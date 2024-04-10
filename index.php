<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>

    <?php
    // Definiamo le variabili e impostale a valori vuoti
    $nameErr = $emailErr = $messageErr ="";
    $name = $email = $message = "";

    // FUNZIONI:
    // Le funzioni in PHP sono blocchi di codice che possono essere definiti 
    // una volta e riutilizzati in tutto il programma. Le funzioni possono accettare input, 
    // elaborare dati e restituire un output. Le funzioni sono utili per organizzare il codice in modo modulare, 
    // rendendolo più leggibile, manutenibile e riutilizzabile.

    // SINTASSI: Una funzione viene definita con la parola chiave function, seguita dal nome 
    // della funzione e da parentesi tonde che possono contenere eventuali parametri di input.

    //      function saluta() {
    //          echo "Ciao!";
    //      }

    // CHIAMATA:  Per eseguire il codice all'interno di una funzione, è necessario chiamarla utilizzando il suo nome seguito da parentesi tonde. Ad esempio:
    //      saluta()  --> stampa Ciao!

    // function clean_input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }

    // SE creo la function invece che pulire i dati manualmente alla fine delle operazioni lo posso fare 
    // richiamando la function
    //     ES.
    // Pulizia dei dati e validazione del nome
    //   if (empty($_POST["name"])) {
    //     $nameErr = "Il nome è richiesto";
    //   } else {
    //     $name = clean_input($_POST["name"]);
    //   }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pulizia dei dati e validazione del nome
        if (empty($_POST["name"])) {
          $nameErr = "Il nome è richiesto";
        } else {
          $name = trim($_POST["name"]);
        }
        
        // Pulizia dei dati e validazione dell'email
        if (empty($_POST["email"])) {
          $emailErr = "L'email è richiesta";
        } else {
          $email = trim($_POST["email"]);
          // Verifica se l'email è valida
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato email non valido";
          }
        }
        
        // Pulizia dei dati e validazione del messaggio
        if (empty($_POST["message"])) {
          $messageErr = "Il messaggio è richiesto";
        } else {
          $message = trim($_POST["message"]);
        }
      
        // Se tutti i campi sono stati compilati correttamente, invia l'email
        if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
          // Destinatario dell'email
          $to = "martinellichiara944@gmail.com";
          // Soggetto dell'email
          $subject = "Nuovo messaggio dal form di contatto";
          // Corpo dell'email
          $email_body = "Nome: $name";
          $email_body .= "Email: $email";
          $email_body .= "Messaggio:$message";
          // Intestazioni per l'email
          $headers = "From: $email";
          $headers .= "Reply-To: $email";
      
          // Invia l'email
          mail($to, $subject, $email_body, $headers);
          
          // Messaggio di conferma
          if (mail($to, $subject, $email_body, $headers)) {
            // Reindirizzamento dopo l'invio dell'email
            header("Location: success.php");
            exit;
          } else {
            echo "Errore durante l'invio dell'email. Si prega di riprovare più tardi.";
          }
          
          // Resetta i valori del form
          $name = $email = $message = "";
        }
      }


    ?>

    <h2>Contattaci</h2>
    <form method="post" action="">
        <label for="name">Nome:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name;?>">
        <span class="error"><?php echo $nameErr;?></span>
        <br><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo $email;?>">
        <span class="error"><?php echo $emailErr;?></span>
        <br><br>
        <label for="message">Messaggio:</label><br>
        <textarea id="message" name="message" rows="5" cols="40"><?php echo $message;?></textarea>
        <span class="error"><?php echo $messageErr;?></span>
        <br><br>
        <button>Invia</button>
    </form>
</body>
</html>