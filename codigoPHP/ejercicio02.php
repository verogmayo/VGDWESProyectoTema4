<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio02</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
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
                /** @var $dns (Data Source Name): indica el tipo de conexión, el host y el nombre de la base de datos. */
                /** @var string $usuarioDb : usuario de la base de datos. */
                /** @var string $pswd Contraseña del usuario de la base de datos. */
                $dsn = 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4';
                $usuarioDb = 'userVGDWESProyectoTema4';
                $pswd = 'paso';

                //Establecer la conexión en la base de datos
                try {
                    //Establecer la conexión en la base de datos
                    $miDB = new PDO($dsn, $usuarioDb, $pswd);
                    echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3><br></br>';
                    //query para devolver datos
                    $resultadoConsulta = $miDB->query('SELECT * FROM T_02Departamento');
                    //$numRegistros=$miDB->query('SELECT count(*) FROM T_02Departamento');
                    //Mostrar los registros
                    //https://www.php.net/manual/es/pdostatement.fetch.php
                    //PDO::FETCH_ASSOC: devuelve un array indexado por el nombre de la columna como se devuelve en el conjunto de resultados
                    while ($aRegistroArray = $resultadoConsulta->fetch(PDO::FETCH_ASSOC)) {
                        echo '<p>';
                        foreach ($aRegistroArray as $columna => $valor) {
                            echo "<strong>$columna:</strong> $valor <br> ";
                        }
                        echo '</p><br>';
                    }
                    $numRegistros = $miDB->query('SELECT COUNT(*) FROM T_02Departamento');
                    $total = $numRegistros->fetchColumn();
                    echo "<p><strong>Número de registros:</strong> $total</p>";
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

