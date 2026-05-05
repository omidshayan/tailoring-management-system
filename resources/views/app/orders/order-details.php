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
                <div class="w100 m10 center">تاریخ ثبت</div>
                <div class="w100 m10 center"><?= jdate('Y/m/d', strtotime($order['created_at'])) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">ثبت سفارش توسط</div>
                <div class="w100 m10 center"><?= $order['who_it'] ?></div>
            </div>
        </div>
        <div class="detailes-culomn d-flex align-center cursor-p">
            <div class="title-detaile"><a href="#" data-url="<?= url('change-status-order') ?>" data-id="<?= $order['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a></div>
            <div class="info-detaile">
                <div class="w100 m10 center status status-column" id="status"><?= ($order['status'] != 3) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
            </div>
        </div>



    </div>

    <!-- lists -->
    <div class="box-container mt20 pt10 mb10">
        <div class="fs12 color-orange">لیست سفارشات</div>
        <div>
            <ul>
                <?php
                $number = 1;
                foreach ($orderList as $item) {
                    $types = [
                        'afghan' => 'لباس افغانی',
                        'vest'   => 'واسکت',
                        'suit'   => 'کت و شلوار',
                    ];

                    $typeLabel = $types[$item['type']] ?? 'نامشخص';
                ?>
                    <div class="d-flex bg-main border hover justify-between align-center">
                        <li class="fs14 p5"><?= $number . '- ' . $typeLabel . ' - ' . ' مدل: ' . $item['model_name'] . ' - ' . ' اجرت دوخت: ' . number_format($item['sewing_fee']) ?></li>
                    </div>
                <?php
                    $number++;
                }
                ?>
            </ul>
        </div>
    </div>

    <a href="<?= url('orders') ?>" class="color text-underline">
        <div class="center">برگشت</div>
    </a>
</div>

<?php include_once('resources/views/layouts/footer.php') ?>