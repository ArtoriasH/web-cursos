drop view if exists view_rating;

create view view_rating as 
SELECT c.idCurso, c.nombreCurso, c.descripcionCur, c.contenidoP, c.imagen, c.precio,
Function_getRate(SUM(valoracion), COUNT(curso)) as rate
FROM valoraciones
JOIN cursos c ON c.idCurso = valoraciones.curso
WHERE estadoCurso = 1
GROUP BY curso LIMIT 6;