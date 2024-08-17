<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/padrao.css">
    <title>Cadastro de Livros</title>
</head>
<body>
    <header>
        <h1>Cadastro de Livros</h1>
    </header>

    <div class="form-container">
        <form action="../php/processar_livro.php" method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="autor">Autor:</label><br>
            <select id="autor" name="autor" required>
            <option value="" disabled selected>Selecione um Autor</option>
                <?php
                include '../php/db_connection.php';
                $autor_query = "SELECT id, nome FROM autores";
                $autor_result = $conn->query($autor_query);
                
                if ($autor_result->num_rows > 0) {
                    var_dump($row);
                    while ($row = $autor_result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum autor encontrado</option>";
                }
                ?>
            </select><br><br>

            <label for="categoria">Categoria:</label><br>
            <select id="categoria" name="categoria" required>
            <option value="" disabled selected>Selecione uma Categoria</option>
                <?php
                include '../php/db_connection.php';
                $categoria_query = "SELECT id, nome FROM categorias";
                $categoria_result = $conn->query($categoria_query);

                if ($categoria_result->num_rows > 0) {
                    var_dump($row);
                    while ($row = $categoria_result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma categoria encontrada</option>";
                }
                ?>
            </select><br><br>

            <div class="button-container">
                <input type="button" value="Voltar" onclick="window.history.back();">
                <input type="submit" value="Cadastrar">
            </div>
        </form>
    </div>
</body>
</html>

