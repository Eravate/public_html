<?php
session_start();
ini_set('display_errors',0);
$dwes = new mysqli('localhost', 'root', 'toor', 'actividad');
$enviar = $_POST['enviar'];
$logout = $_GET['logout'];
# Si se envia una petición de cerrar sesión: 
if (isset($logout)) {
    session_destroy();
}
# Si se envia una petición del login para acceder al index: 
if (isset($enviar)) {
    $login = $_POST['login'];
    $clave = $_POST['clave'];
    $dwes->stmt_init();
    $resultado = $dwes->prepare("SELECT * FROM usuarios WHERE login=? && password=?");
    $resultado->bind_param('ss',$login,$clave);
    $resultado->execute();
    $resultado->store_result();
    $resultado->bind_result($loginR, $nombreR, $claveR);
    $rowcount = $resultado->num_rows;
    switch ($rowcount) {
      case 0:
        break;
      case 1:
        $resultado->fetch();
        $_SESSION['login'] = $loginR;
        break;
      default:
        echo "<h1 style='color:red;'>Error fatal, contacte con el administrador del sitio web</h1>";
        exit;
        break;
    }
}
# Si el login ha funcionado: 
if (isset($_SESSION['login'])) {
    header("Location: index.php");
} else {
  #si el login no ha funcionado
    header("Location: login.php");
}
?>