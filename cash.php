<?php
error_reporting(0);
include("includes/config.php");
extract($_REQUEST);


// Rest of your existing code follows below this block
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
    <title><?php echo SITE_TITLE;?> - Expenses</title>
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
                        <h4 class="page-title">Cash List</h4> &nbsp;&nbsp;&nbsp;&nbsp;
						
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">							
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="expenses_add.php"><button type="button" class="btn btn-success">Add</button></a></li>
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
					  <th>Cash Type</th>
					</tr>
					</thead>
					<tbody>
					<?php


$sectUsrQry = "SELECT * FROM cash";
$secUsrResource = mysqli_query($zconn, $sectUsrQry);
$u = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Add your HTML head content here -->
</head>
<body>
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr style="background-color: #626F80; color: #fff;">
                <th>S.No</th>
                <th>Entry Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($userdata = mysqli_fetch_array($secUsrResource, MYSQLI_ASSOC)) { ?>
                <tr id="expenses_<?php echo $userdata['id']; ?>">
                    <td><?php echo $u; ?></td>
                    <td><?php echo $userdata['entry_name']; ?></td>
                    <td><?php echo $userdata['type']; ?></td>
                    <td>
                        <a href="cash_edit.php?userid=<?php echo $userdata['id']; ?>"><i class="fa fa-fw fa-edit"></i></a> |
<a href="javascript:void(0);" onclick="DeleteUsrId('<?php echo $userdata['id']; ?>')"><i class="fa fa-fw fa-times"></i></a>
                    </td>
                </tr>
                <?php $u++;
            } ?>
        </tbody>
    </table>
</body>
</html>

<?php
mysqli_close($zconn);
?>
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
 
</script>
		
		<script>
function DeleteUsrId(buyer_id) {
    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            type: "POST",
            url: "delete_buyer.php",
            data: { buyer_id: buyer_id },
            success: function(response) {
                if (response === "success") {
                    // Handle success (e.g., remove the deleted row from the table)
                    $("#expenses_" + buyer_id).remove();
                } else {
                    alert("Delete operation failed.");
                }
            },
            error: function() {
                alert("An error occurred during the delete operation.");
            }
        });
    }
}
</script>


</body>
</html>