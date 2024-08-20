<?php
class publicar{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function publicar($datos){
        $this->db->query('INSERT INTO publicaciones (idUserPublico, contenidoPublicacion, fotoPublicacion) VALUES (:idusuario, :contenido, :foto)');
        $this->db->bind(':idusuario', $datos['iduser']);
        $this->db->bind(':contenido', $datos['contenido']);
        $this->db->bind(':foto', $datos['imagen']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getPublicaciones() {
        $sql = "SELECT P.num_likes, P.idpublicacion, P.contenidoPublicacion, P.fotoPublicacion, P.fechaPublicacion, U.usuario, Per.fotoPerfil, U.idusuario 
                FROM publicaciones P
                INNER JOIN usuarios U ON U.idusuario = P.idUserPublico
                INNER JOIN perfil Per ON Per.idUsuario = P.idUserPublico
                ORDER BY P.fechaPublicacion DESC";
        
        $this->db->query($sql);
        return $this->db->registers();
    }

    public function getPublicacion($id){
        $this->db->query('SELECT * FROM publicaciones WHERE idpublicacion = :id');
        $this->db->bind(':id', $id);
        return $this->db->register();
    }


    public function eliminarPublicacion($publicacion){
        $this->db->query('DELETE FROM publicaciones WHERE idpublicacion = :id');
        $this->db->bind(':id', $publicacion->idpublicacion);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function rowLikes($datos){
        $this->db->query('SELECT * FROM likes WHERE idPublicacion = :idpublicacion AND idUser = :idusuario');
        $this->db->bind(':idpublicacion', $datos['idpublicacion']);
        $this->db->bind(':idusuario', $datos['idusuario']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function agregarLike($datos){
        $this->db->query('INSERT INTO likes (idPublicacion, idUser) VALUES (:idpublicacion, :idusuario)');
        $this->db->bind(':idpublicacion', $datos['idpublicacion']);
        $this->db->bind(':idusuario', $datos['idusuario']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function eliminarLike($datos){
        $this->db->query('DELETE FROM likes WHERE idPublicacion = :idpublicacion AND idUser = :idusuario');
        $this->db->bind(':idpublicacion', $datos['idpublicacion']);
        $this->db->bind(':idusuario', $datos['idusuario']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function misLikes($id){
        $this->db->query('SELECT * FROM likes WHERE idUser = :id');
        $this->db->bind(':id', $id);
        return $this->db->registers();
    }

    public function addLikeCount($datos)
    {
        $this->db->query('UPDATE publicaciones SET num_likes =  :countLike WHERE idpublicacion = :id');
        $this->db->bind(':countLike', $datos->num_likes + 1);
        $this->db->bind(':id', $datos->idpublicacion);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteLikeCount($datos){
        $this->db->query('UPDATE publicaciones SET num_likes =  :countLike WHERE idpublicacion = :id');
        $this->db->bind(':countLike', $datos->num_likes - 1);
        $this->db->bind(':id', $datos->idpublicacion);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function publicarComentario($datos){
        $this->db->query('INSERT INTO comentarios (idPublicacion, idUser, contenidoComentario) VALUES (:idpublicacion, :idusuario, :comentario)');
        $this->db->bind(':idpublicacion', $datos['idpublicacion']);
        $this->db->bind(':idusuario', $datos['iduser']);
        $this->db->bind(':comentario', $datos['comentario']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
    }
    }

    public function getComentarios(){
        $this->db->query('SELECT * FROM comentarios');
        return $this->db->registers();
    }

    public function getInformacionComentarios($comentarios) {
        $this->db->query('SELECT C.idPublicacion, C.contenidoComentario, C.fechaComentario, P.fotoPerfil, U.usuario , C.idUser , C.idComentario
                          FROM comentarios C
                          INNER JOIN perfil P ON P.idUsuario = C.idUser
                          INNER JOIN usuarios U ON U.idUsuario = C.idUser');
    
        return $this->db->registers();
    }
    public function eliminarComentarioUsuario($id){
        $this->db->query('DELETE FROM comentarios WHERE idcomentario = :id');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function addNotificacionesLike($datos){
        $this->db->query('INSERT INTO notificaciones (idUsuario, usuarioAccion, tipoNotificaion) VALUES (:idUsuario, :usuarioAccion, :tipoNotificacion)');
        $this->db->bind(':idUsuario', $datos['idUsuarioPropietario']);
        $this->db->bind(':usuarioAccion', $datos['idusuario']);
        $this->db->bind(':tipoNotificacion', '1');
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function addNotificacionComentarios($datos){
        $this->db->query('INSERT INTO notificaciones (idUsuario, usuarioAccion, tipoNotificaion) VALUES (:idUsuario, :usuarioAccion, :tipoNotificacion)');
        $this->db->bind(':idUsuario', $datos['iduserPropietario']);
        $this->db->bind(':usuarioAccion', $datos['iduser']);
        $this->db->bind(':tipoNotificacion', '2');
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function getNotificaciones($id){
        $this->db->query('SELECT idnotificacion FROM notificaciones WHERE idUsuario = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getMensajes($id) {
        $this->db->query('SELECT COUNT(idmensaje) AS total_mensajes FROM mensajes WHERE usuarios_idusuario = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->register();
        return $result->total_mensajes;
    }
    

    public function getLikesTotales($id) {
        $this->db->query('SELECT SUM(num_likes) AS total_likes FROM publicaciones WHERE idUserPublico = :id');
        $this->db->bind(':id', $id);
        return $this->db->register()->total_likes;
    }

    public function getPublicacionesTotales($id){
        $this->db->query('SELECT COUNT(idpublicacion) AS total_publicaciones FROM publicaciones WHERE idUserPublico = :id');
        $this->db->bind(':id', $id);
        return $this->db->register()->total_publicaciones;
    }

    public function getPublicacionesUsuario($id){
        $this->db->query('SELECT * FROM publicaciones WHERE idUserPublico = :id ORDER BY fechaPublicacion DESC');
        $this->db->bind(':id', $id);
        return $this->db->registers();
    }
    
}
?>