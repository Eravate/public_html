<!DOCTYPE html>
<html>
    <head><title>Ejercicio Formulario</title></head>
    <body>
        <?php 
        ini_set('display_errors',0);
        function Redirecionar($url) {
            $permanent = false;
            if (headers_sent() === false)
            {
                header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
            }

            exit();
        }   
        ?>
        <form action="ejercicio_formulario.php" method="POST" enctype="multipart/form-data">
            Nombre: <input type="text" name="nombre" id="nombre" value="<?php $nombre = $_POST['nombre']; if (isset($nombre) && !empty($nombre)){echo("$nombre");}?>"/><br/><br/>
            Estudios: 
            <select name="estudios">
                <option value="DWES" <?php $estudios = $_POST['estudios']; if ($estudios == "DWES"){ echo("selected=''");}?>>Desarrollo Web en Entorno Servidor</option>
                <option value="DWEC" <?php $estudios = $_POST['estudios']; if ($estudios == "DWEC") {echo("selected=''");}?>>Desarrollo Web en Entorno Cliente</option>
                <option value="DAW" <?php $estudios = $_POST['estudios']; if ($estudios == "DAW") {echo("selected=''");}?>>Despliegue de Aplicaciones Web</option>
                <option value="DIW" <?php $estudios = $_POST['estudios']; if ($estudios == "DIW") {echo("selected=''");}?>>Diseño de interfaces Web</option>
            </select><br/><br/>
            <input type="radio" id="casado" name="civil" value="casado" <?php  $civil = $_POST['civil']; if ($civil == "casado"){ echo("checked");}?>> Casado/a
            <input type="radio" id="soltero" name="civil" value="soltero" <?php  $civil = $_POST['civil']; if ($civil == "soltero"){ echo("checked");}?>> Soltero/a
            <input type="radio" id="viudo" name="civil" value="viudo" <?php  $civil = $_POST['civil']; if ($civil == "viudo"){ echo("checked");}?>> Viudo/a <br/><br/>
            Imagen perfil: <input type="file" id="img" name="img"/><br><br>
            <input type="checkbox" id="acepta" name="acepta" <?php $acepta = $_POST['acepta']; if (isset($acepta)){ echo("checked");}?>/>Acepto las condiciones de uso<br/><br/>
            <input type="submit" name="enviar" value="Enviar"/>
        </form>
        <?php
           if($_SERVER['REQUEST_METHOD']=='POST')
           {
                $nombre = $_POST['nombre'];
                $estudios = $_POST['estudios'];
                $civil = $_POST['civil'];
                $acepta = $_POST['acepta'];

                $salir = false;

                $txt = "<br>Le faltan estos datos por rellenar: ";
                if (!isset($nombre) || empty($nombre)) {
                    $salir = true;
                    $txt .= "Nombre; ";
                }
                if (!isset($estudios) || empty($estudios)) {
                    $salir = true;
                    $txt .= "Estudios; ";
                }
                if (!isset($civil) || empty($civil)) {
                    $salir = true;
                    $txt .= "Civil; ";
                }
                if (!isset($acepta) || empty($acepta)) {
                    $salir = true;
                    $txt .= "Aceptar; ";
                }

                if ($salir==false) {
                    $milliseconds = round(microtime(true) * 1000);
                    $dir  = '/home/alumnodaw/public_html/php_ejercicios_ud2/images/';
                    $dirfich = $dir . basename($_FILES["img"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($dirfich,PATHINFO_EXTENSION));
                    $txtMilli = strval($milliseconds).'.'.$imageFileType;
                    if (file_exists($dirfich)) {
                        $uploadOk = 0;
                    }
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        $uploadOk = 0;
                    }
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $dir.$txtMilli)) {
                            Redirecionar("ejercicio_formulario2.php?nombre=$nombre&estudios=$estudios&civil=$civil&acepta=$acepta&dir=images/$txtMilli&enviar=Enviar");
                    } else {
                            echo "Error al subir archivo";
                    }
                    
                } else {
                    echo ($txt);
                }
           } 
        ?>
    </body>
</html>