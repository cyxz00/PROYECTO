<?php 
require_once "clases/Conexion.php";
require_once "clases/User.php";

$obj = new conectar();
$conexion = $obj->conexion();

// Verificar si hay un usuario con el nombre de usuario 'admin'
$sql = "SELECT * FROM user WHERE usuario='admin'";
$result = mysqli_query($conexion, $sql);
$validar = 0;

if (mysqli_num_rows($result) > 0) {
    $validar = 1;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login de usuario</title>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <script src="librerias/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/funciones.js"></script>
    <style>
        .index-body {
            background-image: url('https://grupopypings.com/wp-content/uploads/2023/03/20230220-consultasycotizaciones-1226x766-1.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body class="index-body">
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Sistema de Seguimiento de Proyectos</div>
                    <div class="panel panel-body">
                        <p>
                            <img src="https://grupopypings.com/wp-content/uploads/2023/03/logo-normal.svg" height="100">
                        </p>
                        <form id="frmLogin">
                            <label>Usuario</label>
                            <input type="text" class="form-control input-sm" name="usuario" id="usuario">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control input-sm">
                            <p></p>
                            <span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
                            <?php if (!$validar): ?>
                            <a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#entrarSistema').click(function(){
            var vacios = validarFormVacio('frmLogin');
            if (vacios > 0) {
                alert("Debes llenar todos los campos!!");
                return false;
            }

            var datos = $('#frmLogin').serialize();
            console.log('Datos enviados:', datos); // Depuración
            $.ajax({
                type: "POST",
                data: datos,
                url: "procesos/regLogin/login.php",
                success: function(r) {
                    console.log('Respuesta del servidor:', r); // Depuración
                    if (r == 1) {
                        window.location = "vistas/inicio.php";
                    } else {
                        alert("No se pudo acceder :(");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown); // Depuración
                }
            });
        });
    });
</script>
