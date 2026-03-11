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

    const navMenuClose = document.getElementById('nav-menu-close');
    if (navMenuClose && navMenu) {
        navMenuClose.addEventListener('click', closeMenu);
    }

    // Close menu when clicking a link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            closeMenu();
        });
    });

    // Navbar scroll effect (deep.html style): transparent at top, solid on scroll
    const navbar = document.getElementById('navbar') || document.querySelector('.navbar');
    if (navbar) {
        function updateNavbarScroll() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        updateNavbarScroll();
        window.addEventListener('scroll', updateNavbarScroll);
    }

    // Hero scroll indicator — smooth scroll to #welcome
    const heroScrollIndicator = document.querySelector('.hero-scroll-indicator');
    if (heroScrollIndicator) {
        heroScrollIndicator.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId.startsWith('#')) {
                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    }

    // Hero slider (home page) — only when slider present
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
            var counterEl = heroSlider.querySelector('.hero-slide-current');
            if (counterEl) counterEl.textContent = String(current + 1).padStart(2, '0');
        }

        function nextSlide() {
            goToSlide(current + 1);
        }

        function prevSlide() {
            goToSlide(current - 1);
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

        const prevBtn = heroSlider.querySelector('.hero-arrow--prev');
        const nextBtn = heroSlider.querySelector('.hero-arrow--next');
        if (prevBtn) prevBtn.addEventListener('click', function() { prevSlide(); startAutoplay(); });
        if (nextBtn) nextBtn.addEventListener('click', function() { nextSlide(); startAutoplay(); });

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

    // Product image lightbox: click image to open popup with prev/next
    var lightbox = document.getElementById('product-lightbox');
    if (lightbox) {
        var lightboxImg = document.getElementById('lightbox-img');
        var lightboxCounter = document.getElementById('lightbox-counter');
        var lightboxBackdrop = lightbox.querySelector('.lightbox-backdrop');
        var lightboxClose = lightbox.querySelector('.lightbox-close');
        var lightboxPrev = lightbox.querySelector('.lightbox-prev');
        var lightboxNext = lightbox.querySelector('.lightbox-next');

        var lightboxImages = [];
        var lightboxIndex = 0;

        function openLightbox(images, index) {
            lightboxImages = images;
            lightboxIndex = index >= 0 && index < images.length ? index : 0;
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            if (lightboxImages.length <= 1) {
                lightbox.classList.add('lightbox--single');
                if (lightboxCounter) lightboxCounter.textContent = '';
            } else {
                lightbox.classList.remove('lightbox--single');
                if (lightboxCounter) lightboxCounter.textContent = (lightboxIndex + 1) + ' / ' + lightboxImages.length;
            }
            updateLightboxImage();
            document.body.classList.add('lightbox-open');
        }

        function updateLightboxImage() {
            if (!lightboxImg || !lightboxImages.length) return;
            var item = lightboxImages[lightboxIndex];
            lightboxImg.src = item.src;
            lightboxImg.alt = item.alt || '';
            if (lightboxCounter && lightboxImages.length > 1) {
                lightboxCounter.textContent = (lightboxIndex + 1) + ' / ' + lightboxImages.length;
            }
        }

        function closeLightbox() {
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('lightbox-open');
        }

        function lightboxGoPrev() {
            if (lightboxImages.length <= 1) return;
            lightboxIndex = (lightboxIndex - 1 + lightboxImages.length) % lightboxImages.length;
            updateLightboxImage();
        }

        function lightboxGoNext() {
            if (lightboxImages.length <= 1) return;
            lightboxIndex = (lightboxIndex + 1) % lightboxImages.length;
            updateLightboxImage();
        }

        document.addEventListener('click', function(e) {
            var img = e.target.closest('.farmstead-section .card-carousel-slide img');
            if (!img) return;
            e.preventDefault();
            var carousel = img.closest('.card-carousel');
            if (!carousel) return;
            var slides = carousel.querySelectorAll('.card-carousel-slide');
            var images = [];
            var index = 0;
            slides.forEach(function(slide, i) {
                var im = slide.querySelector('img');
                if (im) {
                    images.push({ src: im.src, alt: im.alt || '' });
                    if (im === img) index = i;
                }
            });
            if (images.length) openLightbox(images, index);
        });

        if (lightboxBackdrop) lightboxBackdrop.addEventListener('click', closeLightbox);
        if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
        if (lightboxPrev) lightboxPrev.addEventListener('click', function(e) { e.stopPropagation(); lightboxGoPrev(); });
        if (lightboxNext) lightboxNext.addEventListener('click', function(e) { e.stopPropagation(); lightboxGoNext(); });

        document.addEventListener('keydown', function(e) {
            if (!lightbox.classList.contains('is-open')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') lightboxGoPrev();
            if (e.key === 'ArrowRight') lightboxGoNext();
        });
    }

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
