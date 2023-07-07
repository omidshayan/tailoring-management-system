<?php include_once 'sidebar.php'; ?>
<div class="overview">
                        <div class="all-review"> نتایج جستجو</div>
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
                if(isset($_GET['repeat'])){
                        echo ' <span class="mytxt">برای این مشتری قبلا سفارش ثبت شده است :(</span>';
                }

                ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام </th>
                        <th>شماره موبایل </th>
                        <th>تاریخ ثبت</th>
                        <th> جزئیات</th>
                        <th> سفارش جدید</th>
                        <th> ویرایش</th>
                        <!-- <th> حذف</th> -->
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


</script>

<?php 

include_once "db.php"; 
$sql = "SELECT * FROM `users` WHERE `phone` LIKE ?";
$result = $connect->prepare($sql);
$result->bindValue(1,'%'.$_GET["data-search"].'%');
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$number = 1;
foreach($rows as $row){ ?>
                <tr>
                    <td><?=$number?></td>
                    <td><?=$row['username']?></td>
                    <td><?=$row['phone']?></td>
                    <td><?=$row['date']?></td>
                    <td><a href="show-user-info.php?id=<?=$row['id']?>" class="myLinka">نمایش</a></td>
                    <td><a href="new-order.php?id=<?=$row['id']?>"><i class="fas fa-plus-square"></i></a></td>
                    <td><a href="update-customer.php?id=<?=$row['id']?>"><i class="fas fa-edit"></i></a></td>
                    <!-- <td><a href="back/delete-product-check.php?id=<?=$row['id']?>"  class="delete"><i class="fas fa-trash-alt" style="color: red;"></i></i></a></td> -->
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