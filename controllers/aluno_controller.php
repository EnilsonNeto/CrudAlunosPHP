<?php
include "../config/db.php";

$action = $_GET["action"] ?? $_POST["action"] ?? "";

if ($action === "create") {
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $data_nascimento = filter_input(INPUT_POST, "data_nascimento", FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO alunos (nome, email, telefone, data_nascimento, ativo) VALUES (:nome, :email, :telefone, :data_nascimento, TRUE)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":data_nascimento", $data_nascimento);

    if ($stmt->execute()) {
        header("Location: ../views/index.php?status=created");
        exit();
    } else {
        echo json_encode(["status" => "error"]);
        exit();
    }
} elseif ($action === "delete") {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE alunos SET ativo = FALSE WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "deleted"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
} elseif ($action === "list") {
    $query = "SELECT * FROM alunos WHERE ativo = TRUE ORDER BY id DESC";
    $result = $pdo->query($query);

    if ($result) {
        $alunos = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $alunos[] = $row;
        }

        echo json_encode(["data" => $alunos]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro na consulta ao banco de dados"]);
    }
}
?>
