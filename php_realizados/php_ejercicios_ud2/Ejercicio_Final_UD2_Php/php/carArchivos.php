<?php
    #función para cargar las categorías
    function cargarDirs() {
        if (file_exists("archivos")) {
            $d = dir("archivos");
            while (false !==  ($fichero=$d->read())) {
                if(is_dir("archivos/".$fichero) && $fichero!="." && $fichero!="..") {
                    echo ("<li class='nav-item'><a class='nav-link' href='?fichero=".$fichero."'>".$fichero."</a></li>");
                }
            }
        } else {
            $old_umask = umask(0);
            mkdir("archivos",0777);
            umask($old_umask);
        }
        
    }

    #función para cargar las categorías del select
    function cargarDirsSelect() {
        $d = dir("archivos");
        while (false !==  ($fichero=$d->read())) {
            if(is_dir("archivos/".$fichero) && $fichero!="." && $fichero!="..") {
                echo ("<option value=$fichero>$fichero</option>");
            }
        }
    }
    
    #función para cargar los archivos de una categoría
    function cargarExes($directorio) {
        $d = dir("archivos/$directorio");
        while (false !==  ($fichero=$d->read())) {
            if(!is_dir("archivos/$directorio".$fichero) && $fichero!="." && $fichero!="..") {
                list($nom,$ext) = explode (".",strval($fichero));
                $nom = strtoupper($nom);
                echo ("<li style='font-size:20px;'><a href='archivos/$directorio/$fichero'>$nom</a><a href='index.php?eliminarArch=true&nombreArch=archivos/$directorio/$fichero'><div class='x xright'></div></a></li>");
            }
            
        }
    }

    #función para obtener resultados de un querry
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
                            echo ("<li style='font-size:20px;'><a href='archivos/$fichero/$ficheroInterno'>$nom</a><a href='index.php?eliminarArch=true&nombreArch=archivos/$fichero/$ficheroInterno'><div class='x xright'></div></a></li>");
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