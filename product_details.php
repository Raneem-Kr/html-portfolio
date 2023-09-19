<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
   <style>
  .product-details {
    max-width: 400px; 
    margin: 0 auto;
    padding: 15px; 
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #fff;
}

.product-details h1 {
    font-size: 22px;
    margin-bottom: 10px;
}

.product-details img {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.product-details p {
    font-size: 14px; 
    line-height: 1.5;
    margin-bottom: 15px;
}

.product-details p:last-child {
    margin-bottom: 0;
}

.product-details .price {
    font-size: 18px;
    font-weight: bold;
    color: #4CAF50;
}
</style>
</head>
<body>
    <?php
    try {
        $host = 'localhost';
        $db_name = 'minishop';
        $username = 'root';
        $password = '';

        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $sql = 'SELECT * FROM products WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $product_id);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                echo '<div class="product-details">';
                echo '<h1>' . $product['name'] . '</h1>';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($product['image_blob']) . '">';
                echo '<p>' . $product['description'] . '</p>';
                echo '<p>Price: $' . $product['price'] . '</p>';
                echo '</div>';
            } else {
                echo '<p>Product not found.</p>';
            }
        } else {
            echo '<p>Invalid product ID.</p>';
        }
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }
    ?>
    
</body>
</html>
