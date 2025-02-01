<?php
include "../config/db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM alunos WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: lista_alunos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-4">Editar Aluno</h2>
    <form action="../controllers/editar_aluno_controller.php" method="POST">
        <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $aluno['nome'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $aluno['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= $aluno['telefone'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" value="<?= $aluno['data_nascimento'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</body>
</html>
