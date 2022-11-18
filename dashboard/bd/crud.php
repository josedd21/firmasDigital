<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS

$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$sede = (isset($_POST['sede'])) ? $_POST['sede'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$cargo = (isset($_POST['cargo'])) ? $_POST['cargo'] : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';
$signatur = (isset($_POST['signatur'])) ? $_POST['signatur'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO personas (cedula, sede, nombre, cargo, area, signatur) VALUES('$cedula','$sede','$nombre', '$cargo', '$area','$signatur') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, cedula, sede,nombre, cargo, area, signatur FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET cedula='$cedula',sede='$sede',nombre='$nombre', cargo='$cargo', area='$area',signatur='$signatur' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, cedula, sede,nombre, cargo, area, signatur FROM personas WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM personas WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
