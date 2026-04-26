    <?php
    $title = 'ثبت خرید پارچه ';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/live-search-fabric.php');
    ?>

    <div class="content">
        <div class="content-title">ثبت خرید پارچه</div>

        <!-- search box for fabric -->
        <div class=" flex-justify-align mb10">
            <div class="search-database-s flex-justify-align border"
                data-url="<?= url('search-fabric') ?>"
                data-input-id="search_user"
                data-result-id="backResponseSeller"
                data-field-name="customer_name"
                data-target-id="item_id">
                <a href="#" class="color search-icon-database-s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-10 search-icon w17">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </a>
                <input type="text" class="p5 fs15 input w100 border checkInput" id="search_user" placeholder="جستجوی پارچه" autofocus autocomplete="off" />
                <ul class="search-back d-none top40" id="backResponseSeller">
                    <li class="search-item color" role="option"></li>
                </ul>
            </div>
        </div>

        <div class="box-container">
            <div class="insert">
                <form action="<?= url('buy-fabric-store') ?>" method="POST">

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">فی متر <?= _star ?></div>
                            <input type="text" class="checkInput" name="quantity" placeholder="فی متر پارچه را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات خرید را وارد نمایید"></textarea>
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