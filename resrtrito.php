<?php
    // Inicia a sessão do PHP
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION["usuario"])) {
        // Redireciona o usuário para a tela de login
        header("Location: tela_login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Protegida</title>
</head>
<body>
    <h1>Página Protegida</h1>
    <p>Olá, <?php echo $_SESSION["usuario"]; ?>!</p>
    <p>Esta é uma página protegida que só pode ser acessada se você estiver logado.</p>
    <form method="post" action="logout.php">
        <p>
            <input type="submit" name="submit" value="Logout">
        </p>
    </form>
</body>
</html>
