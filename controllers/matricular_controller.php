<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno_id = $_POST["aluno_id"];
    $curso_id = $_POST["curso_id"];

    // Verificar se a matrícula já existe
    $check = $pdo->prepare("SELECT * FROM matriculas WHERE aluno_id = :aluno_id AND curso_id = :curso_id");
    $check->bindParam(":aluno_id", $aluno_id);
    $check->bindParam(":curso_id", $curso_id);
    $check->execute();

    if ($check->rowCount() > 0) {
        header("Location: ../views/matricular_aluno.php?status=exists");
        exit();
    }

    // Inserir a matrícula
    $sql = "INSERT INTO matriculas (aluno_id, curso_id) VALUES (:aluno_id, :curso_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":aluno_id", $aluno_id);
    $stmt->bindParam(":curso_id", $curso_id);

    if ($stmt->execute()) {
        header("Location: ../views/lista_matriculas.php?status=success");
        exit();
    } else {
        echo "Erro ao matricular.";
    }
}
?>
