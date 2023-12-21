<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Junior Software Developer Exam</title>
        <link rel="stylesheet" href="./css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script defer src="./scripts/script.js"></script>
        </head>
        <body>
            <?php include_once("./db/connectDb.php")?>
          
            <h1>Web Exam</h1>
            <p>Junior Software Developer Exam</p>
            <nav>
                <ul>
                    <li>
                        <a href="./index.php">Products</a>
                    </li>
                </ul>
            </nav>

            <main class="container">
                <section class="addProductSection">
                    <form action="./db/create.php" method="POST" class="addProductSectionForm" enctype="multipart/form-data">
                        <input type="text" name="product_name" id="" placeholder="Name">
                        <input type="text" name="product_unit" id="" placeholder="Unit">
                        <input type="number" name="product_price" id="" placeholder="Price">
                        <input type="date" name="product_doe" id="">
                        <input type="number" name="product_ai" id="" placeholder="Available Inventory">
                        <input type="file" name="product_image" id="">
                        <input type="submit" value="Add Product">
                    </form>
                </section>
            </main>

            <section class="productSection">
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
                                echo '<form enctype="multipart/form-data" action="./db/update.php?id=' . $row['id'] . '" method="POST">';
                                echo '<table>';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Product Name</th>';
                                echo '<th>Unit</th>';
                                echo '<th>Price</th>';
                                echo '<th>Date of Expiry</th>';
                                echo '<th>Available Inventory</th>';
                                echo '<th>Available Inventory Cost</th>';
                                echo '<th>Image</th>';
                                echo '<th>Action</th>'; 
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                echo '<td><input type="text" name="product_name" value="' . $row['product_name'] . '"></td>';
                                echo '<td><input type="text" name="product_unit" value="' . $row['product_unit'] . '"></td>';
                                echo '<td><input type="number" name="product_price" value="' . $row['product_price'] . '"></td>';
                                echo '<td><input type="date" name="product_doe" value="' . $row['product_doe'] . '"></td>';
                                echo '<td><input type="number" name="product_ai" value="' . $row['product_ai'] . '"></td>';
                                echo '<td>' . $row['product_aic'] . '</td>';
                                echo '<td class="imgTd"><img src="' . $row['product_image'] . '" alt="Product Image"></td>';
                                echo '<td>';
                                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                                echo '<input type="submit" value="Update">';
                                echo '</td>';
                                echo '</tbody>';
                                echo '</table>';
                                echo '</form>';
                        } else {
                                echo "No product found with ID $id";
                        }
                } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                }
                ?>
            </section>

        </body>
    </html>
