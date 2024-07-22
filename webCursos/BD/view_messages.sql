drop view if exists view_messages;

create view view_messages as 
SELECT contenidoMsg, remitente, chat, hora, chats.instructor, 
ui.nombre as nombreI, ua.nombre as nombreA, chats.alumno 
        FROM mensajes
		JOIN chats ON chats.idChat = chat 
        JOIN usuarios ui ON ui.idUser = chats.instructor
		JOIN usuarios ua ON ua.idUser = chats.alumno