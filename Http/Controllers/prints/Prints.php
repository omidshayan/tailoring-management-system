<?php

namespace App;

class Prints extends App
{
    // order invoice print
    public function printOrderInvoice($id)
    {
        $this->middleware(true, true, 'general');

        $branchId = (int)$this->getBranchId();

        $order = $this->db->select(
            'SELECT * FROM factor_settings WHERE branch_id = ?',
            [$branchId]
        )->fetch();


        if (!$order) {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        // ارسال داده‌ها به ویو برای رندر خروجی
        include_once(BASE_PATH . '/resources/views/app/prints/sale-invoice/sale-print.php');
    }
}
