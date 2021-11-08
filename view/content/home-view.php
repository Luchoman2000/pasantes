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


<div class="card">
  <div class="card-content">
    <div class="container mW alignCenter content">
      <h1 class="title has-text-success">Bienvenido</h1>
      <h1 class="subtitle"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h1>
      <h1 class="subtitle"><?php echo $_SESSION['rol']; ?></h1>
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