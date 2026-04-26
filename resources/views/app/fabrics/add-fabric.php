    <?php
    $title = 'ثبت پارچه جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>

    <div class="content">
        <div class="content-title">ثبت پارچه جدید</div>

        <div class="box-container">
            <div class="insert">
                <form action="<?= url('fabric-store') ?>" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام پارچه <?= _star ?> </div>
                            <input type="text" class="checkInput" name="name" placeholder="نام پارچه را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">مدل پارچه</div>
                            <select name="category">
                                <option disabled selected>مدل پارچه را انتخاب نمایید</option>
                                <option value="چینایی">چینایی</option>
                                <option value="پاکستانی">پاکستانی</option>
                                <option value="هندی">هندی</option>
                                <option value="ایرانی">ایرانی</option>
                            </select>
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">قیمت خرید فی متر <?= _star ?></div>
                            <input type="text" class="checkInput" name="buy_price" placeholder="رنگ پارچه را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">قیمت فروش فی متر <?= _star ?></div>
                            <input type="text" class="checkInput" name="sell_price" placeholder="رنگ پارچه را وارد نمایید" />
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">رنگ پارچه </div>
                            <input type="text" name="color" placeholder="رنگ پارچه را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>
    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>