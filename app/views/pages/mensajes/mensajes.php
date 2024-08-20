<?php 
include_once URL_APP . '/views/custom/header.php'; 
include_once URL_APP . '/views/custom/navbar.php'; 
?>
<div class="container mt-3">
    <div class="container-notificaciones-usuario">
        <h6>Mensajería privada</h6>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p>Enviar nuevo mensaje</p>
                <form action="<?php echo URL_PROJECT?>/mensajes" method="POST">
                    <input type="hidden" name="idusermando" value="<?php echo $_SESSION['logueado']?>">
                    <div class="form-group">
                        <label for="enviar">Para:</label>
                        <select name="enviar" id="enviar" class="form-control" required>
                            <option value="">Seleccionar un destinatario</option>
                            <?php foreach ($datos['usuarios'] as $allusuario): ?>
                                <option value="<?php echo $allusuario->idusuario?>"><?php echo $allusuario->usuario?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="mensaje">Mensaje:</label>
                        <textarea name="mensaje" id="mensaje" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                    <button class="btn-purple btn-block" type="submit">Enviar mensaje</button>
                </form>
            </div>
            <div class="col-md-6">
                <p>Mensajes recibidos</p>
                <hr>
                <?php
                // Crear un array para almacenar los mensajes por usuario
                $mensajesPorUsuario = [];
                foreach ($datos['misMensajes'] as $datosMensajes) {
                    if (!isset($mensajesPorUsuario[$datosMensajes->usuario])) {
                        $mensajesPorUsuario[$datosMensajes->usuario] = [
                            'fotoPerfil' => $datosMensajes->fotoPerfil,
                            'mensajes' => []
                        ];
                    }
                    $mensajesPorUsuario[$datosMensajes->usuario]['mensajes'][] = $datosMensajes;
                }
                ?>
                <?php foreach ($mensajesPorUsuario as $usuario => $info): ?>
                    <div class="usuario-mensajes">
                        <div class="usuario-info">
                            <img src="<?php echo URL_PROJECT .'/public/'. $info['fotoPerfil']; ?>" alt="" class="image-border mr-2">
                            <span class="usuario-nombre"><?php echo $usuario; ?></span>
                        </div>
                        <?php foreach ($info['mensajes'] as $mensaje): ?>
                            <div class="mensaje">
                                <div class="contenido-comentario-usuario">
                                    <a href="<?php echo URL_PROJECT . '/mensajes/eliminarMensaje/' . $mensaje->idmensaje; ?>" class="float-right">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <p><?php echo $mensaje->contenido; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<style>
/* Estilos para el contenedor de mensajes */
.container-notificaciones-usuario {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
}

/* Estilos para la imagen del perfil en los mensajes */
.image-border {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  object-fit: cover;
}

/* Estilos para la información del usuario */
.usuario-info {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.usuario-info .usuario-nombre {
  font-size: 1rem;
  font-weight: bold;
  margin-left: 10px;
}

/* Estilos para cada mensaje */
.mensaje {
  display: flex;
  align-items: flex-start;
  margin-bottom: 10px;
}

.contenido-comentario-usuario {
  flex: 1;
}

.contenido-comentario-usuario a {
  color: #007bff;
  text-decoration: none;
}

.contenido-comentario-usuario p {
  margin: 0;
}

.float-right {
  float: right;
  color: #ff0000;
  font-size: 1rem;
  text-decoration: none;
}

</style>
<?php 
include_once URL_APP . '/views/custom/footer.php'; 
?>
