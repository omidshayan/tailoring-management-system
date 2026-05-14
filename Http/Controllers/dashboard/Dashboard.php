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

        $ordersList = $this->db->select("SELECT orders.id, orders.user_id, users.name FROM orders LEFT JOIN users ON users.id = orders.user_id WHERE orders.status = 2")->fetchAll();

        $employees = $this->db->select("SELECT COUNT(*) AS total FROM employees WHERE `state` = 1")->fetch();

        $chartOrders = $this->db->select("SELECT DATE(created_at) as order_date, COUNT(*) as total FROM orders WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY) GROUP BY DATE(created_at) ORDER BY order_date ASC")->fetchAll();

        $days = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $days[$date] = 0;
        }

        foreach ($chartOrders as $row) {
            $days[$row['order_date']] = (int)$row['total'];
        }

        $chartData = [];

        foreach ($days as $date => $total) {
            $chartData[] = [
                'date' => $date,
                'total' => $total
            ];
        }

        require_once(BASE_PATH . '/resources/views/app/dashboard/index.php');
    }
}
