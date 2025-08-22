document.addEventListener('DOMContentLoaded', function() {
    const email = "info@esempio.com";
    
    const preventivoForm = document.getElementById('preventivo-form');
    if (preventivoForm) {
        const sendPreventivo = document.getElementById('send-preventivo');
        const preventivoInputs = preventivoForm.querySelectorAll('input, textarea');

        preventivoInputs.forEach(input => {
            input.addEventListener('input', () => updatePreventivoHref());
        });

        function updatePreventivoHref() {
            const nome = document.getElementById('preventivo-nome').value.trim();
            const cognome = document.getElementById('preventivo-cognome').value.trim();
            const citta = document.getElementById('preventivo-citta').value.trim();
            const telefono = document.getElementById('preventivo-telefono').value.trim();
            const email = document.getElementById('preventivo-email').value.trim();
            const messaggio = document.getElementById('preventivo-messaggio').value.trim();

            const formData = { nome, cognome, citta, telefono, email, messaggio };
            const allFieldsFilled = Object.values(formData).every(value => value !== '');

            if (allFieldsFilled) {
                const subject = `Richiesta preventivo da ${nome} ${cognome}`;
                const body = `
Nome: ${nome}
Cognome: ${cognome}
Città: ${citta}
Telefono: ${telefono}
Email: ${email}

Messaggio:
${messaggio}
                `.trim();

                const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
                sendPreventivo.href = mailtoLink;
            } else {
                sendPreventivo.removeAttribute('href');
            }
        }

        preventivoForm.addEventListener('submit', function(e) {
            e.preventDefault();
        });

        updatePreventivoHref();
    }
    
    const appointmentForm = document.getElementById('appointment-form');
    if (appointmentForm) {
        const sendAppointment = document.getElementById('send-mail');
        const appointmentInputs = appointmentForm.querySelectorAll('input, textarea');

        appointmentInputs.forEach(input => {
            input.addEventListener('input', () => updateAppointmentHref());
        });

        function updateAppointmentHref() {
            const name = document.getElementById('name').value.trim();
            const surname = document.getElementById('surname').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const message = document.getElementById('message').value.trim();

            const formData = { name, surname, email, phone, message };
            const allFieldsFilled = Object.values(formData).every(value => value !== '');

            if (allFieldsFilled) {
                const subject = `Richiesta appuntamento da ${name} ${surname}`;
                const body = `
Nome: ${name}
Cognome: ${surname}
Email: ${email}
Telefono: ${phone}

Messaggio:
${message}
                `.trim();

                const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
                sendAppointment.setAttribute('onclick', `location.href='${mailtoLink}'; return false;`);
            } else {
                sendAppointment.removeAttribute('onclick');
            }
        }

        appointmentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const hasHref = sendAppointment.getAttribute('onclick') !== null;
            if (hasHref) {
                const onclickAttr = sendAppointment.getAttribute('onclick');
                const mailtoLink = onclickAttr.split("'")[1];
                window.location.href = mailtoLink;
            }
        });

        updateAppointmentHref();
    }
});