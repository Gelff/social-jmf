-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Maio-2022 às 09:10
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `snjmf`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amigos`
--

CREATE TABLE `amigos` (
  `pessoa1` int(11) NOT NULL,
  `pessoa2` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `idConta` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobrenome` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `verificado` tinyint(4) NOT NULL,
  `criacao` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`id`, `nome`, `sobrenome`, `email`, `senha`, `status`, `verificado`, `criacao`) VALUES
(17, 'Geronimo', 'Neto', 'geronimo@gmail.com', 'MTIz', 1, 1, 'Sun, 01 May 22 00:27:56 +0200'),
(20, 'Camila', 'Pedro', 'gg@gmail.com', 'MTIz', 0, 0, 'Sun, 01 May 22 01:48:31 +0200'),
(21, 'Meu', 'Telefone', 'mobile@gmail.com', 'MTIz', 0, 0, 'Sun, 01 May 22 02:42:27 +0200'),
(22, 'Teste ', 'Teste', 'teste@teste.teste.te', 'dGVzdGU=', 0, 0, 'Sun, 01 May 22 02:59:41 +0200'),
(23, 'Leticiaa', 'Moura', 'leticialindaa@gmail.com', 'MTIz', 0, 0, 'Sun, 01 May 22 03:18:21 +0200'),
(24, 'Esquerci', 'Senha', 'esquerciasenha@gmail.com', 'MTIzNA==', 0, 0, 'Sun, 01 May 22 03:19:37 +0200'),
(25, 'Lídia ', 'Almeida ', 'lidiaalmeidaw@gmail.com', 'amVzdXNjcmlzdG8uY29tMDA=', 0, 0, 'Sun, 01 May 22 03:42:23 +0200');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `apelido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capa` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biografia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `turma` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `apelido`, `capa`, `biografia`, `turma`, `foto`) VALUES
(17, 'cumia', '/content/img/capas/capa.png', 'Oi tudo bom 😒👌', 'Turma', '9452eacb4debf75dd9af48dab8546aba.jpg'),
(20, '', '/content/img/capas/capa.png', 'minha bio', 'Turma', 'nil.png'),
(21, '', '/content/img/capas/capa.png', '', 'Turma', 'nil.png'),
(22, '', '/content/img/capas/capa.png', 'Picture a book', 'Turma', 'nil.png'),
(23, '', '/content/img/capas/capa.png', '', 'Turma', 'nil.png'),
(24, '', '/content/img/capas/capa.png', '', 'Turma', 'nil.png'),
(25, '', '/content/img/capas/capa.png', '🤡', 'Turma', 'nil.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

CREATE TABLE `publicacoes` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `midia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `privacidade` int(11) NOT NULL DEFAULT 0,
  `reacoes` int(11) NOT NULL DEFAULT 0,
  `denuncias` int(11) NOT NULL DEFAULT 0,
  `idConta` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`id`, `data`, `midia`, `texto`, `likes`, `privacidade`, `reacoes`, `denuncias`, `idConta`, `idPerfil`) VALUES
(83, '2022-04-30', '', 'teste aa', 0, 0, 0, 0, 17, 20),
(84, '2022-04-30', '', 'Kklkkklk q legalllll', 0, 0, 0, 0, 25, 25),
(85, '2022-04-30', '', 'Kklkkklk q legalllll', 0, 0, 0, 0, 25, 25),
(86, '2022-04-30', '', 'Kklkkklk q legalllll', 0, 0, 0, 0, 25, 25),
(87, '2022-04-30', '', 'zap zip', 0, 0, 0, 0, 17, 20),
(88, '2022-04-30', '', 'Kklkkklk q legalllll', 0, 0, 0, 0, 25, 25),
(89, '2022-04-30', '', 'em nad', 0, 0, 0, 0, 21, 21),
(91, '2022-04-30', '', 'kkkk biruta', 0, 0, 0, 0, 17, 23),
(92, '2022-04-30', '', 'aa bbbds', 0, 0, 0, 0, 17, 20),
(93, '2022-04-30', '', 'quem é', 0, 0, 0, 0, 17, 20),
(100, '2022-05-01', '', 'boa noitinha', 0, 0, 0, 0, 17, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `manutencao` tinyint(4) NOT NULL,
  `ativos` int(11) NOT NULL,
  `inativos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
