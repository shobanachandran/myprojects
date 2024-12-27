<?php
error_reporting(0); 
include("../includes/config.php");
include("../includes/functions.php");

extract($_REQUEST);


if ($action == 'staffadd') {
    // Check if the NIK NO already exists
    $sectExistQuery = "SELECT id FROM hv_fabric_master WHERE id='" . $id. "'";
    $sectResource = mysqli_query($zconn, $sectExistQuery);
    $sectData = mysqli_fetch_array($sectResource, MYSQLI_ASSOC);

    //if (!$sectData) {
        // Handle file upload for photo_ref
       // $photo_ref = '';
       // if (!empty($_FILES['photo']['name'])) {
          //  $photo_ref = 'uploads/hv_fab/' . basename($_FILES['photo']['name']);
          //  if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo_ref)) {
               

             //   echo 'File upload failed!';
             //   exit;
           // }
       // }

        // Insert into database
        $insertQuery = "INSERT INTO hv_fabric_master 
            (nik_no, style, style_no, nik_id, color, qty, cut_qty, tech_pack_date, 
            strike_off_date, strike_off_lead_time, plan_date, lookup_date, actual_date) 
            VALUES ('$nik_no', '$style', '$style_no', '$nik_id', '$color', '$qty', '$cut_qty', 
            '$tech_pack_date', '$strike_off_date', '$strike_off_lead_time', '$plan_date', 
            '$lookup_date', '$actual_date')";

        $insertstatus = mysqli_query($zconn, $insertQuery);

		if($insertstatus){
			$last_id = mysqli_insert_id($zconn);
		if(file_exists(($_FILES['photo']['tmp_name']))){
		$c_date = date('y-m-d');
		$source1 = $_FILES['photo']['tmp_name'];
		$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
		$upload1 =$c_date.$last_id.".".$ext;	
		$original_complogos1 = "../uploads/hv_fabric/".$upload1;
		$enqUpload = move_uploaded_file($source1, $original_complogos1);
		$filepath = "uploads/hv_fabric/".$upload1;
		if($enqUpload){
			$updatestatus = mysqli_query($zconn,"UPDATE hv_fabric_master SET photo = '".$upload1."' WHERE id = '".$last_id."'");
		}
	}

			$msg="1";
		} else {
			$msg="0";
		}

        if ($insertstatus == true) {
            echo 1; // Success
        } else {
            echo "Error: " . mysqli_error($zconn); // Debugging error
        }
    } 


if($action=='staffedit'){
	$sectExistQuery = "SELECT staff_name FROM staffs WHERE lower(staff_name)='".strtolower($staff_name)."' and userid!='".$userid."' and deleted='N'";
	$sectResource = mysqli_query($zconn,$sectExistQuery);
	$sectData = mysqli_fetch_array($sectResource,MYSQLI_ASSOC);

	if(!$sectData){
		$updatestatus = mysqli_query($zconn,"UPDATE staffs SET staff_name = '".$staff_name."',
        staff_code = '".$staff_code."',
        TYPEID = '".$typeid."',dept_id = '".$dept_id."',
        staff_position = '".$staff_position."',staff_education = '".$staff_education."', staff_mobile = '".$staff_mobile."',
        staff_email = '".$staff_email."',staff_address = '".$staff_address."', staff_bloodgroup = '".$staff_bloodgroup."',
        staff_econtact = '".$staff_econtact."', staff_relation = '".$staff_relation."',
        staff_salary = '".$staff_salary."', staff_allow = '".$staff_allow."',
        status = '".$status."',
        
        EDTUSER = '".$_SESSION['userid']."',EDTDATE = '".$date_time."' WHERE staff_id = '".$userid."'");
		if($updatestatus==true){
			echo 1;
		}else{
			echo 'error';
		}
	}else{
		echo "exist";
	}
}
if($action=='staffdelete'){
	$updatestatus = mysqli_query($zconn,"UPDATE staffs SET DELETED = 'Y',DELUSER = '".$_SESSION['userid']."',DELDATE = '".$date_time."' WHERE staff_id = '".$userid."'");
	if($updatestatus==true){
			echo 1;
	}else{
		echo 'error';
	}
}

if($action=='saveUserDept'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from user_department where dept_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into user_department(dept_name,dept_desc,status,created_by,created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update user_department set 
							dept_name='".$dt_name."', 
							dept_desc='".$dept_descr."', 
							status='".$status."' where dept_id='".$dept_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
			
		}
	} else {
		$msg="2";
	}
	$dept_list =user_dept();
	echo $msg."~~~".$dept_list;
}

if($action=='deptDelete'){
	$del_dept = mysqli_query($zconn,"delete from user_department where dept_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
	
}


