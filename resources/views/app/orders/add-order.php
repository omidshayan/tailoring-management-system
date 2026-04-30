    <?php
    $title = 'ثبت سفارش جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/datePicker.php');
    include_once('resources/views/scripts/live-search-items.php');
    include_once('resources/views/scripts/live-search-fabric.php');
    ?>

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
                <input type="text" class="p5 fs15 input w100 border checkInput" id="search_user" placeholder="جستجوی مشتری" autofocus />
                <ul class="search-back d-none top40" id="backResponseSeller">
                    <li class="search-item color" role="option"></li>
                </ul>
            </div>
        </div>

        <div class="content-container">
            <div class="insert">

                <form action="<?= url('order-store') ?>" method="POST" id="transactionForm">

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
                            <select name="afghan_model" onchange="setFee(this)">
                                <option disabled selected>مدل را انتخاب نمایید</option>
                                <?php foreach ($models as $model) {
                                    if ($model['type'] != 'afghan') continue; ?>

                                    <option
                                        value="<?= $model['model_name'] ?>"
                                        data-fee="<?= $model['fee'] ?>">
                                        <?= $model['model_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="one" id="vestBox" style="display:none;">
                            <div class="label-form mb5 fs14">مدل</div>
                            <select name="vest_model" onchange="setFee(this)">
                                <option disabled selected>مدل را انتخاب نمایید</option>
                                <?php foreach ($models as $model) {
                                    if ($model['type'] != 'vest') continue; ?>

                                    <option
                                        value="<?= $model['model_name'] ?>"
                                        data-fee="<?= $model['fee'] ?>">
                                        <?= $model['model_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="one" id="suitBox" style="display:none;">
                            <div class="label-form mb5 fs14">مدل</div>
                            <select name="suit_model" onchange="setFee(this)">
                                <option disabled selected>مدل را انتخاب نمایید</option>
                                <?php foreach ($models as $model) {
                                    if ($model['type'] != 'suit') continue; ?>

                                    <option
                                        value="<?= $model['model_name'] ?>"
                                        data-fee="<?= $model['fee'] ?>">
                                        <?= $model['model_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="one">
                            <div class="label-form mb5 fs14">اجرت دوخت</div>
                            <input type="text" id="feeInput" name="fee" placeholder="اجرت دوخت را وارد نمایید" />
                        </div>

                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب</div>
                            <select name="fabric">
                                <option value="with_fabric">همراه با پارچه</option>
                                <option value="without_fabric">بدون پارچه</option>
                            </select>
                        </div>

                        <!-- select fabric -->
                        <div class="one">
                            <div class="label-form mb5 fs14">جستجوی پارچه</div>
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


                        <div class="one w300">
                            <div class="label-form mb5 fs14">متراژ پارچه</div>
                            <input type="text" placeholder="متراژ پارچه" />
                        </div>
                        <div class="one w300">
                            <div class="label-form mb5 fs14">قیمت</div>
                            <input type="text" placeholder="قیمت" />
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات </div>
                            <textarea name="description" placeholder="توضیحات را وارد نمائید"></textarea>
                        </div>
                    </div>

                    <div class="inputs">
                        <div class="text-right invoice-print">
                            <input type="checkbox" class="invoice-print" id="invoice-print" name="invoice_print">
                            <label for="invoice-print" class="fs14">بِل تراکنش چاپ شود</label>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" id="item_id">
                    <input type="hidden" name="fabric_id" id="fabric_id">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
                
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

    <?php include_once('resources/views/layouts/footer.php') ?>