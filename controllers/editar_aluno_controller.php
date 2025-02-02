<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM alunos WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$aluno) {
        header("Location: ../views/lista_alunos.php?status=notfound");
        exit();
    }

    echo json_encode($aluno);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];
    $ativo = $_POST["ativo"];

    $sql = "UPDATE alunos SET nome = :nome, email = :email, telefone = :telefone, data_nascimento = :data_nascimento, ativo = :ativo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":data_nascimento", $data_nascimento);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":ativo", $ativo);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}
