<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);


/// For Suppliers

if($action=='jobworkadd'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from jobwork where BINARY jobwork_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
			$insert_dept = mysqli_query($zconn,"insert into jobwork(jobwork_code,jobwork_type_id,jobwork_name,
			jobwork_mobile,jobwork_phone,jobwork_email,jobwork_address1,jobwork_address2,state_id,district_id,area_id,jobwork_country,jobwork_pincode, jobwork_pancard, jobwork_gst,jobwork_hold, bank_name,branch_name,account_number,account_name,ifsc_code,status,created_by,created_date)
			 values('".$jobwork_code."','','".$jobwork_name."','".$jmobile_no."',
			 '".$jphone."','".$jemail."','".$job_add1."','".$job_add2."','".$state_id."', 
			 '".$dist_id."','".$city."',
			 '".$jcountry."','".$jpin_code."','".$jpancard."','".$j_gst."',
			 '".$holdup_txt."','".$bank_name."','".$branch_name."','".$account_number."',
			 '".$account_name."','".$ifsc_code."','".$rad_status."',
			 '".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
	} else {
		$msg="2";
	}
	echo $msg;
}

if($action=='jobworkedit'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from jobwork where BINARY jobwork_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
			$update_dept = mysqli_query($zconn,"update jobwork set
							jobwork_code='".$jobwork_code."', 
							jobwork_name='".$jobwork_name."',
							jobwork_mobile='".$jmobile_no."',
							jobwork_phone='".$jphone."',
							jobwork_email='".$jemail."',
							jobwork_address1='".$job_add1."',
							jobwork_address2='".$job_add2."',
							state_id='".$state_id."',
							district_id='".$dist_id."',
							area_id='".$city."',
							jobwork_country='".$jcountry."',
							jobwork_pincode='".$jpin_code."',
							jobwork_pancard='".$jpancard."',
							jobwork_gst='".$j_gst."',
							jobwork_hold='".$holdup_txt."',
							bank_name='".$bank_name."',
							branch_name='".$branch_name."',
							account_number='".$account_number."',
							account_name='".$account_name."',
							ifsc_code='".$ifsc_code."',
							status='".$rad_status."'
							where jobwork_id='".$colid."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
	} else {
		$msg="2";
	}
	echo $msg;
}

if($action=='jobworkdelete'){
	$del_dept = mysqli_query($zconn,"delete from jobwork where jobwork_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

