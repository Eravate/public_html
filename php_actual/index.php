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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
    <link href="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    function verificar(menId) {
        return confirm("Estás seguro? Es una acción irreversible");
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
                    echo "<form action='procesa.php' method='POST'><input type='hidden' name='origen' value='".$_SESSION['login']."'>";
                    echo "<div style='width:80px;justify-content:flex-end;display:inline-flex'>Para:&nbsp;</div><select id=\"editable-select\" name='destino'>";
                    $dwes = new mysqli('localhost', 'root', 'toor', 'mensajeria');
                    //$dwes = new mysqli('localhost', 'alumno', 'alumno', 'mensajeria');
                    $dwes->stmt_init();
                    $resultado = $dwes->prepare("SELECT login FROM contactos");
                    $resultado->execute();
                    $resultado->bind_result($loginRec);if (
                    while ($resultado->fetch()) {
                        echo "<option value='$loginRec'>$loginRec</option>";
                    }
                    echo "</select><br><br>";
                    echo "<div style='width:80px;justify-content:flex-end;display:inline-flex'>Asunto:&nbsp;</div><input style='width:500px'type='text' name='asunto'><br><br>";
                    echo "<div style='width:80px;justify-content:flex-end;display:inline-flex;'>&nbsp;</div><textarea style='width:500px; height:300px;' name='texto' placeholder='Escribe...'></textarea>";
                    echo "<div style='width:580px;margin-top:50px;justify-content:flex-end;display:inline-flex;'><input style='background-color:#427cc5;'type='submit' name='enviarMensaje' value='Enviar'></div>";
                    echo "</form>";
                } elseif (isset($_POST["accion"])) {
                    $dwes = new mysqli('localhost', 'root', 'toor', 'mensajeria');
                    //$dwes = new mysqli('localhost', 'alumno', 'alumno', 'mensajeria');
                    if ($_POST['menLeido']=="N") {
                        $dwes->stmt_init();
                        $resultado = $dwes->prepare("UPDATE mensajes SET leido='S' WHERE id=?");
                        $resultado->bind_param('s',$_POST['mensaje']);
                        $resultado->execute();
                    }
                    $dwes->stmt_init();
                    $resultado = $dwes->prepare("SELECT origen, asunto, texto, fecha FROM mensajes WHERE id = ?");
                    $resultado->bind_param('s',$_POST['mensaje']);
                    $resultado->execute();
                    $resultado->bind_result($origen, $asunto, $texto, $fecha);
                    $resultado->fetch();
                    echo "<p><span style='color:#427cc5;font-weight:bold;'>Asunto: </span>$asunto</p>";
                    echo "<p><span style='color:#427cc5;font-weight:bold;'>De: </span>$origen</p>";
                    echo "<p><span style='color:#427cc5;font-weight:bold;'>Recibido: </span>$fecha</p>";
                    echo "<div style='width:800px;height:400px;border:1px solid black;padding:10px;'>$texto</div>";
                } else {
                    echo "<div class='tab'>
                    <div class='titTH'>
                        <div class='th'>Usuario</div>
                        <div class='th'>Asusto</div>
                        <div class='th'>Fecha</div>
                        <div class='th' style=\"width: 50px;\"></div>
                    </div>";
                    $dwes = new mysqli('localhost', 'root', 'toor', 'mensajeria');
                    //$dwes = new mysqli('localhost', 'alumno', 'alumno', 'mensajeria');
                    $dwes->stmt_init();
                    $resultado = $dwes->prepare("SELECT m.id AS id, c.nombre AS nombre, m.asunto AS asunto, m.fecha AS fecha, m.leido AS leido FROM contactos c, mensajes m WHERE m.origen = c.login AND destino=? ORDER BY fecha desc, nombre asc");
                    $resultado->bind_param('s',$_SESSION['login']);
                    $resultado->execute();
                    $resultado->bind_result($menId, $menNombre, $menAsunto, $menFecha, $menLeido);
                    while ($resultado->fetch()) {
                        echo "<div class='titTR'><div class='td'><span>".$menNombre."</span></div>
                        <div class='td'><form method=\"POST\" action=\"index.php\"><input type='hidden' name='accion' value='leeMen'><input type='hidden' name='menLeido' value='$menLeido'><button type=\"submit\" name=\"mensaje\" value=\"$menId\" class=\"link-button\"";
                        if($menLeido=="N") {
                            echo "style='color:red'";
                        }
                        echo ">$menAsunto</button></form></div>
                        <div class='td'>".$menFecha."</div>
                        <div class='td' style='width: 42px;justify-content:center;'><form method=\"POST\" action='procesa.php'><input type='hidden' id='$menId' name='codMensaje' value='$menId'><input type='image' src='images/borrar.png' onclick='return verificar($menId);'></form></div></div>";
                    }
                    echo "</div>";
                }
            ?>
        </section>
    </main>
    <script>
    $('#editable-select').editableSelect();
    </script>
    <footer>
    </footer>
</body>
</html>