<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio08</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">

    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 08</h1>
        </header>
        <main>
            <section>
                <?php
                /**
                 * @author: Véronique Grué
                 * @since 13/11/2025
                 * 
                 *  * Ejercicio 8
                 * 	Página web que toma datos (código y descripción) de la tabla Departamento y 
                 * guarda en un fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero 
                 * exportado se encuentra en el directorio .../tmp/ del servidor.
                 */
                //enlace a los datos de conexión
                require_once '../config/confDBPDO.php';

                try {
                    //Conexion a la base de datos
                    $miDB = new PDO(DNS, USUARIODB, PSWD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "<h3>Conexión establecida con éxito.</h3>";
                    //Consulta Preparada
                    $sql = 'SELECT T02_CodDepartamento, T02_DescDepartamento FROM T_02Departamento';
                    $consultaPreparada = $miDB->prepare($sql);
                    //Ejecución de la consulta
                    $consultaPreparada->execute();

                    //https://www.php.net/manual/es/book.simplexml.php
                    //https://www.w3schools.com/php/php_ref_simplexml.asp
                    //creacion del objeto XML
                    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><departamentos></departamentos>');

                    while ($oDepartamento = $consultaPreparada->fetchObject()) {
                        $elemento = $xml->addChild('departamento');
                        $elemento->addChild('codDpto', $oDepartamento->T02_CodDepartamento);
                        $elemento->addChild('descDpto', $oDepartamento->T02_DescDepartamento);
                    }
                    //Se guarda el fichero en la carpeta tmp
                    $rutaFichero = '/var/www/html/VGDWESProyectoTema4/tmp/departamentos.xml';
                    
                    $xml->asXML($rutaFichero);
                    echo "<p>Ruta generada: $rutaFichero</p>";
                    //Mensaje de confirmación
                    echo "<h3 style='color:blue;'>Exportación completada con éxito.</h3>";
                    echo "<p>El archivo se ha guardado en: <b>{$rutaFichero}</b></p>";
                } catch (PDOException $miExceptionPDO) {
                    // errores de la base de datos.    
                    echo "<h3 style='color:red;'>Error en la base de datos.</h3>";
                    echo "<p><b>Mensaje:</b> " . $miExceptionPDO->getMessage() . "</p>";
                    echo "<p><b>Código:</b> " . $miExceptionPDO->getCode() . "</p>";
                } catch (Exception $miExcepcionGeneral) {
                    echo "<h3 style='color:red;'>Error general.</h3>";
                    echo "<p><b>Mensaje:</b> " . $miExcepcionGeneral->getMessage() . "</p>";
                } finally {
                    unset($miDB); // Cerrar conexión
                }
                ?>
            </section>


        </main>
        <footer class="footer">
            <div class="footerContent">
                <div><p class="copyright">
                        2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> <address><a href="../../VGDWESProyectoDWES/indexProyectoDWES.html">Véronique Grué.</a> Fecha de Actualización :
                        <time datetime="2025-10-02"></time> 02-10-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

