<?php 

include_once "db.php";
include_once "function.php";


$sql = "SELECT * FROM info WHERE location IN ('dhaka','khulna')";
$data = connect()->query($sql);

while ($row= $data->fetch_assoc())
{
   echo $row['id'];
   echo $row['name'];
   echo $row['location']."<br>";
}


?>