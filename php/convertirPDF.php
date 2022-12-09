
<?php
include "fpdf/fpdf.php";
include "../php/database.php";


session_start(); 

$pdf = new FPDF($orientation='P',$unit='mm', array(45,120));

$pdf->setTitle("Ticket ".$_SESSION['user']);
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
$textypos = 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Image("../img/LogoV1Escalado.png",30,-1,10,10,"png","");
$pdf->Cell(5,$textypos,"Game Paradise");
$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 20
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'-------------------------------------------------------------------');
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'CANT.  ARTICULO           PRECIO            TOTAL');

$total =0;
$off = $textypos+6;
$records=$connect->prepare("SELECT carro.juego,juegos.caratula,juegos.tituloTr,juegos.precio,carro.cant from juegos,carro WHERE juegos.id in 
                     (SELECT carro.juego from carro where carro.user=:user)
                     GROUP BY juegos.tituloTr");   
                     $records->bindParam(":user",$_SESSION['user']);      
                     $records->execute();
                     $productos = $records->fetchAll();

foreach($productos as $pro){
$pdf->setX(2);
$pdf->Cell(5,$off,$pro["cant"]);
$pdf->setX(6);
$pdf->Cell(35,$off,  strtoupper(substr($pro["tituloTr"], 0,13)) );
$pdf->setX(20);
$pdf->Cell(11,$off,  "$".number_format($pro["precio"],2,".",",") ,0,0,"R");
$pdf->setX(32);
$pdf->Cell(11,$off,  "$ ".number_format($pro["cant"]*$pro["precio"],2,".",",") ,0,0,"R");

$total += $pro["cant"]*$pro["precio"];
$off+=6;
}
$textypos=$off+6;

$pdf->setX(2);
$pdf->Cell(5,$textypos,"TOTAL: " );
$pdf->setX(38);
$pdf->Cell(5,$textypos,"$ ".number_format($total,2,".",","),0,0,"R");

$pdf->setX(2);
$pdf->Cell(5,$textypos+6,'GRACIAS POR TU COMPRA ');

$pdf->output();

?>