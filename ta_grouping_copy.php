<!-- <?php 
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
    <title><?php echo SITE_TITLE;?> - T & A Grouping</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	

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
                        <h4 class="page-title">T & A Grouping </h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="admin_master.php"> <button type="button" class="btn btn-info">Admin Master</button></a>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">							
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="ta_grouping_add.php"><button type="button" class="btn btn-success">Add</button></a></li>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
								
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
											<tr>
												<th>S.No</th>
												<th>T & A Group Name</th>
												<th>T & A Managements</th>
												<th>Commitment Days</th>
												<th>Assignee</th>

												<!-- <th>Status</th> -->
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
                                        <?php $sel_group = mysqli_query($zconn,"select * from ta_grouping");
										$g=1;
										while($res_group = mysqli_fetch_array($sel_group,MYSQLI_ASSOC)){
										?>
											<tr id="delete_<?php echo $res_group['id'];?>">
												<td><?php echo $g;?></td>
												<td><?php echo $res_group['ta_group_name'];?></td>
												<td><?php echo $res_group['ta_names'];?></td>
                                                <td><?php echo $res_group['commitment_days'];?></td>
                                                <td><?php echo $res_group['assignee'];?></td>

                                                <!-- <td><?php echo $res_group['status'];?></td> -->
												<td><a href="ta_grouping_edit.php?id=<?php echo $res_group['id'];?>" title="Edit">
                                                <i class="fas fa-edit"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:;" title="Delete" onclick="DeleteUsrId('<?php echo $res_group['id'];?>');"><i class="fas fa-window-close"></i></a> </td>
											</tr>
										<?php $g++;} ?>
											<!-- <tr id="delete_1">
												<td>1</td>
												<td>Group-1</td>
												<td>www, eee, rrr, ttt</td>
												<td>25</td>
												<td>Active</td>
												<td><i class="fas fa-edit"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a onclick="DeleteUsrId('1');"><i class="fas fa-window-close"></i></a> </td>
											</tr> -->
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
	$(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete user type ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	  }
	</script>	

</body>
</html> -->