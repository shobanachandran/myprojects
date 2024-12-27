<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);


if($action=='userlogin'){
	//if($rememberme=='on'){
		//setcookie("loggedIn", "yes", time()+31536000);
        //setcookie("usrname", $usrname, time()+31536000);
       // setcookie("usrpwd", $usrpwd, time()+31536000);
	//}
	$sectExistQuery = "SELECT * FROM users WHERE usrname='".$usrname."' and usrpwd='".$usrpwd."' and deleted='N' and status='Active'";

	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);

	if(!empty($sectData)){
	    $update_login = mysqli_query($zconn,"update users set last_login='".$date_time."' where USERID='".$sectData[0]."'");

		$_SESSION['userid']  = $sectData['USERID'];
		$_SESSION['uname']   = $sectData['UNAME'];
		$_SESSION['usrname'] = $sectData['USRNAME'];
		$_SESSION['email']   = $sectData['EMAIL'];
		$_SESSION['mobno']   = $sectData['MOBNO'];
		$_SESSION['usrtype'] = $sectData['TYPEID'];
		$_SESSION['usrteam'] = $sectData['team_id'];
		echo  1;
	}else{
		echo 'error';
	}
}
if($action=='useradd'){
	$sectExistQuery = "SELECT usrname FROM users WHERE lower(usrname)='".strtolower($usrname)."' and deleted='N'";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);
	if(!$sectData){
		$maxcntQuery = "SELECT COALESCE(MAX(USERID),0)+1 as INC FROM users";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_array($maxcntResource,MYSQLI_ASSOC);

		$dojoin_arr = explode("/",$dojoin);
		$dojoin_db = $dojoin_arr['2']."-".$dojoin_arr['1']."-".$dojoin_arr['0'];

		$dobirth_arr = explode("/",$dobirth);
		$dobirth_db = $dobirth_arr['2']."-".$dobirth_arr['1']."-".$dobirth_arr['0'];

		$insertstatus = mysqli_query($zconn,"INSERT INTO users ( UNAME, USRNAME, USRPWD, EMAIL, MOBNO, TYPEID,team_id, STATUS, ADDRS, DOJOIN, DOBIRTH, BLDGRP, ENUM, relation,ADDDATE, ADDUSER, DELETED) VALUES ( '".$uname."', '".$usrname."','".$usrpwd."', '".$email."', '".$mobno."', '".$typeid."', '".$team_id."', '".$status."', '".addslashes($addrs)."', '".$dojoin_db."', '".$dobirth_db."', '".$bldgrp."', 
		'".$enum."', '".$relation."','".$date_time."', '".$_SESSION['userid']."', 'N')");

		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='useredit'){
	$sectExistQuery = "SELECT usrname FROM users WHERE lower(usrname)='".strtolower($usrname)."' and userid!='".$userid."' and deleted='N'";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);

		$dojoin_arr = explode("/",$dojoin);
		$dojoin_db = $dojoin_arr['2']."-".$dojoin_arr['1']."-".$dojoin_arr['0'];

		$dobirth_arr = explode("/",$dobirth);
		$dobirth_db = $dobirth_arr['2']."-".$dobirth_arr['1']."-".$dobirth_arr['0'];

	if(!$sectData){
		$updatestatus = mysqli_query($zconn,"UPDATE users SET UNAME = '".$uname."',USRNAME = '".$usrname."',USRPWD = '".$usrpwd."',EMAIL = '".$email."',ADDRS ='".$addrs."',MOBNO = '".$mobno."',TYPEID = '".$typeid."',team_id = '".$team_id."',relation = '".$relation."',STATUS = '".$status."',DOJOIN = '".$dojoin_db."',DOBIRTH = '".$dobirth_db."',BLDGRP ='".$bldgrp."',ENUM ='".$enum."',EDTUSER = '".$_SESSION['userid']."',EDTDATE = '".$date_time."' WHERE USERID = '".$userid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='userdelete'){
	$updatestatus = mysqli_query($zconn,"UPDATE users SET DELETED = 'Y',DELUSER = '".$_SESSION['userid']."',DELDATE = '".$date_time."' WHERE USERID = '".$userid."'");
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


