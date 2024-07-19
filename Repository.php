<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



$db_name = 'bd_slscars';
$db_host = 'localhost:3306';
$db_user = 'root';
$db_password = '';



$conec = new PDO("mysql:dbname=".$db_name.";host=".$db_host,$db_user,$db_password);


?>