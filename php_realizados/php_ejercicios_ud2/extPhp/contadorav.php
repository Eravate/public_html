<?php
    function contador() {
        $num = 0;
        if (file_exists("digitos/contador.txt")) {
            $idFich = fopen("digitos/contador.txt","r");
            $num = (int) fgets($idFich,256);
        }
        fclose($idFich);
        $num++;
        $numTxt = strval($num);
        $arrNumTxt = array_reverse(str_split($numTxt));
        $txtEcho = "";
        for ($i = 4;$i >= 0; $i--) {
            if ($i >= sizeof($arrNumTxt)) {
                $txtEcho .= "<img src='digitos/0.png' width='20' height='50'/>";
            } else {
                $value = $arrNumTxt[$i];
                $txtEcho .= "<img src='digitos/$value.png' width='20' height='50'/>";
            }
        }
        $idFich = fopen("digitos/contador.txt","w");
        fputs($idFich,$num);
        fclose($idFich);
    }
?>