document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu');
    const navMenu = document.querySelector('.nav-menu');

    if (mobileMenuBtn && navMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenuBtn.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }

    // Close menu when clicking a link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (mobileMenuBtn) mobileMenuBtn.classList.remove('active');
            if (navMenu) navMenu.classList.remove('active');
        });
    });

    // Sticky Navbar shadow on scroll
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                navbar.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
            } else {
                navbar.style.boxShadow = "0 2px 10px rgba(0,0,0,0.05)";
            }
        });
    }

    // Hero slider (home page)
    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider) {
        const slides = heroSlider.querySelectorAll('.hero-slide');
        const contents = heroSlider.querySelectorAll('.hero-slide-content');
        const dots = heroSlider.querySelectorAll('.hero-dot');
        const total = slides.length;
        let current = 0;
        let autoplayTimer;

        function goToSlide(index) {
            current = (index + total) % total;
            slides.forEach(function(s, i) {
                s.classList.toggle('active', i === current);
            });
            contents.forEach(function(c, i) {
                c.classList.toggle('active', i === current);
            });
            dots.forEach(function(d, i) {
                d.classList.toggle('active', i === current);
            });
        }

        function nextSlide() {
            goToSlide(current + 1);
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayTimer = setInterval(nextSlide, 6000);
        }

        function stopAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
        }

        dots.forEach(function(dot, i) {
            dot.addEventListener('click', function() {
                goToSlide(i);
                startAutoplay();
            });
        });

        startAutoplay();
        heroSlider.addEventListener('mouseenter', stopAutoplay);
        heroSlider.addEventListener('mouseleave', startAutoplay);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerOffset = 70;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });
});
