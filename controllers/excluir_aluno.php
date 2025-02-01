<?php
include "../config/db.php";

if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE alunos SET ativo = FALSE WHERE id = :id"; // Exclusão lógica
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
