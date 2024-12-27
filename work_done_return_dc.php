<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
    echo "<script>window.location.href='login.php';</script>";
}

if (isset($_REQUEST['save'])) {
     $select=mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from process_dcin_master"));
     $id=$select['id']+1;

    $count=count($_REQUEST['wgt']);

    for($i=0; $i<$count; $i++) {
        if ($_REQUEST['delivery_wgt'][$i]>0) {
            
                $order.=$_REQUEST['order_no'][$i].",";
                $style_no.=$_REQUEST['style_no'][$i].",";
                //$fabric_name.=$_REQUEST['fabric_name'][$i].",";
                
        
            

        }
    }

    
$sql=mysqli_query($zconn,"INSERT INTO fabric_dcin_master(in_dc,order_no,style_no,dc_no,date,total,from_addr,party_dc,party_date)values('$id','".$order."','".$style_no."','".$_REQUEST['dc_no']."',Now(),'".$_REQUEST['total']."','".$_REQUEST['from']."','".$_REQUEST['party_dc']."','".$_REQUEST['party_date']."')");

    for($i=0; $i<$count; $i++) {
        if ($_REQUEST['delivery_wgt'][$i]>0) {
            $delivery=$_REQUEST['delivery_wgt'][$i];


        $sql=mysqli_query($zconn,"INSERT INTO fabric_dc_in (order_no,style_no,dc_no,date,fabric_name,content,color,dia,gsm,gauge,loop_length,lab_no,wgt,from_addr,party_dc,party_date,in_dc,inward_id) values('".$_REQUEST['order_no'][$i]."','".$_REQUEST['style_no'][$i]."','".$_REQUEST['dc_no']."',Now(),'".$_REQUEST['fabric_name'][$i]."','".$_REQUEST['content'][$i]."','".$_REQUEST['color'][$i]."','".$_REQUEST['dia'][$i]."','".$_REQUEST['gsm'][$i]."','".$_REQUEST['gauge'][$i]."','".$_REQUEST['loop_length'][$i]."','".$_REQUEST['lab_no'][$i]."','".$_REQUEST['delivery_wgt'][$i]."','".$_REQUEST['from']."','".$_REQUEST['party_dc']."','".$_REQUEST['party_date']."','$id','".$_REQUEST['id']."')");


        }
    }
    if($sql) {

//echo '<script> alert("Record has been Update successfully !")</script>';
        echo '<script>alert("The Record has been Successfully Added...")</script>';
    }
    else{
     echo '<script>alert("The Record Not Added Please Fill all The correct Detail...");</script>';
    }

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
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Order No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="order" id="order" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select distinct order_no from fabric_inward where 1 group by id");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
                                                $order[]=$res_buyer['order_no'];
                                             ?>
                                            <option value="<?php echo $res_buyer['order_no'];?>" <?php if ( $res_buyer['order_no']==$_REQUEST['order']){?> selected="selected" <?php } ?>
                                                
                                            ><?php echo $res_buyer['order_no'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Style No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="style" id="style" onchange="this.form.submit();">
                                            <option>Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from fabric_inward where  order_no='".$_REQUEST['order']."'");
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
                                            <select class="select2 form-control custom-select" name="from" id="from" onchange="this.form.submit();">
                                            <option value="0">Select</option>

                                           
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from department_master where 1 AND NOT dept_name='fabric Inward'   group by dept_name ");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>

                                            <option value="<?php echo $res_buyer['dept_name'];?>" 
                                                <?php if ($res_buyer['dept_name']==$_REQUEST['from']){?> selected="selected" <?php } ?>
                                                ><?php echo $res_buyer['dept_name'];?>
                                                    

                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;To Deparment</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="to_process" id="to_process" onchange="this.form.submit();">
                                            <option value="0">Select</option>
                                            <!?php $sel_buyer = mysqli_query($zconn,"select * from department_master where 1 AND NOT dept_name='yarn Inward' AND NOT dept_name='fabric Inward'group by dept_name");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
                                            <option value="<!?php echo $res_buyer['dept_name'];?>" 
                                                <!?php if ($res_buyer['dept_name']==$_REQUEST['to_process']){?> selected="selected" <!?php } ?>
                                                ><!?php echo $res_buyer['dept_name'];?></option>
                                            <!?php } ?>
                                            </select>
                                        </div>
                                            </div> -->
                                    


                                </div>

                                <div class="card" style="width:50%; float:left; right: 50px;">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Dc No</label>
                                        <div class="col-sm-6">
                                            <?php $select=mysqli_num_rows(mysqli_query($zconn,"select * from fabric_dcout_master")); 
                                            $id=$select+1;?>
                                            <input type="text" name="dc_no" class="form-control" value="<?php echo $id;?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">DC Out Date</label>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="dc_date" name="dc_date" autocomplete="off" required>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;To Contractor</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="to_contractor" id="to_contrator" onchange="this.form.submit();">
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
                                <br><br>
                                <?php
if (isset($_REQUEST['order_no']) && !empty($_REQUEST['order_no'])) {
    // If order_no is set and not empty, display the table
    ?>
                                <div class="table-responsive">
                                    <div class="col-12 d-flex no-block align-items-center">
                                        <h5 class="page-title" style="margin-left: 390px;">Cutting wait delivered</h5>
                                    </div>
                                    <table  class="table table-striped table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">S.NO</th>
                                                <th style="width: 10%">ORDER NO</th>
                                                <th style="width: 10%">STYLE NO</th>
                                                <th style="width: 10%">FABRIC NAME</th>
                                                <th style="width: 5%">DIA</th>
                                                <th style="width: 5%">GSM</th>
                                                <th style="width: 10%"  data-toggle="tooltip" title="Quantity">TOTAL WEIGHT</th>
                                                <!-- <th style="width: 4%"  data-toggle="tooltip" title="Unit of Measurement">UOM</th> -->
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;

                                            $sectBrnQry = "SELECT * FROM fabric_dc_out where order_no='".$_REQUEST['order_no']."' and to_process='$processs'";
                                            $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                                            while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
                                                // $order_no=$coldata['order_no'];
                                                // $style_no=$coldata['style_no'];
                                                // $fabric_name=$coldata['fabric_name'];
                                                // $processs;


                                                $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM fabric_dc_in where dc_no='".$_REQUEST['dc_no']."' and order_no='".$coldata['order_no']."' and style_no='".$coldata['style_no']."' and fabric_name='".$coldata['fabric_name']."' and from_addr= '".$processs."' "));

                                                    $in=$inward['wgt'];
                                            ?>
                                            <tr>
                                                <td style="width: 2%"><?php echo $i;?></td> 
                                                <td style="width: 5%"><?php echo $coldata['order_no']?><input type="hidden" name="id[]" value="<?php echo $coldata['inward_id']?>"><input type="hidden" name="order_no[]" value="<?php echo $coldata['order_no']?>"> </td>
                                                <td style="width: 10%"><?php echo $coldata['style_no']?><input type="hidden" name="style_no[]" value="<?php echo $coldata['style_no']?>"></td>
                                                <td style="width: 10%"><?php echo $coldata['fabric_name']?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name']?>"></td>
                                                <td style="width:5%"><?php echo $coldata['dia']?><input type="hidden" name="dia[]" value="<?php echo $coldata['dia']?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['gsm']?><input type="hidden" name="gsm[]" value="<?php echo $coldata['gsm']?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['wgt']?><input type="hidden" name="wgt[]" value="<?php echo $coldata['wgt']?>"></td>
                                                <!-- <td style="width: 4%"><?php echo $coldata['style_no']?></td> -->
                                               
                                               
                                            </tr>
                                            

                                            <?php
                                            $i++;   }
                                            ?>


                                            
                                        </tbody>
                                        
                                    </table>
                                            </div>

                                            <div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Planing Quantity Details</h5>
    </div>
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">S.NO</th>
                <th style="width: 10%">ORDER NO</th>
                <?php
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();

                $sectBrnQry = "SELECT DISTINCT size_id FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order_no'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueSizeIds[] = $coldata['size_id'];
                }

                // Create table headers for color names
                echo '<th style="width: 10%">Color</th>';

                // Create table headers for each size ID
                foreach ($uniqueSizeIds as $sizeId) {
                    echo '<th>' . $sizeId . '</th>';
                }

                // Add total column header
                echo '<th>Total</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;

            // Initialize arrays to store color-wise totals
            $colorTotals = array();

            // Retrieve unique colors for the selected order_no
            $uniqueColors = array();

            $sectBrnQry = "SELECT DISTINCT color FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order_no'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);

            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $uniqueColors[] = $coldata['color'];
            }

            // Create an array to store color-wise quantities for each size ID
            $colorQuantities = array();

            foreach ($uniqueSizeIds as $sizeId) {
                $colorQuantities[$sizeId] = array();
            }

            // Retrieve and organize the color-wise quantities for each size ID
            $sectBrnQry = "SELECT * FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order_no'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);

            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $colorQuantities[$coldata['size_id']][$coldata['color']] = $coldata['qty_val'];
            }

            // Loop through the colors and display quantities for each size ID in rows
            foreach ($uniqueColors as $color) {
                echo '<tr>';
                echo '<td style="width: 2%">' . $i . '</td>';
                echo '<td style="width: 10%">' . $_REQUEST['order_no'] . '</td>';
                echo '<td>' . $color . '</td>';

                // Initialize the color-wise total for this row
                $colorTotal = 0;

                // Loop through unique size IDs and display quantities for each color
                foreach ($uniqueSizeIds as $sizeId) {
                    $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;
                    echo '<td>' . $quantity . '</td>';

                    // Add the quantity to the color-wise total for this row
                    $colorTotal += $quantity;
                }

                // Display the color-wise total for this row
                echo '<td>' . $colorTotal . '</td>';

                echo '</tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Cutting Quantity Details</h5>
    </div>
    <form method="post" action="process_form.php"> <!-- Add the appropriate action attribute for your form -->
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 5%">S.NO</th>
                    <th style="width: 10%">ORDER NO</th>
                    <?php
                    // Retrieve unique size IDs for the selected order_no
                    $uniqueSizeIds = array();

                    $sectBrnQry = "SELECT DISTINCT size_id FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order_no'] . "'";
                    $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                    while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                        $uniqueSizeIds[] = $coldata['size_id'];
                    }

                    // Create table headers for color names
                    echo '<th style="width: 10%">Color</th>';

                    // Create table headers for each size ID
                    foreach ($uniqueSizeIds as $sizeId) {
                        // Decrease the column width for sizes
                        echo '<th style="width: 5%">' . $sizeId . '</th>';
                    }

                    // Add a heading for the "Total" column and increase its width
                    echo '<th style="width: 10%">Total</th>';
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                // Initialize an array to store color-wise totals
                $colorTotals = array();

                // Retrieve unique colors for the selected order_no
                $uniqueColors = array();

                $sectBrnQry = "SELECT DISTINCT color FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order_no'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueColors[] = $coldata['color'];
                }

                // Loop through the colors and display quantities for each size ID in rows
                foreach ($uniqueColors as $color) {
                    echo '<tr>';
                    echo '<td style="width: 2%">' . $i . '</td>';
                    echo '<td style="width: 10%">' . $_REQUEST['order_no'] . '</td>';
                    echo '<td>' . $color . '</td>';

                    // Initialize the color-wise total for this row
                    $colorTotal = 0;

                    // Loop through unique size IDs and create input fields for each color and size combination
                    foreach ($uniqueSizeIds as $sizeId) {
                        echo '<td><input type="text"style="width: 100%" name="qty[' . $color . '][' . $sizeId . ']" value="" onkeyup="updateColorTotal(\'' . $color . '\')" /></td>';
                    }

                    // Display the color-wise total for this row
                    echo '<td><span class="color-total" id="' . $color . '-total">0</span></td>';

                    echo '</tr>';
                    $i++;
                }
                ?>
            </tbody>
        </table>
        
    </form>
</div>

<script>
function updateColorTotal(color) {
    var inputs = document.querySelectorAll('[name*="' + color + '"]');
    var total = 0;

    inputs.forEach(function(input) {
        total += parseInt(input.value) || 0;
    });

    var colorTotal = document.getElementById(color + '-total');
    colorTotal.innerText = total;
}
</script>

                                
                               

                                <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                    </div>
                                    <?php
} else {
    // If order_no is not set or empty, display a message or take appropriate action
    echo "Please select an order number.";
}
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