<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>فاکتور خیاطی</title>

<style>
body {
    font-family: Tahoma;
    direction: rtl;
    background-color: #0706065d;
}

.invoice {
    width: 100%;
    height: 7.5cm;
    border: 2px solid #000;
    padding: 10px;
    box-sizing: border-box;
}

/* هدر */
.header {
    text-align: center;
    font-weight: bold;
    font-size: 18px;
}

/* اطلاعات بالا */
.top-info {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    font-size: 14px;
}

/* جدول اصلی */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.table td {
    border: 1px solid #000;
    padding: 5px;
    height: 30px;
    font-size: 13px;
}

/* فوتر */
.footer {
    margin-top: 10px;
    font-size: 12px;
    text-align: center;
}

/* لوگو سمت چپ */
.side-logo {
    position: absolute;
    left: 10px;
    top: 20px;
    text-align: center;
    font-size: 14px;
}
</style>

</head>
<body>

<div class="invoice">

    <!-- لوگو -->
    <div class="side-logo">
        <div>آرمان</div>
    </div>

    <!-- عنوان -->
    <div class="header">
        خیاطی و پارچه سرای آرمان
    </div>

    <!-- اطلاعات -->
    <div class="top-info">
        <div>مدیر: احمد حسین</div>
        <div>شماره: 254</div>
        <div>تاریخ: 1403/01/01</div>
    </div>

    <!-- جدول -->
    <table class="table">
        <tr>
            <td>نام مشتری</td>
            <td colspan="3"></td>
        </tr>

        <tr>
            <td>تعداد</td>
            <td></td>
            <td>قیمت</td>
            <td></td>
        </tr>

        <tr>
            <td>مجموعه</td>
            <td></td>
            <td>جوره</td>
            <td></td>
        </tr>

        <tr>
            <td>پرداخت</td>
            <td></td>
            <td>باقیمانده</td>
            <td></td>
        </tr>

        <tr>
            <td>رسید</td>
            <td></td>
            <td>یادداشت</td>
            <td></td>
        </tr>
    </table>

    <!-- فوتر -->
    <div class="footer">
        آدرس: هرات، شهر نو، جاده بهزاد
    </div>

</div>

</body>
</html>