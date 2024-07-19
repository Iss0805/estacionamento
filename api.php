<?php
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require 'Repository.php';

try {
    $conec = new PDO('mysql:host=localhost;dbname=bd_slscars', 'root', '');
    $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    response(['error' => 'Failed to connect to the database'], 500);
    exit;
}


function response($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

$path = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : [];

if (empty($path)) {
    try {
        $sql = "SELECT * FROM tbl_usuario";
        $stmt = $conec->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        response($usuarios);
    } catch (PDOException $e) {
        response(['error' => 'Failed to retrieve users'], 500);
    }
} else {
    if ($path[0] === 'usuario' && isset($path[1])) {
        $id = intval($path[1]);
        if ($id > 0) {
            try {
                $sql = "SELECT * FROM tbl_usuario WHERE id = :id";
                $stmt = $conec->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuario) {
                    response($usuario);
                } else {
                    response(['error' => 'Usuário não encontrado'], 404);
                }
            } catch (PDOException $e) {
                response(['error' => 'Failed to retrieve user'], 500);
            }
        } else {
            response(['error' => 'Invalid user ID'], 400);
        }
    } else {
        response(['error' => 'Endpoint não encontrado'], 404);
    }
}
?>
