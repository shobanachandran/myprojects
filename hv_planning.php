
<?php
include('includes/config.php');
include('includes/base_functions.php');

if ($_SESSION['userid'] == '') {
    echo "<script>window.location.href='login.php';</script>";
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Collect form data
    $yarn_po_date = $_POST['yarn_po_date'];
    $yarn_received_date = $_POST['yarn_received_date'];
    $knitting_end_date = $_POST['knitting_end_date'];
    $knitting_lead_time = $_POST['knitting_lead_time'];
    $dying_name = mysqli_real_escape_string($zconn, $_POST['dying_name']);
    $dying_start = $_POST['dying_start'];
    $dying_end = $_POST['dying_end'];
    $dying_lead_time = $_POST['dying_lead_time'];
    $compacting_name = mysqli_real_escape_string($zconn, $_POST['compacting_name']);
    $compacting_start = $_POST['compacting_start'];
    $compacting_end = $_POST['compacting_end'];
    $compacting_lead_time = $_POST['compacting_lead_time'];
    $planned = $_POST['planned'];
    $actual = mysqli_real_escape_string($zconn, $_POST['actual']);
    $fabric_lead_time = $_POST['fabric_lead_time'];
    $merch = mysqli_real_escape_string($zconn, $_POST['merch']);
    $remarks = mysqli_real_escape_string($zconn, $_POST['remarks']);
    $comments = mysqli_real_escape_string($zconn, $_POST['comments']);
    $additional_comments = mysqli_real_escape_string($zconn, $_POST['additional_comments']);

    // Insert query
    $query = "
        INSERT INTO hv_planning (
            yarn_po_date, yarn_received_date, knitting_end_date, knitting_lead_time,
            dying_name, dying_start, dying_end, dying_lead_time, compacting_name,
            compacting_start, compacting_end, compacting_lead_time, planned, actual,
            fabric_lead_time, merch, remarks, comments, additional_comments
        ) VALUES (
            '$yarn_po_date', '$yarn_received_date', '$knitting_end_date', '$knitting_lead_time',
            '$dying_name', '$dying_start', '$dying_end', '$dying_lead_time', '$compacting_name',
            '$compacting_start', '$compacting_end', '$compacting_lead_time', '$planned', '$actual',
            '$fabric_lead_time', '$merch', '$remarks', '$comments', '$additional_comments'
        )
    ";

    // Execute the query
    if (mysqli_query($zconn, $query)) {
        echo '<script>alert("Data successfully inserted into hv_planning table!");</script>';
    } else {
        echo '<script>alert("Error inserting data: ' . mysqli_error($zconn) . '");</script>';
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
    <title>
        <?php echo SITE_TITLE;?> - Fabris Planning
    </title>
    <!-- Custom CSS -->
    <!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/chosen.jquery.min.js"></script>
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
                        <h4 class="page-title">Fabric Planning</h4>
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
                <form name="costing_list" id="costing_list" method="post">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow:hidden;">
                                        <div class="row" style="float:right;">
                                            <div class="col-sm-12" style="float:right;">
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" style="overflow:auto;">

                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
                                        <tr>
    <th>YARN PO DATE</th>
    <th>YARN RECEIVED DATE</th>
    <th>KNITTING END DATE</th>
    <th>KNITTING LEAD TIME</th>
    <th>DYING NAME</th>
    <th>START</th>
    <th>END</th>
    <th>DYING LEAD TIME</th>
    <th>COMPACTING NAME</th>
    <th>START</th>
    <th>END</th>
    <th>COMPACTING LEAD TIME</th>
    <th>PLANNED</th>
    <th>ACTUAL</th>
    <th>FABRIC LEAD TIME</th>
    <th>MERCH</th>
    <th>REMARKS</th>
    <th>COMMENTS</th>
    <th>ADDITIONAL COMMENTS</th>
</tr>
</thead>
<tr>
    <td><input type="date" class="form-control" name="yarn_po_date" value="2024-11-05" style="width: 80%;"></td>
    <td><input type="date" class="form-control" name="yarn_received_date" value="2024-11-07" style="width: 80%;"></td>
    <td><input type="date" class="form-control" name="knitting_end_date" value="2024-11-13" style="width: 80%;"></td>
    <td><input type="number" class="form-control" name="knitting_lead_time" value="6" style="width: 50%;"></td>
    <td><textarea class="form-control" name="dying_name" style="width: 100%; height: 50px;">lakshmi</textarea></td>
    <td><input type="date" class="form-control" name="dying_start" value="2024-11-13" style="width: 80%;"></td>
    <td><input type="date" class="form-control" name="dying_end" value="2024-11-22" style="width: 80%;"></td>
    <td><input type="number" class="form-control" name="dying_lead_time" value="9" style="width: 50%;"></td>
    <td><textarea class="form-control" name="compacting_name" style="width: 100%; height: 50px;">vinayaka</textarea></td>
    <td><input type="date" class="form-control" name="compacting_start" value="2024-11-22" style="width: 80%;"></td>
    <td><input type="date" class="form-control" name="compacting_end" value="2024-11-25" style="width: 80%;"></td>
    <td><input type="number" class="form-control" name="compacting_lead_time" value="3" style="width: 50%;"></td>
    <td><input type="date" class="form-control" name="planned" value="2024-12-06" style="width: 80%;"></td>
    <td><textarea class="form-control" name="actual" style="width: 100%; height: 50px;"></textarea></td>
    <td><input type="number" class="form-control" name="fabric_lead_time" value="30" style="width: 50%;"></td>
    <td><textarea class="form-control" name="merch" style="width: 100%; height: 50px;"></textarea></td>
    <td><textarea class="form-control" name="remarks" style="width: 100%; height: 50px;">UNDER WASHING-26-11</textarea></td>
    <td><textarea class="form-control" name="comments" style="width: 100%; height: 50px;">100 KG ONLY PENDING</textarea></td>
    <td><textarea class="form-control" name="additional_comments" style="width: 100%; height: 50px;"></textarea></td>
</tr>

</table>


</div>
<div>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
<div>
                </form>
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
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
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
    <!--datatables JavaScript -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function costing_sheet(id) {
            window.open("yarn_po_print.php?id=" + id, "PO Order ", "width=800,height=700");
        }
    </script>
    <script>
        $(document).ready(function () {
            //$('#example').DataTable();
            $('.display').DataTable();
        });
    </script>

</body>

</html>