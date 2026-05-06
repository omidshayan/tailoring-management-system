<?php

namespace App;

class Prints extends App
{
    // order invoice print
    public function printOrderInvoice($id)
    {
        $this->middleware(true, true, 'general');

        $branchId = (int)$this->getBranchId();

        // 1. تنظیمات ظاهری بِل (لوگو، آدرس، تلفن شعبه)
        $factor_infos = $this->db->select(
            'SELECT * FROM factor_settings WHERE branch_id = ?',
            [$branchId]
        )->fetch();

        // 2. اطلاعات اصلی بِل (شماره بِل، تاریخ، تخفیف کلی، نام مشتری)
        $invoice_infos = $this->db->select(
            "
            SELECT 
                i.*, 
                u.user_name AS user_name, 
                u.phone AS user_mobile 
            FROM invoices i
            LEFT JOIN users u ON i.user_id = u.id
            WHERE i.id = ? AND i.branch_id = ?",
            [$id, $branchId]
        )->fetch();

        if (!$invoice_infos) {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        // 3. آیتم‌های داخل بِل به همراه جزئیات محصول
        $invoice_items = $this->db->select(
            'SELECT 
            sii.*, 
            p.product_name, 
            p.package_type, 
            p.unit_type,
            p.quantity_in_pack
            FROM invoice_items sii
            LEFT JOIN products p ON p.id = sii.product_id
            WHERE sii.invoice_id = ?',
            [$id]
        )->fetchAll();

        // 4. محاسبات نهایی برای نمایش در انتهای بِل
        $subTotal = 0;
        foreach ($invoice_items as $item) {
            $subTotal += (float)$item['item_total_price']; // جمع مبلغ قبل از تخفیف کلی
        }

        $discount = (float)($invoice_infos['discount'] ?? 0);
        $tax = (float)($invoice_infos['tax'] ?? 0); // اگر مالیات داری
        $finalTotal = $subTotal - $discount + $tax;

        // 5. تبدیل تاریخ میلادی به شمسی برای چاپ (اگر تابع jdate را داری)
        $printDate = date('Y/m/d');
        if (function_exists('jdate')) {
            $printDate = jdate('Y/m/d H:i', strtotime($invoice_infos['created_at']));
        }

        $debtor = $this->db->select(
            'SELECT debtor FROM account_balances WHERE user_id = ? AND branch_id = ?',
            [$invoice_infos['user_id'], $branchId]
        )->fetch();

        // ارسال داده‌ها به ویو برای رندر خروجی
        include_once(BASE_PATH . '/resources/views/app/prints/sale-invoice/sale-print.php');
    }
}
