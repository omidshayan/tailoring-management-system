<?php include_once 'sidebar.php'; ?>


<?php 
include_once 'db.php';
$sql = "SELECT * FROM `users` WHERE id = ?";
$result = $connect->prepare($sql);
$result->bindValue(1,$_GET['id']);
$result->execute();
$row = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);
?>
                    <div class="overview">
                        <div class="all-review">ویرایش مشتری:  <?=$data->username?></div>
                     </div>   
                     <br>
                        <?php
                        if(isset($_GET['ok'])){
                            echo '<div class="my-event"><span>مشتری جدید با موفقیت ویرایش شد!</span></div>';
                        }
                                                if(isset($_GET['error'])){
                            echo '<span>not ok</span>';
                        }
                        ?>
                     <div class="insert-cars">
                        <form action="back/update-user-check.php">
                            <h3 class="my-title"> مشخصات مشتری</h3>
                            <div>نام مشتری <span style="color: red;">*</span></div>
                            <input type="text" placeholder="نام مشتری را وارد نمایید ..." name="customer_name" id="search" autocomplete="off" required value="<?=$data->username?>"><div>شماره موبایل <span style="color: red;">*</span></div>
                            <input type="text" placeholder="شماره موبایل مشتری را وارد نمایید ..." name="customer_phone" required value="<?=$data->phone?>">
                            <div>رمزعبور</div>
                            <input type="text" placeholder="به صورت پیش فرض شماره موبایل رمز عبور است..." name="customer_pass" value="<?=$data->customer_pass?>">
                            <div>توضیحات</div>
                            <input type="text" placeholder="توضیحات اضافی را وارد نمایید  ..." name="customer_desc" value="<?=$data->customer_desc?>">
                            <h3 class="my-title"> اندازه های مشتری</h3>
                            <div>قد </div>
                            <input type="text" placeholder="اندازه قد را وارد نمایید ..." name="customer_height" value="<?=$data->customer_height?>">
                            <div>شانه </div>
                            <input type="text" placeholder="اندازه شانه را وارد نمایید ..." name="customer_sholder" value="<?=$data->customer_sholder?>">
                            <div>آستین </div>
                            <input type="text" placeholder="اندازه آستین را وارد نمایید ..." name="customer_sleeve" value="<?=$data->customer_sleeve?>">
                            <div>هخن </div>
                            <input type="text" placeholder="اندازه هخن را وارد نمایید ..." name="customer_ice" value="<?=$data->customer_ice?>">
                            <div>بغل </div>
                            <input type="text" placeholder="اندازه بغل را وارد نمایید ..." name="customer_hug" value="<?=$data->customer_hug?>">
                            <div>دامن </div>
                            <input type="text" placeholder="اندازه دامن را وارد نمایید ..." name="customer_skirt" value="<?=$data->customer_skirt?>">
                            <div>چتی </div>
                            <input type="text" placeholder="اندازه چتی را وارد نمایید ..." name="customer_chatty" value="<?=$data->customer_chatty?>">
                            <div>شلوار </div>
                            <input type="text" placeholder="اندازه شلوار را وارد نمایید ..." name="customer_pants" value="<?=$data->customer_pants?>">
                            <div>پارچه </div>
                            <input type="text" placeholder="اندازه پارچه را وارد نمایید ..." name="customer_cloth" value="<?=$data->customer_cloth?>">
                            <div>بر شلوار </div>
                            <input type="text" placeholder="اندازه بر شلوار را وارد نمایید ..." name="customer_bar_pants" value="<?=$data->customer_bar_pants?>">
                            <div>مدل </div>
                            <input type="text" placeholder="مدل را وارد نمایید ..." name="customer_model" value="<?=$data->customer_model?>">
                            <div>توضیحات </div>
                            <input type="type" placeholder="توضیحات را وارد نمایید ..." name="customer_size_desc" value="<?=$data->customer_size_desc?>">
                            <h3 class="my-title"> اندازه های واسکت</h3>
                            <div>قد </div>
                            <input type="text" placeholder="اندزه قد را وارد نمایید ..." name="vaskat_height" value="<?=$data->vaskat_height?>">     
                            <div>شانه </div>
                            <input type="text" placeholder="اندازه شانه را وارد نمایید ..." name=" vaskat_sholder" value="<?=$data->vaskat_sholder?>">
                            <div>چتی </div>
                            <input type="text" placeholder="اندازه چتی را وارد نمایید ..." name="vaskat_chatty" value="<?=$data->vaskat_chatty?>">
                            <div>توضیحات </div>
                            <input type="text" placeholder="توضیحات را وارد نمایید ..." name="vaskat_desc" value="<?=$data->vaskat_desc?>">
                            <input type="hidden" name="id" value="<?=$data->id?>">

                            <input type="submit" value="ثبت مشتری جدید" class="my-btn" name="btn">
                        </form>
                     </div>
                        
                     
                </main>

        </div>


 


 




   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>