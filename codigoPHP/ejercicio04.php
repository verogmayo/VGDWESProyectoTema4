<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio04</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
        <style>
            *{
                margin: 0 auto;
            }
            main{
                display: flex;
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
            #preguntaSeguridad, #nombre{
                margin-right: 10px;
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
                display: inline-block;
                margin-bottom: 50px;
                padding: 20px;
                position: relative;
                height: 300px;
                border-radius: 20px;
                border: solid lightskyblue;
            }


            input#T02_DescDepartamento{
                width: 500px;
            }
            input#T02_CodDepartamento{
                width: 35px;
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
                bottom: 10px;
                left:  10px;
            }
            .cancelar{
                font-size: 20px;
                background-color: grey;
                color: white;
                padding: 10px;
                border-radius: 5px;
                position: absolute;
                bottom: 10px;
                right: 10px;
            }

        </style>
    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 04</h1>
        </header>
        <main>
            
                <?php
                /**
                 * @author: Véronique Grué
                 * @since 06/11/2025
                 * 
                 *  * Ejercicio 4
                 * * 	Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos) .
                 */
                //enlace para importar las librerías de validación de campos
                require_once '../core/libreriaValidacion.php';

                ///inicialización de variables
                /** @var array $aErrores Array para almacenar mensajes de error de validación. */
                $aErrores = [
                    'T02_DescDepartamento' => ''
                ];
                /** @var array $aRespuestas Array para almacenar las repuestas. */
                $aRespuestas = [
                    'T02_DescDepartamento' => ''
                ];

                /** @boollean boolean $entradaOK Indica si los datos de entrada son correctos o no. */
                $entradaOK = true;

                //Para cada campo del formulario se valida la entrada y se actua en consecuencia
                if (isset($_REQUEST['enviar'])) {//se cumple si el boton es submit
                    //Validación de los datos de los campos del formulario
                    $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['T02_DescDepartamento'], 255, 0, 1);

                    //recorre el array de errores para detectar si hay alguno
                    foreach ($aErrores as $valorCampo) {
                        if (!is_null($valorCampo)) {//Si encuentra algún error 
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

                    $aRespuestas = trim($_REQUEST['T02_DescDepartamento']);

                    try {
                        // Configuracion conexión PDO
                        $dsn = 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4';
                        $usuarioDb = 'userVGDWESProyectoTema4';
                        $pswd = 'paso';

                        $miDB = new PDO($dsn, $usuarioDb, $pswd);
                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Consulta si el usuario no introduce datos
                        if (empty($aRespuestas)) {
                            $sql = "SELECT * FROM T_02Departamento ";
                        } else {
                            //Consulta si el usuario introduce parte o la totalidad de la descripción
                            $aRespuestasSql = "%" . $aRespuestas . "%";

                            $sql = "SELECT * FROM T_02Departamento WHERE T02_DescDepartamento LIKE '$aRespuestasSql'";
                        }
                        //Se ejecuta con query
                        $resultadoConsulta = $miDB->query($sql);
                        echo'<h3>Resulstados de la busquedad</h3>';
                        echo'<table>';
                        echo '<tr>';
                        echo'<th> Codigo </th>';
                        echo '<th> Fecha Creación </th>';
                        echo '<th> Fecha Baja </th>';
                        echo '<th> Descripción </th>';
                        echo '<th> Volumen de Negocio</th>';
                        echo '</tr>';

                        while ($aRegistroArray = $resultadoConsulta->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo'<td> ' . $aRegistroArray['T02_CodDepartamento'] . '</td>';
                            $oFechaCreacion = new DateTime($aRegistroArray['T02_FechaCreacionDepartamento']);
                            echo'<td> ' . $oFechaCreacion->format("d-m-Y") . '</td>';
                            if (!is_null($aRegistroArray['T02_FechaBajaDepartamento'])) {
                                //si no se pone la condición la fecha no es null y pone la fecha de hoy
                                $oFechaBaja = new DateTime($aRegistroArray['T02_FechaBajaDepartamento']);
                                echo '<td>' . $oFechaBaja->format("d-m-Y") . '</td>';
                            } else {
                                echo '<td>Activo</td>';
                            }
                            echo'<td> ' . $aRegistroArray['T02_DescDepartamento'] . '</td>';
                            echo'<td> ' . number_format($aRegistroArray['T02_VolumenDeNegocio'], 2, ',', '.') . '€</td>';
                            echo '</tr>';
                        }
                        echo'</table>';

                        echo "<p style='color:green; font-weight:bold;'>Departamento insertado correctamente.</p>";
                    } catch (PDOException $miExceptionPDO) {
                        echo '<p style="color:purple; font-weight:bold;">Error en la base de datos: '
                        . $miExceptionPDO->getMessage() . '<br>Código: '
                        . $miExceptionPDO->getCode() . '</p>';
                    } finally {
                        unset($miDB);
                    }
                } else {
                    //si hay algún error se vuelve a mostrar el formulario
                    ?>
                    <section>
                        <h2>BUSQUEDAD POR LA DESCRIPCIÓN.</h2>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            
                            <label for="T02_DescDepartamento">Descripción:</label>
                            <a style='color:red'><?php echo $aErrores['T02_DescDepartamento'] ?></a>
                            <input name="T02_DescDepartamento" id="T02_DescDepartamento" type="text" value='<?php echo(empty($aErrores['T02_DescDepartamento'])) ? ($_REQUEST['T02_DescDepartamento'] ?? '') : ''; ?> '><br>

                            <button type="submit" name="enviar" id="enviar">Buscar</button>
                            <a class="cancelar" href="../indexProyectoTema4.php">Cancelar</a>

                        </form>  
                        <?php
                    }
                    ?>


                    
                </section>


        </main>

        <footer class="footer">
            <div class="footerContent">
                <div><p class="copyright">
                        2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> <address><a href="../../VGDWESProyectoDWES/indexProyectoDWES.html">Véronique Grué.</a> Fecha de Actualización :
                        <time datetime="2025-10-10"></time> 10-10-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

