document.addEventListener('DOMContentLoaded', function() {
    // ======================
// IMPROVED MOBILE MENU
// ======================
const hamburger = document.querySelector('.hamburger');
const navList = document.querySelector('.nav-list');
const body = document.body;

if (hamburger && navList) {
  // Gestione click hamburger
  hamburger.addEventListener('click', function(e) {
    e.stopPropagation();
    const isExpanded = this.getAttribute('aria-expanded') === 'true';
    
    // Aggiorna stato ARIA
    this.setAttribute('aria-expanded', !isExpanded);
    
    // Animazioni
    this.classList.toggle('active');
    navList.classList.toggle('active');
    body.classList.toggle('menu-open'); // Cambiato da no-scroll a menu-open
    
    // Blocco scroll più efficace
    if (navList.classList.contains('active')) {
      document.documentElement.style.overflow = 'hidden';
    } else {
      document.documentElement.style.overflow = '';
    }
  });

  // Chiusura al click sui link
  document.querySelectorAll('.nav-list a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.setAttribute('aria-expanded', 'false');
      hamburger.classList.remove('active');
      navList.classList.remove('active');
      body.classList.remove('menu-open');
      document.documentElement.style.overflow = '';
    });
  });

  // Chiusura al click fuori
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.nav') && 
        !e.target.closest('.hamburger') && 
        navList.classList.contains('active')) {
      hamburger.setAttribute('aria-expanded', 'false');
      hamburger.classList.remove('active');
      navList.classList.remove('active');
      body.classList.remove('menu-open');
      document.documentElement.style.overflow = '';
    }
  });

  // Disabilita scroll quando il menu è aperto
  document.addEventListener('scroll', function(e) {
    if (navList.classList.contains('active')) {
      window.scrollTo(0, 0);
      e.preventDefault();
    }
  }, { passive: false });
}

    // Prevent scrolling when menu is open
    document.addEventListener('scroll', function() {
        if (navList.classList.contains('active')) {
            window.scrollTo(0, 0);
        }
    });

    // Header scroll effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Infinite horizontal carousel for treatments
    const carouselTrack = document.querySelector('.carousel-track');
    const treatmentCards = document.querySelectorAll('.treatment-card');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');

    if (carouselTrack && treatmentCards.length > 0) {
        let currentIndex = 0;
        const cardWidth = treatmentCards[0].offsetWidth + parseInt(getComputedStyle(treatmentCards[0]).marginRight) * 2;
        const visibleCards = Math.floor(document.querySelector('.treatments-carousel').offsetWidth / cardWidth);

        // Clone cards for infinite effect
        treatmentCards.forEach(card => {
            const clone = card.cloneNode(true);
            carouselTrack.appendChild(clone);
        });

        function updateCarousel() {
            carouselTrack.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }

        nextBtn.addEventListener('click', () => {
            currentIndex++;
            if (currentIndex >= treatmentCards.length) {
                currentIndex = 0;
                carouselTrack.style.transition = 'none';
                updateCarousel();
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease';
                }, 10);
            } else {
                carouselTrack.style.transition = 'transform 0.5s ease';
                updateCarousel();
            }
        });

        prevBtn.addEventListener('click', () => {
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = treatmentCards.length - 1;
                carouselTrack.style.transition = 'none';
                updateCarousel();
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease';
                }, 10);
            } else {
                carouselTrack.style.transition = 'transform 0.5s ease';
                updateCarousel();
            }
        });

        // Auto-scroll carousel
        let autoScrollInterval = setInterval(() => {
            nextBtn.click();
        }, 5000);

        // Pause auto-scroll on hover
        const carouselContainer = document.querySelector('.treatments-carousel');
        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(autoScrollInterval);
        });

        carouselContainer.addEventListener('mouseleave', () => {
            autoScrollInterval = setInterval(() => {
                nextBtn.click();
            }, 5000);
        });
    }

    // Form submission
    const contactForm = document.getElementById('appointment-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Grazie per la tua richiesta! Ti contatteremo al più presto.');
            this.reset();
        });
    }

    const preventivoForm = document.getElementById('preventivo-form');
    if (preventivoForm) {
        preventivoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Grazie per la tua richiesta di preventivo! Ti contatteremo al più presto.');
            this.reset();
        });
    }

    // File upload display
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

    // Intersection Observer for animations
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