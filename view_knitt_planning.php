<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
    echo "<script>window.location.href='login.php';</script>";
}

// if(isset($_POST['save'])=='save'){
//     $knit_loss=0;
//     $fabcount = count($_POST['fabric_name']);
//     for($i=0;$i<$fabcount;$i++){
//        $knit_loss +=$_REQUEST['knit_loss'][$i];
//     }
   
//     $order =$_POST['order_no'];
//     $style_no=$_POST['style_no'];
//     $ins_details_master = mysqli_query($zconn,"update  knitting_planning_master set knit_loss='".$knit_loss."',grand_total='".$_REQUEST['grand_total']."' where id='".$_REQUEST['id']."' and order_no='".$order."' and style_no='".$style_no."'");
   
//     $trows = count($_POST['fabric_name']);
//     for($tr=0;$tr<$trows;$tr++){

//         $ins_details = mysqli_query($zconn,"update  knitting_planning set fabric_name='".$_POST['fabric_name'][$tr]."',knitt_id='".$_REQUEST['id']."',content='".$_POST['content'][$tr]."',color='".$_POST['ycolor'][$tr]."',dia='".$_POST['dia'][$tr]."',f_dia='".$_POST['f_dia'][$tr]."',f_gsm='".$_POST['f_gsm'][$tr]."',Gauge='".$_POST['gauge'][$tr]."',Loop_Length='".$_POST['loop'][$tr]."',wgt='".$_POST['weight'][$tr]."',grand_total='".$_POST['grand_total']."',order_no='".$order."',style_no='". $style_no."',component_group='".$_POST['component']."',knit_loss='".$_POST['knit_loss'][$tr]."',pcs_weight='".$_POST['pcs_weight'][$tr]."'where knitt_id='".$_REQUEST['id']."' and order_no='".$order."' and style_no='".$style_no."' and id='".$_REQUEST['kid'][$tr]."'");
//         }
//     }


// if(isset($_POST['save'])=='save'){
//     $style=explode("~~",$_POST['sel_buyer']);
//     $order=$style[1];
//  $knitt_id =$_REQUEST['edit_id'];
//     $upd_details_master = mysqli_query($zconn,"update  knitting_planning_master 
//                          set order_no ='".$order."',
//                          style_no='".$_POST['style_no']."',
//                          component_group='".$_POST['component']."',
//                          grand_total = '".$_POST['grand_total']."'
//                          where id='".$knitt_id."'");
//     $trows = count($_POST['fabric_name']);
//  $del_child = mysqli_query($zconn,"delete from knitting_planning where knitt_id='".$knitt_id."'");
//     for($tr=0;$tr<$trows;$tr++){
//   $ins_details = mysqli_query($zconn,"insert into knitting_planning(fabric_name,content,color,dia,f_dia,f_gsm,Gauge,Loop_Length,wgt,grand_total,order_no,style_no,component_group,knit_loss,knitt_id) values('".$_POST['fabric_name'][$tr]."','".$_POST['content'][$tr]."','".$_POST['ycolor'][$tr]."','".$_POST['dia'][$tr]."','".$_POST['f_dia'][$tr]."','".$_POST['f_gsm'][$tr]."','".$_POST['gauge'][$tr]."','".$_POST['loop'][$tr]."','".$_POST['pcs_weight'][$tr]."','".$_POST['grand_total']."','".$order."','".$_POST['style_no']."','".$_POST['component']."','".$_POST['knit_loss']."','".$knitt_id."')");
//         }
//     }

// if($ins_details){
//     echo "<script>alert('Updated Successfully!!!');</script>";
//     echo "<script>window.location.href='knitting_planning_list.php';</script>";
//     }

// if($_REQUEST['id']==''){
//     //$cost_no = get_max_costno();

