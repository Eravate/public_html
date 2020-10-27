<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arkadiusz-Stefan Skawinski</title>
</head>
<body>
    <h1>Hola mundo</h1>
    
    <?php
        function precio_con_iva($precio) {
            $precio_iva = $precio * 1.18;
            return $precio_iva;
        }
        $precio = 10;
            
        $precio_coniva = precio_con_iva($precio); // Aquí ya no da error 
        echo($precio_coniva);
    ?> 

</body>
</html>