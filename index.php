<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // SE creo la function invece che pulire i dati manualmente alla fine delle operazioni lo posso fare 
    // richiamando la function
    //     ES.
    // Pulizia dei dati e validazione del nome
    //   if (empty($_POST["name"])) {
    //     $nameErr = "Il nome è richiesto";
    //   } else {
    //     $name = clean_input($_POST["name"]);
    //   }


    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     // Pulizia dei dati e validazione del nome
    //     if (empty($_POST["name"])) {
    //       $nameErr = "Il nome è richiesto";
    //     } else {
    //       $name = trim($_POST["name"]);
    //     }
        
    //     // Pulizia dei dati e validazione dell'email
    //     if (empty($_POST["email"])) {
    //       $emailErr = "L'email è richiesta";
    //     } else {
    //       $email = trim($_POST["email"]);
    //       // Verifica se l'email è valida
    //       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //         $emailErr = "Formato email non valido";
    //       }
    //     }
        
    //     // Pulizia dei dati e validazione del messaggio
    //     if (empty($_POST["message"])) {
    //       $messageErr = "Il messaggio è richiesto";
    //     } else {
    //       $message = trim($_POST["message"]);
    //     }
      
    //     // Se tutti i campi sono stati compilati correttamente, invia l'email
    //     if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
    //       // Destinatario dell'email
    //       $to = "martinellichiara944@gmail.com";
    //       // Soggetto dell'email
    //       $subject = "Nuovo messaggio dal form di contatto";
    //       // Corpo dell'email
    //       $email_body = "Nome: $name";
    //       $email_body .= "Email: $email";
    //       $email_body .= "Messaggio:$message";
    //       // Intestazioni per l'email
    //       $headers = "From: $email";
    //       $headers .= "Reply-To: $email";
      
    //       // Invia l'email
    //       mail($to, $subject, $email_body, $headers);
          
    //       // Messaggio di conferma
    //       if (mail($to, $subject, $email_body, $headers)) {
    //         // Reindirizzamento dopo l'invio dell'email
    //         header("Location: success.php");
    //         exit;
    //       } else {
    //         echo "Errore durante l'invio dell'email. Si prega di riprovare più tardi.";
    //       }
          
    //       // Resetta i valori del form
    //       $name = $email = $message = "";
    //     }
    //   }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pulizia dei dati e validazione del nome
        if (empty($_POST["name"])) {
          $nameErr = "Il nome è richiesto";
        } else {
          $name = clean_input($_POST["name"]);
        }
        
        // Pulizia dei dati e validazione dell'email
        if (empty($_POST["email"])) {
          $emailErr = "L'email è richiesta";
        } else {
          $email = clean_input($_POST["email"]);
          // Verifica se l'email è valida
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato email non valido";
          }
        }
        
        // Pulizia dei dati e validazione del messaggio
        if (empty($_POST["message"])) {
          $messageErr = "Il messaggio è richiesto";
        } else {
          $message = clean_input($_POST["message"]);
        }
      
        if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
            session_start();
            $_SESSION['message'] = [
                'name' => $name,
                'email' => $email,
                'message' => $message
            ];
            
            // Reindirizzamento dopo l'invio del modulo
            header("Location: success.php");
            exit;
        }
      }
    ?>

<div class="container">
    <div class="row">
        <div class="m-4 col-6">
            <h1 class="text-center">Contattaci!</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group mb-2">
                        <label for="name" class="mb-1">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                        <span class="text-danger"><?php echo $nameErr; ?></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="mb-1">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                        <span class="text-danger"><?php echo $emailErr; ?></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="message" class="mb-1">Messaggio:</label>
                        <textarea class="form-control" id="message" name="message"><?php echo $message; ?></textarea>
                        <span class="text-danger"><?php echo $messageErr; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Invia</button>
                </form>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>