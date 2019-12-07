<html>
    <head>
        <title>Cars Upkeep</title>
        <link type="text/css" href="libreria/bootstrap.min.css"  rel="stylesheet" />
        <link type="text/css" href="libreria/sweetalert2.css"  rel="stylesheet" />
        <script type="text/javascript" src="libreria/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="libreria/bootstrap.min.js"></script>
        <script type="text/javascript" src="libreria/sweetalert2.js"></script>
    </head>
    <body>

        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="text-align:center"> Add a new Car </h1></div>
                <div class="panel-body">
                    <form id="libro-form" onsubmit="return validar()" role="form" method="POST" action="controlador.php" autocomplete="off">
                    
                    <input type="hidden" name="evento" id="evento" value="registrar">
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="nombre">Make:</label>
                        <input type="text" class="form-control" id="make" name="make" placeholder="e.g (Honda, Jeep, Toyota)">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Model:</label>
                        <input type="text" class="form-control" id="model" name="model" placeholder="e.g (Accord, Wrangler, Corolla)">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Color:</label>
                        <input type="text" class="form-control" id="color" name="color" placeholder="Car's Color">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Year:</label>
                        <input type="number" class="form-control" id="year" name="year" placeholder="Year the car was made">
                    </div>
                    <div class="form-group">
                        <label for="autor">Mileage:</label>
                        <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Car's mileage">
                    </div>
                    <div class="pull-right">
                        <button type="submit" id="registrar" class="btn btn-success">Add Car</button>
                        <button type="submit" id="modificar" class="btn btn-primary" style="display:none">Modify Car</button>
                        <button type="button" id="cancelar" class="btn btn-default" onclick="cancelarOper()" style="display:none">Cancel</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th> Car's ID </th>
                            <th> Make </th>
                            <th> Model </th>
                            <th> Color </th>
                            <th> Year </th>
                            <th> Mileage </th>
                            <th></th>
                        </tr>
                        <?php 
                            require_once("clase.php");
                            $cars = new cars;
                            $arreglo = $cars->listar();

                            if ($arreglo != 0)
                            {
                                $num = 1;
                                foreach ($arreglo as $key => $data)
                                {
                                    echo '<tr>';
                                    echo '<td>'.$num,'</td>';
                                    echo '<td>';
                                    echo $data['make'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $data['model'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $data['color'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $data['year'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $data['mileage'];
                                    echo '</td>';
                                    echo '<td>
                                            <button type="button" class="btn btn-primary" onclick="modificar('.$data['id'].',\''.$data['make'].'\',\''.$data['model'].'\')">M</button>
                                            <button type="button" class="btn btn-danger" onclick="eliminar('.$data['id'].',\''.$data['make'].'\',\''.$data['model'].'\','.$num.')">E</button>
                                        </td>';
                                    echo '</tr>';
                                    $num ++;
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>

        function modificar(id,make,model,color,year,mileage)
        {
            document.getElementById('id').value = id;
            document.getElementById('make').value = make;
            document.getElementById('model').value = model;
            document.getElementById('color').value = color;
            document.getElementById('year').value = year;
            document.getElementById('mileage').value = mileage;
            document.getElementById('evento').value = 'modificar';
            $('#registrar').hide();
            $('#modificar').show();
            $('#cancelar').show();
        }

        function cancelarOper()
        {
            $('#make').val('');
            $('#model').val('');
            $('#color').val('');
            $('#year').val('');
            $('#mileage').val('');
            document.getElementById('evento').value = 'registrar';
            $('#registrar').show();
            $('#modificar').hide();
            $('#cancelar').hide();
        }

        function eliminar(id,make,model,color,year,mileage,num)
        {
            swal({
                title: 'Are you sure you want to delete this car??',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                html: '<br><table class="table table-bordered"><tr><td>'+color+'</td><td>'+make+'</td><td>'+model+'</td></tr></table>'
            }).then((result) => 
            {
                if (result.value)
                {
                    $('#evento').val('eliminar');
                    $('#id').val(id);
                    $('#libro-form').submit();
                }
            });
        }

        <?php 
            if ( isset($_GET['mensaje']) && isset($_GET['resultado']) ) {
                $class = ($_GET['resultado'] == '1') ? 'success' : 'error';
                echo 'swal( "'.$_GET['mensaje'].'", "", "'.$class.'");';
            }
        ?>

        function validar()
        {
            if ( $('#evento').val() == 'eliminar' )
                return true; 
            else if ( ( $('#evento').val() == 'registrar' || $('#evento').val() == 'modificar' ) && $('#make').val() == '' || $('#model').val() == '' ) {
                swal( "Complete todos los campos", "", "warning");
                return false;
            }
            else return true;
        }

    </script>
</html>