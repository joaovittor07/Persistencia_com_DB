<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Cadastrar Categoria</title>
</head>
<body>
    <header>
        <h1>Cadastrar Categoria</h1>
    </header>

    <div class="form-container">
        <form action="../php/processar_categoria.php" method="POST">
            <label for="nome">Categoria:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>
        
            <div class="button-container">
                <input type="button" value="Voltar" onclick="window.history.back();">
                <input type="submit" value="Cadastrar">
            </div>
        </form>
    </div>
</body>
</html>
