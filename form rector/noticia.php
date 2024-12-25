<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <center>
    <form class="formulario" action="formrector.html" method="post" enctype="multipart/form-data">
        <h2>REDACTA TU NUEVA NOTICIA!</h2>
        <?php
            $fecha_actual = date("Y-m-d");
            echo $fecha_actual; 
        ?>
         
         <br>
         <br>
         <label>Ingrese su nombre: </label>
         <input type="text" placeholder="user" name="user">
         <br>
         <br>
         <label>Ingrese el titulo de la noticia: </label>
         <input type="text" placeholder="title" name="title">
         <br>
         <br><label>Ingrese el contenido de la noticia: </label>
      <textarea name="content" id="content" cols="30" rows="10"></textarea>
         <br>
         <br>
      
         <input type="submit" value="subir">
     </form>
    </center>
</body>
</html>