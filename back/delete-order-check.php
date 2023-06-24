<?php
require_once '../db.php'; 



$sql = "SELECT * FROM `orders` WHERE id = ? ";
$result = $connect->prepare($sql);
$result->bindValue(1,$_GET['id']);
$result->execute();
$row = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);

// select users state
$sql3 = "SELECT * FROM `users` WHERE phone = ? ";
$result3 = $connect->prepare($sql3);
$result3->bindValue(1,$data->user_phone);
$result3->execute();
$row3 = $result3->rowCount();
$data3 = $result3->fetch(PDO::FETCH_OBJ);

$sql2 = "UPDATE `users` SET `state` = '0' WHERE `users`.`id` = $data3->id;";
$result2 = $connect->prepare($sql2);
$result2->execute();




$sql = "DELETE FROM `orders` WHERE `orders`.`id` = ?;";
$result = $connect->prepare($sql);
$result->bindValue(1, $_GET["id"]);



if($result->execute()) {
    header("location:../show-orders.php?ok=10");
}
