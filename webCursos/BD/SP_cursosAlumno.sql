DROP PROCEDURE IF EXISTS SP_cursosAlumno
DELIMITER //
CREATE PROCEDURE SP_cursosAlumno(
	IN accion			TINYINT,
    IN sp_idUser		INT,
    IN sp_idCat			INT,
    IN sp_from			DATE,
	IN sp_to			DATE
    )
BEGIN
	IF accion = 0 THEN /*Consulta cursos comprados por el alumno*/
		SELECT idCurso, nombreCurso, comprador, venta, estadoCompleto, imagen, precioOriginal, 
        fechaCompleto, ultimaFechaI, nivel, fechaAdquirido, nombreNiv, diploma, nombreI
        FROM view_cursosAlumno	
        WHERE comprador = sp_idUser;
	ELSEIF accion = 1 THEN /*Cursos comprados y completos*/
		SELECT idCurso, nombreCurso, comprador, venta, estadoCompleto, imagen, precioOriginal, 
        fechaCompleto, ultimaFechaI, nivel, fechaAdquirido, nombreNiv, diploma, nombreI
        FROM view_cursosAlumno	
        WHERE comprador = sp_idUser AND estadoCompleto = 1;
	ELSEIF accion = 2 THEN /*Consulta cursos comprados por el alumno por fecha*/
		SELECT idCurso, nombreCurso, comprador, venta, estadoCompleto, imagen, precioOriginal, 
        fechaCompleto, ultimaFechaI, nivel, fechaAdquirido, nombreNiv, diploma, nombreI
        FROM view_cursosAlumno	
        WHERE comprador = sp_idUser AND fechaAdquirido BETWEEN sp_from AND sp_to;
	ELSEIF accion = 3 THEN /*Consulta cursos comprados por el alumno por categoria*/
		SELECT c.idCurso, c.nombreCurso, c.imagen, p.nivel, n.nombreNiv, u.idUser, u.nombre, p.venta, 
		v.fechaAdquirido, v.estadoCompleto, v.precioOriginal, p.ultimaFechaI, v.fechaCompleto, v.diploma, ca.nombreCat, ui.nombre AS nombreI
		FROM progreso p
		JOIN ventas v ON v.idCompra = p.venta
		JOIN usuarios u ON u.idUser = v.comprador
		JOIN cursos c ON c.idCurso = p.curso
		JOIN niveles n ON n.idNivel = p.nivel
		JOIN CursosConcat cc ON cc.curso = c.idCurso
		JOIN categorias ca ON ca.idCategoria = cc.categoria
        JOIN usuarios ui ON ui.idUser = c.instructor
        WHERE u.idUser = sp_idUser AND idCategoria = sp_idCat;
	ELSEIF accion = 4 THEN /*Cursos activos*/
		SELECT idCurso, nombreCurso, comprador, venta, estadoCompleto, imagen, precioOriginal, 
        fechaCompleto, ultimaFechaI, nivel, fechaAdquirido, nombreNiv, diploma, nombreI
        FROM view_cursosAlumno	
        WHERE comprador = sp_idUser AND estadoCurso = 1;
    END IF;
END //
DELIMITER ;