<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ssk_associates';

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($database);
} else {
    die("Error creating database: " . $conn->error);
}

// Admin table
$sql_admins = "CREATE TABLE IF NOT EXISTS admins (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Projects table
$sql_projects = "CREATE TABLE IF NOT EXISTS projects (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    location VARCHAR(255) NOT NULL,
    year VARCHAR(10) NOT NULL,
    size VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($sql_admins) || !$conn->query($sql_projects)) {
    die("Error creating tables: " . $conn->error);
}

// Check if projects table is empty
$result_projects = $conn->query("SELECT * FROM projects");
if ($result_projects->num_rows == 0) {
    $initial_projects = [
        ['Luxury Villa Complex', 'residential', 'Lusaka', '2024', '4,500 sqm', 'residential.png', 'This luxury villa complex represents a paradigm shift in residential design within Zambia. The architectural vision was to create a highly efficient, sustainable, and visually striking structure.'],
        ['Meridian Business Tower', 'commercial', 'Lusaka', '2025', '24,000 sqm', 'commercial.png', 'A state-of-the-art office complex designed for the modern professional. Featuring a high-performance facade and passive solar shading.'],
        ['National Learning Center', 'institutional', 'Ndola', '2023', '12,000 sqm', 'institutional.png', 'An educational infrastructure project focusing on community growth and modern learning environments.'],
        ['City Gateway Development', 'commercial', 'Kitwe', '2026', '35,000 sqm', 'urban.png', 'A large-scale urban development project integrating commercial spaces with public infrastructure.'],
        ['Green Horizons Estate', 'residential', 'Livingstone', '2024', '8,000 sqm', 'sustainable.png', 'Sustainable residential estate utilizing solar energy and water conservation systems.']
    ];
    
    $stmt = $conn->prepare("INSERT INTO projects (title, category, location, year, size, image, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($initial_projects as $p) {
        $stmt->bind_param("sssssss", $p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $p[6]);
        $stmt->execute();
    }
}
// Check if any admin exists, if not, create a default one (admin / admin123)
$result_admin = $conn->query("SELECT * FROM admins");
if ($result_admin->num_rows == 0) {
    $default_user = 'admin';
    $default_pass = password_hash('admin123', PASSWORD_BCRYPT);
    $conn->query("INSERT INTO admins (username, password) VALUES ('$default_user', '$default_pass')");
}
?>
