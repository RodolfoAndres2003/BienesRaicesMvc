<?php 

    namespace Controllers;

    use MVC\Router;
    use Model\Propiedad;
    use PHPMailer\PHPMailer\PHPMailer;

    class PaginasController{
        public static function index(Router $router){
            $propiedades = Propiedad::get(3); 
            $router->render('../paginas/index', [
                'propiedades' => $propiedades
            ]);
        }
        public static function nosotros(Router $router){
            $router->render('../paginas/nosotros');
        }
        public static function propiedades(Router $router){
            $propiedades = Propiedad::all();
            $router->render('../paginas/propiedades', [
                'propiedades' => $propiedades
            ]);
        }
        public static function propiedad(Router $router){
            $id = validarORedireccionar('../paginas/propiedades');

            //buscar la propiedad por su id
            $propiedad = Propiedad::find($id);
            $router->render('../paginas/propiedad', [
                'propiedad' => $propiedad
            ]);
        }
        public static function blog(Router $router){
            $router->render('../paginas/blog');
        }
        public static function entrada(Router $router){
            $router->render('../paginas/entrada');
        }
        public static function contacto(Router $router){
            $mensaje = '';
            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                $respuestas = $_POST['contacto'];
                
                //Crear una instancia de phpmailer
                $mail = new PHPMailer();

                //configurar SMTP
                $mail->isSMTP();
                $mail->Host = $_ENV['EMAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['EMAIL_USER'];
                $mail->Password = $_ENV['EMAIL_PASS'];
                $mail->SMTPSecure = 'tls';
                $mail->Port = $_ENV['EMAIL_PORT'];

                //Configurar el contenido del email
                $mail->setFrom('admin@bienesraices.com'); //quien envia el email
                $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');//A que email va a llegar ese correo
                $mail->Subject = 'Tienes un nuevo mensaje'; //el mensaque que va a llegar una vez tengamos el nuevo email
                
                //Habilitar el html
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8'; //Idioma

                //Defini el contenido
                $contenido = '<html>';
                $contenido .= '<p>Tienes un nuevo Mensaje</p>';
                $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';
                
                // Enviar de forma condicional
                if($respuestas['contacto'] === 'telefono'){
                    //eligio ser contactado por telefono
                    $contenido .= '<p>Quiere ser contactado por telefono</p>';
                    $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . ' </p>';
                    $contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha'] . ' </p>';
                    $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
                } else {
                    //eligio ser contactado por email
                    $contenido .= '<p>Quiere ser contactado por email </p>';
                    $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
                }
                
                
                $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
                $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
                $contenido .= '<p>Presupuesto: $' . $respuestas['precio'] . ' </p>';
                $contenido .= ' </html>';


                $mail->Body = $contenido;
                $mail->AltBody = 'Esto es texto alternativo sin html';

                //Enviar el email

                if($mail->send()){
                    $mensaje = "Mensaje enviado correctamente";
                } else {
                    $mensaje = "El mensaje no se pudo enviar";
                }
                
            }
            $router->render('../paginas/contacto', [
                'mensaje'> $mensaje
            ]);
        }
    }