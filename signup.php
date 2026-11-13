<?php
require 'db.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = trim($_POST["username"]);
    $full_name = trim($_POST["full_name"]);
    $email     = trim($_POST["email"]);
    $password  = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, full_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $full_name, $email, $password);
    if ($stmt->execute()) {
        $msg = "<div class='msg ok'>Account for <b>" . htmlspecialchars($username) . "</b> created. <a href='login.php'>Login</a></div>";
    } else {
        $msg = "<div class='msg err'>Error: " . htmlspecialchars($stmt->error) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html><head><title>Sign Up - IS Project 1</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Create an Account</h2>
<?= $msg ?>
<form method="POST" action="signup.php">
  <label>Username</label><input type="text" name="username" required>
  <label>Full Name</label><input type="text" name="full_name" required>
  <label>Email</label><input type="email" name="email" required>
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Sign Up</button>
</form>
<p>Already registered? <a href="login.php">Login here</a></p>
</div></body></html>
