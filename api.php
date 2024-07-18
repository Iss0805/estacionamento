<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET,POST');
header('Access-Control-Allow-Headers:Content-Type');
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json');
require 'Repository.php';


try {
    $conec = new PDO('mysql:host=localhost;dbname=bd_slscars', 'root', '');
    $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to connect to the database: ' . $e->getMessage()]);
    exit;
}

$path = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : [];


if (empty($path)) {
    $sql = "SELECT * FROM tbl_usuario";
    $stmt = $conec->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($usuarios);
} else {
    if ($path[0] === 'usuario' && isset($path[1])) {
        $id = intval($path[1]);
        $sql = "SELECT * FROM tbl_usuario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            echo json_encode($usuario);
        } else {
            echo json_encode(['error' => 'Usuário não encontrado']);
        }
    } else {
        echo json_encode(['error' => 'Endpoint não encontrado']);
    }
}
    
    

?>
