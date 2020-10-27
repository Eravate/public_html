<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arkadiusz-Stefan Skawinski</title>
</head>
<body>
    <h1>Hola mundo</h1>
    <p>Página de prueba</p>
    
    <?php
        $n = $_GET['numero'];
        $nFact = $n;
        if ($n < 0) {
            echo ("<p>No existe factorial de un número negativo</p>");
        } elseif ($n == 0) {
            echo ("1");
        } else {
            for ($i=$n-1;$i>0;$i--) {
                $nFact *= $i;
            }
            echo ($nFact);
        }
    ?> 

</body>
</html>