<?php

include_once 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM `oders` WHERE `id` = ? ;";
$result = $connect->prepare($sql);
$result->bindValue(1, $id);
$result->execute();
$row = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);
header('location:  ');
?>

