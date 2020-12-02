<?php
ini_set('display_errors',0);
session_start();
$eliminar = $_POST['eliminar'];
if (isset($eliminar)) {
  session_destroy();
  header("Location: login.php");
}
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Jardinería</title>
    <link rel="icon" href="images/index.ico">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      a {
        clear: both;
        color: black;
        text-decoration: none; /* no underline */
      }
      .xright {
        float: right;
      }
      .x {
        position: relative;
        width: 27px;
        height: 27px;
        border: 2px solid #eef5df;
        background-color: #ff5248;
        border-radius: 50%;
      }
      .x::before, .x::after {
        position: absolute;
        top: 10px;
        left: 5px;
        width: 13px;
        height: 3px;
        content: "";
        background-color: #eef5df;
        display: none;
        }
      .x::before {
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        }
      .x::after {
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        }
      .x:hover { cursor: pointer; }
      .x:hover::before, .x:hover::after { display: block; }


      /* The alert message box */
      .alertD {
        padding: 20px;
        background-color: #f44336; /* Red */
        color: white;
        margin-bottom: 15px;
      }
      .alertS {
        padding: 20px;
        background-color: #56fc03; /* Red */
        color: white;
        margin-bottom: 15px;
      }
      /* The close button */
      .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
      }

      /* When moving the mouse over the close button */
      .closebtn:hover {
        color: black;
      }
      #contenido {
        width: 500px;
      }
      #contenido input {
        float: right;
      }
      #contenido select {
        float: right;
      }
      #contenido textarea {
        float: right;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php 
    #$dwes = new mysqli('localhost', 'alumno', 'alumno', 'jardineria');
    $dwes = new mysqli('localhost', 'root', 'toor', 'jardineria');
    $resultado = $dwes->query("SELECT * FROM productos");
    
    echo "<script>
    var max = 5;

    $(function() {
            var scntDiv = $('#p_scents');
            var i = $('#p_scents p').size() + 1;
            
            $('#addScnt').on('click', null, function() {
                if (i <= max) {
                    $('<p><label for=\"p_scnts\"> Cantidad: <input style=\"float:none;height:25px;\" type=\"text\" name=\"cantidad' + i +'\" size=\"2\">&nbsp;&nbsp; <select id=\"p_scnt\" style=\"width:250px;\" name=\"producto' + i +'\" value=\"\">";
                    while ($producto = $resultado->fetch_array()) {
                      echo "<option value=\"$producto[CodigoProducto]\">$producto[CodigoProducto] $producto[Nombre]</option>";
                    }
                    echo "</select></label><a href=\"#\" id=\"remScnt\"> Remover</a></p>').appendTo(scntDiv);
                    i++;
                    return false;
                }
            });
            
            $(document).on('click','#remScnt', function() {
                    $(this).parent().remove();
                    i--;
                    return false;
            });
    });
    </script>";
    $dwes->close();
    ?>
    <!-- Custom styles for this template
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

    <link href="css/jumbotron.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
    <link href="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
      $( "#datepicker" ).datepicker({dateFormat:'yy-mm-dd',minDate: new Date()});
    } );
    </script>
    <script>
      function confirmarReenvio() {
        if(confirm("Estás seguro? esto es una acción irreversible.")) {
          document.getElementById('regPedido').submit();
        }
      }
      function confirmarReenvioCl() {
        if(confirm("Estás seguro? esto es una acción irreversible.")) {
          document.getElementById('anCliente').submit();
        }
      }
    </script>
    <script>
      function getSelectedOption(sel) {
        var opt;
        for ( var i = 0, len = sel.options.length; i < len; i++ ) {
            opt = sel.options[i];
            if ( opt.selected === true ) {
                break;
            }
        }
        return opt;
      }
      function cargarInfo() {
        var sel = document.getElementsByClassName('selPedidoLis');
        var opt = sel[0].value;
        var codCliente = opt.split(" ")[0];
        window.location.href = "index.php?pagina=lisPedido&codCliente=" + codCliente;
      }
      function establecerCliente(codCliente) {
        var sel = document.getElementsByClassName('selPedidoLis');
        sel[0].value = codCliente;
      }
    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="index.php">Jardinería</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php?pagina=regPedido">Registrar Pedido</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?pagina=lisPedido">Lista Pedidos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?pagina=anCliente">Añadir Cliente</a>
        </li>
    </ul>
    <form action="index.php" method="POST" class="form-inline my-2 my-lg-0">
      <?php echo "<p style='color:white;position:relative;top:8px;'>Bienvenido ".$_SESSION['usuario']."&nbsp;&nbsp;&nbsp;</p>";?>
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Eliminar" name="eliminar"></input>
    </form>
  </div>
