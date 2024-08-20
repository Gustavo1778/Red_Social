<?php 
include_once URL_APP . '/views/custom/header.php'; 
include_once URL_APP . '/views/custom/navbar.php'; 
?>

<div>
  <img class="Fondo" src="https://th.bing.com/th/id/R.e86c7ff3b49c184f7fb177e3046d1e47?rik=whcWKWW9lx44Wg&pid=ImgRaw&r=0" alt="Imagen de fondo">
</div>

<link rel="stylesheet" href="<?php echo URL_PROJECT?>/public/css/home.css">

<div class="container">
    <div class="row">
        <div class="col section section-1">
            <div class="container">
                <div class="row">
                    <div class="card text-center" style="width: 18rem; margin: auto;">
                        <!-- Formulario para cambiar imagen -->
                        <?php if ($datos['usuario']->idusuario == $_SESSION['logueado']) : ?>
                            <form action="<?php echo URL_PROJECT ?>/perfil/cambiarImagen/<?php echo $_SESSION['logueado'] ?>" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center;">
                                <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">

                                <!-- Label with icon for file upload -->
                                <label for="imagen" style="cursor: pointer; display: inline-flex; align-items: center; background-color: transparent; padding: 0; margin: 0;">
                                    <i class="fa-solid fa-camera" style="font-size: 24px; color: #333;"></i>
                                </label>

                                <!-- File input -->
                                <input type="file" name="imagen" id="imagen" style="display: none;" onchange="this.form.submit();">
                            </form>
                        <?php endif ?>
                        
                        <div class="card-img-container" style="margin-bottom: 1rem;">
                            <a>
                                <img src="<?php echo URL_PROJECT.'/'.$datos['perfil']->fotoPerfil ?>" class="card-img-top rounded-circle" alt="Imagen de perfil" style="width: 150px; height: 150px; object-fit: cover;">
                            </a>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $datos['perfil']->nombreCompleto ?></h5>
                        </div>
                        
                        <div class="card-footer text-center" style="display: flex; justify-content: space-between;">
                            <div class="stat-box" style="flex: 1; text-align: center;">
                                <p class="stat-label">Publicaciones</p>
                                <p class="stat-value">0</p>
                            </div>
                            <div class="stat-box" style="flex: 1; text-align: center;">
                                <p class="stat-label">Me gustas</p>
                                <p class="stat-value">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col section section-2">
            <?php if ($datos['usuario']->idusuario == $_SESSION['logueado']) :?>
                <div class="card publicacion">
                    <div class="publicacion-total">
                        <img src="<?php echo URL_PROJECT.'/'.$datos['perfil']->fotoPerfil?>" class="publicacion-imagen" alt="Imagen de perfil">
                        <form action="<?php echo URL_PROJECT?>/publicaciones/publicar/<?php echo $datos['usuario']->idusuario?>" method="POST" enctype="multipart/form-data" class="publicacion-form">
                            <textarea class="form-control" rows="3" placeholder="¿Qué estás pensando?" name="contenido"></textarea>
                            <div class="separar-elementos">
                                <label for="imagen" class="form-label hidden-file-label">Subir foto</label>
                                <input class="hidden-file-input" type="file" id="imagen" name="imagen">
                                <button type="submit" class="btn btn-primary">Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif ?>  
            
        </div>

        <div class="col section section-3">
            <!-- Aquí puedes añadir más contenido si es necesario -->
        </div>
    </div>
</div>

<style>
.publicacion {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}

.publicacion-total {
  display: flex;
  align-items: flex-start;
  gap: 10px;
}

.publicacion-imagen {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.publicacion-form {
  flex: 1;
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

.separar-elementos {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn-primary {
  background-color: #007bff;
  border: none;
  color: #fff;
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.Fondo {
  width: 100%;
  height: 200px;
}
</style>

<?php 
include_once URL_APP . '/views/custom/footer.php'; 
?>
