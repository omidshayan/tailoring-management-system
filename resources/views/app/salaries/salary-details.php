<?php
$title = 'جزئیات کاربر: ' . $item['employee_name'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
?>

<div id="alert" class="alert" style="display: none;"></div>
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<div class="content">
    <div class="content-title"> جزئیات کاربر : <?= $item['employee_name'] ?></div>

    <div class="box-container">

        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">نام کارمند</div>
                <div class="w100 m10 center"><?= $item['employee_name'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">مبلغ پرداخت شده</div>
                <div class="w100 m10 center"><?= $this->formatNumber($item['paid_amount']) . ' <span class="fs11 color-orange"> (افغانی)</span>' ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">تاریخ پرداخت</div>
                <div class="w100 m10 center"><?= jdate('l Y/m/d', $item['date']) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">توضیحات</div>
                <div class="w100 m10 center"><?= ($item['description']) ? $item['description'] : '- - - -' ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">تاریخ ثبت</div>
                <div class="w100 m10 center"><?= jdate('Y/m/d', strtotime($item['created_at'])) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">ثبت شده توسط</div>
                <div class="w100 m10 center"><?= $item['who_it'] ?></div>
            </div>
        </div>

        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">
                    <!-- HTML -->
                    <div class="w100 m10 center">
                        <td>
                            <a href="#" data-url="<?= url('change-status-salary') ?>" data-id="<?= $item['id'] ?>" class="changeStatus color btn p5 w100 m10 center">تغییر وضعیت</a>
                        </td>
                    </div>
                </div>
                <div class="w100 m10 center status status-column flex-justify-align" id="status"><?= ($item['status'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
            </div>
        </div>

        <a href="<?= url('salaries') ?>">
            <div class="btn center p5">برگشت</div>
        </a>

    </div>
</div>

<?php include_once('resources/views/layouts/footer.php') ?>