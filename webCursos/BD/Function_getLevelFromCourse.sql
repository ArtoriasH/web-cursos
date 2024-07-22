drop function if exists Function_getFirstLevel;

DELIMITER //
CREATE FUNCTION Function_getFirstLevel(fCurso INT)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE firstLevel INT;
    SET firstLevel = (SELECT FIRST_VALUE(idNivel) OVER(PARTITION BY curso) 
    FROM Niveles WHERE curso = fCurso LIMIT 1);
	RETURN (firstLevel);
END //
DELIMITER ;