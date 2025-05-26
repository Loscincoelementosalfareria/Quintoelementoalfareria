<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que PHPMailer esté instalado o incluido correctamente.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();                                      // Usar SMTP
        $mail->Host = 'smtp.hostinger.com';                   // Servidor SMTP de Hostinger
        $mail->SMTPAuth = true;                               // Habilitar autenticación SMTP
        $mail->Username = 'laezperanzacaicedonia@laprovinciaaldeascampestres.com';  // Correo de Hostinger
        $mail->Password = 'Laezperanza-2023';                       // Contraseña del correo de Hostinger
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Usar SSL/TLS
        $mail->Port = 465;                                    // Puerto SSL

        // Configuración del correo
        $mail->setFrom('laezperanzacaicedonia@laprovinciaaldeascampestres.com', 'La Esperanza'); // Remitente
        $mail->addAddress('laezperanzacaicedonia@gmail.com', 'Destinatario Esperanza');          // Destinatario
        $mail->addReplyTo($email, $full_name);               // Para que el destinatario pueda responder al correo del usuario

        // Contenido del mensaje
        $mail->isHTML(false);                                // Enviar en formato de texto plano
        $mail->Subject = "Nuevo mensaje de " . $name;   // Asunto del correo
        $mail->Body    = "Nombre completo: " . $name . "\n" .
                         "Correo electrónico: " . $email . "\n" .
                         "Mensaje:\n" . $subject;

        // Enviar el correo
        if ($mail->send()) {
            http_response_code(200); // Éxito
        } else {
            http_response_code(500); // Error
        }
    } catch (Exception $e) {
        http_response_code(500); // Error
    }
}
?>
