<!DOCTYPE html>
<html>
    <head><title>Ejercicio Formulario</title></head>
    <body>
        <form action="ejercicio_formulario2.php" method="get">
            Nombre: <input type="text" name="nombre" id="nombre"/><br/><br/>
            Estudios: 
            <select name="estudios">
                <option value="DWES">Desarrollo Web en Entorno Servidor</option>
                <option value="DWEC">Desarrollo Web en Entorno Cliente</option>
                <option value="DAW">Despliegue de Aplicaciones Web</option>
                <option value="DIW">Diseño de interfaces Web</option>
            </select><br/><br/>
            <input type="radio" id="casado" name="civil" value="casado"> Casado/a
            <input type="radio" id="soltero" name="civil" value="soltero"> Soltero/a
            <input type="radio" id="viudo" name="civil" value="viudo"> Viudo/a <br/><br/>
            <input type="checkbox" id="acepta" name="acepta"/>Acepto las condiciones de uso<br/><br/>
            <input type="submit" name="enviar" value="Enviar"/>
        </form>
    </body>
</html>