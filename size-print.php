<!DOCTYPE html>
<html lang="en">
<head>
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
    margin: 2px;
    border: 2px solid black;
    box-sizing: border-box;
    font-size: 3vmin;
    background: #FFFFFF;
    font-family: titr;
    border-bottom: 1px solid black;

}

.fish_details_part
{
    width: 46%;
    line-height: 30px;
    float: right;
    text-align: center;
    font-size: 4vmin;
    border-bottom: 1px solid black;
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
<?php 
include_once 'db.php';
$sql = "SELECT * FROM `users` WHERE id = ?";
$result = $connect->prepare($sql);
$result->bindValue(1,$_GET['id']);
$result->execute();
$row12 = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);
?>
<br>
<div class="fish">


<div class="fish_details_part right-p">نام: <?php 
                if($data->username == ""){
                    echo " 0";
                }
                else{
                    echo $data->username;
                }
            ?></div>

<div class="fish_details_part left-p"><?php 
                if($data->phone == ""){
                    echo " 0";
                }
                else{
                    echo $data->phone;
                }
                ?> :شماره</div>
                                    


            <h3 class="fish_details_part right-p" style="width: 100%;">اندازه ها</h3>
            <div class="fish_details_part right-p">قد: <?php 
                if($data->customer_height == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_height;
                }
            ?></div>
            <div class="fish_details_part left-p">شانه: <?php 
                if($data->customer_sholder == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_sholder;
                }
            ?></div>
            <div class="fish_details_part right-p">آستین: <?php 
                if($data->customer_sleeve == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_sleeve;
                }
            ?></div>
            <div class="fish_details_part left-p">هخن: <?php 
                if($data->customer_ice == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_ice;
                }
            ?></div>
            <div class="fish_details_part right-p">بغل: <?php 
                if($data->customer_hug== ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_hug;
                }
            ?></div>
            <div class="fish_details_part left-p">دامن: <?php 
                if($data->customer_skirt == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_skirt;
                }
            ?></div>
            <div class="fish_details_part right-p">چتی: <?php 
                if($data->customer_chatty== ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_chatty;
                }
            ?></div>
            <div class="fish_details_part left-p">شلوار: <?php 
                if($data->customer_pants == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_pants;
                }
            ?></div>
            <div class="fish_details_part right-p">پارچه: <?php 
                if($data->customer_cloth == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_cloth;
                }
            ?></div>
            <div class="fish_details_part left-p">بر شلوار: <?php 
                if($data->customer_bar_pants == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_bar_pants;
                }
            ?></div>
            <div class="fish_details_part right-p" style="width: 100%;">مدل: <?php 
                if($data->customer_model == ""){
                    echo " 0";
                }
                else{
                    echo $data->customer_model;
                }
            ?></div>
            <div class="fish_details_part right-p" style="width: 100%;">توضیحات:  <?php 
                if($data->customer_size_desc== ""){
                    echo "ندارد";
                }
                else{
                    echo $data->customer_size_desc;
                }
            ?></div>
            <h3 class="fish_details_part right-p" style="width: 100% !important;">اندازه واسکت</h3>
            <div class="fish_details_part right-p">شانه: <?php 
                if($data->vaskat_sholder == ""){
                    echo "0";
                }
                else{
                    echo $data->vaskat_sholder;
                }
            ?></div>
            <div class="fish_details_part left-p">قد: <?php 
                if($data->vaskat_height == ""){
                    echo " 0";
                }
                else{
                    echo $data->vaskat_height;
                }
            ?></div>
            <div class="fish_details_part right-p" style="width: 100%;">چتی: <?php 
                if($data->vaskat_chatty == ""){
                    echo "0";
                }
                else{
                    echo $data->vaskat_chatty;
                }
            ?></div>
            <div class="fish_details_part right-p" style="width: 100%;">توضیحات: <?php 
                if($data->vaskat_desc == ""){
                    echo "ندارد ";
                }
                else{
                    echo $data->vaskat_desc;
                }
            ?> </div>


</div>

                     
                </main>
        </div>

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
</html>