<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
    echo "<script>window.location.href='login.php';</script>";
}

if (isset($_REQUEST['save'])) {
     $select=mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as id from process_dcout_master"));
     $id=$select['id']+1;

    $count=count($_REQUEST['delivery_wgt']);
$sql=mysqli_query($zconn,"INSERT INTO fabric_dcout_master(order_no,style_no,to_process,dc_no,date,total,from_addr)values('".$_REQUEST['order']."','".$_REQUEST['style']."','".$_REQUEST['to_process']."','".$id."','".$_REQUEST['dc_date']."','".$_REQUEST['total']."','".$_REQUEST['from']."')");

    for($i=0; $i<$count; $i++) {
        if ($_REQUEST['delivery_wgt'][$i]>0) {
            $delivery=$_REQUEST['delivery_wgt'][$i];
        $sql=mysqli_query($zconn,"INSERT INTO fabric_dc_out (order_no,style_no,to_process,dc_no,dc_date,fabric_name,content,color,dia,fdia,gsm,gauge,loop_length,lab_no,planning_wgt,wgt,from_addr,inward_id) values('".$_REQUEST['order']."','".$_REQUEST['style']."','".$_REQUEST['to_process']."','".$id."','".$_REQUEST['dc_date']."','".$_REQUEST['fabric_name'][$i]."','".$_REQUEST['content'][$i]."','".$_REQUEST['color'][$i]."','".$_REQUEST['dia'][$i]."','".$_REQUEST['fdia'][$i]."','".$_REQUEST['gsm'][$i]."','".$_REQUEST['gauge'][$i]."','".$_REQUEST['loop_length'][$i]."','".$_REQUEST['lab_no'][$i]."','".$_REQUEST['wgt'][$i]."','".$_REQUEST['delivery_wgt'][$i]."','".$_REQUEST['from']."','".$_REQUEST['id'][$i]."')");
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
    <title><?php echo SITE_TITLE;?> - FABRIC - PROCESS DC OUT</title>
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
                        <h4 class="page-title">FABRIC - PROCESS DC OUT</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">  
<form name="fabric_dc_out" method="post">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="width:100%">
                                <div class="card" style="width:50%; float:left; left: 50px; ">
                                    <!--<div class="form-group row">
                                        <label for="fname" class="col-sm-4 text-right control-label col-form-label">Previous Process</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer">
                                            <option>Select</option>
                                            <option selected="selected">----Select----</option>
                <option value="fabric_inward" selected="selected">fabric Inward</option>
                <option value="fabric_inward">Fabric Inward</option>
                <option value="yarn_dye">Yarn Dye</option>
                <option value="knitting">Knitting</option>      
                <option value="collar_knitting">Collar Knitting</option>
                <option value="de_knitting">DE Knitting</option>
                <option value="dyeing">Dyeing</option>
                <option value="dyeing_with_bio_wash">DYEING WITH BIO WASH</option>      
                <option value="washing">Washing</option>
                <option value="winding">Winding</option>
                <option value="heat_setting">Heat Setting</option>
                <option value="fusing">Fusing</option>
                <option value="peach">Peach Finishing</option>
                <option value="printing_aop">Printing AOP</option>
                <option value="stender_finishing">STENDER FINISHING</option>
                <option value="compacting">Compacting</option>
                <option value="cum_cutting">Cum Cutting</option>
                <option value="stock">Stock</option>
                <option value="power">Power</option>
                                            </select>
                                        </div>
                                    </div>-->
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
                                        <label for="from" class="col-sm-3 text-right control-label col-form-label">&nbsp;From Process</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="from" id="from" onchange="this.form.submit();">
                                            <option value="0">Select</option>

                                            <!-- <option value="fabric_inward">fabric Inward</option> -->
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from department_master where 1 AND NOT dept_name='yarn Inward' AND NOT dept_name='knitting' group by dept_name ");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>

                                            <option value="<?php echo $res_buyer['dept_name'];?>" 
                                                <?php if ($res_buyer['dept_name']==$_REQUEST['from']){?> selected="selected" <?php } ?>
                                                ><?php echo $res_buyer['dept_name'];?>
                                                    

                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>



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
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;To Process</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="to_process" id="to_process" onchange="this.form.submit();">
                                            <option value="0">Select</option>
                                            <?php $sel_buyer = mysqli_query($zconn,"select * from department_master where 1 AND NOT dept_name='yarn Inward' AND NOT dept_name='fabric Inward' AND NOT dept_name='knitting' group by dept_name");
                                            while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
                                            <option value="<?php echo $res_buyer['dept_name'];?>" 
                                                <?php if ($res_buyer['dept_name']==$_REQUEST['to_process']){?> selected="selected" <?php } ?>
                                                ><?php echo $res_buyer['dept_name'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                            <?php 
                            
                            if ($_REQUEST['to_process']!='' && $_REQUEST['to_process']!='0'){
                                    if ($_REQUEST['to_process']=='knitting'){?>
                                    <div class="table-responsive">
                                        <div class="col-12 d-flex no-block align-items-center">
                                            <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;PLANNING PROGRAM</h5>
                                        </div>
                                        <table id="example" class="table table-striped table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">FABRIC NAME</th>
                                                    <th style="width: 10%">CONTENT</th>
                                                    <th style="width: 5%">COLOUR</th>
                                                    <th style="width: 5%">DIA</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="Fabric Dia">FDIA</th>
                                                    <th style="width: 5%">F GSM</th>
                                                    <th style="width: 5%">GUAGE</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="Weight">LOOP LENGTH</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">PLANNING WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">INWARD WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">DELIVERY WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">BALANCE WGT</th>
                                                    <th style="width: 10%">ENTER .WGT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                          
                                            $sel_buyer = mysqli_query($zconn,"select * from fabric_inward where  order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'");
                                                while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ 
                                                $fabric_name=$res_buyer['fabric_name']; 
                                            
                                                $sectBrnQry = "SELECT * FROM fabric_entry where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='$fabric_name'";
                                                $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                                                while($coldate = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){


                                                    if ($_REQUEST['from']=='fabric Inward') {
                                                    $tbl='fabric_inward';
                                                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='$fabric_name'"));
                                                    $in=$inward['wgt'];
                                                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM fabric_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and fabric_name='$fabric_name' and from_addr='".$_REQUEST['from']."'"));
                                                    $out=$out['wgt'];
                                                    $wgt=$in-$out;
                                                    }


                                                    else{
                                                        $tbl='fabric_dc_out';  
                                                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM fabric_dc_in where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."' and fabric_name='$fabric_name'"));
                                                    $in=$inward['wgt'];

                                                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."' and fabric_name='$fabric_name'"));
                                                    $out=$out['wgt'];

                                                    $wgt=$in-$out;
                                                    }

                                                
                                                    

                                                ?>
                                                <tr>
                                                    <td style="width: 10%"><?php echo $coldate['id'];?><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"><input type="hidden" name="fabric_name[]" value="<?php echo $coldate['fabric_name'];?>"></td>
                                                    <td style="width: 10%"><?php echo $coldate['content'];?><input type="hidden" name="content[]" value="<?php echo $coldate['content'];?>"></td>
                                                    <td style="width: 11%"><?php echo $coldate['color'];?><input type="hidden" name="color[]" value="<?php echo $coldate['color'];?>"></td>
                                                    <td style="width: 5%"><?php echo $coldate['dia'];?><input type="hidden" name="dia[]" value="<?php echo $coldate['dia'];?>"></td>
                                                    <td style="width: 4%"><?php echo $coldate['f_dia'];?><input type="hidden" name="fdia[]" value="<?php echo $coldate['f_dia'];?>"></td>
                                                    <td style="width: 4%"><?php echo $coldate['f_gsm'];?><input type="hidden" name="gsm[]" value="<?php echo $coldate['f_gsm'];?>"></td>
                                                    <td style="width: 8%"><?php echo $coldate['Gauge'];?><input type="hidden" name="gauge[]" value="<?php echo $coldate['Gauge'];?>"></td>
                                                    <td style="width: 4%"><?php echo $coldate['Loop_Length'];?><input type="hidden" name="loop_length[]" value="<?php echo $coldate['Loop_Length'];?>"></td>
                                                    <td style="width: 8%"><?php echo $coldate['wgt'];?><input type="hidden" name="wgt[]" value="<?php echo $coldate['wgt'];?>"></td>

                                                    <td style="width: 8%"><?php echo $in;?></td>

                                                    <td style="width: 8%"><?php echo $out;?></td>

                                                    <td style="width: 8%"><?php echo $wgt;?></td>

                                                    <td style="width: 10%"><input type="number" max="<?php echo $wgt;?>" min='0' class="form-control delivery_wgt" id="delivery_wgt" name="delivery_wgt[]"></td>
                                                </tr>

                                                <?php
                                                    }}
                                                ?>
                                                <tr>
                                                    <td colspan="12"><strong>TOTAL WEIGHT</strong></td>
                                                    <td>
                                                        <input type="text" name="total" id="total" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success" >Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                    <?}
                                        else if($_REQUEST['to_process']=='dyeing'){?>
                                    <div class="table-responsive">
                                        <div class="col-12 d-flex no-block align-items-center">
                                            <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;PROGRAM</h5>
                                        </div>
                                        <table id="example" class="table table-striped table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 4%" data-toggle="tooltip" title="Fabric NAME">FABRIC NAME</th>
                                                    <th style="width: 4%" data-toggle="tooltip" title="Fabric COLOR">COLOR</th>
                                                    <th style="width: 4%">DIA</th>
                                                    <th style="width: 8%">LAB NO</th>
                                                    <th style="width: 4%" data-toggle="tooltip" title="PLANNING Weight">PLANNING WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">INWARD WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">DELIVERY WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">BALANCE WGT</th>
                                                    <th style="width: 10%">ENTER .WGT</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                 $sel_buyer = mysqli_query($zconn,"select * from fabric_inward where  order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'");
                                                while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ 
                                                $fabric_name=$res_buyer['fabric_name']; 

                                                $sectBrnQry = "SELECT * FROM dyeing_planning where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='$fabric_name'";
                                                $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                                                while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
                                                    if ($_REQUEST['from']=='fabric Inward') {
                                                    $tbl='fabric_inward';
                                                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'"));
                                                    $in=$inward['wgt'];
                                                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM fabric_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'and from_addr='".$_REQUEST['from']."'"));
                                                    $out=$out['wgt'];
                                                    $wgt=$in-$out;
                                                    }
                                                    else{

                                                    $tbl='fabric_dc_in';

                                                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='".$_REQUEST['from']."' and fabric_name='".$coldata['fabric_name']."'"));
                                                    $in=$inward['wgt'];
                                                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM fabric_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."'and fabric_name='".$coldata['fabric_name']."'"));
                                                        $out=$out['wgt'];
                                                    $wgt=$in-$out;


                                                    }
                                                ?>
                                                <tr>
                                                    <td style="width: 4%"><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td>
                                                    <td style="width: 4%"><?php echo $coldata['color'];?><input type="hidden" name="color[]" value="<?php echo $coldata['color'];?>"></td>
                                                    <td style="width: 4%"><?php echo $coldata['dia'];?><input type="hidden" name="dia[]" value="<?php echo $coldata['dia'];?>"></td>
                                                    <td style="width: 8%"><?php echo $coldata['lab_no'];?><input type="hidden" name="lab_no[]" value="<?php echo $coldata['lab_no'];?>"></td>
                                                    <td style="width: 4%"><?php echo $coldata['wgt'];?><input type="hidden" name="wgt[]" value="<?php echo $coldata['wgt'];?>"></td>

                                                    <td style="width: 8%"><?php echo $in;?></td>

                                                    <td style="width: 8%"><?php echo $out;?></td>

                                                    <td style="width: 8%"><?php echo $wgt;?></td>

                                                    <td style="width: 4%"><input type="text" min="0" max="<?php echo $wgt;?>" class="form-control delivery_wgt" name="delivery_wgt[]"></td>
                                                    <!-- <td style="width: 8%">123</td>
                                                    <td style="width: 4%">123</td> -->
                                                </tr>

                                                <?php
                                                }   }
                                                ?>
                                                <tr>
                                                    <td colspan="8"><strong>TOTAL WEIGHT</strong></td>
                                                    <td>
                                                        <input type="text" name="total" id="total" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                         <?php }

                                         else{?>

                                    <div class="table-responsive">
                                        <div class="col-12 d-flex no-block align-items-center">
                                            <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;PROGRAM</h5>
                                        </div>
                                        <table id="example" class="table table-striped table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">FABRIC NAME</th>
                                                    <th style="width: 3%" data-toggle="tooltip" title="Fabric Dia">COLOR</th>
                                                    <th style="width: 3%">DIA</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">INWARD WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">DELIVERY WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">BALANCE WGT</th>
                                                    <th style="width: 10%">ENTER .WGT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if ($_REQUEST['from']=='fabric Inward') {
                                                    $tbl0='fabric_inward';

//                                                     echo "SELECT distinct order_no,style_no,fabric_name,dia FROM $tbl0 where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
// exit;
                                                    $sectBrnQry = "SELECT distinct order_no,style_no,fabric_name,dia,color FROM $tbl0 where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
                                                }
                                                else{
                                                    $tbl0=$_REQUEST['from'];
                                                    $sectBrnQry = "SELECT distinct order_no,style_no,fabric_name,dia,color FROM fabric_dc_in where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='$tbl0'";
                                                }
                                                $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                                                while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){

                                                    if ($_REQUEST['from']=='fabric Inward') {
                                                    $tbl='fabric_inward';
                                                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'"));
                                                    $in=$inward['wgt'];
                                                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM fabric_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'and from_addr='".$_REQUEST['from']."'"));
                                                    $out=$out['wgt'];
                                                    $wgt=$in-$out;
                                                    }
                                                    else{
                                                        $tbl='fabric_dc_in';
                                                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='$tbl0' and fabric_name='".$coldata['fabric_name']."'"));
                                                    $in=$inward['wgt'];
                                                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM fabric_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='$tbl0' and fabric_name='".$coldata['fabric_name']."'"));
                                                        $out=$out['wgt'];
                                                    $wgt=$in-$out;
                                                    }
                                                ?>
                                        
                                                <td style="width: 4%"><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['color'];?><input type="hidden" name="color[]" value="<?php echo $coldata['color'];?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['dia'];?><input type="hidden" name="dia[]" value="<?php echo $coldata['dia'];?>"></td>
                                                <td style="width: 8%"><?php echo $in;?></td>

                                                    <td style="width: 8%"><?php echo $out;?></td>

                                                    <td style="width: 8%"><?php echo $wgt;?></td>

                                                <td style="width: 4%"><input type="text" class="form-control delivery_wgt" min="0" max="<?php echo $wgt;?>" id="delivery_wgt" name="delivery_wgt[]"></td>
                                                </tr>

                                            <?php
                                                }
                                            ?>
                                                <tr>
                                                    <td colspan="6"><strong>TOTAL WEIGHT</strong></td>
                                                    <td>
                                                        <input type="text" name="total" id="total" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success" >Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                        <?php }
                                
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
        </form>
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