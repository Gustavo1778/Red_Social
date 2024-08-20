<?php 
include_once URL_APP . '/views/custom/header.php'; 
include_once URL_APP . '/views/custom/navbar.php'; 
?>

<div class="container mt-2">
    <div class="container-notificaciones-usuario"> 
        <div class="contenido-notificaciones-usuario">
            <h3>Tienes <?php echo htmlspecialchars($datos['misNotificaciones'], ENT_QUOTES, 'UTF-8'); ?> notificaciones</h3>
        </div>
        <div class="container-notificaciones-usuario-revisar">
            <?php foreach ($datos['notificaciones'] as $datosNotificaciones): ?>
              <a href="<?php echo URL_PROJECT ?>/notificaciones/eliminar/<?php echo htmlspecialchars($datosNotificaciones->idnotificacion, ENT_QUOTES, 'UTF-8'); ?>" class="notificacion">
                <div>
                    <?php echo htmlspecialchars($datosNotificaciones->usuario, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($datosNotificaciones->mensajeNotificacion, ENT_QUOTES, 'UTF-8'); ?>
                </div>
              </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<style>
    /* Estilo general para el contenedor de notificaciones */
.container-notificaciones-usuario {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Estilo para el contenido de notificaciones */
.contenido-notificaciones-usuario {
  margin-bottom: 20px;
}

/* Estilo para el título de notificaciones */
.contenido-notificaciones-usuario h3 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 10px;
}

/* Estilo para el contenedor de notificaciones revisadas */
.container-notificaciones-usuario-revisar {
  display: flex;
  flex-direction: column;
}

/* Estilo para cada notificación */
.container-notificaciones-usuario-revisar a {
  display: block;
  padding: 15px;
  margin-bottom: 10px;
  background-color: #ffffff;
  border: 1px solid #ddd;
  border-radius: 8px;
  color: #333;
  text-decoration: none;
  font-size: 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s, color 0.3s;
}

/* Estilo para el enlace de notificación al pasar el cursor */
.container-notificaciones-usuario-revisar a:hover {
  background-color: #007bff;
  color: #ffffff;
}

/* Estilo para el texto de la notificación */
.container-notificaciones-usuario-revisar a span {
  display: block;
  margin-top: 5px;
  font-size: 0.9rem;
  color: #555;
}

</style>
<?php 
include_once URL_APP . '/views/custom/footer.php'; 
?>