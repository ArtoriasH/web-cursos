DROP FUNCTION IF EXISTS Function_getLevelPrice;
DELIMITER //
CREATE FUNCTION Function_getLevelPrice(fCurso int)
RETURNS FLOAT
DETERMINISTIC
BEGIN
    DECLARE price float;
    DECLARE levelPrice float;
    DECLARE levelAmount int;
    SET price = (SELECT precio FROM Cursos WHERE idCurso = fCurso);
    SET levelAmount = (SELECT COUNT(idNivel) FROM niveles WHERE curso = fCurso AND gratuito = 0 GROUP BY curso);
    SET levelPrice = price/levelAmount;
	RETURN (levelPrice);
END //
DELIMITER ;