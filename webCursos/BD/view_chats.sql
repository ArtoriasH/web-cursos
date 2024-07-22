drop view if exists view_chats;

create view view_chats as 
SELECT idChat, instructor, alumno, ui.nombre as nombreI, ua.nombre as nombreA,
ui.foto as fotoI, ua.foto as fotoA
        FROM chats
        JOIN usuarios ui ON ui.idUser = instructor
        JOIN usuarios ua ON ua.idUser = alumno     