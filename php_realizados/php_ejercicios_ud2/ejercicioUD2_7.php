<!DOCTYPE html>
<html>
<head>
    <title>PHP-Info</title>
</head>
<body>
    <a href="index.html">Volver</a> 
    <h1>Ejercicio 7</h1>
    <?php
    ini_set('display_errors',0);
        $numPares = array();
        for ($i=2;$i<51;$i=$i+2) {
            array_push($numPares, $i);
        }
        ?>

    <form action="ejercicioUD2_7.php" method="get"> 
        Número: <input name="numero7" value=""/>
        <input type="submit" value="Enviar" name="Enviar" id="enviar"/>
    </form>
    <p/>

    <table style="border:1px solid black;border-collapse:collapse;"> 
    <tr>
    <?php
    $numDiv = (int) $_GET['numero7'];
    ?>
    <?php 
    for ($i=1;$i<26;$i++) {
        $num = $i - 1;
        if ($numPares[$num]%$numDiv==0) {
            $color = "blue";
        } else {
            $color = "red";
        }
        echo ("<td style='border:1px solid black;color:$color;'> $numPares[$num] </td>");
        if (($i%5==0 && $i!=25) && $i!=1) {
            echo ("</tr><tr>");
        } else if ($i==25) {
            echo ("</tr");
        }
    } 
    ?>
    </table>
</body>
</html> 