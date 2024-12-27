<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['name'])=='delete'){
    $id=$_REQUEST['id'];
    $delete = mysqli_query($zconn,"delete from yarns_po_details where po_id='$id'");
    $delete = mysqli_query($zconn,"delete from yarns_po_master where id='$id'");

    if ($delete){
        echo '<script> alert("Record has been delete successfully deleted!")</script>';
    }
}

if($_REQUEST['act']=='confirm_po'){
	$update_po = mysqli_query($zconn,"update yarns_po_master set status='Approved' where id='".$_REQUEST['id']."'");
	if($update_po){
		echo "<script>alert('PO Approved successfully!!');</script>";
	echo "<script>window.location.href='yarn_confirm_po.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - YARN PO APPROVAL</title>
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
        <!-- Topbar header - style you can find in pages.scss -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">YARN PO APPROVAL</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
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
											<th style="width: 10%">PO NO</th>
											<th style="width: 10%">DATE</th>
											<th style="width: 20%">TO ADDRESS</th>
											<th style="width: 20%">TOTAL WEIGHT</th>
											<th style="width: 15%">STATUS</th>
											<th style="width: 15%">ACTION</th>
										</tr>
									</thead>
									<tbody>
				<?php
				$costing_sql = mysqli_query($zconn,"select * from yarns_po_master");
				$c=1;
				while($coldata = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){
					$style=$coldata['style_no'];
				?>
					<tr>
						<td><?php echo $c;?></td>
						<td><?php echo $coldata['po_no'];?></td>
						<td><?php echo $coldata['date']; ?></td>
						<td><?php echo $coldata['buyer']; ?></td>
						<td><?php echo $coldata['grant_total']; ?></td>
						<td>
						<?php
                    $status=$coldata['status'];
					$po_id = $coldata['id'];
                    if ($status=='SEND') {
                       echo '<button type="button" class="btn btn-outline-warning" onclick="approve('.$po_id.');">waiting for approval</button>'; 
                    } else {
                        echo '<button type="button" class="btn btn-outline-success"> approved</button>';
                    }
                    ?>
                    </td>
					<td style="width: 24%">
					<!-- <?php// if ($status=='SEND') { ?> -->
					<!--a href="yarn_po_edit.php?id=<!?php echo addslashes($coldata['id']);?>">-->
                    <!--i class="fas fa-edit"></i></a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                    <a href="yarn_po_edit.php?id=<?php echo addslashes($coldata['id']);?>" ><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <!-- <a href="yarn_po_list.php?id=<?php echo $coldata['id'];?>&name=<?="delete"?>"><i class="fas fa-trash"></i></a>  -->
					<!-- <?php //} else { ?> -->
					<!-- <a href="view_yarn_po.php?id=<?php echo addslashes($coldata['id']);?>" ><i class="fas fa-eye"></i></a> -->
					<!-- <?php //} ?> -->
					</td>
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
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
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
		window.location.href="yarn_confirm_po.php?act=confirm_po&id="+po_id;
	}
	$(document).ready(function() {
		$('#example').DataTable();
	});
	function DeleteUsrId(ID){
		var UsrStatus = confirm("Are you sure to delete this company details ?");
		if(UsrStatus){
			$('#delete_'+ID).hide();
		}
	}
	</script>

</body>
</html>