DELIMITER //
CREATE FUNCTION Function_getRate(sumaValoracion int, cantidad int)
RETURNS FLOAT
DETERMINISTIC
BEGIN
    DECLARE rate float;    
    SET rate = (sumaValoracion / cantidad);
	RETURN (rate);
END //
DELIMITER ;