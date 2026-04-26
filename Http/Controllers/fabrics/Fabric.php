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

    // buy fabric
    public function buyFabric()
    {
        $this->middleware(true, true, 'general', true);
        require_once(BASE_PATH . '/resources/views/app/fabrics/manage/buy-fabric.php');
    }
}
