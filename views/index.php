<?php
// index.php
include "config/db.php";

// Você pode incluir uma lógica aqui para buscar a lista de alunos ou cursos, se necessário
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão Escolar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-4">Bem-vindo ao Sistema de Gestão Escolar</h1>
    <p>Escolha uma opção para continuar:</p>

    <div class="list-group">
        <a href="cadastro_aluno.php" class="list-group-item list-group-item-action">Cadastrar Aluno</a>
        <a href="lista_alunos.php" class="list-group-item list-group-item-action">Listar Alunos</a>
        <a href="cadastro_curso.php" class="list-group-item list-group-item-action">Cadastrar Curso</a>
        <a href="lista_cursos.php" class="list-group-item list-group-item-action">Listar Cursos</a>
    </div>
</body>
</html>
