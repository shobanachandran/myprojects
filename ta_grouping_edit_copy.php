<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
$ta_group_name = $_POST['group_name'];
if(isset($_POST['submit1'])){
    extract($_POST);
    
   
    $ta_group_name= $_POST['ta_group_name'];
	$ta_rows = count($_POST['ta_names']);
   
	// $delete= mysqli_fetch_array(mysqli_query($zconn,"delete  from ta_grouping where ta_group_name='".$_REQUEST['id']."'"),MYSQLI_ASSOC);
  
	for($i=0;$i<$ta_rows;$i++){
       
		$insert_dept= mysqli_query($zconn,"UPDATE `ta_grouping` SET `ta_group_name`='".$_POST['ta_group_name']."',`ta_names` ='".$_POST['ta_names']."',`commitment_days`='".$_POST['commitment_days']."',`particulars`='".$_POST['particulars']."',`assignee`='".$_POST['assignee']."' WHERE id='".$_POST['editid']."'");
      
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
    <title><?php echo SITE_TITLE;?> - T & A Grouping Add</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">    
</head>

<body>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="hidden" name="editid" id="editid" value="<?php echo $_GET['id'];?>">
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
                        <h4 class="page-title">T & A Grouping Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="ta_grouping.php">T & A Grouping Info</a></li>
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
							</div>
								<div class="card-body" style="width:100%">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">T & A Group Name</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" id="ta_group_name" name="ta_group_name" placeholder="Group name" value="<?php echo $res_group['ta_group_name'];?>">
										</div>
									</div>
									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
											<tr>
												<th>T & A Management Name</th>
												<th>Commitment days</th>
												<th>Particular</th>
												<th>Assignee</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody>
                                            
                                        <?php
										for($j=0;$j<count($accnames);$j++){ ?>	
											<tr id="delete_<?php echo $j;?>">
												<td>
					<select class="select2 form-control custom-select" style="" name="ta_names[]">
					<option>-Select-</option>
					<?php
				$acc_sql = mysqli_query($zconn,"select * from ta_grouping");
					while($res_acc = mysqli_fetch_array($acc_sql,MYSQLI_ASSOC)){
						if($res_acc['ta_names']==$accnames[$j]){ ?>
							<option selected value="<?php echo $res_acc['ta_names'];?>"><?php echo $res_acc['ta_names'];?></option>
						<?php } else { ?>
							<option value="<?php echo $res_acc['ta_names'];?>"><?php echo $res_acc['ta_names'];?></option>
						<?php }  } ?>
					</select>
                    </td>
                    <td>
			<input type="text" class="form-control" id="commitment_days" name="commitment_days[]" placeholder="Commitment days" value="<?php echo $res_group['commitment_days']; ?>">
						</td>
                        <td>
			<input type="text" class="form-control" id="particulars" name="particulars[]" placeholder="Commitment days" value="<?php echo $res_group['particulars']; ?>">
						</td>
                        <td>
			<input type="text" class="form-control" id="assignee" name="assignee[]" placeholder="Commitment days" value="<?php echo $res_group['assignee']; ?>">
						</td>
					<td>
						<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
					</td>
				</tr>
										<?php } ?>
<!--                         
											<tr id="delete_1">
												<td>
														<select class="select2 form-control custom-select" name="ta_names[]" style="">
															<option>Multi Select</option>
                                                            <?php
											$ta_sql = mysqli_query($zconn,"select * from  grouping ");
											while($res_ta = mysqli_fetch_array($ta_sql,MYSQLI_ASSOC)){
											?>
											<option value="<?php echo $res_ta['ta_names'];?>"><?php echo $res_ta['ta_names'];?></option>
											<?php } ?>
														</select>
												</td>
												<td>
														<input type="text" class="form-control" id="commitment_day" name="commitment_days[]" placeholder="Commitment days ">
												</td>
												<td>
														<input type="text" class="form-control" id="particulars" name="particulars[]" placeholder="particulars">
												</td>
												<td>
														<select class="select2 form-control custom-select" id="assignee" name="assignee[]" style="">
															<option>Select</option>

                                                            <?php
											$user_sql = mysqli_query($zconn,"select * from   users");
											while($res_user = mysqli_fetch_array($user_sql,MYSQLI_ASSOC)){
											?>
											<option value="<?php echo $res_user['UNAME'];?>"><?php echo $res_user['UNAME'];?></option>
											<?php } ?>
														</select>
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr> -->
										</tbody>
									</table>
									
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="submit1" value="save" class="btn btn-success">Save</button>
									<button type="reset" name="" class="btn btn-primary">Reset</button>
									<a href="ta_grouping.php"><button type="button" class="btn btn-danger">Back</button></a>
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
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
		 
    </div>

    
    </form>
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
	<script type="text/javascript">
        <?php
	$sel_ta = mysqli_query($zconn,"select * from ta_manage");
	$ta_list='';
	while($res_ta=mysqli_fetch_array($sel_ta,MYSQLI_ASSOC)){ 
		$ta_list .="<option value='".$res_ta['ta_name']."'>".$res_ta['ta_name']."</option>";
		} 
		
		$sel_user = mysqli_query($zconn,"select * from users");
	$user_list='';
	while($res_user=mysqli_fetch_array($sel_user,MYSQLI_ASSOC)){ 
		$user_list .="<option value='".$res_user['UNAME']."'>".$res_user['UNAME']."</option>";
		} 
		?>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
	//	$(this).attr("disabled", "disabled");
    var ta_list ="<?php echo $ta_list;?>";
		var user_list ="<?php echo $user_list;?>";

		var index = $("table tbody tr:last-child").index();
        var id=parseInt(index)+parseInt(1);
        var row = '<tr>' +
            
             '<td><select class="select2 form-control custom-select" name="ta_names[]" id="ta_names" style=""><option>Multi Select</option>'+ta_list+'</select></td>' +
            '<td><input type="text" class="form-control" id="commitment_days'+id+'" name="commitment_days[]" placeholder="Commitment_days"></td>' +
            '<td><input type="text" class="form-control" id="particulars'+id+'" name="particulars[]" placeholder="Particulars "></td>' +
            '<td><select class="select2 form-control custom-select" id="assignee" name="assignee[]" style=""><option>Select</option>'+user_list+'</select></td>' +
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