<!DOCTYPE html>
<html>
<head>
    <title>PHP-Info</title>
</head>
<body>
    <a href="index.html">Volver</a> 
    <h1>Ejercicio 6</h1>

    <form action="ejercicioUD2_6.php" method="get"> 
        Número: <input name="numero6" value=""/>
        <input type="submit" value="Enviar" name="Enviar" id="enviar"/>
    </form>

    <?php
    ini_set('display_errors',0);
    $num = (int) $_GET['numero6'];
    if ($num %2==0) {
        $color = "blue";
    } else {
        $color = "red";
    }?>
    <p style=<?php echo("\"color:$color;\"");?>><?php echo($num)?></p> 
</body>
</html> 