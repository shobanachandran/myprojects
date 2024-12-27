<?php
error_reporting(0); 
include("../includes/config.php");
extract($_REQUEST);
if (isset($_GET['emp_id'])) {
     
   $query = "SELECT * FROM employees WHERE emp_name LIKE '{$_GET['emp_id']}%' LIMIT 25";
    $result = mysqli_query($zconn, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $res[] = $user['emp_name'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>