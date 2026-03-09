<?php
require_once('includes/db.php');
$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SSK Associates Ltd — Architecture and project management firm in Zambia.">
    <title>SSK Associates Ltd | Portfolio</title>

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
<body class="page-projects">
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


    <div class="page-hero">
        <div class="page-hero-bg" style="background-image: url('assets/images/projects/residential.png')"></div>
        <div class="page-hero-content" data-aos="fade-up">
            <div class="section-label justify-center"><span class="label-line"></span><span class="label-text">Our Portfolio</span><span class="label-line"></span></div>
            <h1 class="page-hero-title">Featured <span class="text-accent">Projects</span></h1>
            <p class="page-hero-subtitle">A curated selection of defining architectural works.</p>
        </div>
    </div>
    
    <section class="projects-section" style="padding-top: 50px;">
        <div class="container">
            <div class="project-filters glass-panel" style="padding: 15px; border-radius: 50px; display: inline-flex; margin-bottom: 50px; left: 50%; transform: translateX(-50%); position: relative;" data-aos="fade-up">
                <button class="filter-btn active" data-filter="all" style="border:none;">All</button>
                <button class="filter-btn" data-filter="residential" style="border:none;">Residential</button>
                <button class="filter-btn" data-filter="commercial" style="border:none;">Commercial</button>
                <button class="filter-btn" data-filter="institutional" style="border:none;">Institutional</button>
            </div>

            <div class="portfolio-grid" id="projectsGrid">
                <?php if ($projects->num_rows > 0): ?>
                    <?php while($row = $projects->fetch_assoc()): ?>
                        <div class="pro-project-card" data-category="<?php echo $row['category']; ?>" onclick="location.href='project-details.php?id=<?php echo $row['id']; ?>'" data-aos="fade-up">
                            <div class="img-wrapper">
                                <img src="assets/images/projects/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                            </div>
                            <div class="pro-project-info glass-panel">
                                <span class="category"><?php echo ucfirst($row['category']); ?></span>
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <div class="pro-project-meta">
                                    <span class="meta-item"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></span>
                                    <span class="meta-item"><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($row['year']); ?></span>
                                </div>
                                <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
                        <h3 style="color: var(--text-gray);">No projects found.</h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Transformation Highlights Section -->
    <section class="transformation-section" style="padding: 100px 0; background: var(--bg-secondary);">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-label"><span class="label-line"></span><span class="label-text">Case Comparisons</span></div>
                <h2 class="section-title">Site <span class="text-accent">Transformations</span></h2>
                <p class="section-subtitle">Browse recent architectural milestones and their lifecycle from blueprint to reality.</p>
            </div>
            <div class="transformation-grid stagger-children" data-aos="fade-up">
                <!-- Meridian Business Tower -->
                <div class="transformation-item glass-panel" onclick="viewTransformation('Meridian Tower', 'assets/images/projects/commercial.png', 'assets/images/projects/urban.png')">
                    <img src="assets/images/projects/commercial.png" alt="Meridian Tower Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Luxury Villa Complex -->
                <div class="transformation-item glass-panel" onclick="viewTransformation('Luxury Villa', 'assets/images/projects/residential.png', 'assets/images/projects/sustainable.png')">
                    <img src="assets/images/projects/residential.png" alt="Villa Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Public Infrastructure -->
                <div class="transformation-item glass-panel" onclick="viewTransformation('City Gateway', 'assets/images/projects/urban.png', 'assets/images/projects/institutional.png')">
                    <img src="assets/images/projects/urban.png" alt="Infrastructure Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Educational Campus -->
                <div class="transformation-item glass-panel" onclick="viewTransformation('National Campus', 'assets/images/projects/institutional.png', 'assets/images/projects/commercial.png')">
                    <img src="assets/images/projects/institutional.png" alt="Educational Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
            </div>
        </div>
    </section>
    

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

                <div class="footer-links-col" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="footer-heading">Services</h4>
                    <ul class="footer-links">
                        <li><a href="services.html">Architectural Design</a></li>
                        <li><a href="services.html">Project Management</a></li>
                        <li><a href="services.html">Urban Planning</a></li>
                        <li><a href="services.html">Construction Supervision</a></li>
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
                    <div class="footer-tags">
                        <span>#SSKAssociates</span>
                        <span>#ArchitectureZambia</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Glass Modal for Quick View -->
    <div id="projectModal" class="glass-modal">
        <div class="glass-modal-content">
            <button class="glass-modal-close"><i class="fas fa-times"></i></button>
            <div class="glass-modal-body" id="modalBody"></div>
        </div>
    </div>

    <!-- Transformation (Before/After) Modal -->
    <div id="baModal" class="glass-modal">
        <div class="glass-modal-content ba-modal-content">
            <button class="glass-modal-close"><i class="fas fa-times"></i></button>
            <div class="glass-modal-body ba-modal-body" id="baModalBody"></div>
        </div>
    </div>

    <button id="backToTop" class="back-to-top glass-btn" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/advanced.js"></script>
</body>
</html>
