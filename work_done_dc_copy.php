<?php 
// Report all errors
error_reporting(E_ALL);
include('includes/config.php');

if($_SESSION['userid']==''){
    echo "<script>window.location.href='login.php';</script>";
}

?>
<!DOCTYPE html>
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
    <title><?php echo SITE_TITLE;?> - Work done DC IN</title>
    <!-- Custom CSS -->
    <!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <style>
    th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
    </style>
</head>

<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">WorkDone DC IN</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <form method="post">
            <div class="container-fluid">               
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12" >
                                        <div class="col-sm-6" style="float:left; left: 50px; ">
												
                                        <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;DC No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="dc_no" id="order" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select distinct dc_no from production_dc where 1 group by id");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
                                                $order[]=$res_buyer['dc_no'];
                                             ?>
                                            <option value="<?php echo $res_buyer['dc_no'];?>" <?php if ( $res_buyer['dc_no']==$_REQUEST['dc_no']){?> selected="selected" <?php } ?>
                                                
                                            ><?php echo $res_buyer['dc_no'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Order No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="order" id="order" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from production_dc where  dc_no='".$_REQUEST['dc_no']."'");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
                                                $order[]=$res_buyer['order_no'];
                                             ?>
                                            <option value="<?php echo $res_buyer['order_no'];?>" <?php if ( $res_buyer['order_no']==$_REQUEST['order']){?> selected="selected" <?php } ?>
                                                
                                            ><?php echo $res_buyer['order_no'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Style No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="style" id="style" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from production_dc where  order_no='".$_REQUEST['order']."'");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ $fabrc=$res_buyer['style_no']; ?>

                                            <option value="<?php echo $res_buyer['style_no'];?>" <?php if ($res_buyer['style_no']==$_REQUEST['style']) {?> selected="selected" <?php
                                                
                                            }?> ><?php echo $res_buyer['style_no'];?></option>

                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="from" class="col-sm-3 text-right control-label col-form-label">&nbsp;Deparment</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="from" id="from" onchange="this.form.submit();">
                                            <option value="0">Select</option>

                                           
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from department_master where 1 AND NOT dept_name='fabric Inward'   group by dept_name ");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>

                                            <option value="<?php echo $res_buyer['dept_name'];?>" 
                                                <?php if ($res_buyer['dept_name']==$_REQUEST['from']){?> selected="selected" <?php } ?>
                                                ><?php echo $res_buyer['dept_name'];?>
                                                    

                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>               
                                </div>

                                <div class="card" style="width:50%; float:left; right: 50px;">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Party Dc No</label>
                                        <div class="col-sm-6">
                                            <!--?php $select=mysqli_num_rows(mysqli_query($zconn,"select * from production_dc")); 
                                            $id=$select+1;?-->
                                            <input type="text" name="party_dc_no" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">DC Out Date</label>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="dc_out_date" name="dc_out_date" autocomplete="off" required>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Contractor</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="to_contractor" id="to_contractor" >
                                            <option value="0">Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from contractors group by con_name");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
                                            <option value="<?php echo $res_buyer['con_name'];?>" 
                                                <?php if ($res_buyer['con_name']==$_REQUEST['to_contractor']){?> selected="selected" <?php } ?>
                                                ><?php echo $res_buyer['con_name'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                            </div>
                                    
                                    
                                </div>


                              
                            
                            
                                <?php 
                            
                            if ($_REQUEST['from']!='' && $_REQUEST['from']!='0'){
                                    ?> 
                                    
 <div class="table-responsive">
    <div class="col-8 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Planning Quantity Details</h5>
    </div>
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">S.NO</th>
                <!--th style="width: 10%">ORDER NO</th-->
                <?php
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();

                $sectBrnQry = "SELECT DISTINCT size_id FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueSizeIds[] = $coldata['size_id'];
                }

                // Create table headers for color names
                echo '<th style="width: 10%">Color</th>';

                // Create table headers for each size ID
                foreach ($uniqueSizeIds as $sizeId) {
                    echo '<th>' . $sizeId . '</th>';
                }

                // Add total column header
                echo '<th>Total</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;

            // Initialize arrays to store color-wise totals
            $colorTotals = array();

            // Retrieve unique colors for the selected order_no
            $uniqueColors = array();

            $sectBrnQry = "SELECT DISTINCT color FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);

            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $uniqueColors[] = $coldata['color'];
            }

            // Create an array to store color-wise quantities for each size ID
            $colorQuantities = array();

            foreach ($uniqueSizeIds as $sizeId) {
                $colorQuantities[$sizeId] = array();
            }

            // Retrieve and organize the color-wise quantities for each size ID
            $sectBrnQry = "SELECT * FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);

            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $colorQuantities[$coldata['size_id']][$coldata['color']] = $coldata['qty_val'];
            }
								// Initialize the grand total
$grandTotal = 0;

            // Loop through the colors and display quantities for each size ID in rows
            foreach ($uniqueColors as $color) {
                echo '<tr>';
                echo '<td style="width: 2%">' . $i . '</td>';
               // echo '<td style="width: 10%">' . $_REQUEST['order'] . '</td>';
                echo '<td>' . $color . '</td>';

                // Initialize the color-wise total for this row
                $colorTotal = 0;

                // Loop through unique size IDs and display quantities for each color
                foreach ($uniqueSizeIds as $sizeId) {
                    $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;
                    echo '<td>' . $quantity . '</td>';

                    // Add the quantity to the color-wise total for this row
                    $colorTotal += $quantity;
					  
                }

                // Display the color-wise total for this row
                echo '<td>' . $colorTotal . '</td>';
// Add the color-wise total to the grand total
    $grandTotal += $colorTotal;
                echo '</tr>';
                $i++;
            }
								// Display the grand total row
echo '<tr>';
echo '<td colspan="' . (count($uniqueSizeIds) + 2) . '">Grand Total</td>';
echo '<td>' . $grandTotal . '</td>';
echo '</tr>';
            ?>
        </tbody>
    </table>
</div>
										
										
                                        
                                        
                                <div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Work Done Quantity Details</h5>
    </div>
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">S.NO</th>
                <!--th style="width: 10%">ORDER NO</th-->
                <?php
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();

                $sectBrnQry = "SELECT DISTINCT size_id FROM cutting_balance WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueSizeIds[] = $coldata['size_id'];
                }

                // Create table headers for color names
                echo '<th style="width: 10%">Color</th>';

                // Create table headers for each size ID
                foreach ($uniqueSizeIds as $sizeId) {
                    echo '<th>' . $sizeId . '</th>';
                }

                // Add total column header
                echo '<th>Total</th>';
                ?>
            </tr>
        </thead>
        <tbody>
           <?php
