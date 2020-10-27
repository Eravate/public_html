<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arkadiusz-Stefan Skawinski</title>
</head>
<body>
    <?php
        $d = dir(getcwd());
        echo "<strong>Directorio Actual:</strong><br/>".$d->path."<br/>";
        echo "<strong>Archivos:</strong><br/>";
        while(false!==($entrada=$d->read())) {
            echo $entrada."\n<br>";
        }
        $d->close();
    ?> 

</body>
</html>