<?php include "../config/db.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-4">Cadastro de Aluno</h2>
    <form action="../controllers/aluno_controller.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</body>
</html>
