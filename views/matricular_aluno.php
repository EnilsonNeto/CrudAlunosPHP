<?php
include "../config/db.php";

// Buscar alunos
$alunos = $pdo->query("SELECT * FROM alunos ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// Buscar cursos
$cursos = $pdo->query("SELECT * FROM cursos ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricular Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-4">Matricular Aluno</h2>
    
    <form action="../controllers/matricular_controller.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Aluno</label>
            <select name="aluno_id" class="form-control" required>
                <option value="">Selecione um aluno</option>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Curso</label>
            <select name="curso_id" class="form-control" required>
                <option value="">Selecione um curso</option>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?= $curso['id'] ?>"><?= $curso['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Matricular</button>
    </form>
</body>
</html>
