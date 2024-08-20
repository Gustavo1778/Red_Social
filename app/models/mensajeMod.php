<?php
class mensajeMod{
    private $db;
    public function __construct(){
        $this->db = new Base;
    }
    public function enviarMensaje($datosMensaje){
        $this->db->query('INSERT INTO mensajes (usuarios_idusuario, usuarioMando, contenido) VALUES (:idusermando, :iduserrecibe, :mensaje)');
        $this->db->bind(':idusermando', $datosMensaje['idusermando']);
        $this->db->bind(':iduserrecibe', $datosMensaje['enviar']);
        $this->db->bind(':mensaje', $datosMensaje['mensaje']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function getMensajes($id) {
        $sql = 'SELECT 
                    U.usuario, 
                    P.fotoPerfil, 
                    M.contenido, 
                    M.fechaMensaje, 
                    M.idmensaje 
                FROM mensajes M
                INNER JOIN usuarios U ON U.idusuario = CASE 
                                                            WHEN M.usuarioMando = :id THEN M.usuarios_idusuario 
                                                            ELSE M.usuarioMando 
                                                         END
                INNER JOIN perfil P ON P.idUsuario = CASE 
                                                        WHEN M.usuarioMando = :id THEN M.usuarios_idusuario 
                                                        ELSE M.usuarioMando 
                                                     END
                WHERE (M.usuarioMando = :id OR M.usuarios_idusuario = :id)';
        
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->registers();
    }

    public function eliminarMensaje($id){
        $this->db->query('DELETE FROM mensajes WHERE idmensaje = :id');
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>