create database ccup;
use ccup;

create table institucion(
	idInstitucion int 		primary key auto_increment,
    nombre		varchar(100) not null
);
insert into institucion values(1,"No Aplica");

create table concurso(
	idConcurso			int 		primary key auto_increment,
    nombreConcurso		varchar(100) not null,
    fechaInicio		varchar(10) not null,
    fechaFin			varchar(10) not null,
    ubicacion	varchar(100) not null,
    status		tinyint		null default 0
);

-- Tipo de usuario
-- 1 Administrador
-- 2 Auxiliar
-- 3 Coach
create table usuario(
	idUsuario			int 		primary key auto_increment,
    nombre		varchar(100) not null,
    usuario	    varchar(50)  not null unique,
    correo		varchar(70)  not null,
    telefono	varchar(20)  null,
    password	varchar(70)  not null,
    idInstitucion 	int		 null,
    tipoUsuario	int			 not null,
    foreign key (idInstitucion) references institucion (idInstitucion)
);
insert into usuario values (1,"User Admin", "root","example@email.com","1234567890",sha2("root",224),1,1);

create table equipo(
	idEquipo			int 		primary key auto_increment,
    nombreEquipo		varchar(100)  not null,
    idUsuario	  int 		not null,
    idConcurso  int			not null,
    aprobado	tinyint		null default 0,
    estudiante1 varchar(100) not null,
    estudiante2 varchar(100) not null,
    estudiante3 varchar(100) not null,
    foreign key (idConcurso) references concurso (idConcurso),
    foreign key (idUsuario) references usuario (idUsuario) on delete cascade
);