<?php
//ignore php errors
//error_reporting(E_ERROR | E_PARSE);
//**** Production db ****//
$servername = "remotemysql.com";
$username = "9lz5upatlm";
$password = "oHjx2G70Tu";
$dbname = "9lz5upatlm";

//**** Developpment db ****//
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_manucop_db";



$con = mysqli_connect($servername, $username, $password);
$db_selected = mysqli_select_db($con, $dbname);

if (!$db_selected) {
    $createDb = "CREATE DATABASE $dbname";
    mysqli_query($con, $createDb);
    include 'create_empty_db.php';
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo 'Failed to connect to database' . mysqli_connect_error();
}

// current date
$date = date('Y-m-d H:i:s', time());
//$date = date("Y-m-d");
//$date = date('Y-m-d H:i:s', '1299762201428');

//arabic lang chars
mysqli_set_charset($conn, 'utf8');

$ProjTitle = "برنامج نساخ المخطوطات";