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
            <?php  
            
                require_once "Conexion.php";

                $conexion = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

                //Comprobar la conexion

                if (!$conexion) {
                    die("Conexion Fallida: " . mysqli_connect_error());
                }

                //Consulta para comprobar si existe el email

                $existeEmail = "SELECT * FROM Profesores WHERE Email = '$_POST[Email]'";

                $resultado = $conexion-> query($existeEmail);

                $count =mysqli_num_rows($resultado);

                if($count == 1){
                    
                    echo "<div class= 'alert alert-warning mt-4' role='alert'>
                            <p>Este email ya está registrado en la base de datos.</p>
                            <p><a href='../Pagina_Inicio.html'>Por favor, vuelva a la página de CrearCuenta.</a></p>
                        </div>
                    ";
                }else{

                    $nombre = $_POST['Nombre'];
                    $apellido1 = $_POST['Apellido1'];
                    $apellido2 = $_POST['Apellido2'];
                    $email = $_POST['Email'];
                    $usuario = $_POST['Usuario'];
                    $contrasena = $_POST['Contraseña'];
                
                    // The password_hash() function convert the password in a hash before send it to the database
                    //$passHash = password_hash($pass, PASSWORD_DEFAULT);
                    
                    // Query to send Name, Email and Password hash to the database
                    $query = "INSERT INTO profesores (Nombre, Apellido1, Apellido2,Email, Nom_Usu, Contraseña,Rol) VALUES ('$nombre', '$apellido1', '$apellido2', '$email','$usuario','$contrasena','0')";
                
                    if (mysqli_query($conexion, $query)) {
                        echo "<div class='alert alert-success mt-4' role='alert'><h3>Tu cuenta ha sido creada con éxito.</h3>";
                                
                        } else {
                            echo "Error: " . $query . "<br>" . mysqli_error($conexion);
                        }	
                    }	
                    mysqli_close($conexion);
            ?>
            <a class='btn btn-outline-primary' href='../Pagina_Inicio.html' role='button'>Ir a página de inicio</a>
        </div>
    </body>
</html>