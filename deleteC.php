<?php
require 'Repository.php';

$id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

if($id){
    $sql= $conec -> prepare("DELETE FROM carros WHERE id = :id");
    $sql -> bindValue(':id',$id);
    $sql -> execute();
  
}

header('Location: listaC.php');




?>