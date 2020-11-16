<!DOCTYPE html>
<html lang="es ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión BBDD</title>
    <style>
        input {
            float: right;
        }
    </style>
</head>
<body>
    <main>
        <section>
            <h1>Conexión BBDD</h1>
            <!--
            <?php ini_set('display_errors', 0);
                $dwes = new mysqli('localhost', 'root', 'toor', 'prueba');

                $error = $dwes->connect_errno;
                
                if ($error != null) { 
                    echo "<p>Error $error conectando a la base de datos: $dwes->connect_error</p>";     
                    exit();
                }
                #echo "<p>Conexión realizada con éxito</p>";
                #$resultado = $dwes->query("INSERT INTO usuario VALUES (0,'alumnodaw','alumnodaw','alumnodaw@email.com','alumnodaw')");
                #if ($resultado) {
                #    echo "<p>Se ha insertado $dwes->affected_rows usuarios</p>";
                #} else {
                #    echo "<p>Error al insertar los datos</p>";
                #}
            ?>
            -->

            <form action="index.php" method="POST">
                <fieldset style="width:500px;">
                    <legend>Usuarios</legend><br>
                    Nombre: <input type="text" name="nombre"><br><br>
                    Apellido: <input type="text" name="apellido"><br><br>
                    Correo: <input type="email" name="correo"><br><br>
                    Contraseña: <input type="password" name="contr1"><br><br>
                    Repetir Contraseña: <input type="password" name="contr2"><br><br>
                    <input type="submit" value="Enviar" style="float:left;"> <input type="reset" value="Limpiar">
                </fieldset>
            </form>

            <?php
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $_POST['correo'];
                $contr1 = $_POST['contr1'];
                $contr2 = $_POST['contr2'];
                $borrar = $_POST['borrar'];
                $cod_usuario = $_POST['cod_usuario'];
                if (isset($nombre) && $nombre != "" && $apellido != "" && $correo != "" && $contr1 != "" && $contr1 == $contr2) {
                    //$resultado = $dwes->query("INSERT INTO usuario VALUES (0,'$nombre','$apellido','$correo','$contr1')");
                    $resultado = $dwes->stmt_init();
                    $resultado = $dwes->prepare("INSERT INTO usuario VALUES (0,?,?,?,?)");
                    $num = 0;
                    $resultado->bind_param('ssss',$nombre,$apellido,$correo,$contr1);
                    if ($resultado->execute()) {
                    } else {
                        echo "<p style='color:red;'>Error al insertar los datos</p>";
                    }
                }
                if (isset($borrar) && $cod_usuario != "") {
                    $resultado = $dwes->stmt_init();
                    $resultado = $dwes->prepare("DELETE FROM usuario WHERE cod_usuario=?;");
                    $resultado->bind_param('i',$cod_usuario);
                    $resultado->execute();
                }
            ?>

            <?php
                echo "<div><hr>";
                    $resultado = $dwes->query("SELECT * FROM usuario");
                    while ($usuario = $resultado->fetch_array()) {
                        echo "<form action='index.php' method='POST'><p>Nombre: $usuario[nombre] Apellido: $usuario[apellido]<input type='hidden' name='cod_usuario' value='$usuario[cod_usuario]'><input type='submit' name='borrar' value='Borrar'></p></form>\n<hr>";
                    }
                echo "</div>";
            ?>
        </section>
    </main>
</body>
</html>