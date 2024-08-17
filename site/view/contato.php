<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/contato.css">
    <title>Contato</title>
</head>
<body>
    <header>
        <h1>Contato</h1>
    </header>

    <div class="form-container">
        <form action="../php/processar_contato.php" method="POST">
            <label for="nome">Nome Completo:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="mensagem">Mensagem:</label><br>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea><br><br>

            <div class="button-container">
                <input type="button" value="Voltar" onclick="window.location.href='index.php'">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</body>
</html>
