<?php
// Connect to your database
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

// Retrieve the selected option value from the AJAX request
$selectedOption = $_POST['option'];

// Prepare and execute the SQL query to retrieve option values by ID from the database
$sql = "SELECT * FROM suppliers WHERE supplier_name = '$selectedOption' ";

// $result = $conn->query($sql);
$result = mysqli_query($zconn, $sql);

// Determine which div to show based on the SQL query result

while($row = mysqli_fetch_array($result)) {
  
    
      $optionValue = $row['state_id'];
     
   
if ($result->num_rows > 0) {
  
   
  if ($optionValue === '21') {
    $response = 'div1';
  } else 
    $response = 'div2';
  } 
}

// Close the database connection
$zconn->close();

// Return the response
echo $response;
?>
