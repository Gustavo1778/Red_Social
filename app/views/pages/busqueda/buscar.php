<?php 
include_once URL_APP . '/views/custom/header.php'; 
include_once URL_APP . '/views/custom/navbar.php'; 
?>

<div class="container mt-2">
    <div class="container-notificaciones-usuario"> 
        <div class="container-notificaciones-usuario-revisar">
            <?php if (!empty($datos['resultado'])): ?>
                <?php foreach($datos['resultado'] as $usuario): ?>
                    <div class="usuario-notificacion">
                        <!-- Mostrar la foto del perfil del usuario -->
                        <img src="<?php echo URL_PROJECT . '/public/' . htmlspecialchars($usuario->fotoPerfil); ?>" alt="<?php echo htmlspecialchars($usuario->nombreCompleto); ?>" class="image-border mr-2">
                       
                        <a href="<?php echo URL_PROJECT?>/perfil/<?php echo $usuario->usuario ?>">
                      <span class="nombre-usuario"><?php echo htmlspecialchars($usuario->nombreCompleto ); ?></span>
                    </a>
                    </div>
                    <br>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron resultados.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php 
include_once URL_APP . '/views/custom/footer.php'; 
?>
<style>
    <style>
    /* General container styles */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Container for user notifications */
    .container-notificaciones-usuario {
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    /* Container for the list of notifications */
    .container-notificaciones-usuario-revisar {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Individual user notification style */
    .usuario-notificacion {
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .usuario-notificacion:hover {
        background-color: #f1f1f1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Styling for user profile image */
    .image-border {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #dee2e6; /* Optional: border for better separation */
    }

    /* Styling for user name */
    .nombre-usuario {
        font-size: 16px;
        font-weight: 500;
        color: #333;
    }

    /* Styling for the 'No results' message */
    p {
        font-size: 16px;
        color: #888;
        margin: 20px 0;
    }
</style>

</style>