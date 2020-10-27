<?php
    function cargarCom() {
        ini_set('display_errors',0);
        $text = "";
        if (file_exists("extPhp/comentarios.txt")) {
            $idFich = fopen("extPhp/comentarios.txt","r");
            while (!feof($idFich)) {
                $text .= fgets($idFich,256);
            }
        }
        fclose($idFich);
        return $text;
    }
?>