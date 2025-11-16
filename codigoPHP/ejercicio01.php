<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio01</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
        <style>
            *{
                margin: 0 auto;
            }
            h2{
                padding: 0;
            }
            h3{
                font-size: 24px;
                margin-bottom: 15px;
            }
            section{
                display: block;
                align-content: center;
                text-align: center;
            }
             table{
                border:solid;
                width: 80%;
                border-collapse: collapse;
            }
            th{
                border: solid black;
                padding: 5px 10px;
                font-size: 20px;
                font-weight: 900;
                background-color: lightskyblue;
                text-align: left;
            }
            td{
                border: solid 1px black;
                padding: 5px 10px;
                font-size: 18px;
                border-right: solid black;
                font-weight:bold;
                text-align: left;
            }
            .contenedorTabla{
                width: 100%;
                margin-bottom: 10px;
                height: auto;
            }
        </style>
    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 01</h1>
        </header>
        <main>
            <section>

                <?php
                /**
                 * @author: Véronique Grué
                 * @since 29/10/2025
                 * 
                 * Ejercicio 1: Conexión a la base de datos con la cuenta usuario y tratamiento de errores.
                 */
                //  https://www.php.net/manual/es/pdo.connections.php
                //enlace a los datos de conexión
                require_once '../config/confDBPDO.php';

                //Atributos de la conexión. https://www.php.net/manual/es/pdo.getattribute.
                //Para que se vean los nombre de los atributos hay que hacer un array clave->valor
                /** @var array $aAtrConexion Atributos de la conexión */
                $aAtrConexion = [
                    'AUTOCOMMIT' => PDO::ATTR_AUTOCOMMIT,
                    'CASE' => PDO::ATTR_CASE,
                    'CLIENT_VERSION' => PDO::ATTR_CLIENT_VERSION,
                    'CONNECTION_STATUS' => PDO::ATTR_CONNECTION_STATUS,
                    'DRIVER_NAME' => PDO::ATTR_DRIVER_NAME,
                    'ERRMODE' => PDO::ATTR_ERRMODE,
                    'ORACLE_NULLS' => PDO::ATTR_ORACLE_NULLS,
                    'PERSISTENT' => PDO::ATTR_PERSISTENT,
                    'PREFETCH' => PDO::ATTR_PREFETCH,
                    'SERVER_INFO' => PDO::ATTR_SERVER_INFO,
                    'SERVER_VERSION' => PDO::ATTR_SERVER_VERSION,
                    'TIMEOUT' => PDO::ATTR_TIMEOUT
                ];

                echo '<h2>Conexión con la base de datos sin errores</h2>';
                
                try {
                    //Establecer la conexión en la base de datos
                    $miDB = new PDO(DNS, USUARIODB, PSWD);
                    echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3>';
                    echo'<h3>Atributos de la conexión</h3>';
                    
                    // Mostrar los atributos en tabla HTML
                    echo '<table ">';
                    echo '<tr ">';
                    echo '<th>Atributo PDO</th>';
                    echo '<th>Valor</th>';
                    echo '</tr>';

                    foreach ($aAtrConexion as $nombre => $constante) {
                        echo '<tr>';
                        echo "<td>PDO::ATTR_$nombre</td>";
                        try {
                            echo '<td style="color:green; ">' . $miDB->getAttribute($constante) . '</td>';
                        } catch (PDOException $miExceptionPDO) {
                            echo '<td style="color:red;">Error: ' . $miExceptionPDO->getMessage() . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                } catch (PDOException $miExceptionPDO) {
                    echo '<p style="color:purple; font-weight:bold;">Error: ' . $miExceptionPDO->getMessage() . '<br>' . 'Código de error: ' . $miExceptionPDO->getCode();
                } finally {
                    //mejor dentro para que se cierre en todos los casos.
                    unset($miDB);
                }
                
                //Establecer la conexión en la base de datos

                echo '<h2>Conexión con la base de datos con errores</h2>';
                try {
                    $miDB2 = new PDO(DNS, USUARIODB, "pasa");
                    echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3><br></br>';
                    echo'<h3>Atributos de la conexión</h3><br>';
                    //para que se vean los nombre y la constante que corresponde a cada atributo.
                    foreach ($aAtrConexion as $nombre => $constante) {
                        echo "PDO::ATTR_$nombre:";
                        try {
                            echo '<p style="color:green; font-weight:bold;">' . $miDB2->getAttribute($constante) . "</p><br>";
                        } catch (PDOException $miExceptionPDO) {
                            echo '<p style="color:red"> <span style:"font-weight:bold">Error: </span>' . $miExceptionPDO->getMessage() . '. <br> <span class="font-weight:bold" >Código del error: </span>' . $miExceptionPDO->getCode() . "</p><br>";
                        }
                    }
                } catch (PDOException $miExceptionPDO) {
                    echo '<p style="color:purple; font-weight:bold">Error: ' . $miExceptionPDO->getMessage() . '<br>' . 'Código de error: ' . $miExceptionPDO->getCode();
                } finally {
                    //mejor dentro para que se cierre en todos los casos.
                    unset($miDB2);
                }
                ?>
            </section>


        </main>
        <footer class="footer">
            <div class="footerContent">
                <div><p class="copyright">
                        2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> <address><a href="../../VGDWESProyectoDWES/indexProyectoDWES.html">Véronique Grué.</a> Fecha de Actualización :
                        <time datetime="2025-10-29"></time>29-10-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

