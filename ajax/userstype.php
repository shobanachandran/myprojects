<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include("../includes/config.php");
extract($_REQUEST);
if($action=='usertypeadd'){
	$typeExistQuery = "SELECT TYPNAME FROM users_type WHERE lower(TYPNAME)='".strtolower($typname)."' and deleted='N'";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(!$typeData){
		$maxcntQuery = "SELECT COALESCE(MAX(TYPEID),0)+1 as INC FROM users_type";
        $date_time = date("Y-m-d H:i:s");
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_row($maxcntResource);
		$insertstatus = mysqli_query($zconn,"INSERT INTO users_type (TYPEID, TYPNAME, DESCRTION, STATUS,ADDDATE, ADDUSER, DELETED) VALUES ('".$maxData[0]."', '".$typname."', '".$descrtion."','".$status."','".$date_time."', '".$_SESSION['userid']."', 'N')");
        echo $insertstatus;
		if($insertstatus==true){
			echo 'true';
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='usertypeedit'){
	$typeExistQuery = "SELECT TYPNAME FROM users_type WHERE lower(TYPNAME)='".strtolower($typename)."' and TYPEID!='".$typeid."' and deleted='N'";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(!$typeData){
		$updatestatus = mysqli_query($zconn,"UPDATE users_type SET TYPNAME = '".$typname."',DESCRTION = '".$descrtion."',STATUS = '".$status."',EDTUSER = '".$_SESSION['userid']."',EDTDATE = '".$date_time."' WHERE TYPEID = '".$typeid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='usertypedelete'){
	//Check If usertype in the User table
	$typeExistQuery = "SELECT TYPEID FROM users WHERE TYPEID='".$typeid."'";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(empty($typeData)){
		$updatestatus = mysqli_query($zconn,"UPDATE users_type SET DELETED = 'Y',DELUSER = '".$_SESSION['userid']."',DELDATE = '".$date_time."' WHERE TYPEID = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo 'exist';
	}
}
if($action=='usertypeinactive'){
	//Check If usertype in the User table
	$typeExistQuery = "SELECT TYPEID FROM users WHERE TYPEID='".$typeid."'";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(empty($typeData)){
	}else{
		echo 'exist';
	}
}