<?php 
include_once URL_APP . '/views/custom/header.php'; 
include_once URL_APP . '/views/custom/navbar.php'; 

?>

<link rel="stylesheet" href="<?php echo URL_PROJECT?>/public/css/home.css">
  <div class="container">
    <div class="row">
      <div class=" section-1">
        <div class="container">
            <div class="row">
                    <div class="card">
                      <div class="centrado">
                      <a href="<?php echo URL_PROJECT?>/perfil/<?php echo $datos['usuario']->usuario?>"><img src="<?php echo URL_PROJECT.'/'.$datos['perfil']->fotoPerfil?>" class="card-img" alt="Imagen de perfil"></a>
                      <div class="card-body"> <h5 class="card-title"><?php echo $datos['usuario']->usuario?></h5>
                      </div>
                      <div class="bloque">
                        <div class="centrado">
                        <a>Publicaciones<br><?php echo $datos['publicacionesTotales']?></a>
                        </div>
                        <div class="centrado">
                        <a>Me gustas<br><?php echo $datos['likesTotales']?></a>
                        </div>
                      </div>
                     
                           
                           
                        </div>
                </div>
            </div>
        </div>
        </div>
      <div class="section-2">
      <div class="card publicacion">
        <div class="publicacion-total">
          <img src="<?php echo URL_PROJECT.'/'.$datos['perfil']->fotoPerfil?>" class="publicacion-imagen" alt="Imagen de perfil">
          <form action="<?php echo URL_PROJECT?>/publicaciones/publicar/<?php echo $datos['usuario']->idusuario?>" method="POST" enctype="multipart/form-data" class="publicacion-form">
            <textarea class="form-control" rows="3" placeholder="¿Qué estás pensando?" name="contenido"></textarea>
            <div class="separar-elementos">
              <label for="imagen" class="form-label hidden-file-label">Subir foto</label>
              <input class="hidden-file-input" type="file" id="imagen" name="imagen">
              <button type="submit" class="btn">Publicar</button>
            </div>
          </form>
        </div>
      </div>
      <?php foreach($datos['publicaciones'] as $datosPublicacion): ?>
          <div class="cuadro-publicacion">
            <div class="publicacion-header">
              <div class="cuadro-imagen-texto">
                <img src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPerfil; ?>" alt="" class="imagenPerfil">
                <div class="texto-publicacion">
                  <h6>
                    <a href="<?php echo URL_PROJECT . '/perfil/' . $datosPublicacion->usuario; ?>">
                      <?php echo ucwords($datosPublicacion->usuario); ?>
                    </a>
                  </h6>
                  <span><?php echo $datosPublicacion->fechaPublicacion; ?></span>
                </div>
              </div>
              <?php if ($datosPublicacion->idusuario == $_SESSION['logueado']): ?>
                <a href="<?php echo URL_PROJECT?>/publicaciones/eliminar/<?php echo $datosPublicacion->idpublicacion?>" class="eliminar-publicacion">
                  <i class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i>
                </a>
              <?php endif ?>
            </div>
            <div class="contenido-publicacion">
              <p><?php echo $datosPublicacion->contenidoPublicacion; ?></p>
              <?php if (!empty($datosPublicacion->fotoPublicacion)): ?>
                <img src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPublicacion; ?>" alt="" class="imagen-publicacion">
              <?php endif; ?>
            </div>
            <div class="acciones-publicacion">
              <div class="me-gusta-container">
                <a href="<?php echo URL_PROJECT?>/publicaciones/megusta/<?php echo $datosPublicacion->idpublicacion .'/'. 
                $_SESSION['logueado'].'/'.$datosPublicacion->idusuario?>"><i class="fa-regular fa-heart fa-lg"></i></a>
                <span class="num-likes"><?php echo $datosPublicacion->num_likes; ?></span>
              </div>
              <div class="formulario-comentario">
                <img src="<?php echo URL_PROJECT.'/'.$datos['perfil']->fotoPerfil?>" alt="">
                <form action="<?php echo URL_PROJECT?>/publicaciones/comentar" method="POST">
                  <input type="hidden" name="iduserPropietario" value="<?php echo $datosPublicacion->idusuario?>">
                  <input type="hidden" name="iduser" value="<?php echo $datos['usuario']->idusuario?>">
                  <input type="hidden" name="idpublicacion" value="<?php echo $datosPublicacion->idpublicacion?>">
                  <input type="text" name="comentario" placeholder="Agregar un comentario">
                  <button>Comentar</button>
                </form>
              </div>
              <div class="cuadro-comentarios">
                <?php foreach($datos['comentarios'] as $datosComentarios): ?>
                  <?php if($datosComentarios->idPublicacion == $datosPublicacion->idpublicacion): ?>
                    <div class="comentario">
                      <img src="<?php echo URL_PROJECT.'/'.$datosComentarios->fotoPerfil?>">
                      <div class="texto-comentario">
                        <?php if($datosComentarios->idUser == $_SESSION['logueado']): ?>
                          <a href="<?php echo URL_PROJECT?>/publicaciones/eliminarComentario/<?php echo $datosComentarios->idComentario?>">Eliminar comentario</a>
                        <?php endif ?>
                        <a href="<?php echo URL_PROJECT?>/perfil/<?php echo $datosComentarios->usuario?>"><?php echo $datosComentarios->usuario?></a>
                        <span><?php echo $datosComentarios->fechaComentario?></span>
                        <p><?php echo $datosComentarios->contenidoComentario?></p>
                      </div>
                    </div>
                  <?php endif ?>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        <?php endforeach ?>


      <div class="section-3">

      </div>
    </div>
  </div>
