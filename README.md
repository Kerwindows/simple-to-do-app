Kerwindows Task Manager
A simple web-based task management application built with PHP, MySQL, and JavaScript, designed to run on an Apache server. Users can create, edit, delete, and mark tasks as completed, with a clean interface and dark/light mode support.
Features

Add new tasks with text descriptions
Edit existing tasks
Delete tasks
Mark tasks as completed
Toggle between dark and light modes
Responsive design for desktop and mobile
Error handling for invalid inputs
Persistent storage using MySQL

Prerequisites

Apache web server
PHP 8.2 or higher
MySQL 8.0 or higher
phpMyAdmin (optional, for easier database management)

Installation

Clone or Download the Repository

Copy the project files to your Apache server's document root (e.g., /var/www/html/kerwindows_task_manager).


Set Up the Database

Create a MySQL database named kerwindows_task_manager.
Import the provided kerwindows_task_manager.sql file to set up the tasks table:mysql -u your_username -p kerwindows_task_manager < kerwindows_task_manager.sql


Ensure the MySQL user has appropriate permissions for the database.


Configure Database Connection

Open api.php and update the database configuration with your MySQL credentials:$host = 'localhost';
$dbname = 'kerwindows_task_manager';
$username = 'your_mysql_username';
$password = 'your_mysql_password';




Set Up Apache

Ensure Apache is configured to serve PHP files.
Place the project files in the Apache document root or a subdirectory.
Verify that the .htaccess file (if used) allows CORS or adjust api.php headers as needed.


File Structure

index.html: Frontend interface (contains embedded JavaScript and HTML).
api.php: Backend API for CRUD operations.
kerwindows_task_manager.sql: Database schema and setup.


Permissions

Ensure the Apache user (e.g., www-data) has read permissions for all project files.
Set write permissions if additional file operations are added.


Access the Application

Navigate to http://your-server/kerwindows_task_manager/index.html in a web browser.



Usage

Add a Task: Enter text in the input field and click "Add" or press Enter.
Edit a Task: Click "Edit" on a task, modify the text, and click "Save" or "Cancel".
Delete a Task: Click "Delete" to remove a task.
Complete a Task: Click the checkbox next to a task to mark it as completed.
Toggle Theme: Click the sun/moon icon in the header to switch between dark and light modes.

API Endpoints
The backend (api.php) provides the following RESTful endpoints:

GET /api.php: Fetch all tasks.
POST /api.php: Create a new task (JSON: { "text": "task description" }).
PUT /api.php?id={id}: Update a task (JSON: { "text": "updated text", "completed": true/false }).
DELETE /api.php?id={id}: Delete a task.

Notes

The frontend uses vanilla JavaScript with no external dependencies.
The application assumes a MySQL database with UTF-8 encoding.
CORS is enabled in api.php for local development; adjust headers for production.
The tasks table includes indexes for completed and created_at for better query performance.

Troubleshooting

Database Connection Errors: Verify MySQL credentials in api.php and ensure the database server is running.
CORS Issues: Check browser console for errors and adjust Access-Control-Allow-Origin in api.php.
Tasks Not Loading: Ensure api.php is accessible and the database is properly set up.
PHP Errors: Check Apache error logs (e.g., /var/log/apache2/error.log).

License
This project is for personal use and not licensed for distribution.
Contact
For issues or questions, please contact the project maintainer.
