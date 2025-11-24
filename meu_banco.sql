-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 24/11/2025 às 19:29
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
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int NOT NULL,
  `nome_categoria` varchar(100) NOT NULL,
  `descricao` text,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nome_categoria`, `descricao`, `data_criacao`) VALUES
(1, 'inovacao', 'Inovação e Tendências', '2025-11-21 16:43:43'),
(2, 'carreira', 'Carreira e Oportunidades', '2025-11-21 16:43:43'),
(3, 'educacao', 'Educação e Capacitação', '2025-11-21 16:43:43'),
(4, 'startups', 'Startups e Iniciativas Inovadoras', '2025-11-21 16:43:43'),
(5, 'eventos', 'Eventos e Conexões', '2025-11-21 16:43:43'),
(6, 'tecnologia', 'Tecnologia e Impacto Social', '2025-11-21 16:43:43');

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
(2, 15, 'que odio', 'aaaaaaa', '2025-11-10 21:22:58', NULL, 1),
(6, 15, 'aaa', 'aaa', '2025-11-13 14:28:01', NULL, 1),
(7, 15, 'oi', 'a', '2025-11-13 14:33:14', NULL, 1),
(8, 15, 'oi', 'a', '2025-11-13 14:35:44', NULL, 1),
(9, 15, 'a', 'a', '2025-11-13 14:44:05', NULL, 1),
(10, 16, 'aaa', 'aa', '2025-11-17 11:25:52', NULL, 1),
(12, 17, 'oi amores', 'testando os includes de js', '2025-11-23 23:38:50', NULL, 1),
(13, 16, 'oi', 'testando os includes de js no cad', '2025-11-23 23:41:05', NULL, 1),
(15, 17, 'teste de redirecionamento', 'eu sou mt incompetente', '2025-11-23 23:53:21', NULL, 1);

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
(19, 'testando', NULL, '2025-11-10 21:54:56'),
(20, 'as', NULL, '2025-11-10 22:01:52'),
(21, 'ttt', NULL, '2025-11-10 22:01:52'),
(22, 'oi', NULL, '2025-11-17 11:25:52'),
(23, 'ei', NULL, '2025-11-17 11:25:52'),
(24, 'ai', NULL, '2025-11-17 11:25:52'),
(25, 'admPikadasgalaxias', NULL, '2025-11-20 21:57:27'),
(26, 'jsBB', NULL, '2025-11-23 23:38:50'),
(27, 'nTaFuncionando', NULL, '2025-11-23 23:41:05'),
(28, 'testeIncludeJS', NULL, '2025-11-23 23:44:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias`
--

