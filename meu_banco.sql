-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 27/11/2025 às 00:55
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

--
-- Despejando dados para a tabela `comentario_curtidas`
--

INSERT INTO `comentario_curtidas` (`curtida_id`, `comentario_id`, `usuario_id`, `data_curtida`) VALUES
(5, 8, 21, '2025-11-24 20:09:37');

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
(16, 20, 'Como organizar seus estudos para tecnologia sem surtar', 'Estudar programação pode ser assustador no começo, especialmente quando tudo parece importante. A chave é organização. Neste post, mostro métodos simples para estudar sem se estressar: usar Pomodoro, alternar teoria e prática, não tentar aprender tudo de uma vez e acompanhar conteúdos confiáveis. Disciplina constante > estudar 10 horas num único dia.', '2025-11-24 20:04:04', NULL, 1),
(17, 20, 'Front-end em 2025: vale a pena aprender React ainda?', 'Com tantas novas bibliotecas surgindo, como Solid, Qwik e Svelte, vocês acham que React continua sendo a melhor opção para iniciantes? Estou começando agora no front-end e não sei por onde ir.', '2025-11-24 20:07:58', NULL, 1),
(18, 21, 'Qual o maior erro de iniciantes em segurança digital?', 'Estou começando a estudar cibersegurança e queria saber de quem já tem experiência: qual o erro mais comum que quem está iniciando costuma cometer?', '2025-11-24 20:10:08', NULL, 1),
(19, 23, 'Vale a pena montar seu próprio PC em 2025?', 'Estou pensando em montar um PC do zero, mas percebi que alguns computadores pré-montados estão com preços competitivos. Ainda compensa customizar tudo?', '2025-11-24 20:14:42', NULL, 1);

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
(26, 'jsBB', NULL, '2025-11-23 23:38:50'),
(27, 'nTaFuncionando', NULL, '2025-11-23 23:41:05'),
(28, 'testeIncludeJS', NULL, '2025-11-23 23:44:38'),
(29, 'estudos', NULL, '2025-11-24 20:04:04'),
(30, 'programação', NULL, '2025-11-24 20:04:04'),
(31, 'organização', NULL, '2025-11-24 20:04:04'),
(32, 'produtividade', NULL, '2025-11-24 20:04:04'),
(33, 'motivação', NULL, '2025-11-24 20:04:04'),
(34, 'front-end', NULL, '2025-11-24 20:07:58'),
(35, 'web', NULL, '2025-11-24 20:07:58'),
(36, 'segurança', NULL, '2025-11-24 20:10:08'),
(37, 'cibersegurança', NULL, '2025-11-24 20:10:08'),
(38, 'hacking', NULL, '2025-11-24 20:10:08'),
(39, 'iniciantes', NULL, '2025-11-24 20:10:08'),
(40, 'hardware', NULL, '2025-11-24 20:14:42'),
(41, 'pc', NULL, '2025-11-24 20:14:42'),
(42, 'eletrônica', NULL, '2025-11-24 20:14:42'),
(43, 'montagem', NULL, '2025-11-24 20:14:42');

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
(13, 'Mercado Tech Abre 28 Mil Novas Vagas no Brasil em 2025: Áreas de Back-End e IA São Destaques', 'O setor de tecnologia brasileiro iniciou 2025 com força total. De acordo com dados divulgados pela Associação Brasileira das Empresas de TI (Brasscom), mais de 28 mil novas vagas foram abertas apenas no primeiro trimestre do ano, com destaque para as áreas de desenvolvimento back-end, ciência de dados e Inteligência Artificial.\r\n\r\nEmpresas de médio e grande porte estão ampliando seus times devido ao avanço da digitalização e da adoção de soluções em nuvem. Profissionais com habilidades em Python, Java, SQL, APIs e modelagem de IA estão entre os mais procurados. Além disso, vagas voltadas a segurança digital registraram crescimento de 41%, reflexo da preocupação crescente com ataques cibernéticos.\r\n\r\nOutro ponto relevante é a alta demanda por estagiários e trainees, especialmente em empresas que buscam desenvolver talentos internamente. Programas de capacitação gratuita e bootcamps também estão espalhados pelo país, democratizando o acesso à formação tecnológica.\r\n\r\nEspecialistas afirmam que o momento é oportuno para quem deseja iniciar ou migrar para a área de tecnologia. O mercado, antes concentrado em grandes capitais, agora se expande para cidades médias e permite trabalho remoto — ampliando possibilidades para profissionais de diferentes regiões.', 'assets/img/blog/6924be03bab3f_1764015619.png', 2, 19, 'publicado', '2025-11-24 20:20:19', '2025-11-24 20:20:19', '2025-11-24 20:20:19'),
(14, 'IA Generativa Revoluciona o Mercado: Novas Ferramentas Prometem Automatizar 60% das Tarefas Digitais Até 2030', 'O avanço acelerado da Inteligência Artificial generativa está transformando profundamente a maneira como profissionais interagem com a tecnologia. Estudos recentes indicam que, até 2030, cerca de 60% das tarefas digitais poderão ser totalmente automatizadas, abrindo caminho para um novo cenário de produtividade e inovação.\r\n\r\nGrandes empresas de tecnologia anunciaram lançamentos de modelos de IA mais eficientes, capazes de executar desde análises de dados complexas até criação de conteúdo multimídia em poucos segundos. Além disso, o uso em áreas como saúde, educação e atendimento ao cliente está crescendo rapidamente, graças à capacidade da IA de interpretar informações e fornecer respostas cada vez mais precisas.\r\n\r\nApesar dos avanços, especialistas alertam para a necessidade de regulamentação e preparo profissional. A automação pode trazer benefícios significativos, mas também exige adaptação, especialmente na formação de novos talentos e na requalificação de trabalhadores que atuarão lado a lado com sistemas inteligentes.\r\n\r\nA expectativa é que nos próximos anos surja uma nova onda de profissões híbridas, combinando criatividade humana e eficiência algorítmica. O debate sobre ética, transparência e uso responsável da IA também cresce, reforçando a importância de desenvolver tecnologias alinhadas aos valores sociais.', 'assets/img/blog/6924be4aafc94_1764015690.jpg', 1, 19, 'publicado', '2025-11-24 20:21:30', '2025-11-24 20:21:30', '2025-11-24 20:21:30'),
(15, 'Maior Evento de Tecnologia da América Latina Reúne 50 Mil Participantes e Anuncia Novas Tendências para 2025', 'A edição mais recente de um dos maiores eventos de tecnologia da América Latina reuniu mais de 50 mil participantes entre estudantes, profissionais, pesquisadores e grandes empresas do setor. O encontro trouxe palestras sobre Inteligência Artificial, segurança cibernética, computação em nuvem, saúde digital e tendências para o futuro do trabalho.\r\n\r\nEntre as principais novidades apresentadas estão novos modelos de IA multimodal, ferramentas avançadas de automação empresarial e dispositivos de realidade aumentada com foco em educação. Workshops práticos, hackathons e painéis de networking também foram destaques.\r\n\r\nO evento reforçou a importância da troca de conhecimento e da criação de oportunidades para jovens talentos. Empresas parceiras anunciaram vagas, bolsas de estudo e programas de aceleração para startups iniciantes.\r\n\r\nA expectativa é que, nos próximos anos, o evento continue crescendo e fortalecendo o ecossistema tecnológico brasileiro.', 'assets/img/blog/6924bec30b72e_1764015811.png', 5, 19, 'publicado', '2025-11-24 20:23:31', '2025-11-24 20:23:31', '2025-11-24 20:23:31');

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
(30, 13, 3, '2025-11-24 20:20:19'),
(31, 13, 4, '2025-11-24 20:20:19'),
(32, 13, 8, '2025-11-24 20:20:19'),
(33, 13, 5, '2025-11-24 20:20:19'),
(34, 14, 1, '2025-11-24 20:21:30'),
(35, 14, 12, '2025-11-24 20:21:30'),
(36, 15, 7, '2025-11-24 20:23:31'),
(37, 15, 9, '2025-11-24 20:23:31'),
(38, 15, 12, '2025-11-24 20:23:31');

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
(26, 'teste de estatística ', 'Iniciação Científica', 'Online', 'Bahia', 'Desenvolvimento Front-End', '2025-11-11', '2025-11-26', 'https://www.fundatec.org.br/portal/concursos/index_concursos.php?concurso=1014', 'Aberto');

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
(8, 17, 21, 'React ainda domina o mercado, mas conhecer pelo menos um dos novos frameworks pode ser um diferencial. Eu começaria nele mesmo e depois expandiria.', NULL, '2025-11-24 20:09:32', NULL, 1),
(9, 18, 22, 'Achar que hacking é só ferramenta. Na real, entender redes e sistemas é muito mais importante.', NULL, '2025-11-24 20:11:45', NULL, 1),
(10, 17, 22, 'Solid e Svelte estão crescendo muito, mas React ainda tem a melhor comunidade e mais vagas. Depende do seu objetivo.', NULL, '2025-11-24 20:12:07', NULL, 1),
(11, 19, 19, 'Se não entende muito, os pré-montados podem ser uma opção segura. Mas customizar sempre dá mais liberdade.', NULL, '2025-11-24 20:15:21', NULL, 1),
(12, 18, 19, 'Outro erro é focar em invasão antes de aprender defesa. O básico de segurança é o que mais evita problemas reais.', 9, '2025-11-24 20:15:51', NULL, 1);

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
(9, 16, 20, '2025-11-24 20:04:19'),
(10, 17, 20, '2025-11-24 20:08:02'),
(11, 17, 21, '2025-11-24 20:09:22'),
(12, 19, 19, '2025-11-24 20:15:24'),
(13, 17, 19, '2025-11-24 20:15:29'),
(14, 16, 19, '2025-11-24 20:15:33'),
(15, 18, 19, '2025-11-24 20:15:35');

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
(23, 16, 29),
(24, 16, 30),
(25, 16, 31),
(26, 16, 32),
(27, 16, 33),
(29, 17, 7),
(30, 17, 30),
(28, 17, 34),
(31, 17, 35),
(32, 18, 36),
(33, 18, 37),
(34, 18, 38),
(35, 18, 39),
(36, 19, 40),
(37, 19, 41),
(38, 19, 42),
(39, 19, 43);

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
(19, 'SheInnovatesModerator', 'sheInnovatesMOD1@gmail.com', '$2y$10$WOn1tvuSRrIunZOu6CwoheSclnCsDpfzIgzd0yfjtIv1aRn0QLk76', 1, '2025-11-24 19:48:36'),
(20, 'astroWaveS2', 'astro.wave2@outlook.com', '$2y$10$xY5LpmcjLo.rQkQgFJurAOzHHFhvtnC8lFeh6Is4/hyuMFBI34lxa', 0, '2025-11-24 19:50:52'),
(21, 'cyberBloom', 'c.bloom92@gmail.com', '$2y$10$TxJV4DPSMki5.lVOk72bjuHinyF3ZGQUyiSVPYLUdTGy9E5oRwChu', 0, '2025-11-24 19:51:27'),
(22, 'lunaTech47', 'lunatech47@gmail.com', '$2y$10$ABbPbRys7pl.NCXGI8DIKOAsi75YINKwjrxGsmENJMJBhTAOihIdC', 0, '2025-11-24 19:51:58'),
(23, 'neonRiverS2', 'neon.river8@gmail.com', '$2y$10$mRaxy4Txk4Ua7GcwYSotuuAdpIGJJ2510p18mi7HL22wUkXRT8OBm', 0, '2025-11-24 19:52:57');

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
(7, 19, 'perfil_19_1764014379.jpeg', '../uploads/fotos_perfil/perfil_19_1764014379.jpeg', '2025-11-24 19:59:39', 1),
(8, 20, 'perfil_20_1764014608.jpeg', '../uploads/fotos_perfil/perfil_20_1764014608.jpeg', '2025-11-24 20:03:28', 0),
(9, 21, 'perfil_21_1764014951.jpeg', '../uploads/fotos_perfil/perfil_21_1764014951.jpeg', '2025-11-24 20:09:11', 1),
(10, 22, 'perfil_22_1764015083.jpeg', '../uploads/fotos_perfil/perfil_22_1764015083.jpeg', '2025-11-24 20:11:23', 1),
(11, 23, 'perfil_23_1764015242.jpg', '../uploads/fotos_perfil/perfil_23_1764015242.jpg', '2025-11-24 20:14:02', 1),
(12, 20, 'perfil_20_1764183231.jpeg', '../uploads/fotos_perfil/perfil_20_1764183231.jpeg', '2025-11-26 18:53:51', 0),
(13, 20, 'perfil_20_1764183242.jpeg', '../uploads/fotos_perfil/perfil_20_1764183242.jpeg', '2025-11-26 18:54:02', 0),
(14, 20, 'perfil_20_1764183259.jpeg', '../uploads/fotos_perfil/perfil_20_1764183259.jpeg', '2025-11-26 18:54:19', 1);

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
  MODIFY `curtida_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `forum_tags`
--
ALTER TABLE `forum_tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `noticia_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `noticias_tags`
--
ALTER TABLE `noticias_tags`
  MODIFY `noticia_tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  MODIFY `id_oportunidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `post_comentarios`
--
ALTER TABLE `post_comentarios`
  MODIFY `comentario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `post_curtidas`
--
ALTER TABLE `post_curtidas`
  MODIFY `curtida_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `post_tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `usuario_fotos`
--
ALTER TABLE `usuario_fotos`
  MODIFY `foto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
