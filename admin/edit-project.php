<?php
$page_title = "Edit Project";
include_once('header.php');

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$project = null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $project = $result->fetch_assoc();
    } else {
        header('Location: dashboard.php');
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $project) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $year = $_POST['year'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    
    // File upload (check if new file is selected)
    $image_name = $project['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = '../assets/images/projects/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_image_name = time() . '_' . uniqid() . '.' . $image_ext;
        $target_file = $upload_dir . $new_image_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Delete old image if exists
            if (file_exists($upload_dir . $project['image'])) {
                unlink($upload_dir . $project['image']);
            }
            $image_name = $new_image_name;
        } else {
            $error = "Failed to upload new image.";
        }
    }

    if (!$error) {
        $stmt = $conn->prepare("UPDATE projects SET title = ?, category = ?, location = ?, year = ?, size = ?, image = ?, description = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $title, $category, $location, $year, $size, $image_name, $description, $id);
        
        if ($stmt->execute()) {
            header('Location: dashboard.php?msg=updated');
            exit();
        } else {
            $error = "Error updating project: " . $conn->error;
        }
    }
}
?>

<div class="admin-card">
    <div style="margin-bottom: 30px;">
        <h2 style="color: var(--text-white); font-family: var(--font-heading);">Edit Project Details</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Update the existing information for this project.</p>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger" style="background: rgba(224, 33, 33, 0.1); color: var(--accent-red); border: 1px solid rgba(224, 33, 33, 0.2); margin-bottom: 20px; padding: 15px; border-radius: 8px;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="form-group-admin">
                <label for="title">Project Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
            </div>
            <div class="form-group-admin">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="residential" <?php echo $project['category'] == 'residential' ? 'selected' : ''; ?>>Residential</option>
                    <option value="commercial" <?php echo $project['category'] == 'commercial' ? 'selected' : ''; ?>>Commercial</option>
                    <option value="institutional" <?php echo $project['category'] == 'institutional' ? 'selected' : ''; ?>>Institutional</option>
                </select>
            </div>
            <div class="form-group-admin">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($project['location']); ?>" required>
            </div>
            <div class="form-group-admin">
                <label for="year">Completion Year</label>
                <input type="text" id="year" name="year" value="<?php echo htmlspecialchars($project['year']); ?>" required>
            </div>
            <div class="form-group-admin">
                <label for="size">Project Size</label>
                <input type="text" id="size" name="size" value="<?php echo htmlspecialchars($project['size']); ?>" required>
            </div>
            <div class="form-group-admin">
                <label for="image">Project Image (Leave empty to keep current)</label>
                <input type="file" id="image" name="image" accept="image/*">
                <div style="font-size: 11px; color: var(--text-muted); margin-top: 5px;">Current: <?php echo $project['image']; ?></div>
            </div>
        </div>

        <div class="form-group-admin">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" rows="10" required><?php echo htmlspecialchars($project['description']); ?></textarea>
        </div>

        <div style="display: flex; gap: 20px; margin-top: 40px;">
            <button type="submit" class="btn btn-primary glass-btn" style="padding: 14px 40px;">
                <span>Update Project</span>
                <i class="fas fa-save"></i>
            </button>
            <a href="dashboard.php" class="btn btn-outline" style="padding: 14px 30px;">Cancel</a>
        </div>
    </form>
</div>

<?php include_once('footer.php'); ?>
