
                                    <div class="table-responsive scroll-container">
                                        <div class="col-12 d-flex no-block align-items-center">
                                            <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['from']); ?>&nbsp;PROGRAM</h5>
                                        </div>
                                        <table id="example" class="table table-striped table-bordered text-center" style="overflow-x:auto;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">FABRIC NAME</th>
													 <th style="width: 3%" data-toggle="tooltip" title="Fabric Dia">Date</th>
													<th style="width: 3%">DIA</th>
													<th style="width: 3%">GSM</th>
                                                    <th style="width: 3%" data-toggle="tooltip" title="Fabric Dia">COLOR</th>
                                                    
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">WGT</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">IN STOCK</th>
                                                    <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">AL. DEL</th>
													<th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">ROLLS</th>
                                                    <th style="width: 10%">NOW DELIVERY</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if ($_REQUEST['from']=='Cutting') {
                                                    $tbl0='process_production';

//                                                     echo "SELECT distinct order_no,style_no,fabric_name,dia FROM $tbl0 where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
// exit;
                                                    $sectBrnQry = "SELECT distinct order_no,style_no,fabric_name,dia,color,wgt,delivery_wgt FROM $tbl0 where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
                                                }
                                                else{
                                                    $tbl0=$_REQUEST['from'];
                                                    $sectBrnQry = "SELECT distinct order_no,style_no,fabric_name,dia,color,wgt,delivery_wgt FROM process_production where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='$tbl0'";
                                                }
                                                $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                                                while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){

                                                 $select_dc_query = "SELECT * FROM production_dc where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' ";
                    $dc_result = mysqli_query($zconn, $select_dc_query);
												//	$dc_row = mysqli_fetch_assoc($dc_result);
													//print_r($dc_row);
													
$stock1 = 0; // Initialize $stock1 to 0

while ($dc_row = mysqli_fetch_assoc($dc_result)) {
    $stock1 += $dc_row['delivery_wgt'];
	
}
$stock2 = $coldata['delivery_wgt'] - $stock1;
													
if ($stock2 < 0) {
    $stock2 = 0;
}
													
//echo 'stock:' .$stock1; // This will display the total sum of delivery_wgt
												//	echo 'stock:' .$stock2;



                                                   // }
                                                ?>
                                        
                                                <td style="width: 4%"><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['date'];?><input type="hidden" name="date[]" value="<?php echo $coldata['date'];?>"></td>
                                                <td style="width: 4%"><?php echo $coldata['dia'];?><input type="hidden" name="dia[]" value="<?php echo $coldata['dia'];?>"></td>
												                                                <td style="width: 4%"><?php echo $coldata['gsm'];?><input type="hidden" name="gsm[]" value="<?php echo $coldata['gsm'];?>"></td>
												  <td style="width: 4%"><?php echo $coldata['color'];?><input type="hidden" name="color[]" value="<?php echo $coldata['color'];?>"></td>
                                                <!--td style="width: 8%"><?php echo $in;?></td-->

                                                    <td style="width: 8%"><?php echo $coldata['delivery_wgt'];?><input type="hidden" name="wgt[]" value="<?php echo $coldata['delivery_wgt'];?>"></td>

                                                    
												 
												<td style="width: 8%"><?php

echo $stock2;
?>

  
    <input type="hidden" name="stock[]" value="<?php echo $stock2; ?>">
</td>

												
												<td style="width: 8%"><?php 
													
													echo  $stock1;?>
													
												</td>
<td style="width: 4%"><input type="text" class="form-control "  id="roll" name="roll[]"></td>
                                                <td style="width: 4%"><input type="text" class="form-control delivery_wgt" min="0" max="<?php echo $stock2;?>" id="delivery_wgt" name="delivery_wgt[]"></td>
                                                </tr>

                                            <?php
                                                }
                                            ?>
                                                <tr>
                                                    <td colspan="9"><strong>TOTAL WEIGHT</strong></td>
                                                    <td>
                                                        <input type="text" name="total" id="total" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save1" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
</div>
                                    