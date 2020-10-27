<html>
<head>
    <style>
        .rojo {
            background-color: red; 
            width: 18px; 
            height: 30px;
            float: left;
            margin-bottom: 0px;
        }
        .verde {
            background-color: green; 
            width: 13px; 
            height: 25px;
            float: left;
        }
        h1 {
            margin-left: 23px;
            margin-top: 5px;
            font-size: 26px;
            margin-bottom: 0px;
        }
        h2 {
            margin-left: 18px;
            margin-top: 5px;
            font-size: 20px;
        }
        .barra {
            width: 100%;
            height: 1px;
            margin-bottom: 0px;
        }
        textarea {
            resize: none;
        }
        p {
            font-size: 17px;
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
    <?php ini_set('display_errors',0);
        include 'extPhp/libroVisCar.php';
        $text = cargarCom();
        $textUs = explode ("*",$text);
    ?>
    <div class="rojo"></div>
    <div class="barra rojo"></div>
    <h1>Libro de visitas sencillo</h1><br>
    <form action="extPhp/libroVisAn.php" method="post">
        <p>Sus comentarios:</p>
        <textarea name="comentario" id="comentario" rows="4" cols="50"></textarea>
        <p>Su nombre:</p>
        <input type="text" name="nombre" id="nombre"/>
        <p>Su email:</p>
        <input type="email" id="email" name="email"/> <input type="submit" id="publicar" name="publicar" value="Publicar"/>
    </form>
    <div class="verde"></div>
    <div class="barra verde"></div>
    <h2>Opiniones anteriores</h2>
    
    <?php
        foreach($textUs as $texto) {
            list($com,$nom,$ema,$dia) = explode ("^",$texto);
            if (strval($nom)!= "") {
                echo ("<span style='color:red;font-weight:bold;'>".strval($nom)."</span> <span style='color:blue;text-decoration:underline;'>(".strval($ema).")</span> escribió el <span style='color:blue;font-style:italic;margin-bottom:0px;'>".strval($dia).":</span><br><span>".strval($com)."</span><br><br>");
            }
            //echo ($textUsDet[0]);
        }
    ?>
</body>
</html>