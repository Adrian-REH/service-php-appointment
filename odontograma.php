<?php 

/* CONEXIÓN A BASE DE DATOS */

$con = new PDO("mysql:host=localhost; dbname=appointment", "root", "dExter@2313", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

/* MUESTRA UN REGISTRO */
if ($_SERVER["REQUEST_METHOD"]=="GET"){	
 	if(isset($_GET["codigoprofesional"])){
		$stmt = $con->prepare("SELECT * FROM odontograma WHERE codigoprofesional = :codigoprofesional AND dni = :dni ");
		$stmt->bindParam(":codigoprofesional", $_GET["codigoprofesional"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetch();
		exit (json_encode($results,JSON_UNESCAPED_UNICODE));
	}else 	if(isset($_GET["dni"])){
		$stmt = $con->prepare("SELECT * FROM odontograma WHERE dni = :dni ");
		$stmt->bindParam(":dni", $_GET["dni"], PDO::PARAM_STR);
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
	}else 	if(isset($_GET["codigoprofesional"])){
		$stmt = $con->prepare("SELECT * FROM odontograma WHERE codigoprofesional = :codigoprofesional ");
		$stmt->bindParam(":codigoprofesional", $_GET["codigoprofesional"], PDO::PARAM_STR);
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
		$stmt = $con->prepare("INSERT INTO odontograma ( d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, codigoprofesional,dni) VALUES ( :d1, :d2, :d3, :d4, :d5, :d6, :d7, :d8, :d9, :d10, :d11, :d12, :d13, :d14, :d15, :d16, :d17, :d18, :d19, :d20, :d21, :d22, :d23, :d24, :d25, :d26, :d27, :d28, :d29, :d30, :d31, :d32, :codigoprofesional,:dni);");
	$stmt->bindParam(":d1", $_POST["d1"], PDO::PARAM_STR);
	$stmt->bindParam(":d2", $_POST["d2"], PDO::PARAM_STR);
	$stmt->bindParam(":d3", $_POST["d3"], PDO::PARAM_STR);
	$stmt->bindParam(":d4", $_POST["d4"], PDO::PARAM_STR);
	$stmt->bindParam(":d5", $_POST["d5"], PDO::PARAM_STR);
	$stmt->bindParam(":d6", $_POST["d6"], PDO::PARAM_STR);
	$stmt->bindParam(":d7", $_POST["d7"], PDO::PARAM_STR);
	$stmt->bindParam(":d8", $_POST["d8"], PDO::PARAM_STR);
	$stmt->bindParam(":d9", $_POST["d9"], PDO::PARAM_STR);
	$stmt->bindParam(":d10", $_POST["d10"], PDO::PARAM_STR);
	$stmt->bindParam(":d11", $_POST["d11"], PDO::PARAM_STR);
	$stmt->bindParam(":d12", $_POST["d12"], PDO::PARAM_STR);
	$stmt->bindParam(":d13", $_POST["d13"], PDO::PARAM_STR);
	$stmt->bindParam(":d14", $_POST["d14"], PDO::PARAM_STR);
	$stmt->bindParam(":d15", $_POST["d15"], PDO::PARAM_STR);
	$stmt->bindParam(":d16", $_POST["d16"], PDO::PARAM_STR);
	$stmt->bindParam(":d17", $_POST["d17"], PDO::PARAM_STR);
	$stmt->bindParam(":d18", $_POST["d18"], PDO::PARAM_STR);
	$stmt->bindParam(":d19", $_POST["d19"], PDO::PARAM_STR);
	$stmt->bindParam(":d20", $_POST["d20"], PDO::PARAM_STR);
	$stmt->bindParam(":d21", $_POST["d21"], PDO::PARAM_STR);
	$stmt->bindParam(":d22", $_POST["d22"], PDO::PARAM_STR);
	$stmt->bindParam(":d23", $_POST["d23"], PDO::PARAM_STR);
	$stmt->bindParam(":d24", $_POST["d24"], PDO::PARAM_STR);
	$stmt->bindParam(":d25", $_POST["d25"], PDO::PARAM_STR);
	$stmt->bindParam(":d26", $_POST["d26"], PDO::PARAM_STR);
	$stmt->bindParam(":d27", $_POST["d27"], PDO::PARAM_STR);
	$stmt->bindParam(":d28", $_POST["d28"], PDO::PARAM_STR);
	$stmt->bindParam(":d29", $_POST["d29"], PDO::PARAM_STR);
	$stmt->bindParam(":d30", $_POST["d30"], PDO::PARAM_STR);
	$stmt->bindParam(":d31", $_POST["d31"], PDO::PARAM_STR);
	$stmt->bindParam(":d32", $_POST["d32"], PDO::PARAM_STR);
	$stmt->bindParam(":codigoprofesional", $_POST["codigoprofesional"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);


	if($stmt->execute()){
		$results = "ok";
	} else {
		$results = "error";
	}




exit (json_encode($results,JSON_UNESCAPED_UNICODE));
/*MODIFICAR UN REGISTRO*/
	}else if($_POST["modificar"]=="modificar"){
	$stmt = $con->prepare("UPDATE odontograma SET d1=:d1, d2=:d2, d3=:d3, d4=:d4 , d5=:d5, d6=:d6 , d7=:d7 , d8=:d8 , d9=:d9 , d10=:d10 , d11=:d11 , d12=:d12 , d13=:d13 , d14=:d14 , d15=:d15 , d16=:d16 , d17=:d17 , d18=:d18 , d19=:d19 , d20=:d20 , d21=:d21 , d22=:d22 , d23=:d23 , d24=:d24 , d25=:d25 , d26=:d26 , d27=:d27 , d28=:d28 , d29=:d29 , d30=:d30, d31=:d31, d32=:d32, codigoprofesional=:codigoprofesional, dni=:dni WHERE codigoprofesional = :codigoprofesional AND dni = :dni");
	$stmt->bindParam(":d1", $_POST["d1"], PDO::PARAM_STR);
	$stmt->bindParam(":d2", $_POST["d2"], PDO::PARAM_STR);
	$stmt->bindParam(":d3", $_POST["d3"], PDO::PARAM_STR);
	$stmt->bindParam(":d4", $_POST["d4"], PDO::PARAM_STR);
	$stmt->bindParam(":d5", $_POST["d5"], PDO::PARAM_STR);
	$stmt->bindParam(":d6", $_POST["d6"], PDO::PARAM_STR);
	$stmt->bindParam(":d7", $_POST["d7"], PDO::PARAM_STR);
	$stmt->bindParam(":d8", $_POST["d8"], PDO::PARAM_STR);
	$stmt->bindParam(":d9", $_POST["d9"], PDO::PARAM_STR);
	$stmt->bindParam(":d10", $_POST["d10"], PDO::PARAM_STR);
	$stmt->bindParam(":d11", $_POST["d11"], PDO::PARAM_STR);
	$stmt->bindParam(":d12", $_POST["d12"], PDO::PARAM_STR);
	$stmt->bindParam(":d13", $_POST["d13"], PDO::PARAM_STR);
	$stmt->bindParam(":d14", $_POST["d14"], PDO::PARAM_STR);
	$stmt->bindParam(":d15", $_POST["d15"], PDO::PARAM_STR);
	$stmt->bindParam(":d16", $_POST["d16"], PDO::PARAM_STR);
	$stmt->bindParam(":d17", $_POST["d17"], PDO::PARAM_STR);
	$stmt->bindParam(":d18", $_POST["d18"], PDO::PARAM_STR);
	$stmt->bindParam(":d19", $_POST["d19"], PDO::PARAM_STR);
	$stmt->bindParam(":d20", $_POST["d20"], PDO::PARAM_STR);
	$stmt->bindParam(":d21", $_POST["d21"], PDO::PARAM_STR);
	$stmt->bindParam(":d22", $_POST["d22"], PDO::PARAM_STR);
	$stmt->bindParam(":d23", $_POST["d23"], PDO::PARAM_STR);
	$stmt->bindParam(":d24", $_POST["d24"], PDO::PARAM_STR);
	$stmt->bindParam(":d25", $_POST["d25"], PDO::PARAM_STR);
	$stmt->bindParam(":d26", $_POST["d26"], PDO::PARAM_STR);
	$stmt->bindParam(":d27", $_POST["d27"], PDO::PARAM_STR);
	$stmt->bindParam(":d28", $_POST["d28"], PDO::PARAM_STR);
	$stmt->bindParam(":d29", $_POST["d29"], PDO::PARAM_STR);
	$stmt->bindParam(":d30", $_POST["d30"], PDO::PARAM_STR);
	$stmt->bindParam(":d31", $_POST["d31"], PDO::PARAM_STR);
	$stmt->bindParam(":d32", $_POST["d32"], PDO::PARAM_STR);
	$stmt->bindParam(":codigoprofesional", $_POST["codigoprofesional"], PDO::PARAM_STR);
	$stmt->bindParam(":dni", $_POST["dni"], PDO::PARAM_STR);

		if($stmt->execute()){
			$results = "ok";
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











