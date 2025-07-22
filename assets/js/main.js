document.addEventListener('DOMContentLoaded', function() {
    // Header and Navigation
    const hamburger = document.querySelector('.hamburger');
    const navList = document.querySelector('.nav-list');
    const body = document.body;
    const navLinks = document.querySelectorAll('.nav-list a');

    if (hamburger) {
        navLinks.forEach((link, index) => {
            link.parentElement.style.setProperty('--i', index);
        });

        hamburger.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            navList.classList.toggle('active');
            body.classList.toggle('no-scroll');

            const isExpanded = this.classList.contains('active');
            this.setAttribute('aria-expanded', isExpanded);
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.nav') && !e.target.closest('.hamburger')) {
                closeMenu();
            }
        });

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                closeMenu();
            });
        });

        document.addEventListener('scroll', function() {
            if (navList.classList.contains('active')) {
                window.scrollTo(0, 0);
            }
        });

        function closeMenu() {
            hamburger.classList.remove('active');
            navList.classList.remove('active');
            body.classList.remove('no-scroll');
            hamburger.setAttribute('aria-expanded', 'false');
        }
    }

    // Header scroll effect
    const header = document.querySelector('.header');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight + 80;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Contact form
    const contactForm = document.getElementById('appointment-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Grazie per la tua richiesta! Ti contatteremo al più presto.');
            this.reset();
        });
    }

    // Preventivo form
    const preventivoForm = document.getElementById('preventivo-form');
    if (preventivoForm) {
        preventivoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Grazie per la tua richiesta di preventivo! Ti contatteremo al più presto.');
            this.reset();
        });
    }

    // File input display
    const fileInput = document.getElementById('preventivo-lastre');
    if (fileInput) {
        const fileInfo = document.querySelector('.file-info');
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileInfo.textContent = `${this.files.length} file selezionati`;
            } else {
                fileInfo.textContent = 'Nessun file selezionato';
            }
        });
    }

    // Scroll animations
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.fade-in, .slide-up, .slide-down, .slide-left, .slide-right, .zoom-in');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        elements.forEach(element => {
            observer.observe(element);
        });
    };

    animateOnScroll();
});