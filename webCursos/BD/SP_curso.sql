DROP PROCEDURE IF EXISTS SP_curso
DELIMITER //
CREATE PROCEDURE sp_curso(
	IN accion			TINYINT,
	IN sp_idCurso  		INT, 
    IN sp_nombre 		VARCHAR(30), 
    IN sp_contenidoP 	INT,
    IN sp_contenidoAd 	TEXT, 
    IN sp_imagen 		MEDIUMBLOB,
    IN sp_descripcionCu TEXT,
    IN sp_estadoCurso 	BIT,
    IN sp_precio 		FLOAT, 
    IN sp_instructor 	INT,
    IN sp_categoria     INT,
    IN sp_nombreNiv		varchar(40),
    IN sp_gratuito		bit,
    IN sp_video			mediumblob,
    IN sp_idNivel		INT,
    IN sp_idUser		INT
    )
BEGIN
	IF accion = 0 THEN /*Alta de curso*/
		INSERT INTO Cursos(nombreCurso, contenidoP, contenidoAd, imagen, descripcionCur, precio, instructor) 
		VALUES (sp_nombre, sp_contenidoP, sp_contenidoAd, sp_imagen, sp_descripcionCu, 
					sp_precio, sp_instructor);
	ELSEIF accion = 2 THEN /*Asignar categorias a curso*/
		INSERT INTO CursosConcat(categoria, curso)
        VALUES (sp_categoria, Function_getLastIdCourse());
	ELSEIF accion = 3 THEN /*Agregar niveles a un curso*/
		INSERT INTO Niveles(curso, nombreNiv, gratuito, video)
        VALUES (Function_getLastIdCourse(), sp_nombreNiv, sp_gratuito, sp_video);
        
	ELSEIF accion = 1 THEN /*Consulta de los datos curso*/
		SELECT idCurso, nombreCurso, descripcionCur, contenidoP, contenidoAd, imagen, precio, nombre, instructor, estadoCurso
        FROM view_curso	
        WHERE idCurso = sp_idCurso;
	ELSEIF accion = 7 THEN /*Consulta calificacion de un curso*/
		SELECT rate FROM view_rating WHERE idCurso = sp_idCurso;
	ELSEIF accion = 4 THEN /*Consulta de niveles de un curso*/
		SELECT idNivel, nombreNiv FROM view_curso WHERE idCurso = sp_idCurso;
	ELSEIF accion = 5 THEN /*Consulta del nivel*/
		SELECT idNivel, nombreNiv, video, idCurso, nombreCurso, levelPrice, gratuito
        FROM view_curso	
        WHERE idNivel = sp_idNivel;
	
	ELSEIF accion = 8 THEN /*Actualizar precio del curso*/
		UPDATE cursos SET precio = sp_precio WHERE idCurso = sp_idCurso;
	ELSEIF accion = 9 THEN /*Dar de baja curso*/
		UPDATE cursos SET estadoCurso = 0 WHERE idCurso = sp_idCurso;
    END IF;
END //
DELIMITER ;