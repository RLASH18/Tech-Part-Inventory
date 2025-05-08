# Tech-Part-Inventory

Tech-Part-Inventory is a web-based inventory management system designed to help users manage and track tech-related parts efficiently.

## Features
- **Inventory Management**: Add, edit, and delete inventory items.
- **Contact Page**: A form to reach out to the team.
- **About Page**: Information about the team members.
- **Responsive Design**: Optimized for desktop and mobile devices.

## Installation

### Prerequisites
- PHP (>= 7.4)
- MySQL
- A web server (XAMPP)

### Steps
1. Clone the repository (git clone https://github.com/RLASH18/Tech-Part-Inventory.git) or download the project files.
2. Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
3. Import the database:
   - Open `phpMyAdmin`.
   - Create a database named `tech_inventory`.
   - Import the SQL file inside the config folder into the `tech_inventory` database.
4. Configure the database connection:
   - Open `config/db.php`.
   - Ensure the `$servername`, `$username`, `$password`, and `$myDb` variables match your local database setup.

### Running the Project
1. Start your web server and MySQL.
2. Open your browser and navigate to `http://localhost/Tech-Part-Inventory/index`.

## Tech-Stack
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL

## Team Members
- **Ryan Lester Lacdang** - Senior Programmer
- **Zanjoe Manuel** - Head Manager
- **Kian John Morenencia** - Data Analyst
- **Jhemry Mangon** - Intern
