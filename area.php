<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

?><!DOCTYPE html>
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
    <title><?php echo SITE_TITLE;?> - Area</title>
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
                        <h4 class="page-title">Area List</h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="admin_master.php"> <button type="button" class="btn btn-info">Admin Master</button></a>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">							
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="area_add.php"><button type="button" class="btn btn-success">Add</button></a></li>
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
												<th>SNo</th>
												  <th>State Name</th>
												  <th>District Name</th>
												  <th>Area Name</th>
												  <th>Status</th>
												  <th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
					$sectBrnQry = "SELECT * FROM area WHERE deleted='N' order by id desc";
					$secBrnResource = mysqli_query($zconn,$sectBrnQry);
					$a=1;
					while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
						$sel_state = mysqli_fetch_array(mysqli_query($zconn,"select * from states where state_id='".$coldata['state_id']."'"),MYSQLI_ASSOC);
						$sel_distict = mysqli_fetch_array(mysqli_query($zconn,"select * from districts where dist_id='".$coldata['dist_id']."'"),MYSQLI_ASSOC);
					?>
				<tr id="delete-<?php echo $coldata['id'];?>">
				  <td><?php echo $a; ?></td>
				  <td><?php echo $sel_state['state_name']; ?></td>
				  <td><?php echo $sel_distict['dist_name']; ?></td>
				  <td><?php echo $coldata['area_name']; ?></td>
				  <td><?php echo $coldata['status']; ?></td>
				  <td><?php if(EDIT_RIGHTS=='1'){?><a href="area.php?colid=<?php echo $coldata['id']; ?>"><i class="fas fa-edit"></i></a> |<?php } ?><?php if(DELETE_RIGHTS=='1'){?><a onclick="DeleteColId('<?php echo $coldata['id']; ?>')"><i class="fa fa-fw fa-times"></i></a> <?php } ?></td>
				</tr>
					<?php
						$a++;}
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
	 function DeleteColId(ID){
			  var UsrStatus = confirm("Are you sure to delete this Area Information details ?");
			  if(UsrStatus){
				$.ajax({
					url : 'ajax/gst.php',
					data: {
					   action: 'areadelete',
					   typeid: ID
					},
					success: function( data ) {
					//	alert(data);
						$('.loader').hide(); // hide the loading message.
						if($.trim(data)=="error"){
							alert("Deleted Failed Kindly. Try again");
							$('.loader').hide();
						}
						if($.trim(data)=="exist"){
							alert("Area Information Exist in the Data(s)!!");
							$('.loader').hide();
						}
						if($.trim(data)==true){
							alert("Area Information Deleted Successfully");
							document.getElementById("delete-"+ID).style.display = "none";
							$('.loader').hide();
						}
					},
					error: function (textStatus, errorThrown) {
						//DO NOTHINIG
					}
				});
			  }
		   }
	</script>	

</body>
</html>