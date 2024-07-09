<?php 
    namespace Controllers;
    use MVC\Router;
    use Model\Vendedor;

    class VendedorController {
        public static function crear (Router $router) {
            $errores = Vendedor::getErrores();
            $vendedor = new Vendedor;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                //Crear una nueva instancia
                $vendedores = new Vendedor($_POST['vendedor']);
                
                //VALIDAR QUE NO HAYA CAMPOS VACIOS
                $errores = $vendedores->validar();
        
                //No hay errores, entonces guardamos
                if(empty($errores)){
                    $vendedores->guardar();
                }
            }
            $router->render('../vendedores/crear', [
                'errores' => $errores,
                'vendedor' => $vendedor

            ]);
        }
        public static function actualizar (Router $router) {
            $id = validarORedireccionar('/admin');
            $vendedores = Vendedor::find($id);
            //Arreglo con mensaje de errores
            $errores = Vendedor::getErrores();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                //Asignar los valores
                $args = $_POST['vendedor'];
                
                //sincronizar objeto en memoria
                $vendedores->sincronizar($args);
        
                $errores = $vendedores->validar();
        
                if(empty($errores)){
                    $vendedores->guardar();
                }
                //validacion
                
            }

            $router->render('../vendedores/actualizar', [
                'errores' => $errores,
                'vendedores' => $vendedores
            ]);
        }
        public static function eliminar () {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                //validar el id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                if($id){
                    //valida el tipo a eliminar
                    $tipo = $_POST['tipo'];

                    if(validarTipoContenido($tipo)){
                        $vendedores = Vendedor::find($id);
                        $vendedores->eliminar();
                    }
                }
                
            }
        }
    }