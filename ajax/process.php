<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");
extract($_REQUEST);


if($action=="list_subprocess"){
	$sublist .='<select class="select2 form-control custom-select" name="sub_process"><option value="">--Select--</option>';

	$sel_sub=mysqli_query($zconn,"select * from sub_process where process_name='".$pr_name."'");
	while($res_sub = mysqli_fetch_array($sel_sub,MYSQLI_ASSOC)){
		$sub_id = $res_sub['id'];
		$sub_name = $res_sub['sub_process_name'];
		$sublist .="<option value='".$sub_id."'>".$sub_name."</option>";
	}
$sublist .="</select>";
	echo $sublist;
}

if($action=='saveUserDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from process_master where process_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
		
			$insert_dept = mysqli_query($zconn,"insert into process_master(process_name,descr,status,created_by,created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update process_master set 
							process_name='".$dt_name."', 
							descr='".$dept_descr."', 
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
	$dept_list =process_list();
	echo $msg."~~~".$dept_list;
}

if($action=='deptDelete'){
	$del_dept = mysqli_query($zconn,"delete from process_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='saveta'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from process_master where process_name='".$dt_name."'");
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



// For sub process_list


if($action=='subDelete'){
	$del_dept = mysqli_query($zconn,"delete from sub_process where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


if($action=='savesubProcess'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from sub_process where process_name='".$process_name."' and sub_process_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into sub_process(process_name,sub_process_name,descr,status,created_by,created_date) values('".$process_name."','".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update sub_process set 
							process_name='".$process_name."',
							sub_process_name='".$dt_name."',
							descr='".$dept_descr."', 
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
	$dept_list =sub_process_list();
	echo $msg."~~~".$dept_list;
}

