<?php 

    if(!isset($_SESSION)){
    session_start();
    }
    $auth = $_SESSION['login'] ?? false;
    if(!isset($inicio)){
        $inicio = false;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $nombrePagina ?? 'Bienes Raices'; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/" class="logo">
                    <img src="../build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <a href="#navegacion">
                        <img src="../build/img/barras.svg" alt="Icono Menu">
                    </a>
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="../build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth):?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php endif; ?>
                        <?php if(!$auth):?>
                            <a href="/login">Iniciar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php if($inicio){ ?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div> <!-- contenedor -->
    </header>
    <?php
    echo $contenido;
    ?>
    <footer class="site-footer">
   
<div class="contenedor contenedor-footer">
        <nav class="navegacion">
            <a href="/nosotros">Nosotros</a>
            <a href="/propiedades">Anuncios</a>
            <a href="/blog">Blog</a>
            <a href="/contacto">Contacto</a>
            
        </nav>
        <p class="copyright">Todos los Derechos Reservados <?php echo date('Y'); ?> &copy; </p>
    </div>
</footer>

<script src="../build/js/bundle.min.js"></script>
</body>

</html>