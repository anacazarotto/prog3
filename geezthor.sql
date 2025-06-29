-- Estrutura do banco de dados `geezthor`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `arquivo` (
  `id` int(11) NOT NULL,
  `caminho` varchar(255) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comentario` text NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `projetos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `tipo_projeto` enum('residencial','comercial','reforma','paisagismo','interiores','outro') DEFAULT NULL,
  `status` enum('ativo','orcamento','pausado','concluido') DEFAULT 'ativo',
  `data_inicio` date DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT 0.00,
  `endereco` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `etapas` enum('Orçamento','Estudo Preliminar','Anteprojeto','Projeto Legal','Projeto Executivo') DEFAULT 'Orçamento',
  `horas_trabalhadas` varchar(255) DEFAULT NULL,
  `pendencias` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Índices

ALTER TABLE `arquivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT

ALTER TABLE `arquivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `projetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Restrições de chave estrangeira

ALTER TABLE `arquivo`
  ADD CONSTRAINT `arquivo_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projetos` (`id`);

ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projetos` (`id`);

COMMIT;