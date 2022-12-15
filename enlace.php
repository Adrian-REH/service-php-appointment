<?php 

/* CONEXIÓN A BASE DE DATOS */

$con = new PDO("mysql:host=localhost; dbname=appointment", "root", "dExter@2313", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

/* MUESTRA UN REGISTRO */
if ($_SERVER["REQUEST_METHOD"]=="GET"){	
 	if(isset($_GET["pacientedni"]) && isset($_GET["profecionalemail"])){
		$stmt = $con->prepare("SELECT * FROM enlace WHERE pacientedni = :pacientedni AND profecionalemail = :profecionalemail");
		$stmt->bindParam(":pacientedni", $_GET["pacientedni"], PDO::PARAM_STR);
		$stmt->bindParam(":profecionalemail", $_GET["profecionalemail"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
	}else 	if(isset($_GET["pacientedni"])){
		$stmt = $con->prepare("SELECT * FROM enlace WHERE pacientedni = :pacientedni ");
		$stmt->bindParam(":pacientedni", $_GET["pacientedni"], PDO::PARAM_STR);
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
	}else 	if(isset($_GET["profecionalemail"])){
		$stmt = $con->prepare("SELECT * FROM enlace WHERE profecionalemail = :profecionalemail ");
		$stmt->bindParam(":profecionalemail", $_GET["profecionalemail"], PDO::PARAM_STR);
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
	}else 	if(isset($_GET["especialidad"])){
		$stmt = $con->prepare("SELECT * FROM enlace WHERE especialidad = :especialidad ");
		$stmt->bindParam(":especialidad", $_GET["especialidad"], PDO::PARAM_STR);
		$stmt->execute();
	    if($stmt->execute()){
        $json="{\"data\":";
        while($row = $stmt->fetchAll()){
            $json=$json.json_encode($row);
            $json=$json.",";
        }
        $json=substr(trim($json),0,-1);
        $json=$json."}";
    }
    echo $json;	
	}



/*INSERTAR UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["insertar"]=="insertar"){
		$stmt = $con->prepare("INSERT INTO enlace (  profecionalemail, pacientedni, especialidad, estadoprofecional, nombreprofesional, nombrecliente) VALUES ( :profecionalemail, :pacientedni, :especialidad, :estadoprofecional, :nombreprofesional, :nombrecliente);");
	$stmt->bindParam(":profecionalemail", $_POST["profecionalemail"], PDO::PARAM_STR);
	$stmt->bindParam(":pacientedni", $_POST["pacientedni"], PDO::PARAM_STR);
	$stmt->bindParam(":especialidad", $_POST["especialidad"], PDO::PARAM_STR);
	$stmt->bindParam(":estadoprofecional", $_POST["estadoprofecional"], PDO::PARAM_STR);
	$stmt->bindParam(":nombreprofesional", $_POST["nombreprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":nombrecliente", $_POST["nombrecliente"], PDO::PARAM_STR);


	if($stmt->execute()){
		$stmt = $con->prepare("SELECT * FROM enlace WHERE pacientedni = :pacientedni AND profecionalemail = :profecionalemail");
		$stmt->bindParam(":pacientedni", $_POST["pacientedni"], PDO::PARAM_STR);
		$stmt->bindParam(":profecionalemail", $_POST["profecionalemail"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
	} else {
		$results = "error";
	}
exit (json_encode($results,JSON_UNESCAPED_UNICODE));

/*MODIFICAR UN REGISTRO*/
	}else if($_POST["modificar"]=="modificar"){
		$stmt = $con->prepare("UPDATE enlace SET  profecionalemail=:profecionalemail, pacientedni=:pacientedni, especialidad=:especialidad , estadoprofecional=:estadoprofecional, nombreprofesional=:nombreprofesional, nombrecliente=:nombrecliente WHERE pacientedni = :pacientedni AND profecionalemail = :profecionalemail");
		$stmt->bindParam(":profecionalemail", $_POST["profecionalemail"], PDO::PARAM_STR);
		$stmt->bindParam(":pacientedni", $_POST["pacientedni"], PDO::PARAM_STR);
		$stmt->bindParam(":especialidad", $_POST["especialidad"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoprofecional", $_POST["estadoprofecional"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreprofesional", $_POST["nombreprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":nombrecliente", $_POST["nombrecliente"], PDO::PARAM_STR);
		
		if($stmt->execute()){
		$stmt = $con->prepare("SELECT * FROM enlace WHERE pacientedni = :pacientedni AND profecionalemail = :profecionalemail");
		$stmt->bindParam(":pacientedni", $_POST["pacientedni"], PDO::PARAM_STR);
		$stmt->bindParam(":profecionalemail", $_POST["profecionalemail"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		} else {
			$results = "error";
		}




	exit (json_encode($results,JSON_UNESCAPED_UNICODE));

	}

/*BORRO UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="DELETE"){

	$stmt = $con->prepare("DELETE FROM enlace WHERE pacientedni = :pacientedni AND profecionalemail = :profecionalemail");
	$stmt->bindParam(":pacientedni", $_GET["pacientedni"], PDO::PARAM_STR);
	$stmt->bindParam(":profecionalemail", $_GET["profecionalemail"], PDO::PARAM_STR);

	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}

exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}











