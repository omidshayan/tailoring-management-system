<?php
$title = 'جزئیات فاکتور: ' . $invoice['id'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
include_once('resources/views/scripts/show-img-modal.php');
?>

<div id="alert" class="alert" style="display: none;"></div>
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<div class="content">
    <div class="content-title"> جزئیات فاکتور : <?= $invoice['id'] ?></div>

    <div class="box-container">
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">شماره فاکتور</div>
                <div class="w100 m10 center"><?= $invoice['id'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">مجموع فاکتور</div>
                <div class="w100 m10 center"><?= number_format($invoice['total_amount']) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">مجموع پرداختی</div>
                <div class="w100 m10 center"><?= number_format($invoice['paid_amount']) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">تاریخ ثبت</div>
                <div class="w100 m10 center"><?= jdate('Y/m/d', strtotime($invoice['created_at'])) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">توسط</div>
                <div class="w100 m10 center"><?= $invoice['who_it'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">
                    <div class="w100 m10 center">
                        <td>
                            <a href="#" data-url="<?= url('change-status-buy-fabric') ?>" data-id="<?= $invoice['id'] ?>" class="changeStatus color btn p5 w100 m10 center">تغییر وضعیت</a>
                        </td>
                    </div>
                </div>
                <div class="w100 m10 center status status-column flex-justify-align" id="status"><?= ($invoice['status'] == 2) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
            </div>
        </div>
        <a href="<?= url('fabric-purchases') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
</div>

<?php include_once('resources/views/layouts/footer.php') ?>