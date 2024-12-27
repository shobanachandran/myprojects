<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}





?><!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Garments ERP">
    <meta name="author" content="Iorange Innovation">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title><?php echo SITE_TITLE;?> - Costing Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">


	
	<style>
   .table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #000; /* Add border to the whole table */
}

.table th, .table td {
    padding: 8px;
    text-align: left;
}

/*th {
    background-color: #f2f2f2;
}*/

/* Print Styles */
@media print {
    th {
        background-color: #FABF8F !important;
    }
    .table {
        border: 1px solid #000 !important; /* Force border to be printed */
    }
}

</style>
	 <style type="text/css">
      
    </style>

</head>
<body>
    <div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php //include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php //include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
    
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
          

            <div class="container-fluid">
				<form name="costing_entry" id="costing_entry" method="post">
 
				 <div class="col-md-12">
                    <div class="card">
						<div class="card-body" style="width:100%; padding:0px;">
						
		
				<?php

				$grant_total=0;
					if($id!=''){ $cost0 = mysqli_fetch_array(mysqli_query($zconn,"select * from process_planning_flow where id='".$id."'"),MYSQLI_ASSOC);
                        $costb = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master WHERE order_no = '" . $cost0['order_no'] . "' AND style_no = '" . $cost0['style_no'] . "'"),MYSQLI_ASSOC);
					?>
							<table  width="100%" style=" border: 1px groove black;">
							               
																					<tr>
    <th height="20" width="100%" colspan="2" align="center" valign="middle" bgcolor="" style="background-color:#FABF8F;border:1px groove black; color: black;text-align: center"><h3>Planning Report: 
    </h3></th>
  </tr>
                              
  <table  style="border: 1px groove black;width:100%;border-bottom:none;border-top:none;" >

  <tr>
    <td width="40%" align="left" valign="top"
        style="padding-left:10px; padding-top:5px; padding-bottom:10px; padding_right:5px; font-size:17px;">
        <img src="assets/images/LOGO VAMAN EXPORTS .png
" alt="Your Company Logo" style="max-width: 500px; height: 100px;"><br>
    </td>
    <td width="60%" align="center" valign="top"
        style="padding-left:0px; padding-top:10px; padding-bottom:10px; font-size:17px;text-align:center;">
       2	SF NO.355/B1 - A, VIVID GARDEN, VIVID GARDEN, Dharapuram Tiruppur Road, Government Adi Dravidar Welfare High School, KOVIL VAZHI, K Chettipalayam, Tiruppur, <br>Tamil Nadu, 641606
    </td>
</tr>
</table>

				<table class="table" style="margin-bottom:-6px;border-bottom:none;">
    <!--tr style="background-color: white; "-->
        <tr style="background-color: white; ">
        <td style="border: none; width: 20%;"><strong>Indent No :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $cost0['order_no'];?></td>
        <td style="border: none; width: 20%;"><strong>Style Code :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $cost0['style_no'];?></td>
                    </tr>
                    <tr style="background-color: white; ">
        <td style="border: none; width: 20%;"><strong>Buyer Name:</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costb['buyer_name'];?></td>
        <td style="border: none; width: 20%;"><strong>Size Group :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costb['size_group'];?></td>
                    </tr>
                    <tr style="background-color: white;border-bottom:none;">
        <td style="border: none; width: 20%;"><strong>Order Qty:</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costb['order_qty'];?></td>
        <td style="border: none; width: 20%;"><strong>Cutting Qty :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costb['cutting_qty'];?></td>
                    </tr>
                    <tr style="background-color: white;border-bottom:none;">
        <td style="border: none; width: 20%;"><strong>Percentage:</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costb['excess_percent'];?></td>
        <td style="border: none; width: 20%;"><strong>Season :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costb['season'];?></td>
                    </tr>
    <!--/tr-->
    
</table>

					<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
    <tr>
            <th style="border: 1px solid; width: 23%;  margin: 0; text-align: center;font-size:18px;" colspan="8">Yarn Purchase</th>
        </tr>
        <tr style="background-color::#FABF8F;" >
           
            <th style="border: 1px solid; width: 25%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Yarn Name</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Content</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Count</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Type</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Color</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Pcs Wgt</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Reruired/kgs</th>
            
            
        </tr>
    </thead>
    <tbody>
    <?php
$sn = 1;
$grant_total1 = 0; // Initialize the grant total

$yarn_master_query = mysqli_query($zconn, "SELECT * FROM yarn_entry_master WHERE order_no = '" . $cost0['order_no'] . "' AND style_no = '" . $cost0['style_no'] . "'");

while ($row = mysqli_fetch_assoc($yarn_master_query)) {
    $yarn_details_query = mysqli_query($zconn, "SELECT * FROM yarn_entry_details WHERE yarn_id = '" . $row['id'] . "'");

    while ($rate1 = mysqli_fetch_assoc($yarn_details_query)) {
        echo '<tr>';
       
        echo '<td style="border: 1px solid; width: 25%; padding: 3px; margin: 0; text-align: center;">' . $rate1['yarn_name'] . '</td>';
        echo '<td style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;">' . $rate1['yarn_content'] . '</td>';
        echo '<td style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;">' . $rate1['yarn_count'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $rate1['yarn_type'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $rate1['yarn_colour'] . '</td>';
        echo '<td style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;">' . $rate1['pcs_weight'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $rate1['yarn_total'] . '</td>';
        echo '</tr>';

        // Update the grant total
        $grant_total1 += $rate1['yarn_total'];
        
    }
}
?>

        <!-- Add the "Total" row after your existing table rows -->
        <tr>
            <td colspan="5" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
          
			 
           <?php echo $grant_total; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo $grant_total1; ?></td>
			
        </tr> 
    </tbody>
</table>
<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;" colspan="8">Knitting Planning</th>
        </tr>
        <tr>
           
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Fabric Name</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Content</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Color</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Dia</th>
            <th style="border: 1px solid; width: 12%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Gsm</th>
            <th style="border: 1px solid; width: 12%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Gauge</th>
            <th style="border: 1px solid; width: 12%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Loop</th>
            <th style="border: 1px solid; width: 20%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Required/kgs</th>
            <th style="border: 1px solid; width: 20%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Knit Loss</th>

            
        </tr>
    </thead>
    <tbody>
    <?php
$sn = 1;
$kn1_query = mysqli_query($zconn, "SELECT * FROM knitting_planning_master WHERE order_no = '" . $cost0['order_no'] . "' AND style_no = '" . $cost0['style_no'] ."'");

while ($kn1 = mysqli_fetch_assoc($kn1_query)) {
    $knit_query = mysqli_query($zconn, "SELECT * FROM knitting_planning WHERE knitt_id = '" . $kn1['id'] . "'");
    
    while ($knit = mysqli_fetch_assoc($knit_query)) {
        echo '<tr>';
        
        echo '<td style="border: 1px solid; width:23%; padding: 3px; margin: 0; text-align: center;">' . $knit['fabric_name'] . '</td>';
        echo '<td style="border: 1px solid; width:15%; padding: 3px; margin: 0; text-align: center;">' . $knit['content'] . '</td>';
        echo '<td style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;">' . $knit['color'] . '</td>';
        echo '<td style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;">' . $knit['f_dia'] . '</td>';
        echo '<td style="border: 1px solid; width: 12%; padding: 3px; margin: 0; text-align: center;">' . $knit['f_gsm'] . '</td>';
        echo '<td style="border: 1px solid; width: 12%; padding: 3px; margin: 0; text-align: center;">' . $knit['Gauge'] . '</td>';
        echo '<td style="border: 1px solid; width: 12%; padding: 3px; margin: 0; text-align: center;">' . $knit['Loop_Length'] . '</td>';
        
        echo '<td style="border: 1px solid; width: 20%; padding: 3px; margin: 0; text-align: center;">' . $knit['wgt'] . '</td>';
        echo '<td style="border: 1px solid; width: 20%; padding: 3px; margin: 0; text-align: center;">' . $knit['knit_loss'] . '</td>';

        echo '</tr>';

        $grant_total_knitting +=$knit['wgt'];
        $knit_loss_total +=$knit['knit_loss'];


    }
}
?>
        <!-- Total row for Knitting Costing -->
        <tr>
            <td colspan="6" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
			
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $grant_total_knitting; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $knit_loss_total; ?></td>

        </tr> 
    </tbody>
</table>
		<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;" colspan="8">Dyeing Planning</th>
        </tr>
        <tr>
           
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Fabric NAme</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Content</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Color</th>
            
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Dia</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Gsm</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Component</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Required/kgs</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Dye Loss</th>

        </tr>
    </thead>
    <tbody>
    <?php
$sn = 1;
$dy1_query = mysqli_query($zconn, "SELECT * FROM dyeing_planning_master WHERE order_no = '" . $cost0['order_no'] . "' AND style_no = '" . $cost0['style_no'] . "'");

while ($dy1 = mysqli_fetch_assoc($dy1_query)) {
    $dye_query = mysqli_query($zconn, "SELECT * FROM dyeing_planning WHERE dye_id = '" . $dy1['id'] . "'");
    
    while ($dye = mysqli_fetch_assoc($dye_query)) {
        echo '<tr>';

        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $dye['fabric_name'] . '</td>';
        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $dye['content'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $dye['ycolor'] . '</td>'; 
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $dye['dia'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $dye['gsm'] . '</td>';
        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $dye['ycomp'] . '</td>';
        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $dye['weight'] . '</td>';
        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $dye['dye_loss'] . '</td>';

        echo '</tr>';


        $grant_total_dyeing += $dye['weight'];
        $dye_loss_total += $dye['dye_loss'];

    }
}
?>



 <!-- Total row for Dyeing Costing -->
 <tr>
            <td colspan="5" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
			
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $grant_total_dyeing; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $dye_loss_total; ?></td>

        </tr> 

       
    </tbody>
</table>

<!-- First Table - Other Process Costing -->
<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
		<tr>
    <th style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;" colspan="8">Other Process Planning</th>
</tr>
        <tr>
          
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Fabric Name</th>
            
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Content</th>
            <th style="border: 1px solid; width: 8%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Color</th>
            <th style="border: 1px solid; width: 8%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Dia</th>
            <th style="border: 1px solid; width: 8%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Gsm</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Process Name</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Component</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Weight</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Other Loss</th>

        </tr>
    </thead>
    <tbody>
    <?php
$op1 = mysqli_query($zconn, "SELECT * FROM process_planning_master WHERE order_no = '" . $cost0['order_no'] . "' AND style_no = '" . $cost0['style_no'] . "'");
$sn = 1;

while ($ppo = mysqli_fetch_assoc($op1)) {
    $id = $ppo['id'];

    // Fetch data from process_planning based on the $id
    $opp = mysqli_query($zconn, "SELECT * FROM process_planning WHERE process_id = '$id'");

    // Loop through the rows in process_planning
    while ($opp_data = mysqli_fetch_assoc($opp)) {
        echo '<tr>';
       
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['fabric_name'] . '</td>';
        
        
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['content'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['ycolor'] . '</td>';    
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['dia'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['gsm'] . '</td>';
        echo '<td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['process_name'] . '</td>';
        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['ycomp'] . '</td>';
        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['wgt'] . '</td>';
        echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">' . $opp_data['process_loss'] . '</td>';

        echo '</tr>';
        $grant_total_other += $opp_data['wgt'];
        $process_loss_total += $opp_data['process_loss'];

    }
}



?>

<!-- Total row for Other Costing -->
<tr>
            <td colspan="6" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
			
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $grant_total_other; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $process_loss_total; ?></td>

        </tr> 

    </tbody>
</table>

<table class="table" style="margin-top: -17px; width: 100%;">
	<tr>
            <td colspan="1" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;"><strong>Fabric Total</strong></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><strong>
				
				<?php
// Assuming you have defined variables like $fab_total, $overhead, $pro_loss, $total_dept1, $total2, $other_cost, $transportation_cost, $rejection, $factory_cost, $others

// Correct the repeated variable name ($rejetion)
$fab_tot = $grant_total_knittingr+$grant_total_dyeing+$grant_total_other;

// Output the rounded total with a currency symbol
echo '₹&nbsp;', round($fab_tot);
?>
				
				</strong></td>
        </tr>
	</table>

<!-- Second Table - Accessories Costing -->
<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
		<tr>
    <th style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;" colspan="8">Accessories Planning</th>
</tr>
        <tr>
            
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Accessories</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Consumption</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">TotalQty</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Loss</th>

            
        </tr>
    </thead>
    <tbody>
        <?php 
        $distinctAccessories = mysqli_query($zconn, "SELECT * FROM accessories_planning_list WHERE order_no = '" . $cost0['order_no'] . "' AND style_no = '" . $cost0['style_no'] . "'");
$sn=1;
while ($acc = mysqli_fetch_assoc($distinctAccessories)) {
    $id = $acc['id'];

    // Fetch data from process_planning based on the $id
    $cca = mysqli_query($zconn, "SELECT * FROM accessories_planning WHERE planning_id = '$id'");

    // Loop through the rows in process_planning
    while ($acc_data = mysqli_fetch_assoc($cca)) {
            echo '<tr>';
			 
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">'.$acc_data['acc_name'].'</td>';
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">'.$acc_data['consumption'].'</td>';
           
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">'.$acc_data['total_qty'].' </td>';
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">'.$acc_data['acc_loss'].' </td>';

           
            echo '</tr>';

			$grant_total_acc += $acc_data['total_qty'];
            $acc_loss_total += $acc_data['acc_loss'];
        }
    }
        ?>


<tr>
            <td colspan="" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
			
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo round($grant_total_acc,2); ?></td>
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo round($acc_loss_total,2); ?></td>

        </tr> 
		
    </tbody>
</table>
<table class="table" style="margin-top: -17px; width: 100%;">
	<tr>
            <td colspan="6" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;"><strong>Over all Total</strong></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><strong>
				
				<?php
// Assuming you have defined variables like $fab_total, $overhead, $pro_loss, $total_dept1, $total2, $other_cost, $transportation_cost, $rejection, $factory_cost, $others

// Correct the repeated variable name ($rejetion)
$ove_tot = $grant_total_knitting+$grant_total_dyeing+$grant_total_other+$grant_total_acc;

// Output the rounded total with a currency symbol
echo '₹&nbsp;', round($ove_tot);
?>
				
				</strong></td>
                <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><strong>
				
				<?php
// Assuming you have defined variables like $fab_total, $overhead, $pro_loss, $total_dept1, $total2, $other_cost, $transportation_cost, $rejection, $factory_cost, $others

// Correct the repeated variable name ($rejetion)
$ove_loss = $knit_loss_total+$dye_loss_total+$process_loss_total+$acc_loss_total;

// Output the rounded total with a currency symbol
echo  $ove_loss;
?>
				
				</strong></td>
                <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><strong>
				
				<?php
// Assuming you have defined variables like $fab_total, $overhead, $pro_loss, $total_dept1, $total2, $other_cost, $transportation_cost, $rejection, $factory_cost, $others

// Correct the repeated variable name ($rejetion)
$all_total = $ove_tot+($ove_tot*$ove_loss/100);

// Output the rounded total with a currency symbol
echo '₹&nbsp;', round($all_total);
?>
				
				</strong></td>
        </tr>
	</table>



						
                <td colspan="3" align="left" valign="top" style="border-right:1px groove black;">
                   <table class="table" style="margin-top: -17px; width: 100%;">
    <tr>
        <td width="25%" height="75px" align="center" valign="bottom" style="border-top: 1px groove black; font-size: 17px; vertical-align: bottom; text-align: center;">Prepared By</td>
        <td width="25%" align="center" valign="bottom" style="border-left: 1px groove black; border-top: 1px groove black; font-size: 17px; vertical-align: bottom; text-align: center;">Received By</td>
        <td width="25%" align="center" valign="bottom" style="border-left: 1px groove black; border-top: 1px groove black; font-size: 17px; vertical-align: bottom; text-align: center;">Verified By</td>
        <td width="25%" align="center" valign="bottom" style="border-left: 1px groove black; border-top: 1px groove black; font-size: 17px; vertical-align: bottom; text-align: center;">Authorized By</td>
    </tr>
</table>

                    <!--/td-->
                    

                    </table>
							
								


  </tbody>
</table>



 
						
				<?php  }?>
				</div>
			</div>
		</div>
				</form>
            <!-- End Container fluid  -->
         <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
  </div>
            <!-- footer -->
           
            <!-- End footer -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
 		<?php //include('includes/footer.php');?>
</body>
</html>