<?php 
include_once URL_APP . '/views/custom/header.php'; 
include_once URL_APP . '/views/custom/navbar.php'; 
?>

<div class="container mt-2">
    <div class="container-notificaciones-usuario"> 
        <div class="container-notificaciones-usuario-revisar">
            <?php foreach($datos['usuariosRegistrados'] as $usuario): ?>
                <div class="usuario-notificacion">
                    <img src="<?php echo URL_PROJECT . '/public/' . htmlspecialchars($usuario->fotoPerfil); ?>" alt="<?php echo htmlspecialchars($usuario->nombreCompleto); ?>" class="image-border mr-2">
                    <a href="<?php echo URL_PROJECT?>/perfil/<?php echo $usuario->usuario ?>">
                      <span class="nombre-usuario"><?php echo htmlspecialchars($usuario->nombreCompleto ); ?></span>
                    </a>
                </div>
                <br>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<style>
    /* Estilo general para el contenedor de notificaciones de usuario */
.container-notificaciones-usuario {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
}

/* Estilo para la sección de usuarios dentro del contenedor */
.container-notificaciones-usuario-revisar {
  display: flex;
  flex-direction: column;
}

/* Estilo para cada usuario en la lista */
.usuario-notificacion {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  padding: 10px;
  background-color: #ffffff;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Estilo para la imagen del perfil del usuario */
.image-border {
  border-radius: 50%;
  width: 50px;
  height: 50px;
  object-fit: cover;
  margin-right: 15px;
}

/* Estilo para el nombre del usuario */
.nombre-usuario {
  font-size: 1.1rem;
  font-weight: bold;
  color: #333;
  margin-left: 10px;
}

/* Opcional: Añadir un borde inferior para separar los usuarios */
.usuario-notificacion:not(:last-child) {
  border-bottom: 1px solid #ddd;
}
</style>
<?php 
include_once URL_APP . '/views/custom/footer.php'; 
?>
