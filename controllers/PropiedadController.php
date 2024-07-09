<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    class PropiedadController{
        public static function index(Router $router){
            $propiedades = Propiedad::all();

            $vendedores = Vendedor::all();
            // Validar la URL 
            $resultado = $_GET['mensaje'] ?? null;



            $router->render('/admin', [
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores
            ]);
        }
        public static function crear(Router $router){
            $propiedad = new Propiedad;
            $vendedores = Vendedor::all();
            //arreglo con mensaje de errores
            $errores = Propiedad::getErrores();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                /* Crea una nueva Instancia */
                $propiedad = new Propiedad($_POST['propiedad']);
                
            
                /* Subida De Archivos*/ 
              
                //Genera un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                
                //Setear la imagen
                //Realiza un resize a la imagen con intervention
                if($_FILES['propiedad']['tmp_name']['imagen']){
                  $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);  
                }
                
                //Validar
                $errores = $propiedad->validar();
            
            
                if (empty($errores)) {
                    // Almacenar la imagen
                    if ($_FILES['propiedad']['tmp_name']['imagen']){
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
                    $resultado = $propiedad->guardar();
                    if($resultado){
                        header('Location: /admin');
                    }
                }
                
            
            }
            $router->render('/crear', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }
        public static function actualizar(Router $router){
            $id = validarORedireccionar('/propiedades');

            // Obtener los datos de la propiedad
            $propiedad = Propiedad::find($id);

            // Consultar para obtener los vendedores
            $vendedores = Vendedor::all();

            // Arreglo con mensajes de errores
            $errores = Propiedad::getErrores();

            // Metodo Post para actualizar
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                //Asignar los atributos
                $args = $_POST['propiedad'];
            
                $propiedad->sincronizar($args);
                
                //Validacion
                $errores= $propiedad->validar();
            
                // Subida de archivos
                //Genera un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);  
                }
            
                if (empty($errores)) {
                    // Almacenar la imagen
                    if ($_FILES['propiedad']['tmp_name']['imagen']){
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
                    $resultado = $propiedad->guardar();
                    if($resultado){
                        header('Location: /admin');
                    }
                }
                
            }

                $router->render('/actualizar', [
                    'propiedad' => $propiedad,
                    'vendedores' => $vendedores,
                    'errores' => $errores
                ]);
        } 
        public static function eliminar() {

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $tipo = $_POST['tipo'];
    
                // peticiones validas
                if(validarTipoContenido($tipo) ) {
                    // Leer el id
                    $id = $_POST['id'];
                    $id = filter_var($id, FILTER_VALIDATE_INT);
        
                    // encontrar y eliminar la propiedad
                    $propiedad = Propiedad::find($id);
                    $resultado = $propiedad->eliminar();
    
                    // Redireccionar
                    if($resultado) {
                        header('location: /admin');
                    }
                }
            } 
        }
        

    }