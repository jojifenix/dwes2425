<?php

//Clase del modelo
//Contiene métodos generales para acceder a la BD

//habilitar las excepciones en mysqli para usar try catch
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


class Db
{
    private $db;

    function __construct()
    {
        require_once 'config.inc';
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        if ($this->db->connect_errno) return -1;
        else return 0;
    }

    function close()
    {
        if ($this->db) $this->db->close();
    }

    //Lanza una consulta $q de tipo select y devuelve un array bidimensional
    //con los resultados. Si no hay resultados, devuelve un array vacío
    function myQuery($q)
    {


        try {
            $result = $this->db->execute_query($q);

            $items = [];
            if ($result->num_rows != 0) {
                while ($fila = $result->fetch_object()) {
                    $items[] = $fila;
                }
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $result->close();
        }

        return $items;
    }


}
