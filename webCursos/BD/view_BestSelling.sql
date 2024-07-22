drop view if exists view_BestSelling;

create view view_BestSelling as 
SELECT cursos.idCurso, cursos.nombreCurso, cursos.imagen, cursos.precio, 
COUNT(curso) AS cantidadVendido
FROM ventas
JOIN cursos ON cursos.idCurso = ventas.curso
WHERE estadoCurso = 1
GROUP BY curso;