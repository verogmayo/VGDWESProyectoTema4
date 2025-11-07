<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - DWESProyectoTema4</title>
        <!--Fuente de google font-->
        <!--Para descargar iconos. https://v2.boxicons.com/usage  (import the css)-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="webroot/css/styles.css">
        <!--https://cdnjs.com/libraries/font-awesome --> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <a href="../VGDWESProyectoDWES/indexProyectoDWES.html">volver</a>
            <h1>PROYECTO TEMA 4</h1>
        </header>
        <main>
            <section>
                <h2>EJERCICIOS DEL TEMA 4</h2>
                
                <h3>SCRIPTS DE LA BASE DE DATOS</h3>
                <table>
                    <tr>
                        <th>Nº</th>
                        <th>Descriptción</th>
                        <th>Mostrar</th>
                        
                    </tr>
                    <tr>
                        <th>1</th>
                        <td class="texto">Creación de la base de Datos y del usuario. </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraCreaDBVGDWESProyectoTema4.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                    </tr>

                     <tr>
                        <th>2</th>
                        <td class="texto">Carga de la base de Datos. </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraCargaDBVGDWESProyectoTema4.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                    </tr>
                     <tr>
                        <th>3</th>
                        <td class="texto">Borrado de la base de Datos. </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraBorraDBVGDWESProyectoTema4.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th rowspan="2">Nº</th>
                        <th rowspan="2">Enunciados</th>
                        <th colspan="2">PDO</th>
                        <th colspan="2">MySQLi</th>
                    </tr>
                    <tr>

                        <th>Ejecutar</th>
                        <th>Mostrar</th>
                        <th>Ejecutar</th>
                        <th>Mostrar</th>
                    </tr>

<!--                    <tr>
                        <th>0</th>
                         <span class="span">text</span> 
                        <td class="texto">Creación de la base de Datos Departamento. </td>
                        <td class="iconos"><a href="codigoPHP/ejercicio00.php"><i class="fa-solid fa-circle-play"> </i> </a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio00.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                        <td class="iconos"><a href=""><i class="fa-solid fa-circle-play"></i></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                    </tr>-->

                    <tr>
                        <th>1</th>
                        <!-- <span class="span">text</span> -->

                        <td class="texto">Conexión a la base de datos con la cuenta usuario y tratamiento de errores. </td>
                        <td class="iconos"><a href="codigoPHP/ejercicio01.php"><i class="fa-solid fa-circle-play"> </i> </a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio01.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td class="texto">Mostrar el contenido de la tabla Departamento y el número de registros.</td>
                        <td class="iconos"><a href="codigoPHP/ejercicio02.php"><i class="fa-solid fa-circle-play"></i></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio02.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <th>3</th>
                    <td class="texto">Formulario para añadir un departamento a la tabla Departamento con validación de entrada y
                        control de errores.</td>
                        <td class="iconos"><a href="codigoPHP/ejercicio03.php"><i class="fa-solid fa-circle-play"></i></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio03.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td class="texto">Formulario de búsqueda de departamentos por descripción  <span class="span">(por una parte del campo
                        DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos)</span> .</td>
                        <td class="iconos"><a href="codigoPHP/ejercicio04.php"><i class="fa-solid fa-circle-play"></i></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio04.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio04.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td class="texto">Página web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones
                            insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.
                        </td><td class="iconos"><a href="codigoPHP/ejercicio05.php"><i class="fa-solid fa-circle-play"></i></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio05.php"><i class="fa-solid fa-eye"></i> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td class="texto">Página web que cargue registros en la tabla Departamento desde un array departamentosnuevos
                            utilizando una consulta preparada.</td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio06.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td class="texto">Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla
                            Departamento de nuestra base de datos.</td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio07.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td class="texto">Mostrar la dirección IP del equipo desde el que estás accediendo.</td>
                      <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio08.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>
                    <tr>
                        <th>9</th>
                        <td class="texto">Aplicación resumen MtoDeDepartamentosTema4. (Incluir PHPDoc y versionado en el repositorio
                            GIT)</td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio09.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>                </tr>

                    <tr>
                        <th>10</th>
                        <td class="texto">Aplicación resumen MtoDeDepartamentos POO y multicapa..</td>
                      <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio10.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                        <td class="iconos"><a href=""><!--<i class="fa-solid fa-circle-play"></i>--></a>  </td>
                        <td class="iconos"> <a href="mostrarcodigo/muestraEjercicio13.php"><!--<i class="fa-solid fa-eye"></i>--> </a>  </td>
                    </tr>

                </table>
            </section>
        </main>
        <footer class="footer">
            <div class="footerContent">
                <div><p class="copyright">
                        2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> <address><a href="../index.html">Véronique Grué.</a> Fecha de Actualización :
                        <time datetime="2025-10-28"></time> 28-10-2025 </address>
                </div>

            </div>

        </footer>

    </body>
</html>