<?php
    // db.php - Database connection
    $host = 'localhost';
    $db   = 'elite_football_agent';
    $user = 'root';
    $pass = '';

    $mysqli = new mysqli($host, $user, $pass, $db);
    if ($mysqli->connect_errno) {
        die('DB connection failed: ' . $mysqli->connect_error);
    }
    ?>