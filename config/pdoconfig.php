<?php

//https://www.hostinger.com/es/tutoriales/conectar-php-mysql
if ($_SERVER['SERVER_ADDR'] == '192.168.0.22' || $_SERVER['SERVER_ADDR'] == '10.199.10.49' ) {
    define('DNS', 'mysql:host=' . $_SERVER['SERVER_ADDR'] . ';dbname=DBVGDWESProyectoTema4');
    define('USUARIODB', 'userVGDWESProyectoTema4');
    define('PSWD', 'paso');
} else {
    define('DNS', 'mysql:host=localhost;dbname=DBVGDWESProyectoTema4');
    define('USUARIODB', 'userVGDWESProyectoTema4');
    define('PSWD', 'pasoDWES4');
}

?>

