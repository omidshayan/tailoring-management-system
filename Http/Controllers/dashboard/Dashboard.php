<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Dashboard extends App
{
    public function index()
    {
        $this->validateUserBranch();
        $this->middleware(true, true, 'general', true);
        $this->db = DataBase::getInstance();

        $totalCustomers = $this->db->select("SELECT COUNT(*) AS total FROM users")->fetch();

        $ordersProgress = $this->db->select("SELECT COUNT(*) AS total FROM orders WHERE `status` = 2")->fetch();

        $employees = $this->db->select("SELECT COUNT(*) AS total FROM employees WHERE `state` = 1")->fetch();

        require_once(BASE_PATH . '/resources/views/app/dashboard/index.php');
    }
}
