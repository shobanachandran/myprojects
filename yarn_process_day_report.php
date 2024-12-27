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
    <title><?php echo SITE_TITLE;?> - Date Wise Report</title>
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
    <!-- Topbar header - style you can find in pages.scss -->
    <?php include('includes/header.php'); ?>
    <!-- End Topbar header -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <?php include('includes/sidebar.php'); ?>
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Date Wise Report</h4>
                </div>
            </div>
        </div>
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Sales chart -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center"> <!-- Add justify-content-center class here -->
                                <div class="col-sm-12">
                                    <div class="row justify-content-center" style="text-align:center;">
                                        <!-- The form with "From Date" and "To Date" input fields -->
                                        <form action="" method="post" class="form-horizontal">
											
                                            <div class="row">
                                                <label for="from_date">From Date:</label>
                                                <input type="date" name="from_date" id="from_date" class="form-control" onchange="this.form.submit()"
                                                    <?php if(isset($_POST['from_date'])) echo 'value="' . $_POST['from_date'] . '"'; ?>>
                                           
                                                <label for="to_date">To Date:</label>
                                                <input type="date" name="to_date" id="to_date" class="form-control" onchange="this.form.submit()"
                                                    <?php if(isset($_POST['to_date'])) echo 'value="' . $_POST['to_date'] . '"'; ?>>
                                            </div>
                                        </form>
                                    </div>

                                    <br>

                                    <!-- Display the date-wise report based on the selected date range -->
                                    <?php
                                    // Ensure you have a valid database connection here

                                    if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
                                        $fromDate = $_POST['from_date'];
                                        $toDate = $_POST['to_date'];

                                        // Perform the database query to fetch records within the date range
                                        $query_yarn_inward = "SELECT yi.*, yp.yarn_name FROM `yarn_inward` yi
                                            LEFT JOIN `yarns_po_details` yp ON yi.po_no = yp.po_id
                                            WHERE yi.`date` BETWEEN '$fromDate' AND '$toDate'";

                                        $result_yarn_inward = mysqli_query($zconn, $query_yarn_inward);

                                        if (!$result_yarn_inward) {
                                            echo 'Error executing the query for Date Wise Report: ' . mysqli_error($zconn);
                                        } else {
                                            // Check if any records were found
                                            if (mysqli_num_rows($result_yarn_inward) > 0) {
                                                echo '<h3 style="text-align: center;">Date Wise Report</h3>';
                                                echo '<p style="text-align: center;">From ' . $fromDate . ' to ' . $toDate . '</p>';

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
                                                echo 'No records found for the selected date range in the Date Wise Report.';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
		<!--/row-->             
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
