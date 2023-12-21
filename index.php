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

      <main class="container">
        <h1>Web Exam</h1>
        <p>Junior Software Developer Exam</p>
        <nav>
          <ul>
            <li>
              <a href="./index.php">Products</a>
            </li>
          </ul>
        </nav>
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
         <?php include_once("./db/read.php"); ?>
      </section>

      

     
      
    </body>
  </html>
