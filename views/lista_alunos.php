<?php
include "../config/db.php";
$query = "SELECT * FROM alunos WHERE ativo = TRUE ORDER BY id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/aluno.js"></script>
</head>

<body class="container">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h2 class="mt-4">Lista de Alunos</h2>
        <a href="cadastro_aluno.php" class="btn btn-primary mt-4">Cadastrar Aluno</a>
    </div>

    <table class="table table-striped" id="tabelaAlunos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row): ?>
                <tr id="linha-<?= $row["id"] ?>">
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["nome"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["telefone"] ?></td>
                    <td><?= $row["data_nascimento"] ?></td>
                    <td>
                        <a href="editar_aluno.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm btnExcluir" data-id="<?= $row["id"] ?>">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>