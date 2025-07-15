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

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  data_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE usuarios ADD COLUMN pais_origem VARCHAR(100);
ALTER TABLE usuarios ADD COLUMN pais_residencia VARCHAR(100);

ALTER TABLE topicos ADD COLUMN criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE usuarios ADD COLUMN foto_perfil VARCHAR(255);


CREATE TABLE indicacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_servico VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    localizacao VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    contato VARCHAR(100),
    autor VARCHAR(100),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE servicos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  descricao TEXT NOT NULL,
  categoria VARCHAR(100),
  preco VARCHAR(50),
  contato VARCHAR(100),
  autor VARCHAR(100),
  criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria_id INT NOT NULL,
    usuario_id INT NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);