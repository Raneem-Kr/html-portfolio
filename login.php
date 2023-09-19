<?php
session_start();
require_once 'setupDB.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT userid, username, password, is_admin FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      
        if (password_verify($password, $user['password'])) {
           
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['is_admin'] = $user['is_admin'];

            if ($user['is_admin'] == 1) {
              
                header("Location: Admin.html");
            } else {

                header("Location: dashboard.php");
            }
            exit;
        } else {
            
            $error_message = "Falsches Passwort.";
        }
    } else {
        
        $error_message = "Benutzer nicht gefunden.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">E-Mail:</label>
        <input type="email" name="email" required><br>

        <label for="password">Passwort:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
