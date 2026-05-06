<?php

namespace App;

class Prints extends App
{
    // order invoice print
    public function printOrderInvoice($id)
    {
        $this->middleware(true, true, 'general');

        $invoice = $this->db->select('SELECT * FROM orders WHERE id = ?', [$id])->fetch();

        if (!$invoice) {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        $this->flashMessageId('success', 'بِل با موفقیت ثبت شد', $invoice['id']);
    }

    public function invoicePrint($id)
    {
        dd('ok');
        $this->middleware(true, true, 'general', true);
        $branchId = (int)$this->getBranchId();

        $factor_infos = $this->db->select(
            'SELECT * FROM factor_settings WHERE branch_id = ?',
            [$branchId]
        )->fetch();

        $invoice_infos = $this->db->select(
            "SELECT i.*, u.user_name AS user_name, u.phone AS user_mobile, u.address AS user_address 
        FROM invoices i
        LEFT JOIN users u ON i.user_id = u.id
        WHERE i.id = ? AND i.branch_id = ?",
            [$id, $branchId]
        )->fetch();

        if (!$invoice_infos) {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        $invoice_items = $this->db->select(
            'SELECT sii.*, p.product_name, p.package_type, p.unit_type, p.quantity_in_pack
        FROM invoice_items sii
        LEFT JOIN products p ON p.id = sii.product_id
        WHERE sii.invoice_id = ?',
            [$id]
        )->fetchAll();

        $userId = $invoice_infos['user_id'];
        $invoiceTime = $invoice_infos['created_at'];

        $oldBalanceQuery = $this->db->select(
            "SELECT SUM(
            CASE 
                WHEN transaction_type = 5 THEN -paid_amount
                WHEN transaction_type IN (1, 4) THEN -(total_amount - discount - paid_amount)
                
                WHEN transaction_type = 6 THEN paid_amount
                WHEN transaction_type IN (2, 3) THEN (total_amount - discount - paid_amount)
                
                ELSE 0 
            END
         ) as balance 
         FROM users_transactions 
         WHERE user_id = ? AND branch_id = ? AND status = 1 
         AND created_at < ?",
            [$userId, $branchId, $invoiceTime]
        )->fetch();

        $oldBalance = (float)($oldBalanceQuery['balance'] ?? 0.0);

        $subTotal = 0;
        foreach ($invoice_items as $item) {
            $subTotal += (float)$item['item_total_price'];
        }

        $discount   = (float)($invoice_infos['discount'] ?? 0);
        $tax        = (float)($invoice_infos['tax'] ?? 0);
        $finalTotal = $subTotal - $discount + $tax;
        $paidAmount = (float)($invoice_infos['paid_amount'] ?? 0);

        $invoiceRemaining = $finalTotal - $paidAmount;
        $type = (int)$invoice_infos['invoice_type'];

        if ($type == 1 || $type == 4) {
            $currentBalanceValue = $oldBalance - $invoiceRemaining;
        } else {
            $currentBalanceValue = $oldBalance + $invoiceRemaining;
        }

        $displayOldBalance = abs($oldBalance);
        $displayInvoiceRemaining = abs($invoiceRemaining);
        $displayTotalBalance = abs($currentBalanceValue);
        $balanceStatus = $currentBalanceValue >= 0 ? 'طلبکار' : 'بدهکار';

        $thisTransaction = (array)$invoice_infos;

        include_once(BASE_PATH . '/resources/views/app/prints/invoices-print/invoice-print.php');
        exit();
    }
}
