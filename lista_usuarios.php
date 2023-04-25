<?php require_once("conn.php");

echo "<h1>Lista de Usuários</h1>";

$sql = "SELECT * FROM Usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // exibir registros
  while($row = $result->fetch_assoc()) {
    echo "<a href='edit_usuario.php/?id=".$row["id"]."'>";
    echo "Nome: " . $row["nome"]. " Email: " . $row["email"]. 
     "</a>";
    echo " --- <a href='delete_usuario.php/?id=".$row["id"]."'>Remover Usuário</a>";
    echo "<br>"
    
    ;
  }
} else {
  echo "0 results";
}
$conn->close();