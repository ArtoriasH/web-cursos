DROP PROCEDURE IF EXISTS SP_instructorCursos
DELIMITER //
CREATE PROCEDURE SP_instructorCursos(
	IN accion				TINYINT,
    IN sp_idUser   			INT,
    IN sp_idCurso			INT,
    IN sp_idNivel			INT,
    IN sp_from				DATE,
	IN sp_to				DATE,
    IN sp_idCat				INT
    )
BEGIN
	IF accion = 0 THEN /*Seleccionar la cantidad de alumnos en un curso*/
		SELECT idCurso, nombreCurso, COUNT(comprador) AS cantidadAlumnos, contenidoP
		FROM view_cursosAlumno
        WHERE instructor = sp_idUser
		GROUP BY idCurso;
	ELSEIF accion = 1 THEN /*Seleccionar la cantidad de alumnos en un curso - ACTIVOS*/
		SELECT idCurso, nombreCurso, COUNT(comprador) AS cantidadAlumnos, contenidoP
		FROM view_cursosAlumno
        WHERE instructor = sp_idUser AND estadoCurso = 1
		GROUP BY idCurso;
    ELSEIF accion = 2 THEN /*Seleccionar la cantidad de alumnos en un curso - FECHA*/
		SELECT idCurso, nombreCurso, COUNT(comprador) AS cantidadAlumnos, contenidoP
		FROM view_cursosAlumno
        WHERE instructor = sp_idUser AND fechaCreaCur BETWEEN sp_from AND sp_to
		GROUP BY idCurso;
	ELSEIF accion = 4 THEN /*Seleccionar el promedio de gente en un nivel*/
		SELECT nivel, COUNT(curso) AS personasCursando, nombreNiv
        FROM view_alumnosCursando 
        WHERE curso = sp_idCurso
        GROUP BY nivel
        ORDER BY COUNT(curso) DESC LIMIT 1;        
	ELSEIF accion = 5 THEN /*Suma de la ganancia de un curso comprado completo*/
		SELECT curso, SUM(precioOriginal) AS totalCurso
        FROM ventas 
        JOIN cursos ON cursos.idCurso = ventas.curso
        WHERE curso = sp_idCurso
        GROUP BY curso;
	ELSEIF accion = 6 THEN /*Suma de la ganancia de un curso comprado por nivel*/
		SELECT n.idNivel, SUM(v.precioOriginal) AS totalCurso
		FROM niveles n
		JOIN ventas v ON v.nivel = n.idNivel
		WHERE n.curso = sp_idCurso
		GROUP BY n.curso;
	ELSEIF accion = 7 THEN /*Suma de todas las ganancias de todos los cursos*/
		SELECT SUM(precioOriginal) AS total, metodoPago
        FROM ventas 
        JOIN cursos ON cursos.idCurso = ventas.curso
        JOIN usuarios ON usuarios.idUser = cursos.instructor
        WHERE usuarios.idUser = sp_idUser
        GROUP BY metodoPago
        ORDER BY metodoPago;
	ELSEIF accion = 8 THEN /*Suma de todas las ganancias de todos los niveles niveles*/
		SELECT SUM(v.precioOriginal) AS total, v.metodoPago
		FROM niveles n
		JOIN ventas v ON v.nivel = n.idNivel
        JOIN cursos cu ON cu.idCurso = n.curso
        JOIN usuarios u ON u.idUser = cu.instructor
		WHERE u.idUser = sp_idUser
		GROUP BY metodoPago
        ORDER BY metodoPago;
        
	ELSEIF accion = 9 THEN /*Traer todos los alumnos de un curso*/
		SELECT curso, nivel, alumno, nombreCurso, nombre, fechaAdquirido, precioOriginal, contenidoP, 
        metodoPago, diploma, estadoCompleto, venta
        FROM view_alumnosCursando
        WHERE curso = sp_idCurso;
	ELSEIF accion = 10 THEN /*Traer el precio original en el que se compró un nivel*/
		SELECT nivel, nombreNiv, comprador, precioOriginal
        FROM ventas
        JOIN niveles ON niveles.idNivel = nivel
        WHERE comprador = sp_idUser AND nivel = sp_idNivel;
    END IF;
END //
DELIMITER ;