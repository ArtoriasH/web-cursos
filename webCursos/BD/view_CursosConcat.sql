drop view if exists view_CursosConcat;

create view view_CursosConcat as 
	SELECT ca.idCategoria, ca.nombreCat, ca.descripcionCat, ca.fechaCrea, cu.idCurso, cu.nombreCurso, cu.imagen
	FROM CursosConcat
	JOIN categorias ca ON ca.idCategoria = CursosConcat.categoria
	JOIN cursos cu ON cu.idCurso = CursosConcat.curso
    WHERE cu.estadoCurso = 1