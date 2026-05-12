<?php
if (!empty($orderList)) { ?>
    <html lang="fa">

    <head>
        <meta charset="UTF-8">
        <title>فاکتور خیاطی</title>

        <link rel="stylesheet" href="<?= asset('resources/views/app/prints/print.css') ?>" />
        <link rel="stylesheet" href="<?= asset('resources/views/app/prints/fish.css') ?>" />

    </head>
    <?php
    foreach ($orderList as $order) {

        $types = [
            'afghan' => 'لباس افغانی',
            'vest'   => 'واسکت',
            'suit'   => 'کت و شلوار',
        ];
    ?>

        <body>
            <div class="fish-print color-print">
                <div class="center fs14">خیاطی و پارچه سرای آرمان</div>

                <hr>

                <div class="fs12 p5 color-print justify-between">
                    <div> نام: <?= $user['name'] ?></div>
                    <div class="fa10">تاریخ: <?= jdate('Y/m/d', strtotime($order['created_at'])) ?></div>
                </div>
                <hr>

                <div class="fs12 p5 bbb">
                    <span>نوع سفارش: <?= $types[$item['type']] ?></span>
                </div>

                <div class="fs12 justify-between p5 bbb">
                    <span>قد: 45</span>
                    <span>شانه: 33</span>
                </div>

                <div class="fs12 justify-between p5 bbb">
                    <span>آستین: 45</span>
                    <span>هخن: شانه</span>
                </div>
                <div class="fs12 justify-between p5 bbb">
                    <span>بغل: 45</span>
                    <span>دامن: شانه</span>
                </div>
                <div class="fs12 justify-between p5 bbb">
                    <span>چتی: 45</span>
                    <span>شلوار: شانه</span>
                </div>
                <div class="fs12 justify-between p5 bbb">
                    <span>پارچه: 45</span>
                    <span>بر شلوار: شانه</span>
                </div>
                <div class="fs12 p5 bbb">
                    <span>مدل: <?= $item['model_name'] ?></span>
                </div>

                <div class="fs12 p5 center">تاریخ تحویل: <span>1405/25/10</span></div>

            </div>

        </body>

    <?php }
    ?>


    </html>
<?php }
?>