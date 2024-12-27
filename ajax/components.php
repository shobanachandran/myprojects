<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);

if($action=='saveFabDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  fabric_master where fabric_name='".$fabric_name."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($fabric_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  fabric_master(fabric_name,created_by,created_date) values('".$fabric_name."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($fabric_id!=''){
			$update_dept = mysqli_query($zconn,"update  fabric_master set 
							fabric_name='".$fabric_name."' where id='".$fabric_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =fabric_dept();
	echo $msg."~~~".$dept_list;
}


//for color
if($action=='saveColorDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  color_master where colour_name='".$colour_name."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($color_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  color_master(colour_name,created_by,created_date) values('".$colour_name."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($color_id!=''){
			$update_dept = mysqli_query($zconn,"update color_master set 
							colour_name='".$colour_name."' where id='".$color_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =color_dept();
	echo $msg."~~~".$dept_list;
}

// For DIA

if($action=='saveDiaDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  dia_master where dia_name='".$dia_name."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dia_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  dia_master(dia_name,created_by,created_date) values('".$dia_name."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dia_id!=''){
			$update_dept = mysqli_query($zconn,"update dia_master set 
							dia_name='".$dia_name."' where id='".$dia_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =dia_dept();
	echo $msg."~~~".$dept_list;
}


// for gsm 

if($action=='saveGsmDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  gsm_master where gsm_name='".$gsm_name."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($gsm_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  gsm_master(gsm_name,created_by,created_date) values('".$gsm_name."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($gsm_id!=''){
			$update_dept = mysqli_query($zconn,"update gsm_master set 
							gsm_name='".$gsm_name."' where id='".$gsm_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =gsm_dept();
	echo $msg."~~~".$dept_list;
}


// for Content 

if($action=='saveContentDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  content_master where content_name='".$content_name."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($content_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  content_master(content_name,created_by,created_date) values('".$content_name."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($content_id!=''){
			$update_dept = mysqli_query($zconn,"update content_master set 
						content_name='".$content_name."' where id='".$content_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =content_dept();
	echo $msg."~~~".$dept_list;
}


// for Style No 

if($action=='savestyleDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  style_code where style_no='".$style_no."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($style_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  style_code(style_no,created_by,created_date) values('".$style_no."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($style_id!=''){
			$update_dept = mysqli_query($zconn,"update style_code set 
						style_no='".$style_no."' where id='".$style_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =style_dept();
	echo $msg."~~~".$dept_list;
}


// for Style No 

if($action=='savenikidDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  nik_id where nik_id='".$nik_id."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($nikid_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  nik_id(nik_id,created_by,created_date) values('".$nik_id."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($nikid_id!=''){
			$update_dept = mysqli_query($zconn,"update nik_id set 
						nik_id='".$nik_id."' where id='".$nikid_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =nikid_dept();
	echo $msg."~~~".$dept_list;
}


// for Nik No 

if($action=='saveniknoDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from  nik_no where nik_no='".$nik_no."'");
	$row_insert = mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($nikno_id==''){
			$insert_dept = mysqli_query($zconn,"insert into  nik_no(nik_no,created_by,created_date) values('".$nik_no."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($nikno_id!=''){
			$update_dept = mysqli_query($zconn,"update nik_no set 
						nik_no='".$nik_no."' where id='".$nikno_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =nikno_dept();
	echo $msg."~~~".$dept_list;
}


// For deletes
if($action=='colorDelete'){
	$del_dept = mysqli_query($zconn,"delete from color_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='FabDelete'){
	$del_dept = mysqli_query($zconn,"delete from fabric_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='diaDelete'){
	$del_dept = mysqli_query($zconn,"delete from dia_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='gsmDelete'){
	$del_dept = mysqli_query($zconn,"delete from gsm_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='contentDelete'){
	$del_dept = mysqli_query($zconn,"delete from content_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='deptDelete'){
	$del_dept = mysqli_query($zconn,"delete from user_department where dept_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='styleDelete'){
	$del_dept = mysqli_query($zconn,"delete from style_code where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='niknoDelete'){
	$del_dept = mysqli_query($zconn,"delete from nik_no where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='nikidDelete'){
	$del_dept = mysqli_query($zconn,"delete from nik_id where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


