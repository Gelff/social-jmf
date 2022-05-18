-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Maio-2022 às 02:55
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
(44, 48, 1, 37),
(50, 49, 1, 38),
(50, 48, 1, 39),
(50, 44, 1, 40),
(44, 49, 1, 41),
(44, 50, 1, 42);

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
  `likes` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL,
  `idPub` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `idConta`, `texto`, `likes`, `idPerfil`, `idPub`, `datetime`) VALUES
(31, '44', 'oi', 0, 48, 211, '2022-05-15 13:47:52'),
(32, '44', 'aiai kkj', 0, 44, 207, '2022-05-15 13:48:02'),
(33, '48', 'ola', 0, 48, 211, '2022-05-15 13:48:37'),
(34, '48', 'Ola', 0, 44, 207, '2022-05-15 13:49:16'),
(35, '50', 'auau', 0, 50, 218, '2022-05-15 13:56:21'),
(36, '50', 'Baitingas', 0, 48, 211, '2022-05-15 13:57:29'),
(37, '50', 'nao', 0, 48, 204, '2022-05-15 13:58:06'),
(38, '50', 'aaaa', 0, 44, 207, '2022-05-15 13:58:27'),
(39, '44', 'Doida', 0, 49, 219, '2022-05-15 14:37:54'),
(40, '44', 'nha', 0, 44, 201, '2022-05-15 19:25:10'),
(41, '44', 'miau', 0, 44, 201, '2022-05-15 19:41:30'),
(42, '44', 'aaaaaaaaaasdfas', 0, 44, 201, '2022-05-15 20:07:41'),
(43, '44', 'adfas dfasdf', 0, 44, 201, '2022-05-15 20:07:46'),
(44, '44', 'aa', 0, 44, 203, '2022-05-17 21:33:47'),
(45, '44', 'Dida', 0, 49, 219, '2022-05-17 21:41:50'),
(46, '44', 'Biruta', 0, 49, 219, '2022-05-17 21:41:53'),
(47, '44', 'Bocó', 0, 49, 219, '2022-05-17 21:41:56'),
(48, '44', '😒👌', 0, 49, 219, '2022-05-17 21:42:09'),
(49, '44', '🎈', 0, 49, 219, '2022-05-17 21:42:53'),
(50, '44', '[][][][][][]', 0, 49, 219, '2022-05-17 21:43:04'),
(51, '44', 'kj', 0, 49, 219, '2022-05-17 21:43:09'),
(52, '44', 'kjjh', 0, 49, 219, '2022-05-17 21:43:09'),
(53, '44', '23', 0, 49, 219, '2022-05-17 21:43:17');

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
(48, 'Admin', 'Presente', 'admin@gmail.com', 'MTIzNDU2Nzg=', 0, 1, 'Sat, 14 May 22 23:58:28 +0200'),
(49, 'Leticia', 'Moura', 'leticia@gmail.com', 'MTIzNDU2Nzg=', 0, 0, 'Sun, 15 May 22 18:40:06 +0200'),
(50, 'Mesa', 'Quadrada', 'mesa@gmail.com', 'MTIzNDU2Nzg=', 0, 0, 'Sun, 15 May 22 18:54:51 +0200');

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
(45, 172, 44),
(46, 205, 48),
(47, 203, 48),
(48, 206, 44),
(49, 207, 48),
(50, 207, 44),
(51, 211, 50),
(52, 207, 50),
(54, 219, 44),
(64, 203, 44),
(65, 202, 44),
(66, 201, 44),
(67, 200, 44);

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
('87bda2750c425471aa795969ef2c3750', '2022-05-14 19:27:01', 0, '12-02-F8-0F-DD-D8', '2022-05-14 19:27:01'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 21:07:49', 1, '12-02-F8-0F-DD-D8', '2022-05-14 21:07:49'),
('87bda2750c425471aa795969ef2c3750', '2022-05-14 21:52:42', 0, '12-02-F8-0F-DD-D8', '2022-05-14 21:52:42'),
('0ccd57151d16316e2f7b559451fa74d0', '2022-05-14 21:52:53', 1, '12-02-F8-0F-DD-D8', '2022-05-14 21:52:53'),
('0ccd57151d16316e2f7b559451fa74d0', '2022-05-14 23:12:55', 1, '12-02-F8-0F-DD-D8', '2022-05-14 23:12:55'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 23:35:07', 1, '12-02-F8-0F-DD-D8', '2022-05-14 23:35:07'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-14 23:43:41', 0, '12-02-F8-0F-DD-D8', '2022-05-14 23:43:41'),
('0ccd57151d16316e2f7b559451fa74d0', '2022-05-15 00:04:11', 0, '12-02-F8-0F-DD-D8', '2022-05-15 00:04:11'),
('0ccd57151d16316e2f7b559451fa74d0', '2022-05-15 10:46:16', 1, '12-02-F8-0F-DD-D8', '2022-05-15 10:46:16'),
('0ccd57151d16316e2f7b559451fa74d0', '2022-05-15 10:47:36', 0, '12-02-F8-0F-DD-D8', '2022-05-15 10:47:36'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-15 10:50:26', 1, '12-02-F8-0F-DD-D8', '2022-05-15 10:50:26'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-15 12:41:34', 0, '12-02-F8-0F-DD-D8', '2022-05-15 12:41:34'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 12:41:54', 1, '12-02-F8-0F-DD-D8', '2022-05-15 12:41:54'),
('5d12046b9f3c36558fbe2ddded0f1278', '2022-05-15 13:40:34', 1, '12-02-F8-0F-DD-D8', '2022-05-15 13:40:34'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-15 13:48:31', 1, '12-02-F8-0F-DD-D8', '2022-05-15 13:48:31'),
('6823866ace2a7b75da481cd3d2952952', '2022-05-15 13:55:07', 1, '12-02-F8-0F-DD-D8', '2022-05-15 13:55:07'),
('6823866ace2a7b75da481cd3d2952952', '2022-05-15 13:59:25', 0, '12-02-F8-0F-DD-D8', '2022-05-15 13:59:25'),
('75d23af433e0cea4c0e45a56dba18b30', '2022-05-15 14:00:01', 0, '12-02-F8-0F-DD-D8', '2022-05-15 14:00:01'),
('5d12046b9f3c36558fbe2ddded0f1278', '2022-05-15 14:03:02', 1, '12-02-F8-0F-DD-D8', '2022-05-15 14:03:02'),
('5d12046b9f3c36558fbe2ddded0f1278', '2022-05-15 14:03:28', 0, '12-02-F8-0F-DD-D8', '2022-05-15 14:03:28'),
('5d12046b9f3c36558fbe2ddded0f1278', '2022-05-15 14:03:36', 1, '12-02-F8-0F-DD-D8', '2022-05-15 14:03:36'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 14:04:23', 0, '12-02-F8-0F-DD-D8', '2022-05-15 14:04:23'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 14:37:42', 1, '12-02-F8-0F-DD-D8', '2022-05-15 14:37:42'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 14:38:37', 0, '12-02-F8-0F-DD-D8', '2022-05-15 14:38:37'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 19:01:52', 1, '12-02-F8-0F-DD-D8', '2022-05-15 19:01:52'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 19:59:48', 0, '12-02-F8-0F-DD-D8', '2022-05-15 19:59:48'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 20:02:06', 1, '12-02-F8-0F-DD-D8', '2022-05-15 20:02:06'),
('87bda2750c425471aa795969ef2c3750', '2022-05-15 20:18:35', 0, '12-02-F8-0F-DD-D8', '2022-05-15 20:18:35'),
('87bda2750c425471aa795969ef2c3750', '2022-05-17 21:32:26', 1, '12-02-F8-0F-DD-D8', '2022-05-17 21:32:26'),
('87bda2750c425471aa795969ef2c3750', '2022-05-17 21:53:37', 0, '12-02-F8-0F-DD-D8', '2022-05-17 21:53:37');

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
(44, '', 'aeb2ce46ef889016c9f12adc9f409d1f.jpg', 'bom dia', 'adm2', 'aeb2ce46ef889016c9f12adc9f409d1f.jpg'),
(48, '', '1fecf073b98db40397dfdfcd4772d79b.jpg', '👀', 'none', '1fecf073b98db40397dfdfcd4772d79b.jpg'),
(49, '', 'bf8f2526c0773f86d83f98c2deb845d2.jpg', '🧚‍♀️', 'inf3', 'bf8f2526c0773f86d83f98c2deb845d2.jpg'),
(50, '', '3cd1d46adb3cf2c454fc00ab9dabcba5.jpg', 'Escreva algo legal :)', 'inf3', '3cd1d46adb3cf2c454fc00ab9dabcba5.jpg');

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
  `denuncias` int(11) NOT NULL DEFAULT 0,
  `idConta` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`id`, `data`, `midia`, `texto`, `likes`, `privacidade`, `denuncias`, `idConta`, `idPerfil`) VALUES
(196, '2022-05-14 22:35:01', 'f65ece716cd506afdc73431fc1a50a5e.jpg', 'as', 0, 0, 0, 44, 44),
(200, '2022-05-14 22:52:07', 'nil', 'mim der', 1, 0, 0, 44, 44),
(201, '2022-05-14 22:52:39', 'nil', 'ghdfghg', 1, 0, 0, 44, 44),
(202, '2022-05-14 22:58:31', 'nil', 'hora certa?', 1, 0, 0, 44, 44),
(203, '2022-05-14 23:09:38', '6627d1274f00b329f71d75112d9aeb87.jpg', '...', 2, 0, 0, 44, 44),
(204, '2022-05-14 23:35:17', 'nil', 'bom dia', 0, 0, 0, 48, 48),
(205, '2022-05-14 23:36:15', 'd896337d10faf478a6b17479136e5f79.jpg', 'Hoje tem aula livre', 1, 0, 0, 48, 48),
(206, '2022-05-14 23:43:20', '155529d81e827b4e2db1594128da3b52.jpg', '😱', 1, 0, 0, 48, 48),
(211, '2022-05-15 10:51:28', 'nil', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nunc quam, iaculis at tristique quis, ullamcorper at nulla. Aliquam id volutpat odio. Proin enim libero, placerat vitae augue id, aliquam fringilla tellus. Maecenas ornare justo nec nisl tristique consectetur. Pellentesque placerat lacinia nulla, non lacinia augue viverra vel. Curabitur facilisis at ante sit amet varius. Phasellus semper semper finibus. Mauris pellentesque urna lacus, non pretium arcu pretium porta. Nulla eget dignis', 1, 0, 0, 48, 48),
(218, '2022-05-15 13:56:15', 'nil', 'Nhem nhem', 0, 0, 0, 50, 50),
(219, '2022-05-15 14:15:03', 'nil', 'я голоден🌻', 1, 0, 0, 49, 49);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
