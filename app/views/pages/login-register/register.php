
<?php
include_once URL_APP . '/views/custom/header.php';

?>

<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center">Registrarme</h4>
                    <form action="<?php echo URL_PROJECT?>/home/register" method="POST">
                            <input type="email" class="form-control" placeholder="Email" name='email' required>
                            <input type="text" class="form-control" placeholder="Usuario" name='usuario' required>
                            <input type="password" class="form-control" placeholder="Contraseña" name='contrasena' required>
                        <button class="btn btn-purple btn-block ">Registrarme</button>
                    </form>
                    <?php
                    if(isset($_SESSION['usuarioError'])){
                        echo '<div class="alert alert-danger mt-3" role="alert">'.$_SESSION['usuarioError'].'</div>';
                        unset($_SESSION['usuarioError']);
                    }
                      
                    ?>
                    <div class="text-center mt-3">
                        <span class="mr-2 " >¿No tienes una cuenta?</span><a href="<?php echo URL_PROJECT?>/home/login">Registrarte</a>
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