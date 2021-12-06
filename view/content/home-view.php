<!-- <div class="container" styles="">
  <section class="section">
    <div class="container">
      <h1 class="title">
        Bienvenido
      </h1>
      <p class="subtitle">
        My first website with <strong>asdasd</strong>!
      </p>
    </div>
  </section>


</div>
<footer class="nav-phone">
  <div class="container">
    <div class="content has-text-centered">
      <p>
      <div class="phone">
        <input type="radio" name="s" id="s1">
        <input type="radio" name="s" id="s2" checked="checked">
        <input type="radio" name="s" id="s3">
        <label class="l" for="s1"><img src="http://co0kie.github.io/codepen/mobile-nav/facebook.svg" alt=""></label>
        <label class="l" for="s2"><img src="http://co0kie.github.io/codepen/mobile-nav/twitter.svg" alt=""></label>
        <label class="l" for="s3"><img src="http://co0kie.github.io/codepen/mobile-nav/instagram.svg" alt=""></label>
        <div class="circle"></div>
        <div class="circle2"></div>
        <div class="phone_content">
          <div class="phone_bottom">
            <span class="indicator"></span>
          </div>
        </div>
      </div>
      </p>
    </div>
  </div>
</footer> -->

<?php
if ($_SESSION['rol'] == 'PASANTE') {
?>
  <div class="card">
    <div class="card-content">
      <div class="container mW alignCenter content">
        <h1 class="title has-text-success">Bienvenido</h1>
        <h1 class="subtitle"><?php $n = strtolower($_SESSION['nombre'] . " " . $_SESSION['apellido']); echo ucwords($n); ?></h1>
        <p>Registra tu asistencia a continuación:</p>
      </div>
    </div>
  </div>

  <br>
  <br>

  <!-- <div class="continer">
  <div class="card">
    <div class="card-content">
      <div class="content">
        <div id="holder">
          <div id="time-holder">
            <div id="display-time"></div>
          </div>
          <div id="date-holder">
            <div id="display-date"></div>
            <div id="display-day"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div> 
  <br>
  <br> -->

  <div class="container">
    <div class="card">
      <div class="card-content">
        <div class="content">
          <div id="marcador" class="list has-visible-pointer-controls">
            <!-- RELOJ -->
            <div id="holder">
              <div id="time-holder">
                <div class="title is-3 has-text-centered has-text-info has-text-shadow" id="display-time"></div>
              </div>
              <div id="date-holder">
                <div class="subtitle is-5 has-text-success has-text-centered" id="display-date"></div>
                <div class="has-text-centered" id="display-day"></div>
              </div>
            </div>
            <br>

            <!-- ASISTENCIA -->
            <!-- <div  class="list-item box">
            <div class="columns is-mobile">
              <div class="column">

                <div class="list-item-content is-small">
                  <div class="list-item-title title is-5">Ingreso</div>
                  <div id="des_m_entrada" class="list-item-description has-text-grey">Sin marcar</div>
                </div>
              </div>
              <div class="column">

                <div class="list-item-controls is-small">
                  <div class="buttons is-right">
                    <button type="submit" id="m_entrada" class="m_entrada button is-success is-light">
                      <span class="icon is-small">
                        <i class="fa fa-edit"></i>
                      </span>
                      <span id="text_m_entrada">Marcar</span>
                    </button>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="almuerzo" style="display: none;" class="almuerzo box">
            <div class="list-item box">
              <div class="columns is-mobile">
                <div class="column">

                  <div class="list-item-content is-small">
                    <div class="list-item-title title is-5">Almuerzo inicio</div>
                    <div id="des_m_almuerzo_inicio" class="list-item-description has-text-grey">Aun no marcado</div>
                  </div>
                </div>
                <div class="column">

                  <div class="list-item-controls is-small">
                    <div class="buttons is-right">
                      <button id="m_almuerzo_inicio" class="button is-success is-light">
                        <span class="icon is-small">
                          <i class="fa fa-edit"></i>
                        </span>
                        <span id="text_m_almuerzo_inicio">Marcar</span>
                      </button>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="list-item box">
              <div class="columns is-mobile">
                <div class="column">

                  <div class="list-item-content is-small">
                    <div class="list-item-title title is-5">Almuerzo fin</div>
                    <div id="des_m_almuerzo_fin" class="list-item-description has-text-grey">Aún no marcado</div>
                  </div>
                </div>
                <div class="column">

                  <div class="list-item-controls is-small">
                    <div class="buttons is-right">
                      <button id="m_almuerzo_fin" class="button is-success is-light">
                        <span class="icon is-small">
                          <i class="fa fa-edit"></i>
                        </span>
                        <span>Marcar</span>
                      </button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="list-item box">
            <div class="columns is-mobile">
              <div class="column">

                <div class="list-item-content is-small">
                  <div class="list-item-title title is-5">Salida</div>
                  <div id="des_m_salida" class="list-item-description has-text-grey">Aún no marcado</div>
                </div>
              </div>
              <div class="column">

                <div class="list-item-controls is-small">
                  <div class="buttons is-right">
                    <button id="m_salida" class="button is-success is-light">
                      <span class="icon is-small">
                        <i class="fa fa-edit"></i>
                      </span>
                      <span>Marcar</span>
                    </button>

                  </div>
                </div>
              </div>
            </div>
          </div> -->

            <?php
            require_once './controller/asistencia.controlador.php';
            $asistencia = new AsistenciaControlador();
            echo $asistencia->CtrMostrarInicioPasante();
            ?>


          </div>
        </div>
      </div>
    </div>
  </div>


  <br>
  <br>





<?php
} elseif ($_SESSION['rol'] == "ADMINISTRADOR") {
?>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-list/css/bulma-list.css"> -->
  <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma-list.css">
  <div class="card">
    <div class="card-content">
      <div class="container mW alignCenter content">
        <h1 class="title has-text-success">Bienvenido</h1>
        <!-- <h1 class="subtitle"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h1>
        <h1 class="subtitle"><?php echo $_SESSION['rol']; ?></h1>
        <p>Registra tu asistencia a continuación:</p> -->

      </div>
    </div>
  </div>
  <br>
  <br>


  <div class="container">
    <div class="card">
      <div class="card-content">
        <div class="content">
          <div id="holder">
            <div id="time-holder">
              <div class="title is-3 has-text-centered has-text-info has-text-shadow" id="display-time"></div>
            </div>
            <div id="date-holder">
              <div class="subtitle is-5 has-text-success has-text-centered" id="display-date"></div>
              <div class="has-text-centered" id="display-day"></div>
            </div>
          </div>
          <br>
          <!-- Boton-->
          <div class="columns is-mobile">
            <div class="column">
              <div class="field has-addons">
                <div class="control">
                  <button id="nuevo_registros" class="button is-success modal-button" data-target="nuevo_registro" data-toggle="modal">
                    <span class="icon is-small">
                      <i class="fa fa-plus"></i>
                    </span>
                    <span>Nueva asistencia</span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="notification">
            <button class="delete"></button>
            <strong>Orden:</strong>
            <div class="tag is-rounded is-info ">Entrada</div>
            <div class="tag is-rounded is-info ">Inicio almuerzo</div>
            <div class="tag is-rounded is-info ">Fin Almuerzo</div>
            <div class="tag is-rounded is-info ">Salida</div>
            <br>
            <br>
            <strong>Colores:</strong>
            <div class="tag is-rounded is-success">Puntual</div>
            <div class="tag is-rounded is-warning">Atrazado</div>
            <div class="tag is-rounded is-danger is-light">Sin marcar</div>
          </div> -->

          <div class="box" id="contacts">
            <h1 class="title is-4 mb-2 has-text-info-dark">Asistencias de hoy</h1>


            <div class="list">



              <!-- <div class="list-item">
                <div class="list-item-content">
                  <div class="list-item-title is-size-3 mb-1">Luis Estacio</div>
                  <div class="list-item-description">
                    <div class="tag is-info is-medium">19:19</div>
                    <div class="tag is-info is-medium">20:19</div>
                    <div class="tag is-info is-medium">19:19</div>
                    <div class="tag is-info is-medium">19:19</div>
                  </div>
                </div>

                <div class="list-item-controls">
                  <div class="buttons">

                    <button class="button is-dark is-inverted">
                      <span class="icon">
                        <i class="fa fa-pencil"></i>
                      </span>
                    </button>

                    <button class="button is-dark is-inverted">
                      <span class="icon">
                        <i class="fa fa-trash"></i>
                      </span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="list-item">

                <div class="list-item-content">
                  <div class="list-item-title is-size-3 mb-1">Alfredo Schafer</div>
                  <div class="list-item-description">
                    <div class="tag is-success is-medium">10:10</div>
                    <div class="tag is-info is-medium">10:10</div>
                    <div class="tag is-link is-medium">10:10</div>
                    <div class="tag is-warning is-medium">10:10</div>

                  </div>
                </div>

                <div class="list-item-controls">
                  <div class="buttons">

                    <button class="button is-dark is-inverted">
                      <span class="icon">
                        <i class="fa fa-pencil"></i>
                      </span>
                    </button>

                    <button class="button is-dark is-inverted">
                      <span class="icon">
                        <i class="fa fa-trash"></i>
                      </span>
                    </button>
                  </div>
                </div>
              </div> -->
              <!-- <div class="title is-4 mb-2 has-text-warning-dark">
              Nadie ha marcado su asistencia aún 😪
              </div> -->
              <?php
              require_once './controller/asistencia.controlador.php';
              $asistencia = new AsistenciaControlador();
              echo $asistencia->CtrMostrarInicioAdmin();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <button class="button is-dark is-inverted modal-button" data-toggle="modal" >Open modal</button> -->

  <div class="modal modal-fx-fadeInScale" id="edit_hora">
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


  <div class="modal modal-fx-fadeInScale" id="nuevo_registro">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="modal-card">

        <header class="modal-card-head">
          <p class="modal-card-title"><strong>Nuevo registro</strong> </p>
        </header>
        <!-- Tabla de pasantes -->
        <section class="modal-card-body">


          <div class="table-container" style="overflow-x: hidden;">


            <!-- <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle;">ESTACIO SABANDO LUIS ANGEL</td>
                  <td>
                    <button class="button is-success is-outlined is-small">
                      <span class="icon is-small">
                        <i class="fa fa-plus"></i>
                      </span>
                      <span>MARCAR</span>
                    </button>
                  </td>
                </tr>
              </tbody> -->

            <?php
            require_once './controller/asistencia.controlador.php';
            $asistencia = new AsistenciaControlador();
            echo  $asistencia->CtrMostrarPasantesSinRegistro();
            ?>
            </table>

          </div>
        </section>
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
  </div>






  <br>
  <br>
  <script>
    var table = $('#pasantes').DataTable({
      // scrollY: "300px",

      "language": {
        "url": "./src/es_es.json"
      },
      // // "order": [
      // //   [
      // //     0, "desc"
      // //   ]
      // // ],
      // order: false,
      searching: true,
      pagin: true,
      autoWidth: false,
      "pagingType": "simple",
      lengthChange: false,
      responsive: false,
      // // scrollCollapse: true,
      // scroller: false,
      // scrollY: false,
      // scrollX: false,

      columnDefs: [{
        width: 1000,
        targets: 0
      }],
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
        const $notification = $delete.parentNode;

        $delete.addEventListener('click', () => {
          $notification.parentNode.removeChild($notification);
        });
      });
    });
  </script>
  <script>
    $(document).on('click', '.verRegistro', function() {
      var id = $(this).attr('id');
      // window.location.href = id;
      console.log(id);
      window.location.href = "registro/" + id;
    })
  </script>
  <!-- <script type="module">
    import BulmaModal from './src/js/BulmaModal.js'

    // document.querySelector(".modal").addEventListener("modal:show", (event) => {
    //   console.log(event)
    // });
    const modals = document.querySelectorAll("[data-toggle='modal']");
    modals.forEach((modal) => new BulmaModal(modal));
  </script> -->
