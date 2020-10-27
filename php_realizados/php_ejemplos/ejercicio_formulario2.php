<!DOCTYPE html>
<html>
    <head><title>Ejercicio Formulario</title></head>
    <body>
        <?php 
            $nombre = $_GET['nombre'];
            $estudios = $_GET['estudios'];
            $civil = $_GET['civil'];
            $acepta = $_GET['acepta'];
            
            $salir = false;

            $txt = "Le faltan estos datos por rellenar: ";
            if (!isset($nombre)) {
                $salir = true;
                $txt += $nombre + " ";
            }
        ?>
    </body>
</html>