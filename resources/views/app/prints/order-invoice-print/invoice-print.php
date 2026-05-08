<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>فاکتور خیاطی</title>
    <link rel="stylesheet" href="<?= asset('public/assets/style/style.css') ?>" />
    <link rel="stylesheet" href="<?= asset('public/assets/style/main.css') ?>" />

    <style>
        body {
            font-family: Tahoma;
            direction: rtl;
            background-color: #0706065d;
        }

        .order-invoice-print {
            width: 40%;
            height: 7.5cm;
            border: 2px solid #000;
            background-color: green;
        }
    </style>

</head>

<body>

    <div class="order-invoice-print">
        <div class="order-header">
            <div class="order-header1 d-flex">
                <div class="header-name-en">ARMAN TEXTILE STORE TAILOR</div>
                <div class="header-name-fa">خیاطی و پارچه سرای آرمان</div>
            </div>
            <div class="order-header2"></div>
        </div>
    </div>

</body>

</html>