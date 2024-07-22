DELIMITER //
CREATE FUNCTION Function_getCourseFromLevel(fidNivel INT)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE idCourse INT;
    SET idCourse = (SELECT curso FROM niveles WHERE idNivel = fidNivel LIMIT 1);
	RETURN (idCourse);
END //
DELIMITER ;