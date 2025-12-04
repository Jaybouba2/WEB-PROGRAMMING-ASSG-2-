<?php
    session_start();
    include 'db.php';
    if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
    $msg='';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['create_agent'])) {
        $name = $mysqli->real_escape_string($_POST['name']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = 'agent';
        $mysqli->query("INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$password','$role')");
        $uid = $mysqli->insert_id;
        $license = $mysqli->real_escape_string($_POST['license']);
        $years = intval($_POST['years']);
        $mysqli->query("INSERT INTO agents (user_id,license_number,years_of_experience) VALUES ($uid,'$license',$years)");
        $msg='Agent created';
    }
    $res = $mysqli->query("SELECT a.*, u.name AS user_name, u.email FROM agents a JOIN users u ON a.user_id=u.id");
    ?>
    <!doctype html>
    <html>
    <head><meta charset='utf-8'><title>Agents</title></head>
    <body>
      <h2>Agents</h2>
      <p><?php echo $msg; ?></p>
      <h3>Create Agent</h3>
      <form method='post'>
        <label>Name: <input type='text' name='name' required></label><br>
        <label>Email: <input type='email' name='email' required></label><br>
        <label>Password: <input type='password' name='password' required></label><br>
        <label>License #: <input type='text' name='license'></label><br>
        <label>Years experience: <input type='number' name='years'></label><br>
        <button type='submit' name='create_agent'>Create</button>
      </form>

      <h3>All Agents</h3>
      <table border='1' cellpadding='6' cellspacing='0'>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>License</th><th>Years</th></tr>
        <?php while($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['agent_id']; ?></td>
            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['license_number']); ?></td>
            <td><?php echo $row['years_of_experience']; ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
      <p><a href='dashboard.php'>Back to dashboard</a></p>
    </body>
    </html>
