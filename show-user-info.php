<?php include_once 'sidebar.php'; ?>

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

        <div class="show-size-customer">
            <h3 class="title-size"> اطلاعات <?=$data->username?></h3>
            <div class="box-size">نام: <?php 
                if($data->username == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->username;
                }
            ?></div>
            <div class="box-size">شماره: <?php 
                if($data->phone == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->phone;
                }
            ?></div>
            <div class="box-size">رمزعبور: <?php 
                if($data->customer_pass == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_pass;
                }
            ?></div>                                    
            <div class="box-size">توضیحات: <?php 
                if($data->customer_desc == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_desc;
                }
            ?></div>



            <h3 class="title-size">اندازه ها</h3>
            <div class="box-size">قد: <?php 
                if($data->customer_height == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_height;
                }
            ?></div>
            <div class="box-size">شانه: <?php 
                if($data->customer_sholder == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_sholder;
                }
            ?></div>
            <div class="box-size">آستین: <?php 
                if($data->customer_sleeve == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_sleeve;
                }
            ?></div>
            <div class="box-size">هخن: <?php 
                if($data->customer_ice == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_ice;
                }
            ?></div>
            <div class="box-size">بغل: <?php 
                if($data->customer_hug== ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_hug;
                }
            ?></div>
            <div class="box-size">دامن: <?php 
                if($data->customer_skirt == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_skirt;
                }
            ?></div>
            <div class="box-size">چتی: <?php 
                if($data->customer_chatty== ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_chatty;
                }
            ?></div>
            <div class="box-size">شلوار: <?php 
                if($data->customer_pants == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_pants;
                }
            ?></div>
            <div class="box-size">پارچه: <?php 
                if($data->customer_cloth == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_cloth;
                }
            ?></div>
            <div class="box-size">بر شلوار: <?php 
                if($data->customer_bar_pants == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_bar_pants;
                }
            ?></div>
            <div class="box-size">مدل: <?php 
                if($data->customer_model == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_model;
                }
            ?></div>
            <div class="box-size">توضیحات:  <?php 
                if($data->customer_size_desc== ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->customer_size_desc;
                }
            ?></div>
            <h3 class="title-size">اندازه واسکت</h3>
            <div class="box-size">شانه: <?php 
                if($data->vaskat_sholder == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->vaskat_sholder;
                }
            ?></div>
            <div class="box-size">قد: <?php 
                if($data->vaskat_height == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->vaskat_height;
                }
            ?></div>
            <div class="box-size">چتی: <?php 
                if($data->vaskat_chatty == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->vaskat_chatty;
                }
            ?></div>
            <div class="box-size m-m">توضیحات: <?php 
                if($data->vaskat_desc == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->vaskat_desc;
                }
            ?> </div>

<?php 
$sql1 = "SELECT * FROM `orders` WHERE user_phone = ?";
$result1 = $connect->prepare($sql1);
$result1->bindValue(1,$data->phone);
$result1->execute();
$row1 = $result1->rowCount();
$rows1 = $result1->fetchAll(PDO::FETCH_ASSOC);
$db_all_price = 0;
$db_discount = 0;
$db_prepayment = 0;
$db_remaining = 0;
$db_final_price = 0;
$final_pre = 0;
$payment = 0;
foreach($rows1 as $row){ 
    $end_time = $row['create_at'];
    $db_discount += intval($row['discount']);
    $db_final_price += intval($row['final_price']);
    $db_prepayment += intval($row['prepayment']);
    $db_all_price += intval($row['all_price']);
    $payment = $row['id'];
    $sum = $db_discount + $db_prepayment + $db_final_price;
    $db_remaining = $db_all_price - $sum;
    $final_pre = $db_prepayment + $db_final_price;
            } 
?>
        <h3 class="title-size">تاریخچه سفارش ها </h3>
    <div class="box-size m-m">تعداد سفارش ها: <?php 
        if($row1 == ""){
            echo " - - - - - ";
        }
        else{
            echo $row1;
        }
    ?> </div>
    <div class="box-size m-m">مبلغ کل: <?php 
        if($db_all_price == ""){
            echo " - - - - - ";
        }
        else{
            echo $db_all_price;
        }
    ?> </div>
    <div class="box-size m-m"> مجموع تخفیف: <?php 
        if($db_discount == ""){
            echo " - - - - - ";
        }
        else{
            echo $db_discount;
        }
    ?> </div>
    <div class="box-size m-m"> مجموع پرداختی ها: <?php 
        if($final_pre == ""){
            echo " - - - - - ";
        }
        else{
            echo '<span style="color:green;">'. $final_pre . '</span>';
        }
    ?> </div>
    <div class="box-size m-m">مجموع قرض داری: <?php 
        if($db_remaining == ""){
            echo " - - - - - ";
        }
        else{
            echo '<span style="color:red;">'. $db_remaining . '</span>';
        }
        
        if($db_remaining == 0){
            echo '';
        }
        else{
            echo '<span class="link-p"><a href="payment.php?id='.$payment.'">پرداخت</a></span> ';
        }
    ?> 
    
    </div>
    <div class="box-size m-m">تاریخ آخرین سفارش: <?php 
        if(!isset($end_time)){
            echo " - - - - - ";
        }
        else{
            echo $end_time;
        }
    ?> </div>

    <a href="show-customer.php" class="size-link">برگشت</a>
</div>

                     
                </main>
        </div>

   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>