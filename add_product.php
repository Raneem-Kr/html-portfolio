<?php
session_start();

$host = 'localhost';
$dbname = 'minishop';
$user = 'root';
$password = ''; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if (!file_exists('images')) {
        mkdir('images', 0777, true);
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];

        
        if (isset($_FILES['image'])) {
            $image = $_FILES['image'];
            $image_tmp_name = $image['tmp_name'];

            
            $image_blob = file_get_contents($image_tmp_name);

            
            $sql = "INSERT INTO products (name, price, quantity, description, image_blob) 
                    VALUES (:name, :price, :quantity, :description, :image_blob)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image_blob', $image_blob, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                echo "Artikel erfolgreich hinzugefügt.";
            } else {
                echo "Fehler beim Hinzufügen des Artikels: " . $stmt->errorInfo()[2];
            }

            $stmt->closeCursor(); 
        }
    }

    $conn = null; 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


