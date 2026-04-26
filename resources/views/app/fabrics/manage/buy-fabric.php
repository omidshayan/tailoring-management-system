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
                            <th>ویرایش</th>
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
                                    <a href="<?= url('edit-buy-fabric/' . $fabric['id']) ?>" class="color-orange">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" class="color-orange" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= url('buy-fabric-details/' . $fabric['id']) ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" class="color-orange" />
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