<?php
	include("includes/config.php");
	$del = mysqli_query($zconn,"SELECT * FROM  `backup` WHERE  `date_time` <= DATE_SUB( CURDATE() , INTERVAL 4 DAY ) ");

	while($res=mysqli_fetch_array($del,MYSQLI_ASSOC)){
		$filename = $res['backup_name'];
		unlink("backups/".$filename);
	}
?>