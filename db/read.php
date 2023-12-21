<?php
// Database connection settings
$host = 'localhost';
$dbname = 'webexamdb';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();

    // Fetch all rows as associative arrays
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Build the HTML table as a string
    $table = '<table>';
    $table .= '<thead>';
    $table .= '<tr>';
    $table .= '<th>Product Image</th>';
    $table .= '<th>Product Name</th>';
    $table .= '<th>Product Unit</th>';
    $table .= '<th>Product Price</th>';
    $table .= '<th>Date of Expiry</th>';
    $table .= '<th>Available Inventory</th>';
    $table .= '<th>Available Inventory Cost</th>';
    $table .= '<th>Action</th>'; 
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>';

    foreach ($rows as $row) {
        $table .= '<tr>';
        $table .= '<td class="imgTd"><img src="' . $row['product_image'] . '" alt="Product Image"></td>';
        $table .= '<td>' . $row['product_name'] . '</td>';
        $table .= '<td>' . $row['product_unit'] . '</td>';
        $table .= '<td>' . $row['product_price'] . '</td>';
        $table .= '<td>' . $row['product_doe'] . '</td>';
        $table .= '<td>' . $row['product_ai'] . '</td>';
        $table .= '<td>' . $row['product_aic'] . '</td>';
        $table .= '<td>';
        $table .= '<a href="edit.php?id=' . $row['id'] . '">Edit</a>'; 
        $table .= ' | ';
        $table .= '<a href="./db/delete.php?id=' . $row['id'] . '">Delete</a>'; 
        $table .= '</td>';
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';

    // Return the HTML table
    echo $table;
    
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>