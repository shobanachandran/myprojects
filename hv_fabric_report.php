<?php 
include('includes/config.php');
include('includes/base_functions.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['name'])=='delete'){
	$id=$_REQUEST['id'];
	$delete=mysqli_query($zconn,"delete from yarns_po_details where po_id='$id'");
	$delete=mysqli_query($zconn,"delete from yarns_po_master where id='$id'");

	if ($delete){
		echo '<script> alert("Record has been delete successfully deleted!")</script>';
	}
	
}


//print_r($_REQUEST);
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
        <?php echo SITE_TITLE;?> - Yarn Po List
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
                        <h4 class="page-title">Fabric Report</h4>
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
                                                <a href="yarn_po.php"><button type="button"
                                                        class="btn btn-success">Add</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" style="overflow:auto;">
                                <table id="example" class="table table-striped table-bordered display">
                                    <thead
                                        style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
                                        <tr>
                                            <th>NO</th>
                                            <th>PO SENT /STYLE</th>
                                            <th>PHOTO REF</th>
                                            <th>NIK ID</th>
                                            <th>COLOR FABRIC STATUS</th>
                                            <th>QTY</th>
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
                                    <tbody>
                                        <tr>
                                            <td>10-Dec</td>
                                            <td>744</td>
                                            <td>AERO SS HEAVY WEIGHT TEE: PRINT 200 GSM</td>
                                            <td>74407</td>
                                            <td class="highlight-green">BLUE CREST</td>
                                            <td>2016</td>
                                            <td>05-Nov</td>
                                            <td>07-Nov</td>
                                            <td>13-Nov</td>
                                            <td>6</td>
                                            <td>lakshmi</td>
                                            <td>13-Nov</td>
                                            <td>22-Nov</td>
                                            <td>9</td>
                                            <td>vinayaka</td>
                                            <td>22-Nov</td>
                                            <td>25-Nov</td>
                                            <td>3</td>
                                            <td></td>
                                            <td></td>
                                            <td>30</td>
                                            <td></td>
                                            <td>UNDER WASHING-26-11</td>
                                            <td>100 KG ONLY PENDING</td>
                                            <td></td>
                                        </tr>
                                        <!-- Add other rows here similarly -->
                                    </tbody>
                                </table>
                            </div>
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