<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            
            <div class="contHang">
                <h1>HANGING GAME</h1>
                <canvas id="pantalla" width="960px" height="450px"> <!-- etiqueta del canvas con sus medidas en la pantalla -->
                    Tu navegador no soporta Canvas.
                </canvas>
                <!-- El boton que nos sirve para recargar la pagina y asi generar una nueva palabra y volver a jugar -->
                <button id="hangButn" type="reset" onclick="javascript:window.location.reload();">Volver a Jugar</button>
                <button id="hangButn2" type="reset" onclick="reproducirAudio()" hidden>Audio</button>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->