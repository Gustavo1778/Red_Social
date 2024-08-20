<?php
    class Perfil extends Controller
    {
        public function __construct(){
            $this->perfil = $this->model('perfilUsuario');
            $this->usuario = $this->model('usuario');
            $this->notificaciones = $this->model('notificacion');
            $this->mensaje = $this->model('mensajeMod');
            $this->publicaciones = $this->model('publicar');
        }

        public function index($user){
            if(isset($_SESSION['logueado'])){
                $datosUsuario =$this->usuario->getUsuario($user);
                $datosPerfil = $this->usuario->getPerfil($datosUsuario->idusuario);
                $notificaciones=$this->notificaciones->obtenerNotificaciones($_SESSION['logueado']);
                $misNotificaciones = $this ->publicaciones->getNotificaciones($_SESSION['logueado']);
                $misMensajes= $this->mensaje->getMensajes($_SESSION['logueado']);
                $publicacionesUsuario = $this->publicaciones->getPublicacionesUsuario($datosUsuario->idusuario);
                $datos = [
                    'perfil'=>$datosPerfil,
                    'usuario'=>$datosUsuario,
                    'notificaciones'=>$notificaciones,
                    'misNotificaciones'=>$misNotificaciones,
                    'misMensajes'=>$misMensajes,
                    'publicaciones'=>$publicacionesUsuario
                ];
                $this->view('pages/perfil/perfil' , $datos);
            }
        }

        public function cambiarImagen($id){
            $carpeta= 'C:/xampp/htdocs/Desarrollo_Red_Social/public/img/imagenesPerfil/';
            opendir($carpeta);
            $rutaImagen= 'img/imagenesPerfil/'. $_FILES['imagen']['name'];
            $ruta= $carpeta. $_FILES['imagen']['name'];
            copy($_FILES['imagen']['tmp_name'], $ruta);
            $datos=[
              'idusuario' => trim($_POST['id_user']),
              'ruta' => $rutaImagen
            ];
            $imagenActual = $this->usuario->getPerfil($datos['idusuario']);
            unlink('C:/xampp/htdocs/Desarrollo_Red_Social/public/'.$imagenActual->fotoPerfil);
           
            if($this->perfil->editarFoto($datos)){
              redirection('/home');
            }else{
              echo "El perfil no se ha guardado";
            }
        }
    

    }
?>