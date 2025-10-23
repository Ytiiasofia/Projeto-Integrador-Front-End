-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 23/10/2025 às 13:10
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
(5, 'a', 'Concurso', 'Híbrido', 'Pará', 'Ciência de Dados', '2025-10-23', '2025-10-13', 'https://www.google.com/search?sca_esv=b2094a0e5ce54ac6&sxsrf=AE3TifMhXKx02NEm8gBzGEIY671SwoTwYQ:1760569509214&udm=2&fbs=AIIjpHydJdUtNKrM02hj0s4nbm4yAFb4PvhjIUcDtaFHkK_tyspyDJg0-Y4Ji8bGEtEDNJFQduqi-TCs4_9mtRCleowrm4wkMMdmjI2QB42C-Jk-i89uBMbU7tPYZGq42zKl-sdKbT2diiPtbbsQdnoe9CzQsSshKneJQc0YuPdzklQRfDTtfSbHtjvAMt0fNxkV4hSqVsf8-GZbUionqB4ShLJ9z0eCJw&q=soraka+meme&sa=X&ved=2ahUKEwiJ0cvBqKeQAxW6FbkGHWi-GogQtKgLegQIGRAB&biw=1536&bih=695&dpr=1.25#vhid=pKQuTh5VQXrUxM&vssid=mosaic', 'Vigente'),
(6, 'Programa de Estágio em Desenvolvimento Web - 2025', 'Estágio', 'Híbrido', 'São Paulo', 'Desenvolvimento Web', '2025-10-10', '2025-11-15', 'https://empresaexemplo.com/estagio-web', 'Aberto'),
(7, 'Bolsa de Iniciação Científica em IA Aplicada', 'Iniciação Científica', 'Presencial', 'Rio Grande do Sul', 'Inteligência Artificial', '2025-09-01', '2025-10-30', 'https://universidadeexemplo.br/ic-ia', 'Fechado'),
(8, 'Concurso Público para Analista de Dados - 2025', 'Concurso', 'Presencial', 'Distrito Federal', 'Análise de Dados', '2025-08-20', '2025-11-10', 'https://gov.br/concurso-analista', 'Aberto'),
(9, 'Vaga de Emprego - Desenvolvedor Full Stack Sênior', 'Emprego', 'Online', 'Exterior', 'Desenvolvimento Full Stack', '2025-10-01', '2025-11-01', 'https://empresa-tech.com/carreiras/fullstack', 'Aberto'),
(10, 'Bootcamp de Desenvolvimento Mobile Android', 'Bootcamp', 'Online', 'Minas Gerais', 'Desenvolvimento Mobile', '2025-10-05', '2025-12-05', 'https://bootcampmobile.dev/inscricao', 'Aberto'),
(11, 'Treinamento em Segurança da Informação - Nível Básico', 'Treinamento', 'Online', 'Paraná', 'Segurança da Informação', '2025-09-15', '2025-10-31', 'https://treinasegura.com.br/curso-basico', 'Aberto'),
(12, 'Programa de Pós-graduação em Ciência de Dados - 2026', 'Pós-graduação', 'Presencial', 'Rio de Janeiro', 'Ciência de Dados', '2025-07-01', '2025-12-31', 'https://universidadedigital.edu.br/pos-ciencia-dados', 'Aberto'),
(13, 'Estágio em Banco de Dados - Empresa XPTO', 'Estágio', 'Presencial', 'Santa Catarina', 'Banco de Dados', '2025-10-10', '2025-11-20', 'https://xpto.com.br/estagio-db', 'Aberto'),
(14, 'Treinamento DevOps para Profissionais de TI', 'Treinamento', 'Híbrido', 'Bahia', 'DevOps', '2025-09-25', '2025-11-25', 'https://devopsacademy.com.br/cursos/devops', 'Vigente'),
(17, 'aaaaaaaaaaaaaaa', 'Estágio', 'Online', 'Pernambuco', 'Análise de Dados', '2025-10-29', '2025-10-30', 'https://chat.deepseek.com/a/chat/s/ea69efd4-7a9d-463e-8828-9fa030e1d019', 'Aberto');

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
(2, 'TheGOD', 'admin@example.com', '123', 1, '2025-10-22 00:53:23'),
(10, 'ihateinformaticaAlot', 'sofiamuller1251@gmail.com', 'Sofia123', 0, '2025-10-22 00:53:23'),
(11, 'mariasilva', 'sofiamuller1811@gmail.com', 'Sofia123', 0, '2025-10-22 00:59:27');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  ADD PRIMARY KEY (`id_oportunidade`);

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
-- AUTO_INCREMENT de tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  MODIFY `id_oportunidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
