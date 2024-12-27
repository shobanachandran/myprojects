<?php 
// Report all errors
error_reporting(E_ALL);
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
    <title><?php echo SITE_TITLE;?> - Work done DC IN</title>
    <!-- Custom CSS -->
    <!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <style>
    th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
    </style>
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
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">WorkDone DC IN</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <form method="post">
            <div class="container-fluid">               
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12" >
                                        <div class="col-sm-6" style="float:left; left: 50px; ">
												
                                        <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;DC No</label>
                                        <div class="col-sm-6">
    <select class="select2 form-control custom-select" name="dc_no" id="order" onchange="this.form.submit();">
        <option>Select</option>
        <?php
        $sel_dc = mysqli_query($zconn, "SELECT DISTINCT dc_no, created_at
            FROM (
                SELECT dc_no, created_at FROM production_dc
                UNION ALL
                SELECT dc_no, created_at FROM stickering_workassign
                UNION ALL
                SELECT dc_no, created_at FROM singer_workassign
                UNION ALL
                SELECT dc_no, created_at FROM checking_workassign
                UNION ALL
                SELECT dc_no, created_at FROM triming_workassign
                UNION ALL
                SELECT dc_no, created_at FROM checking_workassign1
                UNION ALL
                SELECT dc_no, created_at FROM fchecking_workassign
                UNION ALL
                SELECT dc_no, created_at FROM ironing_workassign
                UNION ALL
                SELECT dc_no, created_at FROM packing_workassign
                UNION ALL
                SELECT dc_no, created_at FROM inspection_workassign
                UNION ALL
                SELECT dc_no, created_at FROM iron_workassign
            ) AS combined_result
            ORDER BY created_at");
        
        while ($res_dc = mysqli_fetch_array($sel_dc, MYSQLI_ASSOC)) {
            $dc_no = $res_dc['dc_no'];
        ?>
        <option value="<?php echo $dc_no; ?>" <?php if ($dc_no == $_REQUEST['dc_no']) { ?> selected="selected" <?php } ?>>
            <?php echo $dc_no; ?>
        </option>
        <?php } ?>
    </select>
</div>

                                    </div>
                                        <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Order No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="order" id="order" onchange="this.form.submit();">
    <option>Select</option>
    <?php
    $sel_buyer = mysqli_query($zconn, "SELECT DISTINCT dc_no, order_no
        FROM (
            SELECT dc_no, order_no FROM production_dc
            UNION ALL
            SELECT dc_no, order_no FROM stickering_workassign
            UNION ALL
            SELECT dc_no, order_no FROM singer_workassign
            UNION ALL
            SELECT dc_no, order_no FROM checking_workassign
            UNION ALL
            SELECT dc_no, order_no FROM triming_workassign
                UNION ALL
                SELECT dc_no, order_no FROM checking_workassign1
                UNION ALL
                SELECT dc_no, order_no FROM fchecking_workassign
                UNION ALL
                SELECT dc_no, order_no FROM ironing_workassign
                UNION ALL
                SELECT dc_no, order_no FROM packing_workassign
                UNION ALL
                SELECT dc_no, order_no FROM inspection_workassign
                UNION ALL
            SELECT dc_no, order_no FROM iron_workassign
        ) AS combined_result
        WHERE dc_no = '" . $_REQUEST['dc_no'] . "';");

    while ($res_buyer = mysqli_fetch_array($sel_buyer, MYSQLI_ASSOC)) {
        $order_no = $res_buyer['order_no'];
    ?>
        <option value="<?php echo $order_no; ?>" <?php if ($order_no == $_REQUEST['order']) { ?> selected="selected" <?php } ?>>
            <?php echo $order_no; ?>
        </option>
    <?php } ?>
</select>

                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Style No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="style" id="style" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from production_dc where  order_no='".$_REQUEST['order']."'");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ $fabrc=$res_buyer['style_no']; ?>

                                            <option value="<?php echo $res_buyer['style_no'];?>" <?php if ($res_buyer['style_no']==$_REQUEST['style']) {?> selected="selected" <?php
                                                
                                            }?> ><?php echo $res_buyer['style_no'];?></option>

                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="from" class="col-sm-3 text-right control-label col-form-label">&nbsp;Deparment</label>
                                        <div class="col-sm-6">
                                           <form method="post" action="process_data.php">
    <select class="select2 form-control custom-select" name="from" id="from" onchange="this.form.submit();">
        <option value="0">Select</option>
        <?php
        $sel_buyer = mysqli_query($zconn, "SELECT * FROM department_master WHERE 1 AND NOT dept_name='fabric Inward' GROUP BY dept_name");
        while ($res_buyer = mysqli_fetch_array($sel_buyer, MYSQLI_ASSOC)) {
            ?>
            <option value="<?php echo $res_buyer['dept_name']; ?>" 
                <?php if ($res_buyer['dept_name'] == $_REQUEST['from']) { ?> selected="selected" <?php } ?>
            ><?php echo $res_buyer['dept_name']; ?>
            </option>
        <?php } ?>
    </select>
</form>

                                        </div>
                                    </div>               
                                </div>

                                <div class="card" style="width:50%; float:left; right: 50px;">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Party Dc No</label>
                                        <div class="col-sm-6">
                                            <!--?php $select=mysqli_num_rows(mysqli_query($zconn,"select * from production_dc")); 
                                            $id=$select+1;?-->
                                            <input type="text" name="party_dc_no" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">DC Out Date</label>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="dc_out_date" name="dc_out_date" autocomplete="off" required>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Contractor</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="to_contractor" id="to_contractor" >
                                            <option value="0">Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from contractors group by con_name");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
                                            <option value="<?php echo $res_buyer['con_name'];?>" 
                                                <?php if ($res_buyer['con_name']==$_REQUEST['to_contractor']){?> selected="selected" <?php } ?>
                                                ><?php echo $res_buyer['con_name'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                            </div>
                                    
                                    
                                </div>


                              
                            
                            
                                <?php 
                            
                            if ($_REQUEST['from']!='' && $_REQUEST['from']!='0'){
                                     
                                    // Get the value of 'from' from the request
$from = $_REQUEST['from'];

switch ($from) {
    case 'CUTTING':
        // Display the details for "Cutting"
        include('cutting_workassign.php');
        break;
    case 'PRINTING':
		//echo 'dgdsgdsg';
        // Display the details for "Stickering"
        include('other_workdone.php');
      
        break;
    case 'EMBROIDERY':
        // Display the details for "Singer"
        include('singer_workdone.php');
        break;
		 case 'SEWING':
        // Display the details for "Singer"
		//echo 'Cheking';
        include('checking_workdone.php');
        break;
        case 'TRIMING':
            // Display the details for "Singer"
            echo 'Trimmig';
            include('triming_workdone.php');
            break;
            case 'CHECKING':
                // Display the details for "Singer"
                echo 'CHECKING';
                include('checking_workdone1.php');
                break;
                case 'FINAL CHECKING':
                    // Display the details for "Singer"
                    echo 'FINAL CHECKING';
                    include('fchecking_workdone.php');
                    break;
                    case 'IRONING':
                        // Display the details for "Singer"
                        echo 'IRONING';
                        include('ironing_workdone.php');
                        break;
                        case 'PACKING':
                            // Display the details for "Singer"
                            echo 'PACKING';
                            include('packing_workdone.php');
                            break;
                            case 'INSPECTION':
                                // Display the details for "Singer"
                                echo 'INSPECTION';
                                include('inspection_workdone.php');
                                break;
		// case 'Ironing and Packing':
        // Display the details for "Singer"
		//echo 'Ironing and Packing';
        //include('iron_workdone.php');
        //break;
    default:
        // Handle the case when 'from' doesn't match any of the defined cases
		echo 'Not Fetch';
        //include('other_workdone.php');
        break;
}


?>

                                    </div>
                                       
                                    <?php }
                                
                            
                            ?>
                                
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
           <?php include('includes/footer.php');?>
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
</form> 
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
		
		
		
		
		
		
		
		
		
		
		
<script>
function updateColorTotal(color) {
    var inputs = document.querySelectorAll('[name*="' + color + '"]');
    var total = 0;

    inputs.forEach(function(input) {
        total += parseInt(input.value) || 0;
    });

    var colorTotal = document.getElementById(color + '-total');
    colorTotal.innerText = total;
    
    // Recalculate the grand total when any quantity input changes
    var grandTotalElement = document.getElementById('grand-total');
    var allColorTotalElements = document.querySelectorAll('.color-total'); // Select all color total elements

    var grandTotal = 0;

    allColorTotalElements.forEach(function(element) {
        grandTotal += parseInt(element.innerText) || 0;
    });

    grandTotalElement.innerText = grandTotal;
}

// Attach the updateColorTotal function to the "onkeyup" event of all quantity inputs
var allQuantityInputs = document.querySelectorAll('input[name^="qty"]');
allQuantityInputs.forEach(function(input) {
    input.addEventListener('keyup', function() {
        var color = input.getAttribute('name').match(/\[(.*?)\]/)[1];
        updateColorTotal(color);
    });
});
</script>
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
        $('.delivery_wgt').keyup(function () {
    var sum = 0;
    $('.delivery_wgt').each(function() {
        sum += Number($(this).val());
    });
     
 
    $('#total').val(sum);
     
});

    $(document).ready(function() {
    $('#example').DataTable();
    } );
    function DeleteUsrId(ID){
      var UsrStatus = confirm("Are you sure to delete this company details ?");
      if(UsrStatus){
      $('#delete_'+ID).hide();
      }
      }
    </script>   

</body>
</html>