<?php
$page_title = "Add New Project";
include_once('header.php');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $year = $_POST['year'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    
    // File upload
    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = '../assets/images/projects/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '_' . uniqid() . '.' . $image_ext;
        $target_file = $upload_dir . $image_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Success
        } else {
            $error = "Failed to upload image.";
        }
    } else {
        $error = "Please upload a project image.";
    }

    if (!$error) {
        $stmt = $conn->prepare("INSERT INTO projects (title, category, location, year, size, image, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $title, $category, $location, $year, $size, $image_name, $description);
        
        if ($stmt->execute()) {
            header('Location: dashboard.php?msg=added');
            exit();
        } else {
            $error = "Error adding project to database: " . $conn->error;
        }
    }
}
?>

<div class="admin-card">
    <div style="margin-bottom: 30px;">
        <h2 style="color: var(--text-white); font-family: var(--font-heading);">Project Details</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Fill in the information below to showcase your architectural vision.</p>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger" style="background: rgba(224, 33, 33, 0.1); color: var(--accent-red); border: 1px solid rgba(224, 33, 33, 0.2); margin-bottom: 20px; padding: 15px; border-radius: 8px;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="form-group-admin">
                <label for="title">Project Title <span style="color: var(--accent-red);">*</span></label>
                <input type="text" id="title" name="title" placeholder="e.g. Meridian Business Tower" required>
            </div>
            <div class="form-group-admin">
                <label for="category">Category <span style="color: var(--accent-red);">*</span></label>
                <select id="category" name="category" required>
                    <option value="residential">Residential</option>
                    <option value="commercial">Commercial</option>
                    <option value="institutional">Institutional</option>
                </select>
            </div>
            <div class="form-group-admin">
                <label for="location">Location <span style="color: var(--accent-red);">*</span></label>
                <input type="text" id="location" name="location" placeholder="e.g. Lusaka, Zambia" required>
            </div>
            <div class="form-group-admin">
                <label for="year">Completion Year <span style="color: var(--accent-red);">*</span></label>
                <input type="text" id="year" name="year" placeholder="e.g. 2024" required>
            </div>
            <div class="form-group-admin">
                <label for="size">Project Size <span style="color: var(--accent-red);">*</span></label>
                <input type="text" id="size" name="size" placeholder="e.g. 24,000 sqm" required>
            </div>
            <div class="form-group-admin">
                <label for="image">Project Image <span style="color: var(--accent-red);">*</span></label>
                <input type="file" id="image" name="image" accept="image/*" required>
                <div style="font-size: 11px; color: var(--text-muted); margin-top: 5px;">Suggested size: 1200x800px, PNG or JPG</div>
            </div>
        </div>

        <div class="form-group-admin">
            <label for="description">Full Description <span style="color: var(--accent-red);">*</span></label>
            <textarea id="description" name="description" rows="10" placeholder="Detail the construction materials, architectural design, and project goals..." required></textarea>
        </div>

        <div style="display: flex; gap: 20px; margin-top: 40px;">
            <button type="submit" class="btn btn-primary glass-btn" style="padding: 14px 40px;">
                <span>Upload Project</span>
                <i class="fas fa-cloud-upload-alt"></i>
            </button>
            <a href="dashboard.php" class="btn btn-outline" style="padding: 14px 30px;">Cancel</a>
        </div>
    </form>
</div>

<?php include_once('footer.php'); ?>
