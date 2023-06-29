<?php

include_once '../db.php';


$id = $_GET['id'];

$sql = "SELECT * FROM `orders` WHERE id = ? ";
$result = $connect->prepare($sql);
$result->bindValue(1,$_GET['id']);
$result->execute();
$row = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);



$final_price = $_GET['final_price'];
$final = $data->final_price + $final_price;

$sql = "UPDATE `orders` SET `final_price` = ? WHERE `orders`.`id` = ?;";
$result = $connect->prepare($sql);
$result->bindValue(1, $final);
$result->bindValue(2, $id);
if($result->execute()){
    header("location:../payment.php?ok=20&id=".$_GET["id"]);
}
else{
    header("location:../payment.php?error=10&id=".$_GET["id"]);
}
