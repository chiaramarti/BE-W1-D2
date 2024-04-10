<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form inviato con successo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
// Avvia la sessione
session_start();

// Controlla se ci sono dati del messaggio nella sessione
if (isset($_SESSION['message'])) {
    // Recupera i dati del messaggio dalla sessione
    $name = $_SESSION['message']['name'];
    $email = $_SESSION['message']['email'];
    $message = $_SESSION['message']['message'];

    // Visualizza il recap del messaggio
    echo "<h2>Messaggio Inviato con Successo</h2>";
    echo "<p>Ecco il recap del messaggio inviato:</p>";
    echo "<p><strong>Nome:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Messaggio:</strong> $message</p>";

    // Cancella i dati del messaggio dalla sessione dopo averli visualizzati
    unset($_SESSION['message']);
} else {
    // Se non ci sono dati del messaggio nella sessione, visualizza un messaggio di errore
    echo "<p>Errore: Nessun messaggio inviato.</p>";
}
?>


<p>Grazie per averci contattato!</p>
<p>Riceverai una risposta al più presto.</p>
<p>La redazione di fuffaffero</p>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>