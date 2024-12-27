<?php
error_reporting(0);
include("../includes/config.php");
include("../includes/functions.php");
extract($_REQUEST);

//For Yarn Types
if($action=='save_accessories'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from accessories_master where acc_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into accessories_master(acc_name,acc_desc,status,created_by,created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update accessories_master set 
							acc_name='".$dt_name."', 
							acc_desc='".$dept_descr."', 
							status='".$status."' where id='".$dept_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =accessories_list();
	echo $msg."~~~".$dept_list;
}



if($action=='Deleteaccs'){
	$del_dept = mysqli_query($zconn,"delete from accessories_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


if($action=='accgroupdelete'){
	$del_dept = mysqli_query($zconn,"delete from accessories_group where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}



