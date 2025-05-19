<?php

class objeto {
    public $nombre;
    public $material;
    public $color;
    public $uso;


    public function __construct(
        $nombre, 
        $material,
        $color,
        $uso

    ) {
        $this->nombre = $nombre;
        $this->material = $material;
        $this->color = $color;
        $this->uso = $uso;

    }

    public function descripcion() {
        echo("la " . $this->nombre . " es de color " . $this->color . " y su material es muy " . $this->material . "<br>");
    }
   public function funcion() {
    echo("La " . $this->nombre . " se utiliza para " . $this->uso . "<br>");
    }

    public function getColor() {
        echo("El color de la " . $this->nombre . " es: " . $this->color . "<br>");
    }


}
 
?>