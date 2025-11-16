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
                  /**
                 * Script para exportar departamentos de la base de datos a un archivo XML
                 * 
                 * Este archivo realiza las siguientes operaciones:
                 * 1. Consulta los departamentos almacenados en la base de datos
                 * 2. Crea un objeto SimpleXMLElement con la estructura XML
                 * 3. Itera sobre los resultados y construye el árbol XML
                 * 4. Guarda el archivo XML generado en el sistema de archivos
                 * 
                 */
                //enlace a los datos de conexión
                require_once '../config/confDBPDO.php';

                try {
                    /**
                     * Conexión a la base de datos mediante PDO
                     * Configura el modo de error para lanzar excepciones
                     * 
                     * @var PDO $miDB Objeto de conexión a la base de datos
                     */
                    //Conexion a la base de datos
                    $miDB = new PDO(DNS, USUARIODB, PSWD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "<h3>Conexión establecida con éxito.</h3>";

                    /**
                     * Consulta SQL para obtener código y descripción de todos los departamentos
                     * 
                     * @var string $sql Sentencia SELECT para recuperar departamentos
                     */
                    //Consulta Preparada
                    $sql = 'SELECT T02_CodDepartamento, T02_DescDepartamento FROM T_02Departamento';

                    /**
                     * Consulta preparada para la selección de departamentos
                     * 
                     * @var PDOStatement $consultaPreparada Statement preparado con la consulta SQL
                     */
                    $consultaPreparada = $miDB->prepare($sql);

                    //Ejecución de la consulta
                    $consultaPreparada->execute();

                    /**
                     * Objeto SimpleXMLElement para construir la estructura XML
                     * Inicializado con la declaración XML y el elemento raíz 'departamentos'
                     * 
                     * @var SimpleXMLElement $xml Objeto que representa el documento XML
                     */
                    //https://www.php.net/manual/es/book.simplexml.php
                    //https://www.w3schools.com/php/php_ref_simplexml.asp
                    //creacion del objeto XML
                    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><departamentos></departamentos>');

                    /**
                     * Itera sobre cada departamento recuperado de la base de datos
                     * Crea un elemento 'departamento' con sus hijos 'codDpto' y 'descDpto'
                     * 
                     * @var objeto $oDepartamento Objeto con los datos de cada departamento
                     * @var SimpleXMLElement $elemento Elemento XML 'departamento' añadido al árbol
                     */
                    while ($oDepartamento = $consultaPreparada->fetchObject()) {
                        $elemento = $xml->addChild('departamento');
                        $elemento->addChild('codDpto', $oDepartamento->T02_CodDepartamento);
                        $elemento->addChild('descDpto', $oDepartamento->T02_DescDepartamento);
                    }

                    /**
                     * Ruta absoluta donde se guardará el archivo XML generado
                     * 
                     * @var string $rutaFichero Ruta completa del archivo de destino
                     */
                    /*Se guarda el fichero en la carpeta tmp.
                    Es importante que la carpeta tmp tenga permisos de lectura y escritura para que php pueda guardar el fichero departamentos.php
                    para ello se ejecutan estos commandos en el servidor
                    sudo chown -R www-data:www-data /var/www/html/VGDWESProyectoTema4/tmp
                    sudo chmod 775 /var/www/html/VGDWESProyectoTema4/tmp
                    Hay que mirar si el fichero está en la capreta tmp del servidor 
                     porque no se ve en la carpeta tmp de netbeans si no se descarga manualmente
                     */
                    $rutaFichero = '../tmp/departamentos.xml';

                    /**
                     * Guarda el objeto XML como archivo en el sistema de archivos
                     */
                    $xml->asXML($rutaFichero);
                    echo "<p>Ruta generada: $rutaFichero</p>";

                    //Mensaje de confirmación
                    echo "<h3 style='color:blue;'>Exportación completada con éxito.</h3>";
                    echo "<p>El archivo se ha guardado en: <b>{$rutaFichero}</b></p>";
                } catch (PDOException $miExceptionPDO) {
                    /**
                     * Captura errores específicos de PDO durante la conexión o consulta
                     * Muestra información detallada del error de base de datos
                     * 
                     * @var PDOException $miExceptionPDO Excepción lanzada por PDO
                     */
                    // errores de la base de datos.    
                    echo "<h3 style='color:red;'>Error en la base de datos.</h3>";
                    echo "<p><b>Mensaje:</b> " . $miExceptionPDO->getMessage() . "</p>";
                    echo "<p><b>Código:</b> " . $miExceptionPDO->getCode() . "</p>";
                } catch (Exception $miExcepcionGeneral) {
                    /**
                     * Captura cualquier otra excepción no relacionada con PDO
                     * Por ejemplo, errores al crear o guardar el archivo XML
                     * 
                     * @var Exception $miExcepcionGeneral Excepción general capturada
                     */
                    echo "<h3 style='color:red;'>Error general.</h3>";
                    echo "<p><b>Mensaje:</b> " . $miExcepcionGeneral->getMessage() . "</p>";
                } finally {
                    /**
                     * Cierra la conexión a la base de datos
                     * Se ejecuta siempre, independientemente de si hubo errores
                     */
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

