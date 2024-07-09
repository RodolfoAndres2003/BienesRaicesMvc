<?php
define('FUNCIONES_URL', __DIR__ . "funciones.php");
define('TEMPLATES_URL', __DIR__ . "/templates");
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(){
    session_start();

    if(!$_SESSION['login']) {
        header('Location: ../admin/index.php');
    } 

}
function debugear($variable){
    echo '<pre>';
    var_dump($variable);
    echo'</pre>';
    exit;
}

// Escapa el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
    //htmlspecialchars: es la funcion que se utiliza para escapar al html cualquier codigo malicioso
}
//Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    
    return in_array($tipo, $tipos);
}
// Muestra los mensajes
function mostrarNotificacion($codigo){
    $mensaje= '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
        break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
        break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
        break;
        default:
            $mensaje = false;
        break;
    }
    
    return $mensaje;
} 
function validarORedireccionar(string $url){
    // Verificar el id
    $id =  $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: ${url}");
    }
    return $id;
}