<?php
}
?>

<script>
  // if ($('#des_m_salida').text() != 'Sin marcar') {
  //   Swal.fire({
  //     position: 'top-end',
  //     icon: 'success',
  //     title: '¡Dia Completado! 😃',
  //     showConfirmButton: false,
  //     timer: 1000
  //   })
  // }
  setInterval(function() {
    setTime();
    setDate();
  }, 200);

  function setTime() {
    var disp_time = document.getElementById("display-time");
    let time = new Date();
    let hours = time.getHours();
    let minutes = time.getMinutes();
    let seconds = time.getSeconds();
    let period = "PM";
    if (seconds < 10) {
      seconds = "0" + seconds;
    }
    if (minutes < 10) {
      minutes = "0" + minutes;
    }
    if (hours < 12) {
      period = "AM";
    }
    if (hours == 0) {
      hours = "12";
    }
    if (hours > 12) {
      hours = hours - 12;
    }
    if (hours < 10) {
      hours = "0" + hours;
    }
    disp_time.innerHTML = hours + ":" + minutes + ":" + seconds + " " + period;
  }

  function setDate() {
    var disp_date = document.getElementById("display-date");
    var disp_day = document.getElementById("display-day");
    let time = new Date();
    let date = time.getDate();
    let month = time.getMonth();
    let year = time.getFullYear();
    let day = time.getDay();
    switch (day) {
      case 0:
        day = "Domingo";
        break;
      case 1:
        day = "Lunes";
        break;
      case 2:
        day = "Martes";
        break;
      case 3:
        day = "Miércoles";
        break;
      case 4:
        day = "Jueves";
        break;
      case 5:
        day = "Viernes";
        break;
      case 6:
        day = "Sábado";
        break;
      default:
        day = day;
    }
    if (date < 10) {
      date = "0" + date;
    }
    if (month < 10) {
      month = "0" + month;
    }
    day = day;
    disp_date.innerHTML = date + " / " + month + " / " + year;
    disp_day.innerHTML = day;
  }
</script>