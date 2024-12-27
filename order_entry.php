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
    <title><?php echo SITE_TITLE;?> - Order Entry</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
	    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">

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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Order Entry&nbsp;&nbsp;</h4>
						<div class="btn-group">
									 <a class="dropdown-item" href="order_entry_new.php" 
                                     class="btn btn-success dropdown-toggle" style="background-color:green; color:#fff;">
									New Order Entry</a>
								</div><!-- /btn-group -->
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Order Info</a></li>
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
								<div class="card-body" style="width:100%">
									<table id="example" class="table table-striped table-bordered">
									<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th>SNO</th>
												<th nowrap>ORDER NO</th>
												<th>STYLE NO</th>
												<th>BUYER NAME</th>
												<th>COSTING NO</th>
												<th>ORDER QTY</th>
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
			<?php $sel_orders = mysqli_query($zconn,"select * from order_entry_master ORDER BY costing_no DESC");
			$i=1;
			while($res_orders = mysqli_fetch_array($sel_orders,MYSQLI_ASSOC)){
				$costing_sql = mysqli_fetch_array(mysqli_query($zconn,"select costing_no from 
                costing_entry_master where id='".$res_orders['costing_no']."'"),MYSQLI_ASSOC);

				?>
						<tr>
							<td><?php echo $i;?></td>
							<td nowrap><?php echo $res_orders['order_no'];?></td>
							<td><?php echo $res_orders['style_no'];?></td>
							<td><?php echo $res_orders['buyer_name'];?></td>
							<td><?php echo $costing_sql['costing_no'];?></td>
							<td><?php echo $res_orders['order_qty'];?></td>
							<td><a href='order_entry_edit.php?order_id=<?php echo $res_orders['order_id']; ?>'>
                            <i class='fas fa-edit'></i></a>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <a href="javascript:;" onclick="costing_sheet(<?php echo addslashes($res_orders['order_id']);?>);">
			 <i class="fas fa-print"></i> </a> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                            <!--a href='javascript:;' onclick="DeletejwId('<?php echo $res_orders['order_id']; ?>')">
							<i class='fas fa-window-close'></i></a-->
							  &nbsp;&nbsp;&nbsp;
    <!--a href='order_entry_view.php?order_id=<?php echo $res_orders['order_id']; ?>'>
		<i class='fas fa-print'></i> </a-->
								
</td>
							<script>
								function printOrder(orderId) {
    // Add your code here to print the order with the given orderId
    // You can use window.print() to trigger the print dialog.
    // For example:
    // window.open('print_page.php?order_id=' + orderId, '_blank');
}

								</script>
								
						</tr>
									 <?php $i++;} ?>
										</tbody>
									</table>
							</div>
						</div>
					</div>
					<!-- Sales chart -->
		<!-- ============================================================== -->
				</div>
				<!-- End Container fluid  -->
        <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
            <!-- ============================================================== -->
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
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
<script>
		function costing_sheet(order_id){
			 window.open("order_entry_view.php?order_id="+order_id, "Costing Sheet", "width=800,height=700");
		}
	</script>
	 <script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
	 <script>
    function DeletejwId(ID){
	   var UsrStatus = confirm("Are you sure to delete this ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/advan.php',
			data: {
			   action: 'orderdelete',
			   typeid: ID
			},
			success: function( data ) {
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
				}
				if($.trim(data)=='1'){
					alert("Deleted Successfully");
                    location.reload(true);
				}
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
	  }
	  }
        // Basic Example with form
    var form = $("#example-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
     form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            alert("Submitted!");
        }
    });
    </script>
</body>
</html>