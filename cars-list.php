<?php include_once 'sidebar.php'; ?>
<div class="overview">
                        <div class="all-review"> لیست وسیله ها</div>
                     </div>   
                     <br>

                                <div class="table-wrapper">
                                    <table class="fl-table">
                                    <?php 
                                    if(isset($_GET['ok'])){
                                            echo ' <span class="mytxt">وسیله مورد نظر با موفقیت خروج شد! </span>';
                                    }
                                    if(isset($_GET['error'])){
                                            echo ' <span class="mytxt">مشکل در خروج وسیله </span>';
                                    }

                                    ?>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نوع وسیله</th>
                                            <th>نام </th>
                                            <th>مدل</th>
                                            <th>رنگ</th>
                                            <th>شماره پلت</th>
                                            <th>شماره پارکینگ</th>
                                            <th>تاریخ و ساعت ورود </th>
                                            <th>چاپ رسید</th>
                                            <th>خروج از پارکینگ</th>
                                            <th>سابقه وسیله</th>
                                        </tr>
                                        </thead>
                                        <tbody>

<script>
    $(document).ready(function () {
        $(".disabled").click(function () {
            var msg=confirm("جهت خروج وسیله مطمئن هستید؟");
            if(msg==true)
            {

            }
            else
            {
                return false;
            }
        });
    });

    //     $(document).ready(function () {
    //     $("#print").click(function () {
    //         window.print();
    //     });

    // });
</script>

        <?php 
        include_once "db.php"; 
        $sql = "SELECT * FROM `means`  WHERE `state` = 1";
        $result = $connect->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $number = 1;
        foreach($rows as $row){ ?>
                                        <tr>
                                            <td><?=$number?></td>
                                            <td><?=$row['type_means']?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['model']?></td>
                                            <td><?=$row['color']?></td>
                                            <td> <?=$row['number_p']?></td>
                                            <td><?=$row['parking_number']?></td>
                                            <td><?=$row['date_in']?></td>
                                            <td><a href="back/print.php?id=<?=$row['parking_number']?>" target="blank"><i class="fas fa-print"></i></a></td>
                                            <td><a href="back/exit-means.php?id=<?=$row['id']?>" class="disabled"><i class="fas fa-sign-out-alt"></i></a></td>
                                            <td><a href="history-mean.php?id=<?=$row['id']?>"><i class="fas fa-history"></i></a></td>
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