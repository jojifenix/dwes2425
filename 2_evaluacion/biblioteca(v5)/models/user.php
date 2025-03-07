
<?php
/*
extraer todo lo de vista. Vamos a hacer un modelo por cada entidad y una vista por cada caso de uso
¿y cada vista en una clase diferente?
*/
class User
{

    private $db;

    function __construct()
    {
        $this->db = new DB();
    }

    public function getAll()
    {
        $q = "SELECT * FROM users ORDER BY user";
        $items = $this->db->myQuery($q);
        return $items;
    }

    public function validate($data) {
        $q = "SELECT iduser FROM users WHERE user = '".($data['user'])."' AND pass = '".($data['pwd'])."'";
        $result = $this->db->myQuery($q);

        // print_r($result);

        // if(!empty($result)) $iduser = $result[0]->iduser;
        // else $iduser = 0;

        if(isset($result[0]->iduser)) $iduser = $result[0]->iduser;
        else $iduser = 0;   

        return $iduser;
    }

    public function getRoles($id) {

        $db = new mysqli ("localhost", "root", "root", "books");
        $roles=['cli', 'ope', 'ges', 'adm'];

        $q = "SELECT nivel from users where iduser = ?";
        $result = $db->execute_query($q, [$id]);
        $fila = $result->fetch_object();
        $nivel = $fila->nivel;

        // for ($i=0; $i<count($roles); $i++) {
           
        // }
        $rr = [];
        for($i=0; $i<=$nivel; $i++) $rr[$roles[$i]] = 1;
        return $rr;

        // $rr = [];
        // if ($id==1) $rr['adm'] = 1;
        // $rr['cli'] = 1;

        // //el admin tendra los 2 roles. Los demás solo cli

        // return $rr; 
    }


    public static function save($p)
    {
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