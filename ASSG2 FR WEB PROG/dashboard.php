<?php
    session_start();
    include 'db.php';
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php'); exit;
    }
    $name = $_SESSION['name'];
    $role = $_SESSION['role'];
    ?>
    <!doctype html>
    <html>
    <head><meta charset='utf-8'><title>Dashboard</title></head>
    <body>
      <h2>Welcome, <?php echo htmlspecialchars($name); ?> (<?php echo $role; ?>)</h2>
      <p><a href='players.php'>Players</a> | <a href='agents.php'>Agents</a> | <a href='clubs.php'>Clubs</a> | <a href='logout.php'>Logout</a></p>

      <?php if ($role === 'admin'): ?>
        <h3>Admin Panel</h3>
        <p>As an admin you can manage users and view all records.</p>
      <?php endif; ?>

    </body>
    </html>
