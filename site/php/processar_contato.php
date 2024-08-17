<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $check_stmt = $conn->prepare("SELECT id FROM contatos WHERE nome = ? AND email = ?");
    $check_stmt->bind_param("ss", $nome, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {

        header("Location: ../view/index.php?error=contato_existente");
        exit();
    } else {

        $stmt = $conn->prepare("INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $mensagem);

        if ($stmt->execute()) {

            header("Location: ../view/index.php?success=contato");
            exit();
        } else {

            header("Location: ../view/index.php?error=insercao_falhou");
            exit();
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
