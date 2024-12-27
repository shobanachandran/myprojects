<?php
error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('includes/config.php');

if ($_SESSION['userid'] == '') {
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
    <title><?php echo SITE_TITLE;?> - Work assign	</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">  
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <style>
    th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
    </style>  
	 <style>
        /* CSS for the container */
        .scroll-container {
            width: 100%; /* Set the width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
        }
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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Work assign</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Work Assign</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
			<div class="container-fluid">               
                <!-- ============================================================== -->
                <!-- Sales chart -->
               <form name="fabric_dc_out" method="post">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="width:100%">
                                <div class="card" style="width:50%; float:left; left: 50px; ">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Order No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="order" id="order" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"SELECT * FROM process_production1 WHERE   sent_to = 'To_Production' AND status = 'Accept' ");
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
                                            <?php $sel_buyer = mysqli_query($zconn,"SELECT  * FROM process_production1 WHERE   sent_to = 'To_Production' AND status = 'Accept' AND  order_no='".$_REQUEST['order']."'");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ $fabrc=$res_buyer['style_no']; ?>

                                            <option value="<?php echo $res_buyer['style_no'];?>" <?php if ($res_buyer['style_no']==$_REQUEST['style']) {?> selected="selected" <?php
                                                
                                            }?> ><?php echo $res_buyer['style_no'];?></option>

                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>

<div class="form-group row">
    <label for="from" class="col-sm-3 text-right control-label col-form-label">&nbsp;Department</label>
    <div class="col-sm-6">
        <form method="POST" action="dept_process.php">
            <select class="select2 form-control custom-select" name="from" id="from" onchange="this.form.submit();">
                <option value="0">Select</option>
                <?php
                $sel_buyer = mysqli_query($zconn, "SELECT DISTINCT dept_name FROM department_master WHERE dept_name != 'fabric Inward'");
                while ($res_buyer = mysqli_fetch_array($sel_buyer, MYSQLI_ASSOC)) {
                    $selected = ($res_buyer['dept_name'] == $_REQUEST['from']) ? 'selected="selected"' : '';
                    echo '<option value="' . $res_buyer['dept_name'] . '" ' . $selected . '>' . $res_buyer['dept_name'] . '</option>';
                }
                ?>
            </select>
        </form>
    </div>
</div>
                               </div>

                                <div class="card" style="width:50%; float:left; right: 50px;">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Dc No</label>
                                       <div class="col-sm-6">
                                       <?php
    // Get the maximum dc_no from production_dc
    $selectProductionDC = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM production_dc"));
    $id_production_dc = $selectProductionDC['id'];

    // Get the maximum dc_no from stickering_workassign
    $selectStickeringWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM stickering_workassign"));
    $id_stickering_workassign = $selectStickeringWorkassign['id'];

    // Get the maximum dc_no from singer_workassign
    $selectSingerWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM singer_workassign"));
    $id_singer_workassign = $selectSingerWorkassign['id'];

    // Get the maximum dc_no from checking_workassign
    $selectCheckingWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM checking_workassign"));
    $id_checking_workassign = $selectCheckingWorkassign['id'];

    // Get the maximum dc_no from iron_workassign
    $selectIronWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM iron_workassign"));
    $id_iron_workassign = $selectIronWorkassign['id'];

    // Get the maximum dc_no from triming_workasign
    $selectTrimingWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM triming_workasign"));
    $id_triming_workassign = $selectTrimingWorkassign['id'];

    // Get the maximum dc_no from checking_workassign1
    $selectCheckingWorkassign1 = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM checking_workassign1"));
    $id_checking_workassign1 = $selectCheckingWorkassign1['id'];

    // Get the maximum dc_no from fchecking_workassign
    $selectFCheckingWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM fchecking_workassign"));
    $id_fchecking_workassign = $selectFCheckingWorkassign['id'];

    // Get the maximum dc_no from ironing_workassign
    $selectIroningWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM ironing_workassign"));
    $id_ironing_workassign = $selectIroningWorkassign['id'];

    // Get the maximum dc_no from packing_workassign
    $selectPackingWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM packing_workassign"));
    $id_packing_workassign = $selectPackingWorkassign['id'];

    // Get the maximum dc_no from inspection_workassign
    $selectInspectionWorkassign = mysqli_fetch_array(mysqli_query($zconn, "SELECT MAX(dc_no) AS id FROM inspection_workassign"));
    $id_inspection_workassign = $selectInspectionWorkassign['id'];

    // Determine the new dc_no by finding the maximum of all tables and incrementing it by 1
    $new_dc_no = max(
        $id_production_dc,
        $id_stickering_workassign,
        $id_singer_workassign,
        $id_checking_workassign,
        $id_iron_workassign,
        $id_triming_workassign,
        $id_checking_workassign1,
        $id_fchecking_workassign,
        $id_ironing_workassign,
        $id_packing_workassign,
        $id_inspection_workassign
    ) + 1;
?>


    <input type="text" name="dc_no" class="form-control" value="<?php echo $new_dc_no; ?>">
</div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">DC Out Date</label>
                                      <div class="col-sm-6">
    <input type="date" class="form-control" id="dc_date" name="dc_date" autocomplete="off" required>
</div>

<script>
    // Get the current date in YYYY-MM-DD format
    var currentDate = new Date().toISOString().slice(0, 10);

    // Set the input field's value to the current date
    document.getElementById('dc_date').value = currentDate;
</script>

                                    </div>

                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;To Contractor</label>
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

                           
                                   
									


<script>
function updateColorTotal(color) {
    var inputs = document.querySelectorAll('[name*="' + color + '"]');
    var total = 0;

    inputs.forEach(function(input) {
        total += parseInt(input.value) || 0;
    });

    var colorTotal = document.getElementById(color + '-total');
    colorTotal.innerText = total;
}
</script>

                                    <?php 
        

                            if (isset($_REQUEST['from'])!='' && isset($_REQUEST['from'])!='0'){
                                    if ($_REQUEST['from']=='CUTTING'){
						
       
										
											if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted
    if (isset($_POST['save1'])) {
        // Get data from the form
        if (isset($_POST['fabric_name']) && isset($_POST['date']) && isset($_POST['dia']) && isset($_POST['gsm']) && isset($_POST['color']) && isset($_POST['wgt']) && isset($_POST['stock']) && isset($_POST['delivery_wgt'])) {

			//if ($stock2 > 0) {
            // Generate a single dc_no value
            $select = mysqli_fetch_array(mysqli_query($zconn, "select max(dc_no) as id from production_dc"));
            $dc_no = $select['id'] + 1;

            // Extract other variables
            $dc_date = mysqli_real_escape_string($zconn, $_POST['dc_date']);
            $con_name = mysqli_real_escape_string($zconn, $_POST['to_contractor']);
            $style_no = mysqli_real_escape_string($zconn, $_POST['style']);
            $order_no = mysqli_real_escape_string($zconn, $_POST['order']);
            $from = mysqli_real_escape_string($zconn, $_POST['from']);
            $created_at = date('Y-m-d H:i:s'); // Current date and time

            // Construct and execute the SQL query within a loop
            for ($i = 0; $i < count($_POST['fabric_name']); $i++) {
                // Get data from the arrays
                $fabric_name = mysqli_real_escape_string($zconn, $_POST['fabric_name'][$i]);
                $date = mysqli_real_escape_string($zconn, $_POST['date'][$i]);
                $dia = mysqli_real_escape_string($zconn, $_POST['dia'][$i]);
                $gsm = mysqli_real_escape_string($zconn, $_POST['gsm'][$i]);
                $color = mysqli_real_escape_string($zconn, $_POST['color'][$i]);
                $wgt = mysqli_real_escape_string($zconn, $_POST['wgt'][$i]);
                $stock = mysqli_real_escape_string($zconn, $_POST['stock'][$i]);
                $delivery_wgt = mysqli_real_escape_string($zconn, $_POST['delivery_wgt'][$i]);
                $roll = mysqli_real_escape_string($zconn, $_POST['roll'][$i]);
				



              // Construct the SQL query
$sql = "INSERT INTO production_dc (dc_no, dc_date, date, con_name, style_no, order_no, fabric_name, `from`, wgt, roll, stock, dia, gsm, color, delivery_wgt, created_at) 
  VALUES ('$new_dc_no', '$dc_date', NOW(), '$con_name', '$style_no', '$order_no', '$fabric_name', '$from', '$wgt', '$roll', '$stock', '$dia', '$gsm', '$color', '$delivery_wgt', '$created_at')";



                // Execute the query
                if (mysqli_query($zconn, $sql)) {
                    echo "Data inserted successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($zconn);
                }

                // Insert data into the 'workassign_dc' table
            $insertWorkAssignQuery = "INSERT INTO workassign_dc (style_no, order_no, dc_no, size_id, color, qty_val, `from`, to_contractor, dc_date, session_entry) VALUES ('$style_no', '$order_no', '$dc_no', '$size_id', '$color', $qty_val, '$from', '$to_contractor', '$dc_date', '$uname')";

            $resultWorkAssign = mysqli_query($zconn, $insertWorkAssignQuery);

            if (!$resultWorkAssign) {
                // Log the error for reference
                error_log("Error: " . mysqli_error($zconn));
                die("An error occurred while inserting data into workassign_dc.");
            }

				 }
            } 
			else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($zconn);
				
                             // Display a JavaScript alert as a warning
               // echo '<script>alert("Warning: Stock is not positive. Data not inserted.");</script>';
            }
            //}

            // Close the database connection
            // mysqli_close($zconn);
      //  }
    }
}

								
								?>
                                    <div class="table-responsive scroll-container">
                                        <div class="col-12 d-flex no-block align-items-center">
                                            <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['from']); ?>&nbsp;PROGRAM</h5>
                                        </div>
                                        <table id="example" class="table table-striped table-bordered text-center" style="overflow-x:auto;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">FABRIC NAME</th>
													 <th style="width: 3%" data-toggle="tooltip" title="Fabric Dia">Date</th>
													<th style="width: 3%">DIA</th>
													<th style="width: 3%">GSM</th>
                                                    <th style="width: 3%" data-toggle="tooltip" title="Fabric Dia">COLOR</th>
                                                    
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">IN STOCK</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">AL. DEL</th>
													<th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">ROLLS</th>
                                                    <th style="width: 10%">NOW DELIVERY</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if ($_REQUEST['from']=='CUTTING') {
                                                    $tbl0='process_production1';

//                                                     echo "SELECT distinct order_no,style_no,fabric_name,dia FROM $tbl0 where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
// exit;
                                                    $sectBrnQry = "SELECT distinct order_no,style_no,fabric_name,dia,color,wgt,delivery_wgt FROM $tbl0 where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
                                                }
                                                else{
                                                    $tbl0=$_REQUEST['from'];
                                                    $sectBrnQry = "SELECT distinct order_no,style_no,fabric_name,dia,color,wgt,delivery_wgt FROM process_production1 where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='$tbl0'";
                                                }
                                                $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                                                while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){

                                                 $select_dc_query = "SELECT * FROM production_dc where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' ";
                    $dc_result = mysqli_query($zconn, $select_dc_query);
												//	$dc_row = mysqli_fetch_assoc($dc_result);
													//print_r($dc_row);
													
$stock1 = 0; // Initialize $stock1 to 0

while ($dc_row = mysqli_fetch_assoc($dc_result)) {
    $stock1 += $dc_row['delivery_wgt'];
	
}
$stock2 = $coldata['delivery_wgt'] - $stock1;
													
if ($stock2 < 0) {
    $stock2 = 0;
}
													
//echo 'stock:' .$stock1; // This will display the total sum of delivery_wgt
												//	echo 'stock:' .$stock2;



                                                   // }
                                                ?>
                                        
                                                <td style="width: 4%"><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['date'];?><input type="hidden" name="date[]" value="<?php echo $coldata['date'];?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['dia'];?><input type="hidden" name="dia[]" value="<?php echo $coldata['dia'];?>"></td>
												                                                <td style="width: 4%"><?php echo $coldata['gsm'];?><input type="hidden" name="gsm[]" value="<?php echo $coldata['gsm'];?>"></td>
												  <td style="width: 4%"><?php echo $coldata['color'];?><input type="hidden" name="color[]" value="<?php echo $coldata['color'];?>"></td>
                                                <!--td style="width: 8%"><?php echo $in;?></td-->

                                                    <td style="width: 8%"><?php echo $coldata['entered_wgt'];?><input type="hidden" name="wgt[]" value="<?php echo $coldata['delivery_wgt'];?>"></td>

                                                    
												 
												<td style="width: 8%"><?php

echo $stock2;
?>

  
    <input type="hidden" name="stock[]" value="<?php echo $stock2; ?>">
</td>

												
												<td style="width: 8%"><?php 
													
													echo  $stock1;?>
													
												</td>
<td style="width: 4%"><input type="text" class="form-control "  id="roll" name="roll[]"></td>
                                                <td style="width: 4%"><input type="text" class="form-control delivery_wgt" min="0" max="<?php echo $stock2;?>" id="delivery_wgt" name="delivery_wgt[]"></td>
                                                </tr>

                                            <?php
                                                }
                                            ?>
                                                <tr>
                                                    <td colspan="9"><strong>TOTAL WEIGHT</strong></td>
                                                    <td>
                                                        <input type="text" name="total" id="total" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save1" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
</div>
                                    
                                    
                                         <?php }

                                         else{
if (isset($_POST['from']) && $_POST['from'] !== '0') {
    $selectedDepartment = $_POST['from'];
    var_dump($selectedDepartment);
										if ($selectedDepartment === 'PRINTING') { 
                                          //  echo 'PTG';
include('stickering_workassign.php');
										}  elseif ($selectedDepartment === 'EMBROIDERY') {
                                           //1 echo 'singer';
                                             	include('singer_workassign.php');
                                        
                                             } elseif ($selectedDepartment === 'SEWING') {
                                                // echo 'SEWING';
		include('checking_workassign.php');

                                                    //  include('singer_workassign.php');
                                             
                                                  } elseif ($selectedDepartment === 'TRIMING') {
                                                     echo 'TRIMING';
            include('triming_workassign.php');
    
                                                      } elseif ($selectedDepartment === 'CHECKING') {
                                                        echo 'CHECKING';
                                                        include('checking_workassign1.php');

       
                                                         }      elseif ($selectedDepartment === 'FINAL CHECKING') {
                                                            echo 'FINAL CHECKING';
                                                            include('fchecking_workassign.php');
    
           
                                                             }    elseif ($selectedDepartment === 'IRONING') {
                                                                echo 'IRONING';
                                                                include('ironinng_workassign.php');
        
               
                                                                 }  elseif ($selectedDepartment === 'PACKING') {
                                                                    echo 'PACKING';
                                                                    include('packing_workassign.php');
            
                   
                                                                     }
                                                                    elseif ($selectedDepartment === 'INSPECTION') {
                                                                        echo 'INSPECTION';
                                                                        include('inspection_workassign.php');
                
                       
                                                                         }
	// elseif ($selectedDepartment === 'SINGER') {
	// 	include('singer_workassign.php');

	// }
	// 	elseif ($selectedDepartment === 'checking') {
	// 		//echo 'Checking';
	// 	include('checking_workassign.php');

	// }
	// 	elseif ($selectedDepartment === 'Ironing and Packing') {
	// 		//echo 'Ironing and Packing';
	// include('iron_workassign.php');

	// }
 else {
    // Default case when neither condition is met
}
											 
									}		
                                        }
								 

										 

											 
											
							

                                         }

?>
					
						

								
  


							
							
							
		

                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->
            </div>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <!--?php include('includes/footer.php');?-->
            <!-- End footer -->
            <!-- ============================================================== -->
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