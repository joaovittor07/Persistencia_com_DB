<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];

    if (!empty($nome)) {
        echo "Nome recebido: " . $nome;
    } else {
        die("Nenhum nome foi recebido.");
    }

    $check_stmt = $conn->prepare("SELECT id FROM categorias WHERE nome = ?");
    $check_stmt->bind_param("s", $nome);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {

        echo "Erro: O nome da categoria já existe.";
    } else {

        $stmt = $conn->prepare("INSERT INTO categorias (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);

        if ($stmt->execute()) {

            header("Location: ../view/index.php?success=categoria");
            exit();
        } else {

            echo "Erro ao executar a query: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
