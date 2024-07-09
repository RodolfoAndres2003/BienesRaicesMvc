<?php

namespace Model;

class Propiedad  extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'wc', 'habitaciones', 'estacionamiento', 'creado', 'vendedoresId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedoresId;

    public function __construct($args = [])
    {   // Plano nuevo para Crear.php
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedoresId = $args['vendedoresId'] ?? '';
    }
    public function validar(){
         
        if (!$this->titulo) {
            self::$errores[] = 'Debes añadir un Titulo';
        }
        
        if (!$this->precio) {
            self::$errores[] = 'El Precio es Obligatorio';
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'La Descripción es obligatoria y debe tener al menos 50 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'La Cantidad de Habitaciones es obligatoria';
        }
        if (!$this->wc) {
            self::$errores[] = 'La cantidad de Baños es obligatoria';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'La cantidad de lugares de estacionamiento es obligatoria';
        }
        if (!$this->vendedoresId) {
            self::$errores[] = 'Elige un vendedor';
        }
        if (!$this->imagen) {
            self::$errores[] = 'La imagen es Obligatoria';
        }
        return self::$errores;      
    }
}