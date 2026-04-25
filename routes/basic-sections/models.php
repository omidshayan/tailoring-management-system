<?php
require_once 'Http/Controllers/basic-sections/models/Models.php';

// cothes routes
uri('clothes', 'App\Models', 'clothes');
uri('clothes-store', 'App\Models', 'clothesStore', 'POST');
uri('edit-clothes/{id}', 'App\Models', 'editClothes');
uri('edit-clothes-store/{id}', 'App\Models', 'editClothesStore', 'POST');
uri('clothes-details/{id}', 'App\Models', 'clothesDetails');
uri('change-status-clothes/{id}', 'App\Models', 'changeStatusClothes');


// vests routes
uri('vests', 'App\Models', 'vests');
uri('vest-store', 'App\Models', 'vestStore', 'POST');
uri('edit-vest/{id}', 'App\Models', 'editVest');
uri('edit-vest-store/{id}', 'App\Models', 'editVestStore', 'POST');
uri('vest-details/{id}', 'App\Models', 'vestDetails');
uri('change-status-vest/{id}', 'App\Models', 'changeStatusVest');
