DROP PROCEDURE IF EXISTS SP_adquirirCurso
DELIMITER //
CREATE PROCEDURE sp_adquirirCurso(
	IN accion				TINYINT,
    IN sp_idUser   			INT,
	IN sp_precioOriginal  	FLOAT, 
    IN sp_idCurso 			INT,
    IN sp_idNivel 			INT,
    IN sp_comentario 		TEXT,
    IN sp_valoracion		INT,
    IN sp_idVenta			INT
    )
BEGIN
	IF accion = 0 THEN /*Comprar un curso / nivel*/
		INSERT INTO ventas(comprador, precioOriginal, curso, nivel) 
        VALUES(sp_idUser, sp_precioOriginal, sp_idCurso, sp_idNivel);	
        
	ELSEIF accion = 1 THEN /*Actualizar progreso*/
		UPDATE progreso 
        SET nivel = sp_idNivel, ultimaFechaI = current_timestamp()	
		WHERE alumno = sp_idUser AND curso = sp_idCurso;	
        
	ELSEIF accion = 2 THEN /*Consulta si el curso esta completo*/
		SELECT estadoCompleto FROM ventas 
		WHERE comprador = sp_idUser AND curso = sp_idCurso;
	ELSEIF accion = 12 THEN /*Consulta si el curso comprado nivel por nivel esta completo*/
		SELECT estadoCompleto FROM ventas 
		WHERE comprador = sp_idUser AND nivel = f_getFirstLevel(sp_idCurso);
            
	ELSEIF accion = 3 THEN /*insertar valoracion / comentario*/
		INSERT INTO valoraciones(comentario,valoracion, comentador, curso) 
        VALUES(sp_comentario, sp_valoracion, sp_idUser, sp_idCurso);	
        
	ELSEIF accion = 4 THEN /*Consulta si el curso esta comprado*/
		SELECT idCompra FROM ventas
        WHERE comprador = sp_idUser AND curso = sp_idCurso LIMIT 1;
	ELSEIF accion = 7 THEN /*Consulta si el nivel esta comprado*/
		SELECT idCompra FROM ventas
        WHERE comprador = sp_idUser AND nivel = sp_idNivel LIMIT 1;
        
	ELSEIF accion = 5 THEN /*Consulta los comentarios de un curso*/
		SELECT idValoracion, comentario, valoracion, comentador, fechaValor, curso, u.nombre, u.foto 
        FROM valoraciones
        JOIN usuarios u ON u.idUser = comentador
        WHERE curso = sp_idCurso;
        
	ELSEIF accion = 6 THEN /*Dar diploma*/
		UPDATE ventas SET diploma = 1 WHERE idCompra = sp_idVenta;
        
	ELSEIF accion = 8 THEN /*Consulta la última compra para el metodo de pago*/
		SELECT IdCompra FROM ventas ORDER BY IdCompra DESC LIMIT 1;
	ELSEIF accion = 9 THEN /*update Metodo de pago*/
		UPDATE ventas SET metodoPago = 1 WHERE idCompra = sp_idVenta;
        
	ELSEIF accion = 10 THEN /*Consulta si un usuario ya comento*/
		SELECT idValoracion FROM valoraciones WHERE comentador = sp_idUser AND curso = sp_idCurso;
        
        ELSEIF accion = 11 THEN /*Consulta si un curso/niveles ya esta comprado para comentar*/
		SELECT idProgreso FROM progreso WHERE alumno = sp_idUser AND curso = sp_idCurso;
    END IF;
END //
DELIMITER ;