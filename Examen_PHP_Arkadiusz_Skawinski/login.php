<?php 
ini_set('display_errors',0);
session_start();
# Si la sesion ya existe, me vuelve al index
if (isset($_SESSION['login'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Mensajería</title>
    <style>
        body {
            margin: 0px;
            width: 1000px;
            height: 1000px;
        }
        main {
            margin-top: 20px;
        }
        form {
            width: 650px;
            margin: auto;
        }
        fieldset {
            padding: 40px;
        }
        #contenido {
            float: left;
        }
        #contenido input {
            width: 150px;
        }
        #contenido #enviar {
            width: 90px;
        }
    </style>
</head>
<body>
    <main>
        <form action="procesa.php" method="POST">
        <h1>AUTENTIFICACIÓN</h1>
            <fieldset>
                <div id="contenido">Login: <input type="text" name="login">&nbsp;</div>
                <div id="contenido">Contraseña: <input type="password" name="clave">&nbsp;</div>
                <div id="contenido"><input type="submit" id="enviar" name="enviar" value="Enviar"></div>
            </fieldset>
        </form>
    </main>
</body>
</html>