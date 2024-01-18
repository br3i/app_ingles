<?php 

require('../fpdf1/fpdf.php');
date_default_timezone_set('America/Bogota');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->SetFont('Times','B',20);
    $this->Image('../fimg/fimg/triangulo.png',0,0,70); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->setXY(60,15);
    $this->Cell(100,25,'LISTADO DE CLIENTES',0,1,'C',0);
    $this->Image('../fimg/fimg/logo.png',150,10,35); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->Ln(40);
}

// Pie de página
function Footer()
{
        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("Vivero El trebol © Todos los derechos reservados."),0,0,"C");
        
}



}

?>


