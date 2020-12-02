<?php 
ini_set('display_errors',0);
session_start();
$login = $_POST['enviar'];
if (isset($login)) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $dwes = new mysqli('localhost', 'root', 'toor', 'jardineria');
    $dwes->stmt_init();
    $resultado = $dwes->prepare("SELECT * FROM usuarios WHERE nombreUsuario=? && clave=?");
    $resultado->bind_param('ss',$usuario,$clave);
    $resultado->execute();
    $resultado->store_result();
    $resultado->bind_result($usuarioF, $claveF);
    $rowcount = $resultado->num_rows;
    switch ($rowcount) {
      case 0:
        break;
      case 1:
        $_SESSION['usuario'] = $usuario;
        break;
      default:
        echo "<h1 style='color:red;'>Error fatal, contacte con el administrador del sitio web</h1>";
        exit;
        break;
    }
}
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
} else {
    //$_SESSION['login'] = 'login';
    //header("Location: login.php");
    echo ("<form id='form' action='login.php' method='post'><input type='hidden' name='login' value='login'></form><script>document.getElementById('form').submit();</script>");
}
?>