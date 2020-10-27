<?php
    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }

    ini_set('display_errors',0);
    date_default_timezone_set();
    $dia = date('Y-m-d');
    $com = $_POST['comentario'];
    $nom = $_POST['nombre'];
    $ema = $_POST['email'];

    $textRec = "$com^$nom^$ema^$dia";
    $text = "";
    $num = 0;
    if (file_exists("comentarios.txt")) {
        $idFich = fopen("comentarios.txt","r");
        while (!feof($idFich)) {
            $textRec = "*$com^$nom^$ema^$dia";
            $text .= fgets($idFich);
        }
    }
    $text .= $textRec;
    fclose($idFich);
    $idFich = fopen("comentarios.txt","w");
    fputs($idFich,$text);
    fclose($idFich);
    redirect("../ejercicioUD2_14.php");
?>