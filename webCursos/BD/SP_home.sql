DROP PROCEDURE IF EXISTS SP_home
DELIMITER //
CREATE PROCEDURE sp_home(
	IN accion	TINYINT
    )
    
BEGIN
	IF accion = 0 THEN /* Mostrar los cursos mas recientes*/
    SELECT idCurso, nombreCurso, imagen FROM view_mostRecent LIMIT 5;

	ELSEIF accion = 1 THEN /* Mostrar los cursos mas comprados*/
    SELECT idCurso, nombreCurso, imagen FROM view_BestSelling LIMIT 5;
    
    ELSEIF accion = 2 THEN /* Mostrar los cursos mejor recomendados*/
    SELECT idCurso, nombreCurso, imagen FROM view_rating 
    ORDER BY rate DESC LIMIT 5;

    END IF;
END //
DELIMITER ;