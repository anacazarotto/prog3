CREATE TABLE `user` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(64) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `auth_key` VARCHAR(32) NOT NULL,
  `role` VARCHAR(16) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `projetos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `cliente` VARCHAR(255) NOT NULL,
  `tipo_projeto` ENUM('residencial','comercial','reforma','paisagismo','interiores','outro') DEFAULT NULL,
  `status` ENUM('ativo','orcamento','pausado','concluido') DEFAULT 'ativo',
  `data_inicio` DATE DEFAULT NULL,
  `data_entrega` DATE DEFAULT NULL,
  `valor_total` DECIMAL(10,2) DEFAULT 0.00,
  `endereco` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `etapas` ENUM('Orçamento','Estudo Preliminar','Anteprojeto','Projeto Legal','Projeto Executivo') DEFAULT 'Orçamento',
  `horas_trabalhadas` INT(11) DEFAULT NULL,
  `pendencias` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `arquivo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `caminho` VARCHAR(255) NOT NULL,
  `project_id` INT(11) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`project_id`) REFERENCES `projetos`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `comentario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `comentario` TEXT NOT NULL,
  `project_id` INT(11) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`project_id`) REFERENCES `projetos`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migration` (
  `version` VARCHAR(180) NOT NULL,
  `apply_time` INT(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `username`, `password_hash`, `auth_key`, `role`) VALUES (NULL, 'admin', '$2y$13$qYzsXR/1XHY9ujtB8P2.YegmXBrarCAe8QrbOuwnstJ9OScTD2g1S', '3eIVb20XP0eMvmEUf8YwSuvB8AnJpS9m', 'admin')
