<?php
session_start();
require_once 'setupDB.php'; 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}


$username = $_SESSION['username'];
$sql = "SELECT email FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$email = $user['email'];


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}


if (isset($_POST['delete_account'])) {
    $sql = "DELETE FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <style>
        body {
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); 
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .user-info {
            text-align: center;
        }
        .user-info h2 {
            margin-top: 0;
        }
        .user-info p {
            margin-bottom: 0;
        }
        .shop-link {
            text-align: center;
        }
        .shop-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
        }
        .logout-delete {
            text-align: center;
            margin-top: 30px;
        }
        .logout-delete input {
            padding: 10px 20px;
            background-color: #ff4444;
            color: #fff;
            border: none;
            cursor: pointer;
            margin: 10px;
        }
        .logout-delete input:hover {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome in Dashboard, <?php echo $username; ?>!</h1>
       <div class="user-info">
    <h2>User informations:</h2>
    <p>Username: <?php echo $username; ?></p>
    <p>E-Mail: <?php echo $email; ?></p>
    <a href="editProfile.php">Edit Data</a>
</div>
        <div class="shop-link">
            <a href="shopOurKeychains.php">Check Our Keychains!</a>
        </div>
        <div class="logout-delete">
            <form method="post">
                <input type="submit" name="logout" value="Logout">
                <input type="submit" name="delete_account" value="Account löschen">
            </form>
        </div>
    </div>
</body>
</html>
