<?php



require 'Repository.php';

$sql = "SELECT * FROM tbl_usuario";
$stmt = $conec->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



    <title>SLSCARS</title>

    <h1>Lista de Usuários</h1>
   
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['nome'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <a href="updateUsers.php?id=<?= $user['id'] ?>">Editar</a>
                <a href="deleteUser.php?id=<?= $user['id'] ?>">Deletar</a>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </table>
    <a href="insertUser.php">Adicionar Usuário</a>
     


