<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "El script que se está ejecutando es: ".$_SERVER['PHP_SELF'];
        echo "<br/>La dirección IP del servidor es: ".$_SERVER['SERVER_ADDR'];
        echo "<br/>Tú dirección IP es: ".$_SERVER['REMOTE_ADDR'];
    ?>
</body>
</html>