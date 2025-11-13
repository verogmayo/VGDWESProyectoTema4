CREATE DATABASE IF  NOT EXISTS DBVGDWESProyectoTema4 ;
USE DBVGDWESProyectoTema4;
CREATE TABLE IF NOT EXISTS T_02Departamento (
                     T02_CodDepartamento VARCHAR(3) PRIMARY KEY, 
                     T02_FechaCreacionDepartamento datetime not null default now() ,
                     T02_FechaBajaDepartamento datetime default null,
                     T02_DescDepartamento VARCHAR(255),
                     T02_VolumenDeNegocio FLOAT)engine=innodb;

USE DBVGDWESProyectoTema4;
INSERT INTO T_02Departamento (T02_CodDepartamento,T02_FechaCreacionDepartamento,T02_FechaBajaDepartamento,T02_DescDepartamento,T02_VolumenDeNegocio)
                 VALUES 
            ('AUT',now(),NULL,'Automoción',1285.50),
            ('AER',now(),NULL,'Aeronautica',2285.50),
            ('DEF',now(),'2025-05-25','Defensa',3285.50);
