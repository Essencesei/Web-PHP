<?php 
// Get the values from the request
$product_name = $_POST['product_name'];
$product_unit = $_POST['product_unit'];
$product_price = $_POST['product_price'];
$product_doe = $_POST['product_doe'];
$product_ai = $_POST['product_ai'];
$product_image = $_FILES['product_image'];

// Calculate the available inventory cost
$product_aic = $product_ai * $product_price;

// Create a directory for product images
//0777 permission
$imageDirectory = '../uploads/';
if (!is_dir($imageDirectory)) {
    mkdir($imageDirectory, 0777, true);
}

// Get the file location
$image_url = $imageDirectory . basename($product_image['name']);

// Move the uploaded file to the image directory
if (move_uploaded_file($product_image['tmp_name'], $image_url)) {
    echo "File uploaded successfully";

    // Get the URL of the uploaded file
    $image_url = 'http://localhost/Web-PHP/uploads/' . basename($product_image['name']);

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webexamdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $product_aic = $product_ai * $product_price;

    $sql = "INSERT INTO products (product_name,  product_price, product_unit, product_doe, product_ai, product_aic, product_image)
        VALUES ('$product_name', '$product_price', '$product_unit', '$product_doe', '$product_ai', '$product_aic', '$image_url')";
    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Error uploading file";
}
?>