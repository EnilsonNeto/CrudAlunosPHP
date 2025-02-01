<?php
include "config/db.php"; // Certifique-se de incluir a conexão

// Definir o nome do banco de dados
$dbname = "crud_php";

try {
    // Verificar se o banco de dados existe
    $dbCheckQuery = "SELECT 1 FROM pg_database WHERE datname = :dbname";
    $stmt = $pdo->prepare($dbCheckQuery);
    $stmt->bindParam(":dbname", $dbname);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        // Se o banco de dados não existir, cria-lo
        $createDbQuery = "CREATE DATABASE $dbname";
        $pdo->exec($createDbQuery);
        echo "Banco de dados '$dbname' criado com sucesso.<br>";

        // Agora que o banco de dados está criado, se reconectar no novo banco
        $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "postgres", "20062003");
    }

    // Criação das tabelas
    $createTableQuery = "
    CREATE TABLE IF NOT EXISTS alunos (
        id SERIAL PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        telefone VARCHAR(20),
        data_nascimento DATE
    );

    CREATE TABLE IF NOT EXISTS cursos (
        id SERIAL PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        descricao TEXT,
        carga_horaria INT
    );

    CREATE TABLE IF NOT EXISTS matriculas (
        id SERIAL PRIMARY KEY,
        aluno_id INT REFERENCES alunos(id),
        curso_id INT REFERENCES cursos(id),
        data_matricula DATE DEFAULT CURRENT_DATE
    );
    ";

    $pdo->exec($createTableQuery);
    echo "Tabelas criadas com sucesso!<br>";
} catch (PDOException $e) {
    die("Erro na criação do banco ou das tabelas: " . $e->getMessage());
}
?>
