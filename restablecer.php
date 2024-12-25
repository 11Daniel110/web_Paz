<?php
include('connect.php'); // Ajusta la ruta si es necesario
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // Import the SMTP class

require 'vendor/autoload.php'; // Incluir el autocargador de Composer
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <?php
    // Verificar si se recibe un token en la URL
    if (isset($_GET['token'])) {
        $token = $_GET['token'];

        // Buscar al usuario con el token en la base de datos
        $sql = "SELECT * FROM user WHERE token = '$token'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            // El token es válido, mostrar el formulario de nueva contraseña
            ?>
            <center>
            <h2>Nueva contraseña</h2>
            <form method="post" action="nueva_contrasena.php">
                <div id="nueva_contrasena"></div>
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="password" name="password" placeholder="Nueva contraseña" required>
                <button type="submit">Cambiar contraseña</button>
            </form>
            </center>
            <?php
        } else {
            echo "Token inválido o expirado.";
        }
    } 
    // Mostrar el formulario de recuperación si no hay token
    elseif (!isset($_GET['token'])) { 
        // Verificar si se ha enviado el formulario y si el email está presente
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];

            // Buscar al usuario en la base de datos
            $consulta= mysqli_query($connect, "SELECT * FROM user WHERE email='$email'") or die("Problemas en el select:".mysqli_error($connect));

            if (mysqli_num_rows($consulta) > 0) {
                // Generar un token aleatorio
                $token = bin2hex(random_bytes(32));

                // Almacenar el token en la base de datos 
                $sql = "UPDATE user SET token = '$token' WHERE email = '$email'";
                $connect->query($sql);
                $fila = mysqli_fetch_row($consulta);
                $name = $fila[1];
                $second_name = $fila[2];
                $apell = $fila[3];
                $second_apell = $fila[4];

                // Enviar correo con el enlace de restablecimiento
                $link = "http://localhost/web_la_paz/restablecer.php?token=" . $token; // Corregir la ruta

                // Crear un nuevo objeto PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor SMTP para Gmail
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  
                    $mail->SMTPAuth = true;
                    $mail->Username = 'institucioneducativalapaz6@gmail.com'; // Tu correo electrónico completo de Gmail
                    $mail->Password = 'iqwi jwky oyfr palr';     // Tu contraseña de Gmail o contraseña de aplicación
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                    $mail->Port = 587; 

                    // Remitente
                    $mail->setFrom('institucioneducativalapaz6@gmail.com', 'Web La Paz');

                    // Destinatario
                    $mail->addAddress($email);

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = utf8_decode('Restablecer contraseña');
                    $mail->Body = "Hola ".$name." ".$second_name." ".$apell." ".$second_apell.",<br><br>Para restablecer tu contraseña, haz clic en el siguiente enlace:<br><br><a href='$link'>$link</a>";
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                    $mail->send();
                    echo "<script type=\"text/javascript\">alert('Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña. Revisa tu bandeja de entrada.'); </script>";
                } catch (Exception $e) {
                    echo "No se pudo enviar el correo electrónico. Error: {$mail->ErrorInfo}";
                }

            } else {
                echo "No se encontró ningún usuario con ese correo electrónico.";
            }
        } 
        ?>
        <center>
        <h2>Recuperar contraseña</h2>
        <form method="post" action="restablecer.php"> <div id="recuperar_contrasena"> </div>
            <input type="email" name="email" placeholder="Tu correo electrónico" required>
            <br> <br>
            <button type="submit">Enviar</button>
        </form>
        </center>
        <?php
    }

    $connect->close();
    ?>

</body>
</html>


