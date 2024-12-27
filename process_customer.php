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
    <title><?php echo SITE_TITLE;?> - Party Type</title>
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
                        <h4 class="page-title">Party Type List</h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="admin_master.php"> <button type="button" class="btn btn-info">Admin Master</button></a>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="process_customer_add.php"><button type="button" class="btn btn-success">Add</button></a></li>
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
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
									<tr>
										<th style="width:2%;">S.No</th>
										<th style="width:12%;">Party Type</th>
										<th style="width:8%;" nowrap>Party Code</th>
										<th style="width:15%;">Party Name</th>
										<th style="width:8%;">Mobile No</th>
										<th style="width:20%;">Address</th>
										<th style="width:8%;">Status</th>
										<th style="width:5%;">Action</th>
									</tr>
										</thead>
										<tbody>
						<?php $sel_supp = mysqli_query($zconn,"select * from process_customer where status='0'");
						$s=1;
						while($res_supp = mysqli_fetch_array($sel_supp,MYSQLI_ASSOC)){
							extract($res_supp);
							$stype = mysqli_fetch_array(mysqli_query($zconn,"select * from process_master where status='0' and id='".$res_supp['party_type_id']."'"),MYSQLI_ASSOC);
							$supp_status='';
										if($res_supp['status']=='0'){
											$supp_status='Active';
										} else {
											$supp_status='In Active';
										}supplier
						?>
							<tr id="delete_<?php echo $party_id;?>">
								<td><?php echo $s;?></td>
								<td><?php echo $stype['process_name'];?></td>
								<td><?php echo $party_code;?></td>
								<td><?php echo $party_name;?></td>
								<td><?php echo $party_mobile;?></td>
								<td><?php echo $party_address1."<br>".$party_address2;?></td>
								<td><?php echo $supp_status;?></td>
								<td nowrap><a title="Edit" href='process_customer_add.php?colid=<?php echo $res_supp['party_id']; ?>'>
                                <i class='fas fa-edit'></i></a> &nbsp;&nbsp; 
                                <a title="Delete" href='javascript:;' onclick='DeleteSuppId("<?php echo $res_supp['party_id'] ?>");'>
                                <i class='fas fa-window-close'></i></a></td>
							</tr>

						<?php $s++;} ?>
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
	function DeleteSuppId(ID){
	  var UsrStatus = confirm("Are you sure to delete this party details ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/suppliers.php',
			data: {
			   action: 'suppdelete',
			   typeid: ID
			},
			success: function( data ) {
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
				}
				if($.trim(data)=='1'){
					alert("Party Deleted Successfully");
					document.getElementById("delete_"+ID).style.display = "none";
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