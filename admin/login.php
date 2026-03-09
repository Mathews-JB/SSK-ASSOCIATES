<?php
session_start();
require_once('../includes/db.php');

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: dashboard.php');
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SSK Associates</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/glassmorphism.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-secondary);
            overflow: hidden;
        }
        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 50px;
            border-radius: 20px;
            background: rgba(30, 30, 34, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-card);
            text-align: center;
        }
        .login-logo {
            margin-bottom: 30px;
        }
        .login-logo .logo-mark {
            font-size: 32px;
            letter-spacing: 6px;
            color: var(--text-white);
            font-weight: 800;
        }
        .login-logo .logo-name {
            font-size: 10px;
            letter-spacing: 4px;
            color: var(--accent-cyan);
            text-transform: uppercase;
        }
        .form-group {
            position: relative;
            margin-bottom: 30px;
            text-align: left;
        }
        .form-group input {
            width: 100%;
            padding: 15px 0;
            background: transparent;
            border: none;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-white);
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            outline: none;
            border-bottom-color: var(--accent-red);
        }
        .form-group label {
            position: absolute;
            top: 15px;
            left: 0;
            color: var(--text-muted);
            pointer-events: none;
            transition: 0.3s ease all;
        }
        .form-group input:focus ~ label,
        .form-group input:not(:placeholder-shown) ~ label {
            top: -10px;
            font-size: 12px;
            color: var(--accent-red);
        }
        .error-msg {
            color: var(--accent-red);
            margin-bottom: 20px;
            font-size: 14px;
        }
        .btn-login {
            width: 100%;
            justify-content: center;
            margin-top: 10px;
        }
        .login-footer {
            margin-top: 30px;
            color: var(--text-muted);
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="login-card glass-panel">
        <div class="login-logo">
            <div class="logo-mark">SSK</div>
            <div class="logo-name">ASSOCIATES</div>
        </div>
        <h2 style="color: var(--text-white); margin-bottom: 30px; font-family: var(--font-heading);">Admin Portal</h2>
        
        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder=" " required>
                <label for="username">Username</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary glass-btn btn-login">
                <span>Sign In</span>
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </form>

        <div class="login-footer">
            &copy; 2026 SSK Associates Ltd.
        </div>
    </div>
</body>
</html>
