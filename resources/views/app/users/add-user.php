    <?php
    $title = 'ثبت مشتری جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>

    <div class="content">
        <div class="content-title">ثبت مشتری جدید</div>
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('user-store') ?>" method="POST" enctype="multipart/form-data">

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام مشتری <?= _star ?> </div>
                            <input type="text" class="checkInput" name="name" placeholder="نام و تخلص را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره <?= _star ?></div>
                            <input type="text" class="checkInput validate-number" name="phone" placeholder="شماره را وارد نمایید" maxlength="15" />
                        </div>
                    </div>

                    <div class="accordion-title color-orange mb5">ثبت اندزه‌ها</div>
                    <div class="accordion-content">
                        <div class="child-accordioin">

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">قد</div>
                                    <input type="text" placeholder=" اندازه قد را وارد نمایید ..." name="af_height">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">شانه</div>
                                    <input type="text" placeholder="اندازه شانه را وارد نمایید ..." name="af_sholder">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">آستین</div>
                                    <input type="text" placeholder="اندازه آستین را وارد نمایید ..." name="af_sleeve">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">هخن</div>
                                    <input type="text" placeholder="اندازه هخن را وارد نمایید ..." name="af_ice">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">بغل</div>
                                    <input type="text" placeholder="اندازه بغل را وارد نمایید ..." name="af_hug">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">دامن</div>
                                    <input type="text" placeholder="اندازه دامن را وارد نمایید ..." name="af_skirt">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">چتی</div>
                                    <input type="text" placeholder="اندازه چتی را وارد نمایید ..." name="af_chatty">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">شلوار</div>
                                    <input type="text" placeholder="اندازه شلوار را وارد نمایید ..." name="af_pants">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">پارچه</div>
                                    <input type="text" placeholder="اندازه پارچه را وارد نمایید ..." name="af_cloth">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">بر‌ شلوار</div>
                                    <input type="text" placeholder="اندازه بر شلوار را وارد نمایید ..." name="af_bar_pants">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">مدل</div>
                                    <input type="text" placeholder="مدل را وارد نمایید ..." name="af_model">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">توضیحات دوخت</div>
                                    <input type="type" placeholder="توضیحات را وارد نمایید ..." name="af_desc">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="accordion-title color-orange mb5">ثبت اندازه‌های واسکت</div>
                    <div class="accordion-content">
                        <div class="child-accordioin">

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">قد</div>
                                    <input type="text" placeholder="اندزه قد را وارد نمایید ..." name="va_height">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">شانه</div>
                                    <input type="text" placeholder="اندازه شانه را وارد نمایید ..." name="va_sholder">
                                </div>
                            </div>
                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">چتی</div>
                                    <input type="text" placeholder="اندازه چتی را وارد نمایید ..." name="va_chatty">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">توضیحات واسکت</div>
                                    <input type="text" placeholder="توضیحات را وارد نمایید ..." name="va_desc">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="accordion-title color-orange">جزئیات بیشتر</div>
                    <div class="accordion-content">
                        <div class="child-accordioin">

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">آدرس</div>
                                    <textarea name="address" placeholder="آدرس را وارد نمایید"></textarea>
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">توضیحات</div>
                                    <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">انتخاب عکس</div>
                                    <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/gif">
                                </div>
                            </div>
                            <div id="imagePreview" class="mb100">
                                <img src="" class="img" alt="">
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>