<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_POST['submit'])){
	$grp_name = $_POST['ta_group_name'];
	$acc_count = count($_POST['ta_name']);
	$acc_list = '';
	for($i=0;$i<$acc_count;$i++){
		$acc_list .= $_POST['ta_name'][$i].',';
	}
	$acc_list = substr($acc_list,0,-1);

	$insert_acc =  mysqli_query($zconn,"update ta_grouping set ta_group_name='".$grp_name."', ta_names='".$acc_list."' where id='".$_POST['editid']."' ");
	if($insert_acc){
		echo "<script>alert('Group updated successfully!!');</script>";
		echo "<script>window.location.href='ta_grouping.php';</script>";
	}
}


if($_GET['id']!=''){
	$sel_group = mysqli_query($zconn,"select * from ta_grouping where id='".$_GET['id']."'");
	$res_group = mysqli_fetch_array($sel_group,MYSQLI_ASSOC);
	$accnames = explode(',',$res_group['ta_names']);
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
    <title><?php echo SITE_TITLE;?> - T&A Grouping Add</title>
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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
           <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"> Grouping Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="ta_grouping.php"> Grouping Info</a></li>
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
				<form method="post" name="buyer_acc">
				<input type="hidden" name="editid" id="editid" value="<?php echo $_GET['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label"> Group Name</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" name="ta_group_name" id="fname" placeholder="Group name" value="<?php echo $res_group['ta_group_name'];?>">
										</div>
									</div>
									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
											<tr>
												<th>Group Name</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody>
										<?php
										for($j=0;$j<count($accnames);$j++){ ?>	
											<tr id="delete_<?php echo $j;?>">
												<td>
					<select class="select2 form-control custom-select" style="" name="ta_name[]">
					<option>-Select-</option>
					<?php
				$acc_sql = mysqli_query($zconn,"select * from ta_manage where status='0'");
					while($res_acc = mysqli_fetch_array($acc_sql,MYSQLI_ASSOC)){
						if($res_acc['ta_name']==$accnames[$j]){ ?>
							<option selected value="<?php echo $res_acc['ta_name'];?>"><?php echo $res_acc['ta_name'];?></option>
						<?php } else { ?>
							<option value="<?php echo $res_acc['ta_name'];?>"><?php echo $res_acc['ta_name'];?></option>
						<?php }  } ?>
					</select>
					</td>
					<td>
						<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
					</td>
				</tr>
										<?php } ?>
										</tbody>
									</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" class="btn btn-success"name="submit">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="ta_grouping.php"><button type="button" class="btn btn-danger">Back</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
           <!--==============================================================-->
            </div>
			</form>
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
	<?php
		$acc_sql = mysqli_query($zconn,"select * from ta_manage where status='0'");
		$acc_list='';
		while($res_acc = mysqli_fetch_array($acc_sql,MYSQLI_ASSOC)){
			$acname = $res_acc['ta_name'];
			$acc_list .='<option value="'.$acname.'">'.$acname.'</option>';
		}
	 ?>
	<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
	//	$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
		var acc_list = '<?php echo $acc_list;?>';
        var row = '<tr>' +
            '<td><select class="select2 form-control custom-select" name="ta_name[]"><option>--Select--</option>'+acc_list+'</select></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("table").append(row);
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
		//	if(!$(this).val()){
		//		$(this).addClass("error");
		//		empty = true;
		//	} else{
        //        $(this).removeClass("error");
        //    }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});
</script>
</body>
</html>