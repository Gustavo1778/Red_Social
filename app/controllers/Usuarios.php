<?php
    class Usuarios extends Controller
    {
        public function __construct()
        {
            $this->perfil = $this->model('perfilUsuario');
            $this->usuario = $this->model('usuario');
            $this->notificaciones = $this->model('notificacion');
            $this->publicaciones = $this->model('publicar');
            $this->mensaje = $this->model('mensajeMod');
        }

        public function index(){
            if(isset($_SESSION['logueado'])){
              $datosUsuario=$this->usuario->getUsuario($_SESSION['usuario']);
              $datosPerfil =$this->usuario->getPerfil($_SESSION['logueado']);
              $misNotificaciones =$this->publicaciones->getNotificaciones($_SESSION['logueado']);
              $misMensajes= $this->publicaciones->getMensajes($_SESSION['logueado']);
              $usuariosRegistrados= $this->usuario->getAllUsuarios();
              $cantidadUsuarios=$this->usuario->getCantidadUsuarios();
              $misMensajes= $this->mensaje->getMensajes($_SESSION['logueado']);
              if($datosPerfil){
                $datosRed=[ 
                    'usuario' => $datosUsuario,
                    'perfil' => $datosPerfil,
                    'misNotificaciones' => $misNotificaciones,
                    'misMensajes' => $misMensajes,
                    'usuariosRegistrados' => $usuariosRegistrados,
                    'misMensajes'=>$misMensajes,
                    'cantidadUsuarios' => $cantidadUsuarios
                ];
                $this->view('pages/usuarios/usuarios', $datosRed);
              }
              else{
                $this->view('pages/perfil/completarPerfil', $_SESSION['logueado']);
              }
             
            }
            else{
              redirection("/home/login");
            }
            }

    
    }