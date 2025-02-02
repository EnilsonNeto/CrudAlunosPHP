<?php
include "../config/db.php";
include "../functions/aluno_functions.php"; 

$action = $_GET["action"] ?? $_POST["action"] ?? "";

try {
    if ($action === "create") {
        $nome = filter_input(INPUT_POST, "nome");
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, "telefone");
        $data_nascimento = filter_input(INPUT_POST, "data_nascimento");

        $result = createOrUpdateAluno($nome, $email, $telefone, $data_nascimento);
        echo json_encode(["status" => "success", "data" => $result]);
    
    } elseif ($action === "delete") {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $result = deleteAluno($id);
        echo json_encode(["status" => "success", "data" => $result]);
    
    } elseif ($action === "list") {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = "%" . $_GET['search'] . "%"; 
            $query = "SELECT * FROM alunos WHERE ativo = TRUE AND (nome LIKE :search OR email LIKE :search) ORDER BY id DESC";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        } else {
            $query = "SELECT * FROM alunos WHERE ativo = TRUE ORDER BY id DESC";
            $stmt = $pdo->prepare($query);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["status" => "success", "data" => $result]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
