<?php
require_once 'Http/Controllers/basic-sections/models/Models.php';

// cothes routes
uri('models', 'App\Models', 'models');
uri('model-store', 'App\Models', 'modelStore', 'POST');
uri('edit-model/{id}', 'App\Models', 'editModel');
uri('edit-clmodelothes-store/{id}', 'App\Models', 'editModelStore', 'POST');
uri('model-details/{id}', 'App\Models', 'modelDetails');
uri('change-status-model/{id}', 'App\Models', 'changeStatusModel');


// vests routes
uri('vests', 'App\Models', 'vests');
uri('vest-store', 'App\Models', 'vestStore', 'POST');
uri('edit-vest/{id}', 'App\Models', 'editVest');
uri('edit-vest-store/{id}', 'App\Models', 'editVestStore', 'POST');
uri('vest-details/{id}', 'App\Models', 'vestDetails');
uri('change-status-vest/{id}', 'App\Models', 'changeStatusVest');
