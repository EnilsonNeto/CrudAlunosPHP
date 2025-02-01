<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];

    $sql = "UPDATE alunos SET nome = :nome, email = :email, telefone = :telefone, data_nascimento = :data_nascimento WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":data_nascimento", $data_nascimento);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header("Location: ../views/lista_alunos.php?status=updated");
        exit();
    } else {
        echo "Erro ao atualizar.";
    }
}
?>
