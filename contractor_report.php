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
    <title><?php echo SITE_TITLE;?> - Contractor Report 	</title>
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
                        <h4 class="page-title">Contractor Report </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Contractor Report </a></li>
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
                    <div class="box-content">
                    <fieldset>
                    <h3>Contractor Salary Print</h3>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="41%" height="43" align="center"><h4>Select Department</h4></td>
                        <td width="59%">
                        <form name="workDone" action="" method="post">
                       
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                               
                          <select name="dept" data-rel="chosen" autofocus="autofocus" onchange="document.workDone.submit();">
                          <option value="selected">Selected</option>
<option value="Cutting" <? if($_REQUEST['dept']=='Cutting'){?> selected="selected"<? }?>>Cutting</option>
<option value="Power" <? if($_REQUEST['dept']=='Power') { $Nameworkpen="power_workpen"; ?> selected="selected" <?php }?>>Power Table</option>
<option value="Singer" <? if($_REQUEST['dept']=='Singer') {$Nameworkpen="singer_workpen"; ?> selected="selected" <?php } ?>>Singer</option>
<option value="Ironing & packing"<? if($_REQUEST['dept']=='Ironing & packing' || $_REQUEST['dept']=='ironing' ) { $Nameworkpen="iron_workpen";?> selected="selected" <?php } ?> >Ironing & packing</option>
<option value="Checking" <?php if($_REQUEST['dept']=='Checking') {$Nameworkpen="checking_workpen"; ?> selected="selected" <?php } ?>>Checking</option>
<option value="Printing" <?php if($_REQUEST['dept']=='Printing') { $Nameworkpen="printing_workpen";?> selected="selected" <?php } ?>>Printing</option>
<option value="Embroidery" <?php if($_REQUEST['dept']=='Embroidery') {$Nameworkpen="embroid_workpen"; ?> selected="selected" <?php } ?>>Embroidery</option>
<option value="Sticker" <?php if($_REQUEST['dept']=='Sticker'){$Nameworkpen="sticker_workpen";?> selected="selected" <?php } ?>>Sticker</option>
<option value="Fusing" <?php if($_REQUEST['dept']=='Fusing'){$Nameworkpen="fusing_workpen";?> selected="selected" <?php }?>>Fusing</option>
<option value="Stone" <?php if($_REQUEST['dept']=='Stone') { $Nameworkpen="stone_workpen"; ?> selected="selected" <?php } ?>>Stone</option>
<option value="Sequence" <?php if($_REQUEST['dept']=='Sequence') {$Nameworkpen="sequence_workpen";?> selected="selected" <?php } ?>>Sequence</option>
<option value="dye_and_dye" <?php if($_REQUEST['dept']=='dye_and_dye') {$Nameworkpen="dye_and_dye_workpen";?> selected="selected" <?php } ?>>Dye and Dye</option>
<option value="kajabutton" <?php if($_REQUEST['dept']=='kajabutton') {$Nameworkpen="kajabutton_workpen";?> selected="selected" <?php } ?>>Kaja Button</option>
<option value="rope" <?php if($_REQUEST['dept']=='rope') {$Nameworkpen="rope_workpen";?> selected="selected" <?php } ?>>Rope</option>
<option value="shaping" <?php if($_REQUEST['dept']=='shaping') {$Nameworkpen="shaping_workpen";?> selected="selected" <?php } ?>>Shaping</option>
<option value="cutting_sticker" <?php if($_REQUEST['dept']=='cutting_sticker') {$Nameworkpen="cutting_sticker_workpen";?> selected="selected" <?php } ?>>Cutting Sticker</option>
<option value="embroidery_applique" <?php if($_REQUEST['dept']=='embroidery_applique') {$Nameworkpen="embroidery_applique_workpen";?> selected="selected" <?php } ?>>Embroidery Applique</option>
<option value="sublimation_printing" <?php if($_REQUEST['dept']=='sublimation_printing') {$Nameworkpen="sublimation_printing_workpen";?> selected="selected" <?php } ?>>Sublimation Printing</option>
<option value="bow" <?php if($_REQUEST['dept']=='bow') {$Nameworkpen="bow_workpen";?> selected="selected" <?php } ?>>Bow</option>
<option value="others" <?php if($_REQUEST['dept']=='others') {$Nameworkpen="others_workpen";?> selected="selected" <?php } ?>>Others</option>
<option value="final_checking" <?php if($_REQUEST['dept']=='final_checking') {$Nameworkpen="final_checking_workpen";?> selected="selected" <?php } ?>>Final Checking</option>
<option value="panel_checking" <?php if($_REQUEST['dept']=='panel_checking') {$Nameworkpen="panel_checking_workpen";?> selected="selected" <?php } ?>>Panel Checking</option>

