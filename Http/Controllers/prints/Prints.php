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
        $this->flashMessageId('success', 'بِل با موفقیت چاپ شد', $invoice['id']);
    }

    // get invoice infos for print
    public function invoicePrint($id)
    {
        $this->middleware(true, true, 'general', true);

        $order = $this->db->select('SELECT o.*, u.name, u.phone FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE o.id = ?', [$id])->fetch();
        
        if ($order) {
            $orderItems = $this->db->select('SELECT oi.*, m.model_name, f.name AS fabric_name FROM order_items oi LEFT JOIN models m ON oi.model_id = m.id LEFT JOIN fabrics f ON oi.fabric_id = f.id WHERE oi.order_id = ?', [$order['id']])->fetchAll();
        } else {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        include_once(BASE_PATH . '/resources/views/app/prints/order-invoice-print/invoice-print.php');
        exit();
    }
}
