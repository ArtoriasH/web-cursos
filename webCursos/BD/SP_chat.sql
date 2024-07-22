DROP PROCEDURE IF EXISTS SP_chat
DELIMITER //
CREATE PROCEDURE sp_chat(
	IN accion				TINYINT,
    IN sp_idAlumno   		INT,
    IN sp_idMaestro 		INT,
    IN sp_idChat  			INT,
    IN sp_mensaje 			TEXT
    
    )
BEGIN
	IF accion = 0 THEN /*Crear chat*/
		INSERT INTO chats(instructor, alumno) 
        VALUES(sp_idMaestro, sp_idAlumno);
        
	ELSEIF accion = 1 THEN /*Mostrar mensajes de un chat*/
		SELECT contenidoMsg, remitente, chat, hora, instructor, nombreI, nombreA, alumno 
        FROM view_messages
        WHERE chat = sp_idChat
        ORDER BY hora;
        
	ELSEIF accion = 4 THEN /*Mostrar los datos de un chat*/
		SELECT idChat, instructor, nombreI, nombreA, alumno, fotoI, fotoA
        FROM view_chats
        WHERE idChat = sp_idChat;        
        
	ELSEIF accion = 2 THEN /*Mandar mensaje*/
		INSERT INTO mensajes(contenidoMsg, remitente, chat) 
        VALUES(sp_mensaje, sp_idAlumno, sp_idChat);
        
	ELSEIF accion = 3 THEN /*Mostrar chats disponibles*/
		SELECT idChat, instructor, alumno, nombreI, nombreA
        FROM view_chats	
        WHERE instructor = sp_idAlumno 
        OR alumno = sp_idAlumno;
        
	ELSEIF accion = 5 THEN /*Verficar si el chat entre 2 usuarios ya existe*/
		SELECT idChat
        FROM chats
        WHERE alumno = sp_idAlumno AND instructor = sp_idMaestro;
    END IF;
END //
DELIMITER ;