//     $sel_costing = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as COSTNO from costing_entry_master"));
//     if($sel_costing['COSTNO']=='' || $sel_costing['COSTNO']==NULL){
//         $cost_no ='001';
//     } else {
//         $cost_no = $sel_costing['COSTNO']+1;
//     }
//     $cost_no = "00".$cost_no;
//     $action="saveCosting";
// } 

//      $sel_knitting =mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where id='$id' "));


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
    <title><?php echo SITE_TITLE;?> - Knitting Planning Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <style>
    .table td, .table th{padding:0px !important; font-size:14px;}
    </style>
</head>
<body>
    <div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">
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
                        <h4 class="page-title">Knitting Planning Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Knitting Planning Info</a></li>
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
            <form action="" method="POST">
              <input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
                <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="width:100%">
                                <div class="card" style="width:50%; float:left; left: 50px; ">
                                <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
                                        <div class="col-sm-6">
                                        <?
                                          $id=$_GET['id'];
                                          $style=$sel_buyer['order_no'];
                                          $select=mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where id='$id'"));
                                        ?>
                                <select class="select2 form-control custom-select" name="order_no" id="order_no" onchange="buyer_costing(this.value);" required>
                                 <option  value="<?php echo $select['order_no'];?>" selected="selected"><?php echo $select['order_no'];?></option>
                                <!--  <option value="">Select</option>
                                        <?php $sel_buyer =mysqli_query($zconn,"select * from costing_entry_master");
                                        while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){

                                        if($res_cost['id']==$res_buyer['id']){  ?>
                                        <option selected value="<?php echo $res_buyer['order_no']."~~".$res_buyer['id'];?>"><?php echo $res_buyer['order_no'];?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $res_buyer['order_no']."~~".$res_buyer['id'];?>"><?php echo $res_buyer['order_no'];?></option>
                                        <?php } ?>
                                        <?php } ?> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
                                        <div class="col-sm-6">
                                            <select class="select2 form-control custom-select" name="style_no" id="style" onChange="style_no()">
                                            <option  value="<?php echo $select['style_no'];?>" selected="selected"><?php echo $select['style_no'];?></option>
                                            </select>
                                        </div>
                                                        </div>
                                <!--    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label" >Component Group</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="component" id="component" onchange="myFunction()" >
                                            <?php 
                                                 $sel_comp = mysqli_query($zconn,"select * from costing_entry_details group by comp_group");
                                                 while($res_comp = mysqli_fetch_array($sel_comp,MYSQLI_ASSOC)){
                                                     if($sel_knitting['comp_group']==$res_comp['comp_group']){
                                               ?>
                                                    <option value="<?php echo $res_comp['comp_group'];?>" selected="selected"><?php echo $res_comp['comp_group'];?></option>
                                                     <?php } else { ?>
                                                    <option  value="<?php echo $res_comp['comp_group'];?>" ><?php echo $res_comp['comp_group'];?></option>
                                                 <?php }
                                                 } ?>
                                               </select>
                                        </div>
                                   </div>
                             <br> -->
                </div>
                            </div>

                <!-- Sales chart -->
                <!-- ============================================================== --></div>

                 <?php if ($_GET['id']!='') {?>

                                    <div class="form-group">
                                        <h4 class="page-title"><b>Component Details</b></h4>
                                    </div>
    <table id="example" class="table table-striped table-bordered">
        <thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
            <tr>
                <th>Fabric name</th>
                <th>Pcs weight</th>
                <th>Order quantity + Excess</th>
                <th>Total weight [KGS]</th>
                <th>Total knitting loss</th>
            </tr>
        </thead>
        <tbody>
             <?php
                   $yarnDet=mysqli_query($zconn,"select * from knitting_planning WHERE  knitt_id = '".$_REQUEST['id']."' order by id asc ");
                        $cnt=1;
                        while($Det = mysqli_fetch_object($yarnDet)) {
                            $fabric_name=$Det->fabric_name;
                            $Name = mysqli_fetch_object(mysqli_query($zconn,"SELECT * FROM `knitting_planning_master` WHERE `id`='".$Det->knitt_id."'"));
                            ?>
                                <tr class="form-group has-success">
                                    <td class="w-150&quot;">
                                        <input type="text" name="fabric" id="fabric" autocomplete="off" class="form-control" value="<?php echo $fabric_name;?>" readonly="">
                                    </td>
                                    <td class="w-250&quot;">
                                        <input type="text" name="yarn_pcs_weight[]" id="yarn_color_0" autocomplete="off" class="form-control" value="<?php echo $Det->pcs_weight;?>" readonly=""> 
                                    </td>
                                    <td class="w-150">
                                        <input type="text" name="yarn_qty_total[]" id="yarn_grp_0" autocomplete="off" class="form-control" value="<?php echo $Name->order_qty;?>" readonly=""> 
                                    </td>
                                    <td class="w-150">
                                        <input type="text" name="yarn_total_weight[]" id="yarn_comp_0" autocomplete="off" class="form-control" value="<?php echo $Det->total_weight;?>" readonly=""> 
                                    </td>
                                    <td class="w-150">
                                        <input type="text" name="knit_loss[]" autocomplete="off" class="form-control" value="<?php echo $Det->knit_loss;?>"  required /> 
                                    </td>
                                </tr>
                                <?php
                        $cnt++;
                        } ?>
        </tbody>
    </table>
    <br />
    <hr>
    <legend><h4> Knitting Planning Details</h4></legend>

<table id="example1" class="table table-striped table-bordered">
    <tbody>
        <thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
            <tr>
                <th style="width:15%;">Fabric Name</th>
                <th style="width:20%;">Content</th>
                <th style="width:10%;">Colour</th>
                <th style="width:10%;">DIA</th>
                <th style="width:10%;">F DIA</th>
                <th style="width:10%;">F GSM</th>
                <th style="width:10%;">Gauge</th>
                <th style="width:10%;">Loop Length</th>
                <th style="width:15%;">WGT</th>
                <!-- <th style="width:20px;"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th> -->
            </tr>
        </thead>
        <?php 
        $sel_planning= mysqli_query($zconn,"select * from knitting_planning where knitt_id='".$_GET['id']."'");
        $list_id=0;
        while($res_planning = mysqli_fetch_array($sel_planning,MYSQLI_ASSOC)){
        ?>
        <tr id="delete_<?php echo $list_id;?>">
                                <td>
                                    <input type="hidden" name="kid[]" value="<?php echo $res_planning['id'];?>">
                                    <input type="text" class="form-control totl" id="fabric_name" name="fabric_name[]" placeholder="Total" value="<?php echo $res_planning['fabric_name'];?>">

                                   </td>
                                   <td>
                                        <select name="content[]" id="content0" class="select2 form-control custom-select">
                                            <option>Select</option>
                                        <?php $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
                                        while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
                                        if($res_content['content_name']==$res_planning['content']){
                                            ?>
                                            <option selected value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>

                                        <?php } }?>
                                        </select>
                                    </td>

                                    <td>
                                        <select class="select2 form-control custom-select" name="ycolor[]" id="ycolor0">
                                            <option value="">Select</option>
                                            <?php
                                            $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
                                            while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
                                                if($res_ycolor['colour_name']==$res_planning['color']){ ?>
                                                <option selected value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
                                                <?php }?>
                                            <?php } ?>
                                        </select>
                                    </td>
                                  <td>
                                    <select class="select2 form-control custom-select" id="dia" name="dia[]">
                                        <option value="">Select</option>
                                        <?php $sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
                                        while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
                                            if($res_ycounts['dia_name']==$res_planning['dia']){ ?>
                                            <option value="<?php echo $res_ycounts['dia_name'];?>" selected ><?php echo $res_ycounts['dia_name'];?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $res_ycounts['dia_name'];?>"><?php echo $res_ycounts['dia_name'];?></option>

                                        <?php } }?>
                                     </select>
                                  </td>
                                  <td>
                                        <select class="select2 form-control custom-select" id="f_dia" name="f_dia[]">
                                        <option value="">Select</option>
                                        <?php $sel_ycounts = mysqli_query($zconn,"select * from fdia_master");
                                        while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
                                            if($res_ycounts['f_dia']==$res_planning['f_dia']){ ?>
                                                <option selected value="<?php echo $res_ycounts['f_dia'];?>"><?php echo $res_ycounts['f_dia'];?></option>
                                            <?php  } else { ?>
                                            <option value="<?php echo $res_ycounts['f_dia'];?>"><?php echo $res_ycounts['f_dia'];?></option>

                                        <?php } } ?>
                                        </select>
                                        </td>
                                   <td>
                                        <select class="select2 form-control custom-select" name="f_gsm[]" id="f_gsm">
                                            <option value="">Select</option>
                                                <?php
                                                    $sel_ycolor = mysqli_query($zconn,"select * from  fgsm_master");
                                                    while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
                                                    if($res_ycolor['f_gsm']==$res_planning['f_gsm']){ ?>

                                                            <option selected value="<?php echo $res_ycolor['f_gsm'];?>"><?php echo $res_ycolor['f_gsm'];?></option>
                                                    <?php } else { ?>
                                                            <option value="<?php echo $res_ycolor['f_gsm'];?>"><?php echo $res_ycolor['f_gsm'];?></option><?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </td>
                                        <td>
                                        <input type="text" class="form-control" id="gauge" name="gauge[]" autocomplete="off" value="<?php echo $res_planning['Gauge'];?>">
                                        </td>
                                        <td>
                                        <input type="text" class="form-control" id="loop" name="loop[]" autocomplete="off" value="<?php echo $res_planning['Loop_Length'];?>">
                                        </td>
                                        <td>
                                        <input type="text" class="form-control weight" id="weight" name="weight[]" onKeyUp="multiply()" autocomplete="off" value="<?php echo $res_planning['wgt'];$totwgt+=$res_planning['wgt'];?>">
                                        </td>
                                       <!--  <td>
                                            <a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
                                        </td> -->
                                        </tr>
        <?php $list_id++;} ?>
                                           <tr id="">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                  <h6 class="page-title">Yarn Total:</h6></td>
                                                <td>
                                            <input type="text" class="form-control" id="grand_total" name="grand_total" readonly placeholder="" value="<?php echo $totwgt;?>" style="border: 1px solid #000;">
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            <div class="border-top">
                                <div class="card-body">
                                    <div class="text-center">
                                   <a href="knitting_planning_list.php"><button type="button" class="btn btn-danger">back</button></a>
                                   </div>
                                   
                                </div>
                            </div>  
    </tbody>
