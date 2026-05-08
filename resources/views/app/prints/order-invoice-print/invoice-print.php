<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>فاکتور خیاطی</title>

    <link rel="stylesheet" href="<?= asset('resources/views/app/prints/print.css') ?>" />

</head>

<body>
    <div class="form-container border">
        <div class="order-header">
            <div class="order-header1 d-flex justify-between align-center">
                <div class="fs28 bold">خیاطی و پارچه سرای آرمان</div>
                <div class="bold fs18">ARMAN TEXTILE STORE TAILOR</div>
            </div>

            <div class="order-header1 d-flex justify-between align-center">
                <div class="fs14">مدیریت: احمد شفیع احسان</div>
                <div class="fs14">تماس‌ها: 0786484848 - 0786160407</div>
            </div>

            <hr class="hr">

            <div class="fs12 d-flex justify-between">
                <div>شماره ثبت: <?= $order['id'] ?></div>
                <div> تاریخ ثبت: <?= jdate('Y/m/d', strtotime($order['created_at'])) ?></div>
                <div> تاریخ تحویل: <?= jdate('Y/m/d', $order['delivery_date']) ?></div>
            </div>

            <hr class="hr">

            <!-- orders infos -->
            <div>
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نوع</th>
                            <th>مدل</th>
                            <th>پارچه</th>
                            <th>متر</th>
                            <th>فی متر</th>
                            <th>اجرت دوخت</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $number = 1;
                        foreach ($orderItems as $item) { ?>
                            <td><?= $number ?></td>
                            <td><?= $item['type'] ?></td>
                            <td><?= $item['model_id'] ?></td>
                            <td><?= $item['fabric_id'] ?></td>
                            <td><?= $item['fabric_meter'] ?></td>
                            <td><?= number_format($item['price_fabric']) ?></td>
                            <td><?= number_format($item['sewing_fee']) ?></td>
                        <?php
                            $number++;
                        }
                        $final = $order['total_amount'] - $order['paid_amount'];
                        ?>
                        <tr>
                            <td colspan="3">جمع کل: <span class="bold"><?= $this->formatNumber($order['total_amount']) ?></span></td>
                            <td colspan="2">بیعانه: <span class="bold"><?= $this->formatNumber($order['paid_amount']) ?: 0 ?></span></td>
                            <td colspan="2">باقیمانده: <span class="bold"><?= $this->formatNumber($final) ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- footer -->
            <div class="justify-between fs12 m10">
                <div class="bold">آدرس: هرات، شهرنو، نبش جاده بهزاد، انوری مارکت، طبقه دوم</div>
                <div class="fs14 bold">آرمان ما رضایت شماست</div>
            </div>

        </div>
    </div>

    <!-- print -->
    <!-- <script>
        window.onload = async function() {
            await document.fonts.ready;
            setTimeout(() => {

                window.focus();
                window.print();
            }, 100);
        };
    </script> -->
</body>

</html>