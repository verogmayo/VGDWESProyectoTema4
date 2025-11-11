<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio03</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
        <style>
            *{
                margin: 0 auto;
            }
            main{
                display: block;
                align-content: center;
            }
            label{
                font-size: 20px;
                margin-bottom: 10px;
                display: inline-block;
            }

            input {
                height : 35px;
                margin-bottom: 20px;
                display: inline-block;
                padding-left: 5px;
                border-radius: 5px;
            }


            button{
                font-size: 20px;
                background-color: grey;
                color: white;
                padding: 10px;
                border-radius: 5px;
                position: absolute;
                font-family: Times New Roman;
            }


            section{
                margin-top: 10px;
                height: 400px;
                margin-bottom: 50px;
                padding: 20px;
                position: relative;
                border: solid lightskyblue;
                border-radius: 20px;
                width: 600px;
            }


            input#T02_DescDepartamento{
                width: 500px;
            }
            input#T02_CodDepartamento{
                width: 50px;
            }


            #T02_CodDepartamento, #T02_DescDepartamento, #T02_VolumenDeNegocio{
                background-color:rgb(252, 248, 204);
                font-weight: bold;
            }
            li{
                font-size: 20px;

            }
            h3{
                font-size: 25px;
            }
            #T02_FechaCreacionDepartamento, #T02_FechaBajaDepartamento{
                background-color: gainsboro;
            }
            #enviar{
                bottom: 25px;
                left:  60px;
            }
            .cancelar{
                font-size: 20px;
                background-color: grey;
                color: white;
                padding: 10px;
                border-radius: 5px;
                position: absolute;
                bottom: 25px;
                right: 60px;
            }


            h3{
                font-size: 24px;
            }
            table{
                border:solid;
                width: 80%;
                text-align: center;
                border-collapse: collapse;
                margin-bottom: 20px
            }
            th{
                border: solid;
                padding: 5px 10px;
                font-size: 20px;
                font-weight: 900;
                background-color: lightskyblue;
                white-space: nowrap;
            }
            td{
                border: solid 1px;
                padding: 5px;
                font-size: 18px;
                border-right: solid ;
            }
            .titulo{
                text-align: center;
            }
            .registro{
                border: solid;
                font-size: 20px;
            }
            .contenedorTabla{
                border: none;
                width: 100%;
                margin-bottom: 10px;
                height: auto;

            }
        </style>
    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 03</h1>
        </header>
        <main>


            <?php
            /**
             * @author Véronique Grué
             * @version 1.0
             * @date 2025-11-05 
             * 
             *
             * Ejercicio 3
             * *Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.
             */
            //enlace para importar las librerías de validación de campos
            require_once '../core/libreriaValidacion.php';
            require_once '../core/miLibreriaStatic.php';

            // Variable Configuracion conexión PDO
            define('DNS', 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4');
            define('USUARIODB', 'userVGDWESProyectoTema4');
            define('PSWD', 'paso');
            //Establecer la conexión en la base de datos
            $miDB = new PDO(DNS, USUARIODB, PSWD);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            ///inicialización de variables
            /** @var array $aErrores Array para almacenar mensajes de error de validación. */
            $aErrores = [
                'T02_CodDepartamento' => '',
                'T02_DescDepartamento' => '',
                'T02_VolumenDeNegocio' => ''
            ];
            /** @var array $aRespuestas Array para almacenar las repuestas. */
            $aRespuestas = [
                'T02_CodDepartamento' => '',
                'T02_DescDepartamento' => '',
                'T02_VolumenDeNegocio' => ''
            ];

            /** @boollean boolean $entradaOK Indica si los datos de entrada son correctos o no. */
            $entradaOK = true;

            //Para cada campo del formulario se valida la entrada y se actua en consecuencia
            if (isset($_REQUEST['enviar'])) {//se cumple si el boton es enviar
                //Validación de los datos de los campos del formulario
                $aErrores['T02_CodDepartamento'] = miLibreriaStatic::comprobarAlfabeticoMayuscula($_REQUEST['T02_CodDepartamento'], 3, 3, 1);
                //Comprobacion de que el codigo no está ya en la tabla departamento
                if (empty($aErrores['T02_CodDepartamento'])) {
                    $sql2 = "SELECT T02_CodDepartamento FROM T_02Departamento Where T02_CodDepartamento = '{$_REQUEST['T02_CodDepartamento']}'";
                    $resultadoConsulta = $miDB->query($sql2);
                    //https://www.php.net/manual/es/pdostatement.rowcount.php
                    if ($resultadoConsulta->rowCount() > 0) {
                        $aErrores['T02_CodDepartamento'] = "Este código ya existe. ";
                    }
                }

                $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['T02_DescDepartamento'], 255, 5, 1);
                $aErrores['T02_VolumenDeNegocio'] = miLibreriaStatic::comprobarFloatMonetarioES($_REQUEST['T02_VolumenDeNegocio'], PHP_FLOAT_MAX, -PHP_FLOAT_MAX, 1);

                //recorre el array de errores para detectar si hay alguno
                foreach ($aErrores as $campo => $valorCampo) {
                    if ($valorCampo != null) {//Si encuentra algún error 
                        $entradaOK = false; // la entrada no es correcta
                    }
                }
            } else {
                //Si no se ha aceptado el formulario
                $entradaOK = false;
            }
            //Tratamiento del formulario
            if ($entradaOK) {
                //REllenamos el array de respuesta con los valores que ha introducido el usuario
                $aRespuestas['T02_CodDepartamento'] = $_REQUEST['T02_CodDepartamento'];
                $aRespuestas['T02_DescDepartamento'] = $_REQUEST['T02_DescDepartamento'];

                //------------------------------------------------------------
                //conversion de la coma en punto en el float
                $volumenConPunto = str_replace(',', '.', $_REQUEST['T02_VolumenDeNegocio']);
                // Asignación del valor al array 
                $aRespuestas['T02_VolumenDeNegocio'] = $volumenConPunto;
                //-------------------------------------------------------

                try {

                    // Preparación de la consulta con query
                    $sql = "INSERT INTO T_02Departamento 
                            (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
                           VALUES (
                             '{$aRespuestas['T02_CodDepartamento']}',
                             '{$aRespuestas['T02_DescDepartamento']}',
                             '{$aRespuestas['T02_VolumenDeNegocio']}'
                        )";
                    $miDB->query($sql);

                    //Para limpoar el formulario
                    $_REQUEST['T02_CodDepartamento'] = '';
                    $_REQUEST['T02_DescDepartamento'] = '';
                    $_REQUEST['T02_VolumenDeNegocio'] = '';
                    $_POST['T02_CodDepartamento'] = '';
                    $_POST['T02_DescDepartamento'] = '';
                    $_POST['T02_VolumenDeNegocio'] = '';

                    // echo "<p style='color:green; font-weight:bold;'>Departamento insertado correctamente.</p><br>";
                } catch (PDOException $miExceptionPDO) {
                    echo '<p style="color:purple; font-weight:bold;">Error en la base de datos: '
                    . $miExceptionPDO->getMessage() . '<br>Código: '
                    . $miExceptionPDO->getCode() . '</p>';
                }
            }
            ?>
            <section>
                <h2>Inserta un nuevo departamento.</h2>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                    <label for="T02_CodDepartamento">Código :</label>
                    <input name="T02_CodDepartamento" id="T02_CodDepartamento" type="text" value="<?php echo(empty($aErrores['T02_CodDepartamento'])) ? ($_REQUEST['T02_CodDepartamento'] ?? '') : ''; ?>">
                    <a style='color:red'><?php echo $aErrores['T02_CodDepartamento'] ?></a>

                    <br><label for="T02_FechaCreacionDepartamento">Fecha Creación :</label>
                    <input name="T02_FechaCreacionDepartamento" id="T02_FechaCreacionDepartamento" type="date" value="<?php echo date('Y-m-d'); ?>" disabled><br>

                    <label for="T02_DescDepartamento">Descripción:</label>
                    <a style='color:red'><?php echo $aErrores['T02_DescDepartamento'] ?></a>
                    <input name="T02_DescDepartamento" id="T02_DescDepartamento" type="text" value="<?php echo(empty($aErrores['T02_DescDepartamento'])) ? ($_REQUEST['T02_DescDepartamento'] ?? '') : ''; ?>"><br>

                    <label for="T02_VolumenDeNegocio">Volumen de negocio:</label>
                    <input name="T02_VolumenDeNegocio" id="T02_VolumenDeNegocio" type="text" value="<?php echo(empty($aErrores['T02_VolumenDeNegocio'])) ? ($_REQUEST['T02_VolumenDeNegocio'] ?? '') : ''; ?>">
                    <a style='color:red'><?php echo $aErrores['T02_VolumenDeNegocio'] ?></a>

                    <button type="submit" name="enviar" id="enviar">Añadir</button>
                    <a class="cancelar" href="../indexProyectoTema4.php">Cancelar</a>


                </form>  

            </section>
            <section class="contenedorTabla">
<?php
try {
    //Establecer la conexión en la base de datos

    echo'<h3 class="titulo" style="font-weight:bold;">Contenido de la tabla Departamento</h3></br>';
    //query para devolver datos
    $resultadoConsulta = $miDB->query('SELECT * FROM T_02Departamento');

    //https://www.php.net/manual/es/pdostatement.fetch.php


    echo'<table>';
    echo '<tr>';
    echo'<th> Codigo </th>';
    echo '<th> Fecha Creación </th>';
    echo '<th> Fecha Baja </th>';
    echo '<th> Descripción </th>';
    echo '<th> Volumen de Negocio</th>';
    echo '</tr>';

    while ($oRegistroObject = $resultadoConsulta->fetchObject()) {
        echo '<tr>';
        echo'<td> ' . $oRegistroObject->T02_CodDepartamento . '</td>';
        $oFechaCreacion = new DateTime($oRegistroObject->T02_FechaCreacionDepartamento);
        echo'<td> ' . $oFechaCreacion->format("d-m-Y") . '</td>';
        if (!is_null($oRegistroObject->T02_FechaBajaDepartamento)) {
            //si no se pone la condición la fecha no es null
            $oFechaBaja = new DateTime($oRegistroObject->T02_FechaBajaDepartamento);
            echo '<td>' . $oFechaBaja->format("d-m-Y") . '</td>';
        } else {
            echo '<td>Activo</td>';
        }
        echo'<td> ' . $oRegistroObject->T02_DescDepartamento . '</td>';
        echo'<td> ' . number_format($oRegistroObject->T02_VolumenDeNegocio, 2, ',', '.') . '€</td>';
        echo '</tr>';
    }

    $numRegistros = $miDB->query('SELECT COUNT(*) FROM T_02Departamento');
    $total = $numRegistros->fetchColumn();
    echo '<tr>';
    echo "<td class='registro' colspan=5><strong>Número de registros:</strong> $total</td>";
    echo '</table>';
} catch (PDOException $miExceptionPDO) {
    echo '<p style="color:purple; font-weight:bold;">Error: ' . $miExceptionPDO->getMessage() . '<br>' . 'Código de error: ' . $miExceptionPDO->getCode();
} finally {
    //mejor dentro para que se cierre en todos los casos.
    unset($miDB);
}
?>
            </section>


        </main>

        <footer class="footer">
            <div class="footerContent">
                <div><p class="copyright">
                        2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> <address><a href="../../VGDWESProyectoDWES/indexProyectoDWES.html">Véronique Grué.</a> Fecha de Actualización :
                        <time datetime="2025-11-07"></time> 07-11-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

