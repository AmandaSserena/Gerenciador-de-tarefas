<?php
session_start(); 
include 'conexao.php';


$sql = 'SELECT * FROM gerenciamentodetarefas';
$query = $conexao->query($sql);
$tarefas = $query->fetchAll(PDO::FETCH_ASSOC);


$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : '';
unset($_SESSION['mensagem']); // Limpar a mensagem da sessão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="bloco">Gerenciamento de Tarefas</h1>


    <h2 class="bloco">Tarefas</h2>
    <table class="container" border="1"> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?php echo $tarefa['id']; ?></td>
                    <td><?php echo htmlspecialchars($tarefa['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['status']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $tarefa['id']; ?>" class="btn-editar">Editar</a>
                        <a href="deletar.php?id=<?php echo $tarefa['id']; ?>" class="btn-deletar" onclick="return confirm('Tem certeza que deseja deletar esta tarefa?');">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

     
        <?php if ($mensagem): ?>
        <p class="mensagem-status"><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <a href="adicionar.php" class="btn-adicionar" onclick="return confirm('Você tem certeza que deseja adicionar uma nova tarefa?');">Adicionar Nova Tarefa</a>
</body>
</html>
