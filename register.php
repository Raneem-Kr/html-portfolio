<?php
session_start();
require_once 'setupDB.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

   
    $email = trim($email);

    if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
        $error_message = "Bitte füllen Sie alle Felder aus.";
    
    } else {
      
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
          
            $error_message = "Die E-Mail-Adresse ist bereits registriert.";
        } else {
      
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

            if ($stmt->execute()) {
               
                header("Location: Anmeldung.html");
                exit;
            } else {
                
                $error_message = "Fehler bei der Registrierung.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Registration form</title>
    <link rel="stylesheet" href="register.css" />
    
  </head>
  <body>
    <div class="container">
      <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post"
        id="registration"
        name="registration"
        onsubmit="return validate()"
        onreset="resetForm()"
      >
        <fieldset>
          <legend>
            <b><font size="5">Registration</font></b>
          </legend>
          <?php if ($error_message !== '') { ?>
            <p style="color: red;" id="error_message"><?php echo $error_message; ?></p>
          <?php } ?>
          <p>
            <label for="Name">Username:</label>
            <input
              type="text"
              name="username"
              id="username"
              value=""
              placeholder="Enter your name"
              autofocus
            />
          </p>
          <p>
            <label for="email">Email:</label>
            <input
              type="email"
              name="email"
              id="email"
              value=""
              placeholder="Enter your email"
            />
          </p>
          <p>
            <label for="pwdUser">Password:</label>
            <input
              type="password"
              name="password"
              id="pwdUser"
              value=""
              placeholder="Enter your password"
            />
            <span id="passwordHint" style="color: black"
              >Password should contain at least seven characters, including one
              lowercase letter, one uppercase letter, and one digit.</span
            >
          </p>
          <p>
            <label for="cpwdUser">Confirm Password:</label>
            <input
              type="password"
              name="confirmpassword"
              id="cpwdUser"
              value=""
              placeholder="Re-enter your password"
            />
          </p>
          <button class="register" name="register" type="submit">
            REGISTER
          </button>
          <button type="reset" class="reset">RESET</button>
        </fieldset>
      </form>
    </div>
  </body>
</html>
