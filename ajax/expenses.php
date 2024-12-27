<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);

if($action=='useradd'){
	$sectExistQuery = "SELECT ex_name FROM expenses WHERE ex_name='".$ex_name."' ";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);
	if(!$sectData){
		$maxcntQuery = "SELECT COALESCE(MAX(ex_id),0)+1 as INC FROM expenses";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_array($maxcntResource,MYSQLI_ASSOC);
		$insertstatus = mysqli_query($zconn,"INSERT INTO expenses (ex_name,ex_type,type_id,status,DELETED)VALUES
		('".$ex_name."','".$ex_type."','".$type_id."','".$status."', 'N')");
// print '<pre>';
// print $insertstatus;
// print '<pre>';
		if($insertstatus==true){
			echo 1;
		}else{
			echo $insertstatus;
		}
	}else{
		echo "exist";
	}
}
if($action=='useredit'){
	$sectExistQuery1 = "SELECT ex_name FROM expenses WHERE ex_name='".$ex_name."' and deleted='N'";
	$sectResource1 = mysqli_query($zconn,$sectExistQuery1);
	$sectData1 = mysqli_fetch_array($sectResource1,MYSQLI_ASSOC);
	
	if(!$sectData1){
		
		$updatestatus1 = mysqli_query($zconn,"UPDATE expenses SET ex_name = '".$ex_name."', 
		type_id = '".$type_id."' , status = '".$status."' WHERE ex_id = '".$userid."'");
		
		if($updatestatus1==true){
			echo 1; 
		}else{
			echo $updatestatus1;      
		}
	}else{
		echo "exist";
	}
}
if($action=='userdelete'){
	$updatestatus = mysqli_query($zconn,"UPDATE expenses SET DELETED = 'Y' WHERE ex_id = '".$userid."'");
	if($updatestatus==true){
			echo 1;
	}else{
		echo 'error';
	}
}

if($action=='saveUserDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from user_department where dept_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into user_department(dept_name,dept_desc,status,created_by,created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update user_department set 
							dept_name='".$dt_name."', 
							dept_desc='".$dept_descr."', 
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
	$dept_list =user_dept();
	echo $msg."~~~".$dept_list;
}

if($action=='deptDelete'){
	$del_dept = mysqli_query($zconn,"delete from user_department where dept_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
	
}


