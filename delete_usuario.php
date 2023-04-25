<?php
    // Define as informações de conexão com o banco de dados
   require_once("conn.php");
    // Cria uma conexão com o banco de dados
    
    function Redirect($url, $permanent = false)
    {
        if (headers_sent() === false)
        {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }
    
        exit();
    }
    // Verifica se o ID do usuário a ser deletado foi passado como parâmetro na URL
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Deleta o usuário do banco de dados
        $sql = "DELETE FROM usuarios WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário deletado com sucesso";
            Redirect('http://localhost/lista_usuarios.php', false);
        } else {
            echo "Erro ao deletar usuário: " . $conn->error;
        }
    } else {
        echo "ID do usuário não foi informado";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
?>
