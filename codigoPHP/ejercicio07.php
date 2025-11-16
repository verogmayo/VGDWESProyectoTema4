<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio07</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 07</h1>
        </header>
        <main>
            <section>
                <?php
                /**
                 * @author: Véronique Grué
                 * @since 13/11/2025
                 * 
                 *  * Ejercicio 7
                 * 	Página web que toma datos (código y descripción) de un fichero xml y 
                 * los añade a la tabla Departamento de nuestra base de datos.
                  /**
                 * Script para importar departamentos desde un archivo XML a la base de datos
                 * 
                 * Este archivo realiza las siguientes operaciones:
                 * 1. Verifica la existencia del archivo XML
                 * 2. Carga y parsea el archivo XML con SimpleXML
                 * 3. Inserta los departamentos en la base de datos mediante transacciones PDO
                 * 4. Confirma o revierte la transacción según el resultado
                  */
                //enlace a los datos de conexión
                require_once '../config/confDBPDO.php';

                /**
                 * Ruta absoluta del archivo XML con los datos de departamentos
                 * 
                 * @var string $rutaFichero Ruta completa al archivo XML
                 */
                $rutaFichero = '../tmp/departamentos2.xml';

                /**
                 * Verifica que el archivo XML existe en la ruta especificada
                 * Si no existe, termina la ejecución del script
                 */
                    // Comprobación de la existencia del archivo
                    // https://www.w3schools.com/php/func_misc_exit.asp
                if (!file_exists($rutaFichero)) {
                    exit('<p style="color:red;">Error: No se encuentra el fichero XML.</p>');
                }

                /**
                 * Carga el archivo XML y lo convierte en un objeto SimpleXMLElement
                 * 
                 * @var SimpleXMLElement|false $xml Objeto con la estructura del XML o false si falla
                 */
                    // Conversión del fichero xml a objeto
                    // https://www.w3schools.com/php/func_simplexml_load_file.asp
                $xml = simplexml_load_file($rutaFichero);

                /**
                 * Verifica que el XML se haya cargado correctamente
                 * Si falla, termina la ejecución del script
                 */
                // Verificar que el XML se cargó correctamente
                if ($xml === false) {
                    exit('<p style="color:red;">Error: No se pudo cargar el archivo XML.</p>');
                }

                try {
                    /**
                     * Conexión a la base de datos mediante PDO
                     * Configura el modo de error para lanzar excepciones
                     * 
                     * @var PDO $miDB Objeto de conexión a la base de datos
                     */
                    // Conexion a la base de datos
                    $miDB = new PDO(DNS, USUARIODB, PSWD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "<h3>Conexión establecida con éxito.</h3>";

                    // INICIAR TRANSACCIÓN
                    $miDB->beginTransaction();

                    /**
                     * Consulta SQL preparada para insertar departamentos
                     * Utiliza parámetros nombrados para prevenir inyección SQL
                     * 
                     * @var string $sql Sentencia INSERT con parámetros nombrados
                     */
                    // Consulta Preparada para la inserción
                    $sql = <<<SQL
                        INSERT INTO T_02Departamento 
                        (T02_CodDepartamento, 
                        T02_DescDepartamento, 
                        T02_VolumenDeNegocio) 
                        VALUES (:codigo, :descripcion, :volumen)
                        SQL;

                    /**
                     * Consulta preparada para la inserción de departamentos
                     * 
                     * @var PDOStatement $consultaPreparada Statement preparado con la consulta SQL
                     */
                    $consultaPreparada = $miDB->prepare($sql);

                    /**
                     * Recorre cada elemento departamento del XML e inserta los datos en la base de datos
                     * Convierte cada campo del XML al tipo de dato apropiado antes de la inserción
                     * 
                     * @var SimpleXMLElement $dep Elemento departamento del XML
                     * @var string $codigo Código del departamento
                     * @var string $descripcion Descripción del departamento
                     * @var float $volumen Volumen de negocio del departamento (0.00 por defecto)
                     */
                    // Recorremos el fichero xml con transacción
                    // https://www.php.net/manual/es/simplexml.examples-basic.php
                    foreach ($xml->departamento as $dep) {
                        $codigo = (string) $dep->codDpto;
                        $descripcion = (string) $dep->descDpto;
                        $volumen = isset($dep->volumen) ? (float) $dep->volumen : 0.00;

                        $consultaPreparada->bindParam(':codigo', $codigo);
                        $consultaPreparada->bindParam(':descripcion', $descripcion);
                        $consultaPreparada->bindParam(':volumen', $volumen);

                        // Ejecución de la consulta
                        $consultaPreparada->execute();
                        echo "<p style='color:green;'>Insertado: $codigo - $descripcion</p>";
                    }

                    // CONFIRMAR TRANSACCIÓN
                    $miDB->commit();
                    echo "<h3 style='color:green;'>Datos insertados correctamente desde el XML.</h3>";
                } catch (PDOException $miExceptionPDO) {
                    /**
                     * Captura errores de PDO durante la transacción
                     * Revierte los cambios si la transacción está activa
                     * Muestra información detallada del error
                     * 
                     * @var PDOException $miExceptionPDO Excepción lanzada por PDO
                     */
                    // Errores de la base de datos
                    if ($miDB && $miDB->inTransaction()) {
                        $miDB->rollBack();
                    }
                    echo "<h3 style='color:red;'>Error en la base de datos.</h3>";
                    echo "<p><b>Mensaje:</b> " . $miExceptionPDO->getMessage() . "</p>";
                    echo "<p><b>Código:</b> " . $miExceptionPDO->getCode() . "</p>";
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

