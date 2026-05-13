<?php

namespace App;

class Salary extends App
{

    // add salary page
    public function addSalary()
    {
        $this->middleware(true, true, 'general', true);

        $employees = $this->db->select('SELECT * FROM employees WHERE `state` = ? AND `role` = ?', [1, 1])->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/salaries/add-salary.php');
    }

    // store salary
    public function salaryStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['employee_id'] == '' || $request['paid_amount'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $timestamp = $request['date'];

        $request['year'] = tr_num(jdate('Y', $timestamp), 'en');
        $request['month'] = tr_num(jdate('m', $timestamp), 'en');

        try {
            $this->db->beginTransaction();

            // insert new employee
            $this->db->insert('salary_payments', array_keys($request), $request);

            $this->db->commit();

            $this->flashMessage('success', _success);
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->flashMessage('error', 'خطا در ثبت اطلاعات: ' . $e->getMessage());
        }
    }

    // show salaries
    public function salaries()
    {
        $this->middleware(true, true, 'general');

        $salaries = $this->db->select("
            SELECT 
                sp.*,
                e.employee_name AS employee_name
            FROM salary_payments sp
            LEFT JOIN employees e ON sp.employee_id = e.id
            ORDER BY sp.id DESC
        ")->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/salaries/salaries.php');
        exit();
    }

    // edit salary page
    public function editSalary($id)
    {
        $this->middleware(true, true, 'general', true);

        $item = $this->db->select("
            SELECT 
                sp.*,
                e.employee_name AS employee_name
            FROM salary_payments sp
            LEFT JOIN employees e ON sp.employee_id = e.id
            WHERE sp.id = ?
        ", [$id])->fetch();

        if ($item != null) {

            $employees = $this->db->select('SELECT * FROM employees WHERE `state` = ? AND `role` = ?', [1, 1])->fetchAll();

            require_once(BASE_PATH . '/resources/views/app/salaries/edit-salary.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit salary store
    public function editSalaryStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['employee_id'] == '' || $request['paid_amount'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $this->db->update('salary_payments', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('salaries'));
    }

    // salary detiles page
    public function salaryDetails($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select("
            SELECT 
                sp.*,
                e.employee_name AS employee_name
            FROM salary_payments sp
            LEFT JOIN employees e ON sp.employee_id = e.id
            WHERE sp.id = ?
        ", [$id])->fetch();

        if ($item != null) {
            require_once(BASE_PATH . '/resources/views/app/salaries/salary-details.php');
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
