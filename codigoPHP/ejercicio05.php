<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio05</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">

    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 05</h1>
        </header>
        <main>
            <section>
                <?php
                /**
                 * @author: Véronique Grué
                 * @since 06/11/2025
                 * 
                 *  * Ejercicio 5
                 * * 	Página web que añade tres registros a nuestra tabla Departamento utilizando 
                 * tres instrucciones insert y una transacción, de tal forma que se añadan 
                 * los tres registros o no se añada ninguno. 
                 */
                /** @var $dns (Data Source Name): indica el tipo de conexión, el host y el nombre de la base de datos. */
                /** @var string $usuarioDb : usuario de la base de datos. */
                /** @var string $pswd Contraseña del usuario de la base de datos. */
                $dsn = 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4';
                $usuarioDb = 'userVGDWESProyectoTema4';
                $pswd = 'paso';

                echo'<h3 class="titulo">Inserción de 3 departamentos con transación</h3>';
                //Establecer la conexión en la base de datos
                try {
                    //Establecer la conexión en la base de datos
                    $miDB = new PDO($dsn, $usuarioDb, $pswd);
                    echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3><br></br>';

                    //query para devolver datos
                    $resultadoConsulta = $miDB->query('SELECT * FROM T_02Departamento');

                    //Mostrar los registros
                    //https://www.php.net/manual/es/pdostatement.fetch.php
                    //PDO::FETCH_ASSOC: devuelve un array indexado por el nombre de la columna como se devuelve en el conjunto de resultados
                    $miDB->beginTransaction();
                    echo'<p>Transacción iniciada</p>';

                    //Primer insert
                    $sql1 = "INSERT INTO T_02Departamento 
                            (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
                            VALUES('KKK','KKKKKKKKKKKKKKKKKKKKKKKKK',3904.87)";
                    $miDB->query($sql1);

                    //Seggundo insert
                    $sql2 = "INSERT INTO T_02Departamento 
                            (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
                            VALUES('LLL','LLLLLLLLLLLLLLLLLLLL',3984.87)";
                    $miDB->query($sql2);
                    
                    //Tercer insert
                    $sql3 = "INSERT INTO T_02Departamento 
                            (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
                            VALUES('OOO','OOOOOOOOOOOOOOOOOOOOOOOO',9984.87)";
                    $miDB->query($sql3);
                    
                    //Si todo va bien se confirma
                    $miDB->commit();
                    echo'<h3 style="color:blue; font-weight:bold;">Los 3 departamentos se han insertado correctamente!!!!</h3><br></br>';
                    
                } catch (PDOException $miExceptionPDO) {
                    //si falla algo, revierte todo
                    $miDB->rollBack();
                    echo '<p style="color:purple; font-weight:bold;">Error: ' . $miExceptionPDO->getMessage() . '<br>' . 'Código de error: ' . $miExceptionPDO->getCode();
                } finally {
                    //mejor dentro para que se cierre en todos los casos.
                    unset($miDB);
                }
                ?>
                <br><br><a href="ejercicio02.php" style="font-size: 25px; font-weight: 700;">Ver la tabla departamento </a>


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

