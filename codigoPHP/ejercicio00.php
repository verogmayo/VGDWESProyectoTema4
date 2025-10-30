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
                $dsn = 'mysql:host=192.168.0.22;dbname=prueba';
                $usuarioDb = 'adminsql';
                $pswd = 'paso';
                //Establecer la conexión en la base de datos
                $miDB = new PDO($dsn, $usuarioDb, $pswd);
                // https://www.php.net/manual/es/pdo.error-handling.php
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if ($miDB) {
                    echo'Conexion establecida';
                } else {
                    echo'Error de conexión';
                }

                // Se crea la base de datos
                $miDB->exec('DROP DATABASE IF EXISTS DBVGDWESProyectoTema4');
                $miDB->exec('CREATE DATABASE IF  NOT EXISTS DBVGDWESProyectoTema4  CHARACTER SET utf8 COLLATE utf8_spanish_ci');
                $miDB->exec('USE DBVGDWESProyectoTema4');

                // Se crea la tabla
                $miDB->exec('CREATE TABLE IF NOT EXISTS T_02Departamento (
                     T02_CodDepartamento varchar(3) PRIMARY KEY, 
                     T02_FechaCreacionDepartamento date ,
                     T02_FechaBajaDepartamento date,
                     T02_DescDepartamento varchar(255),
                     T02_VolumenDeNegocio float)Engine=innodb');
                //Se inserta en la tabla creada
                $miDB->exec("INSERT INTO T_02Departamento (T02_CodDepartamento,T02_FechaCreacionDepartamento,T02_FechaBajaDepartamento,T02_DescDepartamento,T02_VolumenDeNegocio)
                            VALUES 
                               ('AUT','2024-10-23',NULL,'Departamento de Automoción',1285.50),
                               ('AER','2024-11-23',NULL,'Departamento de Aeronautica',2285.50),
                               ('DEF','2024-12-23',NULL,'Departamento de Defensa',3285.50)");

                unset($miDB);
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

