<?php

namespace App;

class Models extends App
{
    ////////////// af clothes ///////////////

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

    // edit clothes page
    public function editClothes($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM models WHERE `id` = ?', [$id])->fetch();
        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/models/edit-model.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit clothes Store
    public function editClothesStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['af_model'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM models WHERE `af_model` = ?', [$request['af_model']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'نام مدل وارد شده تکراری است.');
            }
        }
        $this->db->update('models', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('clothes'));
    }

    // clothes detiles page
    public function clothesDetails($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM models WHERE `id` = ?', [$id])->fetch();

        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/models/model-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status clothes
    public function changeStatusClothes($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM models WHERE id = ?', [$id])->fetch();

        if (!$item) {
            require BASE_PATH . '/404.php';
            exit;
        }

        $newState = $item['status'] == 1 ? 2 : 1;
        $this->db->update('models', $item['id'], ['status'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }

    ////////////// vests /////////////////

        // Vests page
    public function vests()
    {
        $this->middleware(true, true, 'general', true);

        $vests = $this->db->select('SELECT * FROM vests')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/basic-sections/models/vests/vests.php');
    }

    // store Vest
    public function vestStore($request)
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

    // edit Vest page
    public function editVest($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM models WHERE `id` = ?', [$id])->fetch();
        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/models/edit-model.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit Vest Store
    public function editVestStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['af_model'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM models WHERE `af_model` = ?', [$request['af_model']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'نام مدل وارد شده تکراری است.');
            }
        }
        $this->db->update('models', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('clothes'));
    }

    // Vest detiles page
    public function vestDetails($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM models WHERE `id` = ?', [$id])->fetch();

        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/models/model-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status Vest
    public function changeStatusVest($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM models WHERE id = ?', [$id])->fetch();

        if (!$item) {
            require BASE_PATH . '/404.php';
            exit;
        }

        $newState = $item['status'] == 1 ? 2 : 1;
        $this->db->update('models', $item['id'], ['status'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }
}

