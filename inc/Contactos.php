<?php 
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
include_once("Datos.php");

$Contactos=new Datos();



$Contactos->Conectar();

$C=$Contactos->Select("Select * from CONTACTO");


foreach ($C as $key => $value)  {
	   
     $C[$key]["Telefonos"]=$Contactos->Select("select * from  TELEFONO where idContacto=$value[idUsuario]");

}


echo json_encode($C);






 ?>