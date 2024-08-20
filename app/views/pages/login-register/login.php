
<?php
include_once URL_APP . '/views/custom/header.php';

?>

<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center">Iniciar Sesión</h4>
                    <form action="<?php echo URL_PROJECT?>/home/login" method="POST">
                        <div class="form-group">
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-purple btn-block ">Ingresar</button>
                    </form>
                    <?php
                    //alerta cuando el usuario o la contraseña son incorrectos
                    if(isset($_SESSION['errorLogin'])){
                        echo '<div class="alert alert-danger mt-3" role="alert">'.$_SESSION['errorLogin'].'</div>';
                        unset($_SESSION['errorLogin']);
                    }
                    //alerta cuando el login se completo
                    if(isset($_SESSION['loginComplete'])){
                        echo '<div class="alert alert-success mt-3" role="alert">'.$_SESSION['loginComplete'].'</div>';
                        unset($_SESSION['loginComplete']);
                    }

                    ?>
                    <div class="text-center mt-3">
                        <span class="mr-2 " >No tienes una cuenta</span><a href="<?php echo URL_PROJECT?>/home/register">Registrate</a>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="<?php echo URL_PROJECT ?>/img/login.png" alt="Imagen de tipo saludando" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

<?php
include_once URL_APP . '/views/custom/footer.php';
?>