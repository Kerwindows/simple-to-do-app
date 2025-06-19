<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database configuration
$host = 'localhost';
$dbname = 'kerwindows_task_manager';
$username = 'kerwindows_task_manager';
$password = '----';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Get request method and data
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

switch($method) {
    case 'GET':
        // Fetch all tasks
        try {
            $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Convert boolean values
            foreach($tasks as &$task) {
                $task['completed'] = (bool)$task['completed'];
            }
            
            echo json_encode($tasks);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch tasks']);
        }
        break;
        
    case 'POST':
        // Create new task
        if (!isset($input['text']) || empty(trim($input['text']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Task text is required']);
            exit();
        }
        
        try {
            $stmt = $pdo->prepare("INSERT INTO tasks (text, completed) VALUES (:text, 0)");
            $stmt->execute(['text' => trim($input['text'])]);
            
            $newId = $pdo->lastInsertId();
            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
            $stmt->execute(['id' => $newId]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            $task['completed'] = (bool)$task['completed'];
            
            echo json_encode($task);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create task']);
        }
        break;
        
    case 'PUT':
        // Update task
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'Task ID is required']);
            exit();
        }
        
        try {
            // Check if task exists
            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
            $stmt->execute(['id' => $id]);
            if (!$stmt->fetch()) {
                http_response_code(404);
                echo json_encode(['error' => 'Task not found']);
                exit();
            }
            
            // Update based on provided fields
            if (isset($input['text'])) {
                $stmt = $pdo->prepare("UPDATE tasks SET text = :text WHERE id = :id");
                $stmt->execute(['text' => trim($input['text']), 'id' => $id]);
            }
            
            if (isset($input['completed'])) {
                $stmt = $pdo->prepare("UPDATE tasks SET completed = :completed WHERE id = :id");
                $stmt->execute(['completed' => $input['completed'] ? 1 : 0, 'id' => $id]);
            }
            
            // Return updated task
            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            $task['completed'] = (bool)$task['completed'];
            
            echo json_encode($task);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to update task']);
        }
        break;
        
    case 'DELETE':
        // Delete task
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'Task ID is required']);
            exit();
        }
        
        try {
            $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
            $stmt->execute(['id' => $id]);
            
            if ($stmt->rowCount() === 0) {
                http_response_code(404);
                echo json_encode(['error' => 'Task not found']);
            } else {
                echo json_encode(['success' => true]);
            }
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete task']);
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
?>