<option value="washing" <?php if($_REQUEST['dept']=='washing') {$Nameworkpen="washing_workpen";?> selected="selected" <?php } ?>>Washing</option>


                                        </select>
                        </form></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">
                        
                          <? if(isset($_REQUEST['dept'])){
                          ?>
                          
                             
                            
                            
                            <div id="myTabContent" class="tab-content">
                            
                            <ul class="nav nav-tabs" id="myTab" style="">
                            <?php $asd=0;
							 $s="SELECT DISTINCT(contid) as contid  FROM `dummy_contractor` WHERE `dept` LIKE '".$_REQUEST['dept']."'";
							$sql=mysql_query($s);
							
                            while($res=mysql_fetch_object($sql))
                            { 
                               
							$persondetail=mysql_fetch_object(mysql_query("SELECT * FROM  `persondetail` where `id`='".$res->contid."' "));
                            if($asd=='0'){
							?>
                              	<li class="active"><a href="#<?=$res->contid?>"><?=$res->contid?><? echo("(".$persondetail->name.")");?></a></li>
                             <? 
							}else{
							?>
								<li><a href="#<?=$res->contid?>"><?=$res->contid?><? echo("(".$persondetail->name.")");?></a></li>
							<? 
							 }
							 $asd=1;
                             } 
                             ?> 
                            </ul>
                            
                            <? 
                            $sql=mysql_query("SELECT DISTINCT(contid) as contid  FROM `dummy_contractor` WHERE `dept` LIKE '".$_REQUEST['dept']."' ORDER BY `dummy_contractor`.`contid` ASC");
							$ads=0;
                            while($res=mysql_fetch_object($sql))
                            {
                                $persondetail=mysql_fetch_object(mysql_query("SELECT * FROM  `persondetail` where `id`='".$res->contid."' "));
								if($ads=='0'){?>
                            
								<div class="tab-pane active" id="<?=$res->contid?>" >
                            	
                  		  		  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            	<tr>
                            		<td align="center" valign="top"> <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" class="curvedEdges1">
                              <tr>
                                <td height="32" colspan="3" align="center" valign="middle">Contractor Name : <?php echo $persondetail->name;?> - Id:<?php echo $res->contid;?></td>
                                </tr>
                              <tr>
                                <td width="25%" height="32" align="center" valign="middle"><strong>Pay Date</strong></td>
                                <td width="25%" align="center" valign="middle"><strong>Status</strong></td>
                                <td width="25%" align="center" valign="middle"><strong>Action</strong></td>
                                </tr>
                            <?		
                            $sql_result=mysql_query("SELECT * FROM  `dummy_contractor` WHERE  `contid` =  '".$res->contid."'ORDER BY  `dummy_contractor`.`date` DESC ");
                            while($result_sql=mysql_fetch_object($sql_result))
                            {
                                ?>
                            
                              <tr>
                                <td align="center" valign="middle"><?=date("d-m-Y",strtotime($result_sql->date))?></td>
                                <td align="center" valign="middle"><? 
                                        if($result_sql->status=='hide')
                                        {
                                            echo('<span class="label label-success">Paid</span>');
                                            $status='paid';
                                        }
                                        elseif($result_sql->status=='pending')
                                        {
                                            echo('<span class="label label-important">Waiting For Approval</span>');			
                                            $status='pending';
                                        } 
                                        elseif($result_sql->status=='show')
                                        {
                                            echo('<span class="label label-warning">Approved</span>');			
                                            $status='pending';						
                                        }	
                                        ?></td>
                                <td align="center" valign="middle">
                    <a class="btn btn-success" href="#" onclick="window.open('iframe_accounts.php?ids=<?=$result_sql->id?>&status=<?=$status?>&pay_date=<?=$result_sql->pay_date?>','Print','fullscreen=yes','_blank')"><i class="icon-list-alt icon-white"></i> View & Print</a>
                                     
            <!--<a href="#" onclick="window.open('iframe_accounts.php?ids=<?=$result_sql->id?>&print=yes&status=<?=$status?>','Print','_blank');" class="btn btn-warning"><i class="icon-print icon-white"></i> Print</a>--></td>
                                </tr>
                                <?
                            }
                            ?>   
                             </table></td>
                             		</tr>
                           </table>
                           
                            	</div>
                                
                                <? }else{ ?>
                                
                                
                                <div class="tab-pane" id="<?=$res->contid?>">
                            	
                  		          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                            <td align="center" valign="top"> <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" class="curvedEdges1">
                              <tr>
                                <td height="32" colspan="3" align="center" valign="middle">Contractor Name : <?php echo $persondetail->name;?> - Id:<?php echo $res->contid;?></td>
                                </tr>
                              <tr>
                                <td width="25%" height="32" align="center" valign="middle"><strong>Pay Date</strong></td>
                                <td width="25%" align="center" valign="middle"><strong>Status</strong></td>
                                <td width="25%" align="center" valign="middle"><strong>Action</strong></td>
                              </tr>
                            <?		
                            $sql_result=mysql_query("SELECT * FROM  `dummy_contractor` WHERE  `contid` =  '".$res->contid."'ORDER BY  `dummy_contractor`.`date` DESC ");
                            while($result_sql=mysql_fetch_object($sql_result))
                            {
                                ?>
                            
                              <tr>
                                <td align="center" valign="middle"><?=date("d-m-Y",strtotime($result_sql->date))?></td>
                                <td align="center" valign="middle"><? 
                                        if($result_sql->status=='hide')
                                        {
                                            echo('<span class="label label-success">Paid</span>');
                                            $status='paid';
                                        }
                                        elseif($result_sql->status=='pending')
                                        {
                                            echo('<span class="label label-important">Waiting For Approval</span>');			
                                            $status='pending';
                                        } 
                                        elseif($result_sql->status=='show')
                                        {
                                            echo('<span class="label label-warning">Approved</span>');			
                                            $status='pending';						
                                        }	
                                        ?></td>
                                <td align="center" valign="middle">                                
                                <a class="btn btn-success" href="#" onclick="window.open('iframe_accounts.php?ids=<?=$result_sql->id?>&status=<?=$status?>&pay_date=<?=$result_sql->pay_date?>','Print','fullscreen=yes','_blank')"><i class="icon-list-alt icon-white"></i> View & Print</a>
                                
                                <!--<a href="#" onclick="window.open('iframe_accounts.php?ids=<?=$result_sql->id?>&print=yes&status=<?=$status?>','Print','_blank');" class="btn btn-warning"><i class="icon-print icon-white"></i> Print</a>-->
                                </td>
                              </tr>
                                <?
                            }
                            ?>   
                             </table></td>
                             </tr>
                             </table>
                           
                            	</div>
                                
								<?
								} $ads=1;
                            }
                             ?>
						  </div>
							 <? 
                          }
						  ?>
                          </td>
                        </tr>
                    </table>
                    </fieldset>
                    
</div>
				</div>
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
</body>
</html>