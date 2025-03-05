<?php
class Usuario
{

    // ATRIBUTOS
    private $nombreDeUsuario;
    private $palabraClave;

    // CONSTRUCTOR DE LA CLASE
    public function Usuario() {}

    // FUNCIONES CONSULTORAS
    public function getNombreDeUsuario()
    {
        return $this->nombreDeUsuario;
    }
    public function getPalabraClave()
    {
        return $this->palabraClave;
    }

    // FUNCIONES MODIFICADORAS
    public function setNombreDeUsuario($nu)
    {
        $this->nombreDeUsuario = $nu;
    }
    public function setPalabraClave($pc)
    {
        $this->palabraClave = $pc;
    }
}

// Crear un objeto de la clase Usuario


$usuario = new Usuario();
$usuario->setNombreDeUsuario('chanquete');
$usuario->setPalabraClave('hamuerto');

echo 'Nombre de Usuario: ' . $usuario->getNombreDeUsuario() . '<br>';
echo 'Palabra Clave: ' . $usuario->getPalabraClave() . '<br>';

$usuario->setPalabraClave('nonosmoveran');

echo 'Nombre de Usuario: ' . $usuario->getNombreDeUsuario() . '<br>';
echo 'Palabra Clave: ' . $usuario->getPalabraClave() . '<br>';
?>