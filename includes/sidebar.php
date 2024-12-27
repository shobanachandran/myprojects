<?php
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = explode('/', $currentFile);
$currentFile = $parts[count($parts)-1];

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
						
						 $menu_files_arr = explode(',',$res_menu['menu_files']);

						$sub1_sql = mysqli_query($zconn,"select * from sub_menu1 where status='0' and main_id='".$res_menu['id']."' order by menu_order");
						$rows_sub1 = mysqli_num_rows($sub1_sql);
						$aclass1='';
						if($rows_sub1>0){
							$aclass1 = 'has-arrow';
						}

						// Check Permission
						$user_rights = mysqli_query($zconn,"select * from menu_rights where user_type_id='".$user_type_id."' and main_menu='".$res_menu['id']."' and sub_menu='0'");
						$res_rights  = mysqli_fetch_array($user_rights,MYSQLI_ASSOC);
						$view_rights = $res_rights['view_option'];

						if($view_rights=='1'){
							$active_main='';
							if (in_array($currentFile, $menu_files_arr)){
								$active_main='active';
							} else {
								$active_main='';
							}
						?>
						<li class="sidebar-item"><a class="sidebar-link <?php echo $aclass1;?> waves-effect waves-dark <?php echo $active_main;?>" href="<?php echo $res_menu['menu_url'];?>" aria-expanded="false"><i class="<?php echo $res_menu['class_name'];?>"></i><span class="hide-menu"><?php echo $res_menu['menu_name'];?></span></a>

							
						<?php
						if($rows_sub1>0){
							//has-arrow waves-effect waves-dark
							$sub1_chk = mysqli_query($zconn,"select * from sub_menu1 where status='0' and main_id='".$res_menu['id']."' order by menu_order");
							$res_sub2 = mysqli_fetch_array($sub1_chk,MYSQLI_ASSOC);
							 $sub1_files_arr = explode(',',$res_sub2['sub_files']);
							
							$active_sub1='';
							if (in_array($currentFile, $sub1_files_arr)){
								$active_sub1='in';
							} else {
								$active_sub1='';
							}
						?>
						<ul aria-expanded="false" class="collapse  first-level <?php echo $active_sub1;?>">
						<?php while($res_sub1 = mysqli_fetch_array($sub1_sql,MYSQLI_ASSOC)){ 
						$sub2_sql = mysqli_query($zconn,"select * from sub_menu2 where status='0' and main_id='".$res_menu['id']."' and sub_id='".$res_sub1['sub_id']."'");
						$rows_sub2 = mysqli_num_rows($sub2_sql);
						$aclass2='';
						if($rows_sub2>0){
							$aclass2 = 'has-arrow waves-effect waves-dark';
						}
					//Check sub menu permission
						$user_rights_sub = mysqli_query($zconn,"select * from menu_rights where user_type_id='".$user_type_id."' and main_menu='".$res_menu['id']."' and sub_menu='".$res_sub1['sub_id']."'");
        	    $res_rights_sub = mysqli_fetch_array($user_rights_sub,MYSQLI_ASSOC);
        	    $view_rights_sub = $res_rights_sub['view_option'];
					if($view_rights_sub=='1'){ ?>

				<li class="sidebar-item"><a href="<?php echo $res_sub1['sub_url'];?>" class="sidebar-link <?php echo $aclass2;?>"><i class="mdi mdi-note-plus"></i><span class="hide-menu"><?php echo $res_sub1['sub_menu'];?></span></a>
				<?php if($rows_sub2>0){?>
				<ul aria-expanded="false" class="collapse  second-level">
				<?php
		while($res_sub2 = mysqli_fetch_array($sub2_sql,MYSQLI_ASSOC)){
			$sub3_sql = mysqli_query($zconn,"select * from sub_menu3 where status='0' and main_id='".$res_menu['id']."' and sub1_id='".$res_sub1['sub_id']."' and sub2_id='".$res_sub2['sub2_id']."'");
			$rows_sub3 = mysqli_num_rows($sub3_sql);
			$aclass3='';
			if($rows_sub3>0){
				$aclass3 = 'has-arrow waves-effect waves-dark';
			}

			?>
					<li class="sidebar-item"><a class="sidebar-link <?php echo $aclass3;?>" href="<?php echo $res_sub2['sub2_url'];?>" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu"><?php echo $res_sub2['sub2_menu'];?></span></a>
					<?php if($rows_sub3>0){ ?>
					<ul aria-expanded="false" class="collapse  third-level">
					<?php while($res_sub3 = mysqli_fetch_array($sub3_sql,MYSQLI_ASSOC)){ ?>

						<li class="sidebar-item"><a href="<?php echo $res_sub3['sub3_url'];?>" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> <?php echo $res_sub3['sub3_name'];?> </span></a></li>
					<?php } ?>
					</ul>
					<?php } ?>
					</li>
				<?php } ?>
				</ul>
				<?php } ?>

				</li>
							<?php } ?>
							<?php } ?>
							</ul>
						<?php } ?>
						</li>
						<?php } // End of checking permission?>
					<?php } ?>
					</ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>