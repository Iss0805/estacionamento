<?php
include("protect.php");
?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Seja Bem-Vindo à Página Inicial, <?php echo $_SESSION['nome']; ?>!</h1>
    <p>
        <a href="login.php">SAIR</a>
    </p>
</body>
</html>
