<?php
session_start();
$current = 'Yarn Style Wise Report';
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

// Initialize variables to store user selections
$selectedDeliverTo = '';
$fromDate = '';
$toDate = '';

// Initialize an array to store distinct deliver_to values
$deliverToOptions = array();





// Perform a query to fetch distinct deliver_to values
$queryDeliverTo = "SELECT DISTINCT deliver_to FROM `yarns_po_master`";
$resultDeliverTo = mysqli_query($zconn, $queryDeliverTo);

if ($resultDeliverTo) {
    while ($rowDeliverTo = mysqli_fetch_assoc($resultDeliverTo)) {
        // Add each distinct deliver_to value to the options array
        $deliverToOptions[] = $rowDeliverTo['deliver_to'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['deliver_to'])) {
        $selectedDeliverTo = $_POST['deliver_to'];
    }

    if (isset($_POST['from_date'])) {
        $fromDate = $_POST['from_date'];
    }

    if (isset($_POST['to_date'])) {
        $toDate = $_POST['to_date'];
    }

    // Build the SQL query based on user selections
    $query = "SELECT m.*, d.* FROM `yarns_po_master` AS m
          LEFT JOIN `yarns_po_details` AS d ON m.po_no = d.po_id
          WHERE 1";

if (!empty($selectedDeliverTo)) {
    $query .= " AND m.deliver_to = '$selectedDeliverTo'";
}

if (!empty($fromDate) && !empty($toDate)) {
    // Include records up to and including the 'To Date'
    $query .= " AND DATE(m.date) BETWEEN '$fromDate' AND DATE_ADD('$toDate', INTERVAL 1 DAY)";
}



    $result = mysqli_query($zconn, $query);

    if (!$result) {
        echo 'Error executing the query: ' . mysqli_error($zconn);
		echo 'Selected Deliver To: ' . $selectedDeliverTo;
echo 'From Date: ' . $fromDate;
echo 'To Date: ' . $toDate;

    }
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
        <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Date Wise Report</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <form action="" method="post" class="form-horizontal">
                                        <div class="col-sm-12">
                                            <div class="row justify-content-center" style="text-align:center;">
                                                <div class="form-group col-md-6">
                                                    <label for="deliver_to">Supplier:</label>
                                                    <select name="deliver_to" id="deliver_to" class="form-control">
                                                        <option value="">Select Supplier</option>
                                                        <?php
                                                        foreach ($deliverToOptions as $option) {
                                                            echo '<option value="' . $option . '"';
                                                            if ($selectedDeliverTo == $option) {
                                                                echo ' selected';
                                                            }
                                                            echo '>' . $option . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												   <div class="row justify-content-center" style="text-align:center;">
                                                <div class="form-group col-md-6">
                                                    <label for="from_date">From Date:</label>
                                                    <input type="date" name="from_date" id="from_date" class="form-control"
                                                        onchange="this.form.submit()"
                                                        <?php if (!empty($fromDate)) echo 'value="' . $fromDate . '"'; ?>>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="to_date">To Date:</label>
                                                    <input type="date" name="to_date" id="to_date" class="form-control"
                                                        onchange="this.form.submit()"
                                                        <?php if (!empty($toDate)) echo 'value="' . $toDate . '"'; ?>>
                                                </div>
													    </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-primary">Go</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <br>
                                <?php
                                if (isset($result)) {
                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            echo '<h3 style="text-align: center;">Date Wise Report</h3>';
                                            echo '<br>';
                                            echo '<table width="100%" class="table">';
                                            echo '<thead>';
                                            echo '<tr>';
                                            echo '<th>PONO</th>';
                                            echo '<th>Order No</th>';
                                            echo '<th>Deliver To</th>';
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
                                                echo '<td align="center">' . $row['po_no'] . '</td>';
                                                echo '<td align="center">' . $row['order_no'] . '</td>';
                                                echo '<td align="center">' . $row['deliver_to'] . '</td>';
                                                echo '<td align="center">' . $row['counts'] . '</td>';
                                                echo '<td align="center">' . $row['grant_total'] . '</td>';
                                                echo '<td align="center">' . $row['rate'] . '</td>';
                                                echo '<td align="center">' . $row['grant_total'] . '</td>';
                                                echo '<td align="center">' . $row['date'] . '</td>';
                                                echo '</tr>';
                                            }
                                            echo '</tbody>';
                                            echo '</table>';
                                        } else {
                                            echo 'No records found for the selected filters.';
                                        }
                                    } else {
                                        echo 'Error executing the query: ' . mysqli_error($zconn);
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