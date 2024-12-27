<?php 
include('includes/config.php');

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
    <title><?php echo SITE_TITLE;?> - General DC 	</title>
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
                        <h4 class="page-title">General Dc</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">General DC</a></li>
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
    <form name="fabric_dc_out" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="order" class="control-label">TO Address</label>
                            
                            <textarea type="text" class="form-control" name="address" > </textarea>      
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;IF RETURN</label>
                            <div class="form-check">
                                <input type="checkbox" id="part_shipment1" name="part_shipment[]" value="Shipment1" required class="form-check-input">
                                <label for="part_shipment1" class="form-check-label">Return</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="dc_no" class="control-label">Remarks</label>
                           
                            <textarea type="text" name="dc_no" class="form-control" ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="styleTable">
                            <thead>
                                <tr>
                                    <th>Style NO</th>
                                    <th>Particular</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control" name="style" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn, "select distinct style_no from fabric_inward where 1 group by id");
                                            while ($res_buyer = mysqli_fetch_array($sel_buyer, MYSQLI_ASSOC)) {
                                                $style[] = $res_buyer['style_no'];
                                            ?>
                                                <option value="<?php echo $res_buyer['style_no']; ?>" <?php if ($res_buyer['style_no'] == $_REQUEST['style']) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $res_buyer['style_no']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea type="text" name="particular" class="form-control"></textarea>
                                    </td>
                                    <td>
                                        <input type="text" name="qty" class="form-control">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" id="addStyle">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                        <table class="table table-bordered" id="styleTable">
                            <thead>
                                <tr>
                                <th ><strong>Driver Name</strong> </th>   
                                <th ><strong>Mobile No</strong></th>
                                <th><strong>Vehicle No</strong></th>
                                    
                                </tr>
                            </thead>
                                
                                <tbody>
                        <tr>
							                          
							  <td><input type="text" name="driver_name" id="driver_name" class="form-control" value="<?php echo $f->driver_name;?>"></td>
							
							  <td ><input type="text" name="vehicle_no" id="vehicle_no" value="<?php echo $f->vehicle_no;?>" class="form-control"></td>
							 
							  <td ><input type="text" name="vehicle_no" id="vehicle_no" value="<?php echo $f->vehicle_no;?>" class="form-control"></td>
					      </tr>
</tbody>
</table>
</div>
                    </div>
                </div>
</div>
</div>
                <div class="card" style="width: 100%;">
                    <div class="border-top">
                        <div class="card-body" style="text-align: center;">
                            <button type="submit" name="save" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
                
                       
                        
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
            <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->

    <script>
    document.getElementById("addStyle").addEventListener("click", function () {
        var table = document.getElementById("styleTable").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);

        cell1.innerHTML = '<select class="form-control" name="style"><option>Select</option><?php foreach ($style as $s) { ?><option value="<?php echo $s; ?>"><?php echo $s; ?></option><?php } ?></select>';
        cell2.innerHTML = '<textarea type="text" name="particular" class="form-control"></textarea>';
        cell3.innerHTML = '<input type="text" name="qty" class="form-control">';
        cell4.innerHTML = '<button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>';
    });

    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
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
</body>
</html>