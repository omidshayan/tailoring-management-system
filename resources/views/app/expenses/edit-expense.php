    <?php
    $title = 'ویرایش مصرفی: ' . $expense['title_expenses'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/error.php');
    ?>

    <div class="content">
        <div class="content-title"> ویرایش مصرفی: <?= $expense['title_expenses'] ?>
            <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
        </div>
        <?php
        $help_title = _help_title;
        $help_content = _help_desc;
        include_once('resources/views/helps/help.php');
        ?>

        <div class="box-container">
            <div class="insert">
                <form action="<?= url('edit-expense-store/' . $expense['id']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">عنوان مصرفی </div>
                            <input type="text" name="title_expenses" value="<?= $expense['title_expenses'] ?>" placeholder="عنوان مصرفی را وارد نمائید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب دسته بندی <?= _star ?></div>
                            <select name="category" class="checkSelect">
                                <option disabled>لطفا دسته بندی را انتخاب نمائید</option>
                                <?php foreach ($expenses_categories as $expenses_category) { ?>
                                    <option
                                        value="<?= $expenses_category['cat_name'] ?>"
                                        <?= ($expenses_category['cat_name'] == $expense['category']) ? 'selected' : '' ?>>
                                        <?= $expenses_category['cat_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">مبلغ مصرف <?= _star ?></div>
                            <input type="text" id="price" value="<?= number_format($expense['amount']) ?>" class="checkInput" name="amount" placeholder="مبلغ را وارد نمائید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب کاربر </div>
                            <select name="by_whom">
                                <option disabled>مصرف توسط کدام کارمند انجام شده</option>
                                <?php foreach ($by_whom_employees as $by_whom_employee) { ?>
                                    <option
                                        value="<?= $by_whom_employee['id'] ?>"
                                        <?= ($by_whom_employee['id'] == $expense['by_whom']) ? 'selected' : '' ?>>
                                        <?= $by_whom_employee['employee_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات مصرف را وارد نمائید"><?= $expense['description'] ?></textarea>
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

                    <div>
                        <img src="<?= ($expense['image'] ? asset('public/images/expenses/' . $expense['image']) : asset('public/assets/img/empty.png')) ?>" class="img" alt="logo">
                    </div>
                    <div class="fs11">تصویر فعلی</div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ویرایش" class="btn" />
                </form>
            </div>
            <a href="<?= url('expenses') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
        </div>
    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>