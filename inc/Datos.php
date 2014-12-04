<?php 
include_once("Conexion.php");

class  Datos{
	
   private $PDO;
   public  $Numero_Renglones;
	
	function Conectar(){
		
	try{	
	$StringConexion=new  Conexion();	 
	$this->PDO=new PDO ("mysql:host=$StringConexion->Servidor;dbname=$StringConexion->Basededatos", $StringConexion->Usuario, $StringConexion->Contrasena);
	
	  } catch (PDOException $e) {
		   echo $e->getMessage();
		  }
	
	
	}
		
	function Select($SQL){
	
	try{
	$resultado = $this->PDO->query($SQL);
	while($row =$resultado->fetch(PDO::FETCH_ASSOC)) 
					{
           $Datos[]=$row;
					 $this->Nombre_Columnas= array_keys($row); 
					}	
					
				$this->Numero_Renglones = count($Datos);
	
	return  $Datos;
	}
	catch(PDOException $e){
		echo $e->getMessage();
		}
	
	}
//--------------------------------------------------------------------
	public  function Cerrar_Conexion(){
		
		$this->PDO=NULL;
		
		}
//---------------------------------------------------------------------------	
	public function Seleccionar_json($sql){
		
	
			return json_encode($this->Select($sql));
		
		}
//-------------------------------------------------------------------------------
	function Insert($SQL){
	
	try{
	$resultado = $this->PDO->exec($SQL);
	
	
	return $resultado;
	}
	catch(PDOException $e){
		echo $e->getMessage();
		}
	
	}	
	

//--------------------------------------------------------------------------------
function Eliminar($Tabla,$Condicion){
	
	try{
	$resultado = $this->PDO->exec("DELETE FROM $Tabla WHERE ".$Condicion);
	
	
	return $resultado;
	}
	catch(PDOException $e){
		echo $e->getMessage();
		}
	
	}	
	
}


?>