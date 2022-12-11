
<?php
include "fpdf/fpdf.php";
include "../php/database.php";


session_start(); 

$pdf = new FPDF($orientation='P',$unit='mm', array(45,120));

$pdf->setTitle("Ticket ".$_SESSION["user"]);
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

$off = $textypos+6;
$producto = ($_GET['nombre']);  
$producto = unserialize($producto);

$price = ($_GET['precio']);  
$price = unserialize($price);
$val=count($price);
$cant = ($_GET['cant']);  
$cant = unserialize($cant);
//var_dump($producto);
$subtotal=0;
for ($i=0; $i < $val; $i++) { 
    
    $pdf->setX(2);
    $pdf->Cell(5,$off,$cant[$i]);
    
    $pdf->setX(6);
    $pdf->Cell(35,$off,  strtoupper(substr($producto[$i], 0,13)) );
    
    $pdf->setX(20);
    $pdf->Cell(11,$off,  "$".number_format($price[$i],2,".",",") ,0,0,"R");
    $pdf->setX(32);
    $pdf->Cell(11,$off,  "$ ".number_format($price[$i]*$cant[$i],2,".",",") ,0,0,"R");
    $off+=6;
    $subtotal += $price[$i]*$cant[$i];
}

/*
foreach($productos as $pro){
$pdf->setX(2);
$pdf->Cell(5,$off,$pro["cant"]);
$pdf->setX(6);
$pdf->Cell(35,$off,  strtoupper(substr($pro["tituloTr"], 0,13)) );
$pdf->setX(20);
$pdf->Cell(11,$off,  "$".number_format($pro["precio"],2,".",",") ,0,0,"R");
$pdf->setX(32);
$pdf->Cell(11,$off,  "$ ".number_format($pro["cant"]*$pro["precio"],2,".",",") ,0,0,"R");

$subtotal += $pro["cant"]*$pro["precio"];
$off+=6;
}*/
$textypos=$off+6;

$pdf->setX(2);
$pdf->Cell(5,$textypos,"SUBTOTAL: " );
$pdf->setX(38);
$pdf->Cell(5,$textypos,"$ ".number_format($subtotal,2,".",","),0,0,"R");
$pdf->setX(2);
$pdf->Cell(5,$textypos+6,"TOTAL: " );
$pdf->setX(38);
$total=$subtotal*1.16;
$pdf->Cell(5,$textypos+6,"$ ".number_format($total,2,".",","),0,0,"R");
$pdf->setX(10);
$pdf->Cell(5,$textypos+12,'GRACIAS POR TU COMPRA ');

$pdf->output();

$records=$connect->prepare("SELECT juego,cant from carro WHERE user=:user");
                     $records->bindParam(":user",$_SESSION['user']);      
                     $records->execute();
                     $productos = $records->fetchAll();

foreach($productos as $pro){
    echo $pro["juego"];
    echo $pro["cant"];
    $data = [
        'cant' => $pro["cant"],
        'id' => $pro["juego"],
    ];
    $sql = "UPDATE juegos SET disponibles=(disponibles - :cant) WHERE id=:id";
    $stmt= $connect->prepare($sql);
    $stmt->execute($data);
}
$records=$connect->prepare("DELETE from carro WHERE user=:user");
$records->bindParam(":user",$_SESSION['user']);      
                     $records->execute();
?>