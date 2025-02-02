<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão Escolar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Bem-vindo ao Sistema de Gestão Escolar</h1>
        <p class="text-center mb-4">
            O Sistema de Gestão Escolar foi desenvolvido para otimizar a administração de alunos em instituições de ensino. Ele oferece uma interface simples e funcional, permitindo que os gestores cadastrem, editem e excluam informações dos alunos de maneira rápida e eficiente.
        </p>
        <?php include "lista_alunos.php"; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
