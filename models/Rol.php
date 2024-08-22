<?php

namespace Model;

class Rol extends ActiveRecord
{
    protected static $tabla = 'rol';
    protected static $idTabla = 'rol_id';
    protected static $columnasDB = ['rol_id', 'rol_nombre', 'rol_nombre_ct', 'rol_app', 'rol_situacion'];

    public $rol_id;
    public $rol_nombre;
    public $rol_nombre_ct;
    public $rol_app;
    public $rol_situacion;


    public function __construct($args = [])
    {
        $this->rol_id = $args['rol_id'] ?? null;
        $this->rol_nombre = $args['rol_nombre'] ?? '';
        $this->rol_nombre_ct = $args['rol_nombre_ct'] ?? '';
        $this->rol_app = $args['rol_app'] ?? '';
        $this->rol_situacion = $args['rol_situacion'] ?? 1;
    }

    public static function obtenerRolconQuery()
    {
        $sql = "SELECT * FROM rol where rol_situacion = 1";
        return self::fetchArray($sql);
    }
}
