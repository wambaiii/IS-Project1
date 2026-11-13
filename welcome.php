<?php
session_start();
if (!isset($_SESSION["username"])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html><head><title>Welcome</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Login successful</h2>
<div class="msg ok">Welcome, <b><?= htmlspecialchars($_SESSION["full_name"]) ?></b> (<?= htmlspecialchars($_SESSION["username"]) ?>)</div>
<p><a href="feedback.php">Go to Feedback form</a> | <a href="logout.php">Logout</a></p>
</div></body></html>
