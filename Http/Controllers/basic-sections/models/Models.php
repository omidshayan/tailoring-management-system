<?php

namespace App;

class Models extends App
{
    ////////////// af clothes ///////////////

    // models page
    public function models()
    {
        $this->middleware(true, true, 'general', true);

        $models = $this->db->select('SELECT * FROM models')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/basic-sections/models/models.php');
    }

    // store model
    public function modelStore($request)
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
    public function editModel($id)
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
    public function editModelStore($request, $id)
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
    public function modelDetails($id)
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
    public function changeStatusModel($id)
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

        if ($request['vest_model'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT vest_model FROM vests WHERE `vest_model` = ?', [$request['vest_model']])->fetch();

        if (!empty($item['vest_model'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('vests', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // edit Vest page
    public function editVest($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM vests WHERE `id` = ?', [$id])->fetch();
        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/models/vests/edit-vest.php');
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
        if ($request['vest_model'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM vests WHERE `vest_model` = ?', [$request['vest_model']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'نام مدل وارد شده تکراری است.');
            }
        }
        $this->db->update('vests', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('vests'));
    }

    // Vest detiles page
    public function vestDetails($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM vests WHERE `id` = ?', [$id])->fetch();

        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/basic-sections/models/vests/vest-details.php');
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

        $item = $this->db->select('SELECT * FROM vests WHERE id = ?', [$id])->fetch();

        if (!$item) {
            require BASE_PATH . '/404.php';
            exit;
        }

        $newState = $item['status'] == 1 ? 2 : 1;
        $this->db->update('vests', $item['id'], ['status'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }
}
