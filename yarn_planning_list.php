<?php 
include('includes/config.php');
include('includes/base_functions.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - Yarn planning List </title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
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
		<form name="costing_list" id="costing_list" method="post">

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Yarn Planning List</h4>
						<h4 class="page-title"></h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="planning.php"> 
							<button type="button" class="btn btn-info">Process Planning</button></a>
							<div class="ml-auto text-left">
						<nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item">
						<label for="fname" style="font-size:16px;padding-left:10px;">Indent No</label>
						<div class="col-sm-3">
										<select 
											class="select2 form-control custom-select chosen-select" 
                                            style="width: 200px;height: 40px; text-align:center;" 
                                            name="sel_buyer" id="sel_buyer" onchange="this.form.submit();">
											<option value="">Select</option>
											<?php $sel_buyer = mysqli_query($zconn,
                                            "select * from yarn_entry_master where 1 group by id");
											while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
											if($_POST['sel_buyer']==$res_buyer['id']){
												?>
											<option selected value="<?php echo $res_buyer['id'];?>">
                                            <?php echo $res_buyer['order_no'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_buyer['order_no'];?>">
                                            <?php echo $res_buyer['order_no'];?> 
                                            - (<?php echo $res_buyer['style_no'];?>)</option>
											<?php 
											}
											} ?>
											</select>
							
											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												
							</li>
                                </ol>
                            </nav>
										</div>
										<div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item">
										<!-- <a style="background-color:#2399CE; color:#fff; color:#fff; margin:10px; padding:10px;" href="knitting_planning.php">Add New</a></li> -->
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Merch</li>
									<li class="breadcrumb-item active" aria-current="page"><a href="planning.php">Process Palnning</a></li>
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
								<div class="table-responsive" style="overflow:hidden;">
								<div class="row" style="float:right;">
                                        <div class="col-sm-12" style="float:right;" >
                                            <a href="yarn_planning.php">
                                                <button type="button" 
												class="btn btn-success">Add</button></a>
                                         </div>
                                    </div> 
									</div>
									</div>
		  <table id="example" class="table table-striped table-bordered display">
				<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;" >
					<tr>
							<th>S.No</th>
							<th>INDENT NO</th>
							<th>STYLE NO</th>
							<!-- <th>Buyer Name</th> -->
							<th>TOTAL VALUE</th>
							<th>Action</th>
					</tr>
				</thead>
				<tbody>
	<?php
			$sql_con='';
			if($_POST['sel_buyer']!=''){
				$sql_con=" where order_no='".$_POST['sel_buyer']."'";
			}
			$costing_sql = mysqli_query($zconn,"select * from yarn_entry_master ".$sql_con."  ORDER BY id DESC");
			$c=1;
			while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){

			
 
			$buyer_sql = mysqli_fetch_array(mysqli_query($zconn,
			"select buyer_name from buyer_master where buyer_id='".$res_costing['buyer_id']."' "));

			$costing_date = date_from_db($res_costing['yarn_date']);
			?>
			<tr id="delete_<?php echo $c;?>">
				<td><?php echo $c;?></td>
				<td><?php echo $res_costing['order_no'];?></td>
				<td><?php echo $res_costing['style_no'];?></td>
				<!-- <td nowrap><?php echo $buyer_sql['buyer_name'];?></td> -->
				<td><?php echo $res_costing['total_value'];?></td>
				<td><a href="edit_yarn_planning.php?id=<?php echo addslashes($res_costing['id']);?>">
				<i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- <a onclick="DeleteUsrId('<?php echo $c;?>');"><i class="fas fa-window-close"></i></a>-->
				<a href="javascript:;" onclick="costing_sheet(<?php echo addslashes($res_costing['id']);?>);"><i class="fas fa-print"></i></a></td>
			</tr>
			
			<?php $c++;} ?>
					</tbody>
				</table>
			</div>
			</form>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('includes/footer.php');?>
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<!--datatables JavaScript -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script>
		$(document).ready(function() {
			//$('#example').DataTable();
			$('.display').DataTable();
		});
	</script>
	<script>
		function costing_sheet(id){
			 window.open("planning_print.php?id="+id, "Costing Sheet", "width=800,height=700");
		}
	</script>

</body>
</html>