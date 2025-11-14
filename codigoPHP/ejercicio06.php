<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio06</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
          <style>
            h3{
                font-size: 24px;
            }
            table{
                border:solid;
                width: 80%;
                text-align: center;
                border-collapse: collapse;
            }
            th{
                border: solid;
                padding: 5px 0 5px 0;
                font-size: 20px;
                font-weight: 900;
                background-color: lightskyblue;
            }
            td{
                border: solid 1px;
                padding: 5px 0 5px 0;
                font-size: 18px;
                border-right: solid ;
            }
            .contenedorTabla{
                width: 100%;
                margin-bottom: 10px;
                height: auto;
                padding-top: 10px;
            }
        </style>
    </head>


    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 06</h1>
        </header>
        <main>
            <section>
                <?php
                /**
                 * @author: Véronique Grué
                 * @since 12/11/2025
                 * 
                 *  * Ejercicio 6
                 * Página web que cargue registros en la tabla Departamento desde un array departamentos 
                 * nuevos utilizando una consulta preparada.
                 */
                //enlace a los datos de conexión
                require_once '../config/confDBPDO.php';

                //Array de los nuevos departamentos
                $aDepartamentos = [
                    ['CodDpto' => 'RUS',
                     'DescDpto' => 'Ruso',
                     'VolDpto' => 4567.98],
                    ['CodDpto' => 'CHI',
                     'DescDpto' => 'Chino',
                     'VolDpto' => 14567.98],
                    ['CodDpto' => 'ITA',
                     'DescDpto' => 'Italiano',
                     'VolDpto' => 4067.98]
                ];

                try {
                    //Establecer la conexión en la base de datos
                    $miDB = new PDO(DNS, USUARIODB, PSWD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $miDB->beginTransaction();
                    // Creacion de la consulta. Se puede utilizar heredoc para que se vea mejor el codigo
                    $sql = <<<SQL
                    INSERT INTO T_02Departamento 
                        (T02_CodDepartamento, 
                         T02_DescDepartamento, 
                         T02_VolumenDeNegocio)
                    VALUES (:codigo, :descripcion, :volumen)          
                    SQL;

                    //Empieza la transacción

                    $consultaPreparada = $miDB->prepare($sql);

                    //bucle for para el insert
                    foreach ($aDepartamentos as $departamento) {
                        
                        $consultaPreparada->bindParam(':codigo', $departamento['CodDpto']);
                        $consultaPreparada->bindParam(':descripcion',$departamento['DescDpto']);
                        $consultaPreparada->bindParam(':volumen',$departamento['VolDpto'] );

                        $consultaPreparada->execute();
                    }
                    $miDB->commit();
                    echo "<h3 style='color:green; font-weight:bold;'>Todos los departamentos fueron insertados correctamente.</h3>";

                    try {
                        //Establecer la conexión en la base de datos
                        $miDB = new PDO(DNS, USUARIODB, PSWD);
                        echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3><br></br>';

                        //query para devolver datos
                        $resultadoConsulta = $miDB->query('SELECT * FROM T_02Departamento');

                        //Mostrar los registros
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
                    

                } catch (PDOException $miExceptionPDO) {
                    $miDB->rollBack();
                    echo '<h3 style="color:blue; font-weight:bold;">La transacción no se ha podido completar correctamente</h3>';
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
                        <time datetime="2025-10-10"></time> 10-10-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

