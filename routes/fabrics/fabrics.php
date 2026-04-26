<?php
require_once 'Http/Controllers/fabrics/Fabric.php';

// add product routes
uri('add-fabric', 'App\Fabric', 'addFabric');
uri('fabrics', 'App\Fabric', 'fabrics');
uri('fabric-store', 'App\Fabric', 'fabricStore', 'POST');
uri('fabric-details/{id}', 'App\Fabric', 'fabricDetails');
uri('edit-fabric/{id}', 'App\Fabric', 'editFabric');
uri('edit-fabric/store/{id}', 'App\Fabric', 'editFabricStore', 'POST');
uri('change-status-fabric/{id}', 'App\Fabric', 'changeStatusFabric');

// uri('search-employee', 'App\Employee', 'searchEmployee', 'POST');