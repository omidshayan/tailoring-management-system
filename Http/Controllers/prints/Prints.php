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

        // include_once(BASE_PATH . '/resources/views/app/prints/order-invoice-print/invoice-print.php');
        $this->flashMessageId('success', 'بِل با موفقیت ثبت شد', $invoice['id']);
    }

    // get invoice infos for print
    public function invoicePrint($id)
    {
        $this->middleware(true, true, 'general', true);

        $order = $this->db->select(
            'SELECT * FROM orders WHERE id = ?',
            [$id]
        )->fetch();

        if ($order) {
            $orderItems = $this->db->select('SELECT * FROM order_items WHERE order_id = ?', [$order['id']])->fetchAll();
        } else {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        include_once(BASE_PATH . '/resources/views/app/prints/order-invoice-print/invoice-print.php');
        exit();
    }
}
