<?php

class perfilUsuario{
   
    private $db;
    
    public function __construct(){
        $this->db = new Base;
    }

    public function editarFoto($datos){
        $this->db->query('UPDATE perfil SET fotoPerfil = :ruta WHERE idUsuario = :id');
        $this->db->bind(':ruta', $datos['ruta']);
        $this->db->bind(':id', $datos['idusuario']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


}
?>