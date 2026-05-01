<?php
require_once 'Http/Controllers/orders/Order.php';

// add product routes
uri('add-order', 'App\Order', 'addOrder');
uri('orders', 'App\Order', 'orders');
uri('order-store', 'App\Order', 'orderStore', 'POST');
uri('order-details/{id}', 'App\Order', 'orderDetails');
uri('edit-order/{id}', 'App\Order', 'editOrder');
uri('edit-order/store/{id}', 'App\Order', 'editOrderStore', 'POST');
uri('change-status-order/{id}', 'App\Order', 'changeStatusOrder');

uri('search-user', 'App\FinancialSector', 'searchUser', 'POST');
uri('delete-item-cart/{id}', 'App\Order', 'deleteItemCart');