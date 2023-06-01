
<?php 
        require 'db.php';
        $val = $_GET['search'];
        $sql = "SELECT * FROM `means` WHERE `number_p` LIKE '%{$val}%'";
        $result = $connect->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $count = $result->rowCount();
        if($count!=""){
                    foreach($rows as $row){ 
                echo '<a href="insert-car.php?id='.$row['id'].'" class="myLink">'.$row['number_p'].'</a>';   
            }

        }else{
        //    echo '<a href="#" class="myLink">موردی یافت نشد &#128148;&#128555;</a>';
        }

