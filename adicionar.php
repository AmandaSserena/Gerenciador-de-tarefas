<?php
session_start(); // Iniciar a sessão
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // Inserir nova tarefa com status 'pendente'
    $sql = 'INSERT INTO gerenciamentodetarefas (titulo, descricao, status) VALUES (:titulo, :descricao, "pendente")';
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);

    if ($stmt->execute()) {
        
        $_SESSION['mensagem'] = 'Tarefa adicionada com sucesso!';
        header('Location: index.php'); 
        exit;
    } else {
        echo '<p style="color: red;">Erro ao adicionar a tarefa.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tarefa</title>
    <link rel="stylesheet" href="adicionar.css">
</head>
<body>
    <h1>Adicionar Nova Tarefa</h1>

    <form method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
        <br><br>
        <button type="submit">Adicionar</button>
    </form>

    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
