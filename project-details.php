<?php
require_once('includes/db.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$project = null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $project = $result->fetch_assoc();
    } else {
        header('Location: projects.php');
        exit();
    }
} else {
    // Fallback if ID is missing (maybe it's still using the old URL style)
    // Actually, user wants it fully dynamic now.
    header('Location: projects.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SSK Associates Ltd — Architecture and project management firm in Zambia.">
    <title><?php echo htmlspecialchars($project['title']); ?> | SSK Associates Ltd</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS Animate on Scroll -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <!-- Main Styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/glassmorphism.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="page-project-details">
    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="blueprint-grid"></div>
            <div class="preloader-logo">
                <span class="logo-text">SSK</span>
                <span class="logo-sub">ASSOCIATES</span>
            </div>
            <div class="preloader-bar">
                <div class="preloader-progress"></div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="mainNav" class="main-nav glass-nav">
        <div class="nav-container">
            <a href="index.html" class="nav-logo">
                <span class="logo-mark">SSK</span>
                <span class="logo-name">ASSOCIATES</span>
            </a>
            <div class="nav-links" id="navLinks">
                <a href="index.html" class="nav-link">Home</a>
                <a href="about.html" class="nav-link">About</a>
                <a href="services.html" class="nav-link">Services</a>
                <div class="nav-item-dropdown">
                    <a href="projects.php" class="nav-link active has-dropdown">Projects</a>
                    <div class="nav-dropdown">
                        <a href="projects.php" class="dropdown-link">Portfolio Overview</a>
                        <a href="index.html#transformations" class="dropdown-link">Transformation Highlights</a>
                        <a href="index.html#transformations" class="dropdown-link">Before & After</a>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <a href="team.html" class="nav-link">Team</a>
                <a href="contact.html" class="nav-link nav-cta glass-btn">Contact Us</a>
            </div>
            <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
                <span class="toggle-line"></span>
                <span class="toggle-line"></span>
                <span class="toggle-line"></span>
            </button>
        </div>
    </nav>

    <main class="page-transition-wrapper">
    <div class="project-detail-hero">
        <img id="detailHeroImg" src="assets/images/projects/<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
        <div class="project-detail-header" data-aos="fade-up">
            <div class="section-label"><span class="label-line"></span><span class="label-text" style="color:#FFF;" id="detailCatLabel"><?php echo ucfirst($project['category']); ?> Portfolio</span></div>
            <h1 class="page-hero-title text-white" id="detailTitle"><?php echo htmlspecialchars($project['title']); ?></h1>
        </div>
    </div>
    
    <div class="container">
        <div class="project-stats-glass glass-panel" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-box">
                <span class="label">Location</span>
                <span class="value"><?php echo htmlspecialchars($project['location']); ?></span>
            </div>
            <div class="stat-box">
                <span class="label">Client</span>
                <span class="value">SSK Associates Ltd</span>
            </div>
            <div class="stat-box">
                <span class="label">Year</span>
                <span class="value"><?php echo htmlspecialchars($project['year']); ?></span>
            </div>
            <div class="stat-box">
                <span class="label">Size</span>
                <span class="value"><?php echo htmlspecialchars($project['size']); ?></span>
            </div>
            <div class="stat-box">
                <span class="label">Services</span>
                <span class="value">Architecture, Management</span>
            </div>
        </div>

        <div class="project-content-grid">
            <div class="project-text" data-aos="fade-right">
                <h2>Project Overview</h2>
                <?php echo nl2br(htmlspecialchars($project['description'])); ?>
                
                <div style="margin-top: 40px;">
                    <img id="detailSecondaryImg" src="assets/images/projects/<?php echo $project['image']; ?>" class="glass-panel" style="width:100%; border-radius:16px; padding:10px;" alt="Secondary image">
                </div>
            </div>
            
            <div class="project-sidebar" data-aos="fade-left">
                <div class="glass-panel">
                    <h3 style="font-family: var(--font-heading); color: var(--text-white); margin-bottom: 20px;">Project Details</h3>
                    <ul class="sidebar-list">
                        <li><span class="list-label">Sector</span> <span class="list-val" id="detailSector"><?php echo ucfirst($project['category']); ?></span></li>
                        <li><span class="list-label">Status</span> <span class="list-val">Completed</span></li>
                        <li><span class="list-label">Location</span> <span class="list-val"><?php echo $project['location']; ?></span></li>
                        <li><span class="list-label">Completion</span> <span class="list-val"><?php echo $project['year']; ?></span></li>
                    </ul>
                    <div style="margin-top: 30px; text-align: center;">
                        <a href="projects.php" class="btn btn-outline" style="width: 100%; justify-content:center;">Back to Portfolio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- Footer -->
    <footer id="footer" class="site-footer">
        <div class="footer-blueprint-lines"></div>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand" data-aos="fade-up">
                    <a href="index.html" class="footer-logo">
                        <span class="logo-mark">SSK</span>
                        <span class="logo-name">ASSOCIATES</span>
                    </a>
                    <p class="footer-desc">Turning ideas into practical, well-managed, and sustainable spaces that serve people and communities across Zambia.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-links-col" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="projects.php">Projects</a></li>
                        <li><a href="team.html">Our Team</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-contact-col" data-aos="fade-up" data-aos-delay="300">
                    <h4 class="footer-heading">Get In Touch</h4>
                    <div class="footer-contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lusaka, Zambia</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@sskassociates.co.zm</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+260 XXX XXX XXX</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-line"></div>
                <div class="footer-bottom-content">
                    <p>&copy; 2026 SSK Associates Ltd. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <button id="backToTop" class="back-to-top glass-btn" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/advanced.js"></script>
</body>
</html>
