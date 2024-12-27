

<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - PO Order</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">

	<style>
	

	table.table {
    border: 1px solid black;
    border-top:2px solid black; 
}





	</style>
</head>
<body>
    <div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php //include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php //include('includes/sidebar.php');?>
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
                        <h4 class="page-title">PO Order</h4>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
				<form name="costing_entry" id="costing_entry" method="post">
 
				 <div class="col-md-12">
                    <div class="card">
						<div class="card-body" style="width:100%; padding:0px;">
				<?php

				// $grant_total=0;
				// 	if($order_no!=''){ $cost0 = mysqli_fetch_array(mysqli_query($zconn,
                //         "select * from yarns_po_details where order_no='".$order_no."'"),MYSQLI_ASSOC);
                //         print_r($cost0);
                //         exit();
				// 	$costb = mysqli_fetch_array(mysqli_query($zconn,"select * from yarns_po_master where  id='".$cost0['po_id']."'"),MYSQLI_ASSOC);
				// 	// $coste = mysqli_fetch_array(mysqli_query($zconn,"select * from expenses_costing where costing_id='".$order_no."'"),MYSQLI_ASSOC);
                   
				// 	?>
				<table class="table">
					<thead>
					<tr>
					    <th style="width:20%;border: none;">Buyer Name</th>	
						<th style="width:30%; border: none;   "><?php echo $costb['buyer'];?></th>
						<th style="width:20%;border: none;">Date</th>
						<th style="width:30%;border: none;">
							<?php $dat_arr = explode("-",$cost0['date']);
							echo $dat_arr['2']."-".$dat_arr['1']."-".$dat_arr['0'];
							?>
						
						</th>
					</tr>
					<tr>
					    <th style="border: none;">Style No</th>
						<th style="border: none;"><?php echo $_REQUEST['style_no'];?></th>
						<th style="border: none;">Order Qty</th>
						<th style="border: none;"><?php echo $_REQUEST['order_no'];?></th>
					</tr>
					<tr>
					    <th style="border: none;">Discription</th>
						<th style="border: none;"><?php echo $coste['descr'];?></th>
						<th style="border: none;">Composition</th>
						<th style="border: none;"><?php echo $coste['compo'];?></th>
					</tr>
					</thead>
					</table>
					<table class="table 1" style="margin-top: -17px;">
						<tbody>
							<tr>
								<th style="border: 1px solid; width: 3%"> S.No</th>
								<th style="border: 1px solid; width: 23%">Process Type</th>
								<th style="border: 1px solid; width: 74%">Yarn Name & Rate</th>
							</tr>
						</tbody>
					</table>
					<table class="table" style="margin-top: -17px;"	>
						<tbody>
							<tr>
								<th>&nbsp;</th>
								<!-- <td style="border: 1px solid; width: 2%"></td> -->

								<th style="border: 1px solid; width: 23%;">Fabric Name</th>
								<?php 
									$cost = mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$costing_no."'"),MYSQLI_ASSOC);
						 			if($cost['costing_id']!=''){ 
									$cost_det = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details where costing_id='".$costing_no."' and fabric_name!=''");
									$count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(fabric_name)as fab_count from costing_entry_details where costing_id='".$costing_no."' and fabric_name!=''"),MYSQLI_ASSOC);
									$tot=75;
									$countf=$count['fab_count'];
									$width=($tot/$countf);

									while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){		
						 		?>
								<td  style="border: 1px solid; width:<?php echo $width."%";?>"><?php echo $res_cost_det['fabric_name'];?></td>
								<?php }   ?>
							</tr>
							<tr>
								<td style="border: 1px solid; width: 2%">1</td>
								<th style="border: 1px solid; width: 23%;">Yarn Rate</th>
								<?php 
									$cost_det = mysqli_query($zconn,"select distinct(fabric_name) as fabric_name from costing_entry_details where costing_id='".$costing_no."' and fabric_name!=''");
									$count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(fabric_name)as fab_count from costing_entry_details where costing_id='".$costing_no."' and fabric_name!=''"),MYSQLI_ASSOC);
									$tot=75;
									$countf=$count['fab_count'];
									$width=($tot/$countf);
									while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){	
									$rate= mysqli_fetch_array(mysqli_query($zconn,"select sum(yarn_rate) as yarn_rate from costing_entry_details where costing_id='".$costing_no."' and fabric_name='".$res_cost_det['fabric_name']."' and fabric_name!=''"),MYSQLI_ASSOC);
						 		?>
								<td  style="border: 1px solid; width:<?php echo $width."%";?>"><?php echo $rate['yarn_rate'];
										$grant_total +=$rate['yarn_rate'];
									
									?></td>
								<?php } }  ?>

							 </tr>
								<?php  
									$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from knit_costing where costing_no='".$costing_no."' and fabric_name!=''"),MYSQLI_ASSOC);
									$COSTNO=$cost_de['costing_no'];
									if ($COSTNO!='') {
									?>
							<tr>
								<td style="border: 1px solid; width: 2%;">2</td>
								<th style="border: 1px solid; width: 23%;">Knitting Costing</th>
								<?php 
									$cost_det = mysqli_query($zconn,"select * from knit_costing where costing_no='".$costing_no."'");
									
									$count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(fabric_name)as fab_count from costing_entry_details where costing_id='".$costing_no."' and fabric_name!=''"),MYSQLI_ASSOC);
									$tot=75;
									$countf=$count['fab_count'];
									$width=($tot/$countf);
									while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){
																		
						 		?>
								<td style="border: 1px solid; width:<?php echo $width."%"; ?>"><?php echo $res_cost_det['rate_per_pc'];
										$grant_total = $grant_total+ $res_cost_det['rate_per_pc'];?></td>
								<?php } ?>
							</tr>
						<?php } ?> 

						<?php 
								$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from dyeing_costing where costing_no='".$costing_no."' and fabric_name!=''"),MYSQLI_ASSOC);
									$COSTNO=$cost_de['costing_no'];
								if ($COSTNO!='') {
							?> 
						 <tr>
								<td style="border: 1px solid; width: 2%;">3</td>
								<th style="border: 1px solid; width: 23%;">Dyeing Costing</th>
								<?php 
									$cost_det = mysqli_query($zconn,"select distinct(fabric_name) as fabric_name from dyeing_costing where costing_no='".$costing_no."' and fabric_name!=''");
									$count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(fabric_name)as fab_count from costing_entry_details where costing_id='".$costing_no."' and fabric_name!=''"),MYSQLI_ASSOC);
									$tot=75;
									$countf=$count['fab_count'];
									$width=($tot/$countf);
									$total=0;
									while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){
									$fabric_name =$res_cost_det['fabric_name'];	

									$cost = mysqli_fetch_array(mysqli_query($zconn,"select COUNT(fabric_name) as count,sum(total) as total from dyeing_costing where costing_no='".$costing_no."' and fabric_name ='$fabric_name' and fabric_name!=''"),MYSQLI_ASSOC);
									 $total =$cost['total']/$cost['count'];								
						 		?>
						 		 <!-- <td colspan="<?php echo $countf ;?>" style="border: 1px solid; ?>"-->
								  <!--<?php echo number_format($total,2);?></td>  -->
								<td style="border: 1px solid; width:<?php echo $width."%"; ?>"><?php echo number_format($total,2);$grant_total +=$total;?></td>
								<?php  } ?>	
							</tr> 
							<?php  } ?>	 





							 <?php 
									$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from other_costing where costing_no='".$costing_no."' and fabric_name!=''"),MYSQLI_ASSOC);
									$COSTNO=$costing_no;
								//	if ($COSTNO!='') {
									?> 




								<?php 
						 			$cost_other = mysqli_query($zconn,"select distinct process_name from other_costing where costing_no='".$costing_no."' and fabric_name!=''");
										
									$count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(process_name)as process_name from other_costing where costing_no='".$costing_no."' and fabric_name!='' and process_name='".$other0['process_name']."'and fabric_name='".$res_cost_det['fabric_name']."'"),MYSQLI_ASSOC);
										  $countf=$count['process_name'];	
									
									
									?>


							 <tr>
								<td style="border: 1px solid; width: 2%;">4</td>
								<th style="border: 1px solid; width: 23%;">Other Process Costing</th>





							<?php 
									$cost_det = mysqli_query($zconn,"select distinct fabric_name from other_costing where costing_no='".$costing_no."' and fabric_name!='' ");
									
									while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){
									$other001 = mysqli_fetch_array(mysqli_query($zconn,"select * from other_costing where costing_no='".$costing_no."' and fabric_name!='' and fabric_name='".$res_cost_det['fabric_name']."'"),MYSQLI_ASSOC);

									 $count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(process_name)as process_name,sum(total) as total from other_costing where costing_no='".$costing_no."' and fabric_name!='' and fabric_name='".$res_cost_det['fabric_name']."'"),MYSQLI_ASSOC);


									 $countf=$count['process_name'];

									 $total=0;
									 $total=$count['total']

						 		?>

								<td style="border: 1px solid; width:<?php echo $width."%"; ?>"><?php echo $total;$grant_total +=$total;?></td>
								<?php  } 
									   //}  ?>	
							</tr>
							<?php //}  ?>	



							<?php 
						 		
								$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from accessories_costing where costing_no='".$costing_no."'"),MYSQLI_ASSOC);
									$COSTNO=$cost_de['costing_no'];
								if ($COSTNO!='') {
							?> 
						 <tr>
								<td style="border: 1px solid; width: 2%;">5</td>
								<th style="border: 1px solid; width: 23%;">Accessories Costing</th>
								<?php 
						 			

						 			 
									$cost_ass = mysqli_fetch_array(mysqli_query($zconn,
                                    "select  sum(total) as total from accessories_costing where costing_no='".$costing_no."' "));

									$tot=75;

									$countf=$count['fab_count'];
									$width=($tot);
									// $total=0;
									// while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){
									// $fabric_name =$res_cost_det['fabric_name'];	

									// $cost = mysqli_fetch_array(mysqli_query($zconn,"select COUNT(costing_no) as count,sum(total) as total from dyeing_costing where costing_no='".$explode['1']."' and fabric_name ='$fabric_name' and fabric_name!=''"),MYSQLI_ASSOC);
									//  $total =$cost['total']/$cost['count'];								
						 		?>
						 		 <!-- <td colspan="<?php echo $countf ;?>" style="border: 1px solid; ?>"><?php echo number_format($total,2);?></td>  -->
								<td colspan="3" style="border: 1px solid; width:<?php echo $width."%"; ?>"><?php echo number_format($cost_ass['total'],2);$grant_total +=$cost_ass['total'];?></td>
								 <?php  } ?> 	
							</tr> 
							<?php   ?>	 

							<?php 
								$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from department_costing where costing_no='".$costing_no."'"),MYSQLI_ASSOC);
									$COSTNO=$costing_no;
								if ($COSTNO!='') {
							?> 
						 <tr>
								<td style="border: 1px solid; width: 2%;">6</td>
								<th style="border: 1px solid; width: 23%;">Department Costing</th>
								<?php 
						 			 
									$cost_ass = mysqli_fetch_array(mysqli_query($zconn,"select  sum(rate) as total from department_costing where costing_no='".$costing_no."' "));

									 $count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(costing_no)as fab_count, sum(total) as total from department_costing where costing_no='".$costing_no."' "),MYSQLI_ASSOC);
									$tot=75;

									$countf=$count['fab_count'];
									$width=($tot);
									// $total=0;
									// while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){
									// $fabric_name =$res_cost_det['fabric_name'];	

									// $cost = mysqli_fetch_array(mysqli_query($zconn,"select COUNT(costing_no) as count,sum(total) as total from dyeing_costing where costing_no='".$explode['1']."' and fabric_name ='$fabric_name' and fabric_name!=''"),MYSQLI_ASSOC);
									//  $total =$cost['total']/$cost['count'];								
						 		?>
						 		 <!-- <td colspan="<?php echo $countf ;?>" style="border: 1px solid; ?>"><?php echo number_format($total,2);?></td>  -->
								<td colspan="3" style="border: 1px solid; width:<?php echo $width."%"; ?>"><?php echo number_format($cost_ass['total'],2);$grant_total +=$cost_ass['total'];?></td>
								 <?php  } ?> 	
							</tr> 
							<?php   ?>	 

							<?php 
								$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from fabric_costing where costing_no='".$costing_no."'"),MYSQLI_ASSOC);
									$COSTNO=$costing_no;
								if ($COSTNO!='') {
							?> 
					<!--	 <tr>
								<td style="border: 1px solid; width: 2%;">7</td>
								<th style="border: 1px solid; width: 23%;">Fabric Name</th>-->
								<?php  
									$cost_ass = mysqli_query($zconn,"select  distinct(fabric_name) as fabric_name from fabric_costing where costing_no='".$costing_no."' ");
									while ($fabric=mysqli_fetch_array($cost_ass,MYSQLI_ASSOC)) {
									 $count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(costing_no)as fab_count from fabric_costing where costing_no='".$costing_no."' "),MYSQLI_ASSOC);
									$tot=75;
									$countf=$count['fab_count'];
									$width=($tot/$countf);									
						 		?>
								<!--<td  style="border: 1px solid; width:<?php echo $width."%"; ?>">
								<?php echo $fabric['fabric_name'];?></td>-->
							 <?php  } ?> 
							<!--</tr> -->
							<?php  } ?>	 
							
							<?php 
								$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from fabric_costing where costing_no='".$costing_no."'"),MYSQLI_ASSOC);
									$COSTNO=$costing_no;
								if ($COSTNO!='') {
							?> 
						 <tr>
								<td style="border: 1px solid; width: 2%;">7</td>
								<th style="border: 1px solid; width: 23%;">Fabric Costing</th>
								<?php 
									$cost_ass = mysqli_query($zconn,"select  distinct(fabric_name) as fabric_name from fabric_costing where costing_no='".$costing_no."' ");
									while ($fabric=mysqli_fetch_array($cost_ass,MYSQLI_ASSOC)) {
									 $count= mysqli_fetch_array(mysqli_query($zconn,"select COUNT(costing_no)as fab_count from fabric_costing where costing_no='".$costing_no."' "),MYSQLI_ASSOC);
									 $total= mysqli_fetch_array(mysqli_query($zconn,"select sum(fab_total) as total from fabric_costing where costing_no='".$costing_no."' and fabric_name='".$fabric['fabric_name']."' "),MYSQLI_ASSOC);
									//$countf=$count['fab_count'];
									$tot=75;
									$countf=$count['fab_count'];
									$width=($tot/$countf);	

						 		?>
						 		
								<td style="border: 1px solid; width:<?php echo $width."%"; ?>"><?php echo number_format($total['total'],2);$grant_total +=$total['total'];?></td>
								<?php  } ?> 
							</tr> 
							<?php  } ?>	

							<?php 
								$cost_de = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where costing_no='".$costing_no."'"),MYSQLI_ASSOC);
									$COSTNO=$costing_no;
								//if ($COSTNO!='') {
							?> 
						 <tr>
								<td style="border: 1px solid; width: 2%;">8</td>
								<th style="border: 1px solid; width: 23%;">Expenses Costing</th>
								<?php 
		$cost_ass = mysqli_query($zconn,"select  * from expenses_costing where costing_no='".$costing_no."' ");
			while ($fabric=mysqli_fetch_array($cost_ass,MYSQLI_ASSOC)) {
					$totexpenses=$fabric['overhead']+$fabric['process_profit']+$fabric['process_loss']-$fabric['rejection'];
					$grant_tot=($grant_total*$totexpenses)/100;
					$loss=$fabric['commission']+$fabric['farwarding_charges'];
					$grandt_to0=$grant_tot+$loss;
					$grandt_tot=$grandt_to0/$cost_de['order_qty'];
									$tot=75;
									$countf=$count['fab_count'];
									$width=($tot/$countf);	
						 		?>
								<td style="border: 1px solid; width:<?php echo $width."%"; ?>"><?php echo number_format($grandt_tot,2);$grant_total +=$grandt_tot;?></td>
								<!-- <?php  //} ?> -->	
							</tr> 
							<?php  // } ?>	

<tr>
	<th colspan="2" style="border: 1px solid; text-align: center;" >Total Cost</th>
	<th colspan="<? echo $countf?>" style="border: 1px solid;"><? echo number_format($grant_total,2);?></th>
</tr>





							







 
						</tbody>
					</table>
				<?php  }?>
				</div>
			</div>
		</div>
				</form>
            <!-- End Container fluid  -->
         <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
  </div>
            <!-- footer -->
           
            <!-- End footer -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
 		<?php //include('includes/footer.php');?>
</body>
</html>