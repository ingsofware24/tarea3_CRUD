<?php

namespace Model;

class Producto extends ActiveRecord
{
    protected static $tabla = 'productos';
    protected static $idTabla = 'pro_id';
    protected static $columnasDB = ['nombre', 'precio', 'situacion'];

    public $pro_id;
    public $nombre;
    public $precio;
    public $situacion;


    public function __construct($args = [])
    {
        $this->pro_id = $args['pro_id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? 0;
        $this->situacion = $args['situacion'] ?? 1;
    }

    public static function obtenerProductosconQuery()
    {
        $sql = "SELECT * FROM productos where situacion = 1";
        return self::fetchArray($sql);
    }
}
