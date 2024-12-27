<?php 
include('includes/config.php');
include('includes/base_functions.php');  

if($_REQUEST['style']){
	$style_no=$_REQUEST['style'];
	$order_no = $_REQUEST['ord'];
	$buyer=$_REQUEST['sel_buyer'];
	$order=explode("~~",$_REQUEST['sel_buyer']);
	$buyer=$order['0'];
	$id=$order['1'];
//echo "select * from  knitting_planning where order_no='".$buyer."' and knitt_id='".$id."'";
	$select=mysqli_query($zconn,"select distinct(component_group) as component_group from  knitting_planning where order_no='".$buyer."' and knitt_id='".$id."'");

	$rowcount=mysqli_num_rows($select);

	if($rowcount >0){
		echo '<option value="Select">Select</option>';
		while ($row=mysqli_fetch_object($select)) {
			echo '<option value="'.$row->component_group.'">'.$row->component_group.'</option>';
		}
	} else {
		   echo '<option value="">Component Group not available</option>';
	}
}

?>