</table>
<script src="dist/js/custom.min.js"></script>
    <?php
         $sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
         $ynamelist= '';
         while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
          $ynamelist .='<option value="'.$res_yname['id'].'">'.$res_yname['yarn_name'].'</option>';
          } 

         $sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
         $ycountlist= '';
         while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
            $ycountlist .='<option value="'.$res_ycounts['id'].'">'.addslashes($res_ycounts['dia_name']).'</option>';
         }

        $sel_ycounts = mysqli_query($zconn,"select * from fdia_master");
        $ytypes ='';
        while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
            $ytypes ='<option value="'.$res_ycounts['id'].'">'.$res_ycounts['f_dia'].'</option>';
        }

       $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
       $color_list='';
        while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
            $color_list .='<option value="'.$res_ycolor['id'].'">'.$res_ycolor['colour_name'].'</option>';
        }

        $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
        $content_list='';
        while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
            $content_list .='<option value="'.$res_content['id'].'">'.$res_content['content_name'].'</option>';
         }

        $selcomp = mysqli_query($zconn,"select * from fgsm_master ");
        $comp_list='';
        while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
            $fgsm .='<option value="'.$res_comp['id'].'">'.$res_comp['f_gsm'].'</option>';
        }

          ?>
<script type="text/javascript">
$(document).ready(function(){
    //$('.left-sidebar').slideToggle();
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var actions = $("#example1 td:last-child").html();
    // Append table with add row form on add new button click
    $(".add-new").click(function(){
        var index = $("table tbody tr:last-child").index();
        var newc = parseInt(index)+parseInt(1);
        var row = '<tr >' +
            '<td><input type="text" class="form-control" id="fabric_name'+newc+'" name="fabric_name[]"  value="<?php echo $fabric_name;?>"> </td>' + '<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>'+ 
            '<td><select class="select2 form-control custom-select" name="ycolor[]" id="ycolor'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="dia'+newc+'" name="dia[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="f_dia'+newc+'" name="f_dia[]"><option>Select</option><?php echo $ytypes;?></select></td>'  +
           '<td><select class="select2 form-control custom-select" name="f_gsm[]" id="f_gsm'+newc+'"><option>Select</option><?php echo $fgsm;?></select></td>' +'<td><input type="text" class="form-control" name="gauge[]" id="gauge'+newc+'"></td>' +
            '<td><input type="text" class="form-control" name="loop[]" id="loop'+newc+'" ></td>' +
            '<td><input type="text" class="form-control weight" id="weight'+newc+'" name="weight[]" onKeyUp="multiply()" ></td>' +
            '<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
        $("#example1").append(row);
        $("#example1 tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Add row on add button click
    $(document).on("click", ".add", function(){
        var empty = false;
        var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
        //  if(!$(this).val()){
        //      $(this).addClass("error");
        //      empty = true;
        //  } else{
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

// To get buyer short name for costing number
function sum_grand(){
    var sum = 0;
    $('.totl').each(function(){
        sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
    });
    if(sum==NaN){
        $('#grand_total').val('0'); 
    } else {
        $('#grand_total').val(sum);
    }
}

function buyer_costing(sh_name){
    var sname = sh_name.split('~~');
    var cno = $('#cost_no').val();
    var nc = sname['0']+"-"+cno;
    $('#costing_no').val(nc);
    sum_grand();
}

function cal_yarn_pcs(id){
    var t1 = document.getElementById('consumption_val'+id).value;
    var t2 = document.getElementById('consumption_per'+id).value;
    var t3 = ((parseFloat(t1))*(parseFloat(t2)/100));
    document.getElementById('weight'+id).value=parseFloat(t3).toFixed(3);
    //input_sum_calculate_yarn_amount(id);
    sum_grand();
}

function cal_amount(id) {
    var t1 = document.getElementById('weight'+id).value;
    var t2 = document.getElementById('yrate'+id).value;
    var t3 = parseFloat(t1)*parseFloat(t2);
    document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(2);
  //  input_sum_calculate_yarn();
  sum_grand();
}   

function multiply(){
    var sum=0;
    $('.weight').each(function(index, element){
    if($(element).val()!="")
        sum += parseFloat($(element).val());
              });
         $('#grand_total').val(sum);}
</script> 


                 <? }
                 ?>

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
    <!-- <?php
         $sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
         $ynamelist= '';
         while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
          $ynamelist .='<option value="'.$res_yname['id'].'">'.$res_yname['yarn_name'].'</option>';
          } 

         $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
         $ycountlist= '';
         while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
            $ycountlist .='<option value="'.$res_ycounts['counts_id'].'">'.addslashes($res_ycounts['counts_name']).'</option>';
         }

        $sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
        $ytypes ='';
        while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
            $ytypes ='<option value="'.$res_ycounts['id'].'">'.$res_ycounts['yarn_type_name'].'</option>';
        }

       $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
       $color_list='';
        while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
            $color_list .='<option value="'.$res_ycolor['id'].'">'.$res_ycolor['colour_name'].'</option>';
        }

        $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
        $content_list='';
        while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
            $content_list .='<option value="'.$res_content['id'].'">'.$res_content['content_name'].'</option>';
         }

        $selcomp = mysqli_query($zconn,"select * from components where status='0'");
        $comp_list='';
        while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
            $comp_list .='<option value="'.$res_comp['id'].'">'.$res_comp['comp_name'].'</option>';
        }

        $sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
        $uom_list ='';
        while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
            $uom_list .='<option value="'.$res_uom['id'].'">'.$res_uom['uom_name'].'</option>';
        }
          ?> -->
