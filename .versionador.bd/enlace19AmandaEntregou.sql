-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2024 às 10:11
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
(1, 'CelsoMito', 'celsoincrivel@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 9, 1);

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
  `horaComeca` time NOT NULL,
  `codVerify` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `data_insercao` datetime DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamento`
--

INSERT INTO `agendamento` (`id`, `id_servico`, `id_int`, `id_cli`, `preco`, `quantInt`, `quantHoras`, `cidade`, `horaComeca`, `codVerify`, `data`, `data_insercao`, `status`) VALUES
(2, 1, 1, 1, 100.00, 1, 1, 'São Paulo', '09:00:00', 'rEuzCF5Ht', '2024-11-23', '2024-11-16 21:45:28', 3),
(4, 1, 1, 1, 180.00, 2, 2, 'São Paulo', '11:00:00', 'aVwNfSSFS', '2024-11-30', '2024-11-28 04:02:28', 1),
(5, 1, 6, 1, 180.00, 2, 2, 'São Paulo', '11:00:00', 'aVwNfSSFS', '2024-11-30', '2024-11-28 04:02:28', 1),
(15, 1, 1, 1, 180.00, 1, 1, 'São Paulo', '22:01:00', '1SqJIpITR', '2024-11-30', '2024-11-29 21:01:36', 1),
(16, 1, 6, 10, 180.00, 1, 1, 'São Paulo', '07:00:00', 'HiTinAaq8', '2024-12-20', '2024-11-30 02:31:51', 1),
(17, 1, 6, 10, 180.00, 1, 1, 'São Paulo', '07:00:00', 'qUokFCEly', '2024-12-21', '2024-11-30 02:41:46', 2);

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
  `complemento` varchar(300) NOT NULL,
  `infor_adicionais` varchar(300) NOT NULL,
  `codVerify` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentolocal`
--

INSERT INTO `agendamentolocal` (`id`, `id_cli`, `id_int`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `complemento`, `infor_adicionais`, `codVerify`, `status`) VALUES
(2, 1, 1, '04863000', 'Avenida Professora Marta Maria Bernardes', '202', 'Vila Natal', 'São Paulo', 'SP', '', '', 'rEuzCF5Ht', 3),
(4, 1, 1, '04863000', 'Avenida Professora Marta Maria Bernardes', '303', 'Vila Natal', 'São Paulo', 'SP', '', '', 'aVwNfSSFS', 1),
(5, 1, 6, '04863000', 'Avenida Professora Marta Maria Bernardes', '303', 'Vila Natal', 'São Paulo', 'SP', '', '', 'aVwNfSSFS', 1),
(21, 1, 1, '04863000', 'Avenida Professora Marta Maria Bernardes', '303', 'Vila Natal', 'São Paulo', 'SP', '', '', '1SqJIpITR', 1),
(22, 10, 6, '04470093', 'Travessa Rosa-do-Natal', '30', 'Pedreira', 'São Paulo', 'SP', '', '', 'HiTinAaq8', 1);

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
(4, 'gd_1732931831.jpg', 'Imagem de um homem falando em libras enfrente a uma sala de aula.', 'pq_1732931831.jpg', 'Imagem de um homem falando em libras enfrente a uma sala de aula.', 1),
(5, 'gd_1732931866.jpg', 'Imagem de um homem falando em libras sobre obras de artes.', 'pq_1732931866.jpg', 'Imagem de um homem falando em libras sobre obras de artes.', 1),
(6, 'gd_1732931905.jpg', 'Imagem de um homem falando em libras com duas pessoas em uma mesa.', 'pq_1732931905.jpg', 'Imagem de um homem falando em libras com duas pessoas em uma mesa.', 1);

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
(1, 'fp_1732924640.jpg', 'Nicolás Corral', 'nico@gmail.com', '556d7dc3a115356350f1f9910b1af1ab0e312d4b3e4fc788d2da63668f36d017', '(54) 54545-4545', '2024-08-02', '888.888.888-88', '2024-01-21 11:37:28', 1),
(2, NULL, 'Politica', 'nicolascorral169@gmail.com', '83cf8b609de60036a8277bd0e96135751bbc07eb234256d4b65b893360651bf2', '11-11111 1111', '2024-08-29', '999.999.999-99', '2024-06-16 21:45:28', 1),
(3, 'fp_1732843402.jpg', 'Politica', 'julio@cesar.com', '5e968ce47ce4a17e3823c29332a39d049a8d0afb08d157eb6224625f92671a51', '11-11111 1111', '2024-08-01', '543.433.333-33', '2024-08-16 21:45:28', 1),
(4, NULL, 'Farmacia', 'ggg@gmail.com', '3538a1ef2e113da64249eea7bd068b585ec7ce5df73b2d1e319d8c9bf47eb314', '11-11111 1111', '2024-08-30', '343.847.333-33', '2024-11-16 21:45:28', 1),
(5, NULL, 'testeCliente', 'netigan507@avzong.com', '5e968ce47ce4a17e3823c29332a39d049a8d0afb08d157eb6224625f92671a51', '99-99999 9999', '2024-10-30', '222.222.222-22', '2024-09-16 21:45:28', 1),
(6, NULL, 'testeCliente2', 'umcaraqualquer1609@gmail.com', 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae', '55-55555 5555', '2024-11-13', '777.777.777-77', '2024-10-16 21:45:28', 1),
(7, NULL, 'Bipaceb565@Gitated.Com', 'bipaceb565@gitated.com', 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae', '(32) 32323-2345', '2024-11-13', '435.353.535-35', '2024-03-16 21:45:28', 1),
(9, NULL, 'Teste83', 'Teste83@gmail.com', 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae', '(43) 90743-8974', '2024-11-14', '434.368.473-67', '2024-11-27 18:06:34', 1),
(10, 'fp_1732944575.jpg', 'Amanda Luana Pedreira', 'amandaluanap7@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '(11) 94907-4140', '2006-07-31', '506.014.428-30', '2024-11-30 02:28:58', 1);

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
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_ser` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `estrela` int(11) NOT NULL,
  `mensagem` varchar(200) NOT NULL,
  `datahora` datetime DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_ser`, `id_cli`, `estrela`, `mensagem`, `datahora`, `status`) VALUES
(3, 1, 1, 5, 'muito foda o site', '2024-11-27 16:37:41', 1),
(4, 1, 3, 5, 'Muito maneiro esse serviço\r\n', '2024-11-28 22:24:08', 1),
(5, 2, 1, 5, 'oi', '2024-11-30 00:38:15', 1),
(6, 1, 10, 3, 'acheio meio chato', '2024-11-30 02:39:45', 1);

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
(1, 'Nicolás Corral 2', 'corralnicolas3@gmail.com', '11111111111', 'duvidas', 'abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abuguble abu', 1),
(2, 'Amanda Luana Pedreira', 'amandaluanap7@gmail.com', '11949074140', 'duvidas', 'ola', 2),
(3, 'Amanda Luana Pedreira', 'amandaluanap7@gmail.com', '11949074140', 'duvidas', 'oii', 2);

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
(5, 'Akemi Tanaka Yamamoto', 'akemi.t.yamamoto@gmail.com', '(54) 54545-454', '1991-11-05', '743.847.589-37', '', 'São Paulo', 'cv_1732753416.pdf', 'video_1732753416.mp4', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', '2024-11-27 21:37:13', 1),
(6, 'Kaê Tupinambá da Silva', 'kae.tupinamba@gmail.com', '12912345678', '1994-06-18', '43874893748937', '', 'São Paulo', 'cv_1732753605.pdf', 'video_1732838916.mp4', '4cc8f4d609b717356701c57a03e737e5ac8fe885da8c7163d3de47e01849c635', '2024-11-28 21:24:24', 1),
(7, ' Mariana Alves Pereira', 'mariana.alvesp@gmail.com', '(11) 91234-567', '1995-02-15', '456.789.123-45', '', 'Campinas', 'cv_1732753763.pdf', 'video_1732753763.mp4', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', '2024-11-27 21:37:28', 1),
(8, 'Aline Costa Santos', 'alinecosta.santos@gmail.com', '11 99876-5432', '0007-03-12', '789.123.456-12', '', 'Santo André', 'cv_1732753958.pdf', 'video_1732753958.mp4', '68487dc295052aa79c530e283ce698b8c6bb1b42ff0944252e1910dbecdc5425', '2024-11-28 02:54:28', 1),
(9, ' Larissa Nogueira Campos', 'larissa.ncampos@gmail.com', '16 93456-7890', '2000-01-02', '321.654.987-65', '', 'Campinas', 'cv_1732754066.pdf', 'video_1732754066.mp4', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', '2024-11-27 21:37:39', 1),
(10, 'Carlos Eduardo Ferreira', 'carlos.e.ferreira@gmail.com', '19 92345-6789', '1985-11-17', '654.321.987-34', '', 'Guarulhos', 'cv_1732754143.pdf', 'video_1732754143.mp4', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', '2024-11-27 21:37:45', 1),
(11, 'Amanda Luana Pedreira', 'amandaluanap7@gmail.com', '(11) 94907-4140', '2006-07-31', '506.014.428-30', '', 'Guarulhos', 'cv_1732942830.pdf', 'video_1732942830.mp4', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', '2024-11-30 02:13:11', 1);

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
(1, 1, 'ff_1728041307.pdf', 'fv_1728041307.pdf', 'cr_1728041307.pdf', 'ct_1728041307.pdf', 'cac_1728041307.pdf', 'rere', 'rere', 'rere', '2024-10-16 20:24:29', 1),
(2, 5, 'ff_1732754889.pdf', 'fv_1732754889.pdf', 'cr_1732754889.pdf', 'ct_1732754889.pdf', 'cac_1732754889.pdf', 'Itaú', '345678-9', '0423', '2024-11-27 22:09:55', 1),
(3, 6, 'ff_1732755139.pdf', 'fv_1732755139.pdf', 'cr_1732755139.pdf', 'ct_1732755139.pdf', '', 'Banco do Brasil', '890123-4', '0345', '2024-11-27 22:10:00', 1),
(4, 7, 'ff_1732755214.pdf', 'fv_1732755214.pdf', 'cr_1732755214.pdf', 'ct_1732755214.pdf', '', 'Banco do Brasil', '123456-7', '0012', '2024-11-27 22:10:14', 1),
(5, 8, 'ff_1732755579.pdf', 'fv_1732755579.pdf', 'cr_1732755579.pdf', 'ct_1732755579.pdf', 'cac_1732755579.pdf', 'Caixa Econômica Federal', '789012-3', ' 0045', '2024-11-27 22:10:15', 1),
(6, 9, 'ff_1732755660.pdf', 'fv_1732755660.pdf', 'cr_1732755660.pdf', 'ct_1732755660.pdf', '', ' Itaú', '789456-3', '0325', '2024-11-27 22:10:17', 1),
(7, 10, 'ff_1732755740.pdf', 'fv_1732755740.pdf', 'cr_1732755740.pdf', 'ct_1732755740.pdf', 'cac_1732755740.pdf', 'Banco do Brasil', '456789-1', ' 0210', '2024-11-27 22:10:19', 1),
(8, 2, 'ff_1732906338.pdf', 'fv_1732906338.pdf', 'cr_1732906338.pdf', 'ct_1732906338.pdf', 'cac_1732906338.', 'Banco do Brasil', '345678-9', '0325', '2024-11-29 15:58:40', 1),
(9, 11, 'ff_1732943694.pdf', 'fv_1732943694.pdf', 'cr_1732943694.pdf', 'ct_1732943694.pdf', 'cac_1732943694.pdf', 'bradesco', '123', '321', '2024-11-30 02:21:55', 1);

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
(1, 1, 'fp_1731798281.jpg', 'video_1731104046.mp4', 'gf', 'ola', '1a2', 'masculino', 'branca', '2024-10-16 21:11:47', 1),
(2, 5, 'fp_1732755051.jpg', 'video_1732755051.mp4', 'Com foco em conferências e áreas empresariais, vejo o trabalho como intérprete de Libras como uma maneira de derrubar barreiras. Quero trazer minha experiência para esse e-commerce inovador.', 'Administração de Empresas', '1a2', 'masculino', 'preta', '2024-11-27 22:10:43', 1),
(3, 6, 'fp_1732839864.jpg', 'video_1732755163.mp4', 'Como intérprete de Libras, minha trajetória é guiada pela luta por acessibilidade e valorização cultural. Tenho experiência em eventos artísticos e sociais, onde busco trazer inclusão com respeito às diversidades. Quero contribuir para ampliar o impacto d', ' Licenciatura em Ciências Sociais', '3a4', 'masculino', 'indigena', '2024-11-27 22:10:51', 1),
(4, 7, 'fp_1732755451.jpg', 'video_1732755451.mp4', 'Sou intérprete de Libras com experiência em eventos culturais e pedagógicos. Minha paixão pela acessibilidade começou na faculdade, e quero contribuir para criar experiências inclusivas para todos. Quero trabalhar com vocês para continuar transformando vi', 'Licenciatura em Letras Libras', '4m', 'feminino', 'branca', '2024-11-27 22:10:55', 1),
(5, 8, 'fp_1732755606.jpg', 'video_1732755606.mp4', 'Atuei em serviços públicos e debates políticos como intérprete de Libras. Minha motivação é proporcionar igualdade de acesso e voz à comunidade surda', 'Bacharelado em Serviço Social', '2a3', 'feminino', 'preta', '2024-11-27 22:12:14', 1),
(6, 9, 'fp_1732755690.jpg', 'video_1732755690.mp4', 'Sou apaixonada pela área social e de turismo. Quero ajudar sua empresa a criar experiências inclusivas e inesquecíveis para a comunidade surda.', 'Turismo', '1a2', 'feminino', 'branca', '2024-11-27 22:12:16', 1),
(7, 10, 'fp_1732755764.jpg', 'video_1732755764.mp4', 'Com foco em conferências e áreas empresariais, vejo o trabalho como intérprete de Libras como uma maneira de derrubar barreiras. Quero trazer minha experiência para esse e-commerce inovador.', 'Administração de Empresas', 'm1', 'masculino', 'preta', '2024-11-27 22:12:18', 1),
(8, 2, 'fp_1732909156.jpg', 'video_1732906367.mp4', 'sou muito foda', 'Fodicimo 123', '2a3', 'feminino', 'indigena', '2024-11-29 15:58:42', 1),
(9, 11, 'fp_1732943734.jpg', 'video_1732943734.mp4', 'ola', 'oi', 'm1', 'feminino', 'amarela', '2024-11-30 02:23:10', 1);

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
(3, 1, 2, '10:00:00', '21:51:00', 1),
(4, 6, 1, '00:00:00', '00:00:00', 1),
(7, 6, 13, '00:00:00', '00:00:00', 1),
(9, 1, 9, '00:00:00', '00:00:00', 1),
(10, 8, 2, '00:00:00', '00:00:00', 1),
(11, 8, 8, '00:00:00', '00:00:00', 1),
(12, 8, 12, '00:00:00', '00:00:00', 1),
(14, 6, 12, '00:00:00', '00:00:00', 1),
(15, 11, 7, '00:00:00', '00:00:00', 1),
(16, 11, 8, '00:00:00', '00:00:00', 1),
(17, 11, 9, '00:00:00', '00:00:00', 1);

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

--
-- Despejando dados para a tabela `interprete_temp`
--

INSERT INTO `interprete_temp` (`id`, `nome`, `email`, `telefone`, `nascimento`, `cpf`, `estado`, `cidade`, `curriculo`, `video`, `senha`, `status`) VALUES
(15, 'Jorge', 'jorge@gmail.com', '24378947389', '2024-11-01', '483894', '', 'São Bernardo do Campo', 'cv_1732907009.pdf', 'video_1732907009.mp4', '68487dc295052aa79c530e283ce698b8c6bb1b42ff0944252e1910dbecdc5425', 1);

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
(1, 1, 'rEuzCF5Ht', 'cartao', 1),
(3, 1, 'aVwNfSSFS', 'pix', 1),
(4, 1, 'F0MniIA14', 'pix', 1),
(5, 2, '', '', 1),
(6, 2, '', '', 1),
(7, 2, '1ZcGLjuI3', '', 1),
(8, 2, '1ZcGLjuI3', '', 1),
(9, 2, '1ZcGLjuI3', '', 1),
(10, 2, 'EJZU7lVw5', 'pix', 1),
(11, 2, 'EJZU7lVw5', 'pix', 1),
(12, 2, 'EJZU7lVw5', 'pix', 1),
(13, 2, '6kFV3wJG0', 'cartao', 1),
(16, 1, '1SqJIpITR', 'cartao', 1),
(17, 10, 'HiTinAaq8', 'pix', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobre` varchar(1000) NOT NULL,
  `serve` varchar(500) NOT NULL,
  `preco` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servico`
--

INSERT INTO `servico` (`id`, `nome`, `sobre`, `serve`, `preco`, `status`) VALUES
(1, 'Aplicação de Provas', 'A interpretação em Libras para vestibulares, concursos e exames é essencial para garantir que candidatos surdos tenham igualdade de condições no processo avaliativo. Com o suporte de intérpretes, as instruções, questões e orientações são apresentadas de forma acessível, promovendo equidade e inclusão. Instituições de ensino, universidades e organizadoras de concursos devem contratar este serviço para cumprir as normas de acessibilidade e assegurar que todos os participantes possam demonstrar suas competências sem barreiras de comunicação.', 'Interpretação em vestibulares, concursos e exames para garantir igualdade de acesso a candidatos surdos.', 180, 1),
(2, 'Artísticos e Culturais', 'Espetáculos, shows, peças teatrais e sessões de cinema tornam-se experiências verdadeiramente inclusivas com a presença de intérpretes de Libras. Esse serviço permite que o público surdo compreenda diálogos, músicas e narrativas, vivenciando a arte em sua totalidade. Produtores culturais, teatros, cinemas e organizadores de eventos artísticos que desejam atingir um público mais diverso e garantir acessibilidade devem investir na contratação de intérpretes para promover a inclusão social e cultural.', 'Facilitação da acessibilidade em espetáculos, shows e cinemas, promovendo inclusão cultural.', 192, 1),
(4, 'Conferência', 'Em eventos como palestras, seminários, congressos e audiências públicas, o serviço de interpretação em Libras desempenha um papel fundamental na comunicação acessível, permitindo que pessoas surdas acompanhem, participem e contribuam ativamente para discussões e decisões. Esse serviço é indispensável para organizadores de eventos acadêmicos, governamentais e corporativos que buscam atender às leis de acessibilidade, valorizar a diversidade e promover um ambiente inclusivo.\n', 'Tradução em palestras, congressos e eventos similares para ampliar a participação de surdos em debates e reuniões.', 144, 1),
(5, 'Lazer e Turismo', 'Passeios turísticos, visitas a museus, excursões e atividades recreativas podem se tornar mais enriquecedores e acessíveis para pessoas surdas com o acompanhamento de intérpretes de Libras. Essa mediação garante que informações culturais, históricas e instrutivas sejam plenamente compreendidas. Empresas de turismo, museus, parques e organizadores de excursões que valorizam a experiência inclusiva e desejam atender às necessidades de clientes surdos devem contratar esse serviço para ampliar o alcance de suas atividades.', 'Acompanhamento em passeios, museus e excursões, proporcionando experiências inclusivas em atividades recreativas.', 144, 1),
(6, 'Saúde', 'A presença de intérpretes de Libras em consultas médicas, exames, internações, partos e cirurgias é crucial para garantir que pacientes surdos compreendam diagnósticos, tratamentos e orientações médicas. Este serviço assegura uma comunicação clara entre profissionais de saúde e pacientes, contribuindo para um atendimento mais seguro e humanizado. Hospitais, clínicas, laboratórios e profissionais de saúde que desejam respeitar os direitos dos pacientes e oferecer um serviço de qualidade devem investir na contratação de intérpretes.', 'Atendimento em consultas, exames e acompanhamentos médicos, incluindo partos e cirurgias, para garantir comunicação eficaz entre pacientes surdos e profissionais de saúde.', 144, 1),
(7, 'Empresarial', 'Treinamentos corporativos, reuniões, workshops e processos seletivos ganham um novo nível de inclusão e eficácia com intérpretes de Libras, que promovem a integração de colaboradores surdos e a acessibilidade no ambiente de trabalho. Empresas que contratam esse serviço demonstram compromisso com a diversidade e criam um espaço mais colaborativo e acolhedor. Organizações e equipes de Recursos Humanos que desejam capacitar ou integrar profissionais surdos devem investir na interpretação para garantir uma comunicação acessível e igualitária.', 'Tradução em treinamentos, entrevistas de emprego e reuniões para inclusão no ambiente corporativo.', 144, 1),
(8, 'Sociais', 'Momentos especiais como casamentos, batizados, formaturas e cerimônias religiosas devem ser acessíveis a todos os convidados, incluindo pessoas surdas. A presença de intérpretes de Libras permite que esses participantes compreendam os discursos e rituais, tornando o evento ainda mais inclusivo e significativo. Noivos, famílias e organizadores de eventos que valorizam a inclusão e desejam garantir que todos os convidados se sintam bem-vindos devem considerar a contratação deste serviço.', 'Interpretação em eventos como casamentos e formaturas, promovendo inclusão em momentos especiais.', 144, 1),
(9, 'Serviços Públicos', 'Serviços governamentais como cadastro de benefícios, emissão de documentos e atendimento em órgãos públicos tornam-se mais acessíveis e eficientes com o suporte de intérpretes de Libras. Este serviço garante que cidadãos surdos compreendam suas opções e exerçam seus direitos de forma plena. Prefeituras e órgãos públicos que desejam cumprir a legislação de acessibilidade e oferecer um atendimento igualitário e respeitoso devem investir na contratação de intérpretes.', 'Atendimento em cadastros, benefícios e serviços governamentais, assegurando direitos de cidadãos surdos.', 60, 1),
(10, 'Pedagógico', 'Em passeios pedagógicos, feiras, eventos escolares e outras atividades educacionais, intérpretes de Libras desempenham um papel essencial ao garantir que alunos surdos participem plenamente e compreendam todas as informações apresentadas. Escolas, universidades e instituições de ensino que desejam promover a inclusão e oferecer uma experiência educacional completa e acessível devem contratar esse serviço para integrar estudantes surdos de maneira efetiva.', 'Acompanhamento em feiras, passeios escolares e aulas, proporcionando aprendizado inclusivo.', 144, 1),
(11, 'Debate Político', 'A interpretação em Libras durante debates políticos e discursos públicos é fundamental para assegurar que eleitores surdos compreendam as propostas e visões dos candidatos, permitindo que participem ativamente do processo democrático. Partidos políticos, candidatos e organizadores de eventos eleitorais que desejam alcançar o público surdo e promover a inclusão devem contratar este serviço para garantir acessibilidade à informação política.', 'Tradução de debates e campanhas políticas para garantir participação igualitária na vida pública.', 300, 1),
(12, 'Programas Políticos', 'Vinhetas e propagandas eleitorais inclusivas são essenciais para ampliar o alcance das campanhas e garantir que pessoas surdas tenham acesso às propostas dos candidatos. A interpretação em Libras nesse contexto reforça o compromisso com a diversidade e a acessibilidade. Partidos políticos e campanhas eleitorais que buscam engajar o público surdo e fortalecer sua imagem como representantes inclusivos devem contratar esse serviço.', 'Interpretação em vinhetas e propagandas eleitorais para ampliar o acesso à informação política.', 300, 1),
(13, 'Propagandas', 'A inclusão de intérpretes de Libras em campanhas publicitárias permite que marcas e empresas alcancem um público mais amplo, transmitindo suas mensagens de forma acessível. Esse serviço não apenas cumpre as exigências legais de acessibilidade, mas também fortalece a imagem da empresa como socialmente responsável e comprometida com a inclusão. Empresas e agências de publicidade que desejam promover seus produtos e serviços para um público diversificado devem investir na contratação de intérpretes.', 'Tradução em comerciais publicitários para garantir acessibilidade em campanhas de marcas.', 250, 1);

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
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `agendamentolocal`
--
ALTER TABLE `agendamentolocal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `carrossel`
--
ALTER TABLE `carrossel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `chamado_adm`
--
ALTER TABLE `chamado_adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `cli_mudarsenha`
--
ALTER TABLE `cli_mudarsenha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `interprete`
--
ALTER TABLE `interprete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `interprete_documentos`
--
ALTER TABLE `interprete_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `interprete_documentos_temp`
--
ALTER TABLE `interprete_documentos_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `interprete_perfil`
--
ALTER TABLE `interprete_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `interprete_perfil_temp`
--
ALTER TABLE `interprete_perfil_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `interprete_servico`
--
ALTER TABLE `interprete_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `interprete_temp`
--
ALTER TABLE `interprete_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `int_mudarsenha`
--
ALTER TABLE `int_mudarsenha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
