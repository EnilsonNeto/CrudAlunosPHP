<?php include "../config/db.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Curso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-4">Cadastro de Curso</h2>
    <form action="../controllers/curso_controller.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Nome do Curso</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Carga Horária</label>
            <input type="number" name="carga_horaria" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</body>
</html>
