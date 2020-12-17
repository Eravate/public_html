<?php 
ini_set('display_errors',0);
session_start();
# Si la sesion no existe, me redirige al login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
$dwes = new mysqli('localhost', 'root', 'toor', 'actividad');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos Disponibles</title>
    <style>
        main {
            margin-left: 50px;
        }
        main h1 {
            margin-bottom: 50px;
        }
        main ol {
            margin-left: 10px;
            padding-inline-start: 0px;
        }
    </style>
</head>
<body>
    <?php 
        # Muestra la página de las actividades y redirige a la página de resultados
        if (isset($_GET['actividad'])) {
            $actividad = $_GET['actividad'];
            echo "<main><h1 style='margin-bottom:15px;'>Nuestra Petición</h1>";
            $dwes->stmt_init();
            $resultado = $dwes->prepare("SELECT titulo FROM actividad WHERE id_actividad=?");
            $resultado->bind_param("i",$actividad);
            $resultado->execute();
            $resultado->bind_result($tituloActividad);
            $resultado->fetch();
            echo "<p>$tituloActividad</p>";
            $dwes->close();
            $dwes = new mysqli('localhost', 'root', 'toor', 'actividad');
            $dwes->stmt_init();
            $resultado = $dwes->prepare("SELECT id_peticion, opcion FROM peticiones WHERE id_actividad=?");
            $resultado->bind_param("i",$actividad);
            $resultado->execute();
            $resultado->bind_result($idPeticion, $tituloPeticion);
            echo "<form action='index.php?actividad=$actividad' method='POST'>";
            echo "<input type='hidden' name='actividad' value='$actividad'>";
            while ($resultado->fetch()) {
                echo "<input type='radio' name='peticion' value='$idPeticion'>$tituloPeticion</input><br>";
            }
            $dwes->close();
            # Si se genera una petición de voto, este código se ejecuta: 
            if (isset($_POST['envPeticion'])) {
                $dwes = new mysqli('localhost', 'root', 'toor', 'actividad');
                $dwes->stmt_init();
                $resultado = $dwes->prepare("SELECT numero_peticiones FROM peticiones WHERE id_actividad=? AND id_peticion=?");
                $resultado->bind_param("ii",$actividad,$_POST['peticion']);
                $resultado->execute();
                $resultado->bind_result($numPeticiones);
                $resultado->fetch();
                $numPeticiones++;
                $dwes->close();
                $dwes = new mysqli('localhost', 'root', 'toor', 'actividad');
                $dwes->stmt_init();
                $resultado = $dwes->prepare("UPDATE peticiones SET numero_peticiones=? WHERE id_actividad=? AND id_peticion=?");
                $resultado->bind_param("iii",$numPeticiones,$actividad,$_POST['peticion']);
                $resultado->execute();
                echo "<br><p>Gracias por hacernos llegar tu respuesta.</p><p><a href='index.php?resultado=$actividad'>Ver los resultados de inscripciones a cursos</a></p>";
            } else {
                echo "<input type='submit' name='envPeticion' value='Enviar Petición'>";
            }
            echo "<p><a href='procesa.php?logout=true'>Salir/Cerrar Sesión</a></p>";
            echo "</form></main>";
            # Muestra la página de resultados
        } elseif (isset($_GET['resultado'])) {
            $actividad = $_GET['resultado'];
            echo "<main><h1 style='margin-bottom:15px;'>Nuestra Petición</h1>";
            $dwes->stmt_init();
            $resultado = $dwes->prepare("SELECT titulo FROM actividad WHERE id_actividad=?");
            $resultado->bind_param("i",$actividad);
            $resultado->execute();
            $resultado->bind_result($tituloActividad);
            $resultado->fetch();
            echo "<p>$tituloActividad</p>";
            $dwes->close();
            # Realizo esta llamada a BBDD para obtener la cantidad total de votos: 
            $dwes = new mysqli('localhost', 'root', 'toor', 'actividad');
            $dwes->stmt_init();
            $resultado = $dwes->prepare("SELECT numero_peticiones FROM peticiones WHERE id_actividad=?");
            $resultado->bind_param("i",$actividad);
            $resultado->execute();
            $resultado->bind_result($numPeticiones);
            while ($resultado->fetch()) {
                $totNumPeticiones += $numPeticiones;
            }
            $dwes->close();
            # Y esta para imprimir los porcentajes:
            echo "<p style='margin-block-end:0em'>Hasta ahora, $totNumPeticiones participantes se han inscrito.</p>";
            echo "<p style='margin-block-start:0em'>Este es el resultado provisional: </p>";
            $dwes = new mysqli('localhost', 'root', 'toor', 'actividad');
            $dwes->stmt_init();
            $resultado = $dwes->prepare("SELECT numero_peticiones, opcion FROM peticiones WHERE id_actividad=?");
            $resultado->bind_param("i",$actividad);
            $resultado->execute();
            $resultado->bind_result($numPeticiones, $tituloPeticion);
            while ($resultado->fetch()) {
                $longPix = round(($numPeticiones / $totNumPeticiones) * 100);
                echo "<div style='height:18px;'><div style='width: 150px; float:left; height: 18px;'>Opcion ($tituloPeticion)</div><div style='width: ".$longPix."px;background-color: blue; height: 18px; float:left;'></div><p>&nbsp;".$longPix."%</p></div>";
            }
            echo "<p><a href='procesa.php?logout=true'>Salir/Cerrar Sesión</a></p>";
            $dwes->close();
            # Esta es la página principal por defecto: 
        } else {
            echo "<main><h1>Actividades</h1>";
            echo "<ol>";
            $dwes->stmt_init();
            $resultado = $dwes->prepare("SELECT id_actividad, titulo FROM actividad");
            $resultado->execute();
            $resultado->bind_result($idActividad, $tituloActividad);
            while ($resultado->fetch()) {
                echo "<li><a href='index.php?actividad=$idActividad'>$tituloActividad</a></li>";
            }
            echo "</ol></main>";
            echo "<p><a href='procesa.php?logout=true'>Salir/Cerrar Sesión</a></p>";
            $dwes->close();
        }
    ?>

</body>
</html>