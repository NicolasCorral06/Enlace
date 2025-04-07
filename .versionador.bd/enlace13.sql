-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2024 às 05:27
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

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
-- Estrutura para tabela `administrador`
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
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`id`, `nome`, `email`, `senha`, `poder`, `status`) VALUES
(1, 'CelsoMito', 'celsoincrivel@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantInt` int(11) NOT NULL,
  `quantHoras` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `codVerify` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `data_insercao` datetime DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamento`
--

INSERT INTO `agendamento` (`id`, `id_servico`, `id_int`, `id_cli`, `preco`, `quantInt`, `quantHoras`, `cidade`, `codVerify`, `data`, `data_insercao`, `status`) VALUES
(2, 1, 1, 1, 100.00, 1, 1, 'São Paulo', 'rEuzCF5Ht', '2024-11-23', '2024-11-16 21:45:28', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentolocal`
--

CREATE TABLE `agendamentolocal` (
  `id` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `codVerify` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentolocal`
--

INSERT INTO `agendamentolocal` (`id`, `id_cli`, `id_int`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `codVerify`, `status`) VALUES
(2, 1, 1, '04863000', 'Avenida Professora Marta Maria Bernardes', '202', 'Vila Natal', 'São Paulo', 'SP', 'rEuzCF5Ht', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrossel`
--

CREATE TABLE `carrossel` (
  `id` int(11) UNSIGNED NOT NULL,
  `imggd` varchar(255) NOT NULL,
  `altgd` varchar(200) NOT NULL,
  `imgpq` varchar(255) NOT NULL,
  `altpq` varchar(200) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrossel`
--

INSERT INTO `carrossel` (`id`, `imggd`, `altgd`, `imgpq`, `altpq`, `status`) VALUES
(1, 'gd_1717357271.jpg', 'altgd90', 'pq_1723239886.jpg', 'altpq1', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamado_adm`
--

CREATE TABLE `chamado_adm` (
  `id` int(11) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `email_adm` varchar(100) NOT NULL,
  `assunto` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chamado_adm`
--

INSERT INTO `chamado_adm` (`id`, `id_adm`, `email_adm`, `assunto`, `status`) VALUES
(1, 0, 'celsoincrivel@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `foto_perfil` varchar(300) DEFAULT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_insercao` datetime DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `foto_perfil`, `nome`, `email`, `senha`, `telefone`, `nascimento`, `cpf`, `data_insercao`, `status`) VALUES
(1, 'fp_1732656793.jpg', 'Nicolás Corral', 'nico@gmail.com', '556d7dc3a115356350f1f9910b1af1ab0e312d4b3e4fc788d2da63668f36d017', '11-11111 1111', '2024-08-02', '888.888.888-88', '2024-01-21 11:37:28', 1),
(2, NULL, 'Politica', 'nicolascorral169@gmail.com', '83cf8b609de60036a8277bd0e96135751bbc07eb234256d4b65b893360651bf2', '11-11111 1111', '2024-08-29', '999.999.999-99', '2024-06-16 21:45:28', 1),
(3, NULL, 'Politica', 'julio@cesar.com', '5e968ce47ce4a17e3823c29332a39d049a8d0afb08d157eb6224625f92671a51', '11-11111 1111', '2024-08-01', '543.433.333-33', '2024-08-16 21:45:28', 1),
(4, NULL, 'Farmacia', 'ggg@gmail.com', '3538a1ef2e113da64249eea7bd068b585ec7ce5df73b2d1e319d8c9bf47eb314', '11-11111 1111', '2024-08-30', '343.847.333-33', '2024-11-16 21:45:28', 1),
(5, NULL, 'testeCliente', 'netigan507@avzong.com', '5e968ce47ce4a17e3823c29332a39d049a8d0afb08d157eb6224625f92671a51', '99-99999 9999', '2024-10-30', '222.222.222-22', '2024-09-16 21:45:28', 1),
(6, NULL, 'testeCliente2', 'umcaraqualquer1609@gmail.com', 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae', '55-55555 5555', '2024-11-13', '777.777.777-77', '2024-10-16 21:45:28', 1),
(7, NULL, 'Bipaceb565@Gitated.Com', 'bipaceb565@gitated.com', 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae', '(32) 32323-2345', '2024-11-13', '435.353.535-35', '2024-03-16 21:45:28', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cli_mudarsenha`
--

CREATE TABLE `cli_mudarsenha` (
  `id` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `cli_identifier` varchar(8) NOT NULL,
  `codigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cli_mudarsenha`
--

INSERT INTO `cli_mudarsenha` (`id`, `id_cli`, `cli_identifier`, `codigo`) VALUES
(16, 0, 'JhvdDuHZ', 894599);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `assunto` varchar(100) NOT NULL,
  `mensagem` varchar(300) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contato`
--

INSERT INTO `contato` (`id`, `nome`, `email`, `telefone`, `assunto`, `mensagem`, `status`) VALUES
(1, 'Nicolás Corral 2', 'corralnicolas3@gmail.com', '11111111111', 'duvidas', 'abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abu', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `interprete`
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
-- Despejando dados para a tabela `interprete`
--

INSERT INTO `interprete` (`id`, `nome`, `email`, `telefone`, `nascimento`, `cpf`, `estado`, `cidade`, `curriculo`, `video`, `senha`, `data_hora`, `status`) VALUES
(1, 'Nicolás Corral', 'corralnicolas3@gmail.com', '22-22222 2222', '2024-09-04', '222.222.222-22', 'são paulo', 'São Paulo', 'cv_1726861366.pdf', 'video_1726861366.mp4', '556d7dc3a115356350f1f9910b1af1ab0e312d4b3e4fc788d2da63668f36d017', '2024-11-16 21:45:28', 1),
(2, 'Bipaceb565@Gitated.Com', 'bipaceb565@gitated.com', '(43) 43894-7389', '2024-11-28', '743.987.589-37', '', 'São Paulo', 'cv_1732396200.pdf', 'video_1732396200.mp4', '91a73fd806ab2c005c13b4dc19130a884e909dea3f72d46e30266fe1a1f588d8', '2024-11-23 18:10:31', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `interprete_documentos`
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
-- Despejando dados para a tabela `interprete_documentos`
--

INSERT INTO `interprete_documentos` (`id`, `id_int`, `rg_frente`, `rg_verso`, `comp_resi`, `car_trabalho`, `ante_criminais`, `db1`, `db2`, `db3`, `data_hora`, `status`) VALUES
(1, 1, 'ff_1728041307.pdf', 'fv_1728041307.pdf', 'cr_1728041307.pdf', 'ct_1728041307.pdf', 'cac_1728041307.pdf', 'rere', 'rere', 'rere', '2024-10-16 20:24:29', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `interprete_documentos_temp`
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
-- Estrutura para tabela `interprete_perfil`
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
-- Despejando dados para a tabela `interprete_perfil`
--

INSERT INTO `interprete_perfil` (`id`, `id_int`, `foto_perfil`, `video_apre`, `texto_apre`, `formacao`, `tempo_exp`, `genero`, `corRaca`, `data_hora`, `status`) VALUES
(1, 1, 'fp_1731798281.jpg', 'video_1731104046.mp4', 'gf', 'ola', '1a2', 'masculino', 'branca', '2024-10-16 21:11:47', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `interprete_perfil_temp`
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
-- Estrutura para tabela `interprete_servico`
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
-- Despejando dados para a tabela `interprete_servico`
--

INSERT INTO `interprete_servico` (`id`, `id_int`, `id_servico`, `hC`, `hA`, `status`) VALUES
(1, 1, 1, '10:00:00', '21:51:00', 1),
(3, 1, 2, '10:00:00', '21:51:00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `interprete_temp`
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
-- Estrutura para tabela `int_mudarsenha`
--

CREATE TABLE `int_mudarsenha` (
  `id` int(11) NOT NULL,
  `id_int` int(11) DEFAULT NULL,
  `int_identifier` varchar(11) DEFAULT NULL,
  `codigo` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `codVerify` varchar(20) NOT NULL,
  `modoPagamento` varchar(20) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamento`
--

INSERT INTO `pagamento` (`id`, `id_cli`, `codVerify`, `modoPagamento`, `status`) VALUES
(1, 1, 'rEuzCF5Ht', 'cartao', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobre` varchar(255) NOT NULL,
  `serve` varchar(255) NOT NULL,
  `preco` int(11) NOT NULL,
  `video` varchar(255) NOT NULL,
  `imgn1` varchar(255) NOT NULL,
  `altI1` varchar(255) NOT NULL,
  `imgn2` varchar(255) NOT NULL,
  `altI2` varchar(255) NOT NULL,
  `imgn3` varchar(255) NOT NULL,
  `altI3` varchar(255) NOT NULL,
  `imgn4` varchar(255) NOT NULL,
  `altI4` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servico`
--

INSERT INTO `servico` (`id`, `nome`, `sobre`, `serve`, `preco`, `video`, `imgn1`, `altI1`, `imgn2`, `altI2`, `imgn3`, `altI3`, `imgn4`, `altI4`, `status`) VALUES
(1, 'Politica', 'debug1', 'debug2', 100, 'video_1723241248.mp4', 'imgn1_1723241266.jpg', 'altI90', 'imgn2_1723239578.jpg', 'altI2', 'imgn3_1723239578.jpg', 'altI3', 'imgn4_1723239578.jpg', 'altI4', 1),
(2, 'Farmacia', 'debug3', 'debug2', 41, 'video_1723242240.mp4', 'imgn1_1723242240.jpg', 'altI1', 'imgn2_1723242240.jpg', 'altI2', 'imgn3_1723242240.jpg', 'altI3', 'imgn4_1723242240.jpg', 'altI4', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `agendamentolocal`
--
ALTER TABLE `agendamentolocal`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carrossel`
--
ALTER TABLE `carrossel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `chamado_adm`
--
ALTER TABLE `chamado_adm`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `cli_mudarsenha`
--
ALTER TABLE `cli_mudarsenha`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `interprete`
--
ALTER TABLE `interprete`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `interprete_documentos`
--
ALTER TABLE `interprete_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `interprete_documentos_temp`
--
ALTER TABLE `interprete_documentos_temp`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `interprete_perfil`
--
ALTER TABLE `interprete_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `interprete_perfil_temp`
--
ALTER TABLE `interprete_perfil_temp`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `interprete_servico`
--
ALTER TABLE `interprete_servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `interprete_temp`
--
ALTER TABLE `interprete_temp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `int_mudarsenha`
--
ALTER TABLE `int_mudarsenha`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `agendamentolocal`
--
ALTER TABLE `agendamentolocal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `carrossel`
--
ALTER TABLE `carrossel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `chamado_adm`
--
ALTER TABLE `chamado_adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cli_mudarsenha`
--
ALTER TABLE `cli_mudarsenha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `interprete`
--
ALTER TABLE `interprete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `interprete_temp`
--
ALTER TABLE `interprete_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `int_mudarsenha`
--
ALTER TABLE `int_mudarsenha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
