<?php 
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
    <title><?php echo SITE_TITLE;?> - Accessories PO</title>
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
                        <h4 class="page-title">Accessories PO</h4>&nbsp;&nbsp;&nbsp;&nbsp;
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
												<th>S.No</th>
												<th>STYLE NO</th>
												<th>ORDER NO</th>
												<th>ACCESSORY NAME</th>
												<th>CONTENT</th>
												<th>UOM</th>
												<th>CONSUMPTION</th>
												<th>ORDER QTY</th>
												<th>Balance Qty	</th>
												<th>Now Wanted</th>
												<th>Rate</th>
											</tr>
										</thead>
										<tbody>
											<tr id="delete_<?php echo $process_id;?>">
												<td><?php echo $sgl;?></td>
												<td><?php echo $process_name;?></td>
												<td><?php echo $sizes;?> </td>
												<td><?php echo $supp_status;?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><a href='process_group_add.php?colid=<?php echo $process_id; ?>'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteSgId("<?php echo $process_id; ?>");'><i class='fas fa-window-close'></i></a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				
				 <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
									<div class="form-group row">
										<label for="scode" class="col-sm-3 text-right control-label col-form-label">Po Number</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="scode"  name="scode" value="<?php echo $supplier_code;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
										<div class="col-sm-6">
                                        <input type="text" class="form-control" id="scode"  name="scode" value="<?php echo $supplier_code;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Yarn Po Date</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" required id="sname" name="sname" placeholder="Supplier name" value="<?php echo $colData['supplier_name'];?>" autocomplete="off">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">SGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" required name="txt_add1" id="txt_add1" autocomplete="off" value="<?php echo $colData['supplier_address1'];?>" placeholder="Address">
										</div>
									</div>


								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Received Date</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" autocomplete="off" id="smobile" value="<?php echo $colData['supplier_mobile'];?>" name="smobile" placeholder="mobile">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Comments</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" autocomplete="off" id="sphone" value="<?php echo $colData['supplier_phone'];?>" name="sphone" placeholder="Telephone">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">CGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="semail" name="semail" autocomplete="off" value="<?php echo $colData['supplier_email'];?>" placeholder="email">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">IGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" autocomplete="off" name="span_card" value="<?php echo $colData['supplier_pancard'];?>" id="span_card" placeholder="Pancard">
										</div>
									</div>

								</div>
							</div>
							<div class="border-top">
								<div class="card-body" style="text-align: center;">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="accessories_po.php"><button type="button" class="btn btn-danger">Back</button></a>
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
	function DeleteSgId(ID){
	 var UsrStatus = confirm("Are you sure to delete this details ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/products.php',
			data: {
			   action: 'processgroupdelete',
			   typeid: ID
			},
			success: function( data ) {
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
				}
				if($.trim(data)=='1'){
					alert("Deleted Successfully");
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