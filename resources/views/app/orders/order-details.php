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
                <div class="w100 m10 center">مدل</div>
                <div class="w100 m10 center"><?= $order['name'] ?></div>
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
                <div class="w100 m10 center">دسته بندی</div>
                <div class="w100 m10 center"><?= $order['category'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">قیمت خرید فی متر</div>
                <div class="w100 m10 center"><?= number_format($order['buy_price']) . ' <span class="fs11 color-orange"> (افغانی)</span>' ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">قیمت فروش فی متر</div>
                <div class="w100 m10 center"><?= number_format($order['sell_price']) . ' <span class="fs11 color-orange"> (افغانی)</span>' ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">رنگ</div>
                <div class="w100 m10 center"><?= $order['color'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">تاریخ ثبت</div>
                <div class="w100 m10 center"><?= jdate('Y/m/d', strtotime($fabric['created_at'])) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">توسط</div>
                <div class="w100 m10 center"><?= $fabric['who_it'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">توضیحات</div>
                <div class="w100 m10 center"><?= ($fabric['description']) ? $fabric['description'] : '- - - -' ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">
                    <!-- HTML -->
                    <div class="w100 m10 center">
                        <td>
                            <a href="#" data-url="<?= url('change-status-fabric') ?>" data-id="<?= $fabric['id'] ?>" class="changeStatus color btn p5 w100 m10 center">تغییر وضعیت</a>
                        </td>
                    </div>
                </div>
                <div class="w100 m10 center status status-column flex-justify-align" id="status"><?= ($fabric['status'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
            </div>
        </div>
        <a href="<?= url('fabrics') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
</div>


<?php include_once('resources/views/layouts/footer.php') ?>