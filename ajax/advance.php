<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);


/// For Suppliers

if($action=='jobworkadd'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from advance where BINARY st_id='".$st_id."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		
			echo "insert into advance(sta_id,st_name,ad_amnt,doa) values('".$sta_id."','".$st_name."','".$ad_amnt."','".$doa."',now())";
			$insert_dept = mysqli_query($zconn,"insert into advance(sta_id,st_name,ad_amnt,doa) values('".$sta_id."','".$st_name."','".$ad_amnt."','".$doa."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
	} else {
		$msg="2";
	}
	echo $msg;
}

if($action=='jobworkedit'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from advance where BINARY st_id='".$st_id."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
			$update_dept = mysqli_query($zconn,"update advance set
							sta_id='".$sta_id."', 
							st_name='".$st_name."',
							ad_amnt='".$ad_amnt."',
							doa='".$doa."',
							where st_id='".$colid."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
	} else {
		$msg="2";
	}
	echo $msg;
}

if($action=='jobworkdelete'){
	$del_dept = mysqli_query($zconn,"delete from advance where st_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

