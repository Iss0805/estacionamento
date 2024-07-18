<?php



require 'Repository.php';

$sql = "SELECT * FROM carros";
$stmt = $conec->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



    <title>SLSCARS</title>

    <h1>Lista de Carros</h1>
   
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Cliente</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['placa'] ?></td>
            <td><?= $user['modelo'] ?></td>
            <td><?= $user['nome_cliente'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['telefone'] ?></td>
            
            
            
            <td>
                <a href="updateUsers.php?id=<?= $user['id'] ?>">Editar</a>
                <a href="deleteUser.php?id=<?= $user['id'] ?>">Deletar</a>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </table>
    <a href="insertC.php">Adicionar Carros</a>
     


