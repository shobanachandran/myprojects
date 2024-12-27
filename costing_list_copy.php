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
    <title><?php echo SITE_TITLE;?> - Costing List </title>
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
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
		<form name="costing_list" id="costing_list" method="post">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Costing List</h4>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="costing.php"> <button type="button" class="btn btn-info">Costing Process</button></a>

                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a style="background-color:#626F80; color:#fff; color:#fff; margin:10px; padding:10px;" href="costing_entry.php">Add New Costing </a></li>
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Merch</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
										<a href="costing.php">Costing</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

			<div class="ml-auto text-left">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item">
										<label for="fname" style="font-size:16px;">&nbsp;Costing No</label>
											<select data-placeholder="Begin typing a name to filter..." 
											multiple class="chosen-select" 
											class="select2 form-control custom-select"  
											style="width: 200px;height: 40px; text-align:center;" 
											name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
											<option value="">Select</option>
											<?php $sel_buyer = mysqli_query($zconn,
											"select * from costing_entry_master where 1 group by costing_no");
											while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
											if($_POST['sel_buyer']==$res_buyer['id']){
												?>
											<option selected value="<?php echo $res_buyer['id'];?>">
											<?php echo $res_buyer['costing_no'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_buyer['id'];?>">
											<?php echo $res_buyer['costing_no'];?>
											   <h2>  - (<?php echo $res_buyer['order_no'];?>)</h2></option>
											<?php 
											}
											} ?>
											</select>
											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
											<!-- <select name="" id="">
											<h2 style="font-size:30px;"><option value="hi">hi <b>(hello)</b></option></h2>
											</select> -->
									</li>
                                </ol>
                            </nav>
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
							<div class="card-body" style="min-height:500px;">
								<div class="table-responsive">
								
		  <table id="example" class="table table-striped table-bordered display">
				<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;" >
					<tr>
							<th>S.NO</th>
							<th>BUYER NAME</th>
							<th>STYLE CODE</th>
							<th>DATE</th>
							<th>TOTAL VALUE</th>
							<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
	<?php
			$sql_con='';
			if($_POST['sel_buyer']!=''){
				$sql_con=" where id='".$_POST['sel_buyer']."'";
			} else {
				$sql_con = "";
			}
				$costing_sql = mysqli_query($zconn,
				"select * from costing_entry_master ".$sql_con." order by id desc");
			$c=1;
			//}

			while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){
 
			$buyer_sql = mysqli_fetch_array(mysqli_query($zconn,
			"select buyer_name from buyer_master where buyer_id='".$res_costing['buyer_id']."' " ));

			$costing_date = date_from_db($res_costing['costing_date']);
			?>
			<tr id="delete_<?php echo $c;?>">
				<td><?php echo $c;?></td>
				<td><?php echo $buyer_sql['buyer_name'];?></td>
				<td><?php echo $res_costing['style_no'];?></td>
				<td nowrap><?php echo $costing_date;?></td>
				<td><?php echo round($res_costing['total_value']); ?></td>

				<td><a href="costing_entry.php?id=<?php echo addslashes($res_costing['id']);?>"><i class="fas fa-edit">

				</i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!--<a href="javascript:;" 
				onclick="$('#view_<?php echo $c;?>').slideToggle();"><i class="fas fa-eye"></i>
			</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><!--<a onclick="DeleteUsrId('<?php echo $c;?>');">
			<i class="fas fa-window-close"></i></a>-->
			<a href="javascript:;" onclick="costing_sheet(<?php echo addslashes($res_costing['id']);?>);">
			 <i class="fas fa-print"></i> </a>

   
			</tr>
			<!-- <tr id="view_<?php echo $c;?>" style="background-color:#fff; display:none;">
				<td colspan="6">
				<table id="test" class="table table-striped table-bordered display" style=" padding: 0px; font-size: 12px;">
					<tr style="background-color: #626F80;color: #fff;">
					<th>S.NO</th>
					<th>TYPE</th>
					<th>NAME</th>
					<th>COLOR</th>
					<th>CONTENT</th>
					<th>UOM</th>
					<th>Rate</th>
					<th>Amount</th>
					</tr>
					<?php
					$sql_details = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$res_costing['id']."' ");
					$t=1;
					while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){
					extract($res_details);
					?>

					<tr>
						<td><?php echo $t;?></td>
						<td><?php echo $yarn_type;?></td>
						<td><?php echo $yarn_name;?></td>
						<td><?php echo $yarn_colour;?></td>
						<td><?php echo $yarn_content;?></td>
						<td><?php echo $uom_id;?></td>
						<td><?php echo $yarn_rate;?></td>
						<td><?php echo $yarn_total;?></td>
					</tr>
					<?php $t++;} ?>
				</table>
			</td>
			</tr> -->
			<?php $c++;} 

			// } ?>
					</tbody>
				</table>
				
			</div>
			</form>
							</div>
                        </div>
                    </div>
                </div>
            </div>
			<br>
			<br>
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
		function costing_sheet(cost_id){
			 window.open("cost_page_copy.php?costing_no="+cost_id, "Costing Sheet", "width=800,height=700");
		}
	</script>
    <script>
		$(document).ready(function() {
			//$('#example').DataTable();
			$('.display').DataTable();
		});
	</script>

</body>
</html>