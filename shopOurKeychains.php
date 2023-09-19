<!DOCTYPE html>
<html>
<head>
    <title>Resin Keychains | Store</title>
    <meta name="description" content="This is the description">
    <script src="https://kit.fontawesome.com/218d8f84d4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="shopOurKeychains.css" />
    <script src="store.js"></script>
</head>
<body>
  
    <section class="container content-section">
    
        <div class="shop-items">
            <?php
            try {
                $host = 'localhost';
                $db_name = 'minishop';
                $username = 'root';
                $password = '';

                $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT * FROM products';
                $stmt = $conn->query($sql);
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);  

                if (count($products) > 0) {
                                 foreach ($products as $product) {
    echo '<div class="shop-item">';
    echo '<span class="shop-item-title">' . $product['name'] . '</span>';
    echo '<img class="shop-item-image" src="data:image/jpeg;base64,' . base64_encode($product['image_blob']) . '">';
   echo '<span class="shop-item-price">$' . number_format($product['price'], 2, '.', ',') . '</span>';

    echo '<div class="shop-item-description">' . $product['description'] . '</div>';
    echo '<a href="product_details.php?id=' . $product['id'] . '" class="btn btn-secondary">VIEW DETAILS</a>';

    echo '<button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>';
    echo '</div>';
}
                } else {
                    echo '<p>No products found.</p>';
                }
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
            ?>
        </div>
    </section>
<section class="container content-section" id="cart">
        <h2 class="section-header">CART</h2>
        <div class="cart-row">
            <span class="cart-item cart-header cart-column">ITEM</span>
            <span class="cart-price cart-header cart-column">PRICE</span>
            <span class="cart-quantity cart-header cart-column">QUANTITY</span>
        </div>
        <div class="cart-items">
        </div>
        <div class="cart-total">
            <strong class="cart-total-title">Total</strong>
            <span class="cart-total-price">$0</span>
        </div>
        <button class="btn btn-primary btn-purchase" type="button">PURCHASE</button>
    </section>
    
</body>
</html>
