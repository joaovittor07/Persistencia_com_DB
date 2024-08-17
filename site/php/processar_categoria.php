<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];

    if (!empty($nome)) {
        echo "Nome recebido: " . $nome;
    } else {
        die("Nenhum nome foi recebido.");
    }

    // Verificar se o nome já existe no banco de dados
    $check_stmt = $conn->prepare("SELECT id FROM categorias WHERE nome = ?");
    $check_stmt->bind_param("s", $nome);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Se o nome já existir, exibir uma mensagem de erro
        echo "Erro: O nome da categoria já existe.";
    } else {
        // Preparar a consulta SQL para inserir a nova categoria
        $stmt = $conn->prepare("INSERT INTO categorias (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);

        if ($stmt->execute()) {
            // Redireciona para o index com uma mensagem de sucesso
            header("Location: ../view/index.php?success=categoria");
            exit();
        } else {
            // Exibe o erro se a inserção falhar
            echo "Erro ao executar a query: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
