// ADVANCED UI INTERACTIONS - Glassmorphism & Expanding Elements

document.addEventListener('DOMContentLoaded', () => {

    // 1. Portfolio Category Filtering (For projects.html)
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.pro-project-card');

    if(filterBtns.length > 0 && projectCards.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-filter');

                projectCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if(filterValue === 'all' || filterValue === category) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }

    // 2. Glass Modal Logic for Quick View
    const modal = document.getElementById('projectModal');
    const modalBody = document.getElementById('modalBody');
    const modalClose = document.querySelector('.glass-modal-close');

    // Make function global so inline onclick="" works
    window.viewQuickProject = function(title, imageSrc, locationDesc, category) {
        if(!modal || !modalBody) return;
        
        modalBody.innerHTML = `
            <div class="modal-grid">
                <div class="modal-img" style="border-radius: 12px; overflow: hidden; height: 350px;">
                    <img src="${imageSrc}" style="width:100%; height:100%; object-fit:cover;" alt="${title}">
                </div>
                <div class="modal-info">
                    <span style="color:var(--accent-cyan); text-transform:uppercase; font-size:12px; font-weight:700; letter-spacing:2px;">${category}</span>
                    <h2 style="font-family:var(--font-heading); font-size:32px; color:var(--text-white); margin:10px 0 20px;">${title}</h2>
                    <p style="color:var(--text-gray); line-height:1.6; margin-bottom:20px;">
                        A detailed preview of the architectural model, showcasing structurally integrated landscapes and world-class environmental compliance.
                    </p>
                    <ul style="list-style:none; padding:0; margin-bottom:30px;">
                        <li style="padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05); color:var(--text-white); font-size:14px;"><i class="fas fa-map-marker-alt text-accent" style="width:20px;"></i> ${locationDesc}, Zambia</li>
                        <li style="padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05); color:var(--text-white); font-size:14px;"><i class="fas fa-hammer text-accent" style="width:20px;"></i> Under Construction</li>
                    </ul>
                    <a href="project-details.html" class="btn btn-primary glass-btn"><span>Full Details</span><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        `;
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    if(modalClose) {
        modalClose.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    if(modal) {
        modal.addEventListener('click', (e) => {
            if(e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

});

// 3. Before & After Slider Logic
// Make function global for specific input element so inline oninput="" works
window.updateSlider = function(inputElem) {
    // Find the closest parent container to scope the logic
    const container = inputElem.closest('.ba-slider-container');
    if(!container) return;

    const baBeforeImg = container.querySelector('.ba-image-before');
    const baLine = container.querySelector('.ba-slider-line');
    
    if(baBeforeImg && baLine) {
        const sliderPos = inputElem.value;
        baBeforeImg.style.width = sliderPos + '%';
        baLine.style.left = sliderPos + '%';
    }
};


// 4. Transformation (Before/After) Modal Logic
document.addEventListener('DOMContentLoaded', () => {
    const baModal = document.getElementById('baModal');
    const baModalBody = document.getElementById('baModalBody');

    window.viewTransformation = function(title, afterImg, beforeImg) {
        if(!baModal || !baModalBody) return;

        baModalBody.innerHTML = '<div style="padding: 40px; text-align: center;">' +
            '<h2 style="font-family:var(--font-heading); color:#fff; margin-bottom:30px;">' + title + ' Transformation</h2>' +
            '<div class="ba-slider-container glass-panel" style="margin: 0 auto; height: 60vh;">' +
                '<div class="ba-image ba-image-after">' +
                    '<img src="' + afterImg + '" alt="After Project">' +
                    '<span class="ba-label ba-label-after">After</span>' +
                '</div>' +
                '<div class="ba-image ba-image-before">' +
                    '<img src="' + beforeImg + '" alt="Before Project" style="filter: grayscale(80%) brightness(0.7);">' +
                    '<span class="ba-label ba-label-before">Before</span>' +
                '</div>' +
                '<input type="range" min="0" max="100" value="50" class="ba-slider-input" oninput="updateSlider(this)">' +
                '<div class="ba-slider-line">' +
                    '<div class="ba-slider-thumb"><i class="fas fa-arrows-alt-h"></i></div>' +
                '</div>' +
            '</div>' +
            '<div style="margin-top: 30px; color: var(--text-gray); font-size: 0.9rem;">' +
                '<p><i class="fas fa-info-circle" style="margin-right: 8px;"></i> Drag the slider to compare original site against completed project.</p>' +
            '</div>' +
        '</div>';

        baModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    // Close button for BA modal
    const baCloseBtn = document.querySelector('#baModal .glass-modal-close');
    if(baCloseBtn) {
        baCloseBtn.addEventListener('click', () => {
            baModal.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // Click outside to close
    if(baModal) {
        baModal.addEventListener('click', (e) => {
            if(e.target === baModal) {
                baModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
});



// 5. Blueprint Hero Animation (Dynamic Architectural Lines)
(function() {
    const canvas = document.getElementById('blueprintCanvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    
    let width, height, points = [];
    const maxPoints = 40;
    const connectionDistance = 250;
    
    function init() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        points = [];
        for (let i = 0; i < maxPoints; i++) {
            points.push({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5
            });
        }
    }
    
    function draw() {
        ctx.clearRect(0, 0, width, height);
        ctx.strokeStyle = 'rgba(0, 209, 209, 0.1)'; // Tech Cyan subtle
        ctx.fillStyle = 'rgba(0, 209, 209, 0.2)';
        
        for (let i = 0; i < points.length; i++) {
            const p = points[i];
            p.x += p.vx;
            p.y += p.vy;
            
            if (p.x < 0 || p.x > width) p.vx *= -1;
            if (p.y < 0 || p.y > height) p.vy *= -1;
            
            ctx.beginPath();
            ctx.arc(p.x, p.y, 1.5, 0, Math.PI * 2);
            ctx.fill();
            
            for (let j = i + 1; j < points.length; j++) {
                const p2 = points[j];
                const dist = Math.sqrt(Math.pow(p.x - p2.x, 2) + Math.pow(p.y - p2.y, 2));
                if (dist < connectionDistance) {
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.stroke();
                }
            }
        }
        requestAnimationFrame(draw);
    }
    
    window.addEventListener('resize', init);
    init();
    draw();
})();
