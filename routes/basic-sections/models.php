<?php
require_once 'Http/Controllers/basic-sections/models/Models.php';

// Models routes
uri('clothes', 'App\Models', 'clothes');
uri('clothes-store', 'App\Models', 'clothesStore', 'POST');
uri('edit-clothes/{id}', 'App\Models', 'editClothes');
uri('edit-clothes-store/{id}', 'App\Models', 'editClothesStore', 'POST');
uri('clothes-details/{id}', 'App\Models', 'clothesDetails');
uri('change-status-clothes/{id}', 'App\Models', 'changeStatusClothes');
