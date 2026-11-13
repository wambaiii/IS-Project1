<?php
require 'db.php';
$msg = "";
// POST: save new feedback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST["name"], $_POST["email"], $_POST["message"]);
    $msg = $stmt->execute()
        ? "<div class='msg ok'>Feedback submitted successfully.</div>"
        : "<div class='msg err'>Error: " . htmlspecialchars($stmt->error) . "</div>";
}
// GET: retrieve all feedback
$rows = $conn->query("SELECT id, name, email, message, created_at FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html><head><title>Feedback - IS Project 1</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box" style="width:600px">
<h2>Feedback Form</h2>
<?= $msg ?>
<form method="POST" action="feedback.php">
  <label>Name</label><input type="text" name="name" required>
  <label>Email</label><input type="email" name="email" required>
  <label>Message</label><textarea name="message" rows="4" required></textarea>
  <button type="submit">Submit Feedback</button>
</form>
<h3>Submitted Feedback (retrieved from CAT2.feedback)</h3>
<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>
<?php while ($r = $rows->fetch_assoc()): ?>
<tr><td><?= $r["id"] ?></td><td><?= htmlspecialchars($r["name"]) ?></td><td><?= htmlspecialchars($r["email"]) ?></td>
<td><?= htmlspecialchars($r["message"]) ?></td><td><?= $r["created_at"] ?></td></tr>
<?php endwhile; ?>
</table>
</div></body></html>
