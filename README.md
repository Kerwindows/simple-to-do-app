# Task Manager

A simple, responsive task management application built with PHP, MySQL, and Vue.js. Features a clean interface with dark/light theme support and full CRUD operations for managing your daily tasks.

## Features

- ✅ Add, edit, delete, and toggle task completion
- 🌙 Dark/Light theme toggle with persistent preferences
- 📱 Fully responsive design for mobile and desktop
- 🔄 Real-time updates with RESTful API
- 💾 Persistent data storage with MySQL
- 🎨 Modern, clean UI with smooth animations

## Screenshots

The application features a clean, modern interface with:
- Task input form at the top
- List of tasks with checkboxes for completion
- Edit and delete buttons for each task
- Theme toggle in the header
- Responsive design that works on all devices

## Requirements

- **Web Server**: Apache (with mod_rewrite enabled)
- **PHP**: Version 7.4 or higher
- **MySQL**: Version 5.7 or higher
- **Extensions**: PDO MySQL extension enabled

## Installation

### 1. Clone or Download
Download the project files to your web server directory (e.g., `/var/www/html/task-manager/` or `htdocs/task-manager/`).

### 2. Database Setup
1. Create a MySQL database named `kerwindows_task_manager`
2. Create a MySQL user with appropriate permissions
3. Import the database schema:
   ```bash
   mysql -u your_username -p kerwindows_task_manager < kerwindows_task_manager.sql
   ```

### 3. Configure Database Connection
Edit the `api.php` file and update the database credentials:

```php
// Database configuration
$host = 'localhost';                    // Your MySQL host
$dbname = 'kerwindows_task_manager';    // Database name
$username = 'your_username';            // Your MySQL username
$password = 'your_password';            // Your MySQL password
```

### 4. File Permissions
Ensure your web server has read/write permissions to the project directory:
```bash
chmod 755 /path/to/task-manager/
chmod 644 /path/to/task-manager/*.php
chmod 644 /path/to/task-manager/*.html
```

### 5. Access the Application
Open your web browser and navigate to:
```
http://your-domain.com/task-manager/
```
or
```
http://localhost/task-manager/
```

## File Structure

```
task-manager/
├── index.html                 # Frontend application (Vue.js)
├── api.php                   # Backend API (PHP)
├── kerwindows_task_manager.sql # Database schema
└── README.md                 # This file
```

## API Endpoints

The application uses a RESTful API with the following endpoints:

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/api.php` | Retrieve all tasks |
| POST   | `/api.php` | Create a new task |
| PUT    | `/api.php?id={id}` | Update an existing task |
| DELETE | `/api.php?id={id}` | Delete a task |

### API Examples

**Create a task:**
```bash
curl -X POST http://your-domain.com/task-manager/api.php \
  -H "Content-Type: application/json" \
  -d '{"text":"Buy groceries"}'
```

**Toggle task completion:**
```bash
curl -X PUT http://your-domain.com/task-manager/api.php?id=1 \
  -H "Content-Type: application/json" \
  -d '{"completed":true}'
```

**Delete a task:**
```bash
curl -X DELETE http://your-domain.com/task-manager/api.php?id=1
```

## Database Schema

The application uses a single `tasks` table with the following structure:

| Column | Type | Description |
|--------|------|-------------|
| id | INT (Primary Key) | Auto-incrementing task ID |
| text | VARCHAR(255) | Task description |
| completed | TINYINT(1) | Completion status (0 or 1) |
| created_at | TIMESTAMP | Creation timestamp |
| updated_at | TIMESTAMP | Last update timestamp |

## Frontend Features

- **Vue.js 3**: Modern reactive framework
- **Axios**: HTTP client for API requests
- **CSS Variables**: Theme switching support
- **Responsive Design**: Mobile-first approach
- **Local Storage**: Theme preference persistence

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Troubleshooting

### Common Issues

**1. Database Connection Failed**
- Verify database credentials in `api.php`
- Ensure MySQL service is running
- Check if the database and user exist

**2. CORS Errors**
- The API includes CORS headers for cross-origin requests
- If issues persist, check your server's CORS configuration

**3. Tasks Not Loading**
- Check browser console for JavaScript errors
- Verify the API endpoint URL in `index.html`
- Ensure PHP and MySQL are properly configured

**4. Theme Not Persisting**
- Check if localStorage is enabled in your browser
- Clear browser cache and cookies

### Debug Mode

To enable error reporting, add this to the top of `api.php`:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## Security Considerations

- The application includes basic input validation and prepared statements
- For production use, consider adding:
  - User authentication
  - Rate limiting
  - Input sanitization enhancements
  - HTTPS enforcement
  - Database user with minimal privileges

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source. Feel free to use, modify, and distribute as needed.

## Support

For issues or questions:
1. Check the troubleshooting section above
2. Review server error logs
3. Check browser console for client-side errors

---

**Enjoy managing your tasks! 📝✅**