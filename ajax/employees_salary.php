<?php
error_reporting(0); 
include("../includes/config.php");
extract($_REQUEST);
if($action=='usertypeadd'){
	// $typeExistQuery = "SELECT emp_id FROM emp_salary WHERE emp_id=$emp_id";
	// $typeResource = mysqli_query($zconn,$typeExistQuery);
	// $typeData = mysqli_fetch_row($typeResource);
	// if(!$typeData){
	// 	$maxcntQuery = "SELECT COALESCE(MAX(id,0)+1 as INC FROM emp_salary";
	// 	$maxcntResource = mysqli_query($zconn,$maxcntQuery);
	// 	$maxData = mysqli_fetch_row($maxcntResource);
		$insertstatus = mysqli_query($zconn,"INSERT INTO 
		emp_salary (dept_id,emp_id,emp_amt) VALUES ('".$dept_id."', 
		'".$emp_id."','".$emp_amt."')");
		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	// }
}
if($action=='usertypeedit'){
	$typeExistQuery = "SELECT bank_name FROM banking WHERE bank_name='".$bank_name."' and id!='".$typeid."' ";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(!$typeData){
		$updatestatus = mysqli_query($zconn,"UPDATE banking SET bank_name = '".$bank_name."',branch_name = '".$branch_name."',account_no = '".$account_no."',ifsc_code = '".$ifsc_code."',status = '".$status."' WHERE id = '".$typeid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='empsalarydelete'){
	//Check If usertype in the User table
	$del_dept2 = mysqli_query($zconn,"delete from 
	emp_salary where id='".$typeid."'");
	if($del_dept2){
		echo "1";
	} else {
		echo "0";
	}
}
if($action=='staffsalarydelete'){
	//Check If usertype in the User table
	$del_dept1 = mysqli_query($zconn,"delete from 
	staff_salary where id='".$typeid."'");
	if($del_dept1){
		echo "1";
	} else {
		echo "0";
	}
}
if($action=='usertypeinactive'){
	//Check If usertype in the User table
	$typeExistQuery = "SELECT id FROM banking WHERE id='".$typeid."'";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(empty($typeData)){
	}else{
		echo 'exist';
	}
}