</nav>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
        <span id="contEl"></span>
        <?php
        
        $pagina = $_GET['pagina'];
        if (isset($pagina) && $pagina != "") {
          #$dwes = new mysqli('localhost', 'alumno', 'alumno', 'jardineria');
          $dwes = new mysqli('localhost', 'root', 'toor', 'jardineria');
          $error = $dwes->connect_errno;
          if ($error != null) { 
            echo "<p style='color:red;'>Error $error conectando a la base de datos: $dwes->connect_error</p>";     
            exit();
          }
          switch($pagina) {
            case "regPedido": 
              $enviarPedido = $_POST['enviarPedido'];
              if (isset($enviarPedido) && $enviarPedido!="") {
                $resultadoCodPed = $dwes->query("SELECT max(CodigoPedido) as CodigoPedidoMax FROM pedidos;");
                while ($max = $resultadoCodPed->fetch_array()) {
                  $CodigoPedido = $max['CodigoPedidoMax'];
                }
                $CodigoPedido++;
                $codCliente = $_POST['codCliente'];
                $codClienteS = explode(" ", $codCliente)[0];
                $estado = $_POST['estado'];
                $fechaPedido = $_POST['fechaPedido'];
                $fechaPrevista = $_POST['fechaPrevista'];
                $comentario = $_POST['comentario'];
                $resultado = $dwes->stmt_init();
                $fechaEntrega = "";
                $resultado = $dwes->prepare("INSERT INTO pedidos VALUES (?,?,?,null,?,?,?);");
                $resultado->bind_param("issssi",$CodigoPedido,$fechaPedido,$fechaPrevista,$estado,$comentario,$codClienteS);
                
                if ($resultado->execute()) {
                  echo "
                  <div class=\"alertS\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> 
                    <strong>Insertado!</strong> El pedido se ha registrado correctamente.
                  </div>";
                  $cantidad1 = $_POST['cantidad1'];
                  $producto1 = explode(" ", $_POST['producto1']);
                  $arrProducto = array($cantidad1, $producto1);
                  $arrProductos = array();
                  array_push($arrProductos,$arrProducto);
                  $cantidad2 = $_POST['cantidad2'];
                  $cantidad3 = $_POST['cantidad3'];
                  $cantidad4 = $_POST['cantidad4'];
                  $cantidad5 = $_POST['cantidad5'];
                  if (isset($cantidad2) && $cantidad2!="") {
                    $arrProducto = array($cantidad2,$_POST['producto2']);
                    array_push($arrProductos,$arrProducto);
                  }
                  if (isset($cantidad3) && $cantidad3!="") {
                    $arrProducto = array($cantidad3,$_POST['producto3']);
                    array_push($arrProductos,$arrProducto);
                  }
                  if (isset($cantidad4) && $cantidad4!="") {
                    $arrProducto = array($cantidad4,$_POST['producto4']);
                    array_push($arrProductos,$arrProducto);
                  }
                  if (isset($cantidad5) && $cantidad5!="") {
                    $arrProducto = array($cantidad5,$_POST['producto5']);
                    array_push($arrProductos,$arrProducto);
                  }
                  foreach ($arrProductos as $producto) {
                    $resultadoPrePed = $dwes->query("SELECT PrecioVenta FROM productos WHERE CodigoProducto=\"".$producto[1][0]."\";");
                    while ($precio = $resultadoPrePed->fetch_array()) {
                      $precioPro = $precio['PrecioVenta'];
                    }
                    
                    $resultado = $dwes->prepare("INSERT INTO detallepedidos VALUES (?,?,?,?,1);");
                    $nombreProducto = $producto[1][0];
                    $cantidadProducto = $producto[0];
                    $resultado->bind_param("isii",$CodigoPedido,$nombreProducto,$cantidadProducto,$precioPro);
                    $resultado->execute();
                  }
                } else {
                  echo "
                  <div class=\"alertD\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> 
                    <strong>Error!</strong> Error al insertar los datos a la base de datos, intentalo de nuevo.
                  </div>";
                }
              }
              $resultado = $dwes->query("SELECT * FROM clientes");
              $diaHoy = date("Y-m-d");
              echo "<h1>Registrar Pedido</h1><br>";
              echo "<form id='regPedido' action='index.php?pagina=regPedido' method='POST'>
              <fieldset>
              <legend>Rellena las siguientes casillas para registrar un pedido:</legend><br>
              <div id='contenido'>

              Cliente: <select id=\"editable-select\" name='codCliente'>";
              while ($cliente = $resultado->fetch_array()) {
                echo "<option value='$cliente[CodigoCliente]'>$cliente[CodigoCliente] $cliente[NombreContacto] $cliente[ApellidoContacto]</option>";
              }
              $resultado = $dwes->query("SELECT * FROM productos");
              echo "</select><br><br>
              Estado: <input type='text'  style='background-color: #e9ecef;' name='estado' value='Pendiente' readonly>
              <br><br>Fecha Pedido: <input type='text' name='fechaPedido' style='background-color: #e9ecef;' value='$diaHoy' readonly><br><br>
              Fecha Prevista: <input type='text' name='fechaPrevista' id='datepicker' value='$diaHoy'><br><br>
              Comentario: <textarea name='comentario' rows='4'y> </textarea><br><br><br><br><br>
              <p><a href=\"#\" id=\"addScnt\" style=\"clear:both;\">Añade otro producto</a></p><br<br>
              <div id=\"p_scents\">
                <p>
                  <label for=\"p_scnts\"> Cantidad: <input style=\"float:none;height:25px;\" type=\"text\" name=\"cantidad1\" size=\"2\" required>&nbsp;&nbsp;<select id=\"p_scnt\" style='width:250px;' name=\"producto1\">";
                  while ($producto = $resultado->fetch_array()) {
                    echo "<option value='$producto[CodigoProducto]'>$producto[CodigoProducto] $producto[Nombre]</option>";
                  }
                  echo "</select></label>
                  </p>
              </div>
              <input style='clear: both; float: left;' type='submit' name='enviarPedido' value='Enviar'>
              </div>
              </fieldset>
              </form>";
              break;
            case "lisPedido":
              $resultado = $dwes->query("SELECT * FROM clientes;");
              echo "<h1>Lista Pedidos</h1><br>";
              echo "Pedido: <select id=\"editable-select\" class='selPedidoLis' onfocusout='cargarInfo()'>";
              while ($pedido = $resultado->fetch_array()) {
                echo "<option value='$pedido[CodigoCliente]'>$pedido[CodigoCliente] - $pedido[NombreContacto] $pedido[ApellidoContacto]</option>";
              }
              echo "</select><br><br>";
              $codCliente = $_GET['codCliente'];
              if (isset($codCliente) && $codCliente != "") {
                $num = 0;
                $resultado = $dwes->stmt_init();
                $resultado = $dwes->prepare("SELECT p.CodigoPedido, p.FechaPedido, p.FechaEsperada, p.Estado, p.Comentarios, c.NombreContacto, c.ApellidoContacto FROM pedidos p, clientes c WHERE c.CodigoCliente = p.CodigoCliente && c.CodigoCliente = ?;");
                $resultado->bind_param('s',$codCliente);
                $resultado->execute();
                $resultado->bind_result($codPedido, $fechaPedido, $fechaEspera, $estado, $comentarios, $nombreContacto, $apellidoContacto);
                #echo "<script>establecerCliente($codCliente);</script><div>";
                while ($pedido = $resultado->fetch()) {
                  if ($num == 0) {
                    echo "$codCliente $nombreContacto $apellidoContacto";
                    $num = 1;
                  }
                  echo "<hr><p>Codigo Pedido: $codPedido</p><p>Fecha Pedido: $fechaPedido</p><p>Fecha Entrega: $fechaEspera</p><p>Estado: $estado</p><p>Comentarios: $comentarios</p><p></p><p></p>";
                }
                echo "</div>";
              }
              break;
            case "anCliente":
              $enviarCliente = $_POST['enviarCliente'];
              if (isset($enviarCliente) && $enviarCliente!="") {
                $resultadoCodCli = $dwes->query("SELECT max(CodigoCliente) as CodigoClienteMax FROM clientes;");
                while ($max = $resultadoCodCli->fetch_array()) {
                  $CodigoCliente = $max['CodigoClienteMax'];
                }
                $CodigoCliente++;
                $nombreCliente = $_POST['nombreCliente'];
                $nombreContacto = $_POST['nombreContacto'];
                $apellidoContacto = $_POST['apellidoContacto'];
                $telefono = $_POST['telefono'];
                $fax = $_POST['fax'];
                $direccion = $_POST['direccion'];
                $ciudad = $_POST['ciudad'];
                $region = $_POST['region'];
                $pais = $_POST['pais'];
                $codigoPostal = $_POST['codigoPostal'];
                $representanteVentas = $_POST['representanteVentas'];
                $limiteCredito = $_POST['limiteCredito'];
                $representanteVentasS = explode(" ", $representanteVentas)[0];
                $resultado = $dwes->stmt_init();
                $resultado = $dwes->prepare("INSERT INTO clientes VALUES (?,?,?,?,?,?,?,null,?,?,?,?,?,?);");
                $resultado->bind_param("isssssssssiii",$CodigoCliente,$nombreCliente,$nombreContacto,$apellidoContacto,$telefono,$fax,$direccion,$ciudad,$region,$pais,$codigoPostal,$representanteVentasS,$limiteCredito);
                if ($resultado->execute()) {
                  echo "
                  <div class=\"alertS\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> 
                    <strong>Insertado!</strong> El cliente se ha registrado correctamente.
                  </div>";
                } else {
                  echo "
                  <div class=\"alertD\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> 
                    <strong>Error!</strong> Error al insertar los datos a la base de datos, intentalo de nuevo.
                  </div>";
                }
              }
              $resultado = $dwes->query("SELECT * FROM empleados");
              echo "<h1>Añadir Cliente</h1><br>";
              echo "<form id='anCliente' action='index.php?pagina=anCliente' method='POST'> 
              <fieldset>
              <legend>Rellena las siguientes casillas para registrar un cliente:</legend><br>
              <div id='contenido'>
              Nombre Cliente: <input type='text' name='nombreCliente' required><br><br>
              Nombre Contacto: <input type='text' name='nombreContacto' required><br><br>
              Apellido Contacto: <input type='text' name='apellidoContacto' required><br><br>
              Telefono: <input type='text' name='telefono' pattern='[0-9]+' required><br><br>
              Fax: <input type='text' name='fax' pattern='[0-9]+' required><br><br>
              Dirección: <input type='text' name='direccion' required><br><br>
              Ciudad: <input type='text' name='ciudad' required><br><br>
              Región: <input type='text' name='region' required><br><br>
              País: <input type='text' name='pais' required><br><br>
              Código Postal: <input type='text' name='codigoPostal' required><br><br>
              Representante Ventas: <select id=\"editable-select\" name='representanteVentas'>";
              while ($empleado = $resultado->fetch_array()) {
                echo "<option value='$empleado[CodigoEmpleado]'>$empleado[CodigoEmpleado] $empleado[Nombre] $empleado[Apellido1]</option>";
              }
              echo "</select><br><br>Limite Credito: <input type='text' name='limiteCredito' required><br><br>
              <input type='submit' name='enviarCliente' value='Enviar' style='float:left'></fieldset></form>";
              break;
          }
        } else {
          echo ("<h1>Bienvenido a la tienda de la Jardinería</h1>
          <p>Aquí podra realizar pedidos para diferentes clientes, ver los pedidos realizados, o añadir nuevos clientes a la base de datos!</p>
          <p>Eliga una de las opciones listadas en el menú superior de la página para empezar</p>");
        }
      ?>
    </div>

  </div>
  <!--<div class="container">

    <div class="row">
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div>
    </div>

    <hr>

  </div>  /container -->

</main>
<script>
$('#editable-select').editableSelect();
</script>
<footer class="container">
  <p>&copy; Skalen S.L. 2020-2021</p>
</footer>
<!--<script src="js/jquery.slim.min.js"></script>
<script src="js/boostrap.bundle.min.js"></script></body>-->
</html>