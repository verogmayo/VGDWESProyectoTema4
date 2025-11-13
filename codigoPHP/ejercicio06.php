<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio06</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">

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
                require_once '../config/pdoconfig.php';
                try {
                    //Establecer la conexión en la base de datos
                    $miDB = new PDO(DNS, USUARIODB, PSWD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    //Array de los nuevos departamentos
                    $aDepartamentos = [
                        ['FRA', 'Departamento de Francés', 4567.98],
                        ['ING', 'Departamento de Ingles', 14567.98],
                        ['ALE', 'Departamento de Aleman', 4067.98]
                    ];
                     
                    // Creacion de la consulta
                    $sql = "INSERT INTO T_02Departamento 
            (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
            VALUES (:codigo, :descripcion, :volumen)";
                    $miDB->beginTransaction();
                    $consultaPreparada = $miDB->prepare($sql);
                   
                    //bucle for para el insert
                    foreach ($aDepartamentos as $departamento) {
                        $consultaPreparada->bindParam(':codigo', $departamento[0]);
                        $consultaPreparada->bindParam(':descripcion', $departamento[1]);
                        $consultaPreparada->bindParam(':volumen', $departamento[2]);

                        $consultaPreparada->execute();
                        echo "<p style='color:green;'>Departamento {$departamento[1]} insertado correctamente.</p>";
                        
                        
                        }
                    $miDB->commit();
                    echo "<h3 style='color:green; font-weight:bold;'>Todos los departamentos fueron insertados correctamente.</h3>";
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

