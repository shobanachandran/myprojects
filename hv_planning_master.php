<?php 
include('includes/config.php');
include('includes/base_functions.php');

if ($_SESSION['userid'] == '') {
    echo "<script>window.location.href='login.php';</script>";
}

// Handle form submission
if (isset($_POST['submit'])) {
    $date = mysqli_real_escape_string($zconn, $_POST['date']);
    $no = mysqli_real_escape_string($zconn, $_POST['no']);
    $po_sent_style = mysqli_real_escape_string($zconn, $_POST['po_sent_style']);
    $nik_id = mysqli_real_escape_string($zconn, $_POST['nik_id']);
    $color_fabric_status = mysqli_real_escape_string($zconn, $_POST['color_fabric_status']);
    $qty = mysqli_real_escape_string($zconn, $_POST['qty']);
   // $photo_ref = null;



    if (isset($_FILES['photo_ref'])) {
        if ($_FILES['photo_ref']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['photo_ref']['tmp_name'];
            $file_name = basename($_FILES['photo_ref']['name']);
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    
            echo "Temporary File Path: $file_tmp<br>";
            echo "Original File Name: $file_name<br>";
    
            if (in_array($file_ext, $allowed_types)) {
                $upload_dir = "uploads/hv_fab/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                    echo "Directory created.<br>";
                }
                $unique_name = uniqid() . "_" . $file_name;
                $target_path = $upload_dir . $unique_name;
    
                echo "Target Path: $target_path<br>";
    
                if (move_uploaded_file($file_tmp, $target_path)) {
                    $photo_ref = $target_path;
                    echo "File uploaded successfully: $photo_ref<br>";
                } else {
                    echo "Failed to move uploaded file.<br>";
                }
            } else {
                echo "Invalid file type: $file_ext<br>";
            }
        } else {
            echo "File upload error code: " . $_FILES['photo_ref']['error'] . "<br>";
        }
    } else {
        echo "File not uploaded.<br>";
    }
    

    if ($photo_ref) {
        $insert_query = "INSERT INTO hv_fabric_planning_report (date, no, po_sent_style, photo_ref, nik_id, color_fabric_status, qty) 
                         VALUES ('$date', '$no', '$po_sent_style', '$photo_ref', '$nik_id', '$color_fabric_status', '$qty')";
        if (mysqli_query($zconn, $insert_query)) {
            echo '<script>alert("Record has been successfully inserted!");</script>';
        } else {
            echo "Database Error: " . mysqli_error($zconn);
        }
    } else {
        echo "Photo reference is empty.";
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
        <?php echo SITE_TITLE;?> - PLANNING MASTER
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
                        <h4 class="page-title">Fabric Planning Master</h4>
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
                <form name="costing_list" id="costing_list" method="post" enctype="multipart/form-data">

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

                                    <table id="example" class="table table-striped table-bordered">
                                        <thead
                                            style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">

                                            <tr>
                                                <th>Date</th>
                                                <th>NO</th>
                                                <th>PO SENT / STYLE</th>
                                                <th>PHOTO REF</th>
                                                <th>NIK ID</th>
                                                <th>COLOR FABRIC STATUS</th>
                                                <th>QTY</th>

                                            </tr>
                                        </thead>
                                        <tr>
                                            <td style="width: 8%;"><input type="date" class="form-control" name="date"
                                                    value="2024-12-10" style="width: 80%;"></td>
                                            <td style="width: 5%;"><input type="text" class="form-control" name="no"
                                                    value="744" style="width: 100%;"></td>
                                            <td style="width: 20%;"><textarea class="form-control" name="po_sent_style"
                                                    style="width: 100%; height: 50px;">AERO SS HEAVY WEIGHT TEE: PRINT 200 GSM</textarea>
                                            </td>
                                            <td><input type="file" class="form-control" name="photo_ref"
                                                    style="width: 100%;"></td>
                                            <td><input type="text" class="form-control" name="nik_id" value="74407"
                                                    style="width: 100%;"></td>
                                            <td><input type="text" class="form-control" name="color_fabric_status"
                                                    value="BLUE CREST" style="width: 100%;"></td>
                                            <td><input type="number" class="form-control" name="qty" value="2016"
                                                    style="width: 100%;"></td>

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