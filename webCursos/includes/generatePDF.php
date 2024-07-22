<?php
    $nombreCurso = '<p>'.$_POST['nombreCurso'].'</p>';
    $nombreUser = '<p>'.$_POST['nombreUser'].'</p>';
    $compDate = '<p>'.$_POST['compDate'].'</p>';
    $nombreInst = '<p>'.$_POST['nombreInst'].'</p>';
    /*require('../PDF/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'El usuario: ' .$nombreUser." Ha pasado el curso: ". $nombreCurso);
    $pdf->Output();*/

    require_once '../dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $html='<div class="container" style="border:double 5px #9f44b8; text-align:center; font-size:25px; background:#dac5e8; height:520px;">';
    $html.='<p>CERTIFICADO DE RECONOCIMIENTO</p>';
    $html.='<p>OTOGADO A:</p>';
    $html.= $nombreUser;
    $html.='<p>POR HABER FINALIZADO EL CURSO:</p>';
    $html.= $nombreCurso;
    $html.='<p>TERMINADO EL:'.$compDate.'</p>';
    $html.='<p>INSTRUCTOR:</p>';
    $html.= $nombreInst;
    $html.='<div style="width: 15%; height: 1%; border-top: solid 1px; margin: 5% 0 3% 0;">';
    $html.='<p style="font-size:25px;margin: 0;">Firma del alumno</p>';
    $html.='</div>';
    $html.='</div>';



    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("diploma.pdf", ["Attachment" => 0]);
?>