<?php
// Script to generate multi-page static HTML files for SSK Associates with specific content

function getHeader($pageId, $pageTitle) {
    $navLinks = [
        ['id' => 'index', 'url' => 'index.html', 'text' => 'Home'],
        ['id' => 'about', 'url' => 'about.html', 'text' => 'About'],
        ['id' => 'services', 'url' => 'services.html', 'text' => 'Services'],
        ['id' => 'projects', 'url' => 'projects.html', 'text' => 'Projects'],
        ['id' => 'team', 'url' => 'team.html', 'text' => 'Team']
    ];

    $navHtml = '';
    foreach ($navLinks as $link) {
        $activeClass = ($pageId === $link['id']) ? ' active' : '';
        $navHtml .= '<a href="' . $link['url'] . '" class="nav-link' . $activeClass . '">' . $link['text'] . '</a>' . "\n                ";
    }

    return '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SSK Associates Ltd — Architecture and project management firm in Zambia.">
    <title>SSK Associates Ltd | ' . $pageTitle . '</title>

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
<body class="page-' . $pageId . '">
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
                ' . trim($navHtml) . '
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
';
}

function getFooter() {
    return '
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
                        <li><a href="projects.html">Projects</a></li>
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
</html>';
}

$pagesContent = [
    'index' => '
    <section id="hero" class="hero-section">
        <div class="hero-blueprint-canvas" id="blueprintCanvas"></div>
        <div class="hero-overlay"></div>
        <div class="hero-particles" id="heroParticles"></div>
        <div class="hero-image-bg" style="background-image: url(\'assets/images/hero-building.png\')"></div>

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
                <a href="projects.html" class="btn btn-primary glass-btn"><span>Explore Projects</span><i class="fas fa-arrow-right"></i></a>
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
                <div class="service-card glass-card hover-lift" onclick="location.href=\'services.html\'" style="cursor: pointer;">
                    <div class="service-number">01</div><div class="service-icon"><i class="fas fa-building"></i></div>
                    <h3 class="service-title">Architectural Design</h3><p class="service-desc">Innovative, functional, and aesthetically compelling designs responding to context.</p><div class="service-line"></div>
                </div>
                <div class="service-card glass-card hover-lift" onclick="location.href=\'services.html\'" style="cursor: pointer;">
                    <div class="service-number">02</div><div class="service-icon"><i class="fas fa-tasks"></i></div>
                    <h3 class="service-title">Project Management</h3><p class="service-desc">End-to-end delivery with disciplined planning and transparent communication.</p><div class="service-line"></div>
                </div>
                <div class="service-card glass-card hover-lift" onclick="location.href=\'services.html\'" style="cursor: pointer;">
                    <div class="service-number">03</div><div class="service-icon"><i class="fas fa-city"></i></div>
                    <h3 class="service-title">Urban Planning</h3><p class="service-desc">Strategic urban design balancing growth, sustainability, and community.</p><div class="service-line"></div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 50px;" data-aos="fade-up">
                <a href="services.html" class="btn btn-outline">View All Services</a>
            </div>
        </div>
    </section>

    <!-- Transformation Highlights Section -->
    <section class="transformation-section" style="padding: 100px 0; background: var(--bg-secondary);">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-label"><span class="label-line"></span><span class="label-text">Visual Showcase</span></div>
                <h2 class="section-title">Transformation <span class="text-accent">Highlights</span></h2>
            </div>
            <div class="transformation-grid stagger-children" data-aos="fade-up">
                <!-- Meridian Business Tower -->
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'Meridian Tower\', \'assets/images/projects/commercial.png\', \'assets/images/projects/urban.png\')">
                    <img src="assets/images/projects/commercial.png" alt="Meridian Tower Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Luxury Villa Complex -->
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'Luxury Villa\', \'assets/images/projects/residential.png\', \'assets/images/projects/sustainable.png\')">
                    <img src="assets/images/projects/residential.png" alt="Villa Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Public Infrastructure -->
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'City Gateway\', \'assets/images/projects/urban.png\', \'assets/images/projects/institutional.png\')">
                    <img src="assets/images/projects/urban.png" alt="Infrastructure Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Educational Campus -->
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'National Campus\', \'assets/images/projects/institutional.png\', \'assets/images/projects/commercial.png\')">
                    <img src="assets/images/projects/institutional.png" alt="Educational Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Highlight Preview -->
    <section class="projects-section" style="background:#16161A;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-label"><span class="label-line"></span><span class="label-text">Portfolio Highlight</span></div>
                <h2 class="section-title">Selected <span class="text-accent">Works</span></h2>
            </div>
            <div class="portfolio-grid">
                <div class="pro-project-card" onclick="location.href=\'project-details.html?img=commercial.png&title=Meridian+Business+Tower&cat=Commercial\'" data-aos="fade-up" data-aos-delay="100">
                    <div class="img-wrapper"><img src="assets/images/projects/commercial.png" alt="Meridian Business Tower"></div>
                    <div class="pro-project-info glass-panel" style="border-radius: 0 0 12px 12px; border:none; border-top: 1px solid rgba(255,255,255,0.1);">
                        <span class="category">Commercial</span>
                        <h3>Meridian Business Tower</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Lusaka, Zambia</span>
                            <span class="meta-item"><i class="fas fa-ruler-combined"></i> 24,000 sqm</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <div class="pro-project-card" onclick="location.href=\'project-details.html?img=residential.png&title=Luxury+Villa+Complex&cat=Residential\'" data-aos="fade-up" data-aos-delay="200">
                    <div class="img-wrapper"><img src="assets/images/projects/residential.png" alt="Luxury Villa Complex"></div>
                    <div class="pro-project-info glass-panel" style="border-radius: 0 0 12px 12px; border:none; border-top: 1px solid rgba(255,255,255,0.1);">
                        <span class="category">Residential</span>
                        <h3>Luxury Villa Complex</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Lusaka, Zambia</span>
                            <span class="meta-item"><i class="fas fa-ruler-combined"></i> 4,500 sqm</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <div class="pro-project-card" onclick="location.href=\'project-details.html?img=institutional.png&title=National+Learning+Center&cat=Institutional\'" data-aos="fade-up" data-aos-delay="300">
                    <div class="img-wrapper"><img src="assets/images/projects/institutional.png" alt="National Learning Center"></div>
                    <div class="pro-project-info glass-panel" style="border-radius: 0 0 12px 12px; border:none; border-top: 1px solid rgba(255,255,255,0.1);">
                        <span class="category">Institutional</span>
                        <h3>National Learning Language Center</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Ndola, Zambia</span>
                            <span class="meta-item"><i class="fas fa-ruler-combined"></i> 12,000 sqm</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 50px;" data-aos="fade-up">
                <a href="projects.html" class="btn btn-primary glass-btn">Explore Full Portfolio</a>
            </div>
        </div>
    </section>
    ',

    'about' => '
    <div class="page-hero">
        <div class="page-hero-bg" style="background-image: url(\'assets/images/projects/urban.png\')"></div>
        <div class="page-hero-content" data-aos="fade-up">
            <div class="section-label justify-center"><span class="label-line"></span><span class="label-text">Our Story</span><span class="label-line"></span></div>
            <h1 class="page-hero-title">About <span class="text-accent">SSK Associates</span></h1>
            <p class="page-hero-subtitle">Building meaningful spaces with discipline, transparency, and innovation.</p>
        </div>
    </div>
    
    <section class="about-section glass-panel" style="margin: 0 5%; border-radius: 24px; position:relative; top: -50px; z-index: 10;">
        <div class="container">
            <div class="about-grid">
                <div class="about-content" data-aos="fade-right">
                    <h2 class="section-title">Driven by <span class="text-accent">Vision</span></h2>
                    <p class="about-lead">Every project begins with an idea — a need, a vision, a possibility.</p>
                    <p class="about-text">SSK Associates was created to help turn those ideas into practical, well-managed, and sustainable spaces that serve people and communities across Zambia.</p>
                    <p class="about-text">We are passionate about thoughtful design, disciplined project delivery, and doing things the right way.</p>
                    <div class="about-features stagger-children" style="flex-wrap: wrap;">
                        <div class="feature-item glass-card" style="padding: 15px 25px;"><div class="feature-icon"><i class="fas fa-drafting-compass"></i></div><span>Innovative Design</span></div>
                        <div class="feature-item glass-card" style="padding: 15px 25px;"><div class="feature-icon"><i class="fas fa-leaf"></i></div><span>Sustainable Approach</span></div>
                    </div>
                </div>
                <div class="about-visual" data-aos="fade-left">
                    <div class="about-image-wrapper glass-panel" style="padding: 15px;">
                        <img src="assets/images/hero-building.png" alt="Architecture" class="about-image" style="height: 450px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    ',

    'services' => '
    <div class="page-hero">
        <div class="page-hero-bg" style="background-image: url(\'assets/images/projects/commercial.png\')"></div>
        <div class="page-hero-content" data-aos="fade-up">
            <div class="section-label justify-center"><span class="label-line"></span><span class="label-text">Expertise</span><span class="label-line"></span></div>
            <h1 class="page-hero-title">Core <span class="text-accent">Services</span></h1>
            <p class="page-hero-subtitle">Comprehensive solutions tailored to Zambia\'s growing landscape.</p>
        </div>
    </div>
    
    <section class="services-section" style="padding-top: 50px;">
        <div class="container">
            <div class="section-header" data-aos="fade-up" style="max-width:800px; margin: 0 auto 50px; text-align:center;">
                <p class="section-subtitle" style="font-size: 18px; color:var(--text-gray);">Discover comprehensive solutions tailored to Zambia\'s growing landscape, engineered with precision and world-class vision.</p>
            </div>

            <div class="magic-services-grid">
            
                <div class="magic-service-card hover-lift" data-aos="fade-up">
                    <div class="service-image" style="background-image: url(\'assets/images/projects/residential.png\');"></div>
                    <div class="service-content glass-panel">
                        <div class="service-icon"><i class="fas fa-building text-accent"></i></div>
                        <h3>Architectural Design</h3>
                        <p>Creating innovative, functional designs that respond to context, climate, and community needs.</p>
                        <ul class="service-list">
                            <li><i class="fas fa-check text-accent"></i> Concept & Visualizations</li>
                            <li><i class="fas fa-check text-accent"></i> Space Planning</li>
                            <li><i class="fas fa-check text-accent"></i> 3D Modeling</li>
                            <li><i class="fas fa-check text-accent"></i> Construction Drawings</li>
                        </ul>
                    </div>
                </div>

                <div class="magic-service-card hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-image" style="background-image: url(\'assets/images/projects/commercial.png\');"></div>
                    <div class="service-content glass-panel">
                        <div class="service-icon"><i class="fas fa-hard-hat text-accent"></i></div>
                        <h3>Project Management</h3>
                        <p>End-to-end project delivery with disciplined planning, ensuring budgets and timelines are met.</p>
                        <ul class="service-list">
                            <li><i class="fas fa-check text-accent"></i> Feasibility Analysis</li>
                            <li><i class="fas fa-check text-accent"></i> Time & Cost Control</li>
                            <li><i class="fas fa-check text-accent"></i> Quality Assurance</li>
                            <li><i class="fas fa-check text-accent"></i> Procurement Strategy</li>
                        </ul>
                    </div>
                </div>
                
                <div class="magic-service-card hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-image" style="background-image: url(\'assets/images/projects/sustainable.png\');"></div>
                    <div class="service-content glass-panel">
                        <div class="service-icon"><i class="fas fa-seedling text-accent"></i></div>
                        <h3>Sustainable Design</h3>
                        <p>Integrating eco-friendly materials and energy efficiency for a positive environmental legacy.</p>
                        <ul class="service-list">
                            <li><i class="fas fa-check text-accent"></i> Energy Performance</li>
                            <li><i class="fas fa-check text-accent"></i> Green Material Selection</li>
                            <li><i class="fas fa-check text-accent"></i> Passive Cooling</li>
                            <li><i class="fas fa-check text-accent"></i> Water Conservation</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    ',

    'projects' => '
    <div class="page-hero">
        <div class="page-hero-bg" style="background-image: url(\'assets/images/projects/residential.png\')"></div>
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
                <div class="pro-project-card" data-category="residential" onclick="location.href=\'project-details.html?img=residential.png&title=Luxury+Villa+Complex&cat=Residential\'" data-aos="fade-up">
                    <div class="img-wrapper"><img src="assets/images/projects/residential.png" alt="Luxury Villa Complex"></div>
                    <div class="pro-project-info glass-panel">
                        <span class="category">Residential</span>
                        <h3>Luxury Villa Complex</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Lusaka</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="pro-project-card" data-category="commercial" onclick="location.href=\'project-details.html?img=commercial.png&title=Meridian+Business+Tower&cat=Commercial\'" data-aos="fade-up">
                    <div class="img-wrapper"><img src="assets/images/projects/commercial.png" alt="Meridian Business Tower"></div>
                    <div class="pro-project-info glass-panel">
                        <span class="category">Commercial</span>
                        <h3>Meridian Business Tower</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Lusaka</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2025</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <div class="pro-project-card" data-category="institutional" onclick="location.href=\'project-details.html?img=institutional.png&title=National+Learning+Center&cat=Institutional\'" data-aos="fade-up">
                    <div class="img-wrapper"><img src="assets/images/projects/institutional.png" alt="Learning Center"></div>
                    <div class="pro-project-info glass-panel">
                        <span class="category">Institutional</span>
                        <h3>National Learning Center</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Ndola</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2023</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <div class="pro-project-card" data-category="commercial" onclick="location.href=\'project-details.html?img=urban.png&title=City+Gateway+Development&cat=Commercial\'" data-aos="fade-up">
                    <div class="img-wrapper"><img src="assets/images/projects/urban.png" alt="City Gateway"></div>
                    <div class="pro-project-info glass-panel">
                        <span class="category">Commercial</span>
                        <h3>City Gateway Development</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Kitwe</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2026</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <div class="pro-project-card" data-category="residential" onclick="location.href=\'project-details.html?img=sustainable.png&title=Green+Horizons+Estate&cat=Residential\'" data-aos="fade-up">
                    <div class="img-wrapper"><img src="assets/images/projects/sustainable.png" alt="Green Estate"></div>
                    <div class="pro-project-info glass-panel">
                        <span class="category">Residential</span>
                        <h3>Green Horizons Estate</h3>
                        <div class="pro-project-meta">
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Livingstone</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <button class="btn-view">View Detail <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

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
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'Meridian Tower\', \'assets/images/projects/commercial.png\', \'assets/images/projects/urban.png\')">
                    <img src="assets/images/projects/commercial.png" alt="Meridian Tower Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Luxury Villa Complex -->
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'Luxury Villa\', \'assets/images/projects/residential.png\', \'assets/images/projects/sustainable.png\')">
                    <img src="assets/images/projects/residential.png" alt="Villa Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Public Infrastructure -->
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'City Gateway\', \'assets/images/projects/urban.png\', \'assets/images/projects/institutional.png\')">
                    <img src="assets/images/projects/urban.png" alt="Infrastructure Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
                <!-- Educational Campus -->
                <div class="transformation-item glass-panel" onclick="viewTransformation(\'National Campus\', \'assets/images/projects/institutional.png\', \'assets/images/projects/commercial.png\')">
                    <img src="assets/images/projects/institutional.png" alt="Educational Thumbnail">
                    <div class="item-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                </div>
            </div>
        </div>
    </section>
    ',

    'project-details' => '
    <div class="project-detail-hero">
        <img id="detailHeroImg" src="assets/images/projects/commercial.png" alt="Project Image">
        <div class="project-detail-header" data-aos="fade-up">
            <div class="section-label"><span class="label-line"></span><span class="label-text" style="color:#FFF;" id="detailCatLabel">Commercial Portfolio</span></div>
            <h1 class="page-hero-title text-white" id="detailTitle">Meridian Business <span class="text-accent">Tower</span></h1>
        </div>
    </div>
    
    <div class="container">
        <div class="project-stats-glass glass-panel" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-box">
                <span class="label">Location</span>
                <span class="value">Lusaka, Zambia</span>
            </div>
            <div class="stat-box">
                <span class="label">Client</span>
                <span class="value">SSK Associates Ltd</span>
            </div>
            <div class="stat-box">
                <span class="label">Year</span>
                <span class="value">2025</span>
            </div>
            <div class="stat-box">
                <span class="label">Size</span>
                <span class="value">24,000 sqm</span>
            </div>
            <div class="stat-box">
                <span class="label">Services</span>
                <span class="value">Architecture, Management</span>
            </div>
        </div>

        <div class="project-content-grid">
            <div class="project-text" data-aos="fade-right">
                <h2>Design Concept & Vision</h2>
                <p>This project represents a paradigm shift in workspace design within Zambia. The architectural vision was to create a highly efficient, sustainable, and visually striking structure that anchors the city\'s growing district.</p>
                
                <p>Our approach integrates a high-performance facade with an articulated structural system. This not only provides structural integrity but also serves as passive solar shading, significantly reducing cooling loads during the harsh summer months.</p>
                
                <h2>Construction & Materials</h2>
                <p>Sourcing locally produced materials was a key priority. Over 60% of raw construction materials, including the specialized concrete mix and interior finishing woods, were sourced from within Zambia. The resulting aesthetic balances sharp, modern lines with warm, textured interiors.</p>

                <div style="margin-top: 40px;">
                    <img id="detailSecondaryImg" src="assets/images/projects/urban.png" class="glass-panel" style="width:100%; border-radius:16px; padding:10px;" alt="Secondary image">
                </div>
            </div>
            
            <div class="project-sidebar" data-aos="fade-left">
                <div class="glass-panel">
                    <h3 style="font-family: var(--font-heading); color: var(--text-white); margin-bottom: 20px;">Project Details</h3>
                    <ul class="sidebar-list">
                        <li><span class="list-label">Sector</span> <span class="list-val" id="detailSector">Commercial</span></li>
                        <li><span class="list-label">Status</span> <span class="list-val">Under Construction</span></li>
                        <li><span class="list-label">Floors</span> <span class="list-val">18 Stories</span></li>
                        <li><span class="list-label">Sustainability</span> <span class="list-val">LEED Gold Target</span></li>
                        <li><span class="list-label">Lead Architect</span> <span class="list-val">M. Banda</span></li>
                    </ul>
                    <div style="margin-top: 30px; text-align: center;">
                        <a href="projects.html" class="btn btn-outline" style="width: 100%; justify-content:center;">Back to Portfolio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Dynamically populate project details from URL params
    (function() {
        var params = new URLSearchParams(window.location.search);
        var img = params.get("img");
        var title = params.get("title");
        var cat = params.get("cat");
        if(img) {
            var heroImg = document.getElementById("detailHeroImg");
            var secImg = document.getElementById("detailSecondaryImg");
            if(heroImg) heroImg.src = "assets/images/projects/" + img;
            if(secImg) secImg.src = "assets/images/projects/" + img;
        }
        if(title) {
            var titleEl = document.getElementById("detailTitle");
            if(titleEl) titleEl.innerHTML = title.replace(/\+/g, " ");
        }
        if(cat) {
            var catEl = document.getElementById("detailCatLabel");
            var sectorEl = document.getElementById("detailSector");
            if(catEl) catEl.textContent = cat + " Portfolio";
            if(sectorEl) sectorEl.textContent = cat;
        }
    })();
    </script>
    ',

    'team' => '
    <div class="page-hero">
        <div class="page-hero-bg" style="background-image: url(\'assets/images/projects/institutional.png\')"></div>
        <div class="page-hero-content" data-aos="fade-up">
            <div class="section-label justify-center"><span class="label-line"></span><span class="label-text">Our People</span><span class="label-line"></span></div>
            <h1 class="page-hero-title">Leadership & <span class="text-accent">Team</span></h1>
            <p class="page-hero-subtitle">The creative minds and disciplined professionals behind our success.</p>
        </div>
    </div>
    
    <section class="team-section" style="padding: 50px 0 100px;">
        <div class="container">
            <div class="team-grid stagger-children">
                <!-- Abstract avatars used as placeholders for high-end look -->
                <div class="team-card glass-panel" style="padding:20px;">
                    <div class="team-img-wrap">
                        <!-- Generative placeholder -->
                        <div style="width:100%; height:100%; background:linear-gradient(135deg, #E02121 0%, #1a1a1a 100%);"></div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <h3>Samuel S. K.</h3>
                    <p>Principal Architect & Founder</p>
                </div>
                
                <div class="team-card glass-panel" style="padding:20px;">
                    <div class="team-img-wrap">
                        <div style="width:100%; height:100%; background:linear-gradient(135deg, #00D1D1 0%, #1a1a1a 100%);"></div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <h3>Elena Mwanza</h3>
                    <p>Head of Project Management</p>
                </div>
                
                <div class="team-card glass-panel" style="padding:20px;">
                    <div class="team-img-wrap">
                        <div style="width:100%; height:100%; background:linear-gradient(135deg, #444 0%, #1a1a1a 100%);"></div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <h3>David Phiri</h3>
                    <p>Lead Urban Planner</p>
                </div>
                
                <div class="team-card glass-panel" style="padding:20px;">
                    <div class="team-img-wrap">
                        <div style="width:100%; height:100%; background:linear-gradient(135deg, #555 0%, #00D1D1 100%); border-radius:12px;"></div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <h3>Grace Banda</h3>
                    <p>Senior Sustainability Consultant</p>
                </div>
            </div>
        </div>
    </section>
    ',

    'contact' => '
    <div class="page-hero">
        <div class="page-hero-bg" style="background-image: url(\'assets/images/hero-building.png\')"></div>
        <div class="page-hero-content" data-aos="fade-up">
            <h1 class="page-hero-title">Get In <span class="text-accent">Touch</span></h1>
            <p class="page-hero-subtitle">Let\'s discuss your next architectural vision.</p>
        </div>
    </div>
    
    <section class="contact-section" style="padding-top: 50px;">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info glass-panel" style="padding:50px; border-radius:16px;" data-aos="fade-right">
                    <h2 class="section-title">Headquarters</h2>
                    <p class="contact-desc">Our design studio is located in the heart of Lusaka. Schedule a meeting to review our portfolio in person.</p>
                    <div class="contact-details">
                        <div class="contact-detail-item">
                            <div class="detail-icon" style="background:transparent; border-color:var(--accent-red);"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="detail-content"><span class="detail-label">Office Address</span><span class="detail-value">Lusaka, Zambia</span></div>
                        </div>
                        <div class="contact-detail-item">
                            <div class="detail-icon" style="background:transparent; border-color:var(--accent-red);"><i class="fas fa-envelope"></i></div>
                            <div class="detail-content"><span class="detail-label">Email Us</span><span class="detail-value">info@sskassociates.co.zm</span></div>
                        </div>
                        <div class="contact-detail-item">
                            <div class="detail-icon" style="background:transparent; border-color:var(--accent-red);"><i class="fas fa-phone-alt"></i></div>
                            <div class="detail-content"><span class="detail-label">Call Us</span><span class="detail-value">+260 XXX XXX XXX</span></div>
                        </div>
                    </div>
                </div>

                <div class="contact-form-wrapper glass-card" style="padding: 50px; background: rgba(30, 30, 34, 0.6);" data-aos="fade-left">
                    <form class="contact-form" id="contactForm">
                        <div class="form-group">
                            <input type="text" id="formName" name="name" placeholder="Your Name" required>
                            <label for="formName">Your Name</label><span class="form-line"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" id="formEmail" name="email" placeholder="Your Email" required>
                            <label for="formEmail">Your Email</label><span class="form-line"></span>
                        </div>
                        <div class="form-group">
                            <textarea id="formMessage" name="message" placeholder="Tell us about your project..." rows="4" required></textarea>
                            <label for="formMessage">Your Message</label><span class="form-line"></span>
                        </div>
                        <button type="submit" class="btn btn-primary glass-btn btn-submit" style="width:100%;"><span>Send Message</span><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            
            <div class="map-container glass-panel" style="margin-top: 80px; height: 400px; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-direction:column;" data-aos="fade-up">
                <i class="fas fa-map-marked-alt text-accent" style="font-size: 64px; margin-bottom: 20px;"></i>
                <h3 style="color:#fff; font-family:var(--font-heading);">Interactive Map View</h3>
                <p style="color:var(--text-gray);">Lusaka, Zambia Location</p>
                <a href="#" class="btn btn-outline" style="margin-top: 20px;">Open in Google Maps</a>
            </div>
        </div>
    </section>
    '
];

foreach ($pagesContent as $id => $content) {
    $titles = [
        'index' => 'Home', 'about' => 'About', 'services' => 'Services', 
        'projects' => 'Portfolio', 'project-details' => 'Project Display',
        'team' => 'Our Team', 'contact' => 'Contact'
    ];
    $fullHtml = getHeader($id, $titles[$id]) . "\n" . $content . "\n" . getFooter();
    file_put_contents('c:/xampp/htdocs/SSK ASSOCIATES/' . $id . '.html', $fullHtml);
}

echo "All multi-page HTML files generated successfully!";
?>
