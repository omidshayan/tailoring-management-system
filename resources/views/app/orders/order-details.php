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




    </div>

    <!-- lists -->
    <div class="box-container mt20 pt10 mb10">
        <div class="fs12 mb5 color-orange">لیست سفارشات</div>
        <div class="d-flex gap20">

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
                            <a href="<?= url('delete-item-cart/' . $item['id']) ?>" class="p5 d-flex align-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512">
                                    <path fill="#ff0000" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320z" />
                                </svg>
                            </a>
                        </div>
                    <?php
                        $number++;
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <a href="<?= url('fabrics') ?>">
        <div class="btn center p5">برگشت</div>
    </a>
</div>


<?php include_once('resources/views/layouts/footer.php') ?>