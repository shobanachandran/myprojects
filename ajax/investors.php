<?php
error_reporting(0); 
include("../includes/config.php");
extract($_REQUEST);
if($action=='invadd'){
	
		$maxcntQuery = "SELECT COALESCE(MAX(inv_id),0)+1 as INC FROM investors";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_row($maxcntResource);
		$insertstatus = mysqli_query($zconn,"INSERT INTO investors (inv_name, inv_value,status) VALUES ('".$inv_name."', '".$inv_value."','".$status."')");
		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	
}
if($action=='invedit'){
		$updatestatus = mysqli_query($zconn,"UPDATE investors SET inv_name = '".$inv_name."',inv_value = '".$inv_value."',status = '".$status."' WHERE inv_id = '".$typeid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
/*	}else{
		echo "exist";
	}*/
}
if($action=='invdelete'){

		$updatestatus = mysqli_query($zconn,"delete from investors WHERE inv_id = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
}
if($action=='invinactive'){
	//Check If usertype in the User table
	$typeExistQuery = "SELECT inv_id FROM investors WHERE inv_id='".$typeid."'";
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