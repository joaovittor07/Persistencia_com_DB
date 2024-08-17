<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $autor_id = $_POST['autor'];
    $categoria_id = $_POST['categoria'];

    $autor_check = $conn->prepare("SELECT id FROM autores WHERE id = ?");
    $autor_check->bind_param("i", $autor_id);
    $autor_check->execute();
    $autor_check->store_result();

    if ($autor_check->num_rows == 0) {
        die("Autor não encontrado.");
    }
    $categoria_check = $conn->prepare("SELECT id FROM categorias WHERE id = ?");
    $categoria_check->bind_param("i", $categoria_id);
    $categoria_check->execute();
    $categoria_check->store_result();

    if ($categoria_check->num_rows == 0) {
        die("Categoria não encontrada.");
    }

    $sql = "INSERT INTO livros (nome, autor_id, categoria_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nome, $autor_id, $categoria_id);

    if ($stmt->execute()) {
        header("location: ../view/index.php??success=livro");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
