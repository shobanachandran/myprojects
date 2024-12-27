<?php
error_reporting(0);
include("../includes/config.php");
extract($_REQUEST);

if($action=='buyeradd'){

	$check_insert = mysqli_query($zconn,"select * from buyer_master where BINARY buyer_name='".$buyer_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		$insert_dept = mysqli_query($zconn,"insert into buyer_master(buyer_name,buyer_short_name,buyer_desc,status,created_by,created_date) values('".$buyer_name."','".$short_name."','".$buyer_desc."','".$status."','".$_SESSION['userid']."',now())");
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
	$check_insert = mysqli_query($zconn,"select * from buyer_master where buyer_id='".$colid."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert){
		$update_dept = mysqli_query($zconn,"update buyer_master 
		set buyer_name='".$buyer_name."', 
		buyer_short_name='".$short_name."',
		buyer_desc = '".$buyer_desc."',
		status='".$status."' where buyer_id='".$colid."'");

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
	$buyer_delete = mysqli_query($zconn,"delete from buyer_master where buyer_id='".$typeid."'");
	if($buyer_delete){
		echo "1";
	} else {
		echo "0";
	}
}