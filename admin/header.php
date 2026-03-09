<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
require_once('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SSK Associates</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/glassmorphism.css">
    <style>
        :root {
            --sidebar-width: 280px;
        }
        body {
            background: var(--bg-secondary);
            display: flex;
        }
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--bg-primary);
            border-right: 1px solid var(--border-color);
            position: fixed;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }
        .sidebar-logo {
            text-align: center;
            margin-bottom: 50px;
        }
        .sidebar-nav {
            list-style: none;
            padding: 0;
            flex-grow: 1;
        }
        .sidebar-nav li {
            margin-bottom: 10px;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            color: var(--text-gray);
            border-radius: 12px;
            transition: all 0.3s ease;
            font-family: var(--font-heading);
            font-size: 14px;
            font-weight: 500;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: rgba(224, 33, 33, 0.1);
            color: var(--text-white);
            transform: translateX(10px);
        }
        .sidebar-nav a.active i {
            color: var(--accent-red);
        }
        .admin-main {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 60px;
            min-height: 100vh;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
        }
        .admin-header h1 {
            font-family: var(--font-heading);
            font-size: 32px;
            font-weight: 700;
            color: var(--text-white);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-gray);
        }
        .user-info span {
            font-size: 14px;
            font-weight: 500;
        }
        .admin-card {
            background: rgba(30, 30, 34, 0.4);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-card);
        }
        .project-table {
            width: 100%;
            border-collapse: collapse;
            color: var(--text-light);
            margin-top: 30px;
        }
        .project-table th {
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid var(--border-color);
            color: var(--text-gray);
            font-family: var(--font-heading);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }
        .project-table td {
            padding: 20px 15px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }
        .project-img {
            width: 80px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }
        .action-btns {
            display: flex;
            gap: 10px;
        }
        .btn-action {
            padding: 8px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            color: var(--text-gray);
            transition: all 0.3s ease;
            cursor: pointer;
            background: transparent;
        }
        .btn-action:hover {
            border-color: var(--accent-red);
            color: var(--accent-red);
            background: rgba(224, 33, 33, 0.05);
        }
        .btn-action.btn-edit:hover {
            border-color: var(--accent-cyan);
            color: var(--accent-cyan);
            background: rgba(0, 209, 209, 0.05);
        }
        .form-group-admin {
            margin-bottom: 25px;
        }
        .form-group-admin label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-gray);
            font-family: var(--font-heading);
            font-size: 13px;
            font-weight: 500;
        }
        .form-group-admin input, .form-group-admin select, .form-group-admin textarea {
            width: 100%;
            padding: 12px 18px;
            background: rgba(22, 22, 26, 0.5);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-white);
            font-family: var(--font-body);
            transition: border-color 0.3s ease;
        }
        .form-group-admin input:focus, .form-group-admin select:focus, .form-group-admin textarea:focus {
            outline: none;
            border-color: var(--accent-red);
        }
        .alert {
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .alert-success {
            background: rgba(0, 209, 209, 0.1);
            color: var(--accent-cyan);
            border: 1px solid rgba(0, 209, 209, 0.2);
        }
    </style>
</head>
<body>
    <aside class="admin-sidebar">
        <div class="sidebar-logo">
            <a href="dashboard.php" class="nav-logo">
                <span class="logo-mark">SSK</span>
            </a>
            <div style="font-size: 10px; letter-spacing: 2px; color: var(--accent-cyan); margin-top: 5px;">ASSOCIATES</div>
        </div>
        <ul class="sidebar-nav">
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"><i class="fas fa-th-large"></i> Projects</a></li>
            <li><a href="add-project.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'add-project.php' ? 'active' : ''; ?>"><i class="fas fa-plus-circle"></i> Add Project</a></li>
            <li><a href="../projects.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="logout.php" class="nav-link" style="color: var(--accent-red); font-weight: 600;"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            <div>
                <div class="section-label"><span class="label-line"></span><span class="label-text">Admin Panel</span></div>
                <h1><?php echo isset($page_title) ? $page_title : 'Dashboard'; ?></h1>
            </div>
            <div class="user-info">
                <span>Welcome, <strong><?php echo $_SESSION['admin_username']; ?></strong></span>
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--accent-red); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                    <?php echo strtoupper(substr($_SESSION['admin_username'], 0, 1)); ?>
                </div>
            </div>
        </header>
