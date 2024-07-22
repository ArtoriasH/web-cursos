DROP PROCEDURE IF EXISTS SP_search
DELIMITER //
CREATE PROCEDURE SP_search(
	IN accion				TINYINT,
    IN sp_kWord   			VARCHAR(50),
    IN sp_from				DATE,
	IN sp_to				DATE
    )
BEGIN
	IF accion = 0 THEN /*Busqueda de cursos por nombre / nombre i / categoria*/
		SELECT idCurso, nombreCurso, imagen
        FROM view_Search
		WHERE nombreCurso LIKE CONCAT('%', sp_kWord, '%') OR nombre LIKE CONCAT('%', sp_kWord, '%') OR nombreCat LIKE CONCAT('%', sp_kWord, '%');	
    ELSEIF accion = 1 THEN /*busqueda con filtro de fecha dada de alta*/
        SELECT idCurso, nombreCurso, imagen 
        FROM view_Search
        WHERE (nombreCurso LIKE CONCAT('%', sp_kWord, '%') OR nombre LIKE CONCAT('%', sp_kWord, '%') OR nombreCat LIKE CONCAT('%', sp_kWord, '%'))
        AND fechaCreaCur BETWEEN sp_from AND sp_to;    
    END IF;
END //
DELIMITER ;