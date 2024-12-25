<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <style>
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: black;
        font-family: Arial, sans-serif;

    }
    .columns {
        display: flex;
    }
    .column {
        flex: 1;
        flex-direction: column;
    }
    .main-column {
        flex: 2;
    }

    html {
  background: mediumseagreen;
  font-family: sans-serif;
  font-size: 14px;
}

a {
  text-decoration: none;
}

div, h2, p, figure {
  margin: 0;
  padding: 0;
}

.main {
  margin: 0 auto;
  max-width: 500px;
  padding: 20px;
}

.columns {
  display: flex;
}

.column {
  display: flex;
  flex: 1;
  flex-direction: column;
}

.main-column {
  flex: 3;
}

.nested-column {
  flex: 2;
}

.article {
  background: white;
  color: #666;
  display: flex;
  flex: 1;
  flex-direction: column;
  flex-basis: auto;
  margin: 10px;
}

.article-image {
  background: #eee;
  display: block;
  padding-top: 75%;
  position: relative;
  width: 100%;
}

.article-image img {
  display: block;
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

.article-image.is-3by2 {
  padding-top: 66.6666%;
}

.article-image.is-16by9 {
  padding-top: 56.25%;
}

.article-body {
  display: flex;
  flex: 1;
  flex-direction: column;
  padding: 20px;
}

.article-title {
  color: #333;
  flex-shrink: 0;
  font-size: 1.4em;
  font-weight: bold;
  font-weight: 700;
  line-height: 1.2;
}

.article-content {
  flex: 1;
  margin-top: 5px;
}

.article-info {
  display: flex;
  font-size: 0.85em;
  justify-content: space-between;
  margin-top: 10px;
}

.first-article {
  flex-direction: row;
}

.first-article .article-body {
  flex: 1;
}

.first-article .article-image {
  height: 300px;
  order: 2;
  padding-top: 0;
  width: 400px;
}
@media screen and (min-width: 1000px) {
  .first-article {
    flex-direction: row;
  }
  .first-article .article-body {
    flex: 1;
  }
  .first-article .article-image {
    height: 300px;
    order: 2;
    padding-top: 0;
    width: 400px;
  }
  .main-column {
    flex: 3;
  }
  .nested-column {
    flex: 2;
  }
}
   
    </style>
</head>
<body>
 
    <h1>Noticias</h1>
    <?php
    include('connect.php'); // Incluir el archivo de conexión

    $sql = "SELECT * FROM noticias ORDER BY fecha DESC";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo"<div class='columns'>";
            echo"<div class='column main-column'>";
            echo"<article class='article'>";
            echo"<a class='article first-article'>";
            echo"<figure class='article-image'>";
            echo"<img src='" . $row["imagen"] . "' alt='" . "'>";
            echo"</figure>";
            echo"<div class='article-body'>";
            echo"<h2 class='article-title'>" . $row["titulo"] . "</h2>";
            echo"<p class='article-content'>" . $row["descripcion"] . "</p>";;
            echo"<footer class='article-info'>" . $row["fecha"] . "</footer>";
            echo"</div>";
            echo"</a>";
            echo"</article>";
            echo"</div>";
            
            
        }
    } else {
        echo "No hay noticias disponibles.";
    }

    $connect->close();
    ?>
</body>
</html>

  
