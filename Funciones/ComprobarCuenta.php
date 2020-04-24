<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página de Registro Profesores</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilo.css">
        <script src="../js/jquery-3.4.1.min.js"></script>
    </head>

    <body>
        <div class="container-fluid">
        <?php session_start(); ?>

<?php 

    require_once "Conexion.php";

    $conexion = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

    if (!$conexion) {
        die("Conexion Fallida: " . mysqli_connect_error());
    }

    $email = $_POST['Email'];
    $contrasena = $_POST['Contraseña'];
    $resultado = mysqli_query($conexion, "SELECT Nombre, Apellido1,Email, Nom_Usu, Contraseña FROM Profesores WHERE Email = '$email' AND Contraseña = '$contrasena'");

    $consulta = mysqli_fetch_assoc($resultado);

    /*$hash = password_hash($contrasena,PASSWORD_DEFAULT);

    echo $contrasena;
    echo "<br>";
    echo $hash;
*/
                if ($consulta > 0){

                    $_SESSION['loggedin'] = true;
                    $_SESSION['Nombre'] = $consulta['Nombre'];
                    $_SESSION['Apellido1'] = $consulta['Apellido1'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;						
        
                  echo " <div class='container-fluid justify-content-center'>
                  <p class='display-2 text-center alert alert-light text-dark'>
                      <img src='../img/logoAula.png' alt='Logo'> Bienvenido Usuario $_SESSION[Nombre]
                  </p>
                  <div class='row'>
                  <div class='col-md-12'>
                  <nav class='navbar navbar-expand-md navbar-light bg-info text-white d-flex justify-content-center'>
                  <button class='navbar-toggler bg-warning' type='button' data-toggle='collapse' data-target='#navbarText'>
                      <span class='navbar-toggler-icon'></span>
                  </button>
                  <div class='collapse navbar-collapse' id='navbarText'>
                      <ul class='navbar-nav mr-auto'>
                          <li class='nav-item active'>
                              <a class='nav-link text-white' href='#'>Matricular Alumnos</a>
                          </li>
                          
                      </ul>
                  </div>
              </nav>
                  </div>
              </div>
              </div>
                  
                  ";	
                
                  } else {
                    echo "<div class='alert alert-danger mt-4' role='alert'>Email or Password are incorrects!
                    <p><a href='../Login.html'><strong>Please try again!</strong></a></p></div>";	
                  }
                  mysqli_close($conexion);

?>
        </div>
    </body>
</html>