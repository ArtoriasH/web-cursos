DELIMITER //
CREATE FUNCTION Function_getFirstLevel()
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE courseLevel INT;
    SET price = (SELECT precio FROM Cursos WHERE idCurso = fCurso);
    SET courseAmount = (SELECT COUNT(idNivel) FROM niveles WHERE curso = fCurso GROUP BY curso);
    SET levelPrice = price/courseAmount;
	RETURN (levelPrice);
END //
DELIMITER ;