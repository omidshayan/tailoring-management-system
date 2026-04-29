    <?php
    $title = 'ویرایش مدل: ' . $item['model_name'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/error.php');
    ?>

    <div class="content">
        <div class="content-title">ویرایش مدل: <?= $item['model_name'] ?></div>
        <div class="box-container">
            <div class="insert">
                <form id="myForm" action="<?= url('edit-model-store/' . $item['id']) ?>" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نوع مدل <?= _star ?></div>
                            <select name="type">
                                <option value="afghan" <?= ($item['type'] == 'afghan') ? 'selected' : '' ?>>لباس افغانی</option>
                                <option value="vest" <?= ($item['type'] == 'vest') ? 'selected' : '' ?>>واسکت</option>
                                <option value="suit" <?= ($item['type'] == 'suit') ? 'selected' : '' ?>>کت و شلوار</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">نام مدل <?= _star ?> </div>
                            <input type="text" name="model_name" class="checkInput" value="<?= $item['model_name'] ?>" placeholder="نام مدل را وارد نمایید" autocomplete="off" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">قیمت <?= _star ?> </div>
                            <input type="text" name="fee" class="checkInput" value="<?= $item['fee'] ?>" placeholder="قیمت مدل را وارد نمایید" autocomplete="off" />
                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="submit" id="submit" value="ویرایش" class="btn bold" />
                </form>
            </div>
            <?= $this->back_link('models') ?>
        </div>
    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>