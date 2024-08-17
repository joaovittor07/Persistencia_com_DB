<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Verificar se o contato com o mesmo nome e email já existe no banco de dados
    $check_stmt = $conn->prepare("SELECT id FROM contatos WHERE nome = ? AND email = ?");
    $check_stmt->bind_param("ss", $nome, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Se o contato já existir, exibir uma mensagem de erro
        header("Location: ../view/index.php?error=contato_existente");
        exit();
    } else {
        // Preparar a consulta SQL para inserir o novo contato
        $stmt = $conn->prepare("INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $mensagem);

        if ($stmt->execute()) {
            // Redireciona para o index com uma mensagem de sucesso
            header("Location: ../view/index.php?success=contato");
            exit();
        } else {
            // Exibe o erro se a inserção falhar
            header("Location: ../view/index.php?error=insercao_falhou");
            exit();
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
