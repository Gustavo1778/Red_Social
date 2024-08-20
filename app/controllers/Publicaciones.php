<?php
class Publicaciones extends Controller
{
    public function __construct(){
        $this->publicar = $this->model('publicar');
    }

    public function publicar($idUsuario){
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $carpeta = 'C:/xampp/htdocs/Desarrollo_Red_Social/public/img/imagenesPublicaciones/';
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $rutaImagen = 'img/imagenesPublicaciones/' . $_FILES['imagen']['name'];
            $ruta = $carpeta . $_FILES['imagen']['name'];
            if (file_exists($_FILES['imagen']['tmp_name'])) {
                copy($_FILES['imagen']['tmp_name'], $ruta);
            } else {
                echo "Archivo temporal no encontrado.";
                return;
            }
        } else {
            $rutaImagen = '';
        }
    
        $datos = [
            'iduser' => trim($idUsuario),
            'contenido' => trim($_POST['contenido']),
            'imagen' => $rutaImagen
        ];
    
        if ($this->publicar->publicar($datos)) {
            redirection('/home');
        } else {
            echo "La publicación no se ha guardado";
        }
    }

    public function eliminar($idPublicacion){

        $publicacion = $this->publicar->getPublicacion($idPublicacion);
        if($this->publicar->eliminarPublicacion($publicacion)){
            unlink('C:/xampp/htdocs/Desarrollo_Red_Social/public/'.$publicacion->fotoPublicacion);
            redirection('/home');
        }else{
            echo "La publicación no se ha eliminado";
        }
    }

    public function megusta($idPublicacion , $idusuario , $idUsuarioPropietario){
        $datos=[
            'idpublicacion' => $idPublicacion,
            'idusuario' => $idusuario,
            'idUsuarioPropietario'=> $idUsuarioPropietario
        ];

        $datosPublicacion = $this->publicar->getPublicacion($idPublicacion);
        if($this->publicar->rowLikes($datos)){
            if($this->publicar->eliminarLike($datos)){
                $this->publicar->deleteLikeCount($datosPublicacion);
            }
            redirection('/home');
        }else{
            if($this->publicar->agregarLike($datos)){
                $this->publicar->addLikeCount($datosPublicacion);
                $this->publicar->addNotificacionesLike($datos);
                
        }
        redirection('/home');
    }
    }

    public function comentar(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'iduserPropietario' => trim($_POST['iduserPropietario']),
                'iduser' => trim($_POST['iduser']),
                'idpublicacion' => trim($_POST['idpublicacion']),
                'comentario' => trim($_POST['comentario'])
            ];
            if($this->publicar->publicarComentario($datos)){
                $this->publicar->addNotificacionComentarios($datos);
                redirection('/home');
            }else{
                redirection('/home');
            }
        }else{
            redirection('/home');
        }
    }

    public function eliminarComentario($id){

        if($this->publicar->eliminarComentarioUsuario($id)){
            redirection('/home');
        }else{
            redirection('/home');
        }
    }

}
?>