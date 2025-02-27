<?php
include(__DIR__ . '/../config/db.php');
include(__DIR__ . '/cadastro_aluno.php');
include(__DIR__ . '/editar_aluno.php');


$query = "SELECT * FROM alunos WHERE ativo = TRUE ORDER BY id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center">Lista de Alunos</h2>
        <p class="text-center">Abaixo você terá acesso a listagem e ações sobre os alunos, ultilize o buscar alunos caso deseja visualizar um aluno específico.</p>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar aluno..." style="width: 250px;">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCadastroAluno"><i class="fa-solid fa-plus"></i> Cadastrar Novo Aluno</button>
        </div>
        <hr>
        <table class="table table-striped text-center" id="tabelaAlunos">
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Email</th>
                    <th>Nº Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Ainda não há alunos cadastrados. Que tal começar agora?</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result as $row): ?>
                        <tr id="linha-<?= $row["id"] ?>">
                            <td><?= $row["nome"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td><?= $row["telefone"] ?></td>
                            <td><?= $row["data_nascimento"] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-id="<?= $row["id"] ?>"><i class="fas fa-edit"></i> Editar</button>
                                <button class="btn btn-danger btn-sm btnExcluir" data-id="<?= $row["id"] ?>"><i class="fas fa-trash"></i> Excluir</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>