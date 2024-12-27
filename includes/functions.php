<?php

function user_dept(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Department</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from user_department where status='0' order by dept_id desc");

	$dept=1;

		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['dept_id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['dept_name']."</td>
						<td id='ddesc_".$dept_id."'>".$res_dept['dept_desc']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteDept(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}


function sub_process_list(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Process Name</th>
						<th>Sub Process Name</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from sub_process where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['process_name']."</td>
						<td id='sname_".$dept_id."'>".$res_dept['sub_process_name']."</td>
						<td id='ddesc_".$dept_id."'>".$res_dept['descr']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteDept(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function process_list(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Process Name</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from process_master where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['process_name']."</td>
						<td id='ddesc_".$dept_id."'>".$res_dept['descr']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteDept(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function process_list1(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th width="3%">S.No</th>
						<th>Department Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from department_master where status='0' order by dept_id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['dept_id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['dept_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteDept(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function yarnname_list(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Yarn Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from yarn_names where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['yarn_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deleteyname(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}


function uom_list(){
global $zconn;
	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>UOM Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from uom_master where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['uom_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deleteuom(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function season_list(){
global $zconn;
	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Season Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from season_master where status='0' order by season_id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['season_id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['season_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deleteseason(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}


function sample_list(){
global $zconn;
	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Sample Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from sample_master where status='0' order by sample_id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['sample_id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['sample_name']."</td>
						<td id='ddesc_".$dept_id."'>".$res_dept['sample_descr']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deletesample(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function component_list1(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Component Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from components where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['comp_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deletecomp(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}


function counts_list(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Counts Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from counts_master where status='0' order by counts_id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['counts_id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['counts_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeletecountType(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function yarntype_list(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Yarn Type</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from yarn_types where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['yarn_type_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deleteytype(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}
function ta_manage_list(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>T & A Management Name</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';

	$select_dept = mysqli_query($zconn,"select * from ta_manage where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['ta_name']."</td>
						<td id='ddesc_".$dept_id."'>".$res_dept['ta_desc']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteDept(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function component_list(){
global $zconn;

	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>T & A Management Name</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';

	$select_dept = mysqli_query($zconn,"select * from ta_manage where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['ta_name']."</td>
						<td id='ddesc_".$dept_id."'>".$res_dept['ta_desc']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteDept(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

function fabric_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Fabric Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from fabric_master order by id desc");

	$dept=1;
	$deptname = 'fabric';
	$fdel_name = 'FabDelete';
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='dname_".$s_type_id."'>".$res_dept['fabric_name']."</td>
						<td><a href='javascript:;' onclick='edit_fabric(\"".$s_type_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

function color_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Colour Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from color_master order by id desc");

	$dept=1;
$deptname = 'color';
$fdel_name = 'colorDelete';
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='cname_".$s_type_id."'>".$res_dept['colour_name']."</td>
						<td><a href='javascript:;' onclick='edit_color(\"".$s_type_id."\");'><i class='fas fa-edit'></i></a> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

function style_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Style No</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from style_code order by id desc");

	$dept=1;
$deptname = 'style';
$fdel_name = 'styleDelete';
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='cname_".$s_type_id."'>".$res_dept['style_no']."</td>
						<td><a href='javascript:;' onclick='edit_style(\"".$s_type_id."\");'>
						<i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'>
						<i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

function nikid_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Nik Id</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from nik_id order by id desc");

	$dept=1;
$deptname = 'nikid';
$fdel_name = 'nikidDelete';
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='nikid_".$s_type_id."'>".$res_dept['nik_id']."</td>
						<td><a href='javascript:;' onclick='edit_nikid(\"".$s_type_id."\");'>
						<i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'>
						<i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

function nikno_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Nik No</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from nik_no order by id desc");

	$dept=1;
$deptname = 'nikno';
$fdel_name = 'niknoDelete';
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='nikno_".$s_type_id."'>".$res_dept['nik_no']."</td>
						<td><a href='javascript:;' onclick='edit_nikno(\"".$s_type_id."\");'>
						<i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

function dia_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>DIA Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';

		$select_dept = mysqli_query($zconn,"select * from dia_master order by id desc");
		$dept=1;
		$deptname = 'dia';
		$fdel_name = 'diaDelete';

		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='dianame_".$s_type_id."'>".$res_dept['dia_name']."</td>
						<td><a href='javascript:;' onclick='edit_dia(\"".$s_type_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

// For GSM

function gsm_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>GSM Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from gsm_master order by id desc");

	$dept=1;
$deptname = 'gsm';
$fdel_name = 'gsmDelete';

		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='gsmname_".$s_type_id."'>".$res_dept['gsm_name']."</td>
						<td><a href='javascript:;' onclick='edit_gsm(\"".$s_type_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

// Content name

function content_dept(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Content Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from content_master order by id desc");

	$dept=1;
$deptname = 'content';
$fdel_name = 'contentDelete';

		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
		$s_type_id = $res_dept['id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='conentname_".$s_type_id."'>".$res_dept['content_name']."</td>
						<td><a href='javascript:;' onclick='edit_content(\"".$s_type_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='fabricDelete(\"".$s_type_id."\",\"".$deptname."\",\"".$fdel_name."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$stype_list .="</tbody></table>";
	return $stype_list;
}

function supplier_typelist(){
	global $zconn;
	$stype_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th>S.No</th>
						<th>Supplier Type</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from supplier_types where status='0' order by supplier_type_id desc");

	$dept=1;

		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$s_type_id = $res_dept['supplier_type_id'];
		$stype_list .="<tr id='delete_".$s_type_id."' >
						<td>".$dept."</td>
						<td id='dname_".$s_type_id."'>".$res_dept['supplier_type']."</td>
						<td id='ddesc_".$s_type_id."'>".$res_dept['type_description']."</td>
						<td>".$status."<input type='hidden' id='status_".$s_type_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$s_type_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='suppDelete(\"".$s_type_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}
	$stype_list .="</tbody></table>";
	return $stype_list;
}



// For accessories
function accessories_list(){
global $zconn;
	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Accessories Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from accessories_master where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['acc_name']."</td>
						<td id='ddesc_".$dept_id."'>".$res_dept['acc_desc']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deleteaccs(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}


// For sizes
function size_list(){
global $zconn;
	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Size Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from size_master where status='0' order by size_id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['size_id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['size_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deletesizes(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}


// For colors
function color_list(){
global $zconn;
	$dept_list = '<table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
					<tr>
						<tr>
							<th>S.No</th>
							<th>Color Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
	$select_dept = mysqli_query($zconn,"select * from color_master where status='0' order by id desc");

	$dept=1;
		while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
			$status='';
			$db_status = $res_dept['status'];
			if($db_status=='0'){
				$status = 'Active';
			} else {
				$status = 'In Active';
			}

		$dept_id = $res_dept['id'];
		$dept_list .="<tr id='delete_".$dept_id."' >
						<td>".$dept."</td>
						<td id='dname_".$dept_id."'>".$res_dept['colour_name']."</td>
						<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
						<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deletecolors(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
					</tr>";
					$dept++;
	}

	$dept_list .="</tbody></table>";
	return $dept_list;
}

// For Style
function style_list(){
	global $zconn;
		$dept_list = '<table id="example" class="table table-striped table-bordered">
						<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
						<tr>
							<tr>
								<th>S.No</th>
								<th>Style No</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
		$select_dept = mysqli_query($zconn,"select * from style_code where status='0' order by id desc");
	
		$dept=1;
			while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
				$status='';
				$db_status = $res_dept['status'];
				if($db_status=='0'){
					$status = 'Active';
				} else {
					$status = 'In Active';
				}
	
			$dept_id = $res_dept['id'];
			$dept_list .="<tr id='delete_".$dept_id."' >
							<td>".$dept."</td>
							<td id='dname_".$dept_id."'>".$res_dept['style_no']."</td>
							<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
							<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							<a href='javascript:;' onclick='Deletestyle(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
						</tr>";
						$dept++;
		}
	
		$dept_list .="</tbody></table>";
		return $dept_list;
	}

	// For Nik id
function nikid_list(){
	global $zconn;
		$dept_list = '<table id="example" class="table table-striped table-bordered">
						<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
						<tr>
							<tr>
								<th>S.No</th>
								<th>Nik ID</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
		$select_dept = mysqli_query($zconn,"select * from nik_id where status='0' order by id desc");
	
		$dept=1;
			while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
				$status='';
				$db_status = $res_dept['status'];
				if($db_status=='0'){
					$status = 'Active';
				} else {
					$status = 'In Active';
				}
	
			$dept_id = $res_dept['id'];
			$dept_list .="<tr id='delete_".$dept_id."' >
							<td>".$dept."</td>
							<td id='dname_".$dept_id."'>".$res_dept['nik_id']."</td>
							<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
							<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							 <a href='javascript:;' onclick='Deletenikid(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
						</tr>";
						$dept++;
		}
	
		$dept_list .="</tbody></table>";
		return $dept_list;
	}

	// For Nik No
function nikno_list(){
	global $zconn;
		$dept_list = '<table id="example" class="table table-striped table-bordered">
						<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size:16px;">
						<tr>
							<tr>
								<th>S.No</th>
								<th>Nik No</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
		$select_dept = mysqli_query($zconn,"select * from nik_no where status='0' order by id desc");
	
		$dept=1;
			while($res_dept = mysqli_fetch_array($select_dept,MYSQLI_ASSOC)){
				$status='';
				$db_status = $res_dept['status'];
				if($db_status=='0'){
					$status = 'Active';
				} else {
					$status = 'In Active';
				}
	
			$dept_id = $res_dept['id'];
			$dept_list .="<tr id='delete_".$dept_id."' >
							<td>".$dept."</td>
							<td id='dname_".$dept_id."'>".$res_dept['nik_no']."</td>
							<td>".$status."<input type='hidden' id='status_".$dept_id."' value='".$db_status."'></td>
							<td><a href='javascript:;' onclick='edit_dept(\"".$dept_id."\");'><i class='fas fa-edit'></i></a> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='Deletenikno(\"".$dept_id."\");'><i class='fas fa-window-close'></i></a></td>
						</tr>";
						$dept++;
		}
	
		$dept_list .="</tbody></table>";
		return $dept_list;
	}



?>