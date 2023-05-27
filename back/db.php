<?php

date_default_timezone_set("asia/kabul");
        $username = 'root';
        $pass = '';
        $dbname = "parking";
        try{
        $connect = new PDO("mysql:host=localhost;dbname=$dbname",$username,$pass);
        $connect->exec("set names utf8");
        }
        catch(PDOException $e){
                echo "connection failed: " . $e->getMessage();
        }