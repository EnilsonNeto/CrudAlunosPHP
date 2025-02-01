<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $carga_horaria = $_POST["carga_horaria"];

    $sql = "INSERT INTO cursos (nome, descricao, carga_horaria) VALUES (:nome, :descricao, :carga_horaria)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":carga_horaria", $carga_horaria);

    if ($stmt->execute()) {
        header("Location: ../views/cadastro_curso.php?status=success");
        exit();
    } else {
        echo "Erro ao cadastrar.";
    }
}
?>
