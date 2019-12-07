<?php
    class cars
    {
        function conexion()
        {
            //Opciones de la conexión
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            //Objeto PDO, Controlador de BD, IP del servidor o localhost, nombre de la BD, usuario y contraseña
            return $objetoPDO = new PDO('mysql:host=localhost;dbname=cars','root','',$opciones);
        }

        function registrar($make,$model,$color,$year,$mileage)
        {
            $objetoPDO = $this->conexion();
            $consulta = "INSERT INTO cars (make, model, color, year, mileage) VALUES('$make','$model','$color','$year','$mileage')";
            return $objetoPDO->exec($consulta);
        }

        function modificar($id,$make,$model,$color,$year,$mileage)
        {
            $objetoPDO = $this->conexion();
            $consulta = "UPDATE cars SET make='$make', model='$model', color='$color', year='$year', mileage='$mileage' WHERE id=$id";
            return $objetoPDO->exec($consulta);
        }

        function eliminar($id)
        {
            $objetoPDO = $this->conexion();
            $consulta = "DELETE FROM cars WHERE id=$id";
            return $objetoPDO->exec($consulta);
        }

        function listar()
        {
            $objetoPDO = $this->conexion();
            $query = "SELECT * from cars ORDER BY id DESC";
            $resultado = $objetoPDO->query($query);
            $key = 0;
            while($registro = $resultado->fetch())
            {
                $arreglo[$key]['id'] = $registro['id'];
                $arreglo[$key]['make'] = $registro['make'];
                $arreglo[$key]['model'] = $registro['model'];
                $arreglo[$key]['color'] = $registro['color'];
                $arreglo[$key]['year'] = $registro['year'];
                $arreglo[$key]['mileage'] = $registro['mileage'];
                $key ++;
            }
            return (!empty($arreglo)) ? $arreglo : 0;
            //return $arreglo;
        }
    }
?>