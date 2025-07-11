document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('appointment-form');
    const sendMailBtn = document.getElementById('send-mail');

    if (!document.getElementById('toast-container')) {
        const toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        document.body.appendChild(toastContainer);
    }

    if (contactForm && sendMailBtn) {
        sendMailBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const formData = {
                name: document.getElementById('name').value,
                surname: document.getElementById('surname').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                message: document.getElementById('message').value
            };

            if (!formData.name || !formData.surname || !formData.email || !formData.phone || !formData.message) {
                showToast('Compila tutti i campi obbligatori', false);
                return;
            }

            fetch('/api/contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
                .then(response => response.json())
                .then(data => {
                    showToast(data.message, data.success);
                    if (data.success) {
                        contactForm.reset();
                    }
                })
                .catch(error => {
                    showToast('Errore durante l\'invio della richiesta', false);
                    console.error('Error:', error);
                });
        });
    }
});