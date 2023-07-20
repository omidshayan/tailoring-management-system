<?php
session_start();
include_once 'sidebar.php'; ?>
<div class="overview">
                        <div class="all-review"> لیست سفارش ها</div>
                     </div>   
                     <br>

                                <div class="table-wrapper">
                                    <table class="fl-table">
                                    <?php 
                                    if(isset($_GET['ok'])){
                                        echo '<div class="my-event"><span>عملیات با موفقیت انجام شد :)</span></div>';
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
                                            <th> اتمام</th>
                                            <th> پیام</th>
                                            <!-- <th> ویرایش</th> -->
                                            <th> کنسل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                     <!-- confirm delete product -->
                     <script>
    $(document).ready(function () {
        $(".delete").click(function () {
            var msg=confirm("جهت حذف آیتم مطمئن هستید؟");
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
        include_once "../db.php"; 
        $sql = "SELECT * FROM `orders` WHERE `user_phone` = ?";
        $result = $connect->prepare($sql);
        $result->bindValue(1,$_SESSION['phone']);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $number = 1;
        $text = "سلام وقت شما بخیر، لباس شما آماده است و می توانید تحویل بگیرید ";
        foreach($rows as $row){ ?>
        <tr>
            <td><?=$number?></td>
            <td><?=$row['username']?></td>
            <td><?=$row['user_phone']?></td>
            <td><?=$row['create_at']?></td>
            <td><a href="print.php?id=<?=$row['id']?>" target="blank"><i class="fas fa-print"></i></a></td>
            <?php if($row['state'] == 1){ ?>
                <td><a href="finish-order.php?id=<?=$row['id']?>"><i class="fas fa-hourglass-end"></i></a></td>          
        <?php    }
                else { ?>
                    <td><a href="#"><i class="fas fa-ban" style="color: red;"></i></a></td>      
                <?php  }
        ?>
            <td><a href="https://wa.me/+93<?=$row['user_phone']?>?text=<?= $text ?>" target="blank" class="delete"><i class="fab fa-whatsapp-square"></i></a></td>
            <!-- <td><a href="update-order.php?id=<?=$row['id']?>"><i class="fas fa-edit"></i></a></td> -->

            <?php if($row['state'] == 1){ ?>
                <td><a href="back/delete-order-check.php?id=<?=$row['id']?>"><i class="fas fa-hourglass-end"></i></a></td>          
        <?php    }
                else { ?>
                    <td><a href="#"><i class="fas fa-trash-alt" style="color: gray;"></i></a></td>      
                <?php  }
        ?>
            <!-- <td><a href="back/delete-order-check.php?id=<?=$row['id']?>" class="delete"><i class="fas fa-trash-alt" style="color: red;"></i></a></td> -->
        </tr>
        <?php $number ++; 
     }  ?>

                                        <tbody>
                                    </table>
                            </div>
                   
                     
                </main>


        </div>

   <!-- js library -->
    <script src="../js/fontA.js"></script>
    <script src="../js/custom.js"></script>
</body>
</html>