<?php 

/* CONEXIÓN A BASE DE DATOS */

$con = new PDO("mysql:host=localhost; dbname=appointment", "root", "dExter@2313", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

/* MUESTRA UN REGISTRO */
if ($_SERVER["REQUEST_METHOD"]=="GET"){	
 	if(isset($_GET["especialidad"])){
		$stmt = $con->prepare("SELECT * FROM especialidades WHERE especialidad = :especialidad");
		$stmt->bindParam(":especialidad", $_GET["especialidad"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
	}else 	if(isset($_GET["todos"])){
		$stmt = $con->prepare("SELECT * FROM especialidades");
		$stmt->execute();
	    if($stmt->execute()){
        $json="";
        while($row = $stmt->fetchAll()){
            $json=$json.json_encode($row);
            $json=$json.",";
        }
        $json=substr(trim($json),0,-1);
        $json=$json."";
    }
    echo $json;	
	}



/*BORRO UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="DELETE"){

	$stmt = $con->prepare("DELETE FROM especialidades WHERE clienteid = :clienteid");
	$stmt->bindParam(":clienteid", $_GET["clienteid"], PDO::PARAM_STR);

	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}

exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}











