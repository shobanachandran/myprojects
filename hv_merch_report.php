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
                        <h4 class="page-title">Merch Report</h4>
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
                                       
                                                <th>NIK</th>
                                                <th>PHOTO</th>
                                                <th>STYLE</th>
                                                <th>STYLE NUMBER</th>
                                                <th>NIK ID</th>
                                                <th>COLOR</th>
                                                <th>QTY</th>
                                                <th>CUT QTY</th>
                                                <th>TECH PACK</th>
                                                <th>STRIKE OFF</th>
                                                <th>STRIKE OFF LEAD TIME</th>
                                                <th colspan="3">FABRIC</th>
                                                <th colspan="2">CUTTING</th>
                                                <th>CUTTING LEAD TIME</th>
                                                <th colspan="3">EMB/PRT/EMBOS</th>
                                                <th>PRINTING LEAD TIME</th>
                                                <th colspan="3">STITCHING</th>
                                                <th>STITCHING LEAD TIME</th>
                                                <th>REMARKS</th>
                                                <th>FABRIC TO BOX</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">741</td>
                                                <td rowspan="2">Image</td>
                                                <td rowspan="2">AERO SS OXFORD PIQUE POLO: DTM A90</td>
                                                <td>AAE02872D</td>
                                                <td>74104</td>
                                                <td>AGATE GREEN</td>
                                                <td>1200</td>
                                                <td>1236</td>
                                                <td>24-Oct</td>
                                                <td>24-Oct</td>
                                                <td>0</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">27-Nov</td>
                                                <td>0</td>
                                                <td>HARSHITHA</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">27-Nov</td>
                                                <td>0</td>
                                                <td>NIK-2</td>
                                                <td>08-Dec</td>
                                                <td>26</td>
                                                <td class="remarks">U/STITCHING</td>
                                                <td class="red">BOX NOT READY</td>
                                            </tr>
                                            <tr>
                                                <td>AAE02872D</td>
                                                <td>74105</td>
                                                <td>BLACK</td>
                                                <td>1200</td>
                                                <td>1236</td>
                                                <td>24-Oct</td>
                                                <td>24-Oct</td>
                                                <td>0</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">27-Nov</td>
                                                <td class="green">28-Nov</td>
                                                <td class="green">28-Nov</td>
                                                <td>1</td>
                                                <td>SIVAM</td>
                                                <td class="green">29-Nov</td>
                                                <td class="green">30-Nov</td>
                                                <td>2</td>
                                                <td>NIK-2</td>
                                                <td>08-Dec</td>
                                                <td>26</td>
                                                <td class="remarks">U/STITCHING</td>
                                                <td class="red">BOX NOT READY</td>
                                            </tr>
                                            <!-- Additional rows here -->
                                        </tbody>                            </tr>
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