<?php
$host = 'localhost';
$dbname = 'webexamdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $product_name = $_POST['product_name'];
        $product_unit = $_POST['product_unit'];
        $product_price = $_POST['product_price'];
        $product_doe = $_POST['product_doe'];
        $product_ai = $_POST['product_ai'];

        $product_aic = $product_ai * $product_price;

        $stmt = $pdo->prepare("UPDATE products SET product_name = :product_name, product_unit = :product_unit, product_price = :product_price, product_doe = :product_doe, product_ai = :product_ai, product_aic = :product_aic WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_unit', $product_unit);
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':product_doe', $product_doe);
        $stmt->bindParam(':product_ai', $product_ai);
        $stmt->bindParam(':product_aic', $product_aic);
        $stmt->execute();

        header("Location: /webexam/index.php");
        exit();
        
    } else {
        echo "Invalid request method!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
