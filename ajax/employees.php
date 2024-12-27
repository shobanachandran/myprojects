<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);


// if($action=='userlogin'){
// 	if($rememberme=='on'){
// 		setcookie("loggedIn", "yes", time()+31536000);
//         setcookie("emp_name", $emp_name, time()+31536000);
//         setcookie("usrpwd", $usrpwd, time()+31536000);
// 	}
// 	$sectExistQuery = "SELECT * FROM employees WHERE emp_name='".$emp_name."' and usrpwd='".$usrpwd."' and deleted='N' and status='Active'";

// 	$sectResource = mysqli_query($zconn,$sectExistQuery);
// 	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);

// 	if(!empty($sectData)){
// 	    $update_login = mysqli_query($zconn,"update employees set last_login='".$date_time."' where USERID='".$sectData[0]."'");

// 		$_SESSION['userid']  = $sectData['USERID'];
// 		$_SESSION['uname']   = $sectData['UNAME'];
// 		$_SESSION['emp_name'] = $sectData['emp_name'];
// 		$_SESSION['email']   = $sectData['EMAIL'];
// 		$_SESSION['mobno']   = $sectData['MOBNO'];
// 		$_SESSION['usrtype'] = $sectData['TYPEID'];
// 		$_SESSION['usrteam'] = $sectData['team_id'];
// 		echo 1;
// 	}else{
// 		echo 'error';
// 	}
// }
if($action=='empadd'){
	$sectExistQuery = "SELECT emp_name FROM employees WHERE lower(emp_name)='".strtolower($emp_name)."'";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);
	if(!$sectData){
		$maxcntQuery = "SELECT COALESCE(MAX(emp_id),0)+1 as INC FROM employees";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_array($maxcntResource,MYSQLI_ASSOC);

      
		$insertstatus = mysqli_query($zconn,"INSERT INTO employees ( emp_name, emp_code, TYPEID,dept_id,emp_position,
        emp_mobile,
        emp_address,emp_bloodgroup, emp_econtact,emp_relation,emp_shiftamt,status,ADDDATE, ADDUSER, DELETED) VALUES (
        '".$emp_name."','".$emp_code."', '".$typeid."', '".$dept_id."', '".$emp_position."',
        '".$emp_mobile."','".$emp_address."','".$emp_bloodgroup."','".$emp_econtact."','".$emp_relation."','".$emp_shiftamt."',
        '".$status."', 
		'".$date_time."', '".$_SESSION['userid']."', 'N')");

		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='empedit'){
	$sectExistQuery = "SELECT emp_name FROM employees WHERE lower(emp_name)='".strtolower($emp_name)."' and userid!='".$userid."' and deleted='N'";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);

	if(!$sectData){
		$updatestatus = mysqli_query($zconn,"UPDATE employees SET emp_name = '".$emp_name."',
        emp_code = '".$emp_code."',
        TYPEID = '".$typeid."',dept_id = '".$dept_id."',
        emp_position = '".$emp_position."', emp_mobile = '".$emp_mobile."',
        emp_address = '".$emp_address."', emp_bloodgroup = '".$emp_bloodgroup."',
        emp_econtact = '".$emp_econtact."', emp_relation = '".$emp_relation."',
        emp_shiftamt = '".$emp_shiftamt."',
        status = '".$status."',
 
        EDTUSER = '".$_SESSION['userid']."',EDTDATE = '".$date_time."' WHERE emp_id = '".$userid."'");
		
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='empdelete'){
	$updatestatus = mysqli_query($zconn,"UPDATE employees SET DELETED = 'Y',DELUSER = '".$_SESSION['userid']."',DELDATE = '".$date_time."' WHERE emp_id = '".$userid."'");
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


