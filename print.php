<!DOCTYPE html>
<html lang="en">
<head>
        <?php 
include_once 'db.php';
$sql = "SELECT * FROM `orders` WHERE id = ?";
$result = $connect->prepare($sql);
$result->bindValue(1,$_GET['id']);
$result->execute();
$row = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="styles/style.css"> -->
        <link rel="stylesheet" href="styles/print.css">
        <script src="js/jquery.js"></script>
    <title>چاپ فاکتور <?=$data->username?></title>
    <style>
       @font-face
{
    font-family: titr;
    src: url('fonts/titr.eot?#') format('eot'),
    url('fonts/titr.ttf') format('truetype'),
    url('fonts/titr.woff') format('woff');
} 
.fish
{
    width: 95%;
    height: auto;
    margin: 2% 2.5%;
    border: 2px solid black;
    box-sizing: border-box;
    font-size: 3vmin;
    background: #FFFFFF;

}
.fish_title1
{
    width: 100%;
    line-height: 40px;
    text-align: center;
    border-bottom: 1px solid black;
    font-family: titr;
    font-size: 4vmin;
}
.fish_title2
{
    width: 100%;
    line-height: 40px;
    text-align: center;
    border-bottom: 1px solid black;
    font-family: titr;
    font-size: 3vmin;
}
.fish_details
{
    width: 100%;
    height: 60px;
    border-bottom: 1px solid black;
    font-weight: bold;
    font-family: titr;
}
.fish_details_part
{
    width: 46%;
    line-height: 30px;
    float: right;
    text-align: center;
    font-size: 4vmin;
}
.right-p{
    text-align: right;
    margin-right: 4px;
}
.left-p{
    text-align: left;
    margin-right: 5px;
    /* margin-left: 4px; */
}
.order
{
    width: 100%;
    height: 30px;
    border-bottom: 1px solid black;
}
.order_title0
{
    width: 5%;
    line-height: 30px;
    float: right;
    text-align: center;
    font-size: 2.2vmin;
    font-weight: bold;
}
.order_title1
{
    width: 10%;
    line-height: 30px;
    float: right;
    text-align: center;
    font-size: 2.2vmin;
    font-weight: bold;
}
.order_title2
{
    width: 40%;
    line-height: 30px;
    float: right;
    text-align: center;
}
.order_title3
{
    width: 10%;
    line-height: 30px;
    float: right;
    text-align: center;
    font-size: 2.2vmin;
    font-weight: bold;
}
.order_title1
{
    width: 15%;
    line-height: 30px;
    float: right;
    text-align: center;
    font-size: 2.2vmin;
    font-weight: bold;

}
.order_allprice
{
    width: 100%;
    height: 30px;
    border-bottom: 1px solid black;
}
.order_price
{
    line-height: 30px;
    float: right;
    text-align: center;
    font-weight: bold;
    font-size: 2.8vmin;
    background: #ECEFF1;
    border: 1px solid black;
    border-right: none;
    border-top: none;
    box-sizing: border-box;
}
.order_allprice>.order_price:nth-child(1)
{
    width: 45%;
}
.order_allprice>.order_price:nth-child(2)
{
    border-left: none;
    width: 55%;
}
.order_phone
{
    width: 100%;
    line-height: 30px;
    border-bottom: 1px solid black;
    text-align: center;
    font-size: 3vmin;
}
.order_pardakti
{
    background: #ECEFF1;
    width: 100%;
    line-height: 30px;
    border-bottom: 1px solid black;
    text-align: center;
    font-size: 3.1vmin;
}
.order_address
{
    width: 100%;
    line-height: 30px;
    text-align: center;
    font-size: 4vmin;
    border-bottom: 1px solid black;
    font-family: titr;
}
.order_address2
{
    width: 100%;
    line-height: 30px;
    text-align: center;
    font-size: 2.5vmin;
}

        @media print
        {
            .back>a,.print>a
            {
                display: none;
            }
            .fish_title1
            {
                font-size: 15pt;
            }
            .fish_title2
            {
                font-size: 10pt;
            }
            .fish_details_part
            {
                font-size: 9pt;
            }
            .order_title0
            {
                font-size: 8pt;
            }
            .order_title1
            {
                font-size: 6pt;
            }
            .order_title2
            {
                width: 30%;
                font-size: 6pt;
            }
            .order_title3
            {
                width: 12.5%;
                font-size: 6pt;
            }
            .order_allprice>.order_price:nth-child(1)
            {
                width: 47.5%;
            }
            .order_allprice>.order_price:nth-child(2)
            {
                border-left: none;
                width: 52.5%;
            }
            .order_pardakti
            {
                font-size: 8pt;
            }
            .order_price
            {
                font-size: 8pt;
            }
            .order_phone
            {
                font-size: 8pt;
            }
            .order_address
            {
                font-size: 8pt;
            }
            .order_address2
            {
                font-size: 6pt;
            }

        }
    </style>
</head>
<body>

<script>

    $(document).ready(function () {
        $("#print").ready(function () {
            window.print();
        });

    });

</script>


<div class="fish">
<div class="fish_title1">خیاطی آرمان</div>

<div class="fish_details">
<div class="fish_details_part right-p">نام: <?php 
                if($data->username == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->username;
                }
            ?></div>
<div class="fish_details_part left-p"><?php 
                if($data->user_phone == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->user_phone;
                }
                ?> :شماره</div>
<div class="fish_details_part right-p"><?php 
                if($data->all_price == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->all_price;
                }
            ?> :قیمت</div>
<div class="fish_details_part left-p"><?php 
                if($data->discount == ""){
                    echo "0";
                }
                else{
                    echo $data->discount;
                }
            ?> :تخفیف</div>
<div class="fish_details_part right-p"><?php 
                if($data->prepayment == ""){
                    echo "0";
                }
                else{
                    echo $data->prepayment;
                }
            ?> :مبلغ پرداختی</div>
<div class="fish_details_part left-p"><?php 
                if($data->remaining == ""){
                    echo " 0 ";
                }
                else{
                    echo $data->remaining;
                }
            ?> :باقیمانده</div>
</div>

<div class="order_allprice">

</div>

<div class="order_address"><span id="telegram"><?php 
                if($data->create_at == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->create_at;
                }
            ?> :تاریخ ثبت</div>
<div class="order_address"><span id="telegram">آدرس: هرات شهرنو جاده بهزاد</div>
<div class="order_address"><span id="telegram">شماره تماس: 0799898989</div>
<div class="order_address2">سیستم مدیریت خیاطی - 0799898989</div>



</div>

<script>
    function closeWindow(){
 setTimeout(function(){
  window.close();
 }, 1000);
}
 
closeWindow();
</script>
</body>

