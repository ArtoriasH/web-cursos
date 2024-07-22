drop function if exists function_existingProgress;

DELIMITER //
CREATE FUNCTION function_existingProgress(fAlumno INT, fCurso INT)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE existingProgress INT;
    SET existingProgress = (SELECT idProgreso FROM progreso WHERE alumno = fAlumno AND curso = fCurso);
	RETURN (existingProgress);
END //
DELIMITER ;