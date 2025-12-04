<?php
    session_start();
    include 'db.php';
    if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
    $msg='';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['create_club'])) {
        $name = $mysqli->real_escape_string($_POST['club_name']);
        $league = $mysqli->real_escape_string($_POST['league']);
        $mysqli->query("INSERT INTO clubs (club_name,league) VALUES ('$name','$league')");
        $msg='Club created';
    }
    $res = $mysqli->query("SELECT * FROM clubs");
    ?>
    <!doctype html>
    <html>
    <head><meta charset='utf-8'><title>Clubs</title></head>
    <body>
      <h2>Clubs</h2>
      <p><?php echo $msg; ?></p>
      <h3>Create Club</h3>
      <form method='post'>
        <label>Club name: <input type='text' name='club_name' required></label><br>
        <label>League: <input type='text' name='league'></label><br>
        <button type='submit' name='create_club'>Create</button>
      </form>

      <h3>All Clubs</h3>
      <table border='1' cellpadding='6' cellspacing='0'>
        <tr><th>ID</th><th>Club Name</th><th>League</th></tr>
        <?php while($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['club_id']; ?></td>
            <td><?php echo htmlspecialchars($row['club_name']); ?></td>
            <td><?php echo htmlspecialchars($row['league']); ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
      <p><a href='dashboard.php'>Back to dashboard</a></p>
    </body>
    </html>
