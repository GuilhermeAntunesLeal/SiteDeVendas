CREATE DATABASE IF NOT EXISTS inf261;
USE inf261;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(500) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(500)
);

CREATE TABLE IF NOT EXISTS compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO usuarios (nome, email, senha, tipo) VALUES
('Administrador GuiBe', 'adminGuiBe@gmail.com', '$2y$10$53i6xsGFinQdaKV2oILbQu3KUGb5T27EmlgreV9VM/0Kxblyl73zi', 'administrador'),
('Usuário Comum', 'usuario@gmail.com', '$2y$10$53i6xsGFinQdaKV2oILbQu3KUGb5T27EmlgreV9VM/0Kxblyl73zi', 'usuario');
