<?php
// Include your database connection code here
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $yarnId = $_POST['yarnId'];
    $newInwardWgt = $_POST['inward_wgt'];

    // Use prepared statements for security
    $stmt = $mysqli->prepare("UPDATE yarn_inward SET inward_wgt = ? WHERE id = ?");
    $stmt->bind_param("di", $newInwardWgt, $yarnId);

    if ($stmt->execute()) {
        echo 'Success'; // Return a success message
    } else {
        echo 'Error'; // Return an error message
    }

    $stmt->close();
    $mysqli->close();
}
?>
