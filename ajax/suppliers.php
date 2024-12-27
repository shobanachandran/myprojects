<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);
//print_r($_REQUEST);
// For supplier Types
if($action=='saveStyes'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from supplier_types where BINARY supplier_type='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into supplier_types(supplier_type,type_description,status,created_by,created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update supplier_types set
							supplier_type='".$dt_name."', 
							type_description='".$dept_descr."', 
							status='".$status."' where supplier_type_id='".$dept_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =supplier_typelist();
	echo $msg."~~~".$dept_list;
}

if($action=='stypeDelete'){
	$del_dept = mysqli_query($zconn,"delete from supplier_types where supplier_type_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


/// For Suppliers

if($action=='supplieradd'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from suppliers where BINARY supplier_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
			$insert_dept = mysqli_query($zconn,"insert into suppliers(supplier_code,supplier_type_id,supplier_name,supplier_mobile,supplier_phone,supplier_email,supplier_address1,supplier_address2,state_id,district_id,area_id,suplier_country,supplier_pincode,supplier_pancard,supplier_gst,bank_name,branch_name,account_number,account_name,ifsc_code,status,created_by,created_date) values('".$scode."','".$stype."','".$sname."','".$smobile."','".$sphone."','".$semail."','".$txt_add1."','".$txt_add2."','".$state_id."', '".$dist_id."','".$city."','".$scountry."','".$spincode."','".$span_card."','".$supplier_gst."','".$bank_name."','".$branch_name."','".$acc_number."','".$account_name."','".$ifsc_code."','".$rad_status."','".$_SESSION['userid']."',now())");
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

// For new supplier add popup


if($action=='supplieradd_pop'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from suppliers where BINARY supplier_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
			$insert_dept = mysqli_query($zconn,"insert into suppliers(supplier_code,supplier_type_id,supplier_name,supplier_mobile,supplier_phone,supplier_email,supplier_address1,supplier_address2,state_id,district_id,area_id,suplier_country,supplier_pincode,supplier_pancard,supplier_gst,bank_name,branch_name,account_number,account_name,ifsc_code,status,created_by,created_date) values('".$scode."','".$stype."','".$sname."','".$smobile."','".$sphone."','".$semail."','".$txt_add1."','".$txt_add2."','".$state_id."', '".$dist_id."','".$city."','".$scountry."','".$spincode."','".$span_card."','".$supplier_gst."','".$bank_name."','".$branch_name."','".$acc_number."','".$account_name."','".$ifsc_code."','".$rad_status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$last_id = mysqli_insert_id($zconn);
				$supplier_list='';
				$supplier_list .='<select class="select2 form-control custom-select" id="to_address" name="to_address">
											<option>--Select--</option>';
		      $tocompe=mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0'");
			 while($tocompe_res=mysqli_fetch_object($tocompe)){
				 if($last_id==$tocompe_res->supplier_id){
					 $supplier_list .='<option selected="selected" value="'.$tocompe_res->supplier_name.'">'.$tocompe_res->supplier_name.'</option>';
				 } else {
				     $supplier_list .='<option value="'.$tocompe_res->supplier_name.'">'.$tocompe_res->supplier_name.'</option>';
				 }
					}
					$supplier_list .='</select>';
					$msg="1"."~~~".$supplier_list;
			} else {
				$msg="0";
			}
	} else {
		$msg="2";
	}
	echo $msg;
}
if($action=='supplieredit'){
	
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from suppliers where BINARY supplier_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
			$update_dept = mysqli_query($zconn,"update suppliers set
							supplier_code='".$scode."', 
							supplier_type_id='".$stype."', 
							supplier_name='".$sname."',
							supplier_mobile='".$smobile."',
							supplier_phone='".$sphone."',
							supplier_email='".$semail."',
							supplier_address1='".$txt_add1."',
							supplier_address2='".$txt_add2."',
							state_id='".$state_id."',
							district_id='".$dist_id."',
							area_id='".$city."',
							suplier_country='".$scountry."',
							supplier_pincode='".$spincode."',
							supplier_pancard='".$span_card."',
							supplier_gst='".$supplier_gst."',
							bank_name='".$bank_name."',
							branch_name='".$branch_name."',
							account_number='".$acc_number."',
							account_name='".$account_name."',
							ifsc_code='".$ifsc_code."',
							status='".$rad_status."'
							where supplier_id='".$colid."'");

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

if($action=='suppdelete'){
	$del_dept = mysqli_query($zconn,"delete from suppliers where supplier_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

