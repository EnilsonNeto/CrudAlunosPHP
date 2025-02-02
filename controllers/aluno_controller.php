<?php
include "../config/db.php";

$action = $_GET["action"] ?? $_POST["action"] ?? "";

if ($action === "create") {
    $nome = filter_input(INPUT_POST, "nome");
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, "telefone");
    $data_nascimento = filter_input(INPUT_POST, "data_nascimento");

    $sqlCheckEmail = "SELECT id, ativo FROM alunos WHERE email = :email LIMIT 1";
    $stmtCheckEmail = $pdo->prepare($sqlCheckEmail);
    $stmtCheckEmail->bindParam(":email", $email);
    $stmtCheckEmail->execute();

    $alunoExistente = $stmtCheckEmail->fetch(PDO::FETCH_ASSOC);

    if ($alunoExistente) {
        if ($alunoExistente['ativo'] === 'TRUE') {
            echo json_encode(["status" => "error", "message" => "Já existe um aluno com esse e-mail ativo."]);
            exit; 
        }
    }

    $sql = "INSERT INTO alunos (nome, email, telefone, data_nascimento, ativo) VALUES (:nome, :email, :telefone, :data_nascimento, TRUE)";
    if ($alunoExistente) {
        $sql = "UPDATE alunos SET nome = :nome, telefone = :telefone, data_nascimento = :data_nascimento, ativo = TRUE WHERE email = :email";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":data_nascimento", $data_nascimento);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
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
