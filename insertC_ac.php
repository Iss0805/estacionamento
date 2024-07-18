<?php
require 'Repository.php';

$placa =filter_input(INPUT_POST, 'placa',);
$modelo=filter_input(INPUT_POST, 'modelo',);
$cliente =filter_input(INPUT_POST, 'cliente',);
$email =filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
$telefone=filter_input(INPUT_POST, 'telefone',FILTER_VALIDATE_INT);

if($placa && $modelo && $cliente && $email && $telefone){

    $sql = $conec->prepare("SELECT * FROM carros WHERE email = :email");
    $sql->bindValue(':email',$email);
    $sql->execute();

    if($sql->rowCount() === 0){

    

    $sql = $conec->prepare('INSERT INTO carros(placa,modelo,cliente,email,telefone) VALUES (:placa,:modelo,:cliente,:email,:telefone)');
    $sql->bindValue(':placa',$placa);
    $sql->bindValue(':modelo',$modelo);
    $sql->bindValue(':cliente',$cliente);
    $sql->bindValue(':email',$email);
    $sql->bindValue(':telefone',$telefone);

    $sql->execute();

    echo "Carro cadastrado com sucesso";
    
    header("Location:insertC.php");
        exit;
    }else{
        
        header("Location: insertC.php");
    };



}else {
    header("Location: insertC.php");
    exit;

};

?>.