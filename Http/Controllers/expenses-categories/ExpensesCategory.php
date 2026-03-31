<?php

namespace App;

class ExpensesCategory extends App
{
    //  expenses_categories page
    public function expensesCategories()
    {
        $this->middleware(true, true, 'general', true);

        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories ORDER BY id DESC')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/expenses-categories/expenses-categories.php');
    }

    // store expenses
    public function expenseCatStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);
        if ($request['cat_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE `cat_name` = ?', [$request['cat_name']])->fetch();
        if (!empty($expenses_categories['cat_name'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('expenses_categories', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // edit expense category page
    public function editExpenseCat($id)
    {
        $this->middleware(true, true, 'general');


        $cat = $this->db->select('SELECT * FROM expenses_categories WHERE `id` = ?', [$id])->fetch();
        if ($cat != null) {
            require_once(BASE_PATH . '/resources/views/app/expenses-categories/edit-product-cat.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit Product Cat Store
    public function editExpenseCatStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['cat_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM expenses_categories WHERE `cat_name` = ?', [$request['cat_name']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'نام دسته بندی وارد شده تکراری است.');
            }
        }
        $this->db->update('expenses_categories', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('expenses_categories'));
    }

    // Expense Cat Details detiles page
    public function expenseCatDetails($id)
    {
        $this->middleware(true, true, 'general');

        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE `id` = ?', [$id])->fetch();

        if ($expenses_categories != null) {
            require_once(BASE_PATH . '/resources/views/app/expenses-categories/expense-cat-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status Expense Cat
    public function changeStatusExpenseCat($id)
    {
        $this->middleware(true, true, 'general');

        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE id = ?', [$id])->fetch();

        if ($expenses_categories != null) {
            if ($expenses_categories['state'] == 1) {
                $this->db->update('expenses_categories', $expenses_categories['id'], ['state'], [2]);
                $this->send_json_response(true, _success, 2);
            } else {
                $this->db->update('expenses_categories', $expenses_categories['id'], ['state'], [1]);
                $this->send_json_response(true, _success, 1);
            }
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
