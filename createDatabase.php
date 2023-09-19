<?php
$host = 'localhost';
$dbname = 'minishop';
$user = 'root';
$password = ''; // Enter your MySQL user password here

try {
    $conn = new PDO("mysql:host=$host", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
    $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($sqlCreateDB);

    // Use the minishop database
    $conn->exec("USE $dbname");

    // Create the users table if it doesn't exist
    $sqlCreateUsersTable = "
        CREATE TABLE IF NOT EXISTS users (
            userid INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            comfirmpassword VARCHAR(255),
            is_admin TINYINT(1) DEFAULT 0
        )
    ";
    $conn->exec($sqlCreateUsersTable);

    // SQL-Code zum Erstellen der Tabelle "products"
$sql = "CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  quantity INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  image_blob LONGBLOB
)";
$conn->query($sql);


    // Add the admin user to the users table
    $adminEmail = 'admin@minishop.de';
    $adminPassword = password_hash('12345Aa', PASSWORD_DEFAULT); 
    $adminUsername = 'Admin'; 

    // Check if the admin user already exists in the table
    $sqlCheckAdmin = "SELECT userid FROM users WHERE email = :email";
    $stmtCheckAdmin = $conn->prepare($sqlCheckAdmin);
    $stmtCheckAdmin->bindParam(':email', $adminEmail, PDO::PARAM_STR);
    $stmtCheckAdmin->execute();
    $adminUser = $stmtCheckAdmin->fetch(PDO::FETCH_ASSOC);

    if (!$adminUser) {
        $sqlInsertAdmin = "INSERT INTO users (username, email, password, is_admin)
                           VALUES (:username, :email, :password, :is_admin)";
        $stmtInsertAdmin = $conn->prepare($sqlInsertAdmin);
        $stmtInsertAdmin->bindParam(':username', $adminUsername, PDO::PARAM_STR);
        $stmtInsertAdmin->bindParam(':email', $adminEmail, PDO::PARAM_STR);
        $stmtInsertAdmin->bindParam(':password', $adminPassword, PDO::PARAM_STR);
        $is_admin = 1; // Set is_admin to 1 for the admin user
        $stmtInsertAdmin->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);
        $stmtInsertAdmin->execute();

        echo "The 'minishop' database, 'users' table, and 'products' table have been successfully created, and the admin user has been added.";
    } else {
        echo "The 'minishop' database, 'users' table, and 'products' table already exist, and the admin user is already added.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
