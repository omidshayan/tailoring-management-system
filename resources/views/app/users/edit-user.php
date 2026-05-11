    <?php
    $title = 'ویرایش مشتری' . $user['name'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/error.php');
    ?>

    <div class="content">
        <div class="content-title">ویرایش مشتری: <?= $user['name'] ?></div>
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('edit-user-store/' . $user['id']) ?>" method="POST" enctype="multipart/form-data">

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام مشتری <?= _star ?> </div>
                            <input type="text" class="checkInput" value="<?= $user['name'] ?>" name="name" placeholder="نام و تخلص را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره <?= _star ?></div>
                            <input type="text" class="checkInput validate-number" value="<?= $user['phone'] ?>" name="phone" placeholder="شماره را وارد نمایید" maxlength="15" />
                        </div>
                    </div>

                    <div class="accordion-title color-orange mb5">ثبت اندزه‌ها</div>
                    <div class="accordion-content">
                        <div class="child-accordioin">
                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">قد</div>
                                    <input type="text" value="<?= $user['af_height'] ?>" placeholder="اندازه قد را وارد نمایید ..." name="af_height">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">شانه</div>
                                    <input type="text" value="<?= $user['af_sholder'] ?>" placeholder="اندازه شانه را وارد نمایید ..." name="af_sholder">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">آستین</div>
                                    <input type="text" value="<?= $user['af_sleeve'] ?>" placeholder="اندازه آستین را وارد نمایید ..." name="af_sleeve">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">هخن</div>
                                    <input type="text" value="<?= $user['af_ice'] ?>" placeholder="اندازه هخن را وارد نمایید ..." name="af_ice">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">بغل</div>
                                    <input type="text" value="<?= $user['af_hug'] ?>" placeholder="اندازه بغل را وارد نمایید ..." name="af_hug">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">دامن</div>
                                    <input type="text" value="<?= $user['af_skirt'] ?>" placeholder="اندازه دامن را وارد نمایید ..." name="af_skirt">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">چتی</div>
                                    <input type="text" value="<?= $user['af_chatty'] ?>" placeholder="اندازه چتی را وارد نمایید ..." name="af_chatty">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">شلوار</div>
                                    <input type="text" value="<?= $user['af_pants'] ?>" placeholder="اندازه شلوار را وارد نمایید ..." name="af_pants">
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">پارچه</div>
                                    <input type="text" value="<?= $user['af_cloth'] ?>" placeholder="اندازه پارچه را وارد نمایید ..." name="af_cloth">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">بر‌ شلوار</div>
                                    <input type="text" value="<?= $user['af_bar_pants'] ?>" placeholder="اندازه بر شلوار را وارد نمایید ..." name="af_bar_pants">
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
                                    <input type="text" value="<?= $user['va_height'] ?>" placeholder="اندزه قد را وارد نمایید ..." name="va_height">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">شانه</div>
                                    <input type="text" value="<?= $user['va_sholder'] ?>" placeholder="اندازه شانه را وارد نمایید ..." name="va_sholder">
                                </div>
                            </div>
                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">چتی</div>
                                    <input type="text" value="<?= $user['va_chatty'] ?>" placeholder="اندازه چتی را وارد نمایید ..." name="va_chatty">
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">توضیحات واسکت</div>
                                    <input type="text" value="<?= $user['va_desc'] ?>" placeholder="توضیحات را وارد نمایید ..." name="va_desc">
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
                                    <textarea name="address" placeholder="آدرس را وارد نمایید"><?= $user['address'] ?></textarea>
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">توضیحات</div>
                                    <textarea name="description" placeholder="توضیحات را وارد نمایید"><?= $user['description'] ?></textarea>
                                </div>
                            </div>

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">انتخاب عکس</div>
                                    <input type="file" id="image" name="image" accept="image/*">
                                </div>
                            </div>
                            <div id="imagePreview">
                                <img src="" class="img" alt="">
                            </div>
                            <div>
                                <img src="<?= ($user['image'] ? asset('public/images/users/' . $user['image']) : asset('public/assets/img/empty.png')) ?>" class="img" alt="logo">
                            </div>
                            <div class="fs11">تصویر فعلی</div>

                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ویــرایـــش" class="btn" />
                </form>
            </div>
            <div class="center text-underline">
                <a href="<?= url('users') ?>" class="color">برگشت</a>
            </div>
        </div>
    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>