<script type="text/javascript">
$(document).ready(function(){
    //$('.left-sidebar').slideToggle();
});

// $(document).ready(function(){
//  $('[data-toggle="tooltip"]').tooltip();
//  var actions = $("table td:last-child").html();
    // Append table with add row form on add new button click
  //   $(".add-new").click(function(){
        // var index = $("table tbody tr:last-child").index();
        // var newc = parseInt(index)+parseInt(1);
  //       var row = '<tr >' +
  //           '<td><select class="select2 form-control custom-select" id="yname'+newc+'" name="yname[]"><option>Select</option><?php echo $ynamelist;?></select></td>' +
  //           '<td><select class="select2 form-control custom-select" id="ycount'+newc+'" name="ycount[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
  //           '<td><select class="select2 form-control custom-select" id="ytype'+newc+'" name="ytype[]"><option>Select</option><?php echo $ytypes;?></select></td>' +
  //           '<td><select class="select2 form-control custom-select" name="ycolor[]" id="ycolor'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
  //           '<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>' +
  //           '<td><input type="text" name="comp_group[]" id="comp_group'+newc+'" class="form-control"></td>' +
        //  '<td><select class="select2 form-control custom-select" name="ycomp[]" id="ycomp'+newc+'"><option>Select</option><?php echo $comp_list;?></select></td>'+
  //           '<td><input type="text" class="form-control" name="consumption_val[]" id="consumption_val'+newc+'"></td>' +
  //           '<td><input type="text" class="form-control" name="consumption_per[]" id="consumption_per'+newc+'" placeholder="in percentage" onkeyup="cal_yarn_pcs('+newc+');"></td>' +
  //           '<td><input type="text" class="form-control" id="pcs_weight'+newc+'" name="pcs_weight[]" placeholder="Pcs.Weight"></td>' +
  //           '<td><select class="select2 form-control custom-select" name="uom[]" id="uom'+newc+'"><option>Select</option><?php echo $uom_list;?></select></td>' +
  //           '<td><input type="text" class="form-control" id="yrate'+newc+'" name="yrate[]" placeholder="Rate" onkeyup="cal_amount('+newc+');"></td>' +
  //           '<td><input type="text" class="form-control totl" id="ytotal'+newc+'" placeholder="Total" name="ytotal[]" value="0"></td>' +
        //  '<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
  //       '</tr>';
  //    $("table").append(row);
        // $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
  //       $('[data-toggle="tooltip"]').tooltip();
    //});

    // Add row on add button click
    // $(document).on("click", ".add", function(){
    //  var empty = false;
    //  var input = $(this).parents("tr").find('input[type="text"]');
 //        input.each(function(){
        //  if(!$(this).val()){
        //      $(this).addClass("error");
        //      empty = true;
        //  } else{
        //        $(this).removeClass("error");
        //    }
        // });
        // $(this).parents("tr").find(".error").first().focus();
        // if(!empty){
        //  input.each(function(){
        //      $(this).parent("td").html($(this).val());
        //  });
        //  $(this).parents("tr").find(".add, .edit").toggle();
        //  $(".add-new").removeAttr("disabled");
        // }
  //   });
    // Edit row on edit button click
    // $(document).on("click", ".edit", function(){
 //        $(this).parents("tr").find("td:not(:last-child)").each(function(){
    //      $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
    //  });
    //  $(this).parents("tr").find(".add, .edit").toggle();
    //  $(".add-new").attr("disabled", "disabled");
 //    });
    // Delete row on delete button click
