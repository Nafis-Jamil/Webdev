<?php
$servername= "localhost";
$username= "root";
$password= "";
$dbname="pipernet_db";

try {
    $conn= mysqli_connect($servername,$username,$password,$dbname);
} catch (mysqli_sql_exception $e) {
    die($e->getMessage());
}
?>