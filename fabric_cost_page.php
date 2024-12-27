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

	  <!--style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px groove black;
        }

        th, td {
            border: none;
            padding: 3px;
			
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .card {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
    </style>
	 <style>
        body {
            font-family: Arial, sans-serif;
        }

        .row {
            display: flex;
        }

        .card {
            margin: 10px;
            padding: 10px;
            border: none;
            background-color: #fff;
        }

        .card-half {
            width: 50%;
        }
    </style-->
	
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
					if($costing_no!=''){ $cost0 = mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$costing_no."'"),MYSQLI_ASSOC);
					$costb = mysqli_fetch_array(mysqli_query($zconn,"select * from buyer_master where  buyer_id='".$cost0['buyer_id']."'"),MYSQLI_ASSOC);
					$coste = mysqli_fetch_array(mysqli_query($zconn,"select * from expenses_costing where costing_id='".$costing_no."'"),MYSQLI_ASSOC);
					$costc = mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_details where  costing_id='".$cost0['buyer_id']."'"),MYSQLI_ASSOC);
					?>
							<table  width="100%" style=" border: 1px groove black;">
																					<tr>
    <th height="20" width="100%" colspan="2" align="center" valign="middle" bgcolor="" style="background-color:#FABF8F;border:1px groove black; color: black;text-align: center"><h3>Pre Budget: 
    </h3></th>
  </tr>
								<table  style="border: 1px groove black;width:100%;border-bottom:none;border-top:none;" >
  <tr>
    <td width="40%" align="left" valign="top"
        style="padding-left:10px; padding-top:5px; padding-bottom:5px; font-size:17px;">
        <img src="assets/images/LOGO VAMAN EXPORTS .png
" alt="Your Company Logo" style="max-width: 500px; height: 100px;"><br>
    </td>
  <td width="60%" align="center" valign="top"
        style="padding-left:0px; padding-top:10px; padding-bottom:10px; font-size:17px;text-align:center;">
       2	SF NO.355/B1 - A, VIVID GARDEN,  Dharapuram Tiruppur Road, Government Adi Dravidar Welfare High School, KOVIL VAZHI, K Chettipalayam, Tiruppur, <br>Tamil Nadu, 641606
 

    
    </td>
</tr>
</table>

				<table class="table">
    <tr style="background-color: white; ">
        <td style="border: none; width: 20%;"><strong>Costing No :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $cost0['costing_no'];?></td>
        <td style="border: none; width: 20%;"><strong>Style Code :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $cost0['style_no'];?></td>
    </tr>
    <tr style="background-color: white;">
        <td style="border: none; width: 20%;"><strong>Buyer Name :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costb['buyer_name'];?></td>
		 <td style="border: none; width: 20%;"><strong>Indent No :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $cost0['order_no'];?></td>
      
    </tr>
					   <tr style="background-color: white;border-bottom:none;">
        <td style="border: none; width: 20%;"><strong>Brand Name :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costc['brand'];?></td>
        <td style="border: none; width: 20%;"><strong>Gold Seal No :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $cost0['goldseal_no'];?></td>
    </tr>
    <tr style="background-color: white;border-bottom:none;">
        <td style="border: none; width: 20%;"><strong>Sub Brand name :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costc['sub_brand'];?></td>
          <td style="border: none; width: 20%;"><strong>Date :</strong></td>
        <td style="border: none; width: 30%;">
            <?php $dat_arr = explode("-", $cost0['costing_date']);
            echo $dat_arr['2']."-".$dat_arr['1']."-".$dat_arr['0'];
            ?>
        </td>
    </tr>
					<tr style="background-color: white;border-bottom:none;">
        <td style="border: none; width: 20%;"><strong>season :</strong></td>
        <td style="border: none; width: 30%;"><?php echo $costc['season'];?></td>
        
    </tr>
</table>

					<table class="table" style="margin-top: -17px; width: 100%;">
    <thead style="">
        <tr style="background-color:#FABF8F;" >
           
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Particulars</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Fabric name</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Fabric colour</th>
			
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Yarn Name</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Yarn Content</th>
            <th style="border: 1px solid; width: 25%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Yarn Count</th>
            <th style="border: 1px solid; width: 25%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Yarn Type</th>
			 <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">PCS.WEIGHT</th>
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Rate/kgs</th>
			
            <th style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Rate/pcs</th>
        </tr>
    </thead>
    <tbody>
  <?php
$costDetails = mysqli_query($zconn, "SELECT * FROM costing_entry_details WHERE costing_id='" . $costing_no . "'");
if ($costDetails->num_rows > 0) {
    $uniqueFabrics = mysqli_query($zconn, "SELECT  DISTINCT fabric_name FROM costing_entry_details WHERE costing_id='" . $costing_no . "' AND fabric_name!=''");
    $totalFabricsCount = mysqli_fetch_array(mysqli_query($zconn, "SELECT COUNT(DISTINCT fabric_name) AS fab_count FROM costing_entry_details WHERE costing_id='" . $costing_no . "' AND fabric_name!=''"), MYSQLI_ASSOC);
    $totalFabrics = $totalFabricsCount['fab_count'];
    $totalWidth = 75;
    $widthPerFabric = ($totalWidth / $totalFabrics);
    $sn = 1;

    while ($uniqueFabric = mysqli_fetch_array($uniqueFabrics, MYSQLI_ASSOC)) {
        $fabricName = $uniqueFabric['fabric_name'];
        $fabricDetails = mysqli_query($zconn, "SELECT * FROM costing_entry_details WHERE costing_id='" . $costing_no . "' AND fabric_name='" . $fabricName . "' AND fabric_name!=''");

        while ($res_cost_det = mysqli_fetch_array($fabricDetails, MYSQLI_ASSOC)) {
            
?>
        <tr>
            
            <td style="border: 1px solid; width: 30%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['comp_id']; ?></td>
            <td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['fabric_name']; ?></td>
			                      <td style="border: 1px solid; width: 10%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['f_color']; ?></td>


            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['yarn_name']; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['yarn_content']; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['yarn_count']; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['yarn_type']; ?></td>
			 <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo $res_cost_det['pcs_weight']; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo '₹&nbsp;', $res_cost_det['yarn_rate']; $grant_total += $rate['yarn_rate']; ?></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><?php echo '₹&nbsp;', $res_cost_det['yarn_total']; $grant_total1 += $res_cost_det['yarn_total']; ?></td>
        </tr>
<?php
    }
}
}
?>


        <!-- Add the "Total" row after your existing table rows -->
        <tr>
            <td colspan="8" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
          
			 
            <!--td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $grant_total; ?></td-->
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><b><?php echo '₹&nbsp;', $grant_total1; ?><b></td>
			
        </tr>
    </tbody>
</table>

<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;" colspan="8">Fabric Costing</th>
        </tr>
        <tr>
            
            <th style="border: 1px solid; width: 33%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Fabric Name</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Content</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Colour</th>
            <th style="border: 1px solid; width: 15%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">GSM</th>

            <th style="border: 1px solid; width: 33%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Rate</th>
        </tr>
    </thead>
    <tbody>
    <?php
$sn = 1;
$grant_total_knitting = 0;
$grant_total_knitting1 = 0;
$cost_de = mysqli_fetch_array(mysqli_query($zconn, "SELECT * FROM fabric_costing WHERE costing_no='" . $costing_no . "' AND fabric_name!=''"), MYSQLI_ASSOC);
//var_dump($cost_de);
$COSTNO = $cost_de['costing_no'];
if ($COSTNO != '') {
    $cost_det = mysqli_query($zconn, "SELECT * FROM fabric_costing WHERE costing_no='" . $costing_no . "'");
    while ($res_cost_det = mysqli_fetch_array($cost_det, MYSQLI_ASSOC)) {
        // Fetching comp_id based on the current row from knit_costing with a specific rate condition
        $rateCondition = $res_cost_det['rate_per_pc']; // Use rate_per_pc as condition
        $compIdQuery = mysqli_query($zconn, "SELECT * FROM costing_entry_details WHERE costing_id='" . $res_cost_det['costing_no'] . "' AND fabric_name!='' AND rate_per_pc=" . $rateCondition);
        $compIds = [];
        while ($compIdResult = mysqli_fetch_array($compIdQuery, MYSQLI_ASSOC)) {
            // Collect all comp_id values into an array
            $compIds[] = $compIdResult['comp_id'];
        }
?>
        <tr>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">
            <?php
                echo 
                 $res_cost_det['fabric_name'];
                
                ?>
            </td>
          
            
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">
                <?php
                echo  $res_cost_det['fab_content'];
                
                ?>
            </td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">
                <?php
                echo $res_cost_det['fab_colour'];
                
                ?>
            </td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">
            <?php
                echo 
                 $res_cost_det['fab_gsm'];
                
                ?>
            </td>
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;">
                <?php
                echo '₹&nbsp;', $res_cost_det['fab_rate'];
                ?>
            </td>
        </tr>
<?php
        $grant_total_knitting += $res_cost_det['fab_rate'];
        $sn++;
    }
}
?>

        

        <!-- Total row for Knitting Costing -->
        <tr>
            <td colspan="3" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
			
            <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><b><?php echo '₹&nbsp;', $grant_total_knitting; ?><b></td>
        </tr>
    </tbody>
</table>

		
<!-- First Table - Other Process Costing -->
<table class="table" style="margin-top: -17px; width: 100%;">
	<tr>
            <td colspan="1" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;"><strong>Fabric Total</strong></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><strong><?php echo '₹&nbsp;',$fab_total=$grant_total1+$grant_total_knitting+$total_rate1+$total_2; ?></strong></td>
        </tr>
	</table>
<!-- Second Table - Accessories Costing -->
<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
		<tr>
    <th style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;font-size:18px;" colspan="8">Accessories Costing</th>
</tr>
        <tr>
           
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Accessories</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Consumption</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Rate</th>

        </tr>
    </thead>
    <tbody>
        <?php 
        $distinctAccessories = mysqli_query($zconn, "SELECT DISTINCT * FROM accessories_costing WHERE costing_no='".$costing_no."'");
$sn=1;
        while($acc_cost_det = mysqli_fetch_array($distinctAccessories, MYSQLI_ASSOC)) {
            $cost_ass = mysqli_fetch_array(mysqli_query($zconn, "SELECT SUM(total) AS total FROM accessories_costing WHERE costing_no='".$costing_no."' AND acc_name='".$acc_cost_det['acc_name']."'"));

            echo '<tr>';
			  
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">'.$acc_cost_det['acc_name'].'</td>';
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">'.$acc_cost_det['consumption'].'</td>';
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp;'.$acc_cost_det['rate'].' </td>';
            echo '</tr>';
			$sn++;
			$total1 += $acc_cost_det['consumption'];
			$total2 += $acc_cost_det['rate'];
        }
        ?>
		 <tr>
            <td colspan="1" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;"><strong>Total</strong></td>
			 <!--	<td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><?php echo $total1; ?></td> -->
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><strong><?php echo '₹&nbsp;', $total2; ?></strong></td>
        </tr>
    </tbody>
</table>

<!-- Third Table - Department Costing -->
<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
		<tr>
    <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;" colspan="8">Department Costing</th>
</tr>
        <tr>
            
			
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Particulars</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Rate</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $distinctDepartments = mysqli_query($zconn, "SELECT DISTINCT * FROM department_costing WHERE costing_no='".$costing_no."'");
$sn=1;
        while($dept_cost_det = mysqli_fetch_array($distinctDepartments, MYSQLI_ASSOC)) {
            $cost_dept = mysqli_fetch_array(mysqli_query($zconn, "SELECT SUM(rate) AS total FROM department_costing WHERE costing_no='".$costing_no."' AND dept_name='".$dept_cost_det['dept_name']."'"));

            echo '<tr>';
			 
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">'.$dept_cost_det['dept_name'].' </td>';
		
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp;'.number_format($cost_dept['total'], 2).' </td>';
            echo '</tr>';
			$sn++;
			$total_dept1 +=$cost_dept['total']; 
        }
        ?>
		 <tr>
           
			 <td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><strong>Total</strong></td> 
			 
			<td style="border: 1px solid; width: 23%; padding: 5px; margin: 0; text-align: center;"><strong><?php echo '₹&nbsp;',$total_dept1; ?><strong></td> 
           
        </tr>
    </tbody>
</table>



<!-- Fifth Table - Expenses Costing -->
<table class="table" style="margin-top: -17px; width: 100%;">
    <!--thead>
        <tr>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; ">Expenses Costing</th>
        </tr>
    </thead-->
    <tbody>
        <?php 
        $cost_ass = mysqli_query($zconn, "SELECT * FROM expenses_costing1 WHERE costing_no='".$costing_no."'");

        while($fabric = mysqli_fetch_array($cost_ass, MYSQLI_ASSOC)) {
            $totexpenses = $fabric['overhead'] + $fabric['process_profit'] + $fabric['process_loss'] - $fabric['rejection'];
            $grant_tot = ($grant_total * $totexpenses) / 100;
            $loss = $fabric['commission'] + $fabric['farwarding_charges'];
            $grandt_to0 = $grant_tot + $loss;
            $grandt_tot = $grandt_to0 / $cost_de['order_qty'];

            echo '<tr>';
          //  echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($grandt_tot, 2).'</td>';
            echo '</tr>';
        }
        ?>
  

<!-- Total Cost Table -->
<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
        <tr>
			
            <th colspan="7" style="border: 0px solid;border-left:none; width: 33%; padding: 3px; margin: 0; text-align: center;"></th>
	
			
			<th colspan="" style="border: 1px solid; border-left:none; width: 42%; padding: 3px; margin: 0; text-align: center;font-size:18px;">Total Cost(per pcs)</th>
			<?php $over_total=$grant_total1 + $grant_total_knitting+$total_rate1+$total_2+$total2+$total_dept1?>
            <th colspan="<?php echo $countf; ?>" style="border: 1px solid; text-align: center;"><?php echo '₹&nbsp;',$over_total; ?>
</th>
        </tr>
    </thead>
</table>
		
		<!-- Fifth Table - Expenses Costing -->
<table class="table" style="margin-top: -17px; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; ">Expenses Costing</th>
        </tr>
		        <tr>
            
			
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Process Loss</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Rejection </th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Over head  </th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Margin</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Other Cost</th>
            <!--th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Packing Trim Cost</th-->
					
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Ex-Factory Cost</th>
            <th style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;background-color:#FABF8F;">Transportation Cost</th>
					
					
					
    </thead>
    <tbody>
        <?php 
        $cost_ass = mysqli_query($zconn, "SELECT * FROM expenses_costing1 WHERE costing_no='".$costing_no."'");

        while($fabric = mysqli_fetch_array($cost_ass, MYSQLI_ASSOC)) {
			 $pro_loss = $fab_total * $fabric['process_loss'] / 100;

			$rejection= ($pro_loss+$over_total)*$fabric['rejection']/100;
			$overhead= ($pro_loss+$over_total)*$fabric['over_head']/100;
			$others=($pro_loss+$overhead+$over_total)*$fabric['compos']/100;
			
            $totexpenses = $fabric['overhead'] + $fabric['process_profit'] + $fabric['process_loss'] - $fabric['rejection'];
            $grant_tot = ($grant_total * $totexpenses) / 100;
            $loss = $fabric['commission'] + $fabric['farwarding_charges'];
            $grandt_to0 = $grant_tot + $loss;
            $grandt_tot = $grandt_to0 / $cost_de['order_qty'];
			$other_cost=$overhead+$rejection+$others;
				$factory_cost=$fabric['factory_cost'];
				$transportation_cost=$fabric['transportation_cost'];
			
			$ove_tot1 = $fab_total + $total2 + $total_dept1 + $other_cost + $pro_loss;

            echo '<tr>';
            echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($pro_loss, 2).'</td>';
			 echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($rejection, 2).'</td>';
				 echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($overhead, 2).'</td>';
			echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($others, 2).'</td>';
			echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($other_cost,2).'</td>';
			//echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($fabric['factory_cost'], 2).'</td>';
			echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($ove_tot1, 2).'</td>';
			echo '<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;">₹&nbsp'.number_format($fabric['transportation_cost'], 2).'</td>';
            echo '</tr>';
        }
        ?>

		</table>
		
		
		<table class="table" style="margin-top: -17px; width: 100%;">
	<tr>
            <td colspan="1" style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"></td>
			<td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;font-size:18px;"><strong>Over all Total</strong></td>
            <td style="border: 1px solid; width: 23%; padding: 3px; margin: 0; text-align: center;"><strong>
				
				<?php
// Assuming you have defined variables like $fab_total, $overhead, $pro_loss, $total_dept1, $total2, $other_cost, $transportation_cost, $rejection, $factory_cost, $others

// Correct the repeated variable name ($rejetion)
$ove_tot = $fab_total + $total2 + $total_dept1 + $other_cost + $transportation_cost+$pro_loss;

// Output the rounded total with a currency symbol
echo '₹&nbsp;', round($ove_tot);
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