<?php
error_reporting(0); 
include("../includes/config.php");
extract($_REQUEST);
//print_r($_REQUEST);

if($action=='generaledit' || $action=='generaladd'){
	$updatestatus = mysqli_query($zconn,"UPDATE company_info SET company_name = '".$company_name."',company_unit='".$unit_office."',company_address = '".addslashes($txtr_address)."',company_phone = '".$txt_phone."',company_email = '".$email1."',company_GSTIN='".$txt_gst."',company_pan='".$txt_pancard."'");
	
	if($updatestatus==true){
		echo 1;
	}else{
		echo 'error';
	}
}
?>