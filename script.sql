CREATE DATABASE tarefas_db;

USE tarefas_db;

CREATE TABLE gerenciamentodetarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    criado_em ENUM('pendente', 'em andamento', 'concluída') DEFAULT 'pendente',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ALTER TABLE gerenciamentodetarefas ADD COLUMN status VARCHAR(20);
    ALTER TABLE gerenciamentodetarefas DROP COLUMN criado_em;
);
