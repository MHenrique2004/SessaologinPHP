<?php
    // Define as informações de conexão com o banco de dados
    require_once("conn.php");

    // Cria uma conexão com o banco de dados
    

    // Verifica se a conexão com o banco de dados foi bem sucedida
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }
    function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém as informações do usuário a partir do formulário
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];
        $email = $_POST["email"];

        // Atualiza as informações do usuário no banco de dados
        $sql = "UPDATE usuarios SET nome='$nome', senha='$senha', email='$email' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário atualizado com sucesso";
            Redirect('http://localhost/lista_usuarios.php', false);
        } else {
            echo "Erro ao atualizar usuário: " . $conn->error;
        }
    }

    // Obtém o ID do usuário a ser editado a partir do parâmetro "id" na URL
    $id = $_GET["id"];

    // Busca as informações do usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $result = $conn->query($sql);

    // Verifica se o usuário foi encontrado
    if ($result->num_rows > 0) {
        // Obtém os dados do usuário
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $senha = $row["senha"];
        $email = $row["email"];

        // Exibe o formulário de edição de usuário
        echo '<html>
                <head>
                    <title>Editar Usuário</title>
                </head>
                <body>
                    <h1>Editar Usuário</h1>
                    <form method="post" action="">
                        Nome : <input type="text" name="nome" value="' . $nome . '"> <br>
                        Senha : <input type="text" name="senha" value="' . $senha . '"> <br>
                        Email : <input type="text" name="email" value="' . $email . '"> <br>
                        ID = ' . $id . ' <input type="hidden" name="id" value="' . $id . '"> <br>
                        <input type="submit" name="submit" value="Salvar">
                    </form>
                </body>
            </html>';
    } else {
        echo "Usuário não encontrado";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
?>