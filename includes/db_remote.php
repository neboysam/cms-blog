<?php

$db['db_host'] = "109.106.246.201";
$db['db_user'] = "u663147282_cms_user";
$db['db_password'] = "Be02!Lo10.Ga35#";
$db['db_name'] = "u663147282_cms";

foreach($db as $key => $value) {
    
    define(strtoupper($key), $value);
    
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$conn) {
    
    echo "Not connected to the database.";
    
}

?>