$i = 1;

// Initialize arrays to store color-wise totals
$colorTotals = array();

// Retrieve unique colors for the selected order_no
$uniqueColors = array();

$sectBrnQry = "SELECT DISTINCT color FROM cutting_balance WHERE order_no='" . $_REQUEST['order'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $uniqueColors[] = $coldata['color'];
}

// Create an array to store color-wise quantities for each size ID
$colorQuantities = array();

foreach ($uniqueSizeIds as $sizeId) {
    $colorQuantities[$sizeId] = array();
}

// Retrieve and organize the color-wise quantities for each size ID
$sectBrnQry = "SELECT * FROM cutting_balance WHERE order_no='" . $_REQUEST['order'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $colorQuantities[$coldata['size_id']][$coldata['color']] = isset($colorQuantities[$coldata['size_id']][$coldata['color']]) ?
        $colorQuantities[$coldata['size_id']][$coldata['color']] + $coldata['qty_val'] : $coldata['qty_val'];
}

// Initialize the grand total
$grandTotal = 0;

// Loop through the colors and display quantities for each size ID in rows
foreach ($uniqueColors as $color) {
    echo '<tr>';
    echo '<td style="width: 2%">' . $i . '</td>';
    echo '<td>' . $color . '</td>';

    // Initialize an array to store size-wise totals for this color
    $sizeTotals = array();

    foreach ($uniqueSizeIds as $sizeId) {
        $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;

        // Display the quantity in a table cell
        echo '<td>' . $quantity . '</td>';

        // Add the quantity to the size-wise total for this color
        if (!isset($sizeTotals[$sizeId])) {
            $sizeTotals[$sizeId] = 0;
        }
        $sizeTotals[$sizeId] += $quantity;
    }

    // Loop through unique size IDs and display the size-wise totals
    foreach ($uniqueSizeIds as $sizeId) {
      //  echo '<td>' . $sizeTotals[$sizeId] . '</td>';
    }

    // Finally, display the color-wise total for this row
    echo '<td>' . array_sum($sizeTotals) . '</td>';
    echo '</tr>';
    $i++;
}

