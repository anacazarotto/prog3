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
  `user_id` int(11) NOT NULL,
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

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `role` varchar(16) NOT NULL DEFAULT 'user',
  `created_at` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;