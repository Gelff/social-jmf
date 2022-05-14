-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Maio-2022 às 00:27
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
  `status` tinyint(4) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `amigos`
--

INSERT INTO `amigos` (`pessoa1`, `pessoa2`, `status`, `id`) VALUES
(48, 44, 1, 36),
(44, 48, 1, 37);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `midia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
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
(44, 'Geronimo', 'Neto', 'geronimo@gmail.com', 'Z2VsZmZnZWxmZjAwMQ==', 0, 0, 'Sat, 14 May 22 21:48:12 +0200'),
(48, 'Admin', 'Admin', 'admin@gmail.com', 'MTIzNDU2Nzg=', 0, 0, 'Sat, 14 May 22 23:58:28 +0200');

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
(45, 172, 44);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(4) NOT NULL,
  `macaddr` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`token`, `data`, `type`, `macaddr`, `datetime`) VALUES
('87bda2750c425471aa795969ef2c3750', '2022-05-14 16:46:08', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 16:47:00', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 16:48:54', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 16:55:29', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 16:56:10', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 17:26:04', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 18:00:32', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 18:00:52', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 18:06:15', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:27'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:07:56', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:07:56'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:12:15', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:12:15'),
('d1ca18cecaa470117672980092647dfe', '2022-05-14 18:12:40', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:12:40'),
('d1ca18cecaa470117672980092647dfe', '2022-05-14 18:16:10', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:16:10'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:16:32', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:16:32'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:18:49', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:18:49'),
('d1ca18cecaa470117672980092647dfe', '2022-05-14 18:26:17', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:26:17'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:27:14', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:27:14'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:27:31', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:27:31'),
('d1ca18cecaa470117672980092647dfe', '2022-05-14 18:34:14', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:34:14'),
('1450ac4f6a279fe0d3c0341f6b53e2d5', '2022-05-14 18:34:55', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:34:55'),
('1450ac4f6a279fe0d3c0341f6b53e2d5', '2022-05-14 18:36:42', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:36:42'),
('3f009d72559f51e7e454b16e5d0687a1', '2022-05-14 18:39:37', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:39:37'),
('3f009d72559f51e7e454b16e5d0687a1', '2022-05-14 18:39:51', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:39:51'),
('70b03db954aa45fc2559e85f5d5bd13e', '2022-05-14 18:40:12', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:40:12'),
('70b03db954aa45fc2559e85f5d5bd13e', '2022-05-14 18:45:57', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:45:57'),
('3f009d72559f51e7e454b16e5d0687a1', '2022-05-14 18:48:35', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:48:35'),
('3f009d72559f51e7e454b16e5d0687a1', '2022-05-14 18:48:49', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:48:49'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:51:40', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:51:40'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 18:58:01', 0, '12-02-F8-0F-DD-D8', '2022-05-14 18:58:01'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 18:58:52', 1, '12-02-F8-0F-DD-D8', '2022-05-14 18:58:52'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 19:09:45', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:09:45'),
('d41d8cd98f00b204e9800998ecf8427e', '2022-05-14 19:09:46', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:09:46'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 19:10:11', 1, '12-02-F8-0F-DD-D8', '2022-05-14 19:10:11'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 19:10:31', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:10:31'),
('d41d8cd98f00b204e9800998ecf8427e', '2022-05-14 19:10:32', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:10:32'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 19:10:40', 1, '12-02-F8-0F-DD-D8', '2022-05-14 19:10:40'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 19:11:11', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:11:11'),
('d41d8cd98f00b204e9800998ecf8427e', '2022-05-14 19:11:12', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:11:12'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 19:11:32', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:11:32'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 19:24:58', 1, '12-02-F8-0F-DD-D8', '2022-05-14 19:24:58'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 19:27:01', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:27:01');

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
(44, '', '91277368c0f1df9f9f61dc6d15a41173.jpg', 'bom dia sdfaasdfasd', 'inf3', '91277368c0f1df9f9f61dc6d15a41173.jpg'),
(48, '', 'capa.png', 'Escreva algo legal :)', 'none', 'h1.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

CREATE TABLE `publicacoes` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
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
(172, '2022-05-14 18:12:11', 'nil', 'ola ola', 2, 0, 0, 0, 44, 44),
(175, '2022-05-14 19:03:08', 'nil', 'asdfasdf', 0, 0, 0, 0, 44, 44),
(176, '2022-05-14 19:03:13', '7c49980c0cf728459c884c035c308ea0.jpg', 'asdf', 0, 0, 0, 0, 44, 44);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `manutencao` tinyint(4) NOT NULL,
  `onlines` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`manutencao`, `onlines`, `id`) VALUES
(0, 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
