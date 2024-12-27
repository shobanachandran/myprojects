<?php

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
    <title><?php echo SITE_TITLE; ?> - Jobwork Create Cheque</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
  <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/chosen.jquery.min.js"></script>
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
            <div class="page-wrapper" style="min-height: 100%; height: auto;">

                <!-- Bread crumb and right sidebar toggle -->
                <div class="page-breadcrumb">
                    
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header well" data-original-title>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="dateFilter">Filter by Cheque Date:</label>
            <input type="date" id="dateFilter" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="payeeFilter">Filter by Payee:</label>
            <input type="text" id="payeeFilter" class="form-control" placeholder="Enter Payee Name">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="bankFilter">Filter by Bank:</label>
            <input type="text" id="bankFilter" class="form-control" placeholder="Enter Bank Name">
        </div>
    </div>
</div>

                            </div>
	




							<div class="card">
    <div class="card-header">
        <h5 class="card-title">Cheque Details</h5>
    </div>
    <div class="card-body">



<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered">
      

                                    										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">

                                        <tr>
                                            <th><strong>Id</strong></th>
                                            <th>Date</th>
                                            <th>Cheque Date</th>
                                            <th><strong>Payee Name</strong></th>
                                            <th>Bank</th>
                                            <th>Desc</th>
                                            <th>Amount</th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
    <?php
										include('includes/config.php');
    $query = "SELECT * FROM cheque_payments ORDER BY id DESC";
    $result = mysqli_query($zconn, $query);

    if ($result) {
		$sn=1;
        while ($res = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $res['id']; ?></td>
            <td><?php echo date('Y-m-d', strtotime($res['date'])); ?></td>
            <td><?php echo date('Y-m-d', strtotime($res['cheque_date'])); ?></td>
			
            <td><?php echo $res['payee']; ?></td>
            <td><?php echo $res['bank']; ?></td>
            <td><?php echo $res['description']; ?></td>
            <td><?php echo $res['amount']; ?></td>
            <td>
                <a href="?id=<?php echo $res['id']; ?>&action=edit" class="btn btn-info"><i class="icon-edit"></i> Edit</a>
                <a href="cheque_print.php?id=<?php echo $res['id']; ?>" class="btn btn-info"><i class="icon-print"></i> Print</a>
            </td>
        </tr>
    <?php
        }
    } else {
        echo "Error: " . mysqli_error($zconn);
    }
    ?>
</tbody>
		 </table>
</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      </div>
			
    
    <?php include('include/footer.php'); ?>
</body>
 <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<!-- Include jQuery -->
<!--datatables JavaScript -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/date-range/search.js"></script>
<script>
$(document).ready(function() {
    var table = $('#example').DataTable({
        "language": {
            // Custom language options if needed
        }
    });

    // Get tomorrow's date
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);

    // Format tomorrow's date in yyyy-MM-dd format
    var tomorrowFormatted = tomorrow.toISOString().split('T')[0];

    // Apply date-wise filtering based on "cheque_date" column
    $('#dateFilter').on('change', function() {
        var dateValue = this.value;

        table.column(2)
            .search(dateValue, false, true) // Column index 2 for "cheque_date"
            .draw();
    });

    // Apply filtering based on "payee" column
    $('#payeeFilter').on('input', function() {
        var payeeName = this.value;

        table.columns(3).search(payeeName).draw();
    });

    // Apply filtering based on "bank" column
    $('#bankFilter').on('input', function() {
        var bankName = this.value;

        table.columns(4).search(bankName).draw();
    });

    // Add reminder logic for tomorrow's date
    table.column(2).search(tomorrowFormatted, false, true).draw();
});

	</script>

</html>

