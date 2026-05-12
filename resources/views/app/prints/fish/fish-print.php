<?php
if (!empty($orderList)) {
?>
    <script>
        document.getElementById('invoice-form').addEventListener('submit', function(e) {

            window.print();

            setTimeout(() => {
                this.submit();
            }, 100);

        });
    </script>
    <link rel="stylesheet" href="<?= asset('resources/views/app/prints/print.css') ?>" />
    <link rel="stylesheet" href="<?= asset('resources/views/app/prints/fish.css') ?>" />

    <?php
    foreach ($orderList as $order) {

        $types = [
            'afghan' => 'لباس افغانی',
            'vest'   => 'واسکت',
            'suit'   => 'کت و شلوار',
        ];
    ?>
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
                <span>قد: <span class="fs14 bold"><?= $measurement['af_height'] ?: '--' ?></span></span>
                <span>شانه: <span class="fs14 bold"><?= $measurement['af_sholder'] ?: '--' ?></span></span>
            </div>
            <div class="fs12 justify-between p5 bbb">
                <span>آستین: <span class="fs14 bold"><?= $measurement['af_sleeve'] ?: '--' ?></span></span>
                <span>هخن: <span class="fs14 bold"><?= $measurement['af_ice'] ?: '--' ?></span></span>
            </div>
            <div class="fs12 justify-between p5 bbb">
                <span>بغل: <span class="fs14 bold"><?= $measurement['af_hug'] ?: '--' ?></span></span>
                <span>دامن: <span class="fs14 bold"><?= $measurement['af_skirt'] ?: '--' ?></span></span>
            </div>
            <div class="fs12 justify-between p5 bbb">
                <span>چتی: <span class="fs14 bold"><?= $measurement['af_chatty'] ?: '--' ?></span></span>
                <span>شلوار: <span class="fs14 bold"><?= $measurement['af_pants'] ?: '--' ?></span></span>
            </div>
            <div class="fs12 justify-between p5 bbb">
                <span>پارچه: <span class="fs14 bold"><?= $measurement['af_cloth'] ?: '--' ?></span></span>
                <span>بر شلوار: <span class="fs14 bold"><?= $measurement['af_bar_pants'] ?: '--' ?></span></span>
            </div>
            <div class="fs12 p5 bbb">
                <span>مدل: <span class="fs14 bold"></span><?= $order['model_id'] ?></span>
            </div>

            <?= !empty($orders['end_sewing'])
                ? '<div class="fs12 p5 center">تاریخ تحویل: <span>' . $orders['end_sewing'] . '</span></div>'
                : ''
            ?>

        </div>
    <?php }
    ?>


<?php }
?>