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

        $employee = $this->db->select('SELECT salary_price FROM employees WHERE id = ?', [$request['salary_price']])->fetch();

        $month = $this->db->select('SELECT id FROM salary_months WHERE employee_id = ? AND `year` = ? AND `month` = ? LIMIT 1', [$request['employee_id'], $request['year'], $request['month']])->fetch();

        if (!$month) {
            $salary_infos = [
                'employee_id' => $request['employee_id'],
                'base_salary' => $employee['salary_price'],
                'year' => $request['year'],
                'month' => $request['month'],
            ];
            $this->db->insert('salary_payments', array_keys($request), $request);
        }

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

    // change status salary
    public function changeStatusSalary($id)
    {
        $this->middleware(true, true, 'general');

        $item = $this->db->select('SELECT * FROM salary_payments WHERE id = ?', [$id])->fetch();

        if (!$item) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newStatus = $item['status'] == 1 ? 2 : 1;

        $this->db->update('salary_payments', $item['id'], ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }

    // employee Salaries
    public function employeeSalaries()
    {
        $this->middleware(true, true, 'general');

        $salaries = $this->db->select("
            SELECT 
                e.id,
                e.employee_name,
                SUM(sp.paid_amount) AS total_paid
            FROM salary_payments sp
            LEFT JOIN employees e 
                ON sp.employee_id = e.id
            WHERE sp.status = ?
            GROUP BY e.id, e.employee_name
            ORDER BY total_paid DESC
        ", [1])->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/salaries/employee-salaries.php');
    }
}
