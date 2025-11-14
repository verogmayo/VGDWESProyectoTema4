<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio02</title>
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
            .titulo{
                text-align: center;
            }
            .registro{
                border: solid;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 02</h1>
        </header>
        <main>
            <section>
                <?php
                /**
                 * @author: Véronique Grué
                 * @since 29/10/2025
                 * 
                 * Ejercicio 2: Mostrar el contenido de la tabla Departamento y el número de registros.
                 */
                //  https://www.php.net/manual/es/pdo.connections.php
                /** @define DNS (Data Source Name): indica el tipo de conexión, el host y el nombre de la base de datos. */
                /** @define string USUARIODB : usuario de la base de datos. */
                /** @define string PSWD Contraseña del usuario de la base de datos. */
                
                //CONSULTA CON QUERY
                //define(DNS, 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4');
//                define('DNS', 'mysql:host=localhost;dbname=DBVGDWESProyectoTema4');
//                define('USUARIODB' ,'userVGDWESProyectoTema4');
//                define('PSWD', 'pasoDWES4');
                //define(PSWD, 'paso');
                require_once '../config/confDBPDO.php';

                //Establecer la conexión en la base de datos
                try {
                    //Establecer la conexión en la base de datos
                    $miDB = new PDO(DNS, USUARIODB, PSWD);
                    echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3><br></br>';
                    echo'<h3 class="titulo" style="font-weight:bold;">Contenido de la tabla Departamento</h3></br>';
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
                ?>
            </section>


        </main>

        <footer class="footer">
            <div class="footerContent">
                <div><p class="copyright">
                        2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> <address><a href="../../VGDWESProyectoDWES/indexProyectoDWES.html">Véronique Grué.</a> Fecha de Actualización :
                        <time datetime="2025-10-09"></time> 09-10-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

