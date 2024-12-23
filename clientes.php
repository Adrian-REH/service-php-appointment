<?php 

/* CONEXIÓN A BASE DE DATOS */

$con = new PDO("mysql:host=localhost; dbname=appointment", "root", "dExter@2313", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

/* MUESTRA UN REGISTRO */
if ($_SERVER["REQUEST_METHOD"]=="GET"){	
 	if(isset($_GET["dni"]) && isset($_GET["correo"])){
		$stmt = $con->prepare("SELECT * FROM clientes WHERE dni = :dni AND correo=:correo");
		$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
	}else 	if(isset($_GET["idclientes"])){
		$stmt = $con->prepare("SELECT * FROM clientes WHERE idclientes = :idclientes ");
		$stmt->bindParam(":idclientes", $_GET["idclientes"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
	}else 	if(isset($_GET["correo"])){
		$stmt = $con->prepare("SELECT * FROM clientes WHERE correo = :correo ");
		$stmt->bindParam(":correo", $_GET["correo"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
		
		
		
	}else 	if(isset($_GET["todos"])){
		$stmt = $con->prepare("SELECT * FROM clientes");
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
		$stmt = $con->prepare("INSERT INTO clientes ( correo, dni, direccion, nombreapellido, img, celular, TokenID) VALUES (:correo, :dni, :direccion, :nombreapellido, :img, :celular, :TokenID);");
	$stmt->bindParam(":correo", $_POST["correo"], PDO::PARAM_STR);
	$stmt->bindParam(":direccion", $_POST["direccion"], PDO::PARAM_STR);
	$stmt->bindParam(":nombreapellido", $_POST["nombreapellido"], PDO::PARAM_STR);
	$stmt->bindParam(":img", $_POST["img"], PDO::PARAM_STR);
	$stmt->bindParam(":celular", $_POST["celular"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
	$stmt->bindParam(":TokenID", $_POST["TokenID"], PDO::PARAM_STR);


	if($stmt->execute()){
		$stmt = $con->prepare("SELECT * FROM clientes WHERE dni = :dni");
		$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));
/*MODIFICAR UN REGISTRO*/
}else if($_POST["modificar"]=="modificar"){
	$stmt = $con->prepare("UPDATE clientes SET correo=:correo, dni=:dni, direccion=:direccion, nombreapellido=:nombreapellido, celular=:celular , img=:img, TokenID=:TokenID WHERE idclientes = :idclientes");
	$stmt->bindParam(":correo", $_POST["correo"], PDO::PARAM_STR);
	$stmt->bindParam(":direccion", $_POST["direccion"], PDO::PARAM_STR);
	$stmt->bindParam(":nombreapellido", $_POST["nombreapellido"], PDO::PARAM_STR);
	$stmt->bindParam(":img", $_POST["img"], PDO::PARAM_STR);
	$stmt->bindParam(":celular", $_POST["celular"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
	$stmt->bindParam(":TokenID", $_POST["TokenID"], PDO::PARAM_STR);
	$stmt->bindParam(":idclientes", $_POST["idclientes"], PDO::PARAM_STR);


	if($stmt->execute()){
		$stmt = $con->prepare("SELECT * FROM clientes WHERE dni = :dni");
		$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}
	



/*BORRO UN REGISTRO*/
} else if ($_SERVER["REQUEST_METHOD"]=="DELETE"){

	$stmt = $con->prepare("DELETE FROM clientes WHERE dni = :dni");
	$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);

	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}

exit (json_encode($results,JSON_UNESCAPED_UNICODE));

}











