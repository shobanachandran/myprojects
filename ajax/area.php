<?php
error_reporting(0); 
include("../includes/config.php");
extract($_REQUEST);

//print_r($_REQUEST);

if($action=='areaadd'){
	
		$maxcntQuery = "SELECT COALESCE(MAX(id),0)+1 as INC FROM area";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_row($maxcntResource);
		$insertstatus = mysqli_query($zconn,"INSERT INTO area (state_id,dist_id,area_name, status, deleted,created_by) VALUES ('".$state_id."','".$dist_id."','".$colname."','".$status."','N', '".$_SESSION['userid']."')");
		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	
}
if($action=='areaedit'){
		$updatestatus = mysqli_query($zconn,"UPDATE area SET state_id='".$state_id."',dist_id='".$dist_id."',area_name = '".$colname."',STATUS = '".$status."' WHERE id = '".$colid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}

}
if($action=='areadelete'){

		$updatestatus = mysqli_query($zconn,"UPDATE area SET DELETED = 'Y' WHERE id = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
	/*}else{
		echo 'exist';
	}*/
}

//For state 

if($action=='state_areaadd'){
	
		$maxcntQuery = "SELECT COALESCE(MAX(id),0)+1 as INC FROM states";
		$maxcntResource = mysqli_query($zconn,$maxcntQuery);
		$maxData = mysqli_fetch_row($maxcntResource);
		
		//echo "INSERT INTO states (state_name, status, deleted,created_by) VALUES ('".$colname."','".$status."','N', '".$_SESSION['userid']."')";
		
		$insertstatus = mysqli_query($zconn,"INSERT INTO states (state_name, status, deleted,created_by) VALUES ('".$colname."','".$status."','N', '".$_SESSION['userid']."')");
		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	
}
if($action=='state_areaedit'){
	$typeExistQuery = "SELECT state_name FROM states WHERE state_name='".$colname."'  ";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(!$typeData){
		$updatestatus = mysqli_query($zconn,"
		UPDATE states SET state_name = '".$colname	."',status = '".$status."' WHERE state_id = '".$colid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='state_areadelete'){
	//Check If usertype in the User table
	/*$typeExistQuery = "SELECT BRNID FROM users WHERE BRNID='".$brnid."'";
	$typeResource = mysqli_query($zconn,$typeExistQuery);
	$typeData = mysqli_fetch_row($typeResource);
	if(empty($typeData)){*/
		$updatestatus = mysqli_query($zconn,"delete from states WHERE state_id = '".$typeid."'");
		if($updatestatus==true){
				echo 1;
		}else{
			echo 'error';
		}
	/*}else{
		echo 'exist';
	}*/
}


//For Districts 

if($action=='dist_areaadd'){
	
		$insertstatus = mysqli_query($zconn,"INSERT INTO districts (state_id,dist_name, status, deleted,created_by) VALUES ('".$state_id."','".$colname."','".$status."','N', '".$_SESSION['userid']."')");
		if($insertstatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	
}
if($action=='dist_areaedit'){
		$updatestatus = mysqli_query($zconn,"UPDATE districts SET state_id='".$state_id."',dist_name = '".$colname	."',status = '".$status."' WHERE dist_id = '".$colid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
}
if($action=='dist_areadelete'){
		$updatestatus = mysqli_query($zconn,"delete from districts WHERE dist_id = '".$typeid."'");
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


if($action=='disp_dist'){

	$dist_list .='';

	$sel_dist = mysqli_query($zconn,"select * from districts where status='Active' and state_id=".$state_id);
	$dist_list .='<select name="dist_id" id="dist_id" class="form-control"><option value="">--Select--</option>';
	while($res_dist = mysqli_fetch_array($sel_dist,MYSQLI_ASSOC)){
		$dist_list .='<option value="'.$res_dist['dist_id'].'">'.$res_dist['dist_name'].'</option>';
	}
	$dist_list .='</select>';
	
	echo $dist_list;
}

if($action=='display_dist'){

	$dist_list .='';

	$sel_dist = mysqli_query($zconn,"select * from districts where status='Active' and state_id=".$state_id);
	$dist_list .='<select name="dist_id" id="dist_id" class="form-control" onchange="disp_area(this.value);"><option value="">--Select--</option>';
	while($res_dist = mysqli_fetch_array($sel_dist,MYSQLI_ASSOC)){
		$dist_list .='<option value="'.$res_dist['dist_id'].'">'.$res_dist['dist_name'].'</option>';
	}
	$dist_list .='</select>';
	
	echo $dist_list;
}

if($action=='disp_area'){
	$dist_list .='';

	$sel_dist = mysqli_query($zconn,"select * from area where status='Active' and dist_id=".$dist_id);
	$dist_list .='<select name="city" id="city" class="form-control"><option value="">--Select--</option>';
	while($res_dist = mysqli_fetch_array($sel_dist,MYSQLI_ASSOC)){
		$dist_list .='<option value="'.$res_dist['id'].'">'.$res_dist['area_name'].'</option>';
	}
	$dist_list .='</select>';
	
	echo $dist_list;
}

