<?php
error_reporting(0);
include("../includes/config.php");
extract($_REQUEST);

if($action=='buyeradd'){

	$check_insert = mysqli_query($zconn,"select * from advance where BINARY st_name='".$st_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		$insert_dept = mysqli_query($zconn,"insert into advance(sta_id,st_name,ad_amnt,doa,created_by,created_date) values('".$sta_id."','".$st_name."','".$ad_amnt."','".$doa."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
	}  else {
		$msg="2";
	}
	echo $msg;
}

if($action=='buyeredit'){
	$check_insert = mysqli_query($zconn,"select * from advance where st_id='".$colid."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert){
		
		$update_dept = mysqli_query($zconn,"update advance 
		set sta_id='".$sta_id."', 
		st_name='".$st_name."',
		ad_amnt='".$ad_amnt."',
		doa='".$doa."' where st_id='".$colid."'");

		if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
	}else {
		$msg="2";
	}
	
	echo $msg;
}


if($action=='buyerdelete'){
	$buyer_delete = mysqli_query($zconn,"delete from advance where st_id='".$typeid."'");
	if($buyer_delete){
		echo "1";
	} else {
		echo "0";
	}
}
if($action=='orderdelete'){
	$buyer_delete = mysqli_query($zconn,"delete from order_entry_master where order_id='".$typeid."'");
	if($buyer_delete){
		echo "1";
	} else {
		echo "0";
	}
}