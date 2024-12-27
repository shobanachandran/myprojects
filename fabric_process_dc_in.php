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
    <title><?php echo SITE_TITLE;?> - FABRIC - PROCESS DC IN</title>
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
                        <h4 class="page-title">FABRIC - PROCESS DC IN</h4>
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
                                                <label for="fname" class="col-sm-4 text-right control-label col-form-label">DC No</label>
                                                <div class="col-sm-6">
                                                    <select class="select2 form-control custom-select" name="dc_no" id="dc_no" onchange="this.form.submit()">
                                                    <option>Select</option>
                                                    <?php $sel_buyer = mysqli_query($zconn,"select * from fabric_dcout_master ");
                                                    while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ 
                                                        ?>
                                                    <option value="<?php echo $res_buyer['dc_no'];?>"<?php if ($res_buyer['dc_no']==$_REQUEST['dc_no']) {
                                                        echo 'selected';
                                                    }?> ><?php echo $res_buyer['dc_no'];?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <label for="fname" class="col-sm-4 text-right control-label col-form-label">Process</label>
                                                <div class="col-sm-6">
                                                    <?php 

                                                     $sel_buyer = mysqli_query($zconn,"select * from fabric_dcout_master where dc_no='".$_REQUEST['dc_no']."' ");
                                                    while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
                                                        $processs=$res_buyer['to_process'];}
                                                        ?>
                                                    <input type="text" name="from" readonly class="form-control" value="<?php echo $processs;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" style="float:left; right: 50px; ">
                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-4 text-right control-label col-form-label">Party DC No</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="party_dc"  class="form-control" required>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <label for="fname" class="col-sm-4 text-right control-label col-form-label">Party DC Date</label>
                                                <div class="col-sm-6">
                                                    <input type="date" autocomplete="off" required class="form-control" id="party_date" name="party_date"  >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="table-responsive">
                                    <div class="col-12 d-flex no-block align-items-center">
                                        <h5 class="page-title" style="margin-left: 390px;">FABRIC PROCESS DC IN</h5>
                                    </div>
                                    <table id="example" class="table table-striped table-bordered text-center">
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
                                                <th style="width: 10%"  data-toggle="tooltip" title="Already Received">ALR. REC.</th>
                                                <th style="width: 5%"  data-toggle="tooltip" title="Balance">BAL.</th>
                                                <th style="width: 5%">ROLLS</th>
                                                <th style="width: 10%"  data-toggle="tooltip" title="Received">WGT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;

                                            $sectBrnQry = "SELECT * FROM fabric_dc_out where dc_no='".$_REQUEST['dc_no']."' and to_process='$processs'";
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
                                                <td style="width: 4%"><?php echo $in;?></td>
                                                <td style="width: 8%"><?php echo $coldata['wgt']-$in;?></td>
                                            
                                                <td style="width: 8%"><div class="col-sm-12">
                                                        <input type="text" class="form-control" id="roll" name="roll[]" autocomplete="off"  >
                                                    </div>
                                                </td>
                                                <td style="width: 8%"><div class="col-sm-12">
                                                        <input type="number" class="form-control delivery_wgt" min="0" max="<?php echo $coldata['wgt']-$in;?>"   id="delivery_wgt" name="delivery_wgt[]" autocomplete="off"  >
                                                    </div>
                                                </td>
                                            </tr>
                                            

                                            <?php
                                            $i++;   }
                                            ?>

                                            <tr>
                                                <td colspan="10">TOTAL</td>
                                                <td><input type="text" name="total" id="total" class="form-control"> </td>
                                            </tr>
                                            
                                        </tbody>
                                        
                                    </table>
                                </div>
                                <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
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