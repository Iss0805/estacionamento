<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET,POST');
header('Access-Control-Allow-Headers:Content-Type');
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json');
require 'Repository.php';

if (isset($_POST['email']) || isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM tbl_usuario WHERE email = :email AND senha = :senha";
        $stmt = $conec->prepare($sql_code);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();

        $quantidade = $stmt->rowCount();

        if ($quantidade == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: pagina.php");
            exit();
        } else {
            echo "Falha ao logar: E-mail ou senha incorretos";
        }
    }
}
?>

<h1>LOGIN</h1>

<form method="post" action="login.php">
    <label>Email: <input type="email" name="email" required/></label><br>
    <label>Senha: <input type="password" name="senha" required/></label><br>
    <input type="submit" value="Entrar"/>
</form>

