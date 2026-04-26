<?php
$title = 'ویرایش خرید: ' . $fabric['id'];
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/error.php');
?>

<div class="content">
    <div class="content-title">ویرایش خرید: <?= $fabric['id'] ?> - <?=$fabric['name']?></div>

    <div class="box-container">
        <div class="insert">
            <form action="<?= url('buy-fabric-store/' . $fabric['id']) ?>" method="POST">

                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">فی متر <?= _star ?></div>
                        <input type="text" class="checkInput" name="quantity" value="<?=$fabric['quantity']?>" placeholder="فی متر پارچه را وارد نمایید" />
                    </div>
                    <div class="one">
                        <div class="label-form mb5 fs14">توضیحات</div>
                        <textarea name="description" placeholder="توضیحات خرید را وارد نمایید"><?=$fabric['description']?></textarea>
                    </div>
                </div>

                <input type="hidden" name="fabric_id" id="item_id">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <input type="submit" id="submit" value="ثبت" class="btn" />
            </form>
        </div>
    </div>
</div>

<?php include_once('resources/views/layouts/footer.php') ?>