/* ================================================================
   SSK ASSOCIATES — MAIN JAVASCRIPT
   All interactive features, animations, and functionality
   ================================================================ */

document.addEventListener("DOMContentLoaded", () => {
  "use strict";

  // ==================== PRELOADER ====================
  const preloader = document.getElementById("preloader");
  window.addEventListener("load", () => {
    setTimeout(() => {
      preloader.classList.add("loaded");
      document.body.style.overflow = "";
      initAnimations();
    }, 2200);
  });

  // Fallback: hide preloader after 4s max
  setTimeout(() => {
    if (preloader && !preloader.classList.contains("loaded")) {
      preloader.classList.add("loaded");
      document.body.style.overflow = "";
    }
  }, 4000);

  // ==================== INIT AOS ====================
  function initAnimations() {
    AOS.init({
      duration: 800,
      easing: "ease-out-cubic",
      once: true,
      offset: 80,
      delay: 0,
    });
  }

  // Fallback AOS init
  setTimeout(() => {
    if (typeof AOS !== "undefined") {
      AOS.init({
        duration: 800,
        easing: "ease-out-cubic",
        once: true,
        offset: 80,
      });
    }
  }, 3000);

  // ==================== NAVIGATION ====================
  const mainNav = document.getElementById("mainNav");
  const navToggle = document.getElementById("navToggle");
  const navLinks = document.getElementById("navLinks");
  const navLinkItems = document.querySelectorAll(".nav-link");

  // Scroll effect
  let lastScroll = 0;
  window.addEventListener("scroll", () => {
    const currentScroll = window.scrollY;

    if (currentScroll > 80) {
      mainNav.classList.add("scrolled");
    } else {
      mainNav.classList.remove("scrolled");
    }

    lastScroll = currentScroll;

    // Update active nav link
    updateActiveNavLink();

    // Back to top button visibility
    updateBackToTop();
  });

  // Mobile toggle
  navToggle.addEventListener("click", () => {
    navToggle.classList.toggle("active");
    navLinks.classList.toggle("open");
    document.body.style.overflow = navLinks.classList.contains("open")
      ? "hidden"
      : "";
  });

  // Close mobile nav on link click
  navLinkItems.forEach((link) => {
    link.addEventListener("click", () => {
      navToggle.classList.remove("active");
      navLinks.classList.remove("open");
      document.body.style.overflow = "";
    });
  });

  // Active nav link based on scroll position
  function updateActiveNavLink() {
    const sections = document.querySelectorAll("section[id]");
    const scrollPos = window.scrollY + 150;

    sections.forEach((section) => {
      const top = section.offsetTop;
      const height = section.offsetHeight;
      const id = section.getAttribute("id");

      if (scrollPos >= top && scrollPos < top + height) {
        navLinkItems.forEach((link) => {
          link.classList.remove("active");
          if (link.getAttribute("href") === "#" + id) {
            link.classList.add("active");
          }
        });
      }
    });
  }

  // ==================== SMOOTH SCROLL ====================
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        const navHeight = mainNav.offsetHeight;
        const targetPosition = target.offsetTop - navHeight;
        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });
      }
    });
  });

  // ==================== BACK TO TOP ====================
  const backToTop = document.getElementById("backToTop");

  function updateBackToTop() {
    if (window.scrollY > 500) {
      backToTop.classList.add("visible");
    } else {
      backToTop.classList.remove("visible");
    }
  }

  backToTop.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  // ==================== HERO BLUEPRINT CANVAS ====================
  function createBlueprintLines() {
    const canvas = document.getElementById("blueprintCanvas");
    if (!canvas) return;

    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, "svg");
    svg.setAttribute("width", "100%");
    svg.setAttribute("height", "100%");
    svg.style.position = "absolute";
    svg.style.inset = "0";

    // Create animated architectural lines
    const lines = [
      { x1: "0%", y1: "20%", x2: "100%", y2: "20%", delay: 0 },
      { x1: "0%", y1: "40%", x2: "100%", y2: "40%", delay: 0.5 },
      { x1: "0%", y1: "60%", x2: "100%", y2: "60%", delay: 1 },
      { x1: "0%", y1: "80%", x2: "100%", y2: "80%", delay: 1.5 },
      { x1: "20%", y1: "0%", x2: "20%", y2: "100%", delay: 0.3 },
      { x1: "40%", y1: "0%", x2: "40%", y2: "100%", delay: 0.8 },
      { x1: "60%", y1: "0%", x2: "60%", y2: "100%", delay: 1.3 },
      { x1: "80%", y1: "0%", x2: "80%", y2: "100%", delay: 1.8 },
      // Diagonal lines
      { x1: "0%", y1: "0%", x2: "50%", y2: "100%", delay: 0.6 },
      { x1: "50%", y1: "0%", x2: "100%", y2: "100%", delay: 1.1 },
      { x1: "100%", y1: "0%", x2: "50%", y2: "100%", delay: 1.6 },
    ];

    lines.forEach(({ x1, y1, x2, y2, delay }) => {
      const line = document.createElementNS(svgNS, "line");
      line.setAttribute("x1", x1);
      line.setAttribute("y1", y1);
      line.setAttribute("x2", x2);
      line.setAttribute("y2", y2);
      line.setAttribute("stroke", "rgba(0, 209, 209, 0.04)");
      line.setAttribute("stroke-width", "1");
      line.setAttribute("stroke-dasharray", "8 12");
      line.style.animation = `blueprintDraw 6s ease-in-out ${delay}s infinite alternate`;
      svg.appendChild(line);
    });

    // Crosshair markers
    const crossPoints = [
      { cx: "20%", cy: "20%" },
      { cx: "40%", cy: "40%" },
      { cx: "60%", cy: "60%" },
      { cx: "80%", cy: "80%" },
      { cx: "20%", cy: "80%" },
      { cx: "80%", cy: "20%" },
    ];

    crossPoints.forEach(({ cx, cy }) => {
      const circle = document.createElementNS(svgNS, "circle");
      circle.setAttribute("cx", cx);
      circle.setAttribute("cy", cy);
      circle.setAttribute("r", "3");
      circle.setAttribute("fill", "none");
      circle.setAttribute("stroke", "rgba(224, 33, 33, 0.1)");
      circle.setAttribute("stroke-width", "1");
      svg.appendChild(circle);

      const dot = document.createElementNS(svgNS, "circle");
      dot.setAttribute("cx", cx);
      dot.setAttribute("cy", cy);
      dot.setAttribute("r", "1");
      dot.setAttribute("fill", "rgba(224, 33, 33, 0.15)");
      svg.appendChild(dot);
    });

    canvas.appendChild(svg);
  }

  createBlueprintLines();

  // ==================== HERO PARTICLES ====================
  function createParticles() {
    const container = document.getElementById("heroParticles");
    if (!container) return;

    for (let i = 0; i < 25; i++) {
      const particle = document.createElement("div");
      particle.classList.add("particle");
      particle.style.left = Math.random() * 100 + "%";
      particle.style.top = Math.random() * 100 + "%";
      particle.style.width = Math.random() * 3 + 1 + "px";
      particle.style.height = particle.style.width;
      particle.style.animationDuration = Math.random() * 10 + 8 + "s";
      particle.style.animationDelay = Math.random() * 5 + "s";

      if (Math.random() > 0.6) {
        particle.style.background = "rgba(224, 33, 33, 0.4)";
      }

      container.appendChild(particle);
    }
  }

  createParticles();

  // ==================== STAT COUNTER ANIMATION ====================
  function animateCounters() {
    const counters = document.querySelectorAll("[data-count]");

    counters.forEach((counter) => {
      const target = parseInt(counter.getAttribute("data-count"));
      const duration = 2000;
      const step = target / (duration / 16);
      let current = 0;

      const updateCounter = () => {
        current += step;
        if (current < target) {
          counter.textContent = Math.floor(current);
          requestAnimationFrame(updateCounter);
        } else {
          counter.textContent = target;
        }
      };

      // Use Intersection Observer
      const observer = new IntersectionObserver(
        (entries) => {
          if (entries[0].isIntersecting) {
            updateCounter();
            observer.disconnect();
          }
        },
        { threshold: 0.5 },
      );

      observer.observe(counter);
    });
  }

  animateCounters();

  // ==================== PROJECT FILTERING ====================
  const filterBtns = document.querySelectorAll(".filter-btn");
  const projectCards = document.querySelectorAll(".project-card");

  filterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      // Update active button
      filterBtns.forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");

      const filter = btn.getAttribute("data-filter");

      projectCards.forEach((card, index) => {
        const category = card.getAttribute("data-category");

        if (filter === "all" || category === filter) {
          card.classList.remove("hidden");
          card.style.animation = `fadeInUp 0.5s ease ${index * 0.1}s forwards`;
        } else {
          card.classList.add("hidden");
        }
      });
    });
  });

  // ==================== BEFORE/AFTER SLIDER ====================
  function initBeforeAfterSlider() {
    const slider = document.getElementById("baSlider");
    const handle = document.getElementById("baHandle");
    const beforeImage = slider ? slider.querySelector(".ba-before") : null;

    if (!slider || !handle || !beforeImage) return;

    let isDragging = false;

    function updateSlider(x) {
      const rect = slider.getBoundingClientRect();
      let position = ((x - rect.left) / rect.width) * 100;
      position = Math.max(5, Math.min(95, position));
      beforeImage.style.clipPath = `inset(0 ${100 - position}% 0 0)`;
      handle.style.left = position + "%";
    }

    // Mouse events
    handle.addEventListener("mousedown", (e) => {
      isDragging = true;
      e.preventDefault();
    });

    slider.addEventListener("mousedown", (e) => {
      isDragging = true;
      updateSlider(e.clientX);
    });

    document.addEventListener("mousemove", (e) => {
      if (isDragging) {
        updateSlider(e.clientX);
      }
    });

    document.addEventListener("mouseup", () => {
      isDragging = false;
    });

    // Touch events
    handle.addEventListener("touchstart", (e) => {
      isDragging = true;
      e.preventDefault();
    });

    slider.addEventListener("touchstart", (e) => {
      isDragging = true;
      updateSlider(e.touches[0].clientX);
    });

    document.addEventListener("touchmove", (e) => {
      if (isDragging) {
        updateSlider(e.touches[0].clientX);
      }
    });

    document.addEventListener("touchend", () => {
      isDragging = false;
    });
  }

  initBeforeAfterSlider();

  // ==================== ZAMBIA MAP INTERACTIVITY ====================
  function initZambiaMap() {
    const pins = document.querySelectorAll(".map-pin");
    const tooltip = document.getElementById("mapTooltip");
    const mapContainer = document.getElementById("zambiaMap");

    if (!tooltip || !mapContainer) return;

    pins.forEach((pin) => {
      pin.addEventListener("mouseenter", (e) => {
        const city = pin.getAttribute("data-city");
        const projects = pin.getAttribute("data-projects");

        tooltip.querySelector(".tooltip-city").textContent = city;
        tooltip.querySelector(".tooltip-projects").textContent =
          projects + " Projects";
        tooltip.style.display = "block";

        // Position tooltip
        const mapRect = mapContainer.getBoundingClientRect();
        const pinRect = pin.getBoundingClientRect();
        const tooltipX = pinRect.left - mapRect.left + pinRect.width / 2;
        const tooltipY = pinRect.top - mapRect.top - 60;

        tooltip.style.left = tooltipX + "px";
        tooltip.style.top = tooltipY + "px";
        tooltip.style.transform = "translateX(-50%)";
      });

      pin.addEventListener("mouseleave", () => {
        tooltip.style.display = "none";
      });
    });
  }

  initZambiaMap();

  // ==================== TESTIMONIALS SLIDER ====================
  function initTestimonialsSlider() {
    const track = document.getElementById("testimonialsTrack");
    const prevBtn = document.getElementById("testPrev");
    const nextBtn = document.getElementById("testNext");
    const dotsContainer = document.getElementById("testDots");

    if (!track || !prevBtn || !nextBtn || !dotsContainer) return;

    const slides = track.querySelectorAll(".testimonial-card");
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoPlayInterval;

    // Create dots
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement("span");
      dot.classList.add("dot");
      if (i === 0) dot.classList.add("active");
      dot.addEventListener("click", () => goToSlide(i));
      dotsContainer.appendChild(dot);
    }

    function goToSlide(index) {
      currentSlide = index;
      track.style.transform = `translateX(-${currentSlide * 100}%)`;

      // Update dots
      const dots = dotsContainer.querySelectorAll(".dot");
      dots.forEach((dot, i) => {
        dot.classList.toggle("active", i === currentSlide);
      });
    }

    function nextSlide() {
      goToSlide((currentSlide + 1) % totalSlides);
    }

    function prevSlide() {
      goToSlide((currentSlide - 1 + totalSlides) % totalSlides);
    }

    nextBtn.addEventListener("click", () => {
      nextSlide();
      resetAutoPlay();
    });

    prevBtn.addEventListener("click", () => {
      prevSlide();
      resetAutoPlay();
    });

    // Auto play
    function startAutoPlay() {
      autoPlayInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoPlay() {
      clearInterval(autoPlayInterval);
      startAutoPlay();
    }

    startAutoPlay();

    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    track.addEventListener("touchstart", (e) => {
      touchStartX = e.touches[0].clientX;
    });

    track.addEventListener("touchend", (e) => {
      touchEndX = e.changedTouches[0].clientX;
      const diff = touchStartX - touchEndX;

      if (Math.abs(diff) > 50) {
        if (diff > 0) {
          nextSlide();
        } else {
          prevSlide();
        }
        resetAutoPlay();
      }
    });
  }

  initTestimonialsSlider();

  // ==================== CONTACT FORM ====================
  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();

      const submitBtn = contactForm.querySelector(".btn-submit");
      const originalContent = submitBtn.innerHTML;

      // Simulate submission
      submitBtn.innerHTML =
        '<span>Sending...</span><i class="fas fa-spinner fa-spin"></i>';
      submitBtn.disabled = true;

      setTimeout(() => {
        submitBtn.innerHTML =
          '<span>Message Sent!</span><i class="fas fa-check"></i>';
        submitBtn.style.background = "#00D1D1";

        setTimeout(() => {
          submitBtn.innerHTML = originalContent;
          submitBtn.style.background = "";
          submitBtn.disabled = false;
          contactForm.reset();
        }, 2500);
      }, 1500);
    });
  }

  // ==================== PARALLAX SCROLLING ====================
  function initParallax() {
    const heroImage = document.querySelector(".hero-image-bg");

    window.addEventListener("scroll", () => {
      const scrollY = window.scrollY;

      if (heroImage && scrollY < window.innerHeight) {
        heroImage.style.transform = `scale(1.05) translateY(${scrollY * 0.3}px)`;
      }
    });
  }

  initParallax();

  // ==================== CURSOR EFFECTS ON NAV ====================
  function initNavEffects() {
    const navCta = document.querySelector(".nav-cta");
    if (!navCta) return;

    navCta.addEventListener("mouseenter", function (e) {
      this.style.transform = "translateY(-2px) scale(1.02)";
    });

    navCta.addEventListener("mouseleave", function (e) {
      this.style.transform = "";
    });
  }

  initNavEffects();

  // ==================== REVEAL ON SCROLL ====================
  function initScrollReveal() {
    const revealElements = document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("revealed");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 },
    );

    revealElements.forEach((el) => observer.observe(el));
  }

  initScrollReveal();

  // ==================== STAGGER ANIMATION ====================
  function initStaggerAnimations() {
    const staggerElements = document.querySelectorAll(".stagger-children");

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.2 },
    );

    staggerElements.forEach((el) => observer.observe(el));
  }

  initStaggerAnimations();

  // ==================== MAGNETIC CURSOR EFFECT ====================
  function initMagneticElements() {
    const magneticElements = document.querySelectorAll(
      ".service-card, .why-card",
    );

    magneticElements.forEach((element) => {
      element.addEventListener("mousemove", (e) => {
        const rect = element.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        element.style.transform = `translateY(-8px) perspective(1000px) rotateX(${y * -0.01}deg) rotateY(${x * 0.01}deg)`;
      });

      element.addEventListener("mouseleave", () => {
        element.style.transform = "";
      });
    });
  }

  initMagneticElements();

  // ==================== MAP DRAW ANIMATION ON SCROLL ====================
  function initMapAnimation() {
    const mapOutline = document.querySelector(".zambia-outline");
    if (!mapOutline) return;

    const observer = new IntersectionObserver(
      (entries) => {
        if (entries[0].isIntersecting) {
          mapOutline.style.animation = "drawMap 3s ease-in-out forwards";
          observer.disconnect();
        }
      },
      { threshold: 0.3 },
    );

    observer.observe(mapOutline);
  }

  initMapAnimation();

  // ==================== KEYBOARD NAVIGATION ====================
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      // Close mobile nav
      navToggle.classList.remove("active");
      navLinks.classList.remove("open");
      document.body.style.overflow = "";
    }
  });

  // ==================== PERFORMANCE: LAZY LOADING ====================
  if ("IntersectionObserver" in window) {
    const imgObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute("data-src");
          }
          imgObserver.unobserve(img);
        }
      });
    });

    document.querySelectorAll("img[data-src]").forEach((img) => {
      imgObserver.observe(img);
    });
  }

  // ==================== CONSOLE BRANDING ====================
  console.log(
    "%c SSK Associates Ltd %c Architecture & Project Management ",
    "background: #E02121; color: white; font-weight: bold; padding: 4px 8px; border-radius: 4px 0 0 4px;",
    "background: #1E1E22; color: #00D1D1; padding: 4px 8px; border-radius: 0 4px 4px 0;",
  );
});
