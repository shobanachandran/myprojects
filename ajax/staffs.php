<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);


// if($action=='userlogin'){
// 	if($rememberme=='on'){
// 		setcookie("loggedIn", "yes", time()+31536000);
//         setcookie("staff_name", $staff_name, time()+31536000);
//         setcookie("usrpwd", $usrpwd, time()+31536000);
// 	}
// 	$sectExistQuery = "SELECT * FROM staffs WHERE staff_name='".$staff_name."' and usrpwd='".$usrpwd."' and deleted='N' and status='Active'";

// 	$sectResource = mysqli_query($zconn,$sectExistQuery);
// 	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);

// 	if(!staffty($sectData)){
// 	    $update_login = mysqli_query($zconn,"update staffs set last_login='".$date_time."' where USERID='".$sectData[0]."'");

// 		$_SESSION['userid']  = $sectData['USERID'];
// 		$_SESSION['uname']   = $sectData['UNAME'];
// 		$_SESSION['staff_name'] = $sectData['staff_name'];
// 		$_SESSION['email']   = $sectData['EMAIL'];
// 		$_SESSION['mobno']   = $sectData['MOBNO'];
// 		$_SESSION['usrtype'] = $sectData['TYPEID'];
// 		$_SESSION['usrteam'] = $sectData['team_id'];
// 		echo 1;
// 	}else{
// 		echo 'error';
// 	}
// }
if($action=='staffadd'){
	$sectExistQuery = "SELECT staff_name FROM staffs WHERE lower(staff_name)='".strtolower($staff_name)."'";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);
	if(!$sectData){
		$maxcntQuery = "SELECT COALESCE(MAX(staff_id),0)+1 as INC FROM staffs";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_array($maxcntResource,MYSQLI_ASSOC);

      
		$insertstatus = mysqli_query($zconn,"INSERT INTO staffs ( staff_name, staff_code, TYPEID,dept_id,staff_position,staff_education,
        staff_mobile,staff_email,
        staff_address,staff_bloodgroup, staff_econtact,staff_relation,staff_salary,staff_allow,status,ADDDATE, ADDUSER, DELETED) VALUES (
        '".$staff_name."','".$staff_code."', '".$typeid."', '".$dept_id."', '".$staff_position."','".$staff_education."',
        '".$staff_mobile."','".$staff_email."','".$staff_address."','".$staff_bloodgroup."','".$staff_econtact."','".$staff_relation."','".$staff_salary."','".$staff_allow."',
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
if($action=='staffedit'){
	$sectExistQuery = "SELECT staff_name FROM staffs WHERE lower(staff_name)='".strtolower($staff_name)."' and userid!='".$userid."' and deleted='N'";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);

	if(!$sectData){
		$updatestatus = mysqli_query($zconn,"UPDATE staffs SET staff_name = '".$staff_name."',
        staff_code = '".$staff_code."',
        TYPEID = '".$typeid."',dept_id = '".$dept_id."',
        staff_position = '".$staff_position."',staff_education = '".$staff_education."', staff_mobile = '".$staff_mobile."',
        staff_email = '".$staff_email."',staff_address = '".$staff_address."', staff_bloodgroup = '".$staff_bloodgroup."',
        staff_econtact = '".$staff_econtact."', staff_relation = '".$staff_relation."',
        staff_salary = '".$staff_salary."', staff_allow = '".$staff_allow."',
        status = '".$status."',
        
        EDTUSER = '".$_SESSION['userid']."',EDTDATE = '".$date_time."' WHERE staff_id = '".$userid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='staffdelete'){
	$updatestatus = mysqli_query($zconn,"UPDATE staffs SET DELETED = 'Y',DELUSER = '".$_SESSION['userid']."',DELDATE = '".$date_time."' WHERE staff_id = '".$userid."'");
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


