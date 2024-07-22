use piabdm;


                    
select * from Usuarios;
select * from Niveles;
select * from Cursos;
select * from Categorias;
select * from CursosConcat;
select * from ventas;
select * from progreso;
select * from valoraciones;
select * from chats;
select * from mensajes;


select idProgreso, vn.idCompra , vn.estadoCompleto, progreso.curso FROM progreso 
JOIN ventas vn ON vn.nivel = progreso.nivel
ORDER BY vn.nivel DESC;

delete from categorias where idCategoria < 100;

delete from progreso where alumno = 4 and curso = 19;

insert into mensajes(contenidoMsg, remitente, chat) values("hola soy maestro", 2, 2);

delete from ventas where comprador = 4 and nivel = 33;

update usuarios set estado = 1 where idUser = 1;


insert into CursosConcat(categoria, curso) values(1,8);
UPDATE ventas
        SET  diploma = 1
        WHERE comprador = 3 AND curso = 1;

INSERT INTO ventas(comprador, precioOriginal, curso, nivel) 
        VALUES(2, 1000, 16, NULL);

alter table progreso rename column fechaIngreso to ultimaFechaI;

alter table ventas add column diploma BIT default 0;
alter table ventas drop column fechaCompleto;

delete from ventas where comprador = 3;
delete from Cursos where instructor = 2;
delete from Niveles where curso = 14;
delete from CursosConcat where curso >= 1;