const initTreatmentsCarousel = () => {
    const carouselTrack = document.querySelector('.carousel-track');
    const treatmentCards = document.querySelectorAll('.treatment-card');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    const carouselContainer = document.querySelector('.treatments-carousel');

    if (!carouselTrack || treatmentCards.length === 0) return;

    let currentIndex = 0;
    let cardWidth = 0;
    let visibleCards = 0;
    let autoScrollInterval;
    let isAnimating = false;
    let containerWidth = 0;

    const calculateVisibleCards = () => {
        containerWidth = carouselContainer.offsetWidth;
        cardWidth = treatmentCards[0].offsetWidth + parseInt(getComputedStyle(treatmentCards[0]).marginRight);

        // Calcola quante card possono stare completamente nel container
        const maxVisible = Math.floor(containerWidth / cardWidth);

        if (containerWidth < 768) return 1;
        if (containerWidth < 992) return Math.min(2, maxVisible);
        return Math.min(3, maxVisible);
    };

    const updateCarousel = (animate = true) => {
        if (isAnimating) return;

        const prevVisibleCards = visibleCards;
        visibleCards = calculateVisibleCards();

        if (prevVisibleCards !== visibleCards) {
            currentIndex = Math.max(0, Math.min(currentIndex, treatmentCards.length - visibleCards));
        }

        const offset = -currentIndex * (cardWidth + 20);

        if (animate) {
            isAnimating = true;
            carouselTrack.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            carouselTrack.style.transform = `translateX(${offset}px)`;

            carouselTrack.addEventListener('transitionend', () => {
                isAnimating = false;
            }, { once: true });
        } else {
            carouselTrack.style.transition = 'none';
            carouselTrack.style.transform = `translateX(${offset}px)`;
        }
    };

    const moveBy = (increment) => {
        if (isAnimating) return;

        const newIndex = currentIndex + increment;

        if (newIndex < 0 || newIndex > treatmentCards.length - visibleCards) return;

        currentIndex = newIndex;
        updateCarousel();
        resetAutoScroll();
    };

    const startAutoScroll = () => {
        clearInterval(autoScrollInterval);
        autoScrollInterval = setInterval(() => {
            if (currentIndex >= treatmentCards.length - visibleCards) {
                currentIndex = 0;
                updateCarousel();
            } else {
                moveBy(1);
            }
        }, 5000);
    };

    const resetAutoScroll = () => {
        clearInterval(autoScrollInterval);
        startAutoScroll();
    };

    nextBtn.addEventListener('click', () => moveBy(1));
    prevBtn.addEventListener('click', () => moveBy(-1));

    carouselContainer.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
    carouselContainer.addEventListener('mouseleave', startAutoScroll);

    let touchStartX = 0;
    let touchEndX = 0;

    carouselTrack.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        clearInterval(autoScrollInterval);
    }, {passive: true});

    carouselTrack.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        startAutoScroll();
    }, {passive: true});

    const handleSwipe = () => {
        if (touchStartX - touchEndX > 50) {
            moveBy(1);
        } else if (touchEndX - touchStartX > 50) {
            moveBy(-1);
        }
    };

    const resizeObserver = new ResizeObserver(() => {
        updateCarousel(false);
        setTimeout(() => updateCarousel(true), 100);
    });

    resizeObserver.observe(carouselContainer);

    visibleCards = calculateVisibleCards();
    updateCarousel(false);
    startAutoScroll();
};

document.addEventListener('DOMContentLoaded', initTreatmentsCarousel);