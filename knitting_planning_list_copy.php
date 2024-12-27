<?php 
include('includes/config.php');
include('includes/base_functions.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if (isset($_REQUEST['id'])) {
	$delete=mysqli_query($zconn,"delete from knitting_planning_master where id='".$_REQUEST['id']."'");
	$delete=mysqli_query($zconn,"delete from knitting_planning where knitt_id='".$_REQUEST['id']."'");
}


//print_r($_REQUEST);
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
    <title><?php echo SITE_TITLE;?> - Knitting Planning List </title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	<style>
	.chosen-container { width:200px !important;}
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
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
			<form method="post" name="knitting_planning">
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Knitting Planning Process</h4>
						<h4 class="page-title"></h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="planning.php"> 
							<button type="button" class="btn btn-info">Process Planning</button></a>
  			  <div class="ml-auto text-left">
						<nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item">
						<label for="fname" style="font-size:16px;padding-left:10px;">Order No</label>

						<div class="col-sm-3">

								<?php $select=mysqli_query($zconn,"select * from knitting_planning_master order by id");
									while($data=mysqli_fetch_object($select)){
										$order_no1[]=$data->order_no;
										 } 
								?>
								 <select data-placeholder="Begin typing a name to filter..." 
								 class="chosen-select" class="select2 form-control custom-select"
								  name="order_no" id="order_no" onchange="this.form.submit()" >
								<option>Select</option>	
								<?php  foreach($order_no1 as $order_no){
								?>
								 <option value="<?php echo $order_no?>"
								 <?php if(in_array($order_no,$_REQUEST['Style'],true)){?> selected="selected"<?php }?>>
								 <?php echo $order_no;?>-<?php echo $data['order_no'];?></option>
								<?php }  ?>

							</select>

							</li>
                                </ol>
                            </nav>
                        </div>
						</form>

                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item">
										<!-- <a style="background-color:#2399CE; color:#fff; color:#fff; margin:10px; padding:10px;" href="knitting_planning.php">Add New</a></li> -->
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Merch</li>
									<li class="breadcrumb-item active" aria-current="page">Process Palnning</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
			<!-- </form> -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Sales chart -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
								<div class="table-responsive" style="overflow:hidden;">
								<div class="row" style="float:right;">
                                        <div class="col-sm-12" style="float:right;" >
                                            <a href="knitting_planning.php">
                                                <button type="button" class="btn btn-success">Add</button></a>
                                         </div>
                                    </div> 
									</div>
                            </div>
					<!--<form name="costing_list" id="costing_list" method="post">-->
						<table id="example" class="table table-striped table-bordered display">
									<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th>S.No</th>
												<th>FABRIC NAME</th>
												<th>ORDER NO</th>
												<th>STYLE NO</th>
												<th>TOTAL VALUE</th>
												<th>Action</th>
											</tr>
									</thead>
									<tbody>
	<?php
			//print_r($_POST);
			$costing_sql = mysqli_query($zconn,"select * from knitting_planning_master where  order_no ='".$_POST['order_no']."'");
			$c=1;
			while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){
			  $style=$res_costing['style_no'];

			//   $buyer_sql = mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$style."'"));

			 $costing_date = date_from_db($res_costing['costing_date']);
			?>
			<tr id="delete_<?php echo $c;?>">
				<td><?php echo $c;?></td>
				<td><?php echo $res_costing['fabric_name'];?></td>
				<td><?php echo $res_costing['order_no'];?></td>
				<td><?php echo $res_costing['style_no'];?></td>
				<td><?php echo number_format($res_costing['grand_total'],2);?></td>
				<td><a href="edit_planning.php?id=<?php echo addslashes($res_costing['id']);?>"><i class="fas fa-edit"></i></a> <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="view_knitt_planning.php?id=<?php echo addslashes($res_costing['id']);?>"><i class="fas fa-eye"></i></a>-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="knitting_planning_list.php?id=<?php echo ($res_costing['id']);?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
			</tr>
		
			<?php $c++;} ?>
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
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<!--datatables JavaScript -->
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
+$(document).bind("pageinit", function() {
    $(".chzn-select").chosen();
});

		$(".chosen-select").chosen({
		no_results_text: "Oops, nothing found!"
		})
	
		$(document).ready(function() {
			$(".chzn-select").chosen();

		$('#example').DataTable();
		});
	</script>

</body>
</html>