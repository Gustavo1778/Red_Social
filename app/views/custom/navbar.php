<link rel="stylesheet" href="<?php echo URL_PROJECT?>/public/css/navbar.css">
<?php

// Mostrar el contenido de $datos
//var_dump($datos);

// Mostrar el contenido de $_SESSION['logueado']
//echo 'Sesión: ';
//var_dump($_SESSION['logueado']);*/
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <img class="rounded-circle me-2 logo" src="https://istpetonline.edu.ec/pluginfile.php/1/theme_klassroom/logo/1723137054/logo-OUT.png" alt="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo URL_PROJECT?>/home?"><i class="fa-solid fa-house fa-xl"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo URL_PROJECT?>/Mensajes/"><i class="fa-regular fa-envelope fa-xl"></i></a>
          <div class="bg-succes"><?php echo isset($datos['misMensajes']) ? (int)$datos['misMensajes'] : 0; ?></div>

          <!--Esta toca cambiar para implementar bien los mensajes -->
        </li>
        <li class="nav-item">
          
        <a class="nav-link active" aria-current="page" href="<?php echo URL_PROJECT; ?>/Notificaciones/"><i class="fa-regular fa-bell fa-xl"></i></a>
            <div class="bg-succes"><?php echo $datos['misNotificaciones']?></div>
          </a>
        </li>
        <li class="nav-item">
          
          <a class="nav-link active" aria-current="page" href="<?php echo URL_PROJECT; ?>/Usuarios/"><i class="fa-solid fa-users fa-xl"></i></a>
  <!--Esta es el area de usuarios -->
            </a>
          </li>
        </ul>
        
      <form action="<?php echo URL_PROJECT ?>/home/buscar" method="POST" class="d-flex">
        <input class="form-control me-2 redondear" type="search" placeholder="Buscar" aria-label="Search" name="busqueda">
        <button class="btn btn-outline" type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
      </form>
<?php
// Asegúrate de que la sesión esté iniciada


// Verificar si el idusuario en $datos es igual al id de sesión
if (isset($_SESSION['logueado']) && $_SESSION['logueado'] == $datos['usuario']->idusuario) :
?>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo URL_PROJECT . '/' . htmlspecialchars($datos['perfil']->fotoPerfil, ENT_QUOTES, 'UTF-8'); ?>" class="foto-nav" alt="Imagen de perfil">
                <?php echo htmlspecialchars($datos['perfil']->nombreCompleto, ENT_QUOTES, 'UTF-8'); ?>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo URL_PROJECT . '/perfil/' . htmlspecialchars($datos['usuario']->usuario, ENT_QUOTES, 'UTF-8'); ?>">Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo URL_PROJECT . '/home/logout'; ?>">Salir</a></li>
            </ul>
        </li>
    </ul>
<?php endif; ?>
    </div>
  </div>
</nav>

<style>
  .logo{
    width: auto;
    height: 50px;
  }
  .redondear{
    border-radius: 20px;
  }
  .foto-nav{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
  }
  .nav-item{
    display: flex;
    padding-left: 10px;
  }
</style>