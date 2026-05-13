    <?php
    $title = 'ثبت معاش جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/datePicker.php');
    ?>

    <div class="content">
        <div class="content-title">ثبت معاش جدید</div>

        <div class="box-container">
            <div class="insert">
                <form action="<?= url('salary-store') ?>" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب کارمند <?= _star ?> </div>
                            <select name="employee_id" class="checkSelect">
                                <option selected disabled>کارمند را انتخاب نمایید</option>
                                <?php
                                foreach ($employees as $employee) { ?>
                                    <option value="<?= $employee['id'] ?>"><?= $employee['employee_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">مبلغ پرداختی <?= _star ?> </div>
                            <input type="number" class="checkInput" id="phone" name="paid_amount" placeholder="مبلغ پرداختی معاش را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">تاریخ پرداخت را انتخاب کنید <?= _star ?></div>
                            <input type="text" data-jdp class="form-control date-view checkInput" placeholder="تاریخ را انتخاب کنید">
                            <input type="hidden" class="date-server checkInput" name="date">
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