// Display the grand total row
echo '<tr>';
echo '<td colspan="' . (count($uniqueSizeIds) + 2) . '">Grand Total</td>';

// Calculate the grand total based on size-wise totals
$grandTotal = 0;
foreach ($uniqueSizeIds as $sizeId) {
    $sizeTotal = array_reduce($uniqueColors, function ($carry, $color) use ($colorQuantities, $sizeId) {
        $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;
        return $carry + $quantity;
    }, 0);
  //  echo '<td>' . $sizeTotal . '</td>';
    $grandTotal += $sizeTotal;
}

// Display the overall grand total
echo '<td>' . $grandTotal . '</td>';
echo '</tr>';
?>

        </tbody>
    </table>
</div>
										
<div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Balance Quantity Details</h5>
    </div>
 
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">S.NO</th>
                <th style="width: 10%">Color</th>
                <?php
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();
                $sectBrnQry = "SELECT DISTINCT size_id FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);
                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueSizeIds[] = $coldata['size_id'];
                }
                // Create table headers for each size ID
                foreach ($uniqueSizeIds as $sizeId) {
                    echo '<th style="width: 5%">' . $sizeId . '</th>';
                }
                // Add a heading for the "Total" column and increase its width
                echo '<th style="width: 10%">Total</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            // Initialize an array to store color-wise totals
            $colorTotals = array();
            // Retrieve unique colors for the selected order_no
            $uniqueColors = array();
            $sectBrnQry = "SELECT DISTINCT color FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $uniqueColors[] = $coldata['color'];
            }
            // Initialize an array to store the 'bal_qty' for each order, color, and size combination
            $balQtyData = array();
            // Retrieve and organize data from cutting_quantity_details
            $cuttingQuantityData = array();
            $sectBrnQry = "SELECT order_no, color, size_id, qty_val FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $cuttingQuantityData[$coldata['order_no']][$coldata['color']][$coldata['size_id']] = $coldata['qty_val'];
            }
            // Retrieve and organize data from cutting_balance
            $cuttingBalanceData = array();
            $sectBrnQry = "SELECT order_no, color, size_id, SUM(qty_val) AS total_qty FROM cutting_balance WHERE order_no='" . $_REQUEST['order'] . "' GROUP BY order_no, color, size_id";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $cuttingBalanceData[$coldata['order_no']][$coldata['color']][$coldata['size_id']] = $coldata['total_qty'];
            }
            // Loop through the colors and display quantities for each size ID in rows
            foreach ($uniqueColors as $color) {
                echo '<tr>';
                echo '<td style="width: 2%">' . $i . '</td>';
                echo '<td>' . $color . '</td>';
                // Initialize the color-wise total for this row
                $colorTotal = 0;
                // Loop through unique size IDs and create input fields for each color and size combination
                foreach ($uniqueSizeIds as $sizeId) {
                    // Calculate 'bal_qty' for this order, color, and size combination
                    $cuttingQuantity = isset($cuttingQuantityData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingQuantityData[$_REQUEST['order']][$color][$sizeId] : 0;
                    $cuttingBalance = isset($cuttingBalanceData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingBalanceData[$_REQUEST['order']][$color][$sizeId] : 0;
                    $balQty = $cuttingQuantity - $cuttingBalance;
                    $balQtyData[$_REQUEST['order']][$color][$sizeId] = $balQty;
                    // Display 'bal_qty' in the table
                    echo '<td>' . $balQty . '</td>';
                }
                // Display the color-wise total for this row
                echo '<td>' . $colorTotal . '</td>';
                echo '</tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Enter  Quantity Details</h5>
    </div>

    
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 5%">S.NO</th>
                    <th style="width: 10%">Color</th>
                    <?php
                    // Create table headers for each size ID
                    foreach ($uniqueSizeIds as $sizeId) {
                        // Decrease the column width for sizes
                        echo '<th style="width: 5%">' . $sizeId . '</th>';
                    }
                    // Add a heading for the "Total" column and increase its width
                    echo '<th style="width: 10%">Total</th>';
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
               $i = 1;
$colorTotals = array();
$insertData = array();

foreach ($uniqueColors as $color) {
    echo '<tr>';
    echo '<td style="width: 2%">' . $i . '</td>';
    echo '<td>' . $color . '</td>';

    $colorTotal = 0;

    foreach ($uniqueSizeIds as $sizeId) {
        // Calculate 'bal_qty' for this order, color, and size combination
        $cuttingQuantity = isset($cuttingQuantityData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingQuantityData[$_REQUEST['order']][$color][$sizeId] : 0;
        $cuttingBalance = isset($cuttingBalanceData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingBalanceData[$_REQUEST['order']][$color][$sizeId] : 0;
        $balQty = $cuttingQuantity - $cuttingBalance;
        $balQtyData[$_REQUEST['order']][$color][$sizeId] = $balQty;

        // Check if balQty is 0 for this sizeId
        if ($balQty == 0) {
            $isReadOnly = 'readonly'; // Set as readonly if balQty is 0
        } else {
            $isReadOnly = ''; // Not readonly if balQty is not 0
        }

        // Create a unique inputName for each input field
        $inputName = 'qty[' . $color . '][' . $sizeId . ']';

        // Display the input field
        echo '<td><input type="text" style="width: 100%" class="form-control" name="' . $inputName . '" value="" ' . $isReadOnly . ' onkeyup="updateColorTotal(\'' . $color . '\')" /></td>';

                        // Store the data for database insertion
                        $insertData[] = array(
                            'style_no' => $_REQUEST['style'],
                            'order_no' => $_REQUEST['order'],
							'dc_no' => $_REQUEST['dc_no'],
                            'party_dc_no' => $_POST['party_dc_no'],
                            'to_contractor' => $_POST['to_contractor'],
                            'from' => $_POST['from'],
                            'dc_out_date' => $_POST['dc_out_date'],
                            'size_id' => $sizeId,
                            'color' => $color,
                            'qty_val' => isset($_POST['qty'][$color][$sizeId]) ? (int)$_POST['qty'][$color][$sizeId] : 0
                        );
                        // Calculate the color-wise total within this loop
                        $colorTotal += isset($_POST['qty'][$color][$sizeId]) ? (int)$_POST['qty'][$color][$sizeId] : 0;
                    }
                    // Display the color-wise total for this row
                    echo '<td><span class="color-total" id="' . $color . '-total">' . $colorTotal . '</span></td>';
                    // Store the color-wise total in the array
                    $colorTotals[$color] = $colorTotal;
                    echo '</tr>';
                    $i++;
                }
								
									if ($_SERVER["REQUEST_METHOD"] == "POST") {
								
if (isset($_POST['save'])) {
	
    // Insert data into the database
    if (!empty($insertData)) {
		
        foreach ($insertData as $data) {
            $style_no = mysqli_real_escape_string($zconn, $data['style_no']);
            $order_no = mysqli_real_escape_string($zconn, $data['order_no']);
            $party_dc_no = mysqli_real_escape_string($zconn, $data['party_dc_no']);
            $to_contractor = mysqli_real_escape_string($zconn, $data['to_contractor']);
            $from = mysqli_real_escape_string($zconn, $data['from']);
            $dc_date = mysqli_real_escape_string($zconn, $data['dc_out_date']);

            $size_id = mysqli_real_escape_string($zconn, $data['size_id']);
            $color = mysqli_real_escape_string($zconn, $data['color']);
            $qty_val = (int)$data['qty_val'];

            // Calculate the bal_qty (you need to add the calculation logic here)
            $bal_qty = 0; // Replace this with your calculation logic

            // If the user is logged in, retrieve the UNAME from the database
            $user_id = $_SESSION['userid']; // Assuming 'userid' is the session variable that stores the user's ID

            // Query to retrieve the UNAME from the 'users' table
            $unameQuery = "SELECT UNAME FROM users WHERE USERID = '$user_id'";
            $result = mysqli_query($zconn, $unameQuery);
if ($balQty > 0) {
    // Retrieve and set session variable
    $uname = ''; // Initialize $uname
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uname = $row['UNAME'];
    }

    // Set the 'session_entry' session variable with the retrieved UNAME
    $_SESSION['session_entry'] = $uname;

    // Create and execute the INSERT query
    $insertQuery = "INSERT INTO cutting_balance (`style_no`, `order_no`, `party_dc_no`, `to_contractor`, `from`, `dc_out_date`, `size_id`, `color`, `qty_val`, `bal_qty`, `session_entry`) 
                    VALUES ('$style_no', '$order_no', '$party_dc_no', '$to_contractor', '$from', '$dc_date', '$size_id', '$color', '$qty_val', '$balQty', '$uname')";

    $result = mysqli_query($zconn, $insertQuery);
    if (!$result) {
        // Log the error for reference
        error_log("Error: " . mysqli_error($zconn));
        die("An error occurred while inserting data.");
    }
} else {
    // Display a JavaScript alert as a warning
    echo '<script>alert("Warning: Stock is not positive. Data not inserted.");</script>';
}
		
		
}

	}
}
								
								}
							
						

								
                ?>
            </tbody>
        </table>
       
    
</div>


                                        <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success" >Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </div>

                                    </div>
                                       
                                    <?php }
                                
                            
                            ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->
            </div>
                          
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
</form> 
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
		
		
		
		
		
		
		
		
		
		
		
<script>
function updateColorTotal(color) {
    var inputs = document.querySelectorAll('[name*="' + color + '"]');
    var total = 0;

    inputs.forEach(function(input) {
        total += parseInt(input.value) || 0;
    });

    var colorTotal = document.getElementById(color + '-total');
    colorTotal.innerText = total;
    
    // Recalculate the grand total when any quantity input changes
    var grandTotalElement = document.getElementById('grand-total');
    var allColorTotalElements = document.querySelectorAll('.color-total'); // Select all color total elements

    var grandTotal = 0;

    allColorTotalElements.forEach(function(element) {
        grandTotal += parseInt(element.innerText) || 0;
    });

    grandTotalElement.innerText = grandTotal;
}

// Attach the updateColorTotal function to the "onkeyup" event of all quantity inputs
var allQuantityInputs = document.querySelectorAll('input[name^="qty"]');
allQuantityInputs.forEach(function(input) {
    input.addEventListener('keyup', function() {
        var color = input.getAttribute('name').match(/\[(.*?)\]/)[1];
        updateColorTotal(color);
    });
});
</script>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--datatables JavaScript -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('.delivery_wgt').keyup(function () {
    var sum = 0;
    $('.delivery_wgt').each(function() {
        sum += Number($(this).val());
    });
     
 
    $('#total').val(sum);
     
});

    $(document).ready(function() {
    $('#example').DataTable();
    } );
    function DeleteUsrId(ID){
      var UsrStatus = confirm("Are you sure to delete this company details ?");
      if(UsrStatus){
      $('#delete_'+ID).hide();
      }
      }
    </script>   

</body>
</html>