<?php 

/* CONEXIÓN A BASE DE DATOS */

$con = new PDO("mysql:host=localhost; dbname=appointment", "root", "dExter@2313", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

/* MUESTRA UN REGISTRO */
if ($_SERVER["REQUEST_METHOD"]=="GET"){	
 	if(isset($_GET["dni"]) && isset($_GET["correoprofesional"])){
		$stmt = $con->prepare("SELECT * FROM turno WHERE dni = :dni AND correoprofesional = :correoprofesional");
		$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":correoprofesional", $_GET["correoprofesional"], PDO::PARAM_STR);
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
	}else 	if(isset($_GET["dni"])){
		$stmt = $con->prepare("SELECT * FROM turno WHERE dni = :dni ");
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
	}else 	if(isset($_GET["correoprofesional"])){
		$stmt = $con->prepare("SELECT * FROM turno WHERE correoprofesional = :correoprofesional ");
		$stmt->bindParam(":correoprofesional", $_GET["correoprofesional"], PDO::PARAM_STR);
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
		$stmt = $con->prepare("INSERT INTO turno ( correoprofesional,archivo5,archivo4,archivo3,archivo2,archivo1,estado, dni, prestacion, fecha, hora, comentario, especialidad, nombrepaciente, nombreprofesional, img) VALUES (:correoprofesional,:archivo5,:archivo4,:archivo3,:archivo2,:archivo1,:estado,:dni, :prestacion, :fecha, :hora, :comentario, :especialidad, :nombrepaciente, :nombreprofesional, :img);");
	$stmt->bindParam(":correoprofesional", $_POST["correoprofesional"], PDO::PARAM_STR);
			$stmt->bindParam(":archivo5", $_POST["archivo5"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo4", $_POST["archivo4"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo3", $_POST["archivo3"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo2", $_POST["archivo2"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo1", $_POST["archivo1"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $_POST["estado"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
	$stmt->bindParam(":prestacion", $_POST["prestacion"], PDO::PARAM_STR);
	$stmt->bindParam(":fecha", $_POST["fecha"], PDO::PARAM_STR);
	$stmt->bindParam(":hora", $_POST["hora"], PDO::PARAM_STR);
	$stmt->bindParam(":comentario", $_POST["comentario"], PDO::PARAM_STR);
	$stmt->bindParam(":especialidad", $_POST["especialidad"], PDO::PARAM_STR);
	$stmt->bindParam(":nombrepaciente", $_POST["nombrepaciente"], PDO::PARAM_STR);
	$stmt->bindParam(":nombreprofesional", $_POST["nombreprofesional"], PDO::PARAM_STR);
	$stmt->bindParam(":img", $_POST["img"], PDO::PARAM_STR);


	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));
/*MODIFICAR UN REGISTRO*/
}else if($_POST["modificar"]=="modificar"){
	$stmt = $con->prepare("UPDATE turno SET 
	correoprofesional=:correoprofesional,
	archivo5=:archivo5,
	archivo4=:archivo4,
	archivo3=:archivo3,
	archivo2=:archivo2,
	archivo1=:archivo1,
	estado=:estado, 
	dni=:dni,
	nombrepaciente=:nombrepaciente, 
	prestacion=:prestacion,
	fecha=:fecha, 
	hora=:hora ,
	especialidad=:especialidad,
	nombreprofesional=:nombreprofesional,
	comentario=:comentario,
	img=:img 
	WHERE dni = :dni AND correoprofesional = :correoprofesional AND fecha = :fecha");
	$stmt->bindParam(":correoprofesional", $_POST["correoprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo5", $_POST["archivo5"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo4", $_POST["archivo4"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo3", $_POST["archivo3"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo2", $_POST["archivo2"], PDO::PARAM_STR);
	$stmt->bindParam(":archivo1", $_POST["archivo1"], PDO::PARAM_STR);
	$stmt->bindParam(":estado", $_POST["estado"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
	$stmt->bindParam(":prestacion", $_POST["prestacion"], PDO::PARAM_STR);
	$stmt->bindParam(":fecha", $_POST["fecha"], PDO::PARAM_STR);
	$stmt->bindParam(":hora", $_POST["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":especialidad", $_POST["especialidad"], PDO::PARAM_STR);
	$stmt->bindParam(":nombreprofesional", $_POST["nombreprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $_POST["comentario"], PDO::PARAM_STR);
	$stmt->bindParam(":nombrepaciente", $_POST["nombrepaciente"], PDO::PARAM_STR);
	$stmt->bindParam(":img", $_POST["img"], PDO::PARAM_STR);


	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}
	



/*BORRO UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="DELETE"){

	$stmt = $con->prepare("DELETE FROM turno WHERE turnoid = :turnoid");
	$stmt->bindParam(":turnoid", $_GET["turnoid"], PDO::PARAM_STR);

	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}

exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}











