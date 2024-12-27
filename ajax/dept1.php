<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");
extract($_REQUEST);

if($action=='saveUserDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from department_master where dept_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into department_master(dept_name,status,created_by,created_date) values('".$dt_name."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update department_master set 
							dept_name='".$dt_name."', 
							status='".$status."' where dept_id='".$dept_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =process_list1();
	echo $msg."~~~".$dept_list;
}

if($action=='deptDelete'){
	$del_dept = mysqli_query($zconn,"delete from department_master where dept_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='saveta'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from process_master where dept_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into ta_manage(ta_name,ta_desc,status,created_by,created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update ta_manage set 
							ta_name='".$dt_name."', 
							ta_desc='".$dept_descr."', 
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
	$dept_list = ta_manage_list();
	echo $msg."~~~".$dept_list;
}

if($action=='taDelete'){
	$del_dept = mysqli_query($zconn,"delete from ta_manage where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

