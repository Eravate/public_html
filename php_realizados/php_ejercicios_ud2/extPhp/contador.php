<?php
    function contador() {
        $num = 0;
        if (file_exists("digitos/contador.txt")) {
            $idFich = fopen("digitos/contador.txt","r");
            $num = (int) fgets($idFich,256);
        }
        fclose($idFich);
        $num++;
        $idFich = fopen("digitos/contador.txt","w");
        fputs($idFich,$num);
        fclose($idFich);
    }
?>