<?php
require_once('includes/db.php');
$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SSK Associates Ltd — Architecture and project management firm in Zambia.">
    <title>SSK Associates Ltd | Home</title>

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
<body class="page-home">
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
            <a href="index.php" class="nav-logo">
                <span class="logo-mark">SSK</span>
                <span class="logo-name">ASSOCIATES</span>
            </a>
            <div class="nav-links" id="navLinks">
                <a href="index.php" class="nav-link active">Home</a>
                <a href="about.html" class="nav-link">About</a>
                <a href="services.html" class="nav-link">Services</a>
                <div class="nav-item-dropdown">
                    <a href="projects.php" class="nav-link has-dropdown">Projects</a>
                    <div class="nav-dropdown">
                        <a href="projects.php" class="dropdown-link">Portfolio Overview</a>
                        <a href="#transformations" class="dropdown-link">Transformation Highlights</a>
                    </div>
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
    <section id="hero" class="hero-section">
        <div class="hero-blueprint-canvas" id="blueprintCanvas"></div>
        <div class="hero-overlay"></div>
        <div class="hero-particles" id="heroParticles"></div>
        <div class="hero-image-bg" style="background-image: url('assets/images/hero-building.png')"></div>

        <div class="hero-content">
            <div class="hero-badge" data-aos="fade-down" data-aos-delay="300">
                <span class="badge-line"></span><span class="badge-text">Architecture & Project Management</span><span class="badge-line"></span>
            </div>
            <h1 class="hero-title" data-aos="fade-up" data-aos-delay="500">
                <span class="title-line">Designing The</span>
                <span class="title-line title-accent">Future of <span class="text-gradient">Zambia</span></span>
            </h1>
            <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="700">Transforming ideas into iconic, sustainable spaces through innovative architecture and precision project management.</p>
            <div class="hero-actions" data-aos="fade-up" data-aos-delay="900">
                <a href="projects.php" class="btn btn-primary glass-btn"><span>Explore Projects</span><i class="fas fa-arrow-right"></i></a>
                <a href="about.html" class="btn btn-outline glass-panel"><span>Our Story</span></a>
            </div>
        </div>
        <div class="hero-scroll-indicator scroll-indicator-animate">
            <span class="scroll-text">Scroll to explore</span><div class="scroll-line"><div class="scroll-dot"></div></div>
        </div>
    </section>

    <section class="services-section" style="padding: 100px 0;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-label"><span class="label-line"></span><span class="label-text">What We Do</span></div>
                <h2 class="section-title">Our <span class="text-accent">Services</span></h2>
            </div>
            <div class="services-grid">
                <div class="service-card glass-card hover-lift" onclick="location.href='services.html'" style="cursor: pointer;">
                    <div class="service-number">01</div><div class="service-icon"><i class="fas fa-building"></i></div>
                    <h3 class="service-title">Architectural Design</h3><p class="service-desc">Innovative, functional, and aesthetically compelling designs responding to context.</p><div class="service-line"></div>
                </div>
                <div class="service-card glass-card hover-lift" onclick="location.href='services.html'" style="cursor: pointer;">
                    <div class="service-number">02</div><div class="service-icon"><i class="fas fa-tasks"></i></div>
                    <h3 class="service-title">Project Management</h3><p class="service-desc">End-to-end delivery with disciplined planning and transparent communication.</p><div class="service-line"></div>
                </div>
                <div class="service-card glass-card hover-lift" onclick="location.href='services.html'" style="cursor: pointer;">
                    <div class="service-number">03</div><div class="service-icon"><i class="fas fa-city"></i></div>
                    <h3 class="service-title">Urban Planning</h3><p class="service-desc">Strategic urban design balancing growth, sustainability, and community.</p><div class="service-line"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Selected Works (Dynamic) -->
    <section class="projects-section" style="background:#16161A;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-label"><span class="label-line"></span><span class="label-text">Portfolio Highlight</span></div>
                <h2 class="section-title">Selected <span class="text-accent">Works</span></h2>
            </div>
            <div class="portfolio-grid">
                <?php if ($projects->num_rows > 0): ?>
                    <?php while($row = $projects->fetch_assoc()): ?>
                        <div class="pro-project-card" onclick="location.href='project-details.php?id=<?php echo $row['id']; ?>'" data-aos="fade-up">
                            <div class="img-wrapper"><img src="assets/images/projects/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>"></div>
                            <div class="pro-project-info glass-panel" style="border-radius: 0 0 12px 12px; border:none; border-top: 1px solid rgba(255,255,255,0.1);">
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
                <?php endif; ?>
            </div>
            <div style="text-align: center; margin-top: 50px;" data-aos="fade-up">
                <a href="projects.php" class="btn btn-primary glass-btn">Explore Full Portfolio</a>
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
                    <a href="index.php" class="footer-logo">
                        <span class="logo-mark">SSK</span>
                        <span class="logo-name">ASSOCIATES</span>
                    </a>
                    <p class="footer-desc">Turning ideas into practical, well-managed, and sustainable spaces that serve people and communities across Zambia.</p>
                </div>
                <div class="footer-links-col" data-aos="fade-up">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="projects.php">Projects</a></li>
                        <li><a href="team.html">Our Team</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 SSK Associates Ltd. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/advanced.js"></script>
</body>
</html>
