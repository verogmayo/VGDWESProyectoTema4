CREATE DATABASE IF  NOT EXISTS DBVGDWESProyectoTema4 ;
USE DBVGDWESProyectoTema4;
CREATE TABLE IF NOT EXISTS T_02Departamento (
                     T02_CodDepartamento VARCHAR(3) PRIMARY KEY, 
                     T02_FechaCreacionDepartamento datetime ,
                     T02_FechaBajaDepartamento datetime,
                     T02_DescDepartamento VARCHAR(255),
                     T02_VolumenDeNegocio FLOAT)engine=innodb;

CREATE USER IF NOT EXISTS "userVGDWESProyectoTema4"@"%" IDENTIFIED by "paso";
GRANT ALL PRIVILEGES on *.* TO "userVGDWESProyectoTema4"@"%" WITH GRANT OPTION;
FLUSH PRIVILEGES;