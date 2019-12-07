<?php
	require_once("clase.php");
	$evento = $_POST["evento"];
    $id = $_POST["id"];
    $make = mb_strtoupper($_POST["make"]);
    $model = mb_strtoupper($_POST["model"]);
    $color = mb_strtoupper($_POST["color"]);
    $year = mb_strtoupper($_POST["year"]);
    $mileage = mb_strtoupper($_POST["mileage"]);
    
    $cars = new cars;
    switch ($evento) {
        case "registrar": {
            if ( $cars->registrar($make, $model, $color, $year, $mileage) > 0 ) {
                $mensaje = "Car registered succesfully";
                $resultado = "1";
            }
            else {
                $mensaje = "Please try again";
                $resultado = "0";
            }
		}
        break;
        case "modificar": {
            if ( $cars->modificar($id,$make, $model, $color, $year, $mileage) > 0 ) {
                $mensaje = "Updated succesfully";
                $resultado = "1";
            }
            else {
                $mensaje = "Error when updating";
                $resultado = "0";
            }
		}
        break;
        case "eliminar": {
            if ( $cars->eliminar($id) > 0 ) {
                $mensaje = "Car was deleted";
                $resultado = "1";
            }
            else {
                $mensaje = "Could not delete car";
                $resultado = "0";
            }
		}
		break;
    }
    header("location:index.php?mensaje=$mensaje&resultado=$resultado");
?>
		