<?php
    session_start();
    include 'db.php';
    if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
    $msg='';
    // Create player
    if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['create_player'])) {
        $name = $mysqli->real_escape_string($_POST['name']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = 'player';
        $mysqli->query("INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$password','$role')");
        $uid = $mysqli->insert_id;
        $position = $mysqli->real_escape_string($_POST['position']);
        $age = intval($_POST['age']);
        $club = $mysqli->real_escape_string($_POST['current_club']);
        $value = floatval($_POST['market_value']);
        $agent_id = intval($_POST['agent_id']) ?: 'NULL';
        $mysqli->query("INSERT INTO players (user_id,position,age,current_club,market_value,agent_id) VALUES ($uid,'$position',$age,'$club',$value,$agent_id)");
        $msg='Player created';
    }
    // Fetch players
    $res = $mysqli->query("SELECT p.*, u.name AS user_name, a.agent_id FROM players p JOIN users u ON p.user_id=u.id LEFT JOIN agents a ON p.agent_id=a.agent_id");
    ?>
    <!doctype html>
    <html>
    <head><meta charset='utf-8'><title>Players</title></head>
    <body>
      <h2>Players</h2>
      <p><?php echo $msg; ?></p>
      <h3>Create Player</h3>
      <form method='post'>
        <label>Full name: <input type='text' name='name' required></label><br>
        <label>Email: <input type='email' name='email' required></label><br>
        <label>Password: <input type='password' name='password' required></label><br>
        <label>Position: <input type='text' name='position'></label><br>
        <label>Age: <input type='number' name='age'></label><br>
        <label>Current Club: <input type='text' name='current_club'></label><br>
        <label>Market Value: <input type='number' step='0.01' name='market_value'></label><br>
        <label>Agent ID (optional): <input type='number' name='agent_id'></label><br>
        <button type='submit' name='create_player'>Create</button>
      </form>

      <h3>All Players</h3>
      <table border='1' cellpadding='6' cellspacing='0'>
        <tr><th>ID</th><th>Name</th><th>Position</th><th>Age</th><th>Club</th><th>Value</th></tr>
        <?php while($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['player_id']; ?></td>
            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['position']); ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo htmlspecialchars($row['current_club']); ?></td>
            <td><?php echo $row['market_value']; ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
      <p><a href='dashboard.php'>Back to dashboard</a></p>
    </body>
    </html>
