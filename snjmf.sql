-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Maio-2022 às 01:58
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
-- Estrutura da tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `midia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
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
(17, 'Geronimo', 'Neto', 'geronimo@gmail.com', 'MTIz', 1, 0, 'Sun, 01 May 22 00:27:56 +0200'),
(20, 'Camila', 'Pedro', 'gg@gmail.com', 'MTIz', 0, 0, 'Sun, 01 May 22 01:48:31 +0200'),
(21, 'Administrador', 'Supremo', 'mobile@gmail.com', 'MTIz', 0, 0, 'Sun, 01 May 22 02:42:27 +0200'),
(22, 'Thiago', 'Augusto', 'teste@teste.teste.te', 'dGVzdGU=', 1, 0, 'Sun, 01 May 22 02:59:41 +0200'),
(23, 'Leticiaa', 'Moura', 'leticialindaa@gmail.com', 'MTIz', 0, 0, 'Sun, 01 May 22 03:18:21 +0200'),
(24, 'Lula', 'Honesto', 'esquerciasenha@gmail.com', 'MTIzNA==', 1, 0, 'Sun, 01 May 22 03:19:37 +0200'),
(25, 'Lídia ', 'Almeida ', 'lidiaalmeidaw@gmail.com', 'amVzdXNjcmlzdG8uY29tMDA=', 0, 0, 'Sun, 01 May 22 03:42:23 +0200'),
(26, 'Gaby', 'Schneider', 'gabykkj@gmail.com', 'MDk4NzY1NDMyMQ==', 0, 0, 'Sun, 08 May 22 01:41:03 +0200'),
(27, 'tioe', 'ticole', 'newcon@gmail.com', 'MTIz', 0, 0, 'Sun, 08 May 22 01:50:53 +0200');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id` int(11) NOT NULL,
  `idPub` int(11) NOT NULL,
  `idConta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `curtidas`
--

INSERT INTO `curtidas` (`id`, `idPub`, `idConta`) VALUES
(11, 149, 17),
(13, 148, 17),
(15, 147, 17),
(16, 151, 21),
(17, 149, 21),
(19, 148, 21),
(21, 150, 21),
(22, 147, 21);

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
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(4) NOT NULL,
  `macaddr` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`token`, `data`, `type`, `macaddr`) VALUES
('geronimo@gmail.com', '2022-05-07', 1, ''),
('geronimo@gmail.com', '2022-05-07', 1, '::1'),
('geronimo@gmail.com', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('geronimo@gmail.com', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('mobile@gmail.com', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('b58e7f4aacaa992fa8ee8dc670d23923', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('71fc8cafd7bfeb4aa7e0dcce50583503', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('b58e7f4aacaa992fa8ee8dc670d23923', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('8050c44288d8831417d8d37ddb9f64aa', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('8050c44288d8831417d8d37ddb9f64aa', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('8050c44288d8831417d8d37ddb9f64aa', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('8050c44288d8831417d8d37ddb9f64aa', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('c331b13453204942e7bf573728cd0d63', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('07c942f36728e337594ab76f65ef335f', '2022-05-07', 1, '12-02-F8-0F-DD-D8'),
('07c942f36728e337594ab76f65ef335f', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 0, '12-02-F8-0F-DD-D8'),
('87bda2750c425471aa795969ef2c3750', '2022-05-07', 1, '12-02-F8-0F-DD-D8');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `apelido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capa` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biografia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `turma` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `apelido`, `capa`, `biografia`, `turma`, `foto`) VALUES
(17, 'cumia', '9452eacb4debf75dd9af48dab8546aba.jpg', 'ナイトメア Nightmare', 'inf3', '9452eacb4debf75dd9af48dab8546aba.jpg'),
(20, '', 'capa.png', 'minha bio', 'none', 'nil.png'),
(21, '', '1a56d88146ca93ff2ec717bd7f40eb9f.jpg', 'Sic Mundus Creatus Est', 'enf3', '1a56d88146ca93ff2ec717bd7f40eb9f.jpg'),
(22, '', 'capa.png', 'Picture a book', 'none', '6ec44141a8c1d396d7c388a24ee62f54.jpg'),
(23, '', 'capa.png', '', 'none', 'nil.png'),
(24, '', 'capa.png', 'VOTE 13', 'inf3', 'cb554fb291f796b2f9fab21447fd5a62.jpg'),
(25, '', 'capa.png', 'Hello =D', 'inf3', 'c658eb1818ad2779ed1ae0daf442f81a.jpg'),
(26, '', 'capa.png', 'x_x', 'inf1', 'cb86f7099aa10cf7aec6d9fdcc3b16a0.jpg'),
(27, '', 'capa.png', 'Escreva algo legal :)', 'none', 'nil.png');

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
(141, '2022-05-07', '9da6a5d7d942d178ff1302cf79b47282.jpg', 'The batman', 0, 0, 0, 0, 17, 17),
(142, '2022-05-07', 'a078401b51f247f2667fbbf8421c95ec.jpg', 'cosplay de sonic fdskkk', 0, 0, 0, 0, 17, 17),
(143, '2022-05-07', '5af1ac15e51d1c6e536b44453c1a6ee8.jpg', 'amogus pew pew', 0, 0, 0, 0, 17, 17),
(147, '2022-05-07', 'nil', 'Pensando na morte da Bezerra...', 2, 0, 0, 0, 25, 25),
(148, '2022-05-07', 'a65a2428eb5829d3ab03d81e80a5b805.jpg', 'paiasaasdoasodska', 2, 0, 0, 0, 17, 17),
(149, '2022-05-07', 'nil', 'ar condicionado ', 2, 0, 0, 0, 17, 17),
(150, '2022-05-07', 'c36b794d1691bf1adb9fe109cf89e294.jpg', 'rias', 1, 0, 0, 0, 17, 17),
(151, '2022-05-07', 'bd3c88111b2961f6990c40f99572e42f.jpg', 'Matrix', 1, 0, 0, 0, 21, 21);

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
-- Índices para tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `curtidas`
--
ALTER TABLE `curtidas`
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
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
