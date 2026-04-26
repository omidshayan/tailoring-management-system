<?php
require_once 'Http/Controllers/fabrics/Fabric.php';

// add product routes
uri('add-fabric', 'App\Fabric', 'addFabric');
uri('fabrics', 'App\Fabric', 'fabrics');
uri('fabric-store', 'App\Fabric', 'fabricStore', 'POST');
uri('fabric-details/{id}', 'App\Fabric', 'fabricDetails');
uri('edit-fabric/{id}', 'App\Fabric', 'editFabric');
uri('edit-fabric-store/{id}', 'App\Fabric', 'editFabricStore', 'POST');
uri('change-status-fabric/{id}', 'App\Fabric', 'changeStatusFabric');

// live search items
uri('search-fabric', 'App\Fabric', 'searchFabcic', 'POST');

// manage fabrices
uri('buy-fabric', 'App\Fabric', 'buyFabric');
uri('buy-fabric-store', 'App\Fabric', 'buyFabricStore', 'POST');
uri('fabric-purchases', 'App\Fabric', 'showFabrics');
uri('edit-buy-fabric/{id}', 'App\Fabric', 'editBuyFabric');
uri('edit-buy-fabric-store/{id}', 'App\Fabric', 'editBuyFabricStore', 'POST');
uri('buy-fabric-details/{id}', 'App\Fabric', 'buyFabricDetails');
uri('change-status-buy-fabric/{id}', 'App\Fabric', 'changeStatusBuyFabric');

uri('close-invoice/{id}', 'App\Fabric', 'closeInvoice', 'POST');
uri('delete-fabric-cart/{id}', 'App\Fabric', 'deleteFabricCart');
// uri('delete-product-cart/{id}', 'App\ProductInventory', 'deleteProductCart');
