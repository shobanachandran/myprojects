<?php 
session_start();
$current='Yarn Style Wise Report';
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
                        <h4 class="page-title">Yarn PO Report</h4>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
    <div class="card-body">
    <div class="row justify-content-center"> <!-- Add justify-content-center class here -->
        <div class="col-sm-12">
            <div class="row">
                <!-- The form remains the same -->
				
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
						<form action="" method="post" class="form-horizontal">
                        <td width="39%" align="center" valign="middle"><strong>PO No</strong></td>
                        <td width="3%" align="center" valign="middle">&nbsp;</td>
                        <td width="58%">
                            <label>
                                <select name="style" class="form-control" id="select" data-rel="chosen" onchange="this.form.submit()">
                                    <option value="Select">---Select---</option>
                                    <?php
                                    // Fetch style numbers from the database and create options
                                    $sql = "SELECT DISTINCT po_id FROM yarns_po_details";
                                    $result = mysqli_query($zconn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = ($_REQUEST['style'] == $row['po_id']) ? 'selected' : '';
                                        echo '<option value="' . $row['po_id'] . '" ' . $selected . '>' . $row['po_id'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                        </td>
                    </tr>
						 </table>
                   <?php
// Ensure you have a valid database connection here

if (isset($_REQUEST['style'])) {
    $style = $_REQUEST['style'];

    // Perform the database query to fetch all records for the selected style
    $query = "SELECT * FROM `yarns_po_details` WHERE `po_id`='$style'";
    $result = mysqli_query($zconn, $query);

    if (!$result) {
        echo 'Error executing the query: ' . mysqli_error($zconn);
    } else {
        // Check if any records were found
        if (mysqli_num_rows($result) > 0) {
			echo '<br>';
			echo '<br>';
			echo '<h3 style="text-align: center;">Yarn PO </h3>';

			echo '<br>';
            echo '<table width="100%" class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>PONO</th>';
            echo '<th>Order No</th>';
			  echo '<th>Yarn Name</th>';
			echo '<th>Counts</th>';
            echo '<th>Weight</th>';
            echo '<th>Rate</th>';
            echo '<th>Grant Total</th>';
            echo '<th>Date</th>';
           
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
				
                echo '<td align="center">' . $row['po_id'] . '</td>';
                echo '<td align="center">' . $row['order_no'] . '</td>';
				                echo '<td align="center">' . $row['yarn_name'] . '</td>';
				 echo '<td align="center">' . $row['counts'] . '</td>';
                echo '<td align="center">' . $row['weight'] . '</td>';
                echo '<td align="center">' . $row['rate'] . '</td>';
                echo '<td align="center">' . $row['grant_total'] . '</td>';
                echo '<td align="center">' . $row['date'] . '</td>';
                
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'No records found for the selected style.';
        }
    }
}
?>
				
				<!-- Display second table (Yarn Inward details) based on the selected style -->
                <?php
                // Ensure you have a valid database connection here

                if (isset($_REQUEST['style'])) {
                    $style = $_REQUEST['style'];

                    // Perform the database query to fetch yarn inward details for the selected style
                   $query_yarn_inward = "SELECT yi.*, yp.yarn_name FROM `yarn_inward` yi
                     LEFT JOIN `yarns_po_details` yp ON yi.po_no = yp.po_id
                     WHERE yi.`po_no`='$style'";

                    $result_yarn_inward = mysqli_query($zconn, $query_yarn_inward);

                    if (!$result_yarn_inward) {
                        echo 'Error executing the query for Yarn Inward details: ' . mysqli_error($zconn);
                    } else {
                        // Check if any records were found
                        if (mysqli_num_rows($result_yarn_inward) > 0) {
                            echo '<h3 style="text-align: center;">Yarn To Production</h3>';

                            echo '<table width="100%" class="table">';
                            echo '<thead>';
                            echo '<tr>';
							echo '<th>PO No</th>';
							   echo '<th>Date</th>';
                            
                            echo '<th>Order No</th>';
							  echo '<th>Yarn Name</th>';
                            echo '<th>Roll</th>';
                            echo '<th>Weight</th>';
                         
                          
                           
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while ($row_yarn_inward = mysqli_fetch_assoc($result_yarn_inward)) {
                                echo '<tr>';
								                                echo '<td align="center">' . $row_yarn_inward['po_no'] . '</td>';
								echo '<td align="center">' . $row_yarn_inward['date'] . '</td>';

                                echo '<td align="center">' . $row_yarn_inward['order_no'] . '</td>';
                              echo '<td align="center">' . $row_yarn_inward['yarn_name'] . '</td>';
								
                                echo '<td align="center">' . $row_yarn_inward['roll'] . '</td>';
                                echo '<td align="center">' . $row_yarn_inward['wgt'] . '</td>';
                                
                               
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo 'No records found for the selected style in Yarn Received details.';
                        }
                    }
                }
                ?>
							
               
          
            </div>
        </div>
    </div>
</div>


</div>


											
									
				
</div><!--/row-->				
 <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
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