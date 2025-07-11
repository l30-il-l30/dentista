<?php

ob_start();
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Metodo non consentito', 405);

    $data = json_decode(file_get_contents('php://input'), true);

    $requiredFields = ['name', 'surname', 'email', 'phone', 'message'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) throw new Exception("Compila tutti i campi obbligatori", 400);
    }

    $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $surname = filter_var($data['surname'], FILTER_SANITIZE_STRING);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($data['phone'], FILTER_SANITIZE_STRING);
    $message = filter_var($data['message'], FILTER_SANITIZE_STRING);

    $to = "graziadiodovich@gmail.com";
    $subject = "Richiesta appuntamento da $name $surname";
    $body = "
<h2>Nuova richiesta di appuntamento</h2>
<p><strong>Nome:</strong> $name $surname</p>
<p><strong>Email:</strong> $email</p>
<p><strong>Telefono:</strong> $phone</p>
<p><strong>Messaggio:</strong></p>
<p>$message</p>
";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: $name $surname <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    $mailSent = mail($to, $subject, $body, $headers);

    if ($mailSent) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Richiesta inviata con successo! Ti contatteremo al più presto.'
        ]);
        exit();
    }

    throw new Exception("Errore durante l'invio della richiesta. Riprova più tardi.");

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