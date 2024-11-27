<?php
session_start(); // Iniciar a sessão
include 'conexao.php';

// Verificar se o parâmetro 'id' está presente na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar a tarefa com o ID fornecido
    $sql = 'SELECT * FROM gerenciamentodetarefas WHERE id = :id';
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se a tarefa foi encontrada
    if (!$tarefa) {
        die('<p style="color: red;">Tarefa não encontrada. <a href="index.php">Voltar</a></p>');
    }
} else {
    die('<p style="color: red;">ID da tarefa não fornecido. <a href="index.php">Voltar</a></p>');
}

// Atualizar os dados da tarefa quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];

    // Validar o status recebido
    $statusPermitidos = ['pendente', 'em andamento', 'concluída'];
    if (!in_array($status, $statusPermitidos)) {
        echo '<p style="color: red;">Status inválido.</p>';
        exit;
    }

    // Atualizar a tarefa no banco de dados
    $sql = 'UPDATE gerenciamentodetarefas SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id';
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Tarefa ID $id atualizada com sucesso!";
        header('Location: index.php');
        exit;
    } else {
        echo '<p style="color: red;">Erro ao atualizar a tarefa.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="editar.css">
</head>
<body>
    <h1>Editar Tarefa</h1>

    <!-- Formulário de edição -->
    <form method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required> 
        <br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea> 
        <br><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="pendente" <?php echo $tarefa['status'] == 'pendente' ? 'selected' : ''; ?>>Pendente</option>
            <option value="em andamento" <?php echo $tarefa['status'] == 'em andamento' ? 'selected' : ''; ?>>Em andamento</option>
            <option value="concluída" <?php echo $tarefa['status'] == 'concluída' ? 'selected' : ''; ?>>Concluída</option>
        </select>
        <br><br>

        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </form>

    <br><br>
    <a href="index.php">Voltar</a>
</body>
</html>
