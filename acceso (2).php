<?php 
$rann = rand(22,99999);
$password = "SS4WJOA58mkhWFkLLzC3LA==";
$usuario = "lsuRb/c6GKDIG7lt";
	$_SESSION['usuario']="";


 if(isset($_GET["usuario"])&&isset($_GET["password"])){
	 echo "{	\"data\": [	{ \"usuario\": \"$usuario\",\"password\": \"$password\"}]}";
 }


	if($_POST["usuario"]== $usuario && $_POST["password"]== $password){
	$_SESSION['usuario']="alm";

	}else{exit;}
		



if($_SESSION['usuario']=="alm"){
/////////////////////////SUBIR UN NUEVO FICHERO/////////////////////
if ($_SERVER["REQUEST_METHOD"]=="POST"){
			
		$dir = "/appointment/";
		if(isset($_FILES["docs"]) && $_FILES["docs"] != null){
			$fichero = $_SERVER['DOCUMENT_ROOT']."{$dir}docs/";
				if(move_uploaded_file($_FILES["docs"]["tmp_name"], $fichero.basename($_FILES["docs"]["name"]))){
					echo "Subido correctamente";
				}else{
					echo "Error al intentar subir";
				}
     
		}
//////////////////////////ELIMINAR FICHEROS EXISTENTES///////////////////////////////////////////////
		 if (isset($_POST['borrar'])){
			$borrarFor=($_POST['borrar']);
			@unlink('docs/'.$borrarFor);
			}
	

	}else{
		
	}


}

else{
	echo"No se puedo compeltar la accion";
}
?>



