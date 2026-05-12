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

            $measurement = $this->db->select('SELECT * FROM measurements WHERE `user_id` = ?', [$user['id']])->fetch();

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

            $total = $this->db->select("
                    SELECT 
                        SUM(oi.sewing_fee + COALESCE(oi.price_fabric, 0)) AS grand_total
                    FROM order_items oi
                    WHERE oi.status = ?
                    AND oi.order_id = ?
                ", [1, $orders['id']])->fetch();
        }

        require_once(BASE_PATH . '/resources/views/app/orders/add-order.php');
    }

    // store employee
    public function orderStore($request)
    {
        $this->middleware(true, true, 'general');

        // validation
        if (empty($request['user_id']) || empty($request['type']) || empty($request['model']) || empty($request['sewing_fee'])) {
            $this->flashMessage('error', _emptyInputs);
            return;
        }

        $fabirc = null;
        $fabirc_id = null;
        $fabirc_meter = null;
        $priceFabric = null;

        if ($request['fabric'] == 'with_fabric') {
            $fabric = $this->db->select('SELECT quantity FROM fabrics WHERE id = ?', [$request['fabric_id']])->fetch();

            if ($fabric['quantity'] < $request['fabric_meter']) {
                $this->flashMessage('error', 'موجودی پارچه کم است!');
            }

            $fabirc = $request['fabric'];
            $fabirc_id = $request['fabric_id'];
            $fabirc_meter = $request['fabric_meter'];
            $priceFabric = (float)$request['price_fabric'];
        }

        try {
            $this->db->beginTransaction();

            $order = $this->db->select(
                'SELECT id, user_id FROM orders WHERE `status` = ? LIMIT 1',
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

            $sewingFee   = (float)$request['sewing_fee'];

            $orderItem = [
                'order_id'      => $orderId,
                'type'          => $request['type'] ?? null,
                'model_id'      => $request['model'] ?? null,
                'sewing_fee'    => $sewingFee,
                'fabric_id'     => $fabirc_id ?? null,
                'order_fabric'  => $fabirc,
                'fabric_meter'  => $fabirc_meter ?? 0,
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

    // edit order store
    public function editOrderStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // validation
        if (empty($request['type']) || empty($request['model']) || empty($request['sewing_fee'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $order = $this->db->select('SELECT id FROM orders WHERE id = ?', [$id])->fetch();

        if ($request['fabric_id']) {
            $fabric = $this->db->select('SELECT quantity FROM fabrics WHERE id = ?', [$request['fabric_id']])->fetch();

            if ($fabric['quantity'] < $request['fabric_meter']) {
                $this->flashMessage('error', 'موجودی پارچه کم است!');
            }
        }

        try {
            $this->db->beginTransaction();

            $priceFabric = (float)$request['price_fabric'];
            $sewingFee   = (float)$request['sewing_fee'];

            $orderItem = [
                'order_id'      => $id,
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

        if (empty($request['total_amount'])) {
            $this->flashMessage('error', _emptyInputs);
            return;
        }

        try {
            $this->db->beginTransaction();

            $order = $this->db->select(
                'SELECT * FROM orders WHERE id = ? LIMIT 1 FOR UPDATE',
                [$id]
            )->fetch();

            if (!$order) {
                throw new Exception('سفارش پیدا نشد');
            }

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

            $this->db->update('orders', $id, [
                'user_id',
                'total_amount',
                'paid_amount',
                'status',
                'who_it'
            ], [
                $order['user_id'],
                $total,
                $paid,
                2,
                $userInfos['name']
            ]);

            foreach ($orderItems as $item) {

                if ($item['order_fabric'] == 'with_fabric') {

                    $fabric = $this->db->select(
                        'SELECT id, name, quantity FROM fabrics WHERE id = ? LIMIT 1 FOR UPDATE',
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

            if ($paid > 0) {
                $this->db->insert('transactions', [
                    'ref_id',
                    'user_id',
                    'total_amount',
                    'paid_amount',
                    'type'
                ], [
                    $order['id'],
                    $order['user_id'],
                    $total,
                    $paid,
                    1
                ]);
            }

            $this->db->commit();

            if ($request['invoice_print']) {
                $this->flashMessageId('success', 'بِل با موفقیت چاپ شد', $order['id']);
            }

            $this->flashMessage('success', _success);
        } catch (Exception $e) {

            $this->db->rollBack();

            $this->flashMessage('error', $e->getMessage());
        }
    }

    // show orders
    public function orders()
    {
        $this->middleware(true, true, 'general');

        $orders = $this->db->select('
            SELECT o.*, u.name AS user_name
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.id
            WHERE `status` != 1
            ORDER BY id DESC
        ')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/orders/orders.php');
        exit();
    }

    // edit order page
    public function editOrder($id)
    {
        $this->middleware(true, true, 'general', true);

        $order = $this->db->select('SELECT * FROM orders WHERE id = ?', [$id])->fetch();

        $models = $this->db->select('SELECT * FROM models WHERE `status` = 1')->fetchAll();

        if ($order) {

            $user = $this->db->select('SELECT * FROM users WHERE `id` = ?', [$order['user_id']])->fetch();

            $orderList = $this->db->select("
                SELECT 
                    oi.*, 
                    m.model_name,
                    (oi.sewing_fee + COALESCE(oi.price_fabric, 0)) AS total_price
                FROM order_items oi
                LEFT JOIN models m 
                    ON oi.model_id = m.id
                WHERE oi.status = ? AND order_id = ?
            ", [1, $order['id']])->fetchAll();

            // جمع کل
            $total = $this->db->select("
                SELECT 
                    SUM(oi.sewing_fee + COALESCE(oi.price_fabric, 0)) AS grand_total
                FROM order_items oi
                WHERE oi.status = ?
            ", [1])->fetch();
        }



        if (!$order) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        require_once(BASE_PATH . '/resources/views/app/orders/edit-order.php');
    }

    // order detiles page
    public function orderDetails($id)
    {
        $this->middleware(true, true, 'general');

        $order = $this->db->select('SELECT * FROM orders WHERE id = ?', [$id])->fetch();

        $orderList = $this->db->select("
                SELECT 
                    oi.*, 
                    m.model_name,
                    (oi.sewing_fee + COALESCE(oi.price_fabric, 0)) AS total_price
                FROM order_items oi
                LEFT JOIN models m 
                    ON oi.model_id = m.id
                WHERE order_id = ?
            ", [$id])->fetchAll();

        $user = $this->db->select('SELECT * FROM users WHERE `id` = ?', [$order['user_id']])->fetch();

        if (!$order) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        require_once(BASE_PATH . '/resources/views/app/orders/order-details.php');
        exit();
    }

    // change status order
    public function changeStatusOrder($id)
    {
        $this->middleware(true, true, 'general');

        $order = $this->db->select('SELECT * FROM orders WHERE id = ?', [$id])->fetch();

        if (!$order) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newStatus = $order['status'] == 3 ? 4 : 3;

        $this->db->update('orders', $order['id'], ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }

    // change status - end sewing and send msg
    public function endSewing($request, $id)
    {
        $this->middleware(true, true, 'general');

        $order = $this->db->select('SELECT * FROM orders WHERE id = ?', [$request['id']])->fetch();

        if (!$order) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        if ($order['status'] == 4) {
            $this->flashMessage('error', 'این سفارش قبلا به اتمام رسیده است!');
        }

        $date = time();

        if (!empty($request['send_whatsapp'])) {

            $user = $this->db->select(
                'SELECT phone FROM users WHERE id = ?',
                [$order['user_id']]
            )->fetch();

            if (!empty($user['phone'])) {
                $_SESSION['send_whatsapp'] = [
                    'phone' => $user['phone'],
                    'message' => 'با سلام، سفارش شما آماده است و می توانید با مراجعه به خیاطی دریافت نمایید. خیاطی آرمان'
                ];
            }
        }

        $this->db->update('orders', $order['id'], ['end_sewing', 'status'], [$date, 4]);

        $this->flashMessage('success', _success);
    }

    // send msg
    public function sendMsg($id)
    {
        $order = $this->db->select('SELECT * FROM orders WHERE id = ?', [$id])->fetch();

        if (!$order) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $user = $this->db->select(
            'SELECT phone FROM users WHERE id = ?',
            [$order['user_id']]
        )->fetch();

        if (!$user || empty($user['phone'])) {
            $this->flashMessage('error', 'شماره کاربر موجود نیست');
            $this->redirectBack();
        }

        $phone = $user['phone'];
        $message = urlencode('با سلام، سفارش شما آماده است و می توانید با مراجعه به خیاطی دریافت نمایید. خیاطی آرمان');

        $link = "https://wa.me/$phone?text=$message";

        header("Location: $link");
        exit;
    }
}
