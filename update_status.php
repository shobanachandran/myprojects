<?php
// Connect to your database
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Update the status in the process_production table
    $updateQuery = "UPDATE process_production SET status = 'Accept' WHERE id = '$id'";
    $updateResult = mysqli_query($zconn, $updateQuery);

    if ($updateResult) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid request';
}

// Close the database connection
mysqli_close($zconn);
?>
