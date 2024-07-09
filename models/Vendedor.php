<?php 
namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
     {   // Plano nuevo para Crear.php
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validar(){
         
        if (!$this->nombre) {
            self::$errores[] = 'Debes añadir un Nombre';
        }
        if (!$this->apellido) {
            self::$errores[] = 'Debes añadir un Apellido';
        }
        if (!$this->telefono) {
            self::$errores[] = 'Debes añadir un Telefono';
        }

        if(!preg_match('/[0-9]{12}/', $this->telefono)){ //busca un patron dentro de un texto, (como primer valor establecemos un formato, despues la variable que vamos a consultar)
            self::$errores[] = 'Formato de telefono no válido';
        }
        return self::$errores;
    }

}