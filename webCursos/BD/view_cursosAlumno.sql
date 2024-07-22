drop view if exists view_cursosAlumno;

create view view_cursosAlumno as 
SELECT c.idCurso, c.nombreCurso, c.imagen, c.estadoCurso, c.fechaCreaCur, c.instructor, c.contenidoP,
		p.nivel, p.venta, p.ultimaFechaI, n.nombreNiv, u.nombre AS nombreA, ui.nombre AS nombreI,
		v.comprador, v.fechaAdquirido, v.estadoCompleto, v.precioOriginal, v.fechaCompleto, v.diploma
FROM progreso p
JOIN ventas v ON v.idCompra = p.venta
JOIN usuarios u ON u.idUser = v.comprador
JOIN cursos c ON c.idCurso = p.curso
JOIN niveles n ON n.idNivel = p.nivel
JOIN usuarios ui ON ui.idUser = c.instructor

/*WHERE p.alumno = 3;

SELECT c.idCurso, c.nombreCurso, c.imagen, u.nombre, 
idCompra, fechaAdquirido, estadoCompleto, precioOriginal,
u.idUser, p.ultimaFechaI, fechaCompleto, p.nivel, n.nombreNiv, diploma
FROM ventas
JOIN usuarios u ON u.idUser = ventas.comprador
JOIN cursos c ON c.idCurso = ventas.curso
JOIN progreso p ON p.venta = ventas.idCompra
JOIN niveles n ON n.idNivel = p.nivel;*/