//  $(document).on("click", ".delete", function(){
//         $(this).parents("tr").remove();
//      $(".add-new").removeAttr("disabled");
//     });
// });

// To get buyer short name for costing number
function sum_grand(){
    var sum = 0;
    $('.totl').each(function(){
        sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
    });
    if(sum==NaN){
        $('#grand_total').val('0'); 
    } else {
        $('#grand_total').val(sum);
    }
}


function buyer_costing(sh_name){
    var sname = sh_name.split('~~');
    var cno = $('#cost_no').val();
    var nc = sname['0']+"-"+cno;
    $('#costing_no').val(nc);
    sum_grand();
}

function cal_yarn_pcs(id){
    var t1 = document.getElementById('consumption_val'+id).value;
    var t2 = document.getElementById('consumption_per'+id).value;
    var t3 = ((parseFloat(t1))*(parseFloat(t2)/100));
    document.getElementById('weight'+id).value=parseFloat(t3).toFixed(3);
    //input_sum_calculate_yarn_amount(id);
    sum_grand();
}

function cal_amount(id) {
    var t1 = document.getElementById('weight'+id).value;
    var t2 = document.getElementById('yrate'+id).value;
    var t3 = parseFloat(t1)*parseFloat(t2);
    document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(2);
  //  input_sum_calculate_yarn();
  sum_grand();
}


