<?php
class Notificaciones extends Controller{
    public function __construct(){
        $this->notificaciones = $this->model('notificacion');
        $this->publicaciones = $this->model('publicar');
        $this->usuario = $this->model('usuario');
        $this->mensaje = $this->model('mensajeMod');
    }

    public function index(){
        if(isset($_SESSION['logueado'])){
            $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
            $datosPerfil = $this->usuario->getPerfil($datosUsuario->idusuario);
            $misNotificaciones = $this ->publicaciones->getNotificaciones($_SESSION['logueado']);
            $misMensajes= $this->mensaje->getMensajes($_SESSION['logueado']);
            $notificaciones=$this->notificaciones->obtenerNotificaciones($_SESSION['logueado']);
            $datos=[
                'perfil'=>$datosPerfil,
                'usuario'=>$datosUsuario,
                'misNotificaciones'=>$misNotificaciones,
                'notificaciones'=>$notificaciones,
                'misMensajes'=>$misMensajes
            ];
            $this->view('pages/notificaciones/notificaciones', $datos);
        }else{
            redirection('/home');
        }
    }

    public function eliminar($id){
        if(isset($_SESSION['logueado'])){
            if($this->notificaciones->eliminarNotificacion($id)){
                redirection('/notificaciones');
        }else{
            echo "No se ha podido eliminar la notificación";
            redirection('/notificaciones');
        }     
    }else{
        redirection('/home');} 

    }
}
?>