<!DOCTYPE html>
<html>
<head>
    <title>PHP-Info</title>
</head>
<body>
    <a href="index.html">Volver</a> 
    <h1>Ejercicio 9</h1>
    <?php 
    $cliente = array("JS" => "Java Script", "VB" => "Visual Basic Script");
    $servidor = array("PHP" => "Hypertext Pre-processor", "JSP" => "Java Server Pages");
    echo "<table style='text-align:center;border-collapse:collapse;'><tr><td colspan=2 style='padding:2px;border:1px solid black;'>LENGUAJES DE PROGRAMACIÓN</td></tr>";
    foreach($cliente as $key=>$value) { 
        echo("<tr><td style='padding:2px;border:1px solid black;color:blue;'>".$key."</td><td style='padding:2px;border:1px solid black;color:blue;'>".$value."</td></tr>");
    }
    foreach($servidor as $key=>$value) {
        echo("<tr><td style='padding:2px;border:1px solid black;color:green;'>".$key."</td><td style='padding:2px;border:1px solid black;color:green;'>".$value."</td></tr>");
    }
    echo("<p>color azul = cliente, color verde = servidor");
    ?>
</body>
</html> 