CREATE TABLE `noticias` (
  `noticia_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `imagem_capa` varchar(255) DEFAULT NULL,
  `categoria_id` int NOT NULL,
  `autor_id` int NOT NULL,
  `status` enum('rascunho','publicado','arquivado') DEFAULT 'rascunho',
  `data_publicacao` timestamp NULL DEFAULT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `noticias`
--

INSERT INTO `noticias` (`noticia_id`, `titulo`, `conteudo`, `imagem_capa`, `categoria_id`, `autor_id`, `status`, `data_publicacao`, `data_criacao`, `data_atualizacao`) VALUES
(5, 'Indústria adota IA generativa para acelerar inovação em produtos', 'A inteligência artificial generativa continua mudando o cenário industrial em 2025. De acordo com novos levantamentos do setor tecnológico, a adoção de IA avançada aumentou mais de 40% entre empresas de médio e grande porte nos últimos 12 meses. Esse salto está diretamente ligado à busca por eficiência, agilidade na criação de produtos e redução de custos operacionais.\r\n\r\nFabricantes de equipamentos eletrônicos, montadoras de veículos e empresas de varejo passaram a utilizar modelos generativos para tarefas como prototipação, simulação de uso, automação de testes e até criação de campanhas publicitárias. Em alguns casos, o tempo de desenvolvimento de um novo produto caiu pela metade.\r\n\r\nEspecialistas afirmam que a transformação vai além da digitalização tradicional. Agora, máquinas são capazes de analisar dados de mercado em tempo real, sugerir melhorias, prever falhas e auxiliar equipes de engenharia com insights que antes levariam semanas para serem identificados.\r\n\r\nApesar dos benefícios, a expansão da IA traz desafios importantes, como a necessidade de capacitar profissionais para interagir com os sistemas e garantir o uso ético das tecnologias. Mesmo assim, analistas projetam que, nos próximos dois anos, a IA generativa será tão comum dentro das indústrias quanto ferramentas de gestão empresarial.', 'assets/img/blog/6920a8291ce8e_1763747881.jpg', 1, 17, 'publicado', '2025-11-21 17:58:01', '2025-11-21 17:58:01', '2025-11-21 17:58:01'),
(6, 'Startups brasileiras ampliam vagas para programas de estágio em tecnologia', 'O ecossistema de startups no Brasil segue em ritmo acelerado de expansão, e isso tem se refletido diretamente na abertura de novas oportunidades para estudantes e jovens profissionais. Em 2025, a expectativa é que o número de vagas de estágio na área de tecnologia ultrapasse 12 mil posições, concentradas principalmente em desenvolvimento Front-end, Back-end, QA, UX e Ciência de Dados.\r\n\r\nEmpresas emergentes têm investido em programas estruturados de formação, oferecendo trilhas de aprendizagem, mentorias semanais e ciclos práticos que simulam o dia a dia de um time de tecnologia. Muitas startups estão apostando em desafios gamificados e projetos reais para identificar talentos que possam ser efetivados nos meses seguintes.\r\n\r\nDe acordo com gestores de RH, o setor busca perfis curiosos, colaborativos e com boa base lógica, mais do que especialistas em ferramentas específicas. Soft skills como comunicação e capacidade de resolver problemas também têm se mostrado diferenciais decisivos nos processos seletivos.\r\n\r\nAlém disso, diversas iniciativas públicas e privadas estão surgindo para aproximar estudantes do mercado, como feiras de contratação, cursos gratuitos e plataformas de matching entre talentos e empresas. A tendência indica que 2025 será um ano marcante para quem deseja ingressar na área de tecnologia.', 'assets/img/blog/6920a8544600e_1763747924.jpg', 2, 17, 'publicado', '2025-11-21 17:58:44', '2025-11-21 17:58:44', '2025-11-21 17:58:44'),
(8, 'Workshops sobre currículo e networking atraem jovens profissionais', 'Eventos presenciais e online focados no desenvolvimento de carreira têm ganhado enorme visibilidade entre jovens profissionais. Na última semana, uma série de workshops sobre elaboração de currículo, posicionamento profissional e estratégias de networking registrou o maior número de participantes dos últimos três anos.\r\n\r\nDurante os encontros, especialistas em recursos humanos e mentores experientes discutiram práticas modernas de construção de currículo, com ênfase em linguagem clara, apresentação visual e uso de palavras-chave alinhadas às exigências das empresas. Também foram realizadas dinâmicas de networking para ajudar os participantes a construir conexões estratégicas dentro do mercado.\r\n\r\nOrganizadores destacam que muitos jovens ainda enfrentam dificuldades em se destacar em processos seletivos altamente competitivos, e por isso os workshops buscam oferecer orientações práticas e ferramentas aplicáveis no dia a dia. Foram abordados temas como uso do LinkedIn, pitch pessoal, portfólios digitais e boas práticas durante entrevistas.\r\n\r\nA demanda crescente levou as instituições responsáveis a planejarem novos ciclos de eventos mensais. Para os jovens profissionais, as iniciativas representam uma oportunidade valiosa de aprimorar habilidades, ampliar contatos e aumentar suas chances de inserção no mercado de trabalho.', 'assets/img/blog/6920a896bced0_1763747990.jpg', 3, 17, 'publicado', '2025-11-21 17:59:50', '2025-11-21 17:59:50', '2025-11-21 17:59:50'),
(9, 'teste', 'testando', NULL, 2, 17, 'publicado', '2025-11-24 00:51:21', '2025-11-24 00:51:21', '2025-11-24 00:51:21'),
(10, 'teste 2', 'balaca', NULL, 1, 17, 'publicado', '2025-11-24 01:06:48', '2025-11-24 01:06:48', '2025-11-24 01:06:48'),
(11, 'teste 3', 'lalalalallalalala', NULL, 2, 17, 'publicado', '2025-11-24 01:23:21', '2025-11-24 01:23:21', '2025-11-24 01:23:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias_tags`
--

CREATE TABLE `noticias_tags` (
  `noticia_tag_id` int NOT NULL,
  `noticia_id` int NOT NULL,
  `tag_id` int NOT NULL,
  `data_associacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `noticias_tags`
--

INSERT INTO `noticias_tags` (`noticia_tag_id`, `noticia_id`, `tag_id`, `data_associacao`) VALUES
(8, 5, 1, '2025-11-21 17:58:01'),
(9, 5, 12, '2025-11-21 17:58:01'),
(10, 6, 3, '2025-11-21 17:58:44'),
(11, 6, 2, '2025-11-21 17:58:44'),
(12, 6, 4, '2025-11-21 17:58:44'),
(13, 6, 5, '2025-11-21 17:58:44'),
(18, 8, 7, '2025-11-21 17:59:50'),
(19, 8, 8, '2025-11-21 17:59:50'),
(20, 8, 9, '2025-11-21 17:59:50'),
(21, 8, 6, '2025-11-21 17:59:50'),
(22, 9, 5, '2025-11-24 00:51:21'),
(23, 9, 6, '2025-11-24 00:51:21'),
(24, 10, 4, '2025-11-24 01:06:48'),
(25, 10, 7, '2025-11-24 01:06:48'),
(26, 10, 8, '2025-11-24 01:06:48'),
(27, 11, 9, '2025-11-24 01:23:21');

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
(12, 'Programa de Pós-graduação em Ciência de Dados - 2026', 'Pós-graduação', 'Presencial', 'Rio de Janeiro', 'Ciência de Dados', '2025-07-01', '2025-12-31', 'https://universidadedigital.edu.br/pos-ciencia-dados', 'Aberto'),
(21, 'blablabla', 'Iniciação Científica', 'Presencial', 'Paraíba', 'Infraestrutura', '2025-11-16', '2025-11-17', 'https://www.youtube.com/', 'Fechado');

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
(3, 9, 16, 'aa', NULL, '2025-11-13 15:06:57', NULL, 1),
(4, 9, 16, 'hihihihihihi', 3, '2025-11-13 15:07:17', NULL, 1);

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

--
-- Despejando dados para a tabela `post_curtidas`
--

INSERT INTO `post_curtidas` (`curtida_id`, `post_id`, `usuario_id`, `data_curtida`) VALUES
(2, 10, 16, '2025-11-20 20:55:18'),
(4, 7, 16, '2025-11-20 21:32:33'),
(7, 13, 16, '2025-11-23 23:43:53'),
(8, 9, 16, '2025-11-23 23:43:58');

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
(3, 2, 15),
(4, 2, 16),
(14, 9, 17),
(15, 10, 22),
(16, 10, 23),
(17, 10, 24),
(19, 12, 26),
(20, 13, 27),
(22, 15, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tags`
--

CREATE TABLE `tags` (
  `tag_id` int NOT NULL,
  `nome_tag` varchar(50) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tags`
--

INSERT INTO `tags` (`tag_id`, `nome_tag`, `data_criacao`) VALUES
(1, 'IA', '2025-11-21 16:43:43'),
(2, 'FrontEnd', '2025-11-21 16:43:43'),
(3, 'BackEnd', '2025-11-21 16:43:43'),
(4, 'Estágio', '2025-11-21 16:43:43'),
(5, 'VagaTech', '2025-11-21 16:43:43'),
(6, 'Mentoria', '2025-11-21 16:43:43'),
(7, 'Networking', '2025-11-21 16:43:43'),
(8, 'Currículo', '2025-11-21 16:43:43'),
(9, 'Workshops', '2025-11-21 16:43:43'),
(10, 'Certificação', '2025-11-21 16:43:43'),
(11, 'Cursos Online', '2025-11-21 16:43:43'),
(12, 'Notícia', '2025-11-21 16:43:43'),
(13, 'Entrevista', '2025-11-21 16:43:43');

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
(15, 'Senha123456', 'sofiamuller1201@gmail.com', '$2y$10$jCsLTVTRP.O85o4dWd9yj.IaRlu0JsOliDVijFREsBNaHQJSMuHjK', 0, '2025-11-10 20:30:56'),
(16, 'Senha1310125', 'maria.silva@example.com', '$2y$10$gkZPCzvYELK56YYqV3KlxunrrWxSRtI2tmsAkBAxg1oBS5ZNZDBkS', 0, '2025-11-13 15:06:21'),
(17, 'Senha18112006', 'sofiamuller1111@gmail.com', '$2y$10$TqV01RAz0lBEGJAffT7fyeg9Toi6G3EOHPBtWIWN.PirFf9UGtbrq', 1, '2025-11-17 11:21:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_fotos`
--

CREATE TABLE `usuario_fotos` (
  `foto_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL,
  `caminho_arquivo` varchar(500) NOT NULL,
  `data_upload` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_atual` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario_fotos`
--

INSERT INTO `usuario_fotos` (`foto_id`, `usuario_id`, `nome_arquivo`, `caminho_arquivo`, `data_upload`, `is_atual`) VALUES
(1, 15, 'perfil_15_1763043143.png', '../uploads/fotos_perfil/perfil_15_1763043143.png', '2025-11-13 14:12:23', 0),
(2, 15, 'perfil_15_1763046344.jpeg', '../uploads/fotos_perfil/perfil_15_1763046344.jpeg', '2025-11-13 15:05:44', 1),
(3, 16, 'perfil_16_1763046408.jpg', '../uploads/fotos_perfil/perfil_16_1763046408.jpg', '2025-11-13 15:06:48', 0),
(4, 16, 'perfil_16_1763381436.jpg', '../uploads/fotos_perfil/perfil_16_1763381436.jpg', '2025-11-17 12:10:36', 1),
(5, 17, 'perfil_17_1763381538.jpg', '../uploads/fotos_perfil/perfil_17_1763381538.jpg', '2025-11-17 12:12:18', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

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
-- Índices de tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`noticia_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `autor_id` (`autor_id`);

--
-- Índices de tabela `noticias_tags`
--
ALTER TABLE `noticias_tags`
  ADD PRIMARY KEY (`noticia_tag_id`),
  ADD UNIQUE KEY `unique_noticia_tag` (`noticia_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

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
-- Índices de tabela `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `nome_tag` (`nome_tag`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `usuario_fotos`
--
ALTER TABLE `usuario_fotos`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `comentario_curtidas`
--
ALTER TABLE `comentario_curtidas`
  MODIFY `curtida_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `forum_tags`
--
ALTER TABLE `forum_tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `noticia_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `noticias_tags`
--
ALTER TABLE `noticias_tags`
  MODIFY `noticia_tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  MODIFY `id_oportunidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `posts_salvos`
--
ALTER TABLE `posts_salvos`
  MODIFY `salvamento_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `post_comentarios`
--
ALTER TABLE `post_comentarios`
  MODIFY `comentario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `post_curtidas`
--
ALTER TABLE `post_curtidas`
  MODIFY `curtida_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `post_tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuario_fotos`
--
ALTER TABLE `usuario_fotos`
  MODIFY `foto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Restrições para tabelas `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`),
  ADD CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Restrições para tabelas `noticias_tags`
--
ALTER TABLE `noticias_tags`
  ADD CONSTRAINT `noticias_tags_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`noticia_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `noticias_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;

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

--
-- Restrições para tabelas `usuario_fotos`
--
ALTER TABLE `usuario_fotos`
  ADD CONSTRAINT `usuario_fotos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
