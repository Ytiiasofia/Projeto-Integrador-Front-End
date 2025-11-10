-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 10/11/2025 às 21:58
-- Versão do servidor: 8.0.43
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `meu_banco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario_curtidas`
--

CREATE TABLE `comentario_curtidas` (
  `curtida_id` int NOT NULL,
  `comentario_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `data_curtida` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_posts`
--

CREATE TABLE `forum_posts` (
  `post_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_edicao` datetime DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `forum_posts`
--

INSERT INTO `forum_posts` (`post_id`, `usuario_id`, `titulo`, `conteudo`, `data_criacao`, `data_edicao`, `ativo`) VALUES
(1, 15, 'eu odeio esse inferno de curso', 'que curso horrível', '2025-11-10 21:22:42', NULL, 1),
(2, 15, 'que odio', 'aaaaaaa', '2025-11-10 21:22:58', NULL, 1),
(3, 15, 'Avaliação de bioplástico formulado com subprodutos naturais e sua aplicabilidade como embalagem agrícola biodegradável', 'a', '2025-11-10 21:33:43', NULL, 1),
(4, 15, 'teste', 'eita bb', '2025-11-10 21:54:56', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_tags`
--

CREATE TABLE `forum_tags` (
  `tag_id` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `forum_tags`
--

INSERT INTO `forum_tags` (`tag_id`, `nome`, `descricao`, `data_criacao`) VALUES
(1, 'javascript', 'Discussões sobre JavaScript e frameworks', '2025-11-10 20:44:13'),
(2, 'frontend', 'Desenvolvimento frontend e UI/UX', '2025-11-10 20:44:13'),
(3, 'web-development', 'Desenvolvimento web em geral', '2025-11-10 20:44:13'),
(4, 'carreira', 'Dicas de carreira e desenvolvimento profissional', '2025-11-10 20:44:13'),
(5, 'entrevistas', 'Preparação para entrevistas técnicas', '2025-11-10 20:44:13'),
(6, 'salario', 'Negociação salarial e benefícios', '2025-11-10 20:44:13'),
(7, 'react', 'Framework React.js', '2025-11-10 20:44:13'),
(8, 'vue', 'Framework Vue.js', '2025-11-10 20:44:13'),
(9, 'svelte', 'Framework Svelte', '2025-11-10 20:44:13'),
(10, 'backend', 'Desenvolvimento backend', '2025-11-10 20:44:13'),
(11, 'banco-de-dados', 'Bancos de dados e SQL', '2025-11-10 20:44:13'),
(12, 'mobile', 'Desenvolvimento mobile', '2025-11-10 20:44:13'),
(13, 'ódio', NULL, '2025-11-10 21:22:42'),
(14, 'ranço', NULL, '2025-11-10 21:22:42'),
(15, 'aa', NULL, '2025-11-10 21:22:58'),
(16, 'aaa', NULL, '2025-11-10 21:22:58'),
(17, 'a', NULL, '2025-11-10 21:33:43'),
(18, 'teste', NULL, '2025-11-10 21:54:56'),
(19, 'testando', NULL, '2025-11-10 21:54:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `oportunidades`
--

CREATE TABLE `oportunidades` (
  `id_oportunidade` int NOT NULL,
  `titulo` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `modalidade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `local` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `area` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `data_abertura` date NOT NULL,
  `data_fechamento` date NOT NULL,
  `link_detalhes` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `status_edital` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `oportunidades`
--

INSERT INTO `oportunidades` (`id_oportunidade`, `titulo`, `tipo`, `modalidade`, `local`, `area`, `data_abertura`, `data_fechamento`, `link_detalhes`, `status_edital`) VALUES
(8, 'Concurso Público para Analista de Dados - 2025', 'Concurso', 'Presencial', 'Distrito Federal', 'Análise de Dados', '2025-08-20', '2025-11-10', 'https://gov.br/concurso-analista', 'Aberto'),
(9, 'Vaga de Emprego - Desenvolvedor Full Stack Sênior', 'Emprego', 'Online', 'Exterior', 'Desenvolvimento Full Stack', '2025-10-01', '2025-11-01', 'https://empresa-tech.com/carreiras/fullstack', 'Fechado'),
(12, 'Programa de Pós-graduação em Ciência de Dados - 2026', 'Pós-graduação', 'Presencial', 'Rio de Janeiro', 'Ciência de Dados', '2025-07-01', '2025-12-31', 'https://universidadedigital.edu.br/pos-ciencia-dados', 'Aberto'),
(14, 'Treinamento DevOps para Profissionais de TI', 'Treinamento', 'Híbrido', 'Bahia', 'DevOps', '2025-09-25', '2025-11-25', 'https://devopsacademy.com.br/cursos/devops', 'Vigente'),
(20, 'LeroLero 2.0', 'Iniciação Científica', 'Presencial', 'Paraíba', 'Ciência de Dados', '2025-11-05', '2025-11-09', 'https://github.com/Ytiiasofia/Projeto-Integrador-Front-End/tree/main/assets/img', 'Fechado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts_salvos`
--

CREATE TABLE `posts_salvos` (
  `salvamento_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `post_id` int NOT NULL,
  `data_salvamento` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `post_comentarios`
--

CREATE TABLE `post_comentarios` (
  `comentario_id` int NOT NULL,
  `post_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `comentario` text NOT NULL,
  `comentario_pai_id` int DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_edicao` datetime DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `post_comentarios`
--

INSERT INTO `post_comentarios` (`comentario_id`, `post_id`, `usuario_id`, `comentario`, `comentario_pai_id`, `data_criacao`, `data_edicao`, `ativo`) VALUES
(1, 4, 15, 'que vontade de me matar', NULL, '2025-11-10 21:55:21', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `post_curtidas`
--

CREATE TABLE `post_curtidas` (
  `curtida_id` int NOT NULL,
  `post_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `data_curtida` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `post_tags`
--

CREATE TABLE `post_tags` (
  `post_tag_id` int NOT NULL,
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `post_tags`
--

INSERT INTO `post_tags` (`post_tag_id`, `post_id`, `tag_id`) VALUES
(1, 1, 13),
(2, 1, 14),
(3, 2, 15),
(4, 2, 16),
(7, 3, 15),
(6, 3, 17),
(9, 4, 18),
(10, 4, 19);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int NOT NULL,
  `nome_usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nome_usuario`, `email`, `senha`, `is_admin`, `data_cadastro`) VALUES
(12, 'sofiamdavid', 'sofiamuller1551@gmail.com', '$2y$10$PL7rOL8ZiH0clFZmZeub9uvDNLboETYlb4EhXBSmh1lnUHIbxxvqG', 1, '2025-10-23 14:09:10'),
(13, 'sofia6923', 'sofiamuller1301@gmail.com', '$2y$10$FL94093oAxRH3w/TOO615uEXmld8Py6gkSliJwLPXpF8uCxgMQN2i', 1, '2025-11-10 11:19:50'),
(15, 'Senha123456', 'sofiamuller1201@gmail.com', '$2y$10$jCsLTVTRP.O85o4dWd9yj.IaRlu0JsOliDVijFREsBNaHQJSMuHjK', 0, '2025-11-10 20:30:56');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentario_curtidas`
--
ALTER TABLE `comentario_curtidas`
  ADD PRIMARY KEY (`curtida_id`),
  ADD UNIQUE KEY `unique_comment_user_like` (`comentario_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `forum_tags`
--
ALTER TABLE `forum_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  ADD PRIMARY KEY (`id_oportunidade`);

--
-- Índices de tabela `posts_salvos`
--
ALTER TABLE `posts_salvos`
  ADD PRIMARY KEY (`salvamento_id`),
  ADD UNIQUE KEY `unique_user_saved_post` (`usuario_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Índices de tabela `post_comentarios`
--
ALTER TABLE `post_comentarios`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `comentario_pai_id` (`comentario_pai_id`);

--
-- Índices de tabela `post_curtidas`
--
ALTER TABLE `post_curtidas`
  ADD PRIMARY KEY (`curtida_id`),
  ADD UNIQUE KEY `unique_post_user_like` (`post_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`post_tag_id`),
  ADD UNIQUE KEY `unique_post_tag` (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentario_curtidas`
--
ALTER TABLE `comentario_curtidas`
  MODIFY `curtida_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `forum_tags`
--
ALTER TABLE `forum_tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  MODIFY `id_oportunidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `posts_salvos`
--
ALTER TABLE `posts_salvos`
  MODIFY `salvamento_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `post_comentarios`
--
ALTER TABLE `post_comentarios`
  MODIFY `comentario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `post_curtidas`
--
ALTER TABLE `post_curtidas`
  MODIFY `curtida_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `post_tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario_curtidas`
--
ALTER TABLE `comentario_curtidas`
  ADD CONSTRAINT `comentario_curtidas_ibfk_1` FOREIGN KEY (`comentario_id`) REFERENCES `post_comentarios` (`comentario_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentario_curtidas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `posts_salvos`
--
ALTER TABLE `posts_salvos`
  ADD CONSTRAINT `posts_salvos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_salvos_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`post_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `post_comentarios`
--
ALTER TABLE `post_comentarios`
  ADD CONSTRAINT `post_comentarios_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comentarios_ibfk_3` FOREIGN KEY (`comentario_pai_id`) REFERENCES `post_comentarios` (`comentario_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `post_curtidas`
--
ALTER TABLE `post_curtidas`
  ADD CONSTRAINT `post_curtidas_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_curtidas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `forum_tags` (`tag_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
