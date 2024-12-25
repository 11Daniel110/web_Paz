<?php
include('connect.php'); // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];

    // Subir la imagen
    $target_dir = "uploads/"; // Carpeta para guardar imágenes
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Validaciones de la imagen (puedes agregar más)
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }
    }

    // Mover la imagen al directorio de destino
    if ($uploadOk == 1 && move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO noticias (titulo, fecha, descripcion, imagen) VALUES (?, ?, ?, ?)";
        
        $stmt = $connect->prepare($sql);

        // Verificar si la preparación fue exitosa
        if ($stmt) {
            $stmt->bind_param("ssss", $titulo, $fecha, $descripcion, $target_file);

            if ($stmt->execute()) {
                echo "<script>alert('Noticia guardada correctamente.')</script>";
            } else {
                echo "<script>alert('Error al guardar la noticia:')</script> " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error en la preparación de la consulta:')</script> " . $connect->error;
        }
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
}

$connect->close();
?>

