<?php
session_start();
require_once 'setupDB.php'; 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
   
    header("Location: login.php");
    exit;
}


$userid = $_SESSION['userid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === '1') {
    
        $sql = "DELETE FROM users WHERE userid = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION = array();

        // Destroy the session
        session_destroy();

        
        header("Location: login.php?deleted=true");
        exit;
    } else {
        
        header("Location: homepage.html");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delete Account</title>
</head>
<body>
    <h1>Delete Account</h1>
    <p>Are you sure you want to delete your account? This action is permanent and cannot be undone.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="confirm_delete" value="1">
        <button type="submit">Delete Account</button>
        <a href="homepage.html">Cancel</a>
    </form>
</body>
</html>
