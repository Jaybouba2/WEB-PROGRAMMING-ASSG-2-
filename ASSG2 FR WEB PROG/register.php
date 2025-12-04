<?php
    session_start();
    include 'db.php';
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $mysqli->real_escape_string($_POST['name']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $mysqli->real_escape_string($_POST['role']);
        $stmt = $mysqli->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
        $stmt->bind_param('ssss', $name, $email, $password, $role);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit;
        } else {
            $error = 'Registration failed: ' . $mysqli->error;
        }
    }
    ?>
    <!doctype html>
    <html>
    <head><meta charset='utf-8'><title>EliteAgent - Register</title></head>
    <body>
      <h2>Register</h2>
      <?php if($error): ?><p style='color:red;'><?php echo $error;?></p><?php endif; ?>
      <form method='post'>
        <label>Name: <input type='text' name='name' required></label><br><br>
        <label>Email: <input type='email' name='email' required></label><br><br>
        <label>Password: <input type='password' name='password' required></label><br><br>
        <label>Role:
          <select name='role'>
            <option value='player'>Player</option>
            <option value='agent'>Agent</option>
            <option value='club_manager'>Club Manager</option>
          </select>
        </label><br><br>
        <button type='submit'>Create Account</button>
      </form>
      <p><a href='index.php'>Back to login</a></p>
    </body>
    </html>
