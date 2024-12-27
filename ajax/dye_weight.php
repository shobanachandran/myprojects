<?php 
include('../includes/config.php');

$x = $_POST['fabric_name'];

if (is_array($x)) {
    $where_con = "fabric_name IN ('" . implode("', '", array_values($x)) . "')";
} else {
    $where_con = "fabric_name = '" . $x . "'";
}

$costing_no = $_REQUEST['costing_no'];

$sel_fabric_pcs_wgt = mysqli_query($zconn, "SELECT fabric_name, pcs_weight FROM costing_entry_details WHERE " . $where_con . " AND `costing_id` = '" . $costing_no . "'");

while ($fabric = mysqli_fetch_array($sel_fabric_pcs_wgt)) {
   // echo " $fabric['pcs_weight']  "<br>";
}
?>
