-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Out-2024 às 16:55
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `enlace`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id` int(12) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `poder` int(1) NOT NULL COMMENT '1-9',
  `status` int(1) NOT NULL COMMENT '1 - ativo ; 0 - inativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id`, `nome`, `email`, `senha`, `poder`, `status`) VALUES
(1, 'CelsoMito', 'celsoincrivel@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrossel`
--

CREATE TABLE `carrossel` (
  `id` int(11) UNSIGNED NOT NULL,
  `imggd` varchar(255) NOT NULL,
  `imgpq` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `carrossel`
--

INSERT INTO `carrossel` (`id`, `imggd`, `imgpq`, `status`) VALUES
(1, 'gd_1717357271.jpg', 'pq_1723239886.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `email`, `senha`, `telefone`, `nascimento`, `cpf`, `status`) VALUES
(1, 'Nicolás Corral', 'nico@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '11-11111 1111', '2024-08-02', '888.888.888-88', 1),
(2, 'Politica', 'nicolascorral169@gmail.com', '83cf8b609de60036a8277bd0e96135751bbc07eb234256d4b65b893360651bf2', '11-11111 1111', '2024-08-29', '999.999.999-99', 1),
(3, 'Politica', 'julio@cesar.com', '5e968ce47ce4a17e3823c29332a39d049a8d0afb08d157eb6224625f92671a51', '11-11111 1111', '2024-08-01', '543.433.333-33', 1),
(4, 'Farmacia', 'ggg@gmail.com', '3538a1ef2e113da64249eea7bd068b585ec7ce5df73b2d1e319d8c9bf47eb314', '11-11111 1111', '2024-08-30', '343.847.333-33', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cli_mudarsenha`
--

CREATE TABLE `cli_mudarsenha` (
  `id` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `codigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `interprete`
--

CREATE TABLE `interprete` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `curriculo` varchar(200) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `data_hora` datetime DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `interprete`
--

INSERT INTO `interprete` (`id`, `nome`, `email`, `telefone`, `nascimento`, `cpf`, `estado`, `cidade`, `curriculo`, `video`, `senha`, `data_hora`, `status`) VALUES
(1, 'Nicolás Corral', 'corralnicolas3@gmail.com', '22-22222 2222', '2024-09-04', '222.222.222-22', 'são paulo', 'são paulo', 'cv_1726861366.pdf', 'video_1726861366.mp4', '9b871512327c09ce91dd649b3f96a63b7408ef267c8cc5710114e629730cb61f', '2024-09-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `interprete_documentos`
--

CREATE TABLE `interprete_documentos` (
  `id` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `rg_frente` varchar(255) DEFAULT NULL,
  `rg_verso` varchar(255) DEFAULT NULL,
  `comp_resi` varchar(255) DEFAULT NULL,
  `car_trabalho` varchar(255) DEFAULT NULL,
  `ante_criminais` varchar(255) DEFAULT NULL,
  `db1` varchar(255) DEFAULT NULL,
  `db2` varchar(255) DEFAULT NULL,
  `db3` varchar(255) DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `interprete_documentos`
--

INSERT INTO `interprete_documentos` (`id`, `id_int`, `rg_frente`, `rg_verso`, `comp_resi`, `car_trabalho`, `ante_criminais`, `db1`, `db2`, `db3`, `data_hora`, `status`) VALUES
(1, 1, 'ff_1728041307.pdf', 'fv_1728041307.pdf', 'cr_1728041307.pdf', 'ct_1728041307.pdf', 'cac_1728041307.pdf', 'rere', 'rere', 'rere', '2024-10-16 20:24:29', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `interprete_documentos_temp`
--

CREATE TABLE `interprete_documentos_temp` (
  `id` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `rg_frente` varchar(255) DEFAULT NULL,
  `rg_verso` varchar(255) DEFAULT NULL,
  `comp_resi` varchar(255) DEFAULT NULL,
  `car_trabalho` varchar(255) DEFAULT NULL,
  `ante_criminais` varchar(255) DEFAULT NULL,
  `db1` varchar(255) DEFAULT NULL,
  `db2` varchar(255) DEFAULT NULL,
  `db3` varchar(255) DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `interprete_perfil`
--

CREATE TABLE `interprete_perfil` (
  `id` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `video_apre` varchar(255) DEFAULT NULL,
  `texto_apre` varchar(255) DEFAULT NULL,
  `formacao` varchar(255) DEFAULT NULL,
  `tempo_exp` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `corRaca` varchar(255) DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `interprete_perfil`
--

INSERT INTO `interprete_perfil` (`id`, `id_int`, `foto_perfil`, `video_apre`, `texto_apre`, `formacao`, `tempo_exp`, `genero`, `corRaca`, `data_hora`, `status`) VALUES
(1, 1, 'fp_1728041321.PNG', 'video_1728041321.1920x1080', 'gf', 'gfgf', 'm1', 'masculino', 'branca', '2024-10-16 21:11:47', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `interprete_perfil_temp`
--

CREATE TABLE `interprete_perfil_temp` (
  `id` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `video_apre` varchar(255) DEFAULT NULL,
  `texto_apre` varchar(255) DEFAULT NULL,
  `formacao` varchar(255) DEFAULT NULL,
  `tempo_exp` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `corRaca` varchar(255) DEFAULT NULL,
  `data_hora` datetime NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `interprete_servico`
--

CREATE TABLE `interprete_servico` (
  `id` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `hC` time NOT NULL,
  `hA` time NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `interprete_servico`
--

INSERT INTO `interprete_servico` (`id`, `id_int`, `id_servico`, `hC`, `hA`, `status`) VALUES
(1, 1, 1, '10:00:00', '21:51:00', 1),
(2, 1, 2, '10:00:00', '21:51:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `interprete_temp`
--

CREATE TABLE `interprete_temp` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `curriculo` varchar(200) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobre` varchar(255) NOT NULL,
  `serve` varchar(255) NOT NULL,
  `preco` int(11) NOT NULL,
  `video` varchar(255) NOT NULL,
  `imgn1` varchar(255) NOT NULL,
  `imgn2` varchar(255) NOT NULL,
  `imgn3` varchar(255) NOT NULL,
  `imgn4` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id`, `nome`, `sobre`, `serve`, `preco`, `video`, `imgn1`, `imgn2`, `imgn3`, `imgn4`, `status`) VALUES
(1, 'Politica', 'debug1', 'debug2', 100, 'video_1723241248.mp4', 'imgn1_1723241266.jpg', 'imgn2_1723239578.jpg', 'imgn3_1723239578.jpg', 'imgn4_1723239578.jpg', 1),
(2, 'Farmacia', 'debug3', 'debug2', 41, 'video_1723242240.mp4', 'imgn1_1723242240.jpg', 'imgn2_1723242240.jpg', 'imgn3_1723242240.jpg', 'imgn4_1723242240.jpg', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `carrossel`
--
ALTER TABLE `carrossel`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `cli_mudarsenha`
--
ALTER TABLE `cli_mudarsenha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Índices para tabela `interprete`
--
ALTER TABLE `interprete`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `interprete_documentos`
--
ALTER TABLE `interprete_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `interprete_documentos_temp`
--
ALTER TABLE `interprete_documentos_temp`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `interprete_perfil`
--
ALTER TABLE `interprete_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `interprete_perfil_temp`
--
ALTER TABLE `interprete_perfil_temp`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `interprete_servico`
--
ALTER TABLE `interprete_servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `interprete_temp`
--
ALTER TABLE `interprete_temp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carrossel`
--
ALTER TABLE `carrossel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cli_mudarsenha`
--
ALTER TABLE `cli_mudarsenha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `interprete`
--
ALTER TABLE `interprete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `interprete_documentos`
--
ALTER TABLE `interprete_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `interprete_documentos_temp`
--
ALTER TABLE `interprete_documentos_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `interprete_perfil`
--
ALTER TABLE `interprete_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `interprete_perfil_temp`
--
ALTER TABLE `interprete_perfil_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `interprete_servico`
--
ALTER TABLE `interprete_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `interprete_temp`
--
ALTER TABLE `interprete_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cli_mudarsenha`
--
ALTER TABLE `cli_mudarsenha`
  ADD CONSTRAINT `cli_mudarsenha_ibfk_1` FOREIGN KEY (`id_cli`) REFERENCES `cliente` (`id`);

--
-- Limitadores para a tabela `interprete_servico`
--
ALTER TABLE `interprete_servico`
  ADD CONSTRAINT `interprete_servico_ibfk_1` FOREIGN KEY (`id_int`) REFERENCES `interprete` (`id`),
  ADD CONSTRAINT `interprete_servico_ibfk_2` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
