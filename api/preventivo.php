<?php
ob_start();

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Metodo non consentito', 405);

    $data = json_decode(file_get_contents('php://input'), true);

    $requiredFields = ['nome', 'cognome', 'citta', 'telefono', 'email', 'messaggio'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) throw new Exception('Compila tutti i campi obbligatori', 400);
    }

    $nome = filter_var($data['nome'], FILTER_SANITIZE_STRING);
    $cognome = filter_var($data['cognome'], FILTER_SANITIZE_STRING);
    $citta = filter_var($data['citta'], FILTER_SANITIZE_STRING);
    $telefono = filter_var($data['telefono'], FILTER_SANITIZE_STRING);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $messaggio = filter_var($data['messaggio'], FILTER_SANITIZE_STRING);

    $to = 'graziadiodovich@gmail.com';
    $subject = "Richiesta preventivo da $nome $cognome";
    $body = "
<h2>Nuova richiesta di preventivo</h2>
<p><strong>Nome:</strong> $nome $cognome</p>
<p><strong>Città:</strong> $citta</p>
<p><strong>Telefono:</strong> $telefono</p>
<p><strong>Email:</strong> $email</p>
<p><strong>Messaggio:</strong></p>
<p>$messaggio</p>
";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: $nome $cognome <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    $mailSent = mail($to, $subject, $body, $headers);

    if ($mailSent) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Richiesta di preventivo inviata con successo! Ti contatteremo al più presto.']);
        exit();
    }

    throw new Exception('Errore durante l\'invio della richiesta. Riprova più tardi.');
} catch (Exception $e) {
    ob_end_clean();

    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit();
}

ob_end_flush();
?>