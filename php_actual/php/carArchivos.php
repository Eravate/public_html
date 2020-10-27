<?php
    function cargarDirs() {
        $d = dir("archivos");
        while (false !==  ($fichero=$d->read())) {
            if(is_dir("archivos/".$fichero) && $fichero!="." && $fichero!="..") {
                echo ("<li class='nav-item'><a class='nav-link' href='?fichero=".$fichero."'>".$fichero."</a></li>");
            }
        }
    }

    function cargarDirsSelect() {
        $d = dir("archivos");
        while (false !==  ($fichero=$d->read())) {
            if(is_dir("archivos/".$fichero) && $fichero!="." && $fichero!="..") {
                echo ("<option value=$fichero>$fichero</option>");
            }
        }
    }
    
    function cargarExes($directorio) {
        $d = dir("archivos/$directorio");
        while (false !==  ($fichero=$d->read())) {
            if(!is_dir("archivos/$directorio".$fichero) && $fichero!="." && $fichero!="..") {
                list($nom,$ext) = explode (".",strval($fichero));
                $nom = strtoupper($nom);
                echo ("<li style='font-size:20px;'><a href='archivos/$directorio/$fichero'>$nom</a></li>");
            }
            
        }
    }

    function busqExes($nombre) {
        $nombre = strtoupper($nombre);
        $d = dir("archivos");
        while (false !==  ($fichero=$d->read())) {
            if(is_dir("archivos/".$fichero) && $fichero!="." && $fichero!="..") {
                $dirInterno= dir("archivos/$fichero");
                while (false !== ($ficheroInterno=$dirInterno->read())) {
                    if(!is_dir("archivos/$fichero".$ficheroInterno) && $ficheroInterno!="." && $ficheroInterno!="..") {
                        list($nom,$ext) = explode (".",strval($ficheroInterno));
                        $nom = strtoupper($nom);
                        if (strpos($nom,$nombre) !== false) {
                            echo ("<li style='font-size:20px;'><a href='archivos/$fichero/$ficheroInterno'>$nom</a></li>");
                        }
                    }
                }
            }
        }
    }
    #$files = scandir('./archivos');
    #foreach($files as $file) {
    #    if (($file != "." && $file != "..") && is_dir($file)) {
    #        
    #    }
    #}
?>