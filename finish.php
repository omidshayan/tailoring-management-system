<?php include_once 'sidebar.php'; ?>
<div class="overview">
                        <div class="all-review"> لیست سفارش ها</div>
                     </div>   
                     <br>

        <div class="table-wrapper">
            <table class="fl-table">
            <?php 
            if(isset($_GET['ok'])){
                    echo ' <span class="mytxt">سفارش جدید با موفقیت ثبت شد :)</span>';
            }
            if(isset($_GET['error'])){
                    echo ' <span class="mytxt">مشکلی پیش آمده است :(</span>';
            }

            ?>
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام </th>
                    <th>شماره موبایل </th>
                    <th>تاریخ ثبت سفارش</th>
                    <th> چاپ</th>
                    <th> پیام</th>
                    <th> کنسل</th>
                </tr>
                </thead>
                <tbody>
                     <!-- confirm delete product -->
                     <script>
    $(document).ready(function () {
        $(".delete").click(function () {
            var msg=confirm("جهت اجرای عملیات مطمئن هستید؟");
            if(msg==true)
            {

            }
            else
            {
                return false;
            }
        });
    });


    $(document).ready(function () {
        $(".new-order").click(function () {
            var msg=confirm("سفارش جدید ثبت شود؟");
            if(msg==true)
            {

            }
            else
            {
                return false;
            }
        });
    });

</script>

        <?php 
        include_once "db.php"; 
        $sql = "SELECT * FROM `orders` WHERE `state` = 0 ORDER BY `id` DESC ";
        $result = $connect->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $number = 1;
        $message = "با سلام، سفارش شما آماده است و می توانید با مراجعه به خیاطی دریافت نمایید. خیاطی آرمان";
        foreach($rows as $row){ ?>
            <tr>
                <td><?=$number?></td>
                <td><?=$row['username']?></td>
                <td><?=$row['user_phone']?></td>
                <td><?=$row['create_at']?></td>
                <td><a href="print.php?id=<?=$row['id']?>" target="blank"><i class="fas fa-print"></i></a></td>
                <td><a href="https://wa.me/+93<?=$row['user_phone']?>?text=<?= $message ?>"  target="blank" class="delete"><i class="fab fa-whatsapp-square"></i></a></td>
                <td><a href="back/delete-order-check.php?id=<?=$row['id']?>"  class="delete"><i class="fas fa-trash-alt" style="color: red;"></i></a></td>
            </tr>
        <?php $number ++; 
     }  ?>

                                        <tbody>
                                    </table>
                            </div>
                   
                     
                </main>


        </div>

   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>