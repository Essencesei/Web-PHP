<?php
$host = 'localhost';
$dbname = 'webexamdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id']; // Get the ID from the URL parameter

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Access the fetched data
    if ($row) {
        echo '<td>' . $row['product_name'] . '</td>';
        echo '<td>' . $row['product_unit'] . '</td>';
        echo '<td>' . $row['product_price'] . '</td>';
        echo '<td>' . $row['product_doe'] . '</td>';
        echo '<td>' . $row['product_ai'] . '</td>';
        echo '<td>' . $row['product_aic'] . '</td>';
    } else {
        echo "No product found with ID $id";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
