<?php


require_once '../db.php'; 
$sql = "DELETE FROM `users` WHERE `users`.`id` = ?;";
$result = $connect->prepare($sql);
$result->bindValue(1, $_GET["id"]);
if($result->execute()) {
    header("location:../show-customer.php?ok=10");
}
