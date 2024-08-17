<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];

    $check_stmt = $conn->prepare("SELECT id FROM autores WHERE nome = ?");
    $check_stmt->bind_param("s", $nome);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {

        echo "Erro: O nome do autor já existe.";
    } else {

        $stmt = $conn->prepare("INSERT INTO autores (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);

        if ($stmt->execute()) {

            header("location: ../view/index.php?success=autor");
            exit();
        } else {

            echo "Erro ao inserir autor: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
