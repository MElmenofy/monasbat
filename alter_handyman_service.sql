CREATE TABLE `taxes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '1' COMMENT 'fixed , percent',
  `value` double DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '1- Active , 0- InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES  (37, '2022_01_10_093501_create_taxes_table', 5);

ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `taxes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
 
 ALTER TABLE `provider_types`  ADD `type` VARCHAR(255) NULL ;  
 INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES  (38, '2022_01_11_051545_alter_provider_types', 5);

 CREATE TABLE `provider_taxes` (
  `id` bigint UNSIGNED NOT NULL,
  `provider_id` bigint UNSIGNED DEFAULT NULL,
  `tax_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES  (39, '2022_01_12_100148_create_provider_taxes_table', 5);
 --
-- Indexes for table `provider_taxes`
--
ALTER TABLE `provider_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_taxes_provider_id_foreign` (`provider_id`);
--
-- AUTO_INCREMENT for table `provider_taxes`
--
ALTER TABLE `provider_taxes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `provider_taxes`
--
ALTER TABLE `provider_taxes`
  ADD CONSTRAINT `provider_taxes_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Table structure for table `provider_payouts`
--

CREATE TABLE `provider_payouts` (
  `id` bigint UNSIGNED NOT NULL,
  `provider_id` bigint UNSIGNED DEFAULT NULL,
  `payment_method` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `amount` double DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
 INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES  (40, '2022_01_12_100212_create_provider_payouts_table', 5);

 --
-- Indexes for table `provider_payouts`
--
ALTER TABLE `provider_payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_payouts_provider_id_foreign` (`provider_id`);

--
-- AUTO_INCREMENT for table `provider_payouts`
--
ALTER TABLE `provider_payouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `provider_payouts`
--
ALTER TABLE `provider_payouts`
  ADD CONSTRAINT `provider_payouts_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;


 ALTER TABLE `bookings`  ADD `tax` longtext NULL ;  
 INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES  (41, '2022_01_20_091224_alter_booking_tax', 5);
