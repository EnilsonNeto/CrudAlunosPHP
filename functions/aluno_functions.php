<?php

include "../config/db.php";

function checkEmail($email) {
    global $pdo;
    $sql = "SELECT id, ativo FROM alunos WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createOrUpdateAluno($nome, $email, $telefone, $data_nascimento, $id = null) {
    global $pdo;

    $alunoExistente = checkEmail($email);
    if ($alunoExistente) {
        if ($alunoExistente['ativo'] === 'TRUE') {
            return ["status" => "error", "message" => "Já existe um aluno com esse e-mail ativo."];
        }
        $sql = "UPDATE alunos SET nome = :nome, telefone = :telefone, data_nascimento = :data_nascimento, ativo = TRUE WHERE email = :email";
    } else {
        $sql = "INSERT INTO alunos (nome, email, telefone, data_nascimento, ativo) VALUES (:nome, :email, :telefone, :data_nascimento, TRUE)";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":data_nascimento", $data_nascimento);

    if ($stmt->execute()) {
        return ["status" => "success"];
    } else {
        return ["status" => "error"];
    }
}

function deleteAluno($id) {
    global $pdo;
    $sql = "UPDATE alunos SET ativo = FALSE WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    
    if ($stmt->execute()) {
        return ["status" => "deleted"];
    } else {
        return ["status" => "error"];
    }
}

function listAlunos() {
    global $pdo;
    $query = "SELECT * FROM alunos WHERE ativo = TRUE ORDER BY id DESC";
    $result = $pdo->query($query);

    if ($result) {
        $alunos = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $alunos[] = $row;
        }
        return ["data" => $alunos];
    } else {
        return ["status" => "error", "message" => "Erro na consulta ao banco de dados"];
    }
}

function getAlunoById($id) {
    global $pdo;
    $query = "SELECT * FROM alunos WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
