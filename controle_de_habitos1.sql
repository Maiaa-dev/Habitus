-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/10/2025 às 02:02
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controle_de_habitos1`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `execucoes_tarefas`
--

CREATE TABLE `execucoes_tarefas` (
  `id_executaf` int(11) NOT NULL,
  `tarefa_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_execucao` date NOT NULL,
  `hora_execucao` time DEFAULT NULL,
  `status` varchar(20) DEFAULT 'concluida',
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `habitos`
--

CREATE TABLE `habitos` (
  `id_habito` int(20) NOT NULL,
  `nome_habito` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `habitos`
--

INSERT INTO `habitos` (`id_habito`, `nome_habito`) VALUES
(1, 'Hidratação'),
(2, 'Leitura'),
(3, 'Caminhada'),
(4, 'rotina do sono');

-- --------------------------------------------------------

--
-- Estrutura para tabela `habito_usuario`
--

CREATE TABLE `habito_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_habito` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_meta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `habito_usuario`
--

INSERT INTO `habito_usuario` (`id_usuario`, `id_habito`, `criado_em`, `id_meta`) VALUES
(13, 1, '2025-09-21 23:58:28', 2),
(2, 2, '2025-10-05 19:17:24', 6),
(2, 3, '2025-10-05 19:17:46', 7),
(2, 1, '2025-10-05 21:05:27', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas`
--

CREATE TABLE `metas` (
  `id_meta` int(11) NOT NULL,
  `nome_meta` varchar(200) NOT NULL,
  `id_habito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `metas`
--

INSERT INTO `metas` (`id_meta`, `nome_meta`, `id_habito`) VALUES
(1, '1l', 1),
(2, '2L', 1),
(3, '2.5L', 1),
(4, '15min', 2),
(5, '20min', 2),
(6, '30min', 2),
(7, '30min', 3),
(8, '35min', 3),
(9, '40min', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `registros`
--

CREATE TABLE `registros` (
  `id_registro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_habito` int(20) NOT NULL,
  `meta_alcancada` varchar(100) NOT NULL,
  `data_feito` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefa` int(11) NOT NULL,
  `rotina_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `duracao_minutos` int(11) DEFAULT NULL,
  `ativa` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_hash` varchar(255) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_conta` varchar(20) DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha_hash`, `genero`, `criado_em`, `atualizado_em`, `status_conta`) VALUES
(1, 'Gustavo', 'gusta@gmail.com', '12345678', 'Masculino', '2025-07-02 20:49:01', '2025-07-02 20:49:01', 'ativo'),
(2, 'Aline Maia', 'ali@gmail.com', 'jZae727K08KaOmKSgOaGzww/XVqGr/PKEgIMkjrcbJI=', NULL, '2025-07-07 21:30:43', '2025-07-07 21:30:43', 'ativo'),
(3, 'Bianca Melo', 'bianca@gmail.com', '$2y$10$mSMqX0kBmczEpheahKCVm.58XrLl68sp1g0rWVTMjtkJi91Z0Xm7m', NULL, '2025-07-26 21:59:55', '2025-07-26 21:59:55', 'ativo'),
(4, 'Marcio Guima', 'marciodguima67@gmail.com', '$2y$10$IqyStNy8ofWMJc55nLEie.6Fl.Mw1XmH6uqri5k9uR09vxz9kItsW', NULL, '2025-07-26 22:05:44', '2025-07-26 22:05:44', 'ativo'),
(9, 'João', 'joao@gmail.com', '$2y$10$tN0ABPf/EG6cyIMaUYgv7eVelkyu/eHeQC1svOP7zJ6Ik9U1KE9hu', NULL, '2025-07-26 22:45:25', '2025-07-26 22:45:25', 'ativo'),
(10, 'Clark', 'clark@gmail.com', '$2y$10$kl19u7qxKMGrUdrkJefqquTMnVPtOpqscvyHZIzV8mebxeMhVZLx2', NULL, '2025-07-27 15:20:06', '2025-07-27 15:20:06', 'ativo'),
(11, 'Maria Luisa', 'malu@gmail.com', '$2y$10$1llzzW8jsRYLkiplTKIGF.kUZCXwiTDCXLfYhDMKqZjSpxb/QJvo.', NULL, '2025-07-27 22:24:15', '2025-07-27 22:24:15', 'ativo'),
(12, 'Flávio', 'flavio@gmail.com', '$2y$10$7WhFeKBQd04C4/dQIpoyCezLKEtKYXMNf519oJtvJldoLKxmG80a2', NULL, '2025-07-27 22:28:07', '2025-07-27 22:28:07', 'ativo'),
(13, 'Helena', 'helena@gmail.com', '$2y$10$pLj0UpaQ4vOEqkHHeX/IY.UAKmXykFVwO9PEz1z9fqSGHpFcu2DOS', NULL, '2025-09-03 00:55:20', '2025-09-03 00:55:20', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `execucoes_tarefas`
--
ALTER TABLE `execucoes_tarefas`
  ADD PRIMARY KEY (`id_executaf`),
  ADD KEY `tarefa_id` (`tarefa_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `habitos`
--
ALTER TABLE `habitos`
  ADD PRIMARY KEY (`id_habito`);

--
-- Índices de tabela `habito_usuario`
--
ALTER TABLE `habito_usuario`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_habito` (`id_habito`),
  ADD KEY `id_meta` (`id_meta`);

--
-- Índices de tabela `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id_meta`),
  ADD KEY `id_habito` (`id_habito`);

--
-- Índices de tabela `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_habito` (`id_habito`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefa`),
  ADD KEY `rotina_id` (`rotina_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `execucoes_tarefas`
--
ALTER TABLE `execucoes_tarefas`
  MODIFY `id_executaf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `habitos`
--
ALTER TABLE `habitos`
  MODIFY `id_habito` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `metas`
--
ALTER TABLE `metas`
  MODIFY `id_meta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `execucoes_tarefas`
--
ALTER TABLE `execucoes_tarefas`
  ADD CONSTRAINT `execucoes_tarefas_ibfk_1` FOREIGN KEY (`tarefa_id`) REFERENCES `tarefas` (`id_tarefa`),
  ADD CONSTRAINT `execucoes_tarefas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `habito_usuario`
--
ALTER TABLE `habito_usuario`
  ADD CONSTRAINT `id_meta` FOREIGN KEY (`id_meta`) REFERENCES `metas` (`id_meta`);

--
-- Restrições para tabelas `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `metas_ibfk_1` FOREIGN KEY (`id_habito`) REFERENCES `habitos` (`id_habito`);

--
-- Restrições para tabelas `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `registros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `registros_ibfk_2` FOREIGN KEY (`id_habito`) REFERENCES `habitos` (`id_habito`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
