<div class="card">
    <div class="card-content">
        <div class="container mW alignCenter content">
            <h1 class="title has-text-success">Registros</h1>
            <p>Historial de dias asistidos asta la fecha:</p>
        </div>
    </div>
</div>


<br>
<br>

<div class="container">


    <div class="card">
        <div class="card-content">
            <div class="content">
                <div class="columns is-vcentered is-mobile">
                    <div class="column">
                        <span class=" ml-3 has-text-info">Total Horas: <span class="total_horas_show title is-6">a</span></span>
                    </div>
                    <div class="column">
                        <div class="buttons is-right mr-3">
                            <button class="button is-small">
                                <span class="icon">
                                    <i class="fa fa-external-link" aria-hidden="true"></i>
                                </span>
                                <span>Exportar</span>
                            </button>
                        </div>
                    </div>


                </div>




                <div class="table-container">
                    <!-- <table id="example" class="table stripe row-border order-column" style="width:100%; box-sizing: inherit;">

                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Ingreso</th>
                        <th>Almuerzo inicio</th>
                        <th>Almuerzo fin</th>
                        <th>Salida</th>
                        <th>Horas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>10/10/2021</td>
                        <td>07:40 <samp class="has-text-success">+0:20</samp></td>
                        <td>12:00</td>
                        <td>12:30</td>
                        <td>16:30 <samp class="has-text-success">+1:23</samp></td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>11/10/2021</td>
                        <td>07:40 <samp class="has-text-success">+0:20</samp></td>
                        <td>12:00</td>
                        <td>12:30</td>
                        <td>16:30 <samp class="has-text-success">+1:23</samp></td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>12/10/2021</td>
                        <td>07:40 <samp class="has-text-success">+0:20</samp></td>
                        <td>12:00</td>
                        <td>12:30</td>
                        <td>16:30 <samp class="has-text-success">+1:23</samp></td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>13/10/2021</td>
                        <td>07:40 <samp class="has-text-success">+0:20</samp></td>
                        <td>12:00</td>
                        <td>12:30</td>
                        <td>16:30 <samp class="has-text-success">+1:23</samp></td>
                        <td>6</td>
                    </tr>
            </table> -->

                    <?php
                    require_once './controller/asistencia.controlador.php';
                    $asistencia = new AsistenciaControlador();
                    echo $asistencia->CtrMostrarAsistenciaPasante();
                    ?>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    var tot = $('.total_horas').val()
    $('.total_horas_show').text(tot)
</script>

<br>
<br>
<br>