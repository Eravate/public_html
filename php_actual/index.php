<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Descargar Programas</title>
    <link rel="icon" href="images/exe.ico">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      a {
        clear: both;
        color: black;
        text-decoration: none; /* no underline */
      }
      .xright {
        float: right;
      }
      .x {
        position: relative;
        width: 27px;
        height: 27px;
        border: 2px solid #eef5df;
        background-color: #ff5248;
        border-radius: 50%;
      }
      .x::before, .x::after {
        position: absolute;
        top: 10px;
        left: 5px;
        width: 13px;
        height: 3px;
        content: "";
        background-color: #eef5df;
        display: none;
        }
      .x::before {
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        }
      .x::after {
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        }
      .x:hover { cursor: pointer; }
      .x:hover::before, .x:hover::after { display: block; }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="index.php">Programas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
        <?php ini_set('display_errors',0);
            include 'php/carArchivos.php';
            cargarDirs();
        ?>
        <!--<li class="nav-item">
            <a class="nav-link" href="#">Temp</a>
        </li>-->
    </ul>
    <form action="index.php" method="GET" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search" name="contenido">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Buscar" name="buscar"></input>
    </form>
  </div>
</nav>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
    <?php 
    #Cada variable corresponde a una diferente combinación de entradas de información GET y POST
    $fichero=$_GET['fichero'];
    $buscar=$_GET['buscar'];
    $enviarCat=$_GET['enviarCat'];
    $eliminarCat = $_GET['eliminarCat'];
    $enviarArch=$_POST['enviarArch'];
    $eliminarArch = $_GET['eliminarArch'];
    #Si la información viene mediante el GET de añadir Categoria
    if (isset($enviarCat)) {
      $nombreCat = $_GET['nombreCat'];
      $old_umask = umask(0);
      mkdir("archivos/$nombreCat",0777);
      umask($old_umask);
      header("Refresh:0; url=index.php");
    }
    #Si la información viene mediante el GET de eliminar Categoria
    if (isset($eliminarCat)) {
      $nombreCat = $_GET['nombreCat'];
      if (rmdir("archivos/$nombreCat")) {
        header("Refresh:0; url=index.php");
      } else {
        echo '<script>';
        echo 'alert("Error, esta categoría contiene archivos")';
        echo '</script>';
      }
    }
    #Si la información viene mediante el GET de eliminar Archivo
    if (isset($eliminarArch)) {
      $nombreArch = $_GET['nombreArch'];
      echo $nombreArch;
      unlink($nombreArch);
      header("Refresh:0; url=index.php");
    }
    #Si la información viene mediante el GET de añadir Archivo
    if (isset($enviarArch)) {
      $nombreArch = $_POST['nombreArch'];
      if ($nombreArch == "") {
          $error = "Error, no ha introducido nombre de archivo";
      } else {
        $categoriaArch = $_POST['categoriaArch'];
        if ($categoriaArch == "") {
          $error ="Error, eliga una categoría antes de subir el archivo";
        } else {
          $dir  = "archivos/$categoriaArch/";
          $dirfich = $dir . basename($_FILES["arch"]["name"]);
          $imageFileType = strtolower(pathinfo($dirfich,PATHINFO_EXTENSION));
          $uploadOk = 1;
          if($imageFileType != "exe" && $imageFileType != "gz" && $imageFileType != "rar" && $imageFileType != "zip") {
            $error = "Error, compruebe que el archivo sea un EXE, TAR.GZ, RAR o ZIP";
            $uploadOk = 0;
          }
          if ($imageFileType == "gz") {
            $nombreArch .= ".tar";
          }
          $old_umask = umask(0);
          if ($uploadOk==1 && move_uploaded_file($_FILES["arch"]["tmp_name"], $dir.$nombreArch.".".$imageFileType)) {
            $error = "Archivo Subido";
          } 
          umask($old_umask);
        }
      }
    }
    #Resultado de busqueda
    if (isset($buscar)) {
      $contenido=$_GET['contenido'];
        echo ("<h1>Resultado de la querry '$contenido': </h1><br><br>");
        echo ("<ul>");
        busqExes($contenido);
        echo ("</ul>");
    } else if (isset($fichero)) {
      #Si la información es de una categoria | el contenido de una categoría
      echo ("<h1>Archivos a descargar en ".$fichero.": </h1><a href='index.php?eliminarCat=true&nombreCat=$fichero'><div class='x'></div></a><br><br>");
      echo ("<ul>");
        cargarExes($fichero);
      echo ("</ul>");
    } else {
      #Si la información tiene que ser la por defecto
      echo ("<h1 class='display-3'>Bienvenido!</h1><p>Aquí puede descargar todos los programas que considere necesarios, desde el servidor local!</p><p>Las carpetas de las categorías se crean en: archivos.</p>");
      echo ("<br><h2>Crear nueva categoría</h2>");
      echo ("<p>Desea crear una nueva categoría? rellena el siguiente formulario:");
      echo ("<form method='GET'>Nombre Categoría: <input type='text' name='nombreCat' id='nombreCat'> <input type='submit' name='enviarCat' value='Enviar'></form>");
      echo ("<br><br><h2>Subir un Archivo</h2>");
      echo ("<p>Quieres que tengamos un archivo en local? rellena el siguiente formulario:");
      echo ("<form  enctype='multipart/form-data' method='POST'>Nombre Archivo: <input type='text' name='nombreArch' id='nombreArch'><br><br>Categoria: <select name='categoriaArch'>");
      cargarDirsSelect();
      echo ("</select><br><br>Archivo: <input type='file' id='arch' name='arch'><br><br><input type='submit' name='enviarArch' value='Enviar'> ");
      if (isset($error)) {
        echo($error);
      }
      echo ("</form>");
    }
    
    
    ?>
      
    </div>
  </div>

  <!--<div class="container">

    <div class="row">
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div>
    </div>

    <hr>

  </div>  /container -->

</main>

<footer class="container">
  <p>&copy; Arkadiusz-Stefan Skawinski 2020-2021</p>
</footer>
<script src="js/jquery.slim.min.js"></script>
<script src="js/boostrap.bundle.min.js"></script></body>
</html>