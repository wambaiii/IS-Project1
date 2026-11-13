<?php
session_start();
require 'db.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row && password_verify($_POST["password"], $row["password"])) {
        $_SESSION["username"] = $username;
        $_SESSION["full_name"] = $row["full_name"];
        header("Location: welcome.php");
        exit;
    } else {
        $msg = "<div class='msg err'>Invalid username or password.</div>";
    }
}
?>
<!DOCTYPE html>
<html><head><title>Login - IS Project 1</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Login</h2>
<?= $msg ?>
<form method="POST" action="login.php">
  <label>Username</label><input type="text" name="username" required>
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Login</button>
</form>
<p>No account? <a href="signup.php">Sign up</a></p>
</div></body></html>
