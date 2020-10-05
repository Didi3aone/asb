/*
 Navicat Premium Data Transfer

 Source Server         : Server Local Mysql
 Source Server Type    : MySQL
 Source Server Version : 100505
 Source Host           : localhost:3306
 Source Schema         : db_saka_v2

 Target Server Type    : MySQL
 Target Server Version : 100505
 File Encoding         : 65001

 Date: 04/10/2020 22:29:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `kode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_beli` decimal(16,2) DEFAULT 0.00,
  `harga_jual` decimal(16,2) DEFAULT 0.00,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `stok_akhir` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of barang
-- ----------------------------
BEGIN;
INSERT INTO `barang` VALUES (5, 1, 1, 'BRG001', 'Sabun', 0.00, 0.00, NULL, 1, 102019, '2020-09-23 10:10:23', '2020-09-23 10:22:07', NULL, NULL, NULL, NULL);
INSERT INTO `barang` VALUES (6, 1, 1, 'BRG002', 'Sampo', 0.00, 0.00, NULL, 1, 11, '2020-09-23 10:10:40', '2020-09-23 10:22:07', NULL, NULL, NULL, NULL);
INSERT INTO `barang` VALUES (7, 1, 1, 'BRG003', 'Sunlight', 0.00, 0.00, NULL, 1, 0, '2020-09-23 10:10:54', '2020-09-23 10:10:54', NULL, NULL, NULL, NULL);
INSERT INTO `barang` VALUES (12, 1, 1, 'FOT10', 'FOTOOO', 0.00, 0.00, 's:39:\"1600832918image_2020-09-14_10-43-04.png\";', 1, 0, '2020-09-23 10:44:42', '2020-09-23 10:48:38', NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for configurations
-- ----------------------------
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_file` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of configurations
-- ----------------------------
BEGIN;
INSERT INTO `configurations` VALUES (1, 'logo_login', 's:32:\"16009685871200px-Laravel.svg.png\";', 1, '2020-09-25 00:08:18', '2020-09-25 00:29:47');
INSERT INTO `configurations` VALUES (2, 'apps_name', 'ASB', 0, '2020-09-25 00:12:08', '2020-09-25 00:28:58');
INSERT INTO `configurations` VALUES (3, 'footer', 'Qsindo', 0, '2020-09-25 00:15:45', '2020-09-25 00:30:09');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for kategori_barang
-- ----------------------------
DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE `kategori_barang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of kategori_barang
-- ----------------------------
BEGIN;
INSERT INTO `kategori_barang` VALUES (1, 'category 1', 1, '2020-09-22 08:37:40', '2020-09-22 08:37:40', 1, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for log_stok_barang
-- ----------------------------
DROP TABLE IF EXISTS `log_stok_barang`;
CREATE TABLE `log_stok_barang` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_barang_id` bigint(20) NOT NULL,
  `log_type` int(11) NOT NULL DEFAULT 1,
  `qty_before` bigint(20) NOT NULL DEFAULT 0,
  `qty_after` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of log_stok_barang
-- ----------------------------
BEGIN;
INSERT INTO `log_stok_barang` VALUES ('5f6abd4ba0425', 0, 100, 400, 800, '2020-09-23 10:13:15', '2020-09-23 10:13:15', 1, 19);
INSERT INTO `log_stok_barang` VALUES ('5f6abdde44022', 0, 100, 400, 500, '2020-09-23 10:15:42', '2020-09-23 10:15:42', 1, 20);
INSERT INTO `log_stok_barang` VALUES ('5f6abf5fc24d0', 4, 100, 0, 11, '2020-09-23 10:22:07', '2020-09-23 10:22:07', 1, 23);
INSERT INTO `log_stok_barang` VALUES ('5f6abf5fc443a', 0, 100, 400, 102319, '2020-09-23 10:22:07', '2020-09-23 10:22:07', 1, 23);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_04_15_191331679173_create_1555355612601_permissions_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_04_15_191331731390_create_1555355612581_roles_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_04_15_191331779537_create_1555355612782_users_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_04_15_191332603432_create_1555355612603_permission_role_pivot_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_04_15_191332791021_create_1555355612790_role_user_pivot_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_04_15_191441675085_create_1555355681975_products_table', 1);
INSERT INTO `migrations` VALUES (8, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_09_14_030833_alter_user_and_role', 1);
INSERT INTO `migrations` VALUES (10, '2020_09_14_081055_create_tabel_kategori_barang_table', 1);
INSERT INTO `migrations` VALUES (11, '2020_09_14_082040_create_tabel_gudang_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_09_14_085313_create_tabel_supplier_table', 1);
INSERT INTO `migrations` VALUES (13, '2020_09_14_085326_create_tabel_customer_table', 1);
INSERT INTO `migrations` VALUES (14, '2020_09_15_121755_create_unit_barang_table', 1);
INSERT INTO `migrations` VALUES (15, '2020_09_15_163359_create_barang_table', 1);
INSERT INTO `migrations` VALUES (16, '2020_09_15_165441_create_stok_barang_table', 2);
INSERT INTO `migrations` VALUES (17, '2020_09_22_112744_create_configurations_table', 2);
INSERT INTO `migrations` VALUES (21, '2020_09_22_113434_create_transaction_stocks_table', 3);
INSERT INTO `migrations` VALUES (22, '2020_09_22_113448_create_transaction_stock_details_table', 3);
INSERT INTO `migrations` VALUES (24, '2020_09_23_094949_alter_log_stock_barang', 4);
COMMIT;

-- ----------------------------
-- Table structure for mst_customer
-- ----------------------------
DROP TABLE IF EXISTS `mst_customer`;
CREATE TABLE `mst_customer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` bigint(20) DEFAULT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rekening` bigint(20) DEFAULT NULL,
  `ppn` int(11) NOT NULL DEFAULT 0,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for mst_gudang
-- ----------------------------
DROP TABLE IF EXISTS `mst_gudang`;
CREATE TABLE `mst_gudang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_gudang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of mst_gudang
-- ----------------------------
BEGIN;
INSERT INTO `mst_gudang` VALUES (1, 'warehouse 1', 1, '2020-09-23 07:44:48', '2020-09-23 07:44:48', 1, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_supplier
-- ----------------------------
DROP TABLE IF EXISTS `mst_supplier`;
CREATE TABLE `mst_supplier` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` bigint(20) DEFAULT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rekening` bigint(20) DEFAULT NULL,
  `ppn` int(11) NOT NULL DEFAULT 0,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  KEY `permission_role_role_id_foreign` (`role_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` VALUES (1, 1);
INSERT INTO `permission_role` VALUES (1, 2);
INSERT INTO `permission_role` VALUES (1, 3);
INSERT INTO `permission_role` VALUES (1, 4);
INSERT INTO `permission_role` VALUES (1, 5);
INSERT INTO `permission_role` VALUES (1, 6);
INSERT INTO `permission_role` VALUES (1, 7);
INSERT INTO `permission_role` VALUES (1, 8);
INSERT INTO `permission_role` VALUES (1, 9);
INSERT INTO `permission_role` VALUES (1, 10);
INSERT INTO `permission_role` VALUES (1, 11);
INSERT INTO `permission_role` VALUES (1, 12);
INSERT INTO `permission_role` VALUES (1, 13);
INSERT INTO `permission_role` VALUES (1, 14);
INSERT INTO `permission_role` VALUES (1, 15);
INSERT INTO `permission_role` VALUES (1, 16);
INSERT INTO `permission_role` VALUES (2, 17);
INSERT INTO `permission_role` VALUES (2, 18);
INSERT INTO `permission_role` VALUES (2, 19);
INSERT INTO `permission_role` VALUES (2, 20);
INSERT INTO `permission_role` VALUES (2, 21);
INSERT INTO `permission_role` VALUES (1, 22);
INSERT INTO `permission_role` VALUES (1, 23);
INSERT INTO `permission_role` VALUES (1, 24);
INSERT INTO `permission_role` VALUES (1, 25);
INSERT INTO `permission_role` VALUES (1, 26);
INSERT INTO `permission_role` VALUES (1, 27);
INSERT INTO `permission_role` VALUES (1, 28);
INSERT INTO `permission_role` VALUES (1, 29);
INSERT INTO `permission_role` VALUES (1, 30);
INSERT INTO `permission_role` VALUES (1, 31);
INSERT INTO `permission_role` VALUES (1, 32);
INSERT INTO `permission_role` VALUES (1, 33);
INSERT INTO `permission_role` VALUES (1, 34);
INSERT INTO `permission_role` VALUES (1, 35);
INSERT INTO `permission_role` VALUES (1, 36);
INSERT INTO `permission_role` VALUES (1, 37);
INSERT INTO `permission_role` VALUES (1, 38);
INSERT INTO `permission_role` VALUES (1, 39);
INSERT INTO `permission_role` VALUES (1, 40);
INSERT INTO `permission_role` VALUES (1, 41);
INSERT INTO `permission_role` VALUES (1, 42);
INSERT INTO `permission_role` VALUES (1, 43);
INSERT INTO `permission_role` VALUES (1, 44);
INSERT INTO `permission_role` VALUES (1, 45);
INSERT INTO `permission_role` VALUES (1, 46);
INSERT INTO `permission_role` VALUES (1, 47);
INSERT INTO `permission_role` VALUES (1, 48);
INSERT INTO `permission_role` VALUES (1, 49);
INSERT INTO `permission_role` VALUES (1, 50);
INSERT INTO `permission_role` VALUES (1, 51);
INSERT INTO `permission_role` VALUES (1, 52);
INSERT INTO `permission_role` VALUES (1, 53);
INSERT INTO `permission_role` VALUES (1, 54);
INSERT INTO `permission_role` VALUES (1, 55);
INSERT INTO `permission_role` VALUES (1, 56);
INSERT INTO `permission_role` VALUES (1, 57);
INSERT INTO `permission_role` VALUES (1, 58);
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `access_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 'modul_setting_access', '2019-04-15 19:14:42', '2020-09-22 11:48:28', NULL, 'Modul Setting Access');
INSERT INTO `permissions` VALUES (2, 'permission_create', '2019-04-15 19:14:42', '2020-09-22 08:30:50', NULL, 'Permission Create');
INSERT INTO `permissions` VALUES (3, 'permission_edit', '2019-04-15 19:14:42', '2020-09-22 08:30:58', NULL, 'Permission Edit');
INSERT INTO `permissions` VALUES (4, 'permission_show', '2019-04-15 19:14:42', '2020-09-22 08:31:06', NULL, 'Permission Show');
INSERT INTO `permissions` VALUES (5, 'permission_delete', '2019-04-15 19:14:42', '2020-09-22 08:31:14', NULL, 'Permission Delete');
INSERT INTO `permissions` VALUES (6, 'permission_access', '2019-04-15 19:14:42', '2020-09-22 08:31:24', NULL, 'Permission Access');
INSERT INTO `permissions` VALUES (7, 'role_create', '2019-04-15 19:14:42', '2020-09-22 08:31:30', NULL, 'Role Create');
INSERT INTO `permissions` VALUES (8, 'role_edit', '2019-04-15 19:14:42', '2020-09-22 08:31:36', NULL, 'Role Edit');
INSERT INTO `permissions` VALUES (9, 'role_show', '2019-04-15 19:14:42', '2020-09-22 08:31:42', NULL, 'Role Show');
INSERT INTO `permissions` VALUES (10, 'role_delete', '2019-04-15 19:14:42', '2020-09-22 08:31:49', NULL, 'Role Delete');
INSERT INTO `permissions` VALUES (11, 'role_access', '2019-04-15 19:14:42', '2020-09-22 08:31:56', NULL, 'Role Access');
INSERT INTO `permissions` VALUES (12, 'user_create', '2019-04-15 19:14:42', '2020-09-22 08:32:03', NULL, 'User Create');
INSERT INTO `permissions` VALUES (13, 'user_edit', '2019-04-15 19:14:42', '2020-09-22 08:32:09', NULL, 'User Edit');
INSERT INTO `permissions` VALUES (14, 'user_show', '2019-04-15 19:14:42', '2020-09-22 08:32:15', NULL, 'User Show');
INSERT INTO `permissions` VALUES (15, 'user_delete', '2019-04-15 19:14:42', '2020-09-22 08:32:22', NULL, 'User Delete');
INSERT INTO `permissions` VALUES (16, 'user_access', '2019-04-15 19:14:42', '2020-09-22 08:32:31', NULL, 'User Access');
INSERT INTO `permissions` VALUES (17, 'product_create', '2019-04-15 19:14:42', '2020-09-22 11:51:52', '2020-09-22 11:51:52', NULL);
INSERT INTO `permissions` VALUES (18, 'product_edit', '2019-04-15 19:14:42', '2020-09-22 11:51:52', '2020-09-22 11:51:52', NULL);
INSERT INTO `permissions` VALUES (19, 'product_show', '2019-04-15 19:14:42', '2020-09-22 11:51:52', '2020-09-22 11:51:52', NULL);
INSERT INTO `permissions` VALUES (20, 'product_delete', '2019-04-15 19:14:42', '2020-09-22 11:51:52', '2020-09-22 11:51:52', NULL);
INSERT INTO `permissions` VALUES (21, 'product_access', '2019-04-15 19:14:42', '2020-09-22 11:51:52', '2020-09-22 11:51:52', NULL);
INSERT INTO `permissions` VALUES (22, 'modul_item_access', '2020-09-22 08:33:12', '2020-09-22 08:33:12', NULL, 'Modul Item Access');
INSERT INTO `permissions` VALUES (23, 'item_category_access', '2020-09-22 08:33:25', '2020-09-22 08:33:25', NULL, 'Item Category Access');
INSERT INTO `permissions` VALUES (24, 'item_category_create', '2020-09-22 08:33:36', '2020-09-22 08:33:36', NULL, 'Item Category Create');
INSERT INTO `permissions` VALUES (25, 'item_category_edit', '2020-09-22 08:33:59', '2020-09-22 08:33:59', NULL, 'Item Category Edit');
INSERT INTO `permissions` VALUES (26, 'item_category_delete', '2020-09-22 08:34:10', '2020-09-22 08:34:10', NULL, 'Item Category Delete');
INSERT INTO `permissions` VALUES (27, 'item_unit_access', '2020-09-22 08:34:35', '2020-09-22 08:34:35', NULL, 'Item Unit Access');
INSERT INTO `permissions` VALUES (28, 'item_unit_create', '2020-09-22 08:34:48', '2020-09-22 08:34:48', NULL, 'Item Category Create');
INSERT INTO `permissions` VALUES (29, 'item_unit_delete', '2020-09-22 08:35:03', '2020-09-22 08:35:03', NULL, 'Item Unit Delete');
INSERT INTO `permissions` VALUES (30, 'item_unit_edit', '2020-09-22 08:35:12', '2020-09-22 08:35:12', NULL, 'Item Unit Edit');
INSERT INTO `permissions` VALUES (31, 'modul_master_access', '2020-09-22 08:35:21', '2020-09-22 08:35:21', NULL, 'Modul Master Access');
INSERT INTO `permissions` VALUES (32, 'gudang_access', '2020-09-22 08:35:31', '2020-09-22 08:35:31', NULL, 'Gudang Access');
INSERT INTO `permissions` VALUES (33, 'gudang_create', '2020-09-22 08:35:39', '2020-09-22 08:35:39', NULL, 'Gudang Create');
INSERT INTO `permissions` VALUES (34, 'gudang_edit', '2020-09-22 08:35:47', '2020-09-22 08:35:47', NULL, 'Gudang Edit');
INSERT INTO `permissions` VALUES (35, 'gudang_delete', '2020-09-22 08:35:55', '2020-09-22 08:35:55', NULL, 'Gudang Delete');
INSERT INTO `permissions` VALUES (36, 'supplier_access', '2020-09-22 08:36:09', '2020-09-22 08:36:09', NULL, 'Supplier Access');
INSERT INTO `permissions` VALUES (37, 'supplier_create', '2020-09-22 08:36:17', '2020-09-22 08:36:17', NULL, 'Supplier Create');
INSERT INTO `permissions` VALUES (38, 'supplier_delete', '2020-09-22 08:36:25', '2020-09-22 08:36:25', NULL, 'Supplier Delete');
INSERT INTO `permissions` VALUES (39, 'supplier_edit', '2020-09-22 08:36:32', '2020-09-22 08:36:32', NULL, 'Supplier Edit');
INSERT INTO `permissions` VALUES (40, 'customer_access', '2020-09-22 08:36:41', '2020-09-22 08:36:41', NULL, 'Customer Access');
INSERT INTO `permissions` VALUES (41, 'customer_create', '2020-09-22 08:36:47', '2020-09-22 08:36:47', NULL, 'Customer Create');
INSERT INTO `permissions` VALUES (42, 'customer_delete', '2020-09-22 08:36:56', '2020-09-22 08:36:56', NULL, 'Customer Delete');
INSERT INTO `permissions` VALUES (43, 'customer_edit', '2020-09-22 08:37:09', '2020-09-22 08:37:09', NULL, 'Customer Edit');
INSERT INTO `permissions` VALUES (44, 'item_access', '2020-09-22 08:39:18', '2020-09-22 08:39:18', NULL, 'item Access');
INSERT INTO `permissions` VALUES (45, 'item_create', '2020-09-22 08:39:27', '2020-09-22 08:39:27', NULL, 'Item Create');
INSERT INTO `permissions` VALUES (46, 'item_edit', '2020-09-22 08:39:37', '2020-09-22 08:39:37', NULL, 'Item Edit');
INSERT INTO `permissions` VALUES (47, 'item_delete', '2020-09-22 08:39:48', '2020-09-22 08:39:48', NULL, 'Item Delete');
INSERT INTO `permissions` VALUES (48, 'item_show', '2020-09-22 08:40:03', '2020-09-22 08:40:03', NULL, 'Item Show');
INSERT INTO `permissions` VALUES (49, 'modul_transaction_access', '2020-09-22 09:08:36', '2020-09-22 09:08:36', NULL, 'Modul Transaction');
INSERT INTO `permissions` VALUES (50, 'config_access', '2020-09-22 11:50:59', '2020-09-22 11:50:59', NULL, 'Configuration Access');
INSERT INTO `permissions` VALUES (51, 'config_create', '2020-09-22 11:51:13', '2020-09-22 11:51:13', NULL, 'Configuration Create');
INSERT INTO `permissions` VALUES (52, 'config_edit', '2020-09-22 11:51:26', '2020-09-22 11:51:26', NULL, 'Configuration Edit');
INSERT INTO `permissions` VALUES (53, 'config_show', '2020-09-22 13:34:25', '2020-09-22 13:34:25', NULL, 'Configuration Show');
INSERT INTO `permissions` VALUES (54, 'transaction_access', '2020-09-22 13:35:03', '2020-09-22 13:35:03', NULL, 'Transaction Access');
INSERT INTO `permissions` VALUES (55, 'transaction_create', '2020-09-22 13:35:17', '2020-09-22 13:35:17', NULL, 'Transaction Create');
INSERT INTO `permissions` VALUES (56, 'transaction_edit', '2020-09-22 13:35:26', '2020-09-22 13:35:26', NULL, 'Transaction Edit');
INSERT INTO `permissions` VALUES (57, 'transaction_show', '2020-09-22 13:35:36', '2020-09-22 13:35:36', NULL, 'Transaction Show');
INSERT INTO `permissions` VALUES (58, 'transaction_delete', '2020-09-22 13:36:05', '2020-09-22 13:36:05', NULL, 'Transaction Delete');
COMMIT;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
BEGIN;
INSERT INTO `role_user` VALUES (1, 1);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'Admin', '2019-04-15 19:13:32', '2019-04-15 19:13:32', NULL);
INSERT INTO `roles` VALUES (2, 'User', '2019-04-15 19:13:32', '2019-04-15 19:13:32', NULL);
COMMIT;

-- ----------------------------
-- Table structure for stok_barang
-- ----------------------------
DROP TABLE IF EXISTS `stok_barang`;
CREATE TABLE `stok_barang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gudang_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `stock` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stok_barang
-- ----------------------------
BEGIN;
INSERT INTO `stok_barang` VALUES (2, 1, 3, 500, '2020-09-23 10:07:52', '2020-09-23 10:07:52');
INSERT INTO `stok_barang` VALUES (3, 1, 5, 400, '2020-09-23 10:11:27', '2020-09-23 10:11:27');
INSERT INTO `stok_barang` VALUES (4, 1, 6, 11, '2020-09-23 10:22:07', '2020-09-23 10:22:07');
COMMIT;

-- ----------------------------
-- Table structure for transaksi_stok_details
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_stok_details`;
CREATE TABLE `transaksi_stok_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint(20) NOT NULL,
  `nomor_sparepart` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of transaksi_stok_details
-- ----------------------------
BEGIN;
INSERT INTO `transaksi_stok_details` VALUES (20, 20, '1', 5, 100, '2020-09-23 10:15:42', '2020-09-23 10:15:42');
INSERT INTO `transaksi_stok_details` VALUES (21, 23, '1', 6, 11, '2020-09-23 10:22:07', '2020-09-23 10:22:07');
INSERT INTO `transaksi_stok_details` VALUES (22, 23, '8', 5, 101919, '2020-09-23 10:22:07', '2020-09-23 10:22:07');
COMMIT;

-- ----------------------------
-- Table structure for transaksi_stoks
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_stoks`;
CREATE TABLE `transaksi_stoks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_ijin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `gudang_id` bigint(20) NOT NULL,
  `tipe` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of transaksi_stoks
-- ----------------------------
BEGIN;
INSERT INTO `transaksi_stoks` VALUES (20, '1600830942', '0191', '2020-09-23', 1, 1, 1, '2020-09-23 10:15:42', '2020-09-23 10:15:42', NULL, NULL, NULL, NULL);
INSERT INTO `transaksi_stoks` VALUES (23, '1600831327', 'sadsa21312', '2020-09-23', 1, 1, 1, '2020-09-23 10:22:07', '2020-09-23 10:22:07', NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for unit_barang
-- ----------------------------
DROP TABLE IF EXISTS `unit_barang`;
CREATE TABLE `unit_barang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of unit_barang
-- ----------------------------
BEGIN;
INSERT INTO `unit_barang` VALUES (1, 'Unit 1', '2020-09-22 09:01:41', '2020-09-22 09:01:41', 1, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `theme_color` int(11) NOT NULL DEFAULT 1,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Admin', 'admin@admin.com', NULL, '$2y$10$CNeaE9RVTsjAzb0lhQ/52OyzZZn.2EPjPn1Gy0Wm4t4oxia/oWwo2', NULL, '2019-04-15 19:13:32', '2020-09-24 14:14:46', NULL, 1, NULL, 1);
COMMIT;

-- ----------------------------
-- View structure for view_barang_stock
-- ----------------------------
DROP VIEW IF EXISTS `view_barang_stock`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang_stock` AS select `br`.`nama` AS `nama`,`kb`.`nama` AS `kategori`,`ub`.`nama` AS `unit`,`sb`.`stock` AS `stock`,`g`.`nama_gudang` AS `nama_gudang` from ((((`barang` `br` join `kategori_barang` `kb` on(`br`.`kategori_id` = `kb`.`id`)) join `unit_barang` `ub` on(`ub`.`id` = `br`.`unit_id`)) left join `stok_barang` `sb` on(`sb`.`barang_id` = `br`.`id`)) left join `mst_gudang` `g` on(`g`.`id` = `sb`.`gudang_id`)) where `br`.`is_active` = 1 and `kb`.`is_active` = 1;

-- ----------------------------
-- View structure for view_barang_stock_habis
-- ----------------------------
DROP VIEW IF EXISTS `view_barang_stock_habis`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang_stock_habis` AS select `br`.`nama` AS `nama`,`kb`.`nama` AS `kategori`,`ub`.`nama` AS `unit`,`sb`.`stock` AS `stock`,`g`.`nama_gudang` AS `nama_gudang` from ((((`barang` `br` join `kategori_barang` `kb` on(`br`.`kategori_id` = `kb`.`id`)) join `unit_barang` `ub` on(`ub`.`id` = `br`.`unit_id`)) left join `stok_barang` `sb` on(`sb`.`barang_id` = `br`.`id`)) left join `mst_gudang` `g` on(`g`.`id` = `sb`.`gudang_id`)) where `br`.`is_active` = 1 and `kb`.`is_active` = 1 and `sb`.`stock` = 0;

SET FOREIGN_KEY_CHECKS = 1;
