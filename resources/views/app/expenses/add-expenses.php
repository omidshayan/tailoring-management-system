    <?php
    $title = 'ثبت مصرفی جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>

    <div class="content">
        <div class="content-title">ثبت مصرفی جدید
            <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
        </div>
        <?php
        $help_title = _help_title;
        $help_content = _help_desc;
        include_once('resources/views/helps/help.php');
        ?>
        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('expense-store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">عنوان مصرفی </div>
                            <input type="text" name="title_expenses" placeholder="عنوان مصرفی را وارد نمائید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب دسته بندی <?= _star ?></div>
                            <select name="category" class="checkSelect">
                                <option selected disabled>لطفا دسته بندی را انتخاب نمائید</option>
                                <?php
                                foreach ($expenses_categories as $expenses_category) { ?>
                                    <option value="<?= $expenses_category['cat_name'] ?>"><?= $expenses_category['cat_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">مبلغ مصرف <?= _star ?></div>
                            <input type="number" id="price" class="checkInput" name="amount" placeholder="مبلغ را وارد نمائید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب کاربر </div>
                            <select name="by_whom">
                                <option selected disabled>مصرف توسط کدام کارمند انجام شده</option>
                                <?php
                                foreach ($by_whom_employees as $by_whom_employee) { ?>
                                    <option value="<?= $by_whom_employee['id'] ?>"><?= $by_whom_employee['employee_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="inputs d-flex">

                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات مصرف را وارد نمائید"></textarea>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">وارد کردن بِل مصرفی</div>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    <div id="imagePreview">
                        <img src="" class="img" alt="">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>
        <!-- end page content -->
    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>