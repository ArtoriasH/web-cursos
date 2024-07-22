DROP PROCEDURE IF EXISTS SP_USER
DELIMITER //
CREATE PROCEDURE sp_user(
	IN accion			TINYINT,
	IN sp_idUser  		INT, 
    IN sp_contra 		VARCHAR(20), 
    IN sp_rol 			INT,
    IN sp_email 		VARCHAR(30), 
    IN sp_foto 			MEDIUMBLOB,
    IN sp_nombre 		VARCHAR(30),
    IN sp_apeP 			VARCHAR(30),
    IN sp_apeM 			VARCHAR(30), 
    IN sp_fNacimiento 	DATE,
    IN sp_genero 		BIT,
    IN sp_estado 		BIT
    )
BEGIN
	IF accion = 0 THEN /*Alta de usuario*/
		INSERT INTO Usuarios(contra, rol, email, foto, nombre, apeP, apeM, 
						fNacimiento, genero) 
		VALUES (sp_contra, sp_rol, sp_email, sp_foto, sp_nombre, sp_apeP, 
					sp_apeM, sp_fNacimiento, sp_genero);
    ELSEIF accion = 1 THEN /*Editar usuario*/
		UPDATE Usuarios 
        SET contra = sp_contra, 		
			foto = sp_foto,
			nombre = sp_nombre,
			apeP = sp_apeP,
			apeM = sp_apeM,
			fNacimiento = sp_fNacimiento	
		WHERE idUser = sp_idUser;
	ELSEIF accion = 2 THEN /*Editar usuario sin imagen*/
		UPDATE Usuarios 
        SET contra = sp_contra, 
			nombre = sp_nombre,
			apeP = sp_apeP,
			apeM = sp_apeM,
			fNacimiento = sp_fNacimiento
		WHERE idUser = sp_idUser;
	ELSEIF accion = 3 THEN /*Baja lógica*/
		UPDATE Usuarios SET estado = 0 WHERE idUser = sp_idUser;
	ELSEIF accion = 4 THEN /*Consulta tus datos*/
		SELECT idUser, foto, email, rol, contra, nombre, apeP, apeM, fNacimiento, 
			genero FROM Usuarios WHERE idUser = sp_idUser AND estado = 1;
            
	ELSEIF accion = 5 THEN /*Consulta de todos los usuarios activos*/
		SELECT idUser, nombre, apeP, apeM, estado
        FROM Usuarios WHERE rol != 0 ;
	ELSEIF accion = 6 THEN /*Desactivar usuario por intentos en login*/
		UPDATE Usuarios SET estado = 0 WHERE email = sp_email;
	ELSEIF accion = 7 THEN /*Habilitar un usuario otra vez*/
		UPDATE Usuarios SET estado = 1 WHERE idUser = sp_idUser;
        
	ELSEIF accion = 8 THEN /*Traer todos los cursos creados por un instructor*/
		SELECT idCurso, nombreCurso
        FROM cursos 
        JOIN usuarios ON usuarios.idUser = instructor
        WHERE usuarios.idUser = sp_idUser;
    END IF;
END //
DELIMITER ;