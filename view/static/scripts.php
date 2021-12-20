<script src="<?php echo SERVERURL ?>src/js/sw.all.min.js"></script>
<!-- <script src="<?php echo SERVERURL ?>src/js/moment.js"></script> -->
<script src="<?php echo SERVERURL ?>src/js/moment-with-locales.js"></script>
<script src="<?php echo SERVERURL ?>src/js/modal-fx.js"></script>
<script src="<?php echo SERVERURL ?>index.js" type="module"></script>

<?php

if ($_SESSION['rol'] == "ADMINISTRADOR") {
?>

    <script>
        let msgshow = false;
        if (localStorage.getItem('msgshow') === null) {
            localStorage.setItem('msgshow', msgshow);
        }
        $(document).ready(function() {
            if ($(window).width() <= 550 && localStorage.getItem('msgshow') == 'false') {

                Swal.fire({
                    title: '¡Atención!',
                    text: 'Para una mejor experiencia en el menú, por favor utilice una pantalla de mayor tamaño.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                msgshow = true;
                localStorage.setItem('msgshow', msgshow);
            }

        });
    </script>

<?php
}

?>