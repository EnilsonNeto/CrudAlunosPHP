<?php
include "../config/db.php";
include "../views/cadastro_aluno.php";
include "../views/editar_aluno.php";
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
        <button class="btn btn-primary mt-4 btnCreate" data-bs-toggle="modal" data-bs-target="#modalCadastroAluno">Cadastrar Aluno</button>
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
                    <button class="btn btn-warning btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalEditarAluno" data-id="<?= $row["id"] ?>">Editar</button>                        
                    <button class="btn btn-danger btn-sm btnExcluir" data-id="<?= $row["id"] ?>">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>