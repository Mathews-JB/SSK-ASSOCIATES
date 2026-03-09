<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
require_once('../includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get image filename to delete from system
    $stmt = $conn->prepare("SELECT image FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $project = $result->fetch_assoc();
        $image_path = '../assets/images/projects/' . $project['image'];
        
        // Delete record
        $delete_stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        $delete_stmt->bind_param("i", $id);
        
        if ($delete_stmt->execute()) {
            // Delete image file if exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            header('Location: dashboard.php?msg=deleted');
            exit();
        } else {
            echo "Error deleting project: " . $conn->error;
        }
    } else {
        header('Location: dashboard.php');
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>
