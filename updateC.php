<?php
require 'Repository.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $placa= isset($_POST['placa']) ? $_POST['placa'] : '';
        $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
        $cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';

        if (!empty($placa) && !empty($modelo) && !empty($cliente) && !empty($email) && !empty($telefone))  {  
            $sql = "UPDATE carros SET placa = :placa, modelo = :modelo, cliente = :cliente,email = :email,telefone = :telefone  WHERE id = :id"; 
            $stmt = $conec->prepare($sql);
            $stmt->bindValue(':placa', $placa);
            $stmt->bindValue(':modelo', $modelo);
            $stmt->bindValue(':cliente', $cliente);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':telefone', $telefone);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        header("Location: listaC.php");
        exit;
    } else {
        $sql = "SELECT * FROM carros WHERE id = :id";
        $stmt = $conec->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: listaC.php");
            exit;
        }
    }
} else {
    header("Location: listaC.php");
    exit;
}
?>


    <title>Editar Usuário</title>

    <h1>Editar Usuário</h1>
    <form method="POST">
        <label>Placa: <input type="text" name="placa" value="<?= isset($user['placa']) ? $user['placa'] : ''; ?>" required></label><br>
        <label>Modelo: <input type="text" name="modelo" value="<?= isset($user['modelo']) ? $user['modelo'] : ''; ?>" required></label><br>
        <label>Nome do Cliente: <input type="text" name="cliente" value="<?= isset($user['cliente']) ? $user['cliente'] : ''; ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?= isset($user['email']) ? $user['email'] : ''; ?>" required></label><br>
        <label>Telefone: <input type="text" name="telefone" value="<?= isset($user['telefone']) ? $user['telefone'] : ''; ?>" required></label><br> 
        <button type="submit">Atualizar</button>
    </form>
    <a href="index.php">Voltar</a>
