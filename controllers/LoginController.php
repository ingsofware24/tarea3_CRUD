<?php

namespace Controllers;

use Exception;
use Model\Permiso;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        isNotAuth();
        $router->render('auth/login', []);
    }
    public static function logout()
    {
        isAuth();
        $_SESSION = [];
        session_destroy();
        header('Location: /login_test/');
    }

    public static function registro(Router $router)
    {
        isAuth();
        hasPermission(['TIENDA_ADMIN']);
        $router->render('auth/registro', [], 'layouts/menu');
    }
    public static function menu(Router $router)
    {
        isAuth();
        hasPermission(['TIENDA_ADMIN', 'TIENDA_USER']);
        $router->render('pages/menu', [], 'layouts/menu');
    }


    public static function registroAPI()
    {
        getHeadersApi();
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        $_POST['usu_catalogo'] = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['usu_password'] = htmlspecialchars($_POST['usu_password']);
        $_POST['usu_password2'] = htmlspecialchars($_POST['usu_password2']);

        if ($_POST['usu_password'] != $_POST['usu_password2']) {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Las constraseñas no coinciden',
                'detalle' => 'Verifique las contraseñas ingresadas',
            ]);
            exit;
        }

        try {
            $_POST['usu_password'] = password_hash($_POST['usu_password'], PASSWORD_DEFAULT);
            $usuario = new Usuario($_POST);
            if ($usuario->validarUsuarioExistente()) {
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Ya existe un usuario registrado con este catalogo',
                    'detalle' => 'Verifique la información',
                ]);
                exit;
            }

            $usuario->crear();
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Usuario creado exitosamente',

            ]);
            exit;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al generar usuario',
                'detalle' => $e->getMessage(),
            ]);
            exit;
        }
    }

    public static function loginAPI()
    {
        getHeadersApi();
        $_POST['usu_catalogo'] = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['usu_password'] = htmlspecialchars($_POST['usu_password']);
        try {
            $usuario = new Usuario($_POST);
            //VALIDA QUE EXISTE EL USUARIO
            if ($usuario->validarUsuarioExistente()) {
                $usuarioBD = $usuario->getUsuarioExistente();
                //VALIDA QUE LA CONTRASEÑA ESTE CORRECTA
                if (password_verify($_POST['usu_password'], $usuarioBD['usu_password'])) {
                    session_start();
                    $_SESSION['user'] = $usuarioBD;

                    // OBTIENE TODOS LOS PERMISOS DEL USUARIO
                    $permisos = Permiso::fetchArray("SELECT * FROM permiso inner join rol on permiso_rol = rol_id where permiso_usuario = " . $usuarioBD['usu_id']);
                    // GENERA UNA VARIABLE DE SESION POR CADA PERMISO 
                    foreach ($permisos as $permiso) {
                        $_SESSION[$permiso['rol_nombre_ct']] = 1;
                    }

                    http_response_code(200);
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => 'Bienvenido al sistema, ' . $usuarioBD['usu_nombre'],
                    ]);
                    exit;
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'codigo' => 0,
                        'mensaje' => 'La constraseña no coincide',
                        'detalle' => 'Verifique la contraseña ingresada',
                    ]);
                    exit;
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El usuario no existe',
                    'detalle' => 'No existe un usuario registrado con el catalogo proporcionado',
                ]);
                exit;
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al generar usuario',
                'detalle' => $e->getMessage(),
            ]);
            exit;
        }
    }
}
