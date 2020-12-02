<?php 
#ini_set('display_errors',0);
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajería v1.0</title>
    <style>
        body {
            margin: 0px;
            width: 1000px;
            height: 1000px;
        }
        main {
            height: 800px;
        }
        nav {
            width: 800px;
            height: 50px;
            margin: auto;
            margin-top: 10px;
        }
        section {
            width: 800px;
            margin: auto;
        }
        
        #textoNav {
            width: 25%;
            text-align: center;
            float: left;
        }
        #textoNav a{
            color: blue;
            text-decoration: none;
        }
        .link-button {
            background: none;
            border: none;
            color: blue;
            text-decoration: none;
            cursor: pointer;
            font-size: 1em;
            font-family: serif;
        }
        .link-button:focus {
            outline: none;
        }
        .link-button:active {
            color:red;
        }
        .tab {
            width: 800px;
        }
        .titTH {
            width: 800px;
        }
        .titTR {
            width: 800px;
        }
        .td {
            display: flex;
            align-items: center;
            border: 1px solid white;
            width: 250px;
            height: 50px;
            float: left;
            background-color: #cccccc;
        }
        .td span{
            vertical-align: middle;
        }
        .th {
            font-weight: bold;
            text-align: center;
            width: 250px;
            height: 20px;
            background-color: #427cc5;
            float: left;
        }
    </style>
    <script>
    function eliminar() {

    }
    </script>
</head>
<body>
    <header>
        <img src="images/logo.jpg">
    </header>
    <main>
        <nav>
            <div id="textoNav" style="text-align: left;">USUARIO: <span style="color:blue"><?php echo $_SESSION['login']; ?></span></div>
            <div id="textoNav"><a href="index.php">Mensajes Recibidos</a></div>
            <div id="textoNav" style="text-align: right;"><a href="index.php?accion=nueMen">Nuevo Mensaje</a></div>
            <div id="textoNav" style="text-align: right;"><form method="POST" action="procesa.php"><button type="submit" name="logout" value="logout" class="link-button">Desconectar</button></form></div>
        </nav>
        <section>
            <?php
                if (isset($_GET["accion"])) {

                } elseif (isset($_POST["accion"])) {
                    
                } else {
                    echo "<div class='tab'>
                    <div class='titTH'>
                        <div class='th'>Usuario</div>
                        <div class='th'>Asusto</div>
                        <div class='th'>Fecha</div>
                        <div class='th' style=\"width: 50px;\"></div>
                    </div>";
                    $dwes = new mysqli('localhost', 'root', 'toor', 'mensajeria');
                    $dwes->stmt_init();
                    $resultado = $dwes->prepare("SELECT m.id AS id, c.nombre AS nombre, m.asunto AS asunto, m.fecha AS fecha, m.leido AS leido FROM contactos c, mensajes m WHERE m.origen = c.login AND destino=?");
                    $resultado->bind_param('s',$_SESSION['login']);
                    $resultado->execute();
                    $resultado->bind_result($menId, $menNombre, $menAsunto, $menFecha, $menLeido);
                    while ($mensaje = $resultado->fetch()) {
                        echo ("<div class='titTR'><div class='td'><span>".$menNombre."</span></div>
                        <div class='td'><form method=\"POST\" action=\"index.php\"><input type='hidden' name='accion' value='leeMen'><button type=\"submit\" name=\"mensaje\" value=\"$menId\" class=\"link-button\">$menAsunto</button></form></div>
                        <div class='td'>".$menFecha."</div>
                        <div class='td' style='width: 42px;'></div></div>");
                    }
                    echo "</div>";
                }
            ?>
        </section>
    </main>
    <footer>
    </footer>
</body>
</html>