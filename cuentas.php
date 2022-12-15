<?php 

/* CONEXIÓN A BASE DE DATOS */

$con = new PDO("mysql:host=localhost; dbname=appointment", "root", "dExter@2313", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

/* MUESTRA UN REGISTRO */
if ($_SERVER["REQUEST_METHOD"]=="GET"){	
 	if(isset($_GET["clienteid"]) && isset($_GET["unico"])){
		$stmt = $con->prepare("SELECT * FROM profesional WHERE clienteid = :clienteid");
		$stmt->bindParam(":clienteid", $_GET["clienteid"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
		
	}else 	if(isset($_GET["correo"])){
		$stmt = $con->prepare("SELECT * FROM profesional WHERE correo = :correo ");
		$stmt->bindParam(":correo", $_GET["correo"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
		
		
		
		
	}else 	if(isset($_GET["idprofesional"])){
		$stmt = $con->prepare("SELECT * FROM profesional WHERE idprofesional = :idprofesional ");
		$stmt->bindParam(":idprofesional", $_GET["idprofesional"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
		
		
		
		
	}else 	if(isset($_GET["todos"])){
		$stmt = $con->prepare("SELECT * FROM profesional");
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
		$stmt = $con->prepare("INSERT INTO profesional ( correo, celular, nombreapellido, direccion, horarios, prestaciones, especialidad, img, matricula, verificar, TokenID, dni) VALUES (:correo, :celular, :nombreapellido, :direccion, :horarios, :prestaciones, :especialidad, :img, :matricula, :verificar, :TokenID, :dni);");
	$stmt->bindParam(":correo", $_POST["correo"], PDO::PARAM_STR);
	$stmt->bindParam(":celular", $_POST["celular"], PDO::PARAM_STR);
	$stmt->bindParam(":direccion", $_POST["direccion"], PDO::PARAM_STR);
	$stmt->bindParam(":nombreapellido", $_POST["nombreapellido"], PDO::PARAM_STR);
	$stmt->bindParam(":horarios", $_POST["horarios"], PDO::PARAM_STR);
	$stmt->bindParam(":prestaciones", $_POST["prestaciones"], PDO::PARAM_STR);
	$stmt->bindParam(":especialidad", $_POST["especialidad"], PDO::PARAM_STR);
	$stmt->bindParam(":img", $_POST["img"], PDO::PARAM_STR);
	$stmt->bindParam(":matricula", $_POST["matricula"], PDO::PARAM_STR);
	$stmt->bindParam(":verificar", $_POST["verificar"], PDO::PARAM_STR);
	$stmt->bindParam(":TokenID", $_POST["TokenID"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);


	if($stmt->execute()){
		$stmt = $con->prepare("SELECT * FROM profesional WHERE correo = :correo");
		$stmt->bindParam(":correo", $_POST["correo"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));
/*MODIFICAR UN REGISTRO*/
}else if($_POST["modificar"]=="modificar"){
	$stmt = $con->prepare("UPDATE profesional SET correo=:correo, celular=:celular, direccion=:direccion, nombreapellido=:nombreapellido, horarios=:horarios , prestaciones=:prestaciones, especialidad=:especialidad, img=:img , matricula=:matricula , TokenID=:TokenID , verificar=:verificar, dni=:dni WHERE idprofesional = :idprofesional");
	$stmt->bindParam(":correo", $_POST["correo"], PDO::PARAM_STR);
	$stmt->bindParam(":celular", $_POST["celular"], PDO::PARAM_STR);
	$stmt->bindParam(":direccion", $_POST["direccion"], PDO::PARAM_STR);
	$stmt->bindParam(":nombreapellido", $_POST["nombreapellido"], PDO::PARAM_STR);
	$stmt->bindParam(":horarios", $_POST["horarios"], PDO::PARAM_STR);
	$stmt->bindParam(":prestaciones", $_POST["prestaciones"], PDO::PARAM_STR);
	$stmt->bindParam(":especialidad", $_POST["especialidad"], PDO::PARAM_STR);
	$stmt->bindParam(":img", $_POST["img"], PDO::PARAM_STR);
	$stmt->bindParam(":TokenID", $_POST["TokenID"], PDO::PARAM_STR);
	$stmt->bindParam(":matricula", $_POST["matricula"], PDO::PARAM_STR);
	$stmt->bindParam(":verificar", $_POST["verificar"], PDO::PARAM_STR);
	$stmt->bindParam(":idprofesional", $_POST["idprofesional"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
	if($stmt->execute()){
		$stmt = $con->prepare("SELECT * FROM profesional WHERE correo = :correo");
		$stmt->bindParam(":correo", $_POST["correo"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}
	



/*BORRO UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="DELETE"){

	$stmt = $con->prepare("DELETE FROM profesional WHERE correo = :correo");
	$stmt->bindParam(":correo", $_GET["correo"], PDO::PARAM_STR);

	if($stmt->execute()){
		$results = "ok";

	} else {
		$results = "error";
	}

exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}











