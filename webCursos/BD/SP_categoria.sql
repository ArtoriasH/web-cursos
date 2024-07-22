DROP PROCEDURE IF EXISTS SP_categoria
DELIMITER //
CREATE PROCEDURE sp_categoria(
	IN accion			TINYINT,
    IN sp_idCategoria   INT,
	IN sp_nombreCat  	VARCHAR(30), 
    IN sp_descripcion 	TEXT,
    IN sp_idCurso   	INT
    )
BEGIN
	IF accion = 0 THEN /*Alta de categoria*/
		INSERT INTO categorias(nombreCat, descripcionCat, creador) 
        VALUES(sp_nombreCat, sp_descripcion, 1);
	ELSEIF accion = 1 THEN /*Consulta todas las categorias*/
		SELECT idCategoria, nombreCat FROM categorias;
	ELSEIF accion = 2 THEN /*Consulta de los datos de una categoria*/
		SELECT idCategoria, nombreCat, descripcionCat, fechaCrea FROM categorias WHERE idCategoria = sp_idCategoria;
    ELSEIF accion = 3 THEN /*Consulta de los cursos de una categoria*/
		SELECT idCategoria, nombreCat, descripcionCat, fechaCrea, idCurso, nombreCurso, imagen
        FROM view_CursosConcat
		WHERE idCategoria = sp_idCategoria;
	ELSEIF accion = 4 THEN /*Consulta las categorías de un curso*/
		SELECT idCategoria, nombreCat FROM view_CursosConcat WHERE idCurso = sp_idCurso;
    END IF;
END //
DELIMITER ;