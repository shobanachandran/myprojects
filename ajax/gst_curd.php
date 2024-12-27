<?php
error_reporting(0); 
include("../includes/config.php");
extract($_REQUEST);
if($action=='gstadd'){
	
		$maxcntQuery = "SELECT COALESCE(MAX(gst_id),0)+1 as INC FROM gst";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_row($maxcntResource);
		$insertstatus = mysqli_query($zconn,"INSERT INTO gst (gst_name, gst_value,status) VALUES ('".$gst_name."', '".$gst_value."','".$status."')");
		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	
}
if($action=='gstedit'){
		$updatestatus = mysqli_query($zconn,"UPDATE gst SET gst_name = '".$gst_name."',gst_value = '".$gst_value."',status = '".$status."' WHERE gst_id = '".$typeid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
/*	}else{
		echo "exist";
	}*/
}
if($action=='gstdelete'){

		$updatestatus = mysqli_query($zconn,"delete from gst WHERE gst_id = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
}
if($action=='gstinactive'){
	//Check If usertype in the User table
	$typeExistQuery = "SELECT gst_id FROM gst WHERE gst_is='".$typeid."'";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(empty($typeData)){
	}else{
		echo 'exist';
	}
}



if($action=='areadelete'){

		$updatestatus = mysqli_query($zconn,"delete from area  WHERE id = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
}
if($action=='districtsdelete'){

		$updatestatus = mysqli_query($zconn,"delete from districts WHERE dist_id = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
}


if($action=='bankmasterdelete'){

		$updatestatus = mysqli_query($zconn,"delete from bank_master WHERE id = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
}