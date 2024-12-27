<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);

/// For Contractors

if($action=='contractoradd'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from contractors where BINARY con_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);
	$con_join_date = $_POST['doj'];
	if($row_insert==0){
			$insert_dept = mysqli_query($zconn,"insert into contractors(con_code,dept_id,con_name,con_address,con_number,doj,status,created_by,created_date,bill_status)
			 values('".$con_code."','".$dept_id."','".$con_name."','".$con_address."','".$con_mobile."','".$con_join_date."','".$status."','".$_SESSION['userid']."',now(),'".$bill_status."')");
			if($insert_dept){
				$last_id = mysqli_insert_id($zconn);
			if(file_exists(($_FILES['con_photo']['tmp_name']))){
			$c_date = date('y-m-d');
			$source1 = $_FILES['con_photo']['tmp_name'];
			$ext = pathinfo($_FILES['con_photo']['name'], PATHINFO_EXTENSION);
			$upload1 =$c_date.$last_id.".".$ext;	
			$original_complogos1 = "../uploads/contractors/".$upload1;
			$enqUpload = move_uploaded_file($source1, $original_complogos1);
			$filepath = "uploads/contractors/".$upload1;
			if($enqUpload){
				$updatestatus = mysqli_query($zconn,"UPDATE contractors SET con_photo = '".$upload1."' WHERE con_id = '".$last_id."'");
			}
		}

				$msg="1";
			} else {
				$msg="0";
			}
	} else {
		$msg="2";
	}
	echo $msg;
}
if($action=='contractoredit'){
	
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from contractors where BINARY con_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
			$update_dept = mysqli_query($zconn,"update contractors set
							con_code='".$con_code."', 
							dept_id='".$dept_id."', 
							con_name='".$con_name."',
							con_address='".$con_address."',
							con_number='".$con_mobile."',
							doj='".$con_join."',
							status='".$status."'
							where con_id='".$colid."'");

			if($update_dept){
			if(file_exists(($_FILES['con_photo']['tmp_name']))){
			$c_date = date('y-m-d');
			$source1 = $_FILES['con_photo']['tmp_name'];
			$ext = pathinfo($_FILES['con_photo']['name'], PATHINFO_EXTENSION);
			$upload1 =$c_date.$colid.".".$ext;	
			$original_complogos1 = "../uploads/contractors/".$upload1;
			$enqUpload = move_uploaded_file($source1, $original_complogos1);
			$filepath = "uploads/contractors/".$upload1;
			if($enqUpload){
				$updatestatus = mysqli_query($zconn,"UPDATE contractors SET con_photo = '".$upload1."' WHERE con_id = '".$colid."'");
			}
				$msg="1";
			}
			} else {
				$msg="0";
			}
	} else {
		$msg="2";
	}
	echo $msg;
}

if($action=='contractor_delete'){
	$del_dept = mysqli_query($zconn,"delete from contractors where con_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

