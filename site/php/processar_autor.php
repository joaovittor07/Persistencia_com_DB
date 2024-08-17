<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];

    // Verificar se o nome já existe no banco de dados
    $check_stmt = $conn->prepare("SELECT id FROM autores WHERE nome = ?");
    $check_stmt->bind_param("s", $nome);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Se o nome já existir, exibir uma mensagem de erro
        echo "Erro: O nome do autor já existe.";
    } else {
        // Preparar a consulta SQL para inserir o novo autor
        $stmt = $conn->prepare("INSERT INTO autores (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);

        if ($stmt->execute()) {
            // Redireciona para o index com uma mensagem de sucesso
            header("location: ../view/index.php?success=autor");
            exit();
        } else {
            // Exibe o erro se a inserção falhar
            echo "Erro ao inserir autor: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
