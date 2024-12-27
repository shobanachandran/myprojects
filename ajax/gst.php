<?php
error_reporting(0); 
include("../includes/config.php");
extract($_REQUEST);
if($action=='gstadd'){
	
		$maxcntQuery = "SELECT COALESCE(MAX(GSTID),0)+1 as INC FROM gst";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_row($maxcntResource);
		$insertstatus = mysqli_query($zconn,"INSERT INTO gst (GSTID, GSTNAME, DESCRTION, STATUS,ADDDATE, ADDUSER, DELETED) VALUES ('".$maxData[0]."', '".$colname	."', '".$descrtion."','".$status."','".$date_time."', '".$_SESSION['userid']."', 'N')");
		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	
}
if($action=='gstedit'){
		$updatestatus = mysqli_query($zconn,"UPDATE gst SET GSTNAME	 = '".$colname	."',DESCRTION = '".$descrtion."',STATUS = '".$status."',EDTUSER = '".$_SESSION['userid']."',EDTDATE = '".$date_time."' WHERE GSTID = '".$colid."'");
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

		$updatestatus = mysqli_query($zconn,"delete from gst WHERE GSTID = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
}
if($action=='gstinactive'){
	//Check If usertype in the User table
	$typeExistQuery = "SELECT BRNID FROM gst WHERE BRNID='".$colid."'";
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