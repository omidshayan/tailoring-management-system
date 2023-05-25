<?php include_once 'sidebar.php'; ?>
<div class="overview">
                        <div class="all-review">تاریخچه وسیله:       <?php 
        include_once "db.php"; 
        $mean = $_GET['id'];
        $sql = "SELECT * FROM `means`  WHERE `id` = ?";
        $result = $connect->prepare($sql);
        $result->bindValue(1,$mean);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){  ?>
             
       <td><?=$row['name']?></td>

    

    <?php  }  ?></div>
                     </div>   
                     <br>

                                <div class="table-wrapper">
                                    <table class="fl-table">

                                    <thead>
                                        <tr>
                                            <th>نوع وسیله</th>
                                            <th>نام </th>
                                            <th>مدل</th>
                                            <th>رنگ</th>
                                            <th>شماره پلت</th>
                                            <th>شماره پارکینگ</th>
                                            <th>تاریخ و ساعت ورود </th>
                                        </tr>
                                        </thead>
                                        <tbody>



        <?php 
        include_once "db.php"; 
        $mean = $_GET['id'];
        $sql = "SELECT * FROM `means`  WHERE `id` = ?";
        $result = $connect->prepare($sql);
        $result->bindValue(1,$mean);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){ 

         $sql2 = "SELECT * FROM `means` WHERE `number_p` = ?";
        $result2 = $connect->prepare($sql2);
        $result2->bindValue(1,$row['number_p']);
        $result2->execute();
        $rows2 = $result2->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows2 as $row2){ ?>
                                        <tr>
                                            <td><?=$row2['type_means']?></td>
                                            <td><?=$row2['name']?></td>
                                            <td><?=$row2['model']?></td>
                                            <td><?=$row2['color']?></td>
                                            <td> <?=$row2['number_p']?></td>
                                            <td><?=$row2['parking_number']?></td>
                                            <td><?=$row2['date_in']?></td>
                                        </tr>

     <?php      }

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