<?php
error_reporting(0);
include("../includes/config.php");
extract($_REQUEST);
if($action=='get_cost_details'){
	$sel_costing1= mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['costing_id']."'"),MYSQLI_ASSOC);
	$sel_costing_dt = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$_REQUEST['costing_id']."'");
	$costing_list .='<select name="color" class="form-control"><option value="">--Select--</option>';
		while($res_costing_dt = mysqli_fetch_array($sel_costing_dt,MYSQLI_ASSOC)){
			$cgroup = $res_costing_dt['comp_group'];
			$costing_list .='<option value="'.$cgroup.'">'.$cgroup.'</option>';
		}
	$costing_list .='</select>';
	$sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"select buyer_name from buyer_master where buyer_id='".$sel_costing1['buyer_id']."'"),MYSQLI_ASSOC);
	$costing_date_arr = explode("-",$sel_costing1['costing_date']);

	$costing_date = $costing_date_arr['2']."-".$costing_date_arr['1']."-".$costing_date_arr['0'];
	
	echo $sel_costing1['order_no']."~~".$sel_costing1['style_no']."~~".$sel_buyer['buyer_name']."~~".$costing_date."~~".$costing_list;
}
	?>