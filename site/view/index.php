<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/impressao.css">
    <title>Livraria</title>
</head>
<body>
    <header>
        <h1>Livraria</h1>
    </header>

    <div class="button-container no-print">
        <button onclick="window.location.href='../view/cad-autor.php'">Cadastrar<br>Autor</button>
        <button onclick="window.location.href='../view/cad-categoria.php'">Cadastrar<br>Categoria</button>
        <button onclick="window.location.href='../view/cad-livro.php'">Cadastrar<br>Livro</button>
        <button onclick="window.print()">Relatório</button>
        <button onclick="window.location.href='../view/contato.php'">Contato</button>
    </div>

    <br><br>

    <?php
        include '../php/db_connection.php';

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
    ?>

    <div>
        <h1>Lista de Categorias</h1>
        <table id="tabela-categorias">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $categoria_query = "SELECT id, nome FROM categorias";
                    $categoria_result = $conn->query($categoria_query);

                    if ($categoria_result->num_rows > 0) {
                        while ($row = $categoria_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td><td>" . $row['nome'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Nenhuma categoria encontrada</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div>
        <h1>Lista de Autores</h1>
        <table id="tabela-autores">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $autor_query = "SELECT id, nome FROM autores";
                    $autor_result = $conn->query($autor_query);

                    if ($autor_result->num_rows > 0) {
                        while ($row = $autor_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td><td>" . $row['nome'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Nenhum autor encontrado</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div>
        <h1>Lista de Livros</h1>
        <table id="tabela-livros">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $livro_query = "
                        SELECT livros.id, livros.nome, autores.nome AS autor, categorias.nome AS categoria 
                        FROM livros 
                        JOIN autores ON livros.autor_id = autores.id 
                        JOIN categorias ON livros.categoria_id = categorias.id";
                    $livro_result = $conn->query($livro_query);

                    if ($livro_result->num_rows > 0) {
                        while ($row = $livro_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['autor'] . "</td>";
                            echo "<td>" . $row['categoria'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Nenhum livro encontrado</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../js/impressao.js"></script>
</body>
</html>
