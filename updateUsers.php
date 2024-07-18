<?php
require 'Repository.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

        if (!empty($nome) && !empty($email) && !empty($senha))  {  
            $sql = "UPDATE tbl_usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id";  // Adicionei `senha`
            $stmt = $conec->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        header("Location: index.php");
        exit;
    } else {
        $sql = "SELECT * FROM tbl_usuario WHERE id = :id";
        $stmt = $conec->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: index.php");
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>


    <title>Editar Usuário</title>

    <h1>Editar Usuário</h1>
    <form method="POST">
        <label>Nome: <input type="text" name="nome" value="<?= isset($user['nome']) ? $user['nome'] : ''; ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?= isset($user['email']) ? $user['email'] : ''; ?>" required></label><br>
        <label>Senha: <input type="password" name="senha" value="<?= isset($user['senha']) ? $user['senha'] : ''; ?>" required></label><br> <!-- Corrigi o tipo de campo -->
        <button type="submit">Atualizar</button>
    </form>
    <a href="index.php">Voltar</a>

