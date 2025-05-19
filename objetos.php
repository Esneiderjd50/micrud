<?php
include_once('clase/objeto.php');

$lapto = new objeto('lapto' ,'duro' , 'negro', 'trabajo');
$lapto->descripcion();
$lapto->funcion();
$lapto->getColor();

$almohada = new objeto('almohada', 'blando' , 'verde' , 'descanso');

$almohada->descripcion();
$almohada->funcion();
$almohada->getColor();


$cama = new objeto('cama', 'dura', 'azul', 'descanso');
$cama->descripcion();
$cama->funcion();
$cama->getColor();