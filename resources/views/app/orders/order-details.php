<?php
$title = 'جزئیات سفارش: ' . $user['name'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
include_once('resources/views/scripts/show-img-modal.php');
$date = explode(' ', $order['created_at']);
?>

<div id="alert" class="alert" style="display: none;"></div>

<!-- loading and overlay -->
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<div class="content">
    <div class="content-title"> جزئیات پارچه : <?= $user['name'] ?></div>

    <div class="box-container">
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">نام مشتری</div>
                <div class="w100 m10 center"><?= $user['name'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">مبلغ کل</div>
                <div class="w100 m10 center"><?= $order['total_amount'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">بیعانه</div>
                <div class="w100 m10 center"><?= $order['paid_amount'] ?: 0 ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">وضعیت دوخت</div>
                <div class="w100 m10 center"><?= $order['status'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">ثبت سفارش توسط</div>
                <div class="w100 m10 center"><?= $order['who_it'] ?></div>
            </div>
        </div>


        
        <a href="<?= url('fabrics') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
</div>


<?php include_once('resources/views/layouts/footer.php') ?>