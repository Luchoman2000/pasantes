<?php
if ($_SESSION['rol'] == 'PASANTE') {
?>
    <!--Responsive navigation starts inside header-->
    <header class="nav-header">
        <div class="container">
            <!-- <a id="logo" href="index.html">
          <h1>Logo</h1>
        </a> -->
            <!--Where the magic happens-->
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
                    <li><a href="home" title="Home">🏠 Home</a></li>
                    <li><a href="registro" title="Registros">📝 Registros</a></li>
                    <li><a href="perfil" title="Perfil">🙍‍♂️ Perfil</a></li>
                    <!-- <li><a href="#" title="Blog">Blog</a></li> -->
                    <li><a href="logout" title="Salir">❌Salir</a></li>
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
                        <li><a href="../home" title="Home">🏠 Home</a></li>
                        <li><a href="../registro" title="Registros">📝 Registros</a></li>
                        <li><a href="../admin" title="Administrador">⚙ Admin</a></li>
                        <li><a href="../perfil" title="Perfil">🙍‍♂️ Perfil</a></li>
                        <li><a href="../logout" title="Salir">❌Salir</a></li>
                        <!-- <li><a href="#" title="Blog">Blog</a></li> -->
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
                        <li><a href="home" title="Home">🏠 Home</a></li>
                        <li><a href="registro" title="Registros">📝 Registros</a></li>
                        <li><a href="admin" title="Administrador">⚙ Admin</a></li>
                        <li><a href="perfil" title="Perfil">🙍‍♂️ Perfil</a></li>
                        <li><a href="logout" title="Salir">❌Salir</a></li>
                        <!-- <li><a href="#" title="Blog">Blog</a></li> -->
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