document.addEventListener('DOMContentLoaded', function() {
    const preventivoForm = document.getElementById('preventivo-form');
    const sendPreventivoBtn = document.getElementById('send-preventivo');
    const fileInput = document.getElementById('preventivo-lastre');
    const fileInfo = document.querySelector('.file-upload-wrapper .file-info');
    const fileError = document.getElementById('file-error');

    if (!document.getElementById('toast-container')) {
        const toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        document.body.appendChild(toastContainer);
    }

    if (preventivoForm && sendPreventivoBtn) {
        preventivoForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const nome = document.getElementById('preventivo-nome').value;
            const cognome = document.getElementById('preventivo-cognome').value;
            const citta = document.getElementById('preventivo-citta').value;
            const telefono = document.getElementById('preventivo-telefono').value;
            const email = document.getElementById('preventivo-email').value;
            const messaggio = document.getElementById('preventivo-messaggio').value;

            if (!nome || !cognome || !citta || !telefono || !email || !messaggio) {
                showToast('Compila tutti i campi obbligatori', false);
                return;
            }

            if (fileInput.files.length > 0) {
                for (let i = 0; i < fileInput.files.length; i++) {
                    if (fileInput.files[i].type !== 'application/pdf') {
                        showToast('Per favore, carica solo file PDF', false);
                        return;
                    }
                }
            }

            const formData = new FormData(preventivoForm);

            sendPreventivoBtn.disabled = true;
            sendPreventivoBtn.textContent = 'Invio in corso...';

            fetch('/api/preventivo.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    showToast(data.message, data.success);
                    if (data.success) {
                        preventivoForm.reset();
                        fileInfo.textContent = 'Nessun file selezionato';
                    }
                })
                .catch(error => {
                    showToast('Errore durante l\'invio della richiesta', false);
                    console.error('Error:', error);
                })
                .finally(() => {
                    sendPreventivoBtn.disabled = false;
                    sendPreventivoBtn.textContent = 'Richiedi preventivo gratuito';
                });
        });
    }

    fileInput.addEventListener('change', function() {
        const files = this.files;
        if (files.length > 0) {
            fileInfo.textContent = Array.from(files).map(f => f.name).join(', ');
        } else {
            fileInfo.textContent = 'Nessun file selezionato';
        }
    });
});