<?php 
include_once URL_APP . '/views/custom/footer.php'; 
?>

<style>
  /*Seccion 1 */
  .centrado{
    text-align: center;
  }
  .bloque{
    display: flex;
    justify-content: space-around;
  }
  .card-img{
    width: 100px;
    height: 100px;
    border-radius: 50%;
  }
  /*Seccion 2 Posteo*/
  .publicacion{
    display : flex;
  }
  .publicacion-imagen{
    margin-top:10px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-left: 10px;

  }

  .card.publicacion {
    
  display: flex;
  flex-direction: column;
}

.publicacion-total {
  margin-top:20px;
  display: flex;
  align-items: flex-start;
  gap: 10px; 
}

.publicacion-imagen {
  width: 50px;
  height: 50px;
  object-fit: cover; 
  border-radius: 50%; 

}

.publicacion-form {
  flex: 0.98; 
  display: flex;
  flex-direction: column;
}

.form-control {
  margin-bottom: 10px; 
}

.hidden-file-label {
  cursor: pointer;
}

.hidden-file-input {
  display: none; 
}

.d-flex {
  display: flex;
}

.align-items-center {
  align-items: center; 
}

.publicacion-form textarea{
  border-radius: 10px;
}
.separar-elementos{
  display: flex;
  justify-content: space-between;
}
/*Sesion 2 Comentarios */
/* Container for each publication */
.cuadro-publicacion {
  border: 1px solid #ddd;
  border-radius: 8px;
  margin-bottom: 20px;
  padding: 10px;
  background-color: #fff;
}

/* Header for each publication */
.publicacion-header {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.eliminar-publicacion {
  margin-right: 10px;
  color: #d9534f;
  text-decoration: none;
  font-size: 0.875rem;
}

.eliminar-publicacion:hover {
  text-decoration: underline;
}

/* Flex container for image and text */
.cuadro-imagen-texto {
  display: flex;
  align-items: center;
  flex: 1;
}

.imagenPerfil {
  border-radius: 50%;
  width: 50px;
  height: 50px;
  margin-right: 10px;
}

.texto-publicacion h6 {
  margin: 0;
  font-size: 1rem;
}

.texto-publicacion span {
  display: block;
  font-size: 0.875rem;
  color: #555;
}

/* Post content */
.contenido-publicacion {
  margin-bottom: 10px;
}

.imagen-publicacion {
  width: 100%;
  max-height: 400px;
  object-fit: cover;
  border-radius: 8px;
}

/* Actions and comments section */
.acciones-publicacion {
  display: flex;
  flex-direction: column;
}

.me-gusta-container {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.me-gusta-container a {
  font-size: 1rem;
  color: #007bff;
  text-decoration: none;
}

.num-likes {
  margin-left: 5px;
  font-size: 1rem;
  color: #333;
}

.formulario-comentario {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.formulario-comentario img {
  border-radius: 50%;
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.formulario-comentario form {
  display: flex;
  flex: 1;
}

.formulario-comentario input[type="text"] {
  flex: 1;
  padding: 5px;
  border-radius: 4px;
  border: 1px solid #ddd;
}

.formulario-comentario button {
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
  margin-left: 5px;
}

.cuadro-comentarios {
  margin-top: 10px;
}

.comentario {
  display: flex;
  align-items: flex-start;
  margin-bottom: 10px;
}

.comentario img {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  margin-right: 10px;
}

.texto-comentario {
  max-width: 100%;
}

.texto-comentario a {
  font-weight: bold;
}

.texto-comentario p {
  margin: 5px 0;
  line-height: 1.5;
}

.texto-comentario span {
  display: block;
  font-size: 0.875rem;
  color: #555;
}

.texto-comentario a, .texto-comentario a:hover {
  text-decoration: none;
  color: #007bff;
}
</style>