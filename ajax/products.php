<?php
error_reporting(0);
include("../includes/config.php");
include("../includes/functions.php");
extract($_REQUEST);

//For Yarn Types
if($action=='saveYarnType'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from yarn_types where yarn_type_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into yarn_types(yarn_type_name,descr,status,created_by,
			created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update yarn_types set 
							yarn_type_name='".$dt_name."', 
							descr='".$dept_descr."', 
							status='".$status."' where id='".$dept_id."'");

			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =yarntype_list();
	echo $msg."~~~".$dept_list;
}

if($action=='deptYarnType'){
	$del_dept = mysqli_query($zconn,"delete from yarn_types where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}
//For Yarn Names
if($action=='saveYarnName'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from yarn_names where yarn_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into yarn_names(yarn_name,descr,status,created_by,created_date)
			 values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update yarn_names set 
							yarn_name='".$dt_name."', 
							descr='".$dept_descr."', 
							status='".$status."' where id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =yarnname_list();
	echo $msg."~~~".$dept_list;
}

//For Compoenents
if($action=='saveComponent'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from components where comp_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into components(comp_name,comp_descr,status,created_by,created_date) values('".$dt_name."','".$dept_descr."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update components set 
							comp_name='".$dt_name."',
							comp_descr='".$dept_descr."',
							status='".$status."' where id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =component_list1();
	echo $msg."~~~".$dept_list;
}


if($action=='compDelete'){
	$del_comp = mysqli_query($zconn,"delete from components where id='".$typeid."'");
	if($del_comp){
		echo "1";
	} else {
		echo "0";
	}
}


if($action=='deptYarnName'){
	$del_dept = mysqli_query($zconn,"delete from yarn_names where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

// For Counts
if($action=='saveCountType'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from counts_master where counts_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into counts_master(counts_name,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update counts_master set 
							counts_name='".addslashes($dt_name)."',
							status='".$status."' where counts_id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =counts_list();
	echo $msg."~~~".$dept_list;
}


// For Components

if($action=='saveCountType122'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from counts_master where counts_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into counts_master(counts_name,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update counts_master set 
							counts_name='".addslashes($dt_name)."',
							status='".$status."' where counts_id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =counts_list();
	echo $msg."~~~".$dept_list;
}


//For UOM


if($action=='saveUom'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from uom_master where uom_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into uom_master(uom_name,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update uom_master set 
							uom_name='".addslashes($dt_name)."',
							status='".$status."' where id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =uom_list();
	echo $msg."~~~".$dept_list;
}

// For Season 

if($action=='saveSeason'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from season_master where season_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into season_master(season_name,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update season_master set 
							season_name='".addslashes($dt_name)."',
							status='".$status."' where season_id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =season_list();
	echo $msg."~~~".$dept_list;
}

// For Sample 
if($action=='save_sample'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from sample_master where sample_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into sample_master(sample_name,sample_descr,status,created_by,created_date) values('".addslashes($dt_name)."','".addslashes($dept_descr)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update sample_master set 
							sample_name='".addslashes($dt_name)."',
							sample_descr = '".addslashes($dept_descr)."',
							status='".$status."' where sample_id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =sample_list();
	echo $msg."~~~".$dept_list;
}


// For sizes

if($action=='saveSize'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from size_master where size_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into size_master(size_name,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update size_master set 
							size_name='".addslashes($dt_name)."',
							status='".$status."' where size_id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =size_list();
	echo $msg."~~~".$dept_list;
}

if($action=='sizeDelete'){
	$del_dept = mysqli_query($zconn,"delete from size_master where size_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}



// For Colors

if($action=='saveColor'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from color_master where colour_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into color_master(colour_name,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update color_master set 
							colour_name='".addslashes($dt_name)."',
							status='".$status."' where id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =color_list();
	echo $msg."~~~".$dept_list;
}

if($action=='delColors'){
	$del_dept = mysqli_query($zconn,"delete from color_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


// For Style

if($action=='saveStyle'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from style_code where style_no='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){

			echo "insert into style_code(style_no,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())";
			$insert_dept = mysqli_query($zconn,"insert into style_code(style_no,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update style_code set 
							style_no='".addslashes($dt_name)."',
							status='".$status."' where id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =style_list();
	echo $msg."~~~".$dept_list;
}


if($action=='delStyle'){
	$del_dept = mysqli_query($zconn,"delete from style_code where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

// For Nikno

if($action=='saveNikno'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from nik_no where nik_no='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){

			
			$insert_dept = mysqli_query($zconn,"insert into nik_no(nik_no,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update nik_no set 
							nik_no='".addslashes($dt_name)."',
							status='".$status."' where id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =nikno_list();
	echo $msg."~~~".$dept_list;
}


if($action=='delNikno'){
	$del_dept = mysqli_query($zconn,"delete from nik_no where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


// For NikId

if($action=='saveNikid'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from nik_id where nik_id='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){

			
			$insert_dept = mysqli_query($zconn,"insert into nik_id(nik_id,status,created_by,created_date) values ('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update nik_id set 
							nik_id='".addslashes($dt_name)."',
							status='".$status."' where id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =nikid_list();
	echo $msg."~~~".$dept_list;
}


if($action=='delNikid'){
	$del_dept = mysqli_query($zconn,"delete from nik_id where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}



if($action=='seasonDelete'){
	$del_dept = mysqli_query($zconn,"delete from season_master where season_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


if($action=='sampleDelete'){
	$del_dept = mysqli_query($zconn,"delete from sample_master where sample_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

if($action=='deptcountType'){
	$del_dept = mysqli_query($zconn,"delete from counts_master where counts_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


if($action=='uomDelete'){
	$del_dept = mysqli_query($zconn,"delete from uom_master where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


// Size groups
if($action=='size_group_add'){
	$check_insert = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_grp_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		$count_sizes = count($_POST['chk_sizes']);
		$sizes='';
		for($sg=0;$sg<$count_sizes;$sg++){
			$sizes .= $_POST['chk_sizes'][$sg].",";
		}
		$sizes = substr($sizes,0,-1);
		$insert_groups =  mysqli_query($zconn,"insert into size_groups(size_group_name,size_ids,status,created_by,created_date) values('".$size_grp_name."','".$sizes."','".$status."','".$_SESSION['userid']."',now())");
		if($insert_groups){
			$msg="1";
		} else {
			$msg="0";
		}
	} else {
		$msg="2";
	}
	echo $msg;
}

if($action=='size_group_edit'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_grp_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		$count_sizes = count($_POST['chk_sizes']);
		$sizes='';
		for($sg=0;$sg<$count_sizes;$sg++){
			$sizes .= $_POST['chk_sizes'][$sg].",";
		}
		$sizes = substr($sizes,0,-1);
			$update_dept = mysqli_query($zconn,"update size_groups set
							size_group_name='".$size_grp_name."', 
							size_ids='".$sizes."', 
							status='".$status."'
							where group_id='".$colid."'");
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


if($action=='sizegroupdelete'){
	$del_dept = mysqli_query($zconn,"delete from size_groups where group_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}

// Process Groups


// Size groups
if($action=='process_group_add'){
	//print_r($_POST);
	$check_insert = mysqli_query($zconn,"select * from process_groups where process_name='".$size_grp_name."'");
	$row_insert = mysqli_num_rows($check_insert);
	$msg='';
	if($row_insert>0){
		//$msg="2";
	} else {
		$count_sizes = count($_POST['chk_sizes']);
		$sizes='';
		for($sg=0;$sg<$count_sizes;$sg++){
			$sizes .= $_POST['chk_sizes'][$sg].",";
		}
		$sizes = substr($sizes,0,-1);

		$count_process = count($_POST['chk_process']);
		$process='';
		for($sg1=0;$sg1<$count_process;$sg1++){
			$process .= $_POST['chk_process'][$sg1].",";
		}
		$process = substr($process,0,-1);

		$insert_groups =  mysqli_query($zconn,"insert into process_groups(process_name,process_flow,dept_flow,status,created_by,created_date) values('".$size_grp_name."','".$process."','".$sizes."','".$status."','".$_SESSION['userid']."',now())");

		if($insert_groups){
			$msg="1";
		} else {
			$msg="0";
		}
	}
	echo $msg;
}

if($action=='process_group_edit'){

	$msg='';
	$check_insert = mysqli_query($zconn,"select * from process_groups where process_name='".$size_grp_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	// if($row_insert==0){

		$count_sizes = count($_POST['chk_sizes']);
		$sizes='';
		for($sg=0;$sg<$count_sizes;$sg++){
			$sizes .= $_POST['chk_sizes'][$sg].",";
		}
		
		$count_process = count($_POST['chk_process']);
		$process='';
		for($sg1=0;$sg1<$count_process;$sg1++){
			$process .= $_POST['chk_process'][$sg1].",";
		}
		$process = substr($process,0,-1);

		$sizes = substr($sizes,0,-1);
			$update_dept = mysqli_query($zconn,"update process_groups set
							process_name='".$size_grp_name."', 
							process_flow='".$process."', 
							dept_flow='".$sizes."', 
							status='".$status."'
							where process_id='".$colid."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
	
	echo $msg;
 }


if($action=='processgroupdelete'){
	$del_dept = mysqli_query($zconn,"delete from process_groups where process_id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}


// Colour groups
if($action=='colour_group_add'){
	$check_insert = mysqli_query($zconn,"select * from color_groups where color_group='".$size_grp_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		$count_sizes = count($_POST['chk_sizes']);
		$sizes='';
		for($sg=0;$sg<$count_sizes;$sg++){
			$sizes .= $_POST['chk_sizes'][$sg].",";
		}
		$sizes = substr($sizes,0,-1);
		$insert_groups =  mysqli_query($zconn,"insert into color_groups(color_group,color_ids,status,created_by,created_date) values('".$size_grp_name."','".$sizes."','".$status."','".$_SESSION['userid']."',now())");
		if($insert_groups){
			$msg="1";
		} else {
			$msg="0";
		}
	} else {
		$msg="2";
	}
	echo $msg;
}

if($action=='colour_group_edit'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from color_groups where color_group='".$size_grp_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		$count_sizes = count($_POST['chk_sizes']);
		$sizes='';
		for($sg=0;$sg<$count_sizes;$sg++){
			$sizes .= $_POST['chk_sizes'][$sg].",";
		}
		$sizes = substr($sizes,0,-1);
			$update_dept = mysqli_query($zconn,"update color_groups set
							color_group='".$size_grp_name."', 
							color_ids='".$sizes."', 
							status='".$status."'
							where id='".$colid."'");
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


if($action=='colourgroupdelete'){
	$del_dept = mysqli_query($zconn,"delete from color_groups where id='".$typeid."'");
	if($del_dept){
		echo "1";
	} else {
		echo "0";
	}
}



if($process_name!=''){
echo "fghgh";

exit;
	$del_dept1 = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM  process_groups where process_name='".$process_name."'"),MYSQLI_ASSOC);
		echo $del_dept1['process_flow'];	
}





if($action=='process_planning_add'){
	$msg='';
	$check_insert = mysqli_query($zconn,"select * from size_master where size_name='".$dt_name."'");
	$row_insert=mysqli_num_rows($check_insert);

	if($row_insert==0){
		if($dept_id==''){
			$insert_dept = mysqli_query($zconn,"insert into size_master(size_name,status,created_by,created_date) values('".addslashes($dt_name)."','".$status."','".$_SESSION['userid']."',now())");
			if($insert_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		} else if($dept_id!=''){
			$update_dept = mysqli_query($zconn,"update size_master set 
							size_name='".addslashes($dt_name)."',
							status='".$status."' where size_id='".$dept_id."'");
			if($update_dept){
				$msg="1";
			} else {
				$msg="0";
			}
		}
	} else {
		$msg="2";
	}
	$dept_list =size_list();
	echo $msg."~~~".$dept_list;
}



