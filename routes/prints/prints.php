<?php
require_once 'Http/Controllers/prints/Prints.php';

// exec cron job routes
uri('print-order-invoice/{id}', 'App\Prints', 'printOrderInvoice');


uri('invoice-print/{id}', 'App\Prints', 'invoicePrint');







// uri('financial-print-item/{id}', 'App\Prints', 'financialPrintItem');
// uri('item-print/{id}', 'App\Prints', 'itemPrint');
