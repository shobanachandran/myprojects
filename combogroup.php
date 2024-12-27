<?php 
include('includes/config.php');
include('includes/base_functions.php');  
if($_REQUEST['style']){
	$style_no=$_REQUEST['style'];
	$order_no = $_REQUEST['ord'];
	$select=mysqli_query($zconn,"select * from  order_entry_master where order_id='".$order_no."' and style_no='".$style_no."'");

	$rowcount=mysqli_num_rows($select);

	if($rowcount >0){
		echo '<option  value="Select">Select</option>';
		while ($row=mysqli_fetch_object($select)) {
			echo '<option value="'.$row->combo_colour.'">'.$row->combo_colour.'</option>';
		}
	} else {
		   echo '<option value="">Component Group not available</option>';
	}
}

?>
 <script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>

