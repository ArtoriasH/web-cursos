DROP TRIGGER IF EXISTS trigger_cursoCompletado
DELIMITER //
CREATE TRIGGER trigger_cursoCompletado AFTER UPDATE ON progreso
	FOR EACH ROW BEGIN
    IF (new.nivel = function_lastLevel(new.curso)) THEN
		UPDATE ventas
        SET estadoCompleto  = 1, fechaCompleto = current_timestamp()
        WHERE idCompra = new.venta;
	END IF;
END//
DELIMITER ;