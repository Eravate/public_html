<!DOCTYPE html>
<html>
    <head><title>Ejercicio Formulario</title></head>
    <body>
        <?php 
            $nombre = $_GET['nombre'];
            $estudios = $_GET['estudios'];
            $civil = $_GET['civil'];
            $acepta = $_GET['acepta'];
            $dir = $_GET['dir'];
            
            $salir = false;

            echo("<h1>Bienvenido $nombre!</h1><img src='$dir' alt='Foto Perfil' width='100' height='100'/><p>Usted estudia: $estudios</p><p>Su estado civil es: $civil/a</p>");
        ?>
    </body>
</html>