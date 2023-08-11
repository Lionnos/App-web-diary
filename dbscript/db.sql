CREATE DATABASE dbAgenda20231;

GO
USE dbAgenda20231;
GO

create table tuser (
	idUser char(13) not null, #UNIQUEID
	firstName varchar(70) not null,
	surName varchar(70) not null,
	email varchar(100) not null,
	password varchar(70) not null,
	created_at datetime not null, #Created-at
	updated_at datetime not null, #Updated-at
	primary key(idUser)
) engine = innodb; #Importante

create table tcity (
	idCity char(13) not null,
	name varchar(100) not null,
	created_at datetime not null,
	updated_at datetime not null,
	primary key(idCity)
) engine = innodb;


create table tperson (
	idPerson char(13) not null,
	idUser char(13) not null,
	idCity char(13) not null,
	firstName varchar(70) not null,
	surName varchar(40) not null,
	phone varchar(20) not null,
	email varchar(100) null,
	created_at datetime not null,
	updated_at datetime not null,

	foreign key (idUser) references tuser(idUser),
	foreign key(idCity) references tcity(idCity)
) engine = innodb;

-- ========================
-- NOTA: Se realizo cambios
-- ========================

-- MOTORES DE BASE DE DATOS MYSQL
-- InnoDB : es el motor de base de datos relacional
-- MyISAM : es un motor no relacion


INSERT INTO tcity (idCity, name, Created_at, Updated_at)
VALUES ('A9b3c8d2e5f1g', 'Abancay', NOW(), NOW()),
       ('H6i4j7k0l9m2n', 'Cusco', NOW(), NOW()),
       ('O3p5q1r8s4t7u', 'Arequipa', NOW(), NOW());

SELECT * FROM tcity --MOSTRAR
DELETE FROM tcity; --BORRAR

SELECT * FROM tuser
SELECT * FROM tperson