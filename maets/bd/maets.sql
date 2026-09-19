-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/09/2026 às 22:12
-- Versão do servidor: 8.4.8
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `maets`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `biblioteca`
--

CREATE TABLE `biblioteca` (
  `idBiblioteca` int NOT NULL,
  `idUsuario` int NOT NULL,
  `idJogo` int NOT NULL,
  `dataAdicao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos`
--

CREATE TABLE `jogos` (
  `idJogo` int NOT NULL,
  `nomeJogo` varchar(150) NOT NULL,
  `descricaoJogo` text,
  `categoriaJogo` varchar(100) DEFAULT NULL,
  `precoJogo` decimal(10,2) DEFAULT NULL,
  `capaJogo` varchar(255) NOT NULL,
  `paginaJogo` varchar(150) DEFAULT NULL,
  `gameplay1Jogo` varchar(255) NOT NULL,
  `gameplay2Jogo` varchar(255) NOT NULL,
  `gameplay3Jogo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `jogos`
--

INSERT INTO `jogos` (`idJogo`, `nomeJogo`, `descricaoJogo`, `categoriaJogo`, `precoJogo`, `capaJogo`, `paginaJogo`, `gameplay1Jogo`, `gameplay2Jogo`, `gameplay3Jogo`) VALUES
(1, 'GTA VI', 'Grand Theft Auto VI (GTA VI) é o próximo jogo eletrônico de ação e aventura desenvolvido pela Rockstar Games. Ele será o sucessor de um dos jogos mais bem-sucedidos de todos os tempos, o GTA V (2013), e tem o seu lançamento mundial oficialmente confirmado para o dia 19 de novembro de 2026.', 'Ação', 649.00, 'assets/img/capaGTAIVxbox.jpg', 'https://www.rockstar.com', 'assets/img/gtaVI_g1.webp', 'assets/img/gtaVI_g2.webp', 'assets/img/gtaVI_g3.png'),
(2, 'Stardew Valley', 'Stardew Valley é um aclamado jogo eletrônico independente (indie) de RPG e simulação de vida no campo. Lançado originalmente em 2016, o game foi inteiramente criado por uma única pessoa, o desenvolvedor Eric Barone (conhecido pelo pseudônimo ConcernedApe). A premissa central é simples e cativante: seu personagem herda a antiga fazenda dilapidada do avô no Vale do Orvalho (Stardew Valley) e decide abandonar a rotina estressante de um trabalho corporativo na cidade grande para reconstruir o lugar e viver da terra. [1] (https://pt.wikipedia.org/wiki/Stardew_Valley), [2] (https://www.youtube.com/watch?v=tCOv_3xg6D4), [3] (https://pt.stardewvalleywiki.com/Stardew_Valley_Wiki)O jogo se destaca por ser uma experiência relaxante e de mundo aberto, permitindo que você jogue totalmente no seu próprio ritmo. Ele mistura elementos de gerenciamento de recursos com fortes interações sociais e exploração.', 'RPG', 120.00, 'assets/img/fazenda.webp', 'https://stardewvalley.com', 'assets/img/fazenda1.jpg', 'assets/img/fazenda2.jpg', 'assets/img/fazenda3.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_maets` int NOT NULL,
  `fotoUsuario` varchar(255) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `dataNascimentoUsuario` date NOT NULL,
  `emailUsuario` varchar(150) NOT NULL,
  `senhaUsuario` varchar(100) NOT NULL,
  `nivelUsuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_maets`, `fotoUsuario`, `nomeUsuario`, `dataNascimentoUsuario`, `emailUsuario`, `senhaUsuario`, `nivelUsuario`) VALUES
(1, 'assets/img/Captura de tela 2026-03-09 192150.png', 'Administrador', '2009-02-03', 'administrador@gmail.com', '202cb962ac59075b964b07152d234b70', 'administrador'),
(2, 'img/celeste1.jpg', 'Comum', '2026-09-09', 'comum@gmail.com', '202cb962ac59075b964b07152d234b70', 'comum');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`idBiblioteca`),
  ADD UNIQUE KEY `idUsuario` (`idUsuario`,`idJogo`),
  ADD KEY `idJogo` (`idJogo`);

--
-- Índices de tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`idJogo`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_maets`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `idBiblioteca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `idJogo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_maets` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `biblioteca_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id_maets`),
  ADD CONSTRAINT `biblioteca_ibfk_2` FOREIGN KEY (`idJogo`) REFERENCES `jogos` (`idJogo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
