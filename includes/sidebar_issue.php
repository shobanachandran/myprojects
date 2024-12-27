<?php
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];

$user_type_id = $_SESSION['usrtype'];

?>
 <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
					 <?php
				$main_sql = mysqli_query($zconn,"select * from main_menu where status='0' and menu_id='0' order by menu_order");
					while($res_menu = mysqli_fetch_array($main_sql,MYSQLI_ASSOC)){

						$sub1_sql = mysqli_query($zconn,"select * from sub_menu1 where status='0' and main_id='".$res_menu['id']."' order by menu_order");
						$rows_sub1 = mysqli_num_rows($sub1_sql);
						$aclass1='';
						if($rows_sub1>0){
							$aclass1 = 'has-arrow';
						}

						?>

                        <li class="sidebar-item"> <a class="sidebar-link <?php echo $aclass1;?> waves-effect waves-dark sidebar-link" href="<?php echo $res_menu['menu_files'];?>" aria-expanded="false"><i class="<?php echo $res_menu['class_name'];?>"></i><span class="hide-menu"><?php echo $res_menu['menu_name'];?></span></a>
						<?php

						if($rows_sub1>0){
							//has-arrow waves-effect waves-dark
						?>
						<ul aria-expanded="false" class="collapse  first-level">
					<?php while($res_sub1 = mysqli_fetch_array($sub1_sql,MYSQLI_ASSOC)){ 
						$sub2_sql = mysqli_query($zconn,"select * from sub_menu2 where status='0' and main_id='".$res_menu['id']."' and sub_id='".$res_sub1['sub_id']."'");
						$rows_sub2 = mysqli_num_rows($sub2_sql);
						$aclass2='';
						if($rows_sub2>0){
							$aclass2 = 'has-arrow waves-effect waves-dark';
						}

							?>
							<li class="sidebar-item"><a href="javascript:void(0);" class="sidebar-link <?php echo $aclass2;?>"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> <?php echo $res_sub1['sub_menu'];?> </span></a>
							<?php if($rows_sub2>0){?>
							<ul aria-expanded="false" class="collapse  second-level">
							<?php while($res_sub2 = mysqli_fetch_array($sub2_sql,MYSQLI_ASSOC)){
						$sub3_sql = mysqli_query($zconn,"select * from sub_menu3 where status='0' and main_id='".$res_menu['id']."' and sub1_id='".$res_sub1['sub_id']."' and sub2_id='".$res_sub2['sub2_id']."'");
						$rows_sub3 = mysqli_num_rows($sub3_sql);
						$aclass3='';
						if($rows_sub3>0){
							$aclass3 = 'has-arrow waves-effect waves-dark';
						}

								?>
								<li class="sidebar-item"><a class="sidebar-link <?php echo $aclass3;?>" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu"><?php echo $res_sub2['sub2_menu'];?></span></a>
								<?php if($rows_sub3>0){ ?>
								<ul aria-expanded="false" class="collapse  third-level">
								<?php while($res_sub3 = mysqli_fetch_array($sub3_sql,MYSQLI_ASSOC)){ ?>

									<li class="sidebar-item"><a href="costing_entry.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> <?php echo $res_sub3['sub3_name'];?> </span></a></li>
								<?php } ?>
								</ul>
								<?php } ?>
								
								</li>
							<?php } ?>
							</ul>
							<?php } ?>
							
							</li>
							<?php } ?>
						</ul>
						<?php } ?>
						</li>
					<?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>