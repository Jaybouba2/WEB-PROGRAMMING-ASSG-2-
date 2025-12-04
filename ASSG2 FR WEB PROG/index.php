<?php
    session_start();
    include 'db.php';
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $res = $mysqli->query("SELECT * FROM users WHERE email='$email'");
        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        } else {
            $error = 'Invalid credentials';
        }
    }
    ?>
    <!doctype html>
    <html>
    <head><meta charset='utf-8'><title>EliteAgent - Login</title></head>
    <body>
      <h2>Elite Football Agent - Login</h2>
      <?php if($error): ?><p style='color:red;'><?php echo $error;?></p><?php endif; ?>
      <form method='post'>
        <label>Email: <input type='email' name='email' required></label><br><br>
        <label>Password: <input type='password' name='password' required></label><br><br>
        <button type='submit'>Login</button>
      </form>
      <p><a href='register.php'>Register</a></p>
    </body>
    </html>
