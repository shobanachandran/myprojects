<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
    echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['name'])=='delete'){
    $id=$_REQUEST['id'];
    $delete=mysqli_query($zconn,"delete from fabric_dc_out where dc_no='$id'");
    $delete=mysqli_query($zconn,"delete from fabric_dcout_master where dc_no='$id'");

    if ($delete){
        echo '<script> alert("Record has been delete successfully deleted!")</script>';
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
    <title><?php echo SITE_TITLE;?> - FABRIC DC OUT EDIT</title>
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
                        <h4 class="page-title">FABRIC DC OUT EDIT</h4>
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
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%">S. NO</th>
                                                <th style="width: 10%">DC.NO</th>
                                                <th style="width: 15%">ORDER NO</th>
                                                <th style="width: 15%">STYLE NO</th>
                                                <th style="width: 10%">DATE</th>
                                                <th style="width: 20%">TO ADDRESS</th>
                                                <th style="width: 20%">TOTAL WEIGHT</th>
                                                <th style="width: 15%">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                        $costing_sql = mysqli_query($zconn,"select * from fabric_dcout_master");
            $c=1;
            while($coldata = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){

            $style=$coldata['style_no'];
                    ?>
                    <tr>
                    <td><?php echo $c;?></td>
                    <td><?php echo $coldata['dc_no'];?></td>
                    <td><?php echo $coldata['order_no'];?></td>
                    <td><?php echo $coldata['style_no'];?></td>
                    <td > <?php echo $coldata['date']; ?></td>
                    <td ><?php echo $coldata['to_process']; ?></td>
                    <td ><?php echo $coldata['total']; ?></td>
                   <!--  <td ><?php  
                    $status=$coldata['status'];
                    if ($status=='SEND') {
                       
                       echo '<button type="button" class="btn btn-outline-warning">waiting for approval</button>'; 
                    }else
                    {
                        echo '<button type="button" class="btn btn-outline-success"> approved</button>';
                    }
                    ?>
                        
                    </td> -->
                  
                    <td style="width: 24%"><a href="edit_fabric_dc_out.php?id=<?php echo addslashes($coldata['dc_no']);?>&to=<?php echo addslashes($coldata['to_process']);?>&from=<?php echo addslashes($coldata['from_addr']);?>&order=<?php echo addslashes($coldata['order_no']);?>&style=<?php echo addslashes($coldata['style_no']);?>"><i class="fas fa-edit"></i></a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!-- <a href="view_yarn_po.php?id=<?php echo addslashes($coldata['dc_no']);?>" ><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --><a href="fabric_dc_out_return.php?id=<?php echo $coldata['dc_no'];?>&name=<?="delete"?>"><i class="fas fa-trash"></i></a> </td>
                    </tr>
                    <?php
                     $c++;  }
                    ?>
                                        </tbody>
                                    </table>
                                </div>
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