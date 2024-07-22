DROP TRIGGER IF EXISTS trigger_progresoCurso
DELIMITER //
CREATE TRIGGER trigger_progresoCurso AFTER INSERT ON Ventas
	FOR EACH ROW BEGIN
    IF (new.nivel IS NULL) THEN  /* Cuando se compra un curso completo */
		INSERT INTO Progreso(alumno, curso, nivel, venta) 
        VALUES (new.comprador, new.curso, Function_getFirstLevel(new.curso), new.idCompra);  
        
	ELSEIF(new.curso IS NULL) THEN /* Cuando se compra nivel por nivel */
		IF(function_existingProgress(new.comprador, Function_getCourseFromLevel(new.nivel)) IS NULL) THEN
			INSERT INTO Progreso(alumno, nivel, venta, curso) 
			VALUES (new.comprador, new.nivel, new.idCompra, Function_getCourseFromLevel(new.nivel)); 
		END IF;
	END IF;
    END//
DELIMITER ;