<?php
require 'repository.php';

$nome =filter_input(INPUT_POST, 'nome');
$email =filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
$senha =filter_input(INPUT_POST, 'senha',FILTER_VALIDATE_INT);

if($nome && $email && $senha){

    $sql = $conec->prepare("SELECT * FROM tbl_usuario WHERE email = :email");
    $sql->bindValue(':email',$email);
    $sql->execute();

    if($sql->rowCount() === 0){

    

    $sql = $conec->prepare('INSERT INTO tbl_usuario(nome,email,senha) VALUES (:nome,:email,:senha)');
    $sql->bindValue(':nome',$nome);
    $sql->bindValue(':email',$email);
    $sql->bindValue(':senha',$senha);

    $sql->execute();

    echo "Usuario cadastrado com sucesso";
    
    header("Location:index.php");
        exit;
    }else{
        
        header("Location: index.php");
    };



}else {
    header("Location: insertUser.php");
    exit;


};
?>