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
                e.name AS employee_name
            FROM salary_payments sp
            LEFT JOIN employees e ON sp.employee_id = e.id
            ORDER BY sp.id DESC
        ")->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/salaries/salaries.php');
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

        if ($request['password'] == '') {
            unset($request['password']);
        } else {
            $request['password'] = $this->hash($request['password']);
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
