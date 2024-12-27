<?php 
    error_reporting(0);
	include("includes/config.php");
	extract($_REQUEST);
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
    <title><?php echo SITE_TITLE;?> - User</title>
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
		<?php  include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php  include('includes/sidebar.php');?>
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
                        <h4 class="page-title">Users List</h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="admin_master.php"> <button type="button" class="btn btn-info">Admin Master</button></a>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">							
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="users_add.php"><button type="button" class="btn btn-success">Add</button></a></li>
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
							<!-- accoridan part -->
                        <div class="accordion" id="accordionExample">
                            <div class="card m-b-0">
                                <table id="" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th>User Type</th>
					</tr>
					</thead>
					<tbody>
					<?php $sel_utypes = mysqli_query($zconn,"select * from users_type where DELETED='N'");
					$ut=1;
					while($res_utype = mysqli_fetch_array($sel_utypes,MYSQLI_ASSOC)){
					?>
					<tr>
						<td>
						 <div class="card-header" id="headingOne">
                                  <h5 class="mb-0">
                                    <a  href="javascript:;" onclick="$('#disp'+<?php echo $ut;?>).slideToggle();"data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="m-r-5 fa fa-magnet" aria-hidden="true"></i>
                                        <span><?php echo $res_utype['TYPNAME']; ?></span>
                                    </a>
                                  </h5>
                                </div>
						<!--<b><a href="javascript:;" onclick="$('#disp'+<?php echo $ut;?>).slideToggle();"><?php echo $res_utype['TYPNAME']; ?></a></b>-->

						</td>
					</tr>
					<tr style="display:none;" id="disp<?php echo $ut;?>">
					<td colspan="7">
					<table id="example<?php echo $ut;?>" class="table table-bordered table-striped">
					<thead>
					<tr style="background-color: #626F80; color: #fff;">
					  <th>SNo</th>
					  <th>Name</th>
					  <th>User Name</th>
					  <th>Mobile Number</th>
					  <th>Email</th>
					  <th>Status</th>
					  <th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$sectUsrQry = "select * from users where DELETED='N' and TYPEID='".$res_utype['TYPEID']."' order by USERID desc ";
						$secUsrResource = mysqli_query($zconn,$sectUsrQry);
						$u=1;
						while($userdata = mysqli_fetch_array($secUsrResource,MYSQLI_ASSOC)){
					?>
					<tr id="user_<?php echo $userdata['USERID'];?>">
					<td><?php echo $u; ?></td>
					<td><?php echo $userdata['UNAME']; ?></td>
					<td><?php echo $userdata['USRNAME']; ?></td>
					<td><?php echo $userdata['MOBNO']; ?></td>
					<td><?php echo $userdata['EMAIL']; ?></td>
					<td><?php echo $userdata['STATUS']; ?></td>
					<td><a href="users_add.php?userid=<?php echo $userdata['USERID']; ?>"><i class="fa fa-fw fa-edit"></i></a> <?php //if($userdata['USERID']!=1){ ?> |
					<a onclick="DeleteUsrId('<?php echo $userdata['USERID']; ?>')"><i class="fa fa-fw fa-times"></i></a> 
					<?php // } ?>
					</td>
					</tr>
					<?php
						$u++;}
					?>
					</tbody>
					</table>
					
					</td>
					</tr>
					<?php $ut++;} ?>
					</tfoot>
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
            <?php  include('includes/footer.php');?>
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
  $(function () {
	   var r;
	  for(r=1;r<<?php echo $ut-1;?>;r++){
     $('#example'+r).DataTable({
         "pageLength": 100
    });
	  }
  });
  function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this User details ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/users.php',
			data: {
			   action: 'userdelete',
			   userid: ID
			},
			success: function( data ) {
				$('.loader').hide(); // hide the loading message.
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
					$('.loader').hide();
				}
				if($.trim(data)==true){
					alert("User Deleted Successfully");
					document.getElementById("user_"+ID).style.display = "none";
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