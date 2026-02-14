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

    // Product page: farm card image carousels (auto-scroll + manual prev/next/dots)
    const carousels = document.querySelectorAll('.card-carousel');
    carousels.forEach(function(carousel) {
        const inner = carousel.querySelector('.card-carousel-inner');
        const slides = carousel.querySelectorAll('.card-carousel-slide');
        const dotsContainer = carousel.querySelector('.card-carousel-dots');
        const prevBtn = carousel.querySelector('.card-carousel-prev');
        const nextBtn = carousel.querySelector('.card-carousel-next');
        const total = slides.length;
        if (total === 0) return;

        let current = 0;
        let autoplayTimer;
        const autoplayMs = parseInt(carousel.getAttribute('data-autoplay') || '4000', 10);

        function goTo(index) {
            current = (index + total) % total;
            slides.forEach(function(s, i) {
                s.classList.toggle('active', i === current);
            });
            const dots = carousel.querySelectorAll('.card-carousel-dots .dot');
            dots.forEach(function(d, i) {
                d.classList.toggle('active', i === current);
            });
        }

        function next() {
            goTo(current + 1);
        }

        function startAutoplay() {
            stopAutoplay();
            if (autoplayMs > 0) {
                autoplayTimer = setInterval(next, autoplayMs);
            }
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
            }
        }

        if (dotsContainer && total > 1) {
            for (let i = 0; i < total; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('aria-label', 'Go to image ' + (i + 1));
                dot.addEventListener('click', function() {
                    goTo(i);
                    startAutoplay();
                });
                dotsContainer.appendChild(dot);
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                goTo(current - 1);
                startAutoplay();
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                goTo(current + 1);
                startAutoplay();
            });
        }

        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);

        goTo(0);
        startAutoplay();
    });

    // Footer Send Inquiry: open mailto with subject and body pre-filled
    document.querySelectorAll('.footer-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            var nameEl = form.querySelector('input[name="name"]');
            var emailEl = form.querySelector('input[name="email"]');
            var msgEl = form.querySelector('textarea[name="message"]');
            var name = nameEl ? nameEl.value.trim() : '';
            var email = emailEl ? emailEl.value.trim() : '';
            var msg = msgEl ? msgEl.value.trim() : '';
            var subject = 'Website Inquiry' + (name ? ' from ' + name : '');
            var body = (name ? 'Name: ' + name + '\n' : '') + (email ? 'Email: ' + email + '\n\n' : '') + (msg ? 'Message:\n' + msg : '');
            var mailto = 'mailto:info@agroswift.co.ke?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
            e.preventDefault();
            window.location.href = mailto;
        });
    });
});
