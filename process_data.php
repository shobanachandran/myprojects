<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDepartment = $_POST['from'];

    switch ($selectedDepartment) {
        case 'Cutting':
            // Retrieve and process data from table1
            $query = "SELECT * FROM table1";
            // Execute the query and handle the data as needed
            break;

        case 'Department2':
            // Retrieve and process data from table2
            $query = "SELECT * FROM table2";
            // Execute the query and handle the data as needed
            break;

        // Add more cases for other departments

        default:
            // Handle the default case when "Select" is chosen
            break;
    }
}
?>
