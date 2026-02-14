document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle — popup from right (75% width), backdrop
    const mobileMenuBtn = document.getElementById('mobile-menu');
    const navMenu = document.getElementById('nav-menu');
    const navBackdrop = document.getElementById('nav-backdrop');

    function openMenu() {
        if (navMenu) navMenu.classList.add('active');
        if (mobileMenuBtn) {
            mobileMenuBtn.classList.add('active');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            mobileMenuBtn.setAttribute('aria-label', 'Close menu');
        }
        if (navBackdrop) {
            navBackdrop.classList.add('is-visible');
            navBackdrop.setAttribute('aria-hidden', 'false');
        }
        document.body.classList.add('nav-menu-open');
    }

    function closeMenu() {
        if (navMenu) navMenu.classList.remove('active');
        if (mobileMenuBtn) {
            mobileMenuBtn.classList.remove('active');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            mobileMenuBtn.setAttribute('aria-label', 'Open menu');
        }
        if (navBackdrop) {
            navBackdrop.classList.remove('is-visible');
            navBackdrop.setAttribute('aria-hidden', 'true');
        }
        document.body.classList.remove('nav-menu-open');
    }

    if (mobileMenuBtn && navMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            if (navMenu.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });
    }

    if (navBackdrop) {
        navBackdrop.addEventListener('click', closeMenu);
    }

    // Close menu when clicking a link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            closeMenu();
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
