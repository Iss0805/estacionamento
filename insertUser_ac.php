<?php
require 'Repository.php';

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if ($nome && $email && $senha) {
    $sql = $conec->prepare("SELECT * FROM tbl_usuario WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();

    if ($sql->rowCount() === 0) {
        $sql = $conec->prepare('INSERT INTO tbl_usuario (nome, email, senha) VALUES (:nome, :email, :senha)');
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);

        if ($sql->execute()) {
            header("Location: index.php");
            exit;
        } else {
            header("Location: insertUser.php");
            exit;
        }
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: insertUser.php");
    exit;
}
?>
