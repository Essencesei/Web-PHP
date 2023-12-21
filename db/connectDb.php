<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it does not exist
$database = "webexamdb";
$createDbQuery = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($createDbQuery) === TRUE) {
    // echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
mysqli_select_db($conn, $database);

// Create a table
$tableName = "products";

// Check if the table exists
$tableExistsQuery = "SHOW TABLES LIKE '$tableName'";
$tableExistsResult = $conn->query($tableExistsQuery);

if ($tableExistsResult->num_rows > 0) {
    // echo "Table already exists \n";
} else {
    $sql = "CREATE TABLE $tableName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_name VARCHAR(30) NOT NULL,
        product_unit VARCHAR(30) NOT NULL,
        product_price DECIMAL(10, 2) NOT NULL,
        product_doe DATE NOT NULL,
        product_ai INT(11) NOT NULL,
        product_aic DECIMAL(10, 2) NOT NULL,
        product_image VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully \n";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

$conn->close();

?>
