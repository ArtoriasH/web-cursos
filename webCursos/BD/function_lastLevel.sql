drop function if exists function_lastLevel;

DELIMITER //
CREATE FUNCTION function_lastLevel(fCurso INT)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE lastLevel INT;
    SET lastLevel = (SELECT LAST_VALUE(idNivel) OVER(PARTITION BY curso) 
    FROM Niveles WHERE curso = fCurso LIMIT 1);
	RETURN (lastLevel);
END //
DELIMITER ;