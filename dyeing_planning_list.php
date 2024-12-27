<?php
include('includes/config.php');
include('includes/base_functions.php');

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
    <title><?php echo SITE_TITLE;?> - Dyeing Planning List</title>
    <!-- Custom CSS -->

    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="dist/css/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>

 

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
					<form name="dyeing_planning" method="post">

        <div class="page-wrapper" >
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dyeing Planning List</h4>
                        <h4 class="page-title"></h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="planning.php"> 
							<button type="button" class="btn btn-info">Process Planning</button></a>

                            <div class="ml-auto text-left">
						<nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item">
                                    <label for="fname" style="font-size:16px;padding-left:10px;">Indent No</label>

						<div class="col-sm-6">
                        <select 
											class="select2 form-control custom-select chosen-select" 
                                            style="width: 200px;height: 40px; text-align:center;" 
                                            name="sel_buyer" id="sel_buyer" onchange="this.form.submit();">
											<option value="">Select</option>
											<?php $sel_buyer = mysqli_query($zconn,
                                            "select * from dyeing_planning_master order by id");
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
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Merch</li>

                                    <li class="breadcrumb-item active" aria-current="page">
                                    <a href="planning.php">Process Palnning</a></li>
                                </ol>
                            </nav>
                        </div>
						<!-- <div class="btn-group">
								 <a class="dropdown-item" 
                                 style="background-color:#27A9E3; color:#fff; font-weight:bold;"
                                  href="dyeing_planning.php">New Dyeing Planning </a>
						</div> -->
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
								<div class="table-responsive" style="overflow:hidden;">
                                <div class="row" style="float:right;">
                                        <div class="col-sm-12" style="float:right;" >
                                            <a href="dyeing_planning.php">
                                                <button type="button" class="btn btn-success">Add</button></a>
                                         </div>
                                    </div> 
									</div>
                                </div>
								<!-- <form name="costing_list" id="costing_list" method="post"> -->
                                <table id="example" class="table table-striped table-bordered display">
									<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">

								<tr>
									<th>S.No</th>
									<th>INDENT NO</th>
									<th>STYLE CODE</th>
									<th>TOTAL WEIGHT</th>
									<th>ACTION</th>
								</tr>
						</thead>
					<tbody>
	<?php
    if($_REQUEST['sel_buyer']!=''){
        $sql_buer = "where order_no='".$_REQUEST['sel_buyer']."'";
    } else {
        $sql_buer = "";
    }
			$costing_sql = mysqli_query($zconn,"select * from dyeing_planning_master ".$sql_buer."ORDER BY id DESC");
			$c=1;
			while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){
                $style=$res_costing['style_no'];

			$costing_date = date_from_db($res_costing['costing_date']);
			?>
			<tr id="delete_<?php echo $c;?>">
				<td><?php echo $c;?></td>
				<td><?php echo $res_costing['order_no'];?></td>
				<td><?php echo $res_costing['style_no'];?></td>
				<td><?php echo $res_costing['grand_total'];?></td>
				<td><a href="edit_dyeing_planning.php?id=<?php echo addslashes($res_costing['id']);?>">
                <i class="fas fa-edit"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" >
                    <!-- <i class="fas fa-print"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a onclick="DeleteUsrId('<?php echo $c;?>');"><i class="fas fa-window-close"></i></a></td>-->
			</tr>
			

			<?php $c++;} ?>
					</tbody>
				</table>
			</div>
			<!-- </form> -->
							</div>
						</div>
					</div>
                    </div>
					<!-- Sales chart -->
				</div>
				<!-- End Container fluid  -->
         <!-- </div>  -->
        <!-- End Page wrapper  -->		 
    <!-- </div>
	</div> -->
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>

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
	<script type="text/javascript">

$(document).ready(function() {
		$('#example').DataTable();
	});
// +$(d
	 $(document).bind("pageinit", function() {
    $(".chzn-select").chosen();
});

		$(".chosen-select").chosen({
		no_results_text: "Oops, nothing found!"
		})
	
		$(document).ready(function() {
			$(".chzn-select").chosen();

		$('#example').DataTable();
		});
		
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