<?php
class notificacion{
    private $db;
    public function __construct(){
        $this->db = new Base;
    }

    public function obtenerNotificaciones($idUsuario){
        $this->db->query('SELECT N.idnotificacion , T.mensajeNotificacion , U.usuario FROM notificaciones N 
        INNER JOIN usuarios U on U.idusuario = N.usuarioAccion
        INNER JOIN tiposnotificaciones T on T.idtiposNotificaciones = N.tipoNotificaion
        WHERE U.idusuario = :idUsuario
        ');
        $this->db->bind(':idUsuario', $idUsuario);
        return $this->db->registers();
        

    }

    public function eliminarNotificacion($id){
       $this->db->query('DELETE FROM notificaciones WHERE idnotificacion = :id'); 
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
}
?>