// $("#sel_buyer").click(function(){
//     var sel_buyer=document.getElementById('sel_buyer').value;

    //alert(sel_buyer);
// $.ajax({
// type: "POST",
// url: "mysimplepage.php",
// async: true,
// data: { logDownload: true, file: $(this).attr("name") }
// });
// success: function(result){
//     $("#div1").html(result);
//     }

// return false;
//});


    $(document).ready(function(){
                $('#sel_buyer').change(function(){
                     var sel_buyer=document.getElementById('sel_buyer').value;
                    $.ajax({
                        
                        type: "POST",
                        url:  "select_styleno.php",
                        data: {sel_buyer: $('#sel_buyer').val()},
                        success: function(data){
                            
                            $("#style").html(data);
                        }
                    });
                                     
                });
                
            });


// function style_no(){
   
//         var styleno = $("#style").val();
        
//       alert(styleno);
       
//     }



    $(document).ready(function(){
                $('#style').change(function(){
                     var style=document.getElementById('style').value;
                    $.ajax({
                        
                        type: "POST",
                        url:  "combogroup.php",
                        data: {style: $('#style').val()},
                        success: function(data){
                            
                            $("#component").html(data);
                        }
                    });
                                     
                });
                
            });



// function component(){

//     alert('dfvfbfgbb');
// }


// $(document).ready(function(){
//     $('#component').change(function(){
//         var component=document.getElementById('component').value;
//         alert(component);



//     });
// });




function myFunction(){
    var form = document.manu;
    var dataString = $(form).serialize();

    alert(dataString);
    $('#suggestion').html('<img src="ajax_entry/loader.gif" width="214" height="138">');
    $.ajax({
        type:'POST',
        url:'planing_knittting_table.php',
        data: dataString,
        success: function(data){
            $('#suggestion').html(data);
        }
    });
    return false;
    }




</script>



<script>
function myFunction() {
    var c = document.getElementById("component").value;
    var s = document.getElementById("style").value;
    var b = document.getElementById("sel_buyer").value;
       $.ajax({
         type:'POST',
         url:'planing_knittting_table.php',
         data:{ c:c,s:s,b:b}, 
         success:function(data){
             $("#demo").html(data);
            }
          });
    // document.getElementById("demo").innerHTML = "You selected: " + c;
}
</script>


</body>
</html>