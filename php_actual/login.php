<?php 
ini_set('display_errors',0);
session_start();
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
            width: 600px;
            margin: auto;
        }
        #contenido {
            margin-top: 25px;
            float: left;
            width: 33%;
        }
        #contenido input {
            width: 150px;
        }
        #contenido #entrar {
            width: 90px;
            background-color: #427cc5;
        }
        #footerForm {
            margin: 30px 30px;
        }
    </style>
</head>
<body>
    <header>
        <img src="images/logo.jpg">
    </header>
    <main>
        <form action="procesa.php" method="POST">
            <fieldset>
                <legend>Autentificación</legend>
                <div id="contenido">Login<br><input type="text" name="login"></div>
                <div id="contenido">Contraseña<br><input type="password" name="clave"></div>
                <div id="contenido"><br><input type="submit" id="entrar" name="entrar" value="Entrar"></div>
            </fieldset>
            <?php
                if (isset($_POST['login'])) {
                    echo "<p style='color:red;'>Error, compruebe que el usuario y la contraseña sean correctos</p>";
                }
            ?>
            <p id="footerForm"><strong>Nota:</strong> Si no dispone de identificación o tiene problemas para acceder, póngase en contacto con el <a href="#">administrador</a>.</p>
        </form>
    </main>
    <footer>
    </footer>
</body>
</html>