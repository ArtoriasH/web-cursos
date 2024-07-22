drop database piabdm;
create database piabdm;
use piabdm;


-- Tabla Usuarios --
create table Usuarios(
idUser int not null auto_increment primary key,
nombre varchar(30),
apeP varchar(30),
apeM varchar(30),
genero bit,
fNacimiento date,
foto mediumblob,
email varchar(50),
contra varchar (20),
fActualizada datetime default current_timestamp,
estado bit default 1,
rol int
);

-- Tabla Cursos --
create table Cursos(
idCurso int not null auto_increment primary key,
nombreCurso varchar(30),
contenidoP int,
contenidoAd text,
imagen mediumblob,
descripcionCur text, 
estadoCurso bit default 1,
fechaCreaCur datetime default current_timestamp,
precio float,
instructor int, 
CONSTRAINT FK_cur_user FOREIGN KEY (instructor)
REFERENCES Usuarios(idUser)
);

-- Tabla Categorias --
create table Categorias(
nombreCat varchar(30),
idCategoria int not null auto_increment primary key,
descripcionCat text,
fechaCrea datetime default current_timestamp,
creador int,
CONSTRAINT FK_cat_user FOREIGN KEY (creador)
REFERENCES Usuarios(idUser)
);

-- Tabla Link CurCat --
create table CursosConcat(
categoria int,
CONSTRAINT FK_curcat_cat FOREIGN KEY (categoria)
REFERENCES Categorias(idCategoria),
curso int,
CONSTRAINT FK_curcat_cur FOREIGN KEY (curso)
REFERENCES Cursos(idCurso)
);

-- Tabla Niveles --
create table Niveles(
idNivel int not null auto_increment primary key,
curso int,
nombreNiv varchar(40),
gratuito bit, 
video mediumblob,
CONSTRAINT FK_niv_cur FOREIGN KEY (curso)
REFERENCES Cursos(idCurso)
);

-- Tabla Valoraciones --
create table Valoraciones(
idValoracion int not null auto_increment primary key,
comentario text,
valoracion int,
comentador int,
fechaValor datetime default current_timestamp,
CONSTRAINT FK_valor_user FOREIGN KEY (comentador)
REFERENCES Usuarios(idUser),
curso int,
CONSTRAINT FK_valor_cur FOREIGN KEY (curso)
REFERENCES Cursos(idCurso)
);

-- Tabla Ventas --
create table Ventas(
idCompra int not null auto_increment primary key,
fechaAdquirido datetime default current_timestamp,
estadoCompleto bit default 0,
fechaCompleto datetime,
diploma BIT default 0,
metodoPago bit default 0,
comprador int,
precioOriginal float,
CONSTRAINT FK_venta_user FOREIGN KEY (comprador)
REFERENCES Usuarios(idUser),
curso int,
CONSTRAINT FK_venta_cur FOREIGN KEY (curso)
REFERENCES Cursos(idCurso),
nivel int,
CONSTRAINT FK_venta_niv FOREIGN KEY (nivel)
REFERENCES Niveles(idNivel)
);


-- Tabla Progreso --
create table Progreso(
idProgreso int not null auto_increment primary key,
ultimaFechaI datetime default current_timestamp,
alumno int,
CONSTRAINT FK_progr_user FOREIGN KEY (alumno)
REFERENCES Usuarios(idUser),
nivel int,
CONSTRAINT FK_progr_niv FOREIGN KEY (nivel)
REFERENCES Niveles(idNivel),
curso int,
CONSTRAINT FK_progr_curso FOREIGN KEY (curso)
REFERENCES cursos(idCurso),
venta int,
CONSTRAINT FK_progr_venta FOREIGN KEY (venta)
REFERENCES ventas(idCompra)
);

-- Tabla Chats --
create table Chats(
idChat int not null auto_increment primary key,
instructor int, 
CONSTRAINT FK_conv_inst FOREIGN KEY (instructor)
REFERENCES Usuarios(idUser),
alumno int,
CONSTRAINT FK_conv_alum FOREIGN KEY (alumno)
REFERENCES Usuarios(idUser)
);

-- Tabla Mensajes --
create table Mensajes(
idMensaje int not null auto_increment primary key,
contenidoMsg text, 
hora datetime default current_timestamp,
remitente int,
CONSTRAINT FK_msg_rem FOREIGN KEY (remitente)
REFERENCES Usuarios(idUser),
chat int,
CONSTRAINT FK_msg_chat FOREIGN KEY (chat)
REFERENCES Chats(idChat)
);





