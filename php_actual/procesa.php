<?php
session_start();
ini_set('display_errors',0);
$dwes = new mysqli('localhost', 'root', 'toor', 'mensajeria');
//$dwes = new mysqli('localhost', 'alumno', 'alumno', 'mensajeria');
$entrar = $_POST['entrar'];
$logout = $_POST['logout'];
if (isset($logout)) {
    session_destroy();
}
if (isset($_POST['enviarMensaje'])) {
  $dwes->stmt_init();
  $resultado = $dwes->prepare("INSERT INTO mensajes VALUES (0,?,?,?,?,CURRENT_TIMESTAMP(),'N')");
  $resultado->bind_param('ssss',$_POST['destino'],$_POST['origen'],$_POST['asunto'],$_POST['texto']);
  $resultado->execute();
}
if (isset($_POST['codMensaje'])) {
  $dwes->stmt_init();
  $resultado = $dwes->prepare("DELETE FROM mensajes WHERE id=?");
  $resultado->bind_param('i',$_POST['codMensaje']);
  $resultado->execute();
}
if (isset($entrar)) {
    $login = $_POST['login'];
    $clave = $_POST['clave'];
    $dwes->stmt_init();
    $resultado = $dwes->prepare("SELECT * FROM contactos WHERE login=? && password=?");
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
if (isset($_SESSION['login'])) {
    header("Location: index.php");
} else {
    //$_SESSION['login'] = 'login';
    //header("Location: login.php");
    echo ("<form id='form' action='login.php' method='post'><input type='hidden' name='login' value='login'></form><script>document.getElementById('form').submit();</script>");
}
?>