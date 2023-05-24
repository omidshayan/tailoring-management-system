<?php
require_once("lib/jdf.php");
date_default_timezone_set("asia/kabul");
global $jalali;
$jalali= gregorian_to_jalali(date('Y'),date('m'),date('d') , '/');
        $username = 'root';
        $pass = '';
        $dbname = "tailoring";
        try{
        $connect = new PDO("mysql:host=localhost;dbname=$dbname",$username,$pass);
        $connect->exec("set names utf8");
        }
        catch(PDOException $e){

                echo "connection failed: " . $e->getMessage();
        }
