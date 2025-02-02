<?php
include "../config/db.php";
include "../functions/aluno_functions.php"; 

$action = $_GET["action"] ?? $_POST["action"] ?? "";

if ($action === "create") {
    $nome = filter_input(INPUT_POST, "nome");
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, "telefone");
    $data_nascimento = filter_input(INPUT_POST, "data_nascimento");

    $result = createOrUpdateAluno($nome, $email, $telefone, $data_nascimento);
    echo json_encode($result);
    
} elseif ($action === "delete") {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $result = deleteAluno($id);
    echo json_encode($result);

} elseif ($action === "list") {
    $result = listAlunos();
    echo json_encode($result);
}
?>
