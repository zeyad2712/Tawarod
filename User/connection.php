<?php

$localhost = "localhost";
$username = "root";
$password = "";
$database ="case02";

$connect = mysqli_connect($localhost, $username ,$password , $database);
if($connect){
    // echo"connected" ;
}

session_start();
ob_start();
if(isset($_POST['logout']))
{
    session_unset();
    session_destroy();
    header("location:login.php");
}
    // error_reporting(0);

?>
