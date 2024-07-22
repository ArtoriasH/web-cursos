DROP PROCEDURE IF EXISTS SP_LOGIN
DELIMITER //
CREATE PROCEDURE SP_LOGIN(
	IN accion			TINYINT,
	IN sp_idUser  		INT,
	IN sp_email 		VARCHAR(30),
    IN sp_contra 		VARCHAR(20)
    )
BEGIN
	IF accion = 0 THEN /*Verificar si la cuenta con el email existe (o está activa)*/
		SELECT contra FROM Usuarios WHERE email = sp_email AND estado = 1;
    ELSEIF accion = 1 THEN /*Traer el email cuando la contraseña fue correcta*/
		SELECT email FROM Usuarios WHERE email = sp_email AND contra = sp_contra;
	ELSEIF accion = 2 THEN /*Traer el email cuando la contraseña fue correcta*/
		SELECT idUser, rol, nombre FROM Usuarios WHERE email = sp_email;
    END IF;
END //
DELIMITER ;