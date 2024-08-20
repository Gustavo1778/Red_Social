<?php
class Mensajes extends Controller{
    public function __construct()
    {
        $this->publicaciones = $this->model('publicar');
        $this->usuario = $this->model('usuario');
        $this->mensaje = $this->model('mensajeMod');
    }

    public function index(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datosMensaeje=[
                'idusermando'=>trim($_POST['idusermando']),
                'enviar'=>trim($_POST['enviar']),
                'mensaje'=>trim($_POST['mensaje']),
            ];
            if($this->mensaje->enviarMensaje($datosMensaeje)){
                redirection('/mensajes');
            }else{
                redirection('/mensajes');
            }
        }else{
            if(isset($_SESSION['logueado'])){
                $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
                $datosPerfil = $this->usuario->getPerfil($datosUsuario->idusuario);
                $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);
                $datosUsuarios= $this->usuario->getUsuarios();
                $misMensajes= $this->mensaje->getMensajes($_SESSION['logueado']);
                $datos=[
                    'perfil'=>$datosPerfil,
                    'usuario'=>$datosUsuario,
                    'misNotificaciones'=>$misNotificaciones,
                    'usuarios'=>$datosUsuarios,
                    'misMensajes'=>$misMensajes
                ];
                $this->view('pages/mensajes/mensajes', $datos);
            }else{
                redirection('/home');
            }
        }
    }
    public function eliminarMensaje($id){
        if($this->mensaje->eliminarMensaje($id)){
            redirection('/mensajes');
        }else{
            redirection('/mensajes');
        }
    }
}
?>