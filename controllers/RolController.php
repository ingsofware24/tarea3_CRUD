<?php

namespace Controllers;

use Exception;
use Model\Rol;
use MVC\Router;

class RolController
{
    public static function index(Router $router)
    {

        $router->render('rol/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['rol_nombre'] = htmlspecialchars($_POST['rol_nombre']);
        $_POST['rol_nombre_ct'] = htmlspecialchars($_POST['rol_nombre_ct']);
        $_POST['rol_app'] = htmlspecialchars($_POST['rol_app']);

        try {
            $rol = new Rol($_POST);
            $resultado = $rol->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Rol guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar App',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
     {
         try {
             // ORM - ELOQUENT
             // $productos = Producto::all();
             $roles = Rol::obtenerRolconQuery();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos encontrados',
                 'detalle' => '',
                 'datos' => $roles
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al buscar Roles',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }

     public static function modificarAPI()
     {
         $_POST['rol_nombre'] = htmlspecialchars($_POST['rol_nombre']);
         $_POST['rol_nombre_ct'] = htmlspecialchars($_POST['rol_nombre_ct']);
         $_POST['rol_app'] = htmlspecialchars($_POST['rol_app']);
         $id = filter_var($_POST['rol_id'], FILTER_SANITIZE_NUMBER_INT);
         try {

             $rol = Rol::find($id);
             $rol->sincronizar($_POST);
             $rol->actualizar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Rol modificado exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al modificar Rol',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }

     public static function eliminarAPI()
     {

         $id = filter_var($_POST['rol_id'], FILTER_SANITIZE_NUMBER_INT);
         try {

             $rol = Rol::find($id);
             // $producto->sincronizar([
             //     'situacion' => 0
             // ]);
             // $producto->actualizar();
             $rol->eliminar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Rol eliminada exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al eliminar Rol',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }
}
