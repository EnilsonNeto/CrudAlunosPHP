<?php
include "../config/db.php";
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
    <?php include "lista_alunos.php"; ?>
</body>

</html>