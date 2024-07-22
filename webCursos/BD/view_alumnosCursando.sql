drop view if exists view_alumnosCursando;

create view view_alumnosCursando as 
SELECT p.curso, p.nivel, alumno, c.nombreCurso, c.contenidoP, u.nombre, v.fechaAdquirido,
 v.precioOriginal, v.metodoPago, n.nombreNiv, v.diploma, v.estadoCompleto, venta
        FROM progreso p
        JOIN cursos c ON c.idCurso = p.curso
        JOIN usuarios u ON u.idUser = alumno
        JOIN ventas v ON v.idCompra = venta
        JOIN niveles n ON n.idNivel = p.nivel;
        
        