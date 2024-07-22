DROP FUNCTION IF EXISTS f_getFirstLevel;
DELIMITER //
CREATE FUNCTION f_getFirstLevel(fCurso int)
RETURNS INT
DETERMINISTIC
BEGIN
    
    DECLARE firstLevel int;
    SET firstLevel = (SELECT idNivel FROM niveles WHERE curso = fCurso LIMIT 1);
	RETURN (firstLevel);
END //
DELIMITER ;