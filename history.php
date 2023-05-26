<?php include_once 'sidebar.php'; ?>
                    <div class="overview">
                        <div class="all-review">سابقه ورود و خروج وسیله ها</div>
                     </div>   
                     <br>

                                <div class="table-wrapper">
                                    <table class="fl-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نوع وسیله</th>
                                            <th>نام </th>
                                            <th>مدل</th>
                                            <th>رنگ</th>
                                            <th>شماره پلت</th>
                                            <th>شماره پارکینگ</th>
                                            <th>تاریخ و ساعت خروج</th>
                                        </tr>
                                        </thead>
                                        <tbody>
  <?php 
        include_once "back/db.php"; 
        $sql = "SELECT * FROM `means`  WHERE `state` = 0";
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
                                            <td><?=$row['date_out']?></td>
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