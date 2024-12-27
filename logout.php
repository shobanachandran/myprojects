<?php
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

session_start();
session_unset(); 
session_destroy();
?>

<script>window.location="login.php";</script>