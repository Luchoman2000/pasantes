let SERVERURL = document.location.origin;
let TRIES = 0;
let RAMDOMMSGS = [
    "Nooo...",
    "Nope...",
    "Nop...",
    "Que haces?...",
    "No puedo...",
    "Y asi todo el día...",
    "Bla bla bla...",
    "Bloqueo de cuenta en proceso...",
    "Tampoco :/",
    "Creo que ya lo has intentado...",
    "Ya olvíste tu contraseña... o el usuario...",
    "No es juego...",
    "Seguirás intentándolo?",
    "Piensa otra vez...",
    "Reportado..."
]
var newStyle = document.createElement('style');
newStyle.appendChild(document.createTextNode("\
@font-face {\
    font-family: Source Sans Pro;\
    font-style: normal;\
    font-weight: 200;\
    src: url('" + SERVERURL + "/pasantes/src/fonts/SourceSansPro-Light.ttf') format('trueType');\
}\
"));

document.head.appendChild(newStyle);

$(document).on('submit', '#loguear', function (e) {
    e.preventDefault();
    var msg = "Usuario o contraseña incorrectos";
    var usuario = $('input[name=usuario]').val();
    var clave = $('input[name=clave]').val();

    if (usuario.length == 0 || clave.length == 0) {
        const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer)
                toast.addEventListener("mouseleave", Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: "error",
            title: "¿Llenaste todos los campos?"
        })

        return false;
    }

    $.ajax({
        url: SERVERURL + "/pasantes/ajax/login.ajax.php",
        type: "POST",
        data: {
            usuario: usuario,
            clave: clave
        },
        success: function (respuesta) {
            // console.log(respuesta);
            if (respuesta == "ok") {
                if (TRIES >= 2) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "bottom-end",
                        showConfirmButton: false,
                        timer: 1350,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer)
                            toast.addEventListener("mouseleave", Swal.resumeTimer)
                        },
                        willClose: () => {
                            TRIES = 0;

                            window.location.href = "home";
                        }
                    })

                    Toast.fire({
                        icon: "success",
                        title: "¡Bienvenido!... Alfin..."
                    })
                } else {
                    TRIES = 0;

                    window.location.href = "home";

                }
            } else if (respuesta == "error_credenciales") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                        $('input[name=clave]').val("");
                        TRIES++;
                    },
                })

                Toast.fire({
                    icon: "error",
                    title: TRIES >= 2 ? RAMDOMMSGS[Math.floor(Math.random() * RAMDOMMSGS.length)] : msg
                })
            } else if (respuesta == 'campos_vacios') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: "error",
                    title: "¿Llenaste todos los campos?"
                })
            } else if (respuesta == 'usuario_inactivo') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: "error",
                    title: "Usuario inactivo"
                })
            } else if (respuesta == 'sesion_iniciada_ok') {
                swal.fire({
                    title: "Atención",
                    text: "Nueva sesión iniciada, solo puedes iniciar una sesión por dispositivo",
                    icon: "info",
                    confirmButtonText: "Usar aquí",
                    confirmButtonColor: "#00a8ff",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: "#d33",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "home";
                    }
                })
            } else {
                console.log(respuesta);
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: "error",
                    title: "Error desconocido"
                })
            }
        }
    });
});