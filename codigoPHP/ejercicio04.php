<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - ProyectoTema3 Ejercicio04</title>
        <link rel="stylesheet" href="../webroot/css/styleEjercicios.css">
        <style>
            p{
                font-size: 16px;
            }
            span{
                color:blue;
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <header class="header">
             <a href="../indexProyectoTema3.php">volver</a>
            <h1>Ejercicio 04</h1>
        </header>
        <main>
            <section>
                <?php
                /**
                 * @author: Véronique Grué
                 * @since 10/10/2025
                 * 
                 */
                // Establecer la zona horaria 
                date_default_timezone_set('Europe/Lisbon');
                // crear un objet de DateTime.
                $ofecha = new DateTime();

                // Establecer el locale (idioma) en español
                setlocale(LC_TIME, 'pt_PT.UTF-8', 'pt_PT', 'portuguese');
                //https://www.w3schools.com/tags/ref_language_codes.asp
                //Para que funcione escribir en portugues, si no está habilidato hay que entrar 
                //en la carpeta /etc/locale.gen y descomentar los idiomas que se quieran. y ejecutar sudo locale-gen

                echo("<h3>Fecha y hora actual en Portugues.</h3><br>");
                // Mostrar el resultado
                echo( "<p>La fecha de hoy es :<span> " . $ofecha->format("l") . " " . $ofecha->format("d") . " de " . $ofecha->format("F") . " de " . $ofecha->format("o") . " y la hora es: " . $ofecha->format("H:i:s") . '</span></p>');
                //info para el parametro format : https://www.php.net/manual/es/datetime.format.php

                echo('<br><br><h3>Usando el timestamp de DateTime y strftime, los dias y los meses están en Portugues</h3><br> ');

                echo "La fecha de hoy es: <span>" . strftime("%A %d de %B de %Y", $ofecha->getTimestamp()) .
                " y la hora es: " . $ofecha->format("H:i:s") . '</span>';
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

