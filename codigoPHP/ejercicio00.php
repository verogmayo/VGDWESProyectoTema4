<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio00</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 00</h1>
            
        </header>
        <main>
            <section>

                <?php
                /**
                 * @author: Véronique Grué
                 * @since 29/10/2025
                 * 
                 */
                //  https://www.php.net/manual/es/pdo.connections.php
                /** @var $dsn (Data Source Name): indica el tipo de conexión, el host y el nombre de la base de datos. */
                /** @var string $usuarioDb : usuario de la base de datos. */
                /** @var string $pswd Contraseña del usuario de la base de datos. */
                //$dsn = 'mysql:host=10.199.10.49;dbname=DBVGDWESProyectoTema4';
                $dsn = 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4';
                $usuarioDb = 'userVGDWESProyectoTema4';
                $pswd = 'paso';

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

                //Establecer la conexión en la base de datos
                $miDB = new PDO($dsn, $usuarioDb, $pswd);


                echo '<h2>Conexión con la base de datos sin errores</h2>';
                try {
                    $miDB;
                    echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3><br></br>';
                    echo'<h3>Atributos de la conexión</h3><br>';
                    //para que se vean los nombre y la constante que corresponde a cada atributo.
                    foreach ($aAtrConexion as $nombre => $constante) {
                        echo "PDO::ATTR_$nombre: <br>";
                        try {
                            echo '<p style="color:green; font-weight:bold;">' . $miDB->getAttribute($constante) . "</p><br>";
                        } catch (PDOException $miExceptionPDO) {
                            echo '<p style="color:red"> <span style:"font-weight:bold">Error: </span>' . $miExceptionPDO->getMessage() . '. <br> <span class="font-weight:bold" >Código del error: </span>' . $miExceptionPDO->getCode() . "</p><br>";
                        }
                    }
                } catch (PDOException $miExceptionPDO) {
                    echo '<p style="color:purple; font-weight:bold;">Error: ' . $miExceptionPDO->getMessage().'<br>'. 'Código de error: ' . $miExceptionPDO->getCode();
                } finally {
                    //mejor dentro para que se cierre en todos los casos.
                    unset($miDB);
                }

                //Establecer la conexión en la base de datos
                
                 echo '<h2>Conexión con la base de datos con errores</h2>';
                try {
                    $miDB2=new PDO($dsn, 'usuarioDb', $pswd);
                    echo'<h3 style="color:blue; font-weight:bold;">Conexion establecida con exito!!!!</h3><br></br>';
                    echo'<h3>Atributos de la conexión</h3><br>';
                    //para que se vean los nombre y la constante que corresponde a cada atributo.
                    foreach ($aAtrConexion as $nombre => $constante) {
                        echo "PDO::ATTR_$nombre: <br>";
                        try {
                            echo '<p style="color:green; font-weight:bold;">' . $miDB2->getAttribute($constante) . "</p><br>";
                        } catch (PDOException $miExceptionPDO) {
                            echo '<p style="color:red"> <span style:"font-weight:bold">Error: </span>' . $miExceptionPDO->getMessage() . '. <br> <span class="font-weight:bold" >Código del error: </span>' . $miExceptionPDO->getCode() . "</p><br>";
                        }
                    }
                } catch (PDOException $miExceptionPDO) {
                    echo '<p style="color:purple; font-weight:bold">Error: ' . $miExceptionPDO->getMessage().'<br>'. 'Código de error: ' . $miExceptionPDO->getCode();
                } finally {
                    //mejor dentro para que se cierre en todos los casos.
                    unset($miDB2);
                }




//                // https://www.php.net/manual/es/pdo.error-handling.php
//                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                if ($miDB) {
//                    echo'Conexion establecida';
//                } else {
//                    echo'Error de conexión';
//                }


//                // Se crea la base de datos
//                $miDB->exec('DROP DATABASE IF EXISTS DBVGDWESProyectoTema4');
//                $miDB->exec('CREATE DATABASE IF  NOT EXISTS DBVGDWESProyectoTema4  CHARACTER SET utf8 COLLATE utf8_spanish_ci');
//                $miDB->exec('USE DBVGDWESProyectoTema4');
//
//                // Se crea la tabla
//                $miDB->exec('CREATE TABLE IF NOT EXISTS T_02Departamento (
//                     T02_CodDepartamento varchar(3) PRIMARY KEY, 
//                     T02_FechaCreacionDepartamento datetime ,
//                     T02_FechaBajaDepartamento date,
//                     T02_DescDepartamento varchar(255),
//                     T02_VolumenDeNegocio float)Engine=innodb');
//                //Se inserta en la tabla creada
//                $miDB->exec("INSERT INTO T_02Departamento (T02_CodDepartamento,T02_FechaCreacionDepartamento,T02_FechaBajaDepartamento,T02_DescDepartamento,T02_VolumenDeNegocio)
//                            VALUES 
//                               ('AUT','2024-10-23',NULL,'Departamento de Automoción',1285.50),
//                               ('AER','2024-11-23',NULL,'Departamento de Aeronautica',2285.50),
//                               ('DEF','2024-12-23',NULL,'Departamento de Defensa',3285.50)");
                ?>
            </section>


        </main>
        <footer class="footer">
            <div class="footerContent">
                <div><p class="copyright">
                        2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> <address><a href="../../VGDWESProyectoDWES/indexProyectoDWES.html">Véronique Grué.</a> Fecha de Actualización :
                        <time datetime="2025-11-05"></time>05-11-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

