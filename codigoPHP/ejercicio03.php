<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio03</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">

    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 03</h1>
        </header>
        <main>
            <section>
                <?php
                /**
                 * @author Véronique Grué
                 * @version 1.0
                 * @date 2025-11-05 
                 * 
                 *
                 * Ejercicio 3
                 * *Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.
                 */
                //enlace para importar las librerías de validación de campos
                require_once '../core/libreriaValidacion.php';

                ///inicialización de variables
                /** @var array $aErrores Array para almacenar mensajes de error de validación. */
                $aErrores = [
                    'T02_CodDepartamento' => '',
                   // 'T02_FechaCreacionDepartamento' => new DateTime(),
                   // 'T02_FechaBajaDepartamento' => new DateTime(),
                    'T02_DescDepartamento' => '',
                    'T02_VolumenDeNegocio' => ''
                ];
                /** @var array $aRespuestas Array para almacenar las repuestas. */
                $aRespuestas = [
                    'T02_CodDepartamento' => '',
                   // 'T02_FechaCreacionDepartamento' => new DateTime(),
                   // 'T02_FechaBajaDepartamento' => new DateTime(),
                    'T02_DescDepartamento' => '',
                    'T02_VolumenDeNegocio' => ''
                ];

                /** @boollean boolean $entradaOK Indica si los datos de entrada son correctos o no. */
                $entradaOK = true;

                //Para cada campo del formulario se valida la entrada y se actua en consecuencia
                if (isset($_REQUEST['enviar'])) {//se cumple si el boton es submit
                    //Validación de los datos de los campos del formulario
                    $aErrores['T02_CodDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['T02_CodDepartamento'], 3, 3, 1);
                   // $aErrores['T02_FechaCreacionDepartamento'] = validacionFormularios::validarFecha($_REQUEST['T02_FechaCreacionDepartamento'], $fechaMaxima, $fechaMinima, 1);
                   // $aErrores['T02_FechaBajaDepartamento'] = validacionFormularios::validarFecha($_REQUEST['TT02_FechaBajaDepartamento'], $fechaMaxima, $fechaMinima, 1);
                    $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['T02_DescDepartamento'], 255, 0, 1);
                    $aErrores['T02_VolumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['T02_VolumenDeNegocio']);

                    //recorre el array de errores para detectar si hay alguno
                    foreach ($aErrores as $campo => $valorCampo) {
                        if ($valorCampo != null) {//Si encuentra algún error 
                            $entradaOK = false; // la entrada no es correcta
                        }
                    }
                } else {
                    //Si no se ha aceptado el formulario
                    $entradaOK = false;
                }
                //Tratamiento del formulario
                if ($entradaOK) {
                    //REllenamos el array de respuesta con los valores que ha introducido el usuario
                    $aRespuestas['T02_CodDepartamento'] = trim($_REQUEST['T02_CodDepartamento']);
                   // $aRespuestas['T02_FechaCreacionDepartamento'] = $_REQUEST['T02_FechaCreacionDepartamento'];
                   // $aRespuestas['T02_FechaBajaDepartamento'] = $_REQUEST['T02_FechaBajaDepartamento'];
                    $aRespuestas['T02_DescDepartamento'] = trim($_REQUEST['T02_DescDepartamento']);
                    $aRespuestas['T02_VolumenDeNegocio'] = trim($_REQUEST['T02_VolumenDeNegocio']);

                    try {
                        // Configuracion conexión PDO
                        $dsn = 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4';
                        $usuarioDb = 'userVGDWESProyectoTema4';
                        $pswd = 'paso';

                        $miDB = new PDO($dsn, $usuarioDb, $pswd);
                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Preparación de la consulta con parámetros
                        $sql = "INSERT INTO T_02Departamento 
                            (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
                            VALUES (:codDpto,:descDpto, :volDpto)";

                        $consulta = $miDB->prepare($sql);

                        // Asignar valores a los parámetros
                        $consulta->bindParam(':codDpto', $aRespuestas['T02_CodDepartamento']);
                        $consulta->bindParam(':descDpto', $aRespuestas['T02_DescDepartamento']);
                        $consulta->bindParam(':volDpto', $aRespuestas['T02_VolumenDeNegocio']);
                        
                        //var_dump($aRespuestas);
                        // Ejecutar la consulta
                        $consulta->execute();

                        echo "<p style='color:green; font-weight:bold;'>Departamento insertado correctamente.</p>";
                    } catch (PDOException $miExceptionPDO) {
                        echo '<p style="color:purple; font-weight:bold;">Error en la base de datos: '
                        . $miExceptionPDO->getMessage() . '<br>Código: '
                        . $miExceptionPDO->getCode() . '</p>';
                    } finally {
                        unset($miDB);
                    }

                    //Se recorre el array de las respuestas y se muestran
                    print("<br><h3>Respuestas del usuario</h3><br>");
                    foreach ($aRespuestas as $campo => $valorCampo) {
                        print("$campo del usuario : " . $valorCampo . '</br>');
                    }
                } else {
                    //si hay algún error se vuelve a mostrar el formulario
                    ?>
                    <section>
                        <h2>Rellena el formulario.</h2>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">



                            <label for="T02_CodDepartamento">T02_CodDepartamento:</label>
                            <a style='color:red'><?php echo $aErrores['T02_CodDepartamento'] ?></a><br>
                            <input name="T02_CodDepartamento" id="T02_CodDepartamento" type="text" value='<?php echo(empty($aErrores['T02_CodDepartamento'])) ? ($_REQUEST['T02_CodDepartamento'] ?? '') : ''; ?>'><br>

                            <label for="T02_DescDepartamento">T02_DescDepartamento:</label>
                            <a style='color:red'><?php echo $aErrores['T02_VolumenDeNegocio'] ?></a><br>
                            <input name="T02_DescDepartamento" id="T02_DescDepartamento" type="text" value='<?php echo(empty($aErrores['T02_DescDepartamento'])) ? ($_REQUEST['T02_DescDepartamento'] ?? '') : ''; ?> '><br>

                            <label for="T02_VolumenDeNegocio">T02_VolumenDeNegocio:</label>
                            <a style='color:red'><?php echo $aErrores['T02_VolumenDeNegocio'] ?></a><br>
                            <input name="T02_VolumenDeNegocio" id="T02_VolumenDeNegocio" type="text" value='<?php echo(empty($aErrores['T02_VolumenDeNegocio'])) ? ($_REQUEST['T02_VolumenDeNegocio'] ?? '') : ''; ?> '><br>

                            <button type="submit" name="enviar">Enviar</button>

                        </form>  
                        <?php
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

