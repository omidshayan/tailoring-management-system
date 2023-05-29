<?php
include_once '../db.php';
$mean = $_GET['id'];

$date = date("Y/m/d h.i:s");

    $sql="UPDATE `means` SET `state` ='0', `date_out`= '$date' WHERE `id` = ?;";
    $result = $connect->prepare($sql);
    $result->bindValue(1,$mean);
    if($result->execute()){
        header("location: ../cars-list.php?ok=20");
    }
    else{
        header("location: ../cars-list.php?error=10");
    }
