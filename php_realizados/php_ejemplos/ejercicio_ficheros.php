<html>
<head>
</head>
<body>
<h1>Ficheros</h1>
    <?php
    ini_set('display_errors',0);
    ?>
    <form action="ejercicio_ficheros.php" method="POST" enctype="multipart/form-data">
        Texto: <input type="text" name="texto" />
        <input type="submit" name="enviar" value="enviar" />
    </form>
    <br><br>
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $texto = $_POST['texto'];
        $id_f1 = fopen("fich.txt","w");
        fputs($id_f1,$texto);
    }
    ?>