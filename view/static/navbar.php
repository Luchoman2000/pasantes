<?php
if ($_SESSION['rol'] == 'PASANTE') {
?>
    <!--Responsive navigation starts inside header-->
    <header class="nav-header">
        <div class="container">
            <nav id="navigation">
                <div id="navigationBox">
                    <div class="call">
                        <a href="registro" title="Registros">
                            <i class="fa fa-calendar"></i>
                            <span>Registros</span>
                        </a>
                    </div>
                    <div class="nav-trigger">
                        Menu
                    </div>
                    <div class="email">
                        <a href="home" title="Perfil">
                            <i class="fa fa-home"></i>
                            <span>Home</span>
                        </a>
                    </div>
                </div>
                <ul class="menu">
                    <li><a href="home" title="Home">
                            <span class="icon">
                                <i class="fa fa-home"></i>
                            </span>
                            Home</a>
                    </li>
                    <li><a href="registro" title="Registros">
                            <span class="icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            Registros</a>
                    </li>
                    <li><a href="perfil" title="Perfil">
                            <span class="icon">
                                <i class="fa fa-user"></i>
                            </span>
                            Perfil</a>
                    </li>
                    <li><a onclick="logout()" title="Salir">
                            <span class="icon">
                                <i class="fa fa-sign-out"></i>
                            </span>
                            Salir</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
<?php
} elseif ($_SESSION['rol'] == 'ADMINISTRADOR') {
?>
    <!--Responsive navigation starts inside header-->
    <header class="nav-header">
        <div class="container">
            <!-- <a id="logo" href="index.html">
          <h1>Logo</h1>
        </a> -->
            <!--Where the magic happens-->
            <nav id="navigation">

                <?php
                $ruta = explode("/", $_GET["views"]);
                if (isset($ruta[1])) {
                ?>
                    <div id="navigationBox">
                        <div class="call">
                            <a href="../registro" title="Registros">
                                <i class="fa fa-calendar"></i>
                                <span>Registros</span>
                            </a>
                        </div>
                        <div class="nav-trigger">
                            Menu
                        </div>
                        <div class="email">
                            <a href="../home" title="Perfil">
                                <i class="fa fa-home"></i>
                                <span>Home</span>
                            </a>
                        </div>
                    </div>
                    <ul class="menu">
                        <li><a href="../home" title="Home">
                                <span class="icon">
                                    <i class="fa fa-home"></i>
                                </span>
                                Home</a>
                        </li>
                        <li><a href="../registro" title="Registros">
                                <span class="icon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                Registros</a>
                        </li>
                        <li><a href="../perfil" title="Perfil">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                Perfil</a>
                        </li>
                        <li><a href="../admin" title="Admin">
                                <span class="icon">
                                    <i class="fa fa-cog"></i>
                                </span>
                                Admin</a>
                            </a></li>
                        <li><a onclick="logout('../logout')" title="Salir">
                                <span class="icon">
                                    <i class="fa fa-sign-out"></i>
                                </span>
                                Salir</a>
                        </li>
                    </ul>
                <?php
                } else {
                ?>
                    <div id="navigationBox">
                        <div class="call">
                            <a href="registro" title="Registros">
                                <i class="fa fa-calendar"></i>
                                <span>Registros</span>
                            </a>
                        </div>
                        <div class="nav-trigger">
                            Menu
                        </div>
                        <div class="email">
                            <a href="home" title="Perfil">
                                <i class="fa fa-home"></i>
                                <span>Home</span>
                            </a>
                        </div>
                    </div>
                    <ul class="menu">
                        <li><a href="home" title="Home">
                                <span class="icon">
                                    <i class="fa fa-home"></i>
                                </span>
                                Home</a>
                        </li>
                        <li><a href="registro" title="Registros">
                                <span class="icon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                Registros</a>
                        </li>
                        <li><a href="perfil" title="Perfil">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                Perfil</a>
                        </li>
                        <li><a href="admin" title="Admin">
                                <span class="icon">
                                    <i class="fa fa-cog"></i>
                                </span>
                                Admin</a>
                            </a></li>
                        <li><a onclick="logout()" title="Salir">
                                <span class="icon">
                                    <i class="fa fa-sign-out"></i>
                                </span>
                                Salir</a>
                        </li>
                    </ul>
                <?php
                }
                ?>


            </nav>
        </div>
    </header>
<?php
}
?>

<script>
    // Para cerrar sesion
    function logout(l = 'logout') {
        $('.nav-trigger').click();
        Swal.fire({
            title: '¿Desea cerrar sesión?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cerrar sesión',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = l;
            }
        })
    }
</script>