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
                    </div>

                    <input type="hidden" name="fabric_id" id="item_id">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>

        <!-- table fabric -->
        <?php
        if (isset($invoice)) { ?>
            <div class="box-container mt20">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>مدل پارچه</th>
                            <th>متراژ (<span class="fs11">متر</span>)</th>
                            <th>قیمت فروش (<span class="fs11">فی متر</span>)</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $number = 1;
                        foreach ($fabrics as $fabric) {
                        ?>
                            <tr>
                                <td class="color-orange <?= ($fabric['status'] == 1) ? '' : 'color-red' ?>"><?= $number ?></td>
                                <td><?= $fabric['name'] ?></td>
                                <td><?= $fabric['quantity'] ?></td>
                                <td><?= number_format($fabric['sell_price']) ?></td>
                                <td>
                                    <a href="<?= url('delete-sale-product-cart/' . $fabric['id']) ?>" class="delete-product flex-justify-align">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512">
                                            <path fill="#ff0000" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $number++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php }
        ?>
    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>