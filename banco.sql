create schema hivedb;

use hivedb;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE topicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    categoria_id INT,
    autor VARCHAR(100),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    anexo VARCHAR(255),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE respostas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    topico_id INT,
    autor VARCHAR(100),
    resposta TEXT NOT NULL,
    data_resposta DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (topico_id) REFERENCES topicos(id)
);

INSERT INTO categorias (nome) VALUES
('Acomodações'),
('Visto e documentação'),
('Dificuldades com idioma'),
('Dicas de integração cultural'),
('Indicações de profissionais');
