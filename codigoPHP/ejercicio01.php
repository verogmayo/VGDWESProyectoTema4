<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio01</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
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
                 */
                
                //  https://www.php.net/manual/es/pdo.connections.php
                /** @var $dns (Data Source Name): indica el tipo de conexión, el host y el nombre de la base de datos. */
                /** @var string $usuarioDb : usuario de la base de datos. */
                /** @var string $pswd Contraseña del usuario de la base de datos. */
                
                $dns='mysql:host=192.168.0.22;dbname=DBVGDWESProyectoTema4';
                $usuarioDb='adminsql';     
                $pswd='paso';
                //Establecer la conexión en la base de datos
                $miDB = new PDO($dns,$usuarioDb,$pswd);
                if($miDB){
                    echo'Conexion establecida con DBVGDWESProyectoTema4';
                }else {
                    echo'Error de conexión';
                }
               // https://www.php.net/manual/es/pdo.error-handling.php
               // $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$miDB->query('SELECT * FROM tablaPrueba');
                
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

