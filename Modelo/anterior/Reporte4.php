<?php
    require('../Vista/Plantilla3.php');
    include("../Config/conexion.php");
    $sql = "SELECT * from producto";
    $resultado = mysqli_query($conexion, $sql);
    //crear objeto
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetMargins(10,10,10);
    $pdf->SetAutoPageBreak(true,20);

    $pdf->SetX(15);
    $pdf->SetFont('Helvetica','B',8);
    $pdf->Cell(10, 8, 'ID_PRODUC','B',0, 'C',0);
    $pdf->Cell(35, 8, 'ID_PRO','B',0, 'C',0);
    $pdf->Cell(35, 8, 'Nombre','B',0, 'C',0);
    $pdf->Cell(35, 8, 'Tipo','B',0, 'C',0);
    $pdf->Cell(35, 8, 'Cantidad','B',0, 'C',0);
    $pdf->Cell(35, 8, 'Precio Mayorista','B',1, 'C',0);

    
    $pdf->SetFillColor(233, 229, 235);//color de fondo rgb
    $pdf->SetDrawColor(61, 61, 61);//color de linea  rgb
    //mostrar datos
    while($mostrar = mysqli_fetch_array($resultado)){
        
        $pdf->Ln(0.6);
        $pdf->setX(15);    

        $pdf->Cell(10, 8, $mostrar['ID_PRODUC'], 1, 0, 'C');
        $pdf->Cell(35, 8, $mostrar['ID_PRO'], 1, 0, 'C');
        $pdf->Cell(35, 8, $mostrar['nombre'], 1, 0, 'C');
        $pdf->Cell(35, 8, $mostrar['tipo'], 1, 0, 'C');
        $pdf->Cell(35, 8, $mostrar['cantidad'], 1, 0, 'C');
        $pdf->Cell(35, 8, $mostrar['pMayor'], 1, 1, 'C');
    }
    $pdf->Output('I', 'productos_Mayoristas.pdf');
?>




