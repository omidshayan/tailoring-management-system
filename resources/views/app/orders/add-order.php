    <?php
    $title = 'ثبت سفارش جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/datePicker.php');
    include_once('resources/views/scripts/live-search-items.php');
    include_once('resources/views/scripts/live-search-fabric.php');
    ?>
    <style>
        /* کانتینر اصلی کاملاً شفاف */
        .acc-container {
            width: 100%;
            background: transparent;
            border: none;
            overflow: hidden;
            font-family: sans-serif;
        }

        /* هدر آکاردئون */
        .acc-header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            cursor: pointer;
            padding: 10px 0;
            user-select: none;
        }

        /* بخش آیکون و تنظیم چرخش */
        .acc-icon {
            display: flex;
            align-items: center;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* وقتی آکاردئون باز است (حالت پیش‌فرض فعلی) */
        .acc-container.active .acc-icon {
            transform: rotate(180deg);
        }

        /* محتوای آکاردئون با انیمیشن همزمان */
        .acc-content {
            display: grid;
            grid-template-rows: 0fr;
            /* تکنیک گرید برای انیمیشن ارتفاع Auto */
            transition: grid-template-rows 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* باز شدن محتوا همزمان با چرخش آیکون */
        .acc-container.active .acc-content {
            grid-template-rows: 1fr;
        }

        .acc-inner {
            overflow: hidden;
        }

        .acc-body {
            padding-bottom: 15px;
        }
    </style>
    <div class="content">
        <div class="content-title print-none">ثبت سفارش جدید</div>

        <!-- search customer -->
        <div class=" flex-justify-align mb10">
            <div class="search-database-s flex-justify-align border"
                data-url="<?= url('search-item') ?>"
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
                <input type="text" class="p5 fs15 input w100 border checkInput" value="<?= $user['name'] ?? '' ?>" id="search_user" placeholder="جستجوی مشتری" autofocus />
                <ul class="search-back d-none top40" id="backResponseSeller">
                    <li class="search-item color" role="option"></li>
                </ul>
            </div>
        </div>

        <!-- form -->
        <div class="content-container">

            <div class="acc-container active" id="accItem">
                <div class="acc-header" onclick="toggleAcc()">
                    <div class="acc-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <span style="margin-right: 12px; font-weight: bold;">عنوان بخش (پیش‌فرض باز)</span>
                </div>

                <div class="acc-content">
                    <div class="acc-inner">
                        <div class="acc-body">

                            <div class="insert">

                                <form action="<?= url('order-store') ?>" method="POST" id="transactionForm">

                                    <!-- type and model -->
                                    <div class="inputs d-flex">

                                        <div class="one">
                                            <div class="label-form mb5 fs14">نوع</div>
                                            <select id="typeSelect" name="type" onchange="changeType()">
                                                <option value="afghan" selected>لباس افغانی</option>
                                                <option value="vest">واسکت</option>
                                                <option value="suit">کت و شلوار</option>
                                            </select>
                                        </div>

                                        <div class="one" id="afghanBox">
                                            <div class="label-form mb5 fs14">مدل</div>
                                            <select name="model" onchange="setFee(this)">
                                                <option disabled selected>مدل را انتخاب نمایید</option>
                                                <?php foreach ($models as $model) {
                                                    if ($model['type'] != 'afghan') continue; ?>

                                                    <option
                                                        value="<?= $model['id'] ?>"
                                                        data-fee="<?= $model['fee'] ?>">
                                                        <?= $model['model_name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="one" id="vestBox" style="display:none;">
                                            <div class="label-form mb5 fs14">مدل</div>
                                            <select name="model" onchange="setFee(this)">
                                                <option disabled selected>مدل را انتخاب نمایید</option>
                                                <?php foreach ($models as $model) {
                                                    if ($model['type'] != 'vest') continue; ?>

                                                    <option
                                                        value="<?= $model['id'] ?>"
                                                        data-fee="<?= $model['fee'] ?>">
                                                        <?= $model['model_name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="one" id="suitBox" style="display:none;">
                                            <div class="label-form mb5 fs14">مدل</div>
                                            <select name="model" onchange="setFee(this)">
                                                <option disabled selected>مدل را انتخاب نمایید</option>
                                                <?php foreach ($models as $model) {
                                                    if ($model['type'] != 'suit') continue; ?>

                                                    <option
                                                        value="<?= $model['id'] ?>"
                                                        data-fee="<?= $model['fee'] ?>">
                                                        <?= $model['model_name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="one">
                                            <div class="label-form mb5 fs14">اجرت دوخت</div>
                                            <input type="text" id="feeInput" name="sewing_fee" placeholder="اجرت دوخت را وارد نمایید" />
                                        </div>

                                    </div>

                                    <!-- fabric -->
                                    <div class="inputs d-flex">
                                        <div class="one">
                                            <div class="label-form fs14">همراه با پارچه</div>
                                            <select name="fabric">
                                                <option value="with_fabric">همراه با فروش پارچه</option>
                                                <option value="without_fabric">پارچه از مشتری است</option>
                                            </select>
                                        </div>

                                        <!-- select fabric -->
                                        <div class="one deactive">
                                            <div class="label-form fs14">جستجوی پارچه <?= _star ?></div>
                                            <div class="search-fabric pr"
                                                data-url="<?= url('search-fabric') ?>"
                                                data-input-id="search_fabric"
                                                data-result-id="backResponseFabric"
                                                data-field-name="fabric_name"
                                                data-target-id="fabric_id">
                                                <input type="text"
                                                    id="search_fabric"
                                                    class="p5 fs15 input w100 border checkInput"
                                                    placeholder="جستجوی پارچه"
                                                    autocomplete="off" />
                                                <ul class="search-back d-none top40" id="backResponseFabric">
                                                    <li class="search-item color" role="option"></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="one w300 deactive">
                                            <div class="label-form fs14">متراژ پارچه <?= _star ?></div>
                                            <input type="text" class="checkInput" name="fabric_meter" id="fabric_meter" placeholder="متراژ پارچه" />
                                        </div>
                                        <div class="one w300 deactive">
                                            <div class="label-form fs14">قیمت <?= _star ?></div>
                                            <input type="text" class="checkInput" name="price_fabric" id="fabric_total_price" placeholder="قیمت" readonly />
                                        </div>

                                    </div>

                                    <div class="inputs">
                                        <div class="one">
                                            <div class="label-form mb5 fs14">توضیحات </div>
                                            <input type="text" name="description" placeholder="توضیحات سفارش" />
                                        </div>
                                    </div>

                                    <!-- <div class="inputs">
                                        <div class="text-right invoice-print">
                                            <input type="checkbox" class="invoice-print" id="invoice-print" name="invoice_print">
                                            <label for="invoice-print" class="fs14">بِل تراکنش چاپ شود</label>
                                        </div>
                                    </div> -->

                                    <input type="hidden" name="user_id" id="item_id" value="<?= $user['id'] ?? '' ?>">
                                    <input type="hidden" name="fabric_id" id="fabric_id">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                                    <input type="submit" id="submit" value="ثبت" class="btn" />
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- lists -->
        <div class="content-container mt20 pt10">
            <div class="fs12 mb5 color-orange">لیست سفارشات</div>
            <div class="d-flex gap20">
                <?php
                if (!empty($orderList)) { ?>
                    <div class="w50d">
                        <ul>
                            <?php
                            $number = 1;
                            foreach ($orderList as $item) {
                                $types = [
                                    'afghan' => 'لباس افغانی',
                                    'vest'   => 'واسکت',
                                    'suit'   => 'کت و شلوار',
                                ];

                                $typeLabel = $types[$item['type']] ?? 'نامشخص';
                            ?>
                                <div class="d-flex bg-main border justify-between align-center">
                                    <li class="fs14 p5"><?= $number . '- ' . $typeLabel . ' - ' . ' مدل: ' . $item['model_name'] . ' - ' . ' اجرت دوخت: ' . number_format($item['sewing_fee']) ?></li>
                                    <a href="<?= url('delete-item-cart/' . $item['id']) ?>" class="p5 d-flex align-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512">
                                            <path fill="#ff0000" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320z" />
                                        </svg>
                                    </a>
                                </div>
                            <?php
                                $number++;
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- close form -->
                    <div class="w50d bg-main">
                        <div class="insert">
                            <form action="<?= url('fabsdafdfsdfric-store') ?>" method="POST">
                                <div class="center fs14 p5 color-orange">
                                    مجموع کل: <?= number_format($total['grand_total'] ?? 0) ?>
                                </div>
                                <div class="p5 d-flex prl40">
                                    <div class="one">
                                        <div class="label-form fs12">پرداختی (بیعانه)</div>
                                        <input type="text" name="buy_price" placeholder="بیعانه را وارد نمایید" />
                                    </div>
                                </div>

                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                                <input type="submit" id="submit" value="بــستــن فــاکــتور" class="btn prl40" />
                            </form>
                        </div>
                    </div>

                <?php } else {
                    echo '<div class="fs12 color-red m-auto">لیست سفارشات خالی است</div>';
                }
                ?>
            </div>
        </div>

    </div>

    <!-- check for print -->
    <?php include_once('resources/views/app/prints/financials/payment-frame.php'); ?>

    <!-- active select tag -->
    <script>
        document.getElementById('price_type').addEventListener('change', function() {
            let sourceSelect = document.getElementById('source');
            if (this.value == "2") {
                sourceSelect.disabled = false;
            } else {
                sourceSelect.disabled = true;
                sourceSelect.value = "1";
            }
        });
    </script>

    <!-- select models -->
    <script>
        function changeType() {
            let type = document.getElementById('typeSelect').value;

            document.getElementById('afghanBox').style.display = 'none';
            document.getElementById('vestBox').style.display = 'none';
            document.getElementById('suitBox').style.display = 'none';

            if (type === 'afghan') {
                document.getElementById('afghanBox').style.display = 'block';
            } else if (type === 'vest') {
                document.getElementById('vestBox').style.display = 'block';
            } else if (type === 'suit') {
                document.getElementById('suitBox').style.display = 'block';
            }

            document.getElementById('feeInput').value = '';

            document.querySelector('#afghanBox select').selectedIndex = 0;
            document.querySelector('#vestBox select').selectedIndex = 0;
            document.querySelector('#suitBox select').selectedIndex = 0;
        }

        function setFee(selectEl) {
            let fee = selectEl.selectedOptions[0].dataset.fee || '';
            document.getElementById('feeInput').value = fee;
        }

        window.onload = function() {
            changeType();
        };
    </script>

    <!-- active and deactive intpus -->
    <script>
        $(document).ready(function() {

            function toggleFabric() {
                let type = $('select[name="fabric"]').val();

                if (type === 'without_fabric') {

                    $('.deactive').each(function() {
                        $(this).addClass('active-disabled');

                        if ($(this).is('input')) {
                            $(this).prop('disabled', true);
                        }

                        $(this).find('input').prop('disabled', true);

                        // ✔ اضافه شد: حذف checkInput
                        $(this).find('input').removeClass('checkInput');
                    });

                } else {

                    $('.deactive').each(function() {
                        $(this).removeClass('active-disabled');

                        if ($(this).is('input')) {
                            $(this).prop('disabled', false);
                        }

                        $(this).find('input').prop('disabled', false);

                        // ✔ اضافه شد: برگرداندن checkInput (اگر لازم بود)
                        $(this).find('input').addClass('checkInput');
                    });

                }
            }

            $('select[name="fabric"]').on('change', toggleFabric);

            toggleFabric();

        });
    </script>

    <!-- accourdion -->
    <script>
        function toggleAcc() {
            document.getElementById('accItem').classList.toggle('active');
        }
    </script>
    
    <?php include_once('resources/views/layouts/footer.php') ?>