document.addEventListener('DOMContentLoaded', function() {
    const readMoreBtn = document.querySelector('.read-more-btn');
    if (readMoreBtn) {
        readMoreBtn.addEventListener('click', function() {
            const textMore = document.querySelector('.text-more');
            const textTruncate = document.querySelector('.text-truncate');

            if (textMore.style.display === 'none' || !textMore.style.display) {
                textMore.style.display = 'block';
                textTruncate.style.display = 'none';
                this.textContent = 'Leggi meno';
                this.classList.add('active');
            } else {
                textMore.style.display = 'none';
                textTruncate.style.display = '-webkit-box';
                this.textContent = 'Leggi di più';
                this.classList.remove('active');
            }
        });
    }
});