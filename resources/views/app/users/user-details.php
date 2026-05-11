<?php
$title = 'جزئیات مشتری: ' . $user['name'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
?>

<!-- loading and overlay -->
<div id="alert" class="alert" style="display: none;"></div>
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>


<div class="content">

    <div class="content-title">
        جزئیات مشتری : <?= $user['name'] ?>
    </div>
    <div class="box-container">

        <div class="accordion-title color-orange">مشخصات عمومی</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام</div>
                    <div class="info-detaile"><?= $user['name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">شماره</div>
                    <div class="info-detaile"><?= $user['phone'] ?></div>
                </div>

                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">آدرس</div>
                    <div class="info-detaile"><?= ($user['address'] ? $user['address'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">توضیحات</div>
                    <div class="info-detaile"><?= ($user['description'] ? $user['description'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تاریخ ثبت</div>
                    <div class="info-detaile"><?= jdate('Y/m/d', strtotime($user['created_at'])) ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ثبت شده توسط</div>
                    <div class="info-detaile"><?= $user['who_it'] ?></div>
                </div>
                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">عکس</div>
                    <div class="info-detaile">
                        <?= ($user['image'] ? '<a href="' . asset('public/images/users/' . $user['image']) . '" target="_blank"><img src="' . asset('public/images/users/' . $user['image']) . '" class="w50" alt=""></a>' : '- - - - ') ?>
                    </div>
                </div>
                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile"><a href="#" data-url="<?= url('change-status-center') ?>" data-id="<?= $user['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a></div>
                    <div class="info-detaile">
                        <div class="w100 m10 center status status-column" id="status"><?= ($user['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-title color-orange">اندازه ها</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام</div>
                    <div class="info-detaile"><?= $user['name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">شماره</div>
                    <div class="info-detaile"><?= $user['phone'] ?></div>
                </div>

                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">آدرس</div>
                    <div class="info-detaile"><?= ($user['address'] ? $user['address'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">توضیحات</div>
                    <div class="info-detaile"><?= ($user['description'] ? $user['description'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تاریخ ثبت</div>
                    <div class="info-detaile"><?= jdate('Y/m/d', strtotime($user['created_at'])) ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ثبت شده توسط</div>
                    <div class="info-detaile"><?= $user['who_it'] ?></div>
                </div>
                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">عکس</div>
                    <div class="info-detaile">
                        <?= ($user['image'] ? '<a href="' . asset('public/images/users/' . $user['image']) . '" target="_blank"><img src="' . asset('public/images/users/' . $user['image']) . '" class="w50" alt=""></a>' : '- - - - ') ?>
                    </div>
                </div>
                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile"><a href="#" data-url="<?= url('change-status-center') ?>" data-id="<?= $user['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a></div>
                    <div class="info-detaile">
                        <div class="w100 m10 center status status-column" id="status"><?= ($user['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?= url('users') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
</div>

</div>

<?php include_once('resources/views/layouts/footer.php') ?>