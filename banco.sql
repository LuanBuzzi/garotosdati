create database hivedb;

use hivedb;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Acomodações'),
(2, 'Visto e documentação'),
(3, 'Dificuldades com idioma'),
(4, 'Dicas de integração cultural'),
(5, 'Indicações de profissionais');

CREATE TABLE `categorias_marketplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categorias_marketplace` (`id`, `nome`) VALUES
(1, 'Eletrônicos'),
(2, 'Roupas'),
(3, 'Alimentos'),
(4, 'Livros'),
(5, 'Móveis'),
(6, 'Jogos e Brinquedos'),
(7, 'Beleza e Saúde'),
(8, 'Ferramentas'),
(9, 'Esportes'),
(10, 'Outros'),
(11, 'Automóveis');

CREATE TABLE `indicacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_servico` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `localizacao` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `contato` varchar(100),
  `autor` varchar(100),
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `imagem` varchar(255),
  `criado_em` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `fk_produtos_categorias_marketplace` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `produtos` (`id`, `titulo`, `descricao`, `preco`, `categoria_id`, `usuario_id`, `imagem`, `criado_em`) VALUES
(1, 'iPhone 15', 'Aparelho impecável...', '2.50', 5, 7, 'uploads/img_6876630cb1f4a.jpg', '2025-07-15 11:17:48'),
(3, '2008 Ford Fiesta Flex', '📄 Documentação 2025 paga...', '17.90', 1, 6, 'uploads/img_68766848044c7.jpg', '2025-07-15 11:40:08'),
(10, 'ff', 'ff', '55.00', 3, 6, NULL, '2025-07-15 11:54:55'),
(11, 'TESTE', '55', '5555.00', 2, 6, 'uploads/img_68766bd10f8f8.jpeg', '2025-07-15 11:55:13'),
(12, 'Dunk Low Rayssa Leal', 'Tudo no skate pode mudar...', '899.99', 2, 6, 'uploads/img_68766c451763f.png', '2025-07-15 11:57:09');

CREATE TABLE `respostas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topico_id` int(11),
  `autor` varchar(100),
  `resposta` text NOT NULL,
  `data_resposta` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `topico_id` (`topico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `respostas` (`id`, `topico_id`, `autor`, `resposta`, `data_resposta`) VALUES
(1, 1, 'admin', 'você pode pedir ajuda', '2025-05-26 23:35:05'),
(2, 4, 'Luan', 'Nada ver isso aí', '2025-06-02 23:40:40'),
(3, 4, 'Luan', 'sim', '2025-06-02 23:40:46'),
(4, 3, 'Inácio', 'oi', '2025-07-15 11:18:40'),
(5, 1, 'Deanderson', 'oii', '2025-07-15 12:03:18');

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `preco` varchar(100),
  `contato` varchar(255) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `anexo` varchar(255),
  `criado_em` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `servicos` (`id`, `titulo`, `descricao`, `categoria_id`, `preco`, `contato`, `autor`, `anexo`, `criado_em`) VALUES
(1, 'Corto grama', 'todos os dias', 1, 'U$50', '+5547988942577', 'Luan', '', '2025-06-03 05:10:32'),
(2, 'DEDEE', 'ED', 3, '323223', 'DEDQWQ', 'Luan', 'uploads/foto2.jpeg', '2025-06-03 05:12:02');

CREATE TABLE `topicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `categoria_id` int(11),
  `autor` varchar(100),
  `data_criacao` datetime DEFAULT current_timestamp(),
  `anexo` varchar(255),
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `topicos` (`id`, `titulo`, `descricao`, `categoria_id`, `autor`, `data_criacao`, `anexo`, `criado_em`) VALUES
(1, 'Dúvida quanto as acomodações', 'preciso de ajuda...', 1, 'Luan', '2025-05-26 20:45:47', '', '2025-05-26 21:29:35'),
(2, 'Dúvida quanto as acomodações na Itália', '321', 4, 'emanuel martizenez', '2025-05-26 21:32:11', '', '2025-05-27 02:32:11'),
(3, 'Dúvida quanto as acomodações', '2222222222', 1, 'emanuel martizenez', '2025-05-26 21:53:23', '', '2025-05-27 02:53:23'),
(4, 'Teste', 'teste', 3, 'admin', '2025-05-26 23:24:04', '', '2025-05-27 04:24:04'),
(5, 'Teste', 'Teste', 3, 'Luan', '2025-06-02 23:40:20', 'uploads/coletiva.png', '2025-06-03 04:40:20');

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_registro` datetime DEFAULT current_timestamp(),
  `pais_origem` varchar(100),
  `pais_residencia` varchar(100),
  `foto_perfil` varchar(255),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_registro`, `pais_origem`, `pais_residencia`, `foto_perfil`) VALUES
(3, 'emanuel martizenez', '321@gmail.com', '$2y$10$pCAs7hgDBvaRk0QQeLLNouEj3rVehB/cycXop8VtgY7oa/lxzrrxm', '2025-05-26 21:26:09', 'Panamá', 'Itália', 'uploads/6835207fbfbe5.png'),
(4, 'admin', 'admin@admin.com', '$2y$10$faADlrKgkQEWlNg3/rHA6eTeHVb58zXK07HemT8bLDwG5SsqqXCNi', '2025-05-26 23:20:55', 'Brasil', 'Itália', 'uploads/6835219d20492.jpeg'),
(5, 'Luan', 'luan@gmail.com', '$2y$10$2GCeofQ10mCU05HZ4JEhKOfHSfj/Wb18YGzdExb6GXw9l1lXiepgy', '2025-06-02 22:21:10', 'Brasil', 'Espanha', 'uploads/683e6278541b7.png'),
(6, 'Deanderson', 'de@de.com', '$2y$10$3/BRBEkbgtGs5Xd/9comYOC43856.olEf6mDAexkVDwmyd1BwPgb.', '2025-07-15 09:18:38', 'África do Sul', 'Espanha', 'uploads/687647898db2e.png'),
(7, 'Inácio', 'inacio@gmail.com', '$2y$10$um8fIglxBf3hQUscOtK9ve.AscK3IRNpmezdQCLMcJ4iloqKCjbT.', '2025-07-15 10:07:11', 'Alemanha', 'Itália', 'uploads/6876633784dc6.jpeg');

-- Restrições de integridade
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias_marketplace` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_marketplace` (`id`),
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

ALTER TABLE `respostas`
  ADD CONSTRAINT `respostas_ibfk_1` FOREIGN KEY (`topico_id`) REFERENCES `topicos` (`id`);

ALTER TABLE `servicos`
  ADD CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

ALTER TABLE `topicos`
  ADD CONSTRAINT `topicos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
