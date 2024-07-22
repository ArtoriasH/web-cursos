drop view if exists view_Search;

create view view_Search as 
	SELECT idCurso, nombreCurso, imagen, fechaCreaCur, u.nombre, ca.nombreCat
	FROM Cursos
	JOIN usuarios u ON u.idUser = instructor
	JOIN CursosConcat cc ON cc.curso = idCurso
	JOIN categorias ca ON ca.idCategoria = cc.categoria
    WHERE estadoCurso = 1;