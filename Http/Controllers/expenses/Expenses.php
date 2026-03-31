<?php

namespace App;

require_once 'Http/Models/Calendar.php';
require_once 'Http/Models/Notification.php';

use Models\Calendar\Calendar;
use Models\Notification\Notification;

class Expenses extends App
{
    private $calendar;
    private $notification;

    public function __construct()
    {
        parent::__construct();
        $this->calendar = new Calendar();
        $this->notification = new Notification();
    }

    // add expense page
    public function addExpense()
    {
        $this->middleware(true, true, 'general', true);

        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE `state` = ?', [1])->fetchAll();

        $by_whom_employees = $this->db->select('SELECT * FROM employees WHERE `state` = ?', [1])->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/expenses/add-expenses.php');
    }

    // store expense
    public function expenseStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['category'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $userInfo = $this->currentUser();

        $this->db->beginTransaction();

        try {

            // upload image
            $request['image'] = $this->handleImageUpload($request['image'], 'images/expenses');

            // insert expense
            $this->db->insert('expenses', array_keys($request), $request);

            $lastId = $this->db->lastInsertId();

            // send notifications
            // $this->notification->sendNotif([
            //     'user_id' => $userInfo['name'],
            //     'ref_id' => $lastId,
            //     'type' => 8,
            // ]);

            $this->db->commit();
            $this->flashMessage('success', _success);
        } catch (\Exception $e) {

            $this->db->rollBack();
            $this->flashMessage('error', $e->getMessage());
        }
    }

    // show expenses
    public function showExpenses()
    {
        $this->middleware(true, true, 'general');

        $expenses = $this->db->select('SELECT * FROM expenses ORDER BY id DESC')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/expenses/show-expenses.php');
        exit();
    }

    // edit expense page
    public function editexpense($id)
    {
        $this->middleware(true, true, 'general', true);

        $expense = $this->db->select('SELECT * FROM expenses WHERE id = ?', [$id])->fetch();

        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE `state` = 1')->fetchAll();

        $by_whom_employees = $this->db->select('SELECT * FROM employees WHERE `state` = 1')->fetchAll();

        if ($expense != null) {
            require_once(BASE_PATH . '/resources/views/app/expenses/edit-expense.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit expense store
    public function editExpenseStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['amount'] == '' || !isset($request['category'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $expense = $this->db->select('SELECT * FROM expenses WHERE id = ?', [$id])->fetch();

        if ($expense != null) {

            // check upload photo
            $this->updateImageUpload($request, 'image', 'expenses', 'expenses', $id);

            $this->db->update('expenses', $id, array_keys($request), $request);
            $this->flashMessageTo('success', _success, url('expenses'));
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // expense detiles page
    public function expenseDetails($id)
    {
        $this->middleware(true, true, 'general');
        $expense = $this->db->select('SELECT * FROM expenses WHERE id = ?', [$id])->fetch();
        if ($expense != null) {
            require_once(BASE_PATH . '/resources/views/app/expenses/expense-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status expense
    public function changeStatusExpense($id)
    {
        $this->middleware(true, true, 'general');

        $expense = $this->db->select('SELECT * FROM expenses WHERE id = ?', [$id])->fetch();

        if ($expense != null) {
            if ($expense['state'] == 1) {
                $this->db->update('expenses', $expense['id'], ['state'], [2]);
                $this->send_json_response(true, _success, 2);
            } else {
                $this->db->update('expenses', $expense['id'], ['state'], [1]);
                $this->send_json_response(true, _success, 1);
            }
        } else {
            require_once BASE_PATH . '/404.php';
            exit();
        }
    }
}
