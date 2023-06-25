<?php
include_once "../db.php";

$customer_name = $_GET['customer_name'];
$customer_phone = $_GET['customer_phone'];
$customer_model = $_GET['customer_model'];
$all_price = $_GET['all_price'];
$discount = $_GET['discount'];
$prepayment = $_GET['prepayment'];
$remaining = $_GET['remaining'];
$order_desc = $_GET['order_desc'];
$date = $jalali;
$id = $_GET['id'];

// $sql2 = "UPDATE `users` SET `state` = '1' WHERE `users`.`id` = $id;";
// $result2 = $connect->prepare($sql2);
// $result2->execute();


$sql = "UPDATE `orders` SET `vaskat_desc` = ?, `date` = ? WHERE `users` . `id` = ?;";

$result = $connect->prepare($sql);
$result->bindValue(1,$customer_name);
$result->bindValue(2,$customer_phone);
$result->bindValue(3,$customer_model);
$result->bindValue(4,$all_price);
$result->bindValue(5,$discount);
$result->bindValue(6,$prepayment);
$result->bindValue(7,$remaining);
$result->bindValue(8,$order_desc);
$result->bindValue(9,$date);

if($result->execute()){
    header("location:../show-customer.php?ok=20&id=".$id);
}
else{
    header("location:../show-customer.php?error=10&id=".$id);
}

