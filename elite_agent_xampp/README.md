
# Elite Football Agent - XAMPP Project
## Description
A minimal XAMPP-ready PHP project for the **Elite Football Agent Sierra Leone** assignment.
It includes:
- MySQL database script (`init.sql`)
- Simple authentication (register / login)
- Basic CRUD pages for Users and Players
- Database connection file (`db.php`)

## How to use
1. Install XAMPP and start Apache & MySQL.
2. Copy the folder `elite_agent_xampp` into `C:\xampp\htdocs\` (Windows) or `/opt/lampp/htdocs/` (Linux).
3. Open `http://localhost/phpmyadmin` and create a new database named `elite_football_agent`.
4. Import `init.sql` (located in the project root) into the `elite_football_agent` database.
5. Open `http://localhost/elite_agent_xampp` in your browser.

## Default accounts created by init.sql
- admin1@elite.sl / password123 (role: admin)
- agent1@elite.sl / password123 (role: agent)
- player1@elite.sl / password123 (role: player)
- manager1@elite.sl / password123 (role: club_manager)

## Notes
- This project is a simple starter template. Do not use in production without adding proper security checks.
- Passwords are hashed with PHP's password_hash.
