<?php
include "../config/db.php";

$query = "
    SELECT 
        m.id, a.nome AS aluno, c.nome AS curso, m.data_matricula
    FROM matriculas m
    JOIN alunos a ON m.aluno_id = a.id
    JOIN cursos c ON m.curso_id = c.id
    ORDER BY m.data_matricula DESC";
    
$matriculas = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Matrículas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-4">Lista de Matrículas</h2>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Data da Matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matriculas as $matricula): ?>
                <tr>
                    <td><?= $matricula['id'] ?></td>
                    <td><?= $matricula['aluno'] ?></td>
                    <td><?= $matricula['curso'] ?></td>
                    <td><?= $matricula['data_matricula'] ?></td>
                    <td>
                        <a href="../controllers/excluir_matricula.php?id=<?= $matricula['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="matricular_aluno.php" class="btn btn-primary">Nova Matrícula</a>
</body>
</html>
