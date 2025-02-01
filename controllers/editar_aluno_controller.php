<?php
include "../config/db.php";

$action = $_GET["action"] ?? $_POST["action"] ?? "";

if ($action === "getAluno") {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM alunos WHERE id = :id AND ativo = TRUE"; // Apenas alunos ativos
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($aluno) {
        echo json_encode(["status" => "success", "data" => $aluno]);
    } else {
        echo json_encode(["status" => "error", "message" => "Aluno não encontrado"]);
    }
} elseif ($action === "update") {
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $data_nascimento = filter_input(INPUT_POST, "data_nascimento", FILTER_SANITIZE_STRING);

    if (!$id || !$nome || !$email) {
        echo json_encode(["status" => "error", "message" => "Preencha todos os campos obrigatórios."]);
        exit();
    }

    // Atualiza apenas se o aluno estiver ativo
    $sql = "UPDATE alunos SET nome = :nome, email = :email, telefone = :telefone, data_nascimento = :data_nascimento WHERE id = :id AND ativo = TRUE";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":data_nascimento", $data_nascimento);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao atualizar aluno."]);
    }
}
?>
