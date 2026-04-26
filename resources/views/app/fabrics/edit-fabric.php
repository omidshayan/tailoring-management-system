<?php
$title = 'ویرایش پارچه: ' . $fabric['name'];
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/error.php');
?>

<div class="content">
    <div class="content-title">ویرایش پارچه: <?= $fabric['name'] ?></div>

    <div class="box-container">
        <div class="insert">
            <form action="<?= url('edit-fabric-store/' . $fabric['id']) ?>" method="POST">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">نام پارچه <?= _star ?> </div>
                        <input type="text" class="checkInput" name="name" value="<?= $fabric['name'] ?>" placeholder="نام پارچه را وارد نمایید" maxlength="40" />
                    </div>
                    <div class="one">
                        <div class="label-form mb5 fs14">مدل پارچه</div>
                        <select name="category">
                            <option disabled>مدل پارچه را انتخاب نمایید</option>

                            <option value="چینایی" <?= ($fabric['category'] == 'چینایی') ? 'selected' : '' ?>>
                                چینایی
                            </option>

                            <option value="پاکستانی" <?= ($fabric['category'] == 'پاکستانی') ? 'selected' : '' ?>>
                                پاکستانی
                            </option>

                            <option value="هندی" <?= ($fabric['category'] == 'هندی') ? 'selected' : '' ?>>
                                هندی
                            </option>

                            <option value="ایرانی" <?= ($fabric['category'] == 'ایرانی') ? 'selected' : '' ?>>
                                ایرانی
                            </option>

                        </select>
                    </div>
                </div>

                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">قیمت خرید فی متر <?= _star ?></div>
                        <input type="text" class="checkInput" name="buy_price" value="<?= $fabric['buy_price'] ?>" placeholder="رنگ پارچه را وارد نمایید" />
                    </div>
                    <div class="one">
                        <div class="label-form mb5 fs14">قیمت فروش فی متر <?= _star ?></div>
                        <input type="text" class="checkInput" name="sell_price" value="<?= $fabric['sell_price'] ?>" placeholder="رنگ پارچه را وارد نمایید" />
                    </div>
                </div>

                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">رنگ پارچه </div>
                        <input type="text" name="color" value="<?= $fabric['color'] ?>" placeholder="رنگ پارچه را وارد نمایید" />
                    </div>
                    <div class="one">
                        <div class="label-form mb5 fs14">توضیحات</div>
                        <textarea name="description" placeholder="توضیحات را وارد نمایید"><?= $fabric['description'] ?></textarea>
                    </div>
                </div>

                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <input type="submit" id="submit" value="ثبت" class="btn" />
            </form>
        </div>
        <a href="<?= url('fabrics') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
    </div>
</div>

<?php include_once('resources/views/layouts/footer.php') ?>