<?php
include_once "../db.php";

$customer_name = $_GET['customer_name'];
$customer_phone = $_GET['customer_phone'];
$customer_pass = $_GET['customer_pass'];
$customer_desc = $_GET['customer_desc'];
/////////////////////////////////////////////
$customer_height = $_GET['customer_height'];
$customer_sholder = $_GET['customer_sholder'];
$customer_sleeve = $_GET['customer_sleeve'];
$customer_ice = $_GET['customer_ice'];
$customer_hug = $_GET['customer_hug'];
$customer_skirt = $_GET['customer_skirt'];
$customer_chatty = $_GET['customer_chatty'];
$customer_pants = $_GET['customer_pants'];
$customer_cloth = $_GET['customer_cloth'];
$customer_bar_pants = $_GET['customer_bar_pants'];
$customer_model = $_GET['customer_model'];
$customer_size_desc = $_GET['customer_size_desc'];
/////////////////////////////////////////////
$vaskat_height = $_GET['vaskat_height'];
$vaskat_sholder = $_GET['vaskat_sholder'];
$vaskat_chatty = $_GET['vaskat_chatty'];
$vaskat_desc = $_GET['vaskat_desc'];
$date = $jalali;

if($customer_pass == ""){
    $customer_pass = $customer_phone;
}

$sql="UPDATE `users` SET `username` =?, `phone` = ?, `customer_pass` = ?, `customer_desc` = ?, `customer_height` = ?, `customer_sholder` = ?, `customer_sleeve` = ?, `customer_ice` = ?, `customer_hug` = ?, `customer_skirt` = ?, `customer_chatty` = ?, `customer_pants` = ?, `customer_cloth` = ?, `customer_bar_pants` = ?, `customer_model` = ?, `customer_size_desc` = ?, `vaskat_height` = ?, `vaskat_sholder` = ?, `vaskat_chatty` = ?, `vaskat_desc` = ?, `date` = ? WHERE `users` . `id` = ?;";

$result = $connect->prepare($sql);
$result->bindValue(1,$customer_name);
$result->bindValue(2,$customer_phone);
$result->bindValue(3,$customer_pass);
$result->bindValue(4,$customer_desc);
$result->bindValue(5,$customer_height);
$result->bindValue(6,$customer_sholder);
$result->bindValue(7,$customer_sleeve);
$result->bindValue(8,$customer_ice);
$result->bindValue(9,$customer_hug);
$result->bindValue(10,$customer_skirt);
$result->bindValue(11,$customer_chatty);
$result->bindValue(12,$customer_pants);
$result->bindValue(13,$customer_cloth);
$result->bindValue(14,$customer_bar_pants);
$result->bindValue(15,$customer_model);
$result->bindValue(16,$customer_size_desc);
$result->bindValue(17,$vaskat_height);
$result->bindValue(18,$vaskat_sholder);
$result->bindValue(19,$vaskat_chatty);
$result->bindValue(20,$vaskat_desc);
$result->bindValue(21,$date);
$result->bindValue(22,$_GET['id']);

if($result->execute()){
    header("location:../update-customer.php?ok=20&id=".$_GET["id"]);
}
else{
    header("location:../update-customer.php?error=10&id=".$_GET["id"]);
}

