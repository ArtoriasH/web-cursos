drop view if exists view_mostRecent;

create view view_mostRecent as 
SELECT idCurso, nombreCurso, descripcionCur, contenidoP, imagen, precio, usuarios.nombre, fechaCreaCur
FROM cursos
JOIN usuarios ON usuarios.idUser = cursos.instructor
WHERE estadoCurso = 1
ORDER BY fechaCreaCur DESC LIMIT 5;