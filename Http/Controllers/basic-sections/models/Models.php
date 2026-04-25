<?php

namespace App;

class Models extends App
{
    // models page
    public function clothes()
    {
        $this->middleware(true, true, 'general', true);

        $models = $this->db->select('SELECT * FROM models')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/basic-sections/models/models.php');
    }

    // store model
    public function clothesStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['af_model'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT af_model FROM models WHERE `af_model` = ?', [$request['af_model']])->fetch();

        if (!empty($item['af_model'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('models', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // edit locations page
    public function editLocation($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM locations WHERE `id` = ?', [$id])->fetch();
        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/locations/edit-location.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit company Store
    public function editLocationStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['location_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM locations WHERE `location_name` = ?', [$request['location_name']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'نام کمپانی وارد شده تکراری است.');
            }
        }
        $this->db->update('locations', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('locations'));
    }

    // locations detiles page
    public function locationDetails($id)
    {
        $this->middleware(true, true, 'general');

        $branchId = $this->getBranchId();

        $item = $this->db->select('SELECT * FROM locations WHERE `id` = ?', [$id])->fetch();

        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/locations/location-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status locations
    public function changeStatusLocation($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM locations WHERE id = ?', [$id])->fetch();

        if (!$item) {
            require BASE_PATH . '/404.php';
            exit;
        }

        $newState = $item['status'] == 1 ? 2 : 1;
        $this->db->update('locations', $item['id'], ['status'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }
}
