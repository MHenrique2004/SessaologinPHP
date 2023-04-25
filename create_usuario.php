<?php 
    require_once('conn.php');

    function createUserDb($conn, $nome, $senha, $email) {
        $nome = mysqli_real_escape_string($conn, $nome);
        $senha = mysqli_real_escape_string($conn,  $senha);
        $email = mysqli_real_escape_string($conn,  $email);
        if($nome && $senha && $email) {
            $sql = "INSERT INTO Usuarios (nome, senha, email) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
                exit('SQL error');
            mysqli_stmt_bind_param($stmt, 'sss', $nome, $senha, $email);
            mysqli_stmt_execute($stmt);
            mysqli_close($conn);
        return true;
        }
    }

    if(isset($_POST['submit'])) {
        $nome = $_POST['nome']; 
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        
        if (createUserDb($conn,$nome,$senha,$email)){
        
        // exibir resultado
           echo "usuario criado com sucesso <br>";
           echo "<a href='formulario.php'>Clique aqui para criar outro</a> " ;
           echo "<a href='lista_usuarios.php'>Clique aqui para ver a lista</a> " ;
        }
    }

  ?>  