<?php
$page_title = "Manage Projects";
require_once('header.php');

$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");

$msg = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'added') $msg = 'Project added successfully!';
    if ($_GET['msg'] == 'deleted') $msg = 'Project deleted successfully!';
    if ($_GET['msg'] == 'updated') $msg = 'Project updated successfully!';
}
?>

<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="color: var(--text-white); font-family: var(--font-heading); margin: 0;">Project Inventory</h2>
        <a href="add-project.php" class="btn btn-primary glass-btn" style="padding: 10px 20px;">
            <span>Add New Project</span>
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-success"><?php echo $msg; ?></div>
    <?php endif; ?>

    <table class="project-table">
        <thead>
            <tr>
                <th width="80">Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Location</th>
                <th>Year</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($projects->num_rows > 0): ?>
                <?php while($row = $projects->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <img src="../assets/images/projects/<?php echo $row['image']; ?>" class="project-img" alt="<?php echo $row['title']; ?>">
                        </td>
                        <td>
                            <strong style="color: var(--text-white);"><?php echo $row['title']; ?></strong>
                            <div style="font-size: 11px; color: var(--text-muted); margin-top: 4px;"><?php echo substr($row['description'], 0, 50); ?>...</div>
                        </td>
                        <td><span class="label-text" style="font-size: 10px;"><?php echo ucfirst($row['category']); ?></span></td>
                        <td><i class="fas fa-map-marker-alt" style="margin-right: 5px; color: var(--accent-red);"></i> <?php echo $row['location']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td style="text-align: right;">
                            <div class="action-btns" style="justify-content: flex-end;">
                                <a href="edit-project.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="delete-project.php?id=<?php echo $row['id']; ?>" class="btn-action" title="Delete" onclick="return confirm('Are you sure you want to delete this project?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 50px; color: var(--text-muted);">
                        <i class="fas fa-folder-open" style="font-size: 48px; margin-bottom: 15px; display: block; opacity: 0.1;"></i>
                        No projects found. Add your first architectural work!
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once('footer.php'); ?>
