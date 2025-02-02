<?php
include "../config/db.php";
include "../functions/aluno_functions.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $aluno = getAlunoById($id);

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

    $sql = createOrUpdateAluno($nome, $email, $telefone, $data_nascimento, $id);
    echo json_encode($sql);
}
?>
