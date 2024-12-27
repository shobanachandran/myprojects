<?php
include('includes/config.php');
$ids = $_GET['id'];


		$cost_det = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$_REQUEST['costing_no']."' and id IN($ids)");
		$rec=0;
		$yarn_type=array();
		$yarn_color=array();
		$fab_type = array();
		$comp = array();
		while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){ 
			$yarn_type[] = $res_cost_det['yarn_type'];
			$yarn_color[] = $res_cost_det['yarn_colour'];
			$fab_type[] = $res_cost_det['yarn_colour'];
			$comp = $res_cost_det['comp_id'];
		} 
		$ytype = array_unique($yarn_type);
		$yarn_type = implode(",",$ytype);
		$ycolor = array_unique($yarn_color);
		$ycolour = implode(",",$ycolor);
		$comp_group = array_unique($comp);
		$comp_groups = implode(",",$comp_group);
		
?>

Group Name : <input type="text" name="group_name">
					