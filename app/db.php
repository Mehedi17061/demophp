<?php 


$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'demo';


function connect() {

    global $host, $user, $pass ,$database;

    $conn = new mysqli($host,$user,$pass,$database);
    return $conn; 
}


?>