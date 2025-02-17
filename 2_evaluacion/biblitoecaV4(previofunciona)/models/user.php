
<?php
/*
extraer todo lo de vista. Vamos a hacer un modelo por cada entidad y una vista por cada caso de uso
¿y cada vista en una clase diferente?
*/
class User{
    private $db;
    function __construct(){
        $this->db = new DB();
    }
    public function getAll(){
        $q = "SELECT * FROM users ORDER BY user";
        $items = $this->db->myQuery($q);
        return $items;
    }

    public function validate($data) {
        $q = "SELECT iduser FROM users
                 WHERE user = '".($data['user'])."' AND pass = '".($data['pwd'])."'";
        $result = $this->db->myQuery($q);
        // print_r($result);
        if(!empty($result)) $iduser = $result[0]->iduser;
        else $iduser = 0;
        return $iduser;
    }
    public function getRoles($id){
        $roles=['cli','ope','ges','adm'];
        $db=new mysqli("localhost","root","root","books");
        $q = "SELECT nivel FROM users WHERE iduser = ?";
        $result = $db->execute_query($q,[$id]);
        // print_r($result);
        $fila=$result->fetch_object();
        $nivel= $fila->nivel;
        print_r($nivel);
        $rr=[];
        for($i=0;$i<$nivel;$i++) $rr[$roles[$i]]=1;
        return $rr;

        /* $rr = [];
        if ($id==1) $rr['adm'] = 1;
        $rr['cli'] = 1;
        return $rr; */
    }//getRoles


    public static function save($p){
        $db = new mysqli("localhost", "root", "root", "books");

        $q = "INSERT INTO personas (nombre, apellido, pais) VALUES ('$p[nombre]', '$p[apellido]', '$p[pais]')";
        echo $q;
        $result = $db->query($q);

        // if ($result->num_rows != 0) $data['result'] = "Persona insertada con éxito";
        // else $data['result'] = "Ha ocurrido un error al insertar la persona. Por favor, inténtelo más tarde.";

        $db->close();
    }
}
?>