<?php 
function date_to_db($ins_date){
	$ins_date_arr = explode("-",$ins_date);
	$ins_date = $ins_date_arr['2']."-".$ins_date_arr['1']."-".$ins_date_arr['0'];
	return $ins_date;
}

function date_from_db($db_date){
	$db_date_arr = explode("-",$db_date);
	$db_date = $db_date_arr['2']."-".$db_date_arr['1']."-".$db_date_arr['0'];
	return $db_date;
}

function get_max_costno(){
	global $zconn;
	$sel_costing123 = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as COSTINO from costing_entry_master"));
	if($sel_costing123['COSTINO']=='' || $sel_costing123['COSTINO']==NULL){
		$cost_no ='001';
	} else {
		$cost_no = "100".$sel_costing123['COSTINO']+1;
	}
	return $cost_no;
}

function get_shift_values($pre_selected) {
	$options = '';
	for($i=0;$i<=3;$i=$i+0.25) {
		if($i == $pre_selected) {
			$options .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
		} else {
			$options .= '<option value="'.$i.'">'.$i.'</option>';
		}
	}
	if('A' == $pre_selected) {
		$options .= '<option selected="selected" value="A">A</option>';
	} else {
		$options .= '<option value="A">A</option>';
	}

	return $options;
}
?>
