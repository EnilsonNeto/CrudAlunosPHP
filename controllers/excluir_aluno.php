<?php
include "../config/db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM alunos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header("Location: ../views/lista_alunos.php?status=deleted");
        exit();
    } else {
        echo "Erro ao excluir.";
    }
}
?>
