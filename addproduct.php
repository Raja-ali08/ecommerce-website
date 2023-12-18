<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product - WinterZilla</title>
    
</head>
<body>

<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $productId = $_POST["product_id"];
    $productName = $_POST["product_name"];
    $productPrice = $_POST["product_price"];
    $productCode = $_POST["product_code"];
    $inStock = isset($_POST["in_stock"]) ? 1 : 0;
    $productDiscount = $_POST["product_discount"];
    $productSize = $_POST["product_size"];
    $productDetails = $_POST["product_details"];

    
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["product_picture"]["name"]);
    move_uploaded_file($_FILES["product_picture"]["tmp_name"], $targetFile);

    
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "winterzilla";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO product (id, name, price, code, in_stock, discount, size, details, picture) 
            VALUES ('$productId', '$productName', '$productPrice', '$productCode', '$inStock', 
                    '$productDiscount', '$productSize', '$productDetails', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!-- Form to add a new product -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="product_id">Product ID:</label>
    <input type="text" name="product_id" required>

    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" required>

    <label for="product_price">Product Price:</label>
    <input type="number" step="0.01" name="product_price" required>

    <label for="product_code">Product Code:</label>
    <input type="text" name="product_code" required>

    <label for="in_stock">In Stock:</label>
    <input type="checkbox" name="in_stock">

    <label for="product_discount">Product Discount:</label>
    <input type="number" step="0.01" name="product_discount">

    <label for="product_size">Product Size:</label>
    <input type="text" name="product_size">

    <label for="product_details">Product Details:</label>
    <textarea name="product_details" rows="4" required></textarea>

    <label for="product_picture">Product Picture:</label>
    <input type="file" name="product_picture" accept="image/*" required>

    <button type="submit">Add Product</button>
</form>

</body>
</html>
