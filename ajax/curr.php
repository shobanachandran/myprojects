<?php
error_reporting(0);
include("../includes/config.php");
extract($_REQUEST);

if($action=='buyeradd'){

	$check_insert = mysqli_query($zconn,"select * from currency where BINARY curr_name='".$curr_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		$insert_dept = mysqli_query($zconn,"insert into currency(curr_name,curr_val,status,created_by,created_date) values('".$curr_name."','".$curr_val."','".$status."','".$_SESSION['userid']."',now())");
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
	$check_insert = mysqli_query($zconn,"select * from currency where curr_id='".$colid."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert){
		$update_dept = mysqli_query($zconn,"update currency 
		set curr_name='".$curr_name."', 
		curr_val='".$curr_val."',
		status='".$status."' where curr_id='".$colid."'");

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
	$buyer_delete = mysqli_query($zconn,"delete from currency where curr_id='".$typeid."'");
	if($buyer_delete){
		echo "1";
	} else {
		echo "0";
	}
}