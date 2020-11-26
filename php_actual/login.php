<?php
ini_set('display_errors',0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- script muy importante -->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Jardineria</title>
    <link rel="icon" href="images/index.ico">
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
      input {
          float: right;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="login.php">Jardinería</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
        <!--<li class="nav-item">
            <a class="nav-link" href="#">Temp</a>
        </li>-->
    </ul>
  </div>
</nav>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
        <form action='procesa.php' method='POST' style='width:400px;margin:auto;'>
            <fieldset>
                <legend>Log In</legend>
                <p id='errorLogIn' style="color:red;">&nbsp;</p>
                <?php 
                  $login = $_POST['login'];
                  if (isset($login)) {
                    echo "<script>document.getElementById(\"errorLogIn\").innerHTML = 'Error, Nombre de usuario o contraseña incorrectos';</script>"; 
                  }
                ?>
                Usuario: <input type='text' name='usuario' required><br><br>
                Contraseña: <input type='password' name='clave' required><br><br>
                <input style='float:none;margin:auto;' type='submit' name='enviar' value='Enviar'>
            </fieldset>     
        </form>
    <?php 
    #echo "<script src=\"https://code.jquery.com/jquery-1.12.4.min.js\"></script>
    #<script src=\"https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js\"></script>
    #<link href=\"https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css\" rel=\"stylesheet\">
    #<select id=\"editable-select\">
    #  <option>Alfa Romeo</option>
    #  <option>Audi</option>
    #  <option>BMW</option>
    #  <option>Citroen</option>
    #</select>
    #<script>
    #$('#editable-select').editableSelect();
    #</script>";
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

<footer class="container">
  <p>&copy; Arkadiusz-Stefan Skawinski 2020-2021</p>
</footer>
<script src="js/jquery.slim.min.js"></script>
<script src="js/boostrap.bundle.min.js"></script></body>
</html>