<script>

</script>
<?php if ($_SESSION['rol'] == "PASANTE") {
?>
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

    <?php
} elseif ($_SESSION['rol'] == "ADMINISTRADOR") {

    // var_dump($_GET['views']);
    // echo "<br>";
    // echo $_REQUEST['views'];
    $ruta = explode("/", $_GET["views"]);
    if (isset($ruta[1])) {
        $id = $ruta[1];
        require_once './controller/asistencia.controlador.php';
        $asistencia = new AsistenciaControlador();

    ?>
        <div class="card">
            <div class="card-content">
                <div class="container mW alignCenter content">
                    <h1 class="title has-text-success">Registros</h1>
                    <p>Historial de dias asistidos de <strong><?php echo $asistencia->CtrGetNombrePasante($id) ?></strong> asta la fecha:</p>
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
                            <?php
                            echo $asistencia->CtrMostrarAsistenciaPasanteAdmin();
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal" id="edit_hora">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="modal-card">

                    <!-- <input id="appt-time" type="time" name="appt-time" step="2"> -->
                    <form id="guardar_edicion" novalidate>


                        <header class="modal-card-head">
                            <p class="modal-card-title"><strong>Editar asistencia</strong> </p>
                            <!-- <button class="delete modal-close" aria-label="close"></button> -->
                        </header>

                        <section class="modal-card-body">

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora de ingreso:</label>
                                </div>
                                <div class="column">
                                    <input id="h_entrada_u" style="width: 60%; height:29px;" type="time" name="h_entrada_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2"></span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora inicio del almuerzo:</label>
                                </div>
                                <div class="column">
                                    <input id="h_almuerzo_start_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_start_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2">11:12:12</span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora fin del almuerzo:</label>
                                </div>
                                <div class="column">
                                    <input id="h_almuerzo_end_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_end_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2">11:12:12</span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora salida:</label>
                                </div>
                                <div class="column">
                                    <input id="h_salida_u" style="width: 60%; height:29px;" type="time" name="h_salida_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2">11:12:12</span>
                                </div>
                            </div>

                            <input id="asiId" type="hidden" name="asiId_u">
                        </section>

                        <footer class="modal-card-foot">
                            <button type="submit" class="button is-success">Guardar</button>
                            <!-- <button class="button">Cancelar</button> -->
                        </footer>

                    </form>


                </div>
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>

        <script type="module">
            import BulmaModal from '../src/js/BulmaModal.js'

            // document.querySelector(".modal").addEventListener("modal:show", (event) => {
            //   console.log(event)
            // });
            const modals = document.querySelectorAll("[data-toggle='modal']");
            modals.forEach((modal) => new BulmaModal(modal));
        </script>

        <script>
            var tot = $('.total_horas').val()
            $('.total_horas_show').text(tot)
        </script>
        

        <br>
        <br>
        <br>
    <?php
    } else {
    ?>


        <div class="card">
            <div class="card-content">
                <div class="container mW alignCenter content">
                    <h1 class="title has-text-success">Registros</h1>
                    <p>Historial de dias asistidos de todos los pasantes asta la fecha:</p>
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
                            <!-- <div class="column">
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
                        </div> -->


                        </div>




                        <div class="table-container">
                            <?php
                            require_once './controller/asistencia.controlador.php';
                            $asistencia = new AsistenciaControlador();
                            echo $asistencia->CtrMostrarAsistenciaPasanteTotal();
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <script>
            var table = $('#totalAsistencia').removeAttr('width').DataTable({
                // scrollY: "300px",
                // columnDefs: [{
                //     width: 6200,
                //     targets: 0
                // }],
                "language": {
                    "url": "./src/es_es.json"
                },
                "order": [
                    [
                        1, "desc"
                    ]
                ],
                searching: false,
                pagin: false,
                "pagingType": "simple",
                lengthChange: false,
                // responsive: true,
                scrollCollapse: true,
                scroller: true,
                // deferRender: true,
                fixedColumns: true,
            });
        </script>
        <br>
        <br>
        <br>
    <?php
    }
    ?>
    <script>
        $(document).on('click', '.verRegistro', function() {
            var id = $(this).attr('id');
            // window.location.href = id;
            console.log(id);
            window.location.href = "registro/" + id;




        })
        $(document).on('click', '.eliminarRegistro', function() {
            var id = $(this).attr('id');
            // window.location.href = id;
            console.log(id);
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Barrarás el registro de este usuario, ¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: '¡No, cancelar!',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                        method: "POST",
                        data: 'id=' + id + '&borrar_registro=true',
                        success: function(data) {
                            console.log(data);
                            if (data == 'ok') {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro ha sido eliminado.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })

                            } else if (data == 'error') {
                                Swal.fire(
                                    '¡Error!',
                                    'Ha ocurrido un error.',
                                    'error'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }

                        }
                    });
                }
            });

        })

        var tot = $('.total_horas').val()
        $('.total_horas_show').text(tot)
    </script>
<?php
}
?>