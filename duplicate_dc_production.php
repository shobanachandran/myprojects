<? 
session_start();
$current='Duplicate Print';
include('include/config.php');
include('include/head.php');
if(isset($_REQUEST['filter_date'])){
	$date=date("Y-m-d",strtotime($_REQUEST['filter_date']));
}
else{
	$date =date("Y-m-d");
}
if(!isset($_SERVER['HTTP_HOST'])){
?>
<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
<? }?>	
		<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i><?=$current?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                   
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>From</td>
                        <td>&nbsp;</td>
                        <td><form name="" action="" method="get">
                          <input type="text" name="filter_date" value="<?=date("d-m-Y",strtotime($date))?>" class="datepicker span10" onChange="this.form.submit()" />
                        </form></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="10%">Filer Style</td>
                        <td width="1%">&nbsp;</td>
                        <td width="23%"><form name="" action="" method="get">
                          <select name="style" data-rel="chosen" class="span10" onChange="this.form.submit()">
                            <?
                        $dccc=mysql_query("SELECT DISTINCT(styleno) as id FROM  `dc`");
						while($dccs=mysql_fetch_object($dccc)){
						?>
                            <option value="<?=$dccs->id?>" <? if($_REQUEST['dcno'] == $dccs->id){?> selected="selected"<? }?>><? echo $dccs->id;?></option>
                            <?
                        }
						?>
                          </select>
                        </form></td>
                        <td width="9%">Filter DC</td>
                        <td width="2%">&nbsp;</td>
                        <td width="21%"><form name="" action="" method="get">
                        <select name="dcno" data-rel="chosen" class="span10" onchange="this.form.submit()">
                        <?
                        $dccc=mysql_query("SELECT DISTINCT(i) as id FROM  `dc`");
						while($dccs=mysql_fetch_object($dccc)){
						?>
                        <option value="<?=$dccs->id?>" <? if($_REQUEST['dcno'] == $dccs->id){?> selected="selected"<? }?>><? echo $dccs->id;?></option>
                        <?
                        }
						?>
                        </select> </form></td>
                        <td width="9%">Filter Company</td>
                        <td width="1%">&nbsp;</td>
                        <td width="24%"><form name="" action="" method="get">
                        <select name="company" data-rel="chosen" class="span10" onchange="this.form.submit()">
                        <?
                        $dccc=mysql_query("SELECT DISTINCT(`company_name`) as id FROM  `dc`");
						while($dccs=mysql_fetch_object($dccc)){
						$employye=mysql_fetch_object(mysql_query("select * from `persondetail` where `id` ='$dccs->id'"));
						?>
                        <option value="<?php echo $dccs->id;?>" <? if($_REQUEST['company'] == $dccs->id){?> selected="selected"<? }?>><? echo $employye->name;?></option>
                        <?
                        }
						?>
                        </select> </form></td>
                      </tr></table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
  <tr>
    <th width="103">DC NO</th>
    <th width="149">Date</th>
    <th width="330">To </th>
    <th width="317">Style No</th>
    <th width="317">Description</th>
    <th width="332">Action</th>
  </tr>
  </thead>
  <tbody>
  <?  
  
  $sqlasa="SELECT DISTINCT(i) as id FROM  `dc`";
  if(isset($_REQUEST['filter_date'])){
  	$sqlasa.="where `date`='$date'";
  }
  elseif(isset($_REQUEST['dcno'])){
  	$sqlasa.="where `i` = '".$_REQUEST['dcno']."'";
  }
  elseif(isset($_REQUEST['style'])){
  	  	$sqlasa.="where `styleno` = '".$_REQUEST['style']."'";
  }	
  elseif(isset($_REQUEST['company'])){
  	  	$sqlasa.="where `company_name` = '".$_REQUEST['company']."'";
  }	
  else{
    	$sqlasa.="where `date`='$date'";
  }
  $sqla=mysql_query($sqlasa);
  while($sql=mysql_fetch_object($sqla)){ 
  $id=$sql->id;
  if($id > '2013'){
	  $f_year = '2014';
  }
  else{
	  $f_year = '2014';
  }
  $getch=mysql_fetch_object(mysql_query("select * from `dc` where `i`='$id' and `f_year` = '$f_year'"));
  $dates=$getch->date;
  $to=$getch->company_name;
  $desc=$getch->department;
  $styleno=$getch->styleno;
 // $status=$sql->admin_status;
  ?>
  <tr>
    <td height="25" align="center" valign="middle"><?=$id?></td>
    <td align="center" valign="middle"><?=date("d-m-Y",strtotime($dates));?></td>
    <td align="center" valign="middle"><? $employye=mysql_fetch_object(mysql_query("select * from `persondetail` where `id` ='$to'"));echo $employye->name;?></td>
    <td align="center" valign="middle"><?=$styleno?></td>
    <td align="center" valign="middle"><?=$desc?></td>
    <td align="center" valign="middle"><a href="DCcom.php?id=<?=$id?>" class="btn btn-success"><i class="icon-print"> </i> Print</a></td>
  </tr>
  <?
  }
  ?>
  <?  
  $sqlasa="SELECT DISTINCT(id) as id FROM  `fabric_to_cutting`";
  if(isset($_REQUEST['filter_date'])){
  	$sqlasa.="where `date`='$date'";
  }
  elseif(isset($_REQUEST['dcno'])){
  	$sqlasa.="where `id` = '".$_REQUEST['dcno']."'";
  }
  elseif(isset($_REQUEST['style'])){
  	  	$sqlasa.="where `styleno` = '".$_REQUEST['style']."'";
  }	
  elseif(isset($_REQUEST['company'])){
  	  	$sqlasa.="where `company_name` = '".$_REQUEST['company']."'";
  }	
  else{
    	$sqlasa.="where `date`='$date'";
  }
  $sqla=mysql_query($sqlasa);
  while($sql=mysql_fetch_object($sqla)){ 
  $id=$sql->id;
  $getch=mysql_fetch_object(mysql_query("select * from `fabric_to_cutting` where `id`='$id'"));
  $dates=$getch->date;
  $to=$getch->customer_id;
  $desc=$getch->department;
  $styleno=$getch->styleno;
 // $status=$sql->admin_status;
  ?>
  <tr>
    <td height="25" align="center" valign="middle"><?=$id?></td>
    <td align="center" valign="middle"><?=date("d-m-Y",strtotime($dates));?></td>
    <td align="center" valign="middle"><? echo $to;?></td>
    <td align="center" valign="middle"><?=$styleno?></td>
    <td align="center" valign="middle">Cutting</td>
    <td align="center" valign="middle"><a href="fabric_dc_fabrics.php?id=<?php echo $id;?>&type=fabric" class="btn btn-success"><i class="icon-print"> </i> Print</a></td>
  </tr>
  <?
  }
  ?>
  </tbody>
</table>
                    
                  </div>
				</div><!--/span-->

			</div><!--/row-->		
		
<? include('include/footer.php'); ?>