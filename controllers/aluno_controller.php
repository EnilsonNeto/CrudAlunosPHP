<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];

    $sql = "INSERT INTO alunos (nome, email, telefone, data_nascimento) VALUES (:nome, :email, :telefone, :data_nascimento)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":data_nascimento", $data_nascimento);

    if ($stmt->execute()) {
        header("Location: ../views/cadastro_aluno.php?status=success");
        exit();
    } else {
        echo "Erro ao cadastrar.";
    }
}
?>
