drop view if exists view_curso;

create view view_curso as 
SELECT idCurso, nombreCurso, descripcionCur, contenidoP, contenidoAd, imagen, precio, estadoCurso, u.nombre, instructor, 
n.nombreNiv, n.idNivel, n.video, n.gratuito, Function_getLevelPrice(idCurso) as levelPrice 
FROM cursos
JOIN usuarios u ON u.idUser = cursos.instructor
JOIN Niveles n ON n.curso = cursos.idCurso