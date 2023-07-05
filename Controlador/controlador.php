<?php
$v = $_GET['var'];
if ($v == 1)
    include("../Vista/crearUsuario.php");
else {
    if ($v == 2)
        include("../Vista/panel.php");
    else
        if ($v == 3)
            include("../Vista/Buscar.php");
        else
            if ($v == 4)
                include("../Vista/MostrarE.php");
            else
                if ($v == 5)
                    include("../Modelo/Reporte1.php");
                else
                    echo "no selecciona nada";

}

?>