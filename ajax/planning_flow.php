<?php
error_reporting(E_ALL);
include("../includes/config.php");
include("../includes/functions.php");
extract($_REQUEST);


if($process_name!=''){
	$del_dept1 = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM  process_groups where process_name='".$process_name."'"),MYSQLI_ASSOC);
		echo $del_dept1['process_flow']."~~".$del_dept1['dept_flow'];	
}

?>