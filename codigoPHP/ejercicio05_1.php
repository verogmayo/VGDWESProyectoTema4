<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema4 Ejercicio05_1</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
        <style>
            *{
                margin: 0 auto;
            }
            main{
                display: block;
                align-content: center;
            }
            label{
                font-size: 20px;
                margin-bottom: 10px;
                display: inline-block;
            }

            input {
                height : 35px;
                margin-bottom: 20px;
                display: inline-block;
                padding-left: 5px;
                border-radius: 5px;
            }


            button{
                font-size: 20px;
                background-color: grey;
                color: white;
                padding: 10px;
                border-radius: 5px;
                position: absolute;
                font-family: Times New Roman;
            }


            section{
                margin-top: 10px;
                height: 400px;
                margin-bottom: 50px;
                padding: 20px;
                position: relative;
                border: solid lightskyblue;
                border-radius: 20px;
                width: 600px;
            }


            input#T02_DescDepartamento{
                width: 500px;
            }
            input#T02_CodDepartamento{
                width: 50px;
            }


            #T02_CodDepartamento, #T02_DescDepartamento, #T02_VolumenDeNegocio{
                background-color:rgb(252, 248, 204);
                font-weight: bold;
            }
            li{
                font-size: 20px;

            }
            h3{
                font-size: 25px;
            }
            #T02_FechaCreacionDepartamento, #T02_FechaBajaDepartamento{
                background-color: gainsboro;
            }
            #enviar{
                bottom: 25px;
                left:  60px;
            }
            .cancelar{
                font-size: 20px;
                background-color: grey;
                color: white;
                padding: 10px;
                border-radius: 5px;
                position: absolute;
                bottom: 25px;
                right: 60px;
            }


            h3{
                font-size: 24px;
            }
            table{
                border:solid;
                width: 80%;
                text-align: center;
                border-collapse: collapse;
                margin-bottom: 20px
            }
            th{
                border: solid;
                padding: 5px 10px;
                font-size: 20px;
                font-weight: 900;
                background-color: lightskyblue;
                white-space: nowrap;
            }
            td{
                border: solid 1px;
                padding: 5px;
                font-size: 18px;
                border-right: solid ;
            }
            .titulo{
                text-align: center;
            }
            .registro{
                border: solid;
                font-size: 20px;
            }
            .contenedorTabla{
                border: none;
                width: 100%;
                margin-bottom: 10px;
                height: auto;

            }
        </style>
    </head>
    <body>
        <header class="header">
            <a href="../indexProyectoTema4.php">volver</a>
            <h1>Ejercicio 05_1</h1>
        </header>
        <main>


            <?php
            /**
             * @author Véronique Grué
             * @version 1.0
             * @date 2025-11-05 
             * 
             *
             * Ejercicio 5
             * *Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.
             */
            //CONSULTA CON QUERY
            //enlace para importar las librerías de validación de campos
            require_once '../core/libreriaValidacion.php';
            require_once '../core/miLibreriaStatic.php';

            //Para utilizar datos en varias sessiones   
            //https://www.php.net/manual/es/reserved.variables.session.php
            // SE inicia la ssesion
           

            if (!isset($_SESSION["incluirDptos"])) {
                $_SESSION["incluirDptos"] = [];
            }
            // Variable Configuracion conexión PDO
            $dsn = 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4';
            $usuarioDb = 'userVGDWESProyectoTema4';
            $pswd = 'paso';
            $miDB = new PDO($dsn, $usuarioDb, $pswd);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            ///inicialización de variables
            /** @var array $aErrores Array para almacenar mensajes de error de validación. */
            $aErrores = [
                'T02_CodDepartamento' => '',
                'T02_DescDepartamento' => '',
                'T02_VolumenDeNegocio' => ''
            ];
            /** @var array $aRespuestas Array para almacenar las repuestas. */
            $aRespuestas = [
                'T02_CodDepartamento' => '',
                'T02_DescDepartamento' => '',
                'T02_VolumenDeNegocio' => ''
            ];

            /** @boollean boolean $entradaOK Indica si los datos de entrada son correctos o no. */
            $entradaOK = true;

            //Para cada campo del formulario se valida la entrada y se actua en consecuencia
            if (isset($_REQUEST['enviar'])) {//se cumple si el boton es submit
                //Validación de los datos de los campos del formulario
                $aErrores['T02_CodDepartamento'] = miLibreriaStatic::comprobarAlfabeticoMayuscula($_REQUEST['T02_CodDepartamento'], 3, 3, 1);
                //Comprobacion de que el codigo no está ya en la tabla departamento
                if (empty($aErrores['T02_CodDepartamento'])) {
                    $sql2 = "SELECT T02_CodDepartamento FROM T_02Departamento Where T02_CodDepartamento = '{$_REQUEST['T02_CodDepartamento']}'";
                    $resultadoConsulta = $miDB->query($sql2);
                    //https://www.php.net/manual/es/pdostatement.rowcount.php
                    if ($resultadoConsulta->rowCount() > 0) {
                        $aErrores['T02_CodDepartamento'] = "Este código ya existe. ";
                    }
                }


                
                $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['T02_DescDepartamento'], 255, 5, 1);
                $aErrores['T02_VolumenDeNegocio'] = miLibreriaStatic::comprobarFloatMonetarioES($_REQUEST['T02_VolumenDeNegocio'], PHP_FLOAT_MAX, -PHP_FLOAT_MAX, 1);

                //recorre el array de errores para detectar si hay alguno
                foreach ($aErrores as $error) {
                    if (!empty($error)) {//Si encuentra algún error 
                        $entradaOK = false; // la entrada no es correcta
                    }
                }
            } else {
                //Si no se ha aceptado el formulario
                $entradaOK = false;
            }
            //Tratamiento del formulario
            if ($entradaOK) {
                $_SESSION["incluirDptos"][] = [
                    "codidoDpto" => $_REQUEST['T02_CodDepartamento'],
                    "descDpto" => $_REQUEST['T02_DescDepartamento'],
                    "volVentasDpto" => str_replace(',', '.', $_REQUEST['T02_VolumenDeNegocio'])
                ];
                if (count($_SESSION["incluirDptos"]) < 3) {
                    echo "<h3>Departamento " . count($_SESSION["incluirDptos"]) . " guardado correctamente.</h3>";
                    echo "<p>Introducza el siguiente departamento (" . (count($_SESSION["incluirDptos"]) + 1) . "/3)</p>";
                }
                if(count($_SESSION["incluirDptos"])==3){
                try {
                    
                    $miDB->beginTransaction();
                    echo'<p>Transacción iniciada</p>';
                    // Comando de insertion de los 3 departamento
                    foreach ($_SESSION["incluirDptos"] as $dpto) {
                        $sql = "INSERT INTO T_02Departamento 
                            (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
                           VALUES (
                            '{$dpto["codidoDpto"]}',
                            '{$dpto["descDpto"]}',
                            '{$dpto["volVentasDpto"]}'
                        )";
                        $miDB->query($sql);
                    }
                    $miDB->commit();

                    echo "<p style='color:green; font-weight:bold;'>Departamentos insertados correctamente.</p><br>";
                } catch (PDOException $miExceptionPDO) {
                    $miDB->rollBack();
                    echo '<p style="color:purple; font-weight:bold;">Error: ' . $miExceptionPDO->getMessage() . '<br>' . 'Código de error: ' . $miExceptionPDO->getCode();
                } 
                $_SESSION["incluirDptos"]=[];
                }
                
                //Se recorre el array de las respuestas y se muestran

                
            }
                //si hay algún error se vuelve a mostrar el formulario
                if (count($_SESSION["incluirDptos"]) < 3) {
                
            
                    ?>

                    <section>
                        <h2>Inserta un nuevo departamento.</h2>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                            <label for="T02_CodDepartamento">Código :</label>
                            <input name="T02_CodDepartamento" id="T02_CodDepartamento" type="text" value="<?php echo(empty($aErrores['T02_CodDepartamento'])) ? ($_REQUEST['T02_CodDepartamento'] ?? '') : ''; ?>">
                            <a style='color:red'><?php echo $aErrores['T02_CodDepartamento'] ?></a>

                            <br><label for="T02_FechaCreacionDepartamento">Fecha Creación :</label>
                            <input name="T02_FechaCreacionDepartamento" id="T02_FechaCreacionDepartamento" type="date" value="<?php echo date('Y-m-d'); ?>" disabled><br>

                           
                            <label for="T02_DescDepartamento">Descripción:</label>
                            <a style='color:red'><?php echo $aErrores['T02_DescDepartamento'] ?></a>
                            <input name="T02_DescDepartamento" id="T02_DescDepartamento" type="text" value="<?php echo(empty($aErrores['T02_DescDepartamento'])) ? ($_REQUEST['T02_DescDepartamento'] ?? '') : ''; ?>"><br>

                            <label for="T02_VolumenDeNegocio">Volumen de negocio:</label>
                            <input name="T02_VolumenDeNegocio" id="T02_VolumenDeNegocio" type="text" value="<?php echo(empty($aErrores['T02_VolumenDeNegocio'])) ? ($_REQUEST['T02_VolumenDeNegocio'] ?? '') : ''; ?>">
                            <a style='color:red'><?php echo $aErrores['T02_VolumenDeNegocio'] ?></a>

                            <button type="submit" name="enviar" id="enviar">Añadir</button>
                            <a class="cancelar" href="../indexProyectoTema4.php">Cancelar</a>


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
                        <time datetime="2025-11-07"></time> 07-11-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>

