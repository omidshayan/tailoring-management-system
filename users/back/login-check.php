<?php
session_start();
include_once "../../db.php"; 

$username = $_POST['username'];
$pass = $_POST["password"];

$sql = "SELECT * FROM `users` WHERE `phone` = ? AND `customer_pass` = ?";
$result = $connect->prepare($sql);
$result->bindValue(1,$username);
$result->bindValue(2,$pass);
$result->execute();
$row = $result->rowCount();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
    if($row == 1){
        foreach($rows as $data){
            $_SESSION['phone']  = $data['phone'];
            }
        $_SESSION['user-panel'] = $_POST['username'];
        header('location:../panel.php');
        exit();
    }

    else
    {
        echo header('location:../index.php?error=10');
    }
