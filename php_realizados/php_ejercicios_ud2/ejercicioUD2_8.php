<!DOCTYPE html>
<html>
<head>
    <title>PHP-Info</title>
</head>
<body>
    <a href="index.html">Volver</a> 
    <h1>Ejercicio 8</h1>
    <?php $mesPelicula = array("Enero" => 4, "Febrero" => 0, "Marzo" => 12, "Abril" => 18, "Mayo" => 7, "Junio" => 3, "Julio" => 0, "Agosto" => 11, "Septiembre" => 1, "Octubre" => 0, "Noviembre" => 19, "Diciembre" => 15);
    
    $cliente = array();
    $servidor = array();

    foreach($mesPelicula as $key=>$value) {
        if ($value!=0) {
            echo("El mes de ".$key." se han visto: ".$value." película/s<br>");
        }
    }
    ?> 
</body>
</html> 