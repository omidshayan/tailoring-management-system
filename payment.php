<?php include_once 'sidebar.php'; ?>

        <?php 
include_once 'db.php';
$sql = "SELECT * FROM `orders` WHERE id = ?";
$result = $connect->prepare($sql);
$result->bindValue(1,$_GET['id']);
$result->execute();
$row12 = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);
?>
                    <div class="overview">
                        <div class="all-review">ثبت پرداختی</div>
                     </div>  
<br>
<?php
                        if(isset($_GET['ok'])){
                            echo '<div class="my-event"><span>عملیات با موفقیت انجام شد :)</span></div>';
                        }
                                                if(isset($_GET['error'])){
                            echo '<span>not ok</span>';
                        }
                            if(isset($_GET['larg'])){
                            echo '<span>مبلغ وارد شده از مبلغ باقیمانده بیشتر است!</span>';
                        }
?>
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
                if($data->user_phone == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->user_phone;
                }
            ?></div>
<?php 
$sql1 = "SELECT * FROM `orders` WHERE user_phone = ?";
$result1 = $connect->prepare($sql1);
$result1->bindValue(1,$data->user_phone);
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
       
    
    <div class="box-size m-m">مجموع قرض داری: <?php 
        if($db_remaining == ""){
            echo " - - - - - ";
        }
        else{
            echo '<span style="color:red;">'. $db_remaining . '</span>';
        }
    ?> 
    
    </div>
    <br><br><br><br>
                
                <div class="insert-cars">
                    <form action="back/payment-check.php"><br>
                        <div>مبلغ پرداختی </div>
                        <input type="number" placeholder="مبلغ را وارد نمایید ..." name="final_price" required>
                        <input type="hidden" name="id" value="<?=$data->id?>">
                        <input type="submit" value="ثبت" class="my-btn" name="btn">
                    </form>
                </div>
                    
                    <a href="show-customer.php" class="size-link">نمایش مشتریان</a>
                </div>
    

</div>

                </main>
        </div>

<!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>