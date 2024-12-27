<?php
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
	$action = 'useradd';
	$breadcrumb = 'Add';
	$sucessMsg = 'User Added Successfully';
	if(isset($userid)){
		$sucessMsg = 'User Updated Successfully';
		$action = 'useredit';
		$breadcrumb = 'Edit';
		$edtUsrQry = "SELECT * FROM users WHERE USERID='".$userid."'";
		$edtUsrResource = mysqli_query($zconn,$edtUsrQry);
		$userData = mysqli_fetch_array($edtUsrResource,MYSQLI_ASSOC);
		$userid = $userData['USERID'];
		$uname = $userData['UNAME'];
		$usrname = $userData['USRNAME'];
		$usrpwd = $userData['USRPWD'];
		$email = $userData['EMAIL'];
		$mobno = $userData['MOBNO'];
		$typeid = $userData['TYPEID'];
		$team_id = $userData['team_id'];
		$status = $userData['STATUS'];
		$addrs = $userData['ADDRS'];
		$dojoin = $userData['DOJOIN'];
		$dobirth = $userData['DOBIRTH'];
		$bldgrp = $userData['BLDGRP'];
		$enum = $userData['ENUM'];
		$relation = $userData['relation'];
	}
?><!DOCTYPE html>
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
    <title>CLEVER ERP - Users Add</title>
    <!-- Custom CSS -->
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
                        <h4 class="page-title">Users Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="users.php">Users Info</a></li>
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
								<form name="userInfo" id="userInfo" method="post" enctype="multipart/form-data" action="">

							<div class="card-body" style="width:100%">
								<div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Name <span class="red">*</span></label>
                <input type="text"  value="<?php echo $uname; ?>" class="form-control" tabindex="1" name="uname"  id="uname" placeholder="Enter Name">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>User Name <span class="red">*</span></label>
                <input type="text" value="<?php echo $usrname; ?>" class="form-control" tabindex="4"  name="usrname" id="usrname" placeholder="Enter Username">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <label>Mobile Number<span class="red">*</span></label>
                <input type="text" value="<?php echo $mobno; ?>" class="form-control" tabindex="2"  onkeypress="return isNumberKey(event)" maxlength="15" name="mobno" id="mobno" placeholder="Enter Mobile number">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Password <span class="red">*</span></label>
               <input type="text" value="<?php echo $usrpwd; ?>" class="form-control"  tabindex="5" name="usrpwd" id="usrpwd" placeholder="Enter Password">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
			 <div class="col-md-4">
				  <div class="form-group">
					<label>Email</label>
					<input type="text" value="<?php echo $email; ?>" class="form-control" tabindex="3" onblur="validateEmail(this.value)" name="email" id="email" placeholder="Enter Email">
				  </div>
				  <!-- /.form-group -->
            </div>

			<div class="col-md-4">
			  <div class="form-group">
					<label>User Type <span class="red">*</span></label>
					<select class="form-control select2"  tabindex="6"  name="typeid" id="typeid" style="width: 100%;">
					 <option value="">Select</option>
					 <?php
						$typQuery = "SELECT typeid,typname FROM users_type WHERE deleted='N' ORDER BY typeid";
						$typResource = mysqli_query($zconn,$typQuery);
						while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
					 ?>
					  <option value="<?php echo $typdata['typeid']; ?>" <?php if($typeid==$typdata['typeid']){ ?> selected <?php } ?>><?php echo $typdata['typname']; ?></option>
					  <?php
					   }
					  ?>
					</select>
				  </div>
			</div>


             <!-- /.col -->
			 <div class="col-md-4">
				  <div class="form-group">
					<label>Date of Join<span class="red">*</span></label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					  <?php
						if($dojoin!=''){
							$dojoin = date('d/m/Y',strtotime($dojoin));
						}
					  ?>
					 <input type="text" value="<?php echo $dojoin; ?>" class="form-control" tabindex="9" name="dojoin" id="dojoin" placeholder="Enter Date of Join" autocomplete="off">
					</div>
				  </div>
			 </div>
			 <div class="col-md-4">
				  <div class="form-group">
					<label>Date of Birth<span class="red">*</span></label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					   <?php
						if($dobirth!=''){
							$dobirth = date('d/m/Y',strtotime($dobirth));
						}
					  ?>
					  <input type="text" class="form-control" value="<?php echo $dobirth; ?>" tabindex="9" name="dobirth" id="dobirth" placeholder="Enter Date of Join" autocomplete="off">
					</div>
				</div>
				  <!-- /.form-group -->
				 </div>
             <div class="col-md-4">
				  <div class="form-group">
					<label>Blood Group</label>
					<input type="text" value="<?php echo $bldgrp; ?>" class="form-control" tabindex="3" name="bldgrp" id="bldgrp" placeholder="Enter Blood Group" >
				  </div>
				  <!-- /.form-group -->
            </div>
             <div class="col-md-4">
				  <div class="form-group">
					<label>Emergency Contact No<span class="red">*</span></label>
					<input type="text" value="<?php echo $enum; ?>" class="form-control" tabindex="3" name="enum" id="enum" placeholder="Enter Emergency No">
				  </div>
				  <!-- /.form-group -->
            </div>
            <div class="col-md-4">
				  <div class="form-group">
					<label>Relationship<span class="red">*</span></label>
					<input type="text" value="<?php echo $relation; ?>" class="form-control" tabindex="3" name="relation" id="relation" placeholder="Enter Relationship with phone number">
				  </div>
				  <!-- /.form-group -->
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Address<span class="red">*</span></label>
                <textarea class="form-control" tabindex="7"  name="addrs" id="addrs" placeholder="Enter Address"><?php echo $addrs; ?></textarea>
              </div>
              <!-- /.form-group -->
            </div>
			 <div class="col-md-4">
				 <div class="form-group">
					<label>Status <span class="red">*</span></label>
					<div>
					<label>
					  <input type="radio" value="Active" <?php if(isset($status)){ if($status=='Active'){ ?> checked <?php } }else{ ?> checked <?php } ?>  name="status" class="flat-red" > Active
					</label>
					<?php if($userid!=1){  ?>
					<label>
					  <input type="radio" value="In active" <?php if($status=='In active'){ ?> checked <?php } ?> name="status" class="flat-red"> In Active
					</label>
					<?php } ?>
				  </div>
				  <!-- /.form-group -->
				 </div>
		    </div>
          <!-- /.row -->
        </div>
      </div>
							</div>
							<div class="border-top">
								<div class="card-body" style="text-align: center;">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="users.php"><button type="button" class="btn btn-danger">Back</button></a>
								</div>
								<input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
	  <?php if(isset($userid)){ ?>
		<input type="hidden" name="userid" id="userid" value="<?php echo $userid ?>" />
	  <?php  } ?>
	  </form>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->            </div>
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
	<script src="dist/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

	<script>
	$(function () {
		//Date picker
		$('#dobirth').datepicker({
		   format: 'dd/mm/yyyy',
		  autoclose: true
		})
		$('#dojoin').datepicker({
	      format: 'dd/mm/yyyy',
		  autoclose: true
		})
		 //Datemask dd/mm/yyyy
	//	$('#dobirth').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		//Datemask2 mm/dd/yyyy
	//	$('#dojoin').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		
		$("form#userInfo").submit(function(e) {
			//$('.loader').show();
			e.preventDefault();    
			var formData = new FormData(this);
			if($('#uname').val()==''){
				alert("Please enter Name");
				$('#uname').focus();
			//	$('.loader').hide();
				return false;
			}
			if($('#email').val()!=''){
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				if (reg.test($('#email').val()) == false) 
				{	//$('#'+emailField.id).focus();
					alert("Please enter Valid Email Address");
					$('#email').val('');
				//	$('.loader').hide();
					return false;
				}
			}
			if($('#usrname').val()==''){
				alert("Please enter Username");
				$('#usrname').focus();
			//	$('.loader').hide();
				return false;
			}
			if($('#usrpwd').val()==''){
				alert("Please enter Password");
				$('#usrpwd').focus();
				//$('.loader').hide();
				return false;
			}
			if($('#typeid').val()==''){
				alert("Please enter User Type");
				$('#typeid').focus();
				//$('.loader').hide();
				return false;
			}
			
		//	$("#save").hide();
			$.ajax({
				url: "ajax/users.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					if($.trim(data)=="exist"){
						alert("Username Already Exist");
					//	$('.loader').hide();
					}
					if($.trim(data)==true){
						alert("<?php echo $sucessMsg; ?>");
						<?php if(!isset($userid)){ ?>
						document.getElementById("userInfo").reset();
					   <?php } ?>
					//	$('.loader').hide();
						window.location.href='users.php';
					}
					if($.trim(data)=="error"){
						alert("Process Failed Kindly. Try again");
						document.getElementById("userInfo").reset();
					//	$('.loader').hide();
					}
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});
	 });

	</script>
</body>
</html>