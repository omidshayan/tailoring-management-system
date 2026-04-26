<?php

namespace App;

class Fabric extends App
{
    // add employee page
    public function addFabric()
    {
        $this->middleware(true, true, 'general', true);

        require_once(BASE_PATH . '/resources/views/app/fabrics/add-fabric.php');
    }

    // store employee
    public function fabricStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['buy_price'] == '' || $request['sell_price'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $existingEmployee = $this->db->select('SELECT * FROM fabrics WHERE `name` = ? AND category = ?', [$request['name'], $request['category']])->fetch();

        if ($existingEmployee) {
            $this->flashMessage('error', _repeat);
        } else {

            try {
                $this->db->beginTransaction();

                $this->db->insert('fabrics', array_keys($request), $request);

                $this->db->commit();

                $this->flashMessage('success', _success);
            } catch (Exception $e) {
                $this->db->rollBack();
                $this->flashMessage('error', 'خطا در ثبت اطلاعات: ' . $e->getMessage());
            }
        }
    }

    // show employees
    public function fabrics()
    {
        $this->middleware(true, true, 'general');
        $fabrics = $this->db->select('SELECT * FROM fabrics')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/fabrics/fabrics.php');
        exit();
    }

    // edit employee page
    public function editFabric($id)
    {
        $this->middleware(true, true, 'general', true);

        $fabric = $this->db->select('SELECT * FROM fabrics WHERE id = ?', [$id])->fetch();
        if ($fabric != null) {
            require_once(BASE_PATH . '/resources/views/app/fabrics/edit-fabric.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit employee store
    public function editFabricStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['buy_price'] == '' || $request['sell_price'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }
        $existingFabric = $this->db->select(
            'SELECT * FROM fabrics 
                WHERE name = ? 
                AND category = ? 
                AND id != ?',
            [
                $request['name'],
                $request['category'],
                $id
            ]
        )->fetch();

        if ($existingFabric) {
            $this->flashMessage('error', _repeat);
        }

        $this->db->update('fabrics', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('fabrics'));
    }

    // employee detiles page
    public function fabricDetails($id)
    {
        $this->middleware(true, true, 'general');

        $fabric = $this->db->select('SELECT * FROM fabrics WHERE id = ?', [$id])->fetch();

        if ($fabric != null) {
            require_once(BASE_PATH . '/resources/views/app/fabrics/fabric-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status employee
    public function changeStatusFabric($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db->select('SELECT * FROM fabrics WHERE id = ?', [$id])->fetch();

        if (!$employee) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newStatus = $employee['status'] == 1 ? 2 : 1;

        $this->db->update('fabrics', $employee['id'], ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }


    /////// manage fabrices //////////

    // search item
    public function searchFabcic($request)
    {
        $this->middleware(true, true, 'general');
        $infos = $this->db->select("SELECT * FROM fabrics WHERE `name` LIKE ?", ['%' . $request['customer_name'] . '%'])->fetchAll();

        $response = [
            'status' => 'success',
            'items' => $infos,
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // buy fabric
    public function buyFabric()
    {
        $this->middleware(true, true, 'general', true);

        $invoice = $this->db->select('SELECT * FROM invoices WHERE `status` = 1')->fetch();

        if ($invoice) {
            $fabrics = $this->db->select(
                'SELECT fs.*, f.name, f.sell_price 
            FROM fabric_stock fs
            JOIN fabrics f ON fs.fabric_id = f.id
            ORDER BY fs.id DESC'
            )->fetchAll();

            $total = $this->db->select(
                'SELECT SUM(f.buy_price * fs.quantity) as total
                    FROM fabric_stock fs
                    JOIN fabrics f ON fs.fabric_id = f.id'
            )->fetch();
        }

        require_once(BASE_PATH . '/resources/views/app/fabrics/manage/buy-fabric.php');
    }

    // store buy fabric
    public function buyFabricStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['fabric_id'] == '' || $request['quantity'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM fabrics WHERE `id` = ?', [$request['fabric_id']])->fetch();

        if (!$item) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $invoice =  $this->db->select('SELECT * FROM invoices WHERE `status` = 1')->fetch();

        if ($invoice) {
        } else {
            $this->db->insert('invoices', ['type'], [2]);
        }


        try {
            $this->db->beginTransaction();

            $this->db->insert('fabric_stock', array_keys($request), $request);

            $this->db->commit();

            $this->flashMessage('success', _success);
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->flashMessage('error', 'خطا در ثبت اطلاعات: ' . $e->getMessage());
        }
    }

    // show fabrics manage
    public function showFabrics()
    {
        $this->middleware(true, true, 'general');

        $fabrics = $this->db->select(
            'SELECT fs.*, f.name, f.sell_price 
            FROM fabric_stock fs
            JOIN fabrics f ON fs.fabric_id = f.id
            ORDER BY fs.id DESC'
        )->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/fabrics/manage/show-fabrics.php');
        exit();
    }

    // edit Buy Fabric
    public function editBuyFabric($id)
    {
        $this->middleware(true, true, 'general', true);

        $fabric = $this->db->select(
            'SELECT fs.*, f.name 
            FROM fabric_stock fs
            LEFT JOIN fabrics f ON fs.fabric_id = f.id
            WHERE fs.id = ?',
            [$id]
        )->fetch();

        if ($fabric != null) {
            require_once(BASE_PATH . '/resources/views/app/fabrics/manage/edit-buy-fabric.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit employee store
    public function editBuyFabricStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['quantity'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $fabric = $this->db->select('SELECT * FROM fabric_stock WHERE id = ?', [$id])->fetch();;

        if (!$fabric) {
            $this->flashMessage('error', 'فایل مورد نظر یافت نشد!');
        }

        $this->db->update('fabric_stock', $id, ['quantity'], [$request['quantity']]);
        $this->flashMessageTo('success', _success, url('fabric-purchases'));
    }

    // employee detiles page
    public function buyFabricDetails($id)
    {
        $this->middleware(true, true, 'general');

        $fabric = $this->db->select(
            'SELECT fs.*, f.name, f.category, f.sell_price, f.buy_price, f.color
            FROM fabric_stock fs
            LEFT JOIN fabrics f ON fs.fabric_id = f.id
            WHERE fs.id = ?',
            [$id]
        )->fetch();

        if ($fabric != null) {
            require_once(BASE_PATH . '/resources/views/app/fabrics/manage/buy-fabric-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status employee
    public function changeStatusBuyFabric($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db->select('SELECT * FROM fabric_stock WHERE id = ?', [$id])->fetch();

        if (!$employee) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newStatus = $employee['status'] == 1 ? 2 : 1;

        $this->db->update('fabric_stock', $employee['id'], ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }

    // delete product from cart
    public function deleteFabricCart($id)
    {
        $this->middleware(true, true, 'general', true);

        if (!is_numeric($id)) {
            $this->flashMessage('error', 'لطفا اطلاعات درست ارسال نمائید!');
        }

        $product_cart = $this->db->select('SELECT id FROM fabric_stock WHERE `id` = ?', [$id])->fetch();

        if (!$product_cart) {
            require_once(BASE_PATH . '/404.php');
            exit;
        }

        $result = $this->db->delete('fabric_stock', $id);

        if ($result) {
            $this->flashMessage('success', _success);
        } else {
            $this->flashMessage('error', _error);
        }
    }
}
