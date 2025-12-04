
CREATE DATABASE IF NOT EXISTS elite_football_agent;
USE elite_football_agent;

DROP TABLE IF EXISTS club_managers;
DROP TABLE IF EXISTS clubs;
DROP TABLE IF EXISTS players;
DROP TABLE IF EXISTS agents;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin','player','agent','club_manager') DEFAULT 'player',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE agents (
    agent_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    license_number VARCHAR(50),
    years_of_experience INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE players (
    player_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    position VARCHAR(50),
    age INT,
    current_club VARCHAR(100),
    market_value DECIMAL(10,2),
    agent_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (agent_id) REFERENCES agents(agent_id) ON DELETE SET NULL
);

CREATE TABLE clubs (
    club_id INT AUTO_INCREMENT PRIMARY KEY,
    club_name VARCHAR(100),
    league VARCHAR(100)
);

CREATE TABLE club_managers (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    club_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (club_id) REFERENCES clubs(club_id) ON DELETE CASCADE
);

-- Insert sample users
INSERT INTO users (name,email,password,role)
VALUES 
('Admin One','admin1@elite.sl', '$2y$10$0RzT9Gqk3zj1oF5gVJcUqup9zqzFvQyQz1Z0YH6Zl2WjvK9y5bGmG', 'admin'),
('Agent One','agent1@elite.sl', '$2y$10$0RzT9Gqk3zj1oF5gVJcUqup9zqzFvQyQz1Z0YH6Zl2WjvK9y5bGmG', 'agent'),
('Player One','player1@elite.sl', '$2y$10$0RzT9Gqk3zj1oF5gVJcUqup9zqzFvQyQz1Z0YH6Zl2WjvK9y5bGmG', 'player'),
('Manager One','manager1@elite.sl', '$2y$10$0RzT9Gqk3zj1oF5gVJcUqup9zqzFvQyQz1Z0YH6Zl2WjvK9y5bGmG', 'club_manager');

-- Note: the password hash above is for "password123"

INSERT INTO agents (user_id, license_number, years_of_experience) VALUES (2, 'SLFA-1001', 6);
INSERT INTO clubs (club_name, league) VALUES ('East End Lions', 'Sierra Leone Premier League'), ('FC Kallon', 'Sierra Leone Premier League');
INSERT INTO players (user_id, position, age, current_club, market_value, agent_id) VALUES (3, 'Striker', 19, 'East End Lions', 50000, 1);
INSERT INTO users (name,email,password,role) VALUES ('Viewer','viewer@elite.sl','$2y$10$0RzT9Gqk3zj1oF5gVJcUqup9zqzFvQyQz1Z0YH6Zl2WjvK9y5bGmG','player');
