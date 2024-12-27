<?php
try{
	error_reporting(0);
	include("includes/config.php");
	extract($_REQUEST);
	$currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currentFile = $parts[count($parts) - 1];


	//$rights = check_rights($zconn,$currentFile);

	if($_SESSION['userid'] == '') { ?>
		<script>window.location='logout.php';</script>
	<?php exit();
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
    <title><?php echo SITE_TITLE;?>  - Investor</title>
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
		<?php include("includes/header.php");?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
       <?php include("includes/sidebar.php");?>
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
                        <h4 class="page-title">Investors</h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="accounts_master.php"> <button type="button" class="btn btn-info">Accounts Master</button></a>
                       			
						<div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">							
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="investors_add.php"><button type="button" class="btn btn-success">Add</button></a></li>
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
                                            <th>S.No</th>
												<th>Investor Name</th>
												<th>Value</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
						$sectUsrQry = "SELECT * FROM investors ORDER BY inv_id desc";
						$secUsrResource = mysqli_query($zconn,$sectUsrQry);
						$ut=1;
						while($userdata = mysqli_fetch_array($secUsrResource,MYSQLI_ASSOC)){
					?>
					<tr id="delete-<?php echo $userdata['inv_id'];?>">
						<td><?php echo $ut; ?></td>
						<td><?php echo $userdata['inv_name']; ?></td>
						<td> <?php echo $userdata['inv_value']; ?></td>
						<td><?php echo $userdata['status']; ?></td>
						<td><a href="investors_add.php?typeid=<?php echo $userdata['inv_id']; ?>"><i class="fa fa-fw fa-edit"></i></a>  | <a onclick="DeleteUsrId('<?php echo $userdata['inv_id']; ?>')"><i class="fa fa-fw fa-times"></i></a> 
					   <?php //} ?>
						</td>
					</tr>
					<?php
						$ut++; }
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
	  var UsrStatus = confirm("Are you sure to delete this Type details ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/investors.php',
			data: {
			   action: 'invdelete',
			   typeid: ID
			},
			success: function( data ) {
				$('.loader').hide(); // hide the loading message.
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
					$('.loader').hide();
				}
				if($.trim(data)=="exist"){
					alert("Investor Exist in the User(s) Data!!");
					$('.loader').hide();
				}
				
				if($.trim(data)==true){
					alert("Investor Deleted Successfully");
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
<?php
} 
catch(Exception $e) {
	echo 'Unknown Error. Try again.';
}
?>