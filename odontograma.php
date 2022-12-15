<?php 

/* CONEXIÓN A BASE DE DATOS */

$con = new PDO("mysql:host=localhost; dbname=appointment", "root", "dExter@2313", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

/* MUESTRA UN REGISTRO */
if ($_SERVER["REQUEST_METHOD"]=="GET"){	
 	if(isset($_GET["dni"]) && isset($_GET["codigoprofesional"]) &&isset($_GET["fecha"])){
		$stmt = $con->prepare("SELECT * FROM odontograma WHERE codigoprofesional = :codigoprofesional AND dni = :dni AND fecha =:fecha ");
		$stmt->bindParam(":codigoprofesional", $_GET["codigoprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $_GET["fecha"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
	}else 	if(isset($_GET["dni"])){
		$stmt = $con->prepare("SELECT * FROM odontograma WHERE dni = :dni ");
		$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);
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
	}else 	if(isset($_GET["codigoprofesional"])){
		$stmt = $con->prepare("SELECT * FROM odontograma WHERE codigoprofesional = :codigoprofesional ");
		$stmt->bindParam(":codigoprofesional", $_GET["codigoprofesional"], PDO::PARAM_STR);
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


/*INSERTAR UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["insertar"]=="insertar"){
		$stmt = $con->prepare("INSERT INTO odontograma ( dientes,odontogramaid,codigoprofesional,dni,fecha) VALUES ( :dientes,:odontogramaid,:codigoprofesional,:dni,:fecha);");
	$stmt->bindParam(":dientes", $_POST["dientes"], PDO::PARAM_STR);
	$stmt->bindParam(":odontogramaid", $_POST["odontogramaid"], PDO::PARAM_STR);
	$stmt->bindParam(":codigoprofesional", $_POST["codigoprofesional"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
	$stmt->bindParam(":fecha", $_POST["fecha"], PDO::PARAM_STR);


	if($stmt->execute()){

		$stmt = $con->prepare("SELECT * FROM odontograma WHERE codigoprofesional = :codigoprofesional AND dni = :dni AND fecha = :fecha ");
		$stmt->bindParam(":codigoprofesional", $_POST["codigoprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $_POST["fecha"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();

	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));
/*MODIFICAR UN REGISTRO*/
	}else if($_POST["modificar"]=="modificar"){
	$stmt = $con->prepare("UPDATE odontograma SET  codigoprofesional=:codigoprofesional, odontogramaid=:odontogramaid, dni=:dni, dientes=:dientes, fecha=:fecha WHERE codigoprofesional = :codigoprofesional AND dni = :dni AND odontogramaid = :odontogramaid");
	$stmt->bindParam(":dientes", $_POST["dientes"], PDO::PARAM_STR);
	$stmt->bindParam(":odontogramaid", $_POST["odontogramaid"], PDO::PARAM_STR);
	$stmt->bindParam(":codigoprofesional", $_POST["codigoprofesional"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
	$stmt->bindParam(":fecha", $_POST["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){
		$stmt = $con->prepare("SELECT * FROM odontograma WHERE codigoprofesional = :codigoprofesional AND dni = :dni AND fecha = :fecha ");
		$stmt->bindParam(":codigoprofesional", $_POST["codigoprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $_POST["fecha"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		} else {
			$results = "error";
		}




	exit (json_encode($results,JSON_UNESCAPED_UNICODE));

	}

/*BORRO UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="DELETE"){

	$stmt = $con->prepare("DELETE FROM odontograma WHERE codigoprofesional = :codigoprofesional AND dni = :dni");
	$stmt->bindParam(":codigoprofesional", $_GET["codigoprofesional"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);

	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}

exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}











