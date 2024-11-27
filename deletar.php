<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = 'DELETE FROM gerenciamentodetarefas WHERE id = :id';
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo 'Erro ao deletar a tarefa.';
    }
}
?>