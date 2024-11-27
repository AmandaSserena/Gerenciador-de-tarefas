<?php
$host = 'localhost';
$usuario = 'root'; // Seu usuário MySQL
$senha = ''; // Sua senha MySQL
$database = 'tarefas_db';

try {
    $conexao = new PDO("mysql:host=$host;dbname=$database", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro na conexão: ' . $e->getMessage();
}
?>
