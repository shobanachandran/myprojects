<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['name'])=='delete'){
    $id=$_REQUEST['id'];
    $delete=mysqli_query($zconn,"delete from process_dc_out where dc_no='$id'");
    $delete=mysqli_query($zconn,"delete from process_dcout_master where dc_no='$id'");

    if($delete){
        echo '<script> alert("Record has been delete successfully deleted!")</script>';
    }
}


if($_REQUEST['act']=='confirm_po'){
	$update_po = mysqli_query($zconn,"update general_po set status='Approved' where po_no='".$_REQUEST['id']."'");
	if($update_po){
		echo "<script>alert('PO Approved successfully!!');</script>";
	echo "<script>window.location.href='general_po_confirm.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - PROCESS GENERAL PO EDIT</title>
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
                        <h4 class="page-title">GENERAL PO LIST</h4>
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
                                                <th style="width: 8%">S. NO</th>
                                                <th style="width: 10%">DATE</th>
												<th style="width: 10%">PO.NO</th>
                                                <th style="width: 16%">PARTY NAME</th>
                                                <th style="width: 10%">PROCESS</th>
                                                <th style="width: 8%">PARTICULARS</th>
                                                <th style="width: 8%">STYLE NO</th>
								                <th style="width: 10%">QTY</th>
												<th style="width: 10%">PRINT</th>
											</tr>
										</thead>
										<tbody>
											<?php
						$costing_sql = mysqli_query($zconn,"SELECT po_no, MIN(po_date) as po_date, MIN(`desc`) as `desc`, MIN(to_address) as to_address, MIN(to_process) as to_process, MIN(pcs_wgt) as pcs_wgt, MIN(price) as price, MIN(status) as status
FROM general_po
GROUP BY po_no");
            $c=1;
            while($coldata = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){

            $style=$coldata['style_no'];
					?>
					<tr>
						<td><?php echo $c;?></td>
                        <td><?php echo $coldata['po_date']; ?></td>
						<td><?php echo $coldata['po_no'];?></td>
                        <td><?php echo $coldata['to_address']; ?></td>
                        <td><?php echo $coldata['to_process']; ?></td>
						<td><?php echo $coldata['desc'];?></td>
						<td><?php echo $coldata['style_no'];?></td>
						<td><?php echo $coldata['received_wgt']; ?></td>
		<td>
						<?php
                    $status=$coldata['status'];
					$po_no = $coldata['po_no'];
                    if ($status=='pending') {
                       echo '<button type="button" class="btn btn-outline-warning" onclick="approve('.$po_no.');">waiting for approval</button>'; 
                    } else {
                        echo '<button type="button" class="btn btn-outline-success"> approved</button>';
                    }
                    ?>
                    </td>

						
                       <!-- <td><a href="javascript:;" onclick="print_sheet(<?php echo addslashes($coldata['dc_no']);?>);">
			<i class="fas fa-print"></i></a>
                        </td> -->
                    </tr>
					<?php
					 $c++;	}
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
		function approve(po_id){
		window.location.href="general_po_confirm.php?act=confirm_po&id="+po_id;
	}
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

<script>
		function print_sheet(dc_no){
			 window.open("general_po_print.php?dc_no="+dc_no, "Costing Sheet", "width=800,height=700");
		}
	</script>
	
<script>
  function updateStatus(po_no) {
    console.log('Updating status for PO:', po_no);
    $.ajax({
        type: "POST",
        url: "generalpo/update_status.php",
        data: { po_no: po_no, status: 'Approved' },
        success: function(response) {
            console.log('Response:', response);
            if (response.trim() === 'success') {
                alert('Status updated to Approved');
                $('button[onclick="updateStatus(' + po_no + ')"]').replaceWith('<button type="button" class="btn btn-outline-success">approved</button>');
            } else {
                alert('Failed to update status: ' + response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('AJAX Error: ' + error); // Display AJAX error
        }
    });
}

</script>



</body>
</html>