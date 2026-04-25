    <?php
    $title = 'ویرایش واسکت مدل: ' . $item['vest_model'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/error.php');
    ?>

    <div class="content">
        <div class="content-title">ویرایش واسکت مدل: <?= $item['vest_model'] ?></div>
        <div class="box-container">
            <div class="insert">
                <form id="myForm" action="<?= url('edit-vest-store/' . $item['id']) ?>" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام مدل <?= _star ?> </div>
                            <input type="text" name="vest_model" class="checkInput" value="<?= $item['vest_model'] ?>" placeholder="نام مدل را وارد نمایید" autocomplete="off" />
                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="submit" id="submit" value="ویرایش" class="btn bold" />
                </form>
            </div>
            <?= $this->back_link('vests') ?>
        </div>
    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>