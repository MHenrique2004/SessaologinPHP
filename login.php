<?php
    // Inicia a sessão do PHP
    session_start();

    // Conecta ao banco de dados
    $servidor = "localhost"; // nome do servidor MySQL
    $usuario_bd = "root"; // nome do usuário do banco de dados
    $senha_bd = ""; // senha do banco de dados
    $nome_bd = "lpcs_db"; // nome do banco de dados
    $conexao = mysqli_connect($servidor, $usuario_bd, $senha_bd, $nome_bd);

    // Verifica se houve erro na conexão
    if (!$conexao) {
        die("Erro de conexão: " . mysqli_connect_error());
    }

    // Verifica se o usuário já está logado
    if (isset($_SESSION["usuario"])) {
        // Redireciona o usuário para a página protegida
        header("Location: resrtrito.php");
    }

    // Verifica se o formulário de login foi submetido
if (isset($_POST["usuario"]) && isset($_POST["senha"])) {

    // Define a consulta SQL para buscar as informações do usuário
    $consulta = "SELECT * FROM usuarios WHERE nome = '$usuario' AND senha = '$senha'";

    // Executa a consulta SQL
    $resultado = mysqli_query($conexao, $consulta);

    // Verifica se a consulta retornou um resultado
    if (mysqli_num_rows($resultado) == 1) {
        // Define o nome do usuário na sessão
        $_SESSION["usuario"] = $usuario;

        // Redireciona o usuário para a página protegida
        header("Location: resrtrito.php");
    } else {
        // Exibe uma mensagem de erro
        $mensagem_erro = "Usuário ou senha incorretos";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Tela de Login</title>
</head>
<body>
    <h1>Tela de Login</h1>
    <?php if (isset($mensagem_erro)) { ?>
        <p><?php echo $mensagem_erro; ?></p>
    <?php } ?>
    <form method="post" action="">
        <p>
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" id="usuario">
        </p>
        <p>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
        </p>
        <p>
            <input type="submit" name="submit" value="Entrar">
        </p>
    </form>
</body>
</html>
