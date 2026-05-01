<?php

namespace App;

class Order extends App
{
    // add order page
    public function addOrder()
    {
        $this->middleware(true, true, 'general', true);

        $models = $this->db->select('SELECT * FROM models WHERE `status` = 1')->fetchAll();

        $orders = $this->db->select('SELECT * FROM orders WHERE `status` = 1')->fetch();

        if ($orders) {

            $user = $this->db->select('SELECT * FROM users WHERE `id` = ?', [$orders['user_id']])->fetch();

            $orderList = $this->db->select("
                SELECT 
                    oi.*, 
                    m.model_name,
                    (oi.sewing_fee + COALESCE(oi.price_fabric, 0)) AS total_price
                FROM order_items oi
                LEFT JOIN models m 
                    ON oi.model_id = m.id
                WHERE oi.status = ? AND order_id = ?
            ", [1, $orders['id']])->fetchAll();

            // جمع کل
            $total = $this->db->select("
                SELECT 
                    SUM(oi.sewing_fee + COALESCE(oi.price_fabric, 0)) AS grand_total
                FROM order_items oi
                WHERE oi.status = ?
            ", [1])->fetch();
        }

        require_once(BASE_PATH . '/resources/views/app/orders/add-order.php');
    }

    // store employee
    public function orderStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // validation
        if (empty($request['user_id'])) {
            $this->flashMessage('error', _emptyInputs);
            return;
        }

        try {
            $this->db->beginTransaction();

            $order = $this->db->select(
                'SELECT id, user_id FROM orders WHERE status = ? LIMIT 1',
                [1]
            )->fetch();

            if ($order) {
                $orderId = $order['id'];
                if ($order['user_id'] != $request['user_id']) {
                    $this->db->update('orders', $order['id'], ['user_id'], [$request['user_id']]);
                }
            } else {
                $invoiceOrder = [
                    'user_id' => $request['user_id'],
                    'status' => 1
                ];

                $this->db->insert('orders', array_keys($invoiceOrder), $invoiceOrder);
                $orderId = $this->db->lastInsertId();
            }

            $priceFabric = (float)$request['price_fabric'];
            $sewingFee   = (float)$request['sewing_fee'];

            $orderItem = [
                'order_id'      => $orderId,
                'type'          => $request['type'] ?? null,
                'model_id'      => $request['model'] ?? null,
                'sewing_fee'    => $sewingFee,
                'fabric_id'     => $request['fabric_id'] ?? null,
                'order_fabric'  => $request['fabric'] ?? null,
                'fabric_meter'  => $request['fabric_meter'] ?? 0,
                'price_fabric'  => $priceFabric ?? null,
                'description'   => $request['description'] ?? null,
            ];

            $this->db->insert('order_items', array_keys($orderItem), $orderItem);

            $this->db->commit();

            $this->flashMessage('success', _success);
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->flashMessage('error', 'خطا در ثبت اطلاعات: ' . $e->getMessage());
        }
    }

    // delete product from cart
    public function deleteItemCart($id)
    {
        $this->middleware(true, true, 'general', true);

        if (!is_numeric($id)) {
            $this->flashMessage('error', 'لطفا اطلاعات درست ارسال نمائید!');
        }

        $item = $this->db->select('SELECT id FROM order_items WHERE `id` = ?', [$id])->fetch();

        if (!$item) {
            require_once(BASE_PATH . '/404.php');
            exit;
        }

        $result = $this->db->delete('order_items', $id);

        if ($result) {
            $this->flashMessage('success', _success);
        } else {
            $this->flashMessage('error', _error);
        }
    }

    // close order
    public function closeOrderStore($request, $id)
    {
        $this->middleware(true, true, 'general');

        try {
            $this->db->beginTransaction();

            $order = $this->db->select(
                'SELECT * FROM orders WHERE id = ? LIMIT 1',
                [$id]
            )->fetch();

            if (!$order) {
                throw new Exception('سفارش پیدا نشد');
            }

            // ❗ اگر قبلاً بسته شده
            if ($order['status'] != 1) {
                throw new Exception('این فاکتور قبلاً بسته شده است');
            }

            $orderItems = $this->db->select(
                'SELECT * FROM order_items WHERE order_id = ?',
                [$id]
            )->fetchAll();

            $userInfos = $this->currentUser();

            $total = (float)$request['total_amount'];
            $paid  = (float)($request['paid_amount'] ?? 0);

            if ($paid > $total) {
                throw new Exception('مبلغ پرداختی بیشتر از مبلغ کل است');
            }

            // ✔ آپدیت سفارش
            $orderData = [
                'user_id'      => $order['user_id'],
                'total_amount' => $total,
                'paid_amount'  => $paid,
                'status'       => 2,
                'who_it'       => $userInfos['name'],
            ];

            $this->db->update('orders', $id, array_keys($orderData), $orderData);

            // ✔ آپدیت پارچه
            foreach ($orderItems as $item) {

                if ($item['order_fabric'] == 'with_fabric') {

                    $fabric = $this->db->select(
                        'SELECT id, name, quantity FROM fabrics WHERE id = ? LIMIT 1',
                        [$item['fabric_id']]
                    )->fetch();

                    if (!$fabric) {
                        throw new Exception('پارچه یافت نشد');
                    }

                    $finalMeter = $fabric['quantity'] - $item['fabric_meter'];

                    if ($finalMeter < 0) {
                        throw new Exception('موجودی پارچه ' . $fabric['name'] . ' کافی نیست');
                    }

                    $this->db->update('fabrics', $fabric['id'], ['quantity'], [$finalMeter]);
                }
            }

            // ✔ ثبت تراکنش
            if ($paid > 0) {
                $transaction = [
                    'ref_id'       => $order['id'],
                    'user_id'      => $order['user_id'],
                    'total_amount' => $total,
                    'paid_amount'  => $paid,
                    'type'         => 1,
                ];

                $this->db->insert('transactions', array_keys($transaction), $transaction);
            }

            $this->db->commit();

            $this->flashMessage('success', _success);
        } catch (Exception $e) {

            $this->db->rollBack();

            $this->flashMessage('error', $e->getMessage());
        }
    }











    // show employees
    public function showEmployees()
    {
        $this->middleware(true, true, 'general');
        $employees = $this->db->select('SELECT * FROM employees')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/employees/show-employees.php');
        exit();
    }

    // edit employee page
    public function editEmployee($id)
    {
        $this->middleware(true, true, 'general', true);

        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();
        if ($employee != null) {
            require_once(BASE_PATH . '/resources/views/app/employees/edit-employee.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit employee store
    public function editEmployeeStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['employee_name'] == '' || $request['phone'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $existEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();

        if ($existEmployee) {
            if ($id != $existEmployee['id']) {
                $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
                return;
            }
        }

        // check upload photo
        $this->updateImageUpload($request, 'image', 'employees', 'employees', $id);

        $this->db->update('employees', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('employees'));
    }

    // employee detiles page
    public function employeeDetails($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();

        if ($employee != null) {
            require_once(BASE_PATH . '/resources/views/app/employees/employee-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status employee
    public function changeStatusEmployee($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();

        if (!$employee) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newStatus = $employee['state'] == 1 ? 2 : 1;

        $this->db->update('employees', $employee['id'], ['state'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }
}
