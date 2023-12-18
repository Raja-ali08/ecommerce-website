<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Products - WinterZilla</title>
    <!-- Include your CSS and other head elements -->
</head>
<body>

<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'winterzilla';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete button is clicked
if (isset($_POST['delete']) && isset($_POST['product_id'])) {
    $deleteProductId = $_POST['product_id'];

    // Perform the delete operation in the database
    $deleteQuery = "DELETE FROM product WHERE id = $deleteProductId";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$selectQuery = "SELECT * FROM product";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    // Display product details in a table
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Name</th><th>Price</th><th>Code</th><th>In Stock</th><th>Discount</th><th>Size</th><th>Details</th><th>Picture</th><th>Action</th></tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
        echo '<td>' . $row['code'] . '</td>';
        echo '<td>' . ($row['in_stock'] ? 'Yes' : 'No') . '</td>';
        echo '<td>' . $row['discount'] . '</td>';
        echo '<td>' . $row['size'] . '</td>';
        echo '<td>' . $row['details'] . '</td>';
        echo '<td><img src="' . $row['picture'] . '" alt="Product Image" width="50"></td>';
        echo '<td><form method="post" action=""><input type="hidden" name="product_id" value="' . $row['id'] . '"><button type="submit" name="delete">Delete</button></form></td>';
        echo '</tr>';
    }
    

    echo '</table>';
} else {
    echo 'No products found.';
}

$conn->close();
?>

</body>
</html>
