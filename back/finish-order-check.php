<?php

include_once '../db.php';
$final_price = $_GET['final_price'];
$date = $jalali;
$id = $_GET['id'];

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



$remaining = $data->remaining;
$final = $final_price;


if($remaining < $final ){
        header("location:../finish-order.php?larg=20&id=".$_GET["id"]);
        exit();
}


$sql = "UPDATE `orders` SET `state` = '0', `final_price` = ? WHERE `orders`.`id` = ?;";
$result = $connect->prepare($sql);
$result->bindValue(1, $final);
$result->bindValue(2, $id);
if($result->execute()){
    header("location:../show-orders.php?ok=20&id=".$_GET["id"]);
}
else{
    header("location:../show-orders.php?error=10&id=".$_GET["id"]);
}
