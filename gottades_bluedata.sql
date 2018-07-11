-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb.cihar.com~yakkety.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2018 at 10:58 AM
-- Server version: 5.7.15-0ubuntu2
-- PHP Version: 7.0.8-3ubuntu3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gottades_bluedata`
--
CREATE DATABASE IF NOT EXISTS `gottades_bluedata` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gottades_bluedata`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orgId` int(10) UNSIGNED NOT NULL,
  `officeId` int(10) UNSIGNED NOT NULL,
  `departmentId` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `superAdmin` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `all_department`
--

DROP TABLE IF EXISTS `all_department`;
CREATE TABLE `all_department` (
  `id` int(22) NOT NULL,
  `department` varchar(225) NOT NULL,
  `orgId` int(10) NOT NULL DEFAULT '0',
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_department`
--

INSERT INTO `all_department` (`id`, `department`, `orgId`, `status`, `created_at`, `updated_at`) VALUES
(1, 'IT', 0, 'Active', NULL, NULL),
(2, 'MARKETING', 0, 'Active', NULL, NULL),
(3, 'SALES', 0, 'Active', NULL, NULL),
(4, 'INVENTORY', 0, 'Active', NULL, NULL),
(5, 'INSURANCE', 0, 'Active', NULL, NULL),
(6, 'PURCHASING', 0, 'Active', NULL, NULL),
(7, 'QUALITY ASURANCE', 0, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orgId` int(10) UNSIGNED NOT NULL,
  `officeId` int(10) UNSIGNED NOT NULL,
  `departmentId` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleId` int(10) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numberOfEmployees` int(11) DEFAULT NULL,
  `officeId` int(10) UNSIGNED DEFAULT NULL,
  `orgId` int(10) UNSIGNED DEFAULT NULL,
  `departmentId` int(22) DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `numberOfEmployees`, `officeId`, `orgId`, `departmentId`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 9, 6, 2, 'Active', '2018-06-13 23:06:13', NULL),
(2, NULL, NULL, 9, 6, 2, 'Active', '2018-06-13 23:06:13', NULL),
(3, NULL, NULL, 10, 6, 1, 'Active', '2018-06-13 23:06:13', NULL),
(4, NULL, NULL, 10, 6, 1, 'Active', '2018-06-13 23:06:13', NULL),
(5, NULL, NULL, 9, 6, 2, 'Active', '2018-06-20 03:51:00', NULL),
(6, NULL, NULL, 9, 6, 2, 'Active', '2018-06-21 00:04:34', NULL),
(7, NULL, NULL, 9, 6, 2, 'Active', '2018-06-21 00:05:09', NULL),
(9, NULL, NULL, 28, 16, 3, 'Active', '2018-06-25 08:15:42', NULL),
(10, NULL, NULL, 26, 15, 2, 'Active', '2018-06-25 08:17:16', NULL),
(11, NULL, NULL, 26, 15, 2, 'Active', '2018-06-25 08:20:48', NULL),
(12, NULL, NULL, 28, NULL, 4, 'Active', '2018-06-29 04:22:13', NULL),
(13, NULL, NULL, 29, NULL, 2, 'Active', '2018-06-29 04:24:43', NULL),
(14, NULL, NULL, 29, NULL, 2, 'Active', '2018-06-29 04:26:00', NULL),
(15, NULL, NULL, 29, NULL, 3, 'Active', '2018-06-29 04:26:28', NULL),
(16, NULL, NULL, 29, NULL, 2, 'Active', '2018-06-29 04:28:56', NULL),
(17, NULL, NULL, 28, NULL, 2, 'Active', '2018-06-29 04:30:23', NULL),
(18, NULL, NULL, 31, 20, 2, 'Active', '2018-06-29 06:44:42', NULL),
(19, NULL, NULL, 31, 20, 4, 'Active', '2018-06-29 06:44:42', NULL),
(20, NULL, NULL, 31, 20, 7, 'Active', '2018-06-29 06:44:42', NULL),
(21, NULL, NULL, 30, 20, 3, 'Active', '2018-06-29 07:13:08', NULL),
(22, NULL, NULL, 30, 20, 1, 'Active', '2018-06-29 07:17:13', NULL),
(23, NULL, NULL, 31, 20, 3, 'Active', '2018-06-29 07:17:51', NULL),
(24, NULL, NULL, 32, NULL, 3, 'Active', '2018-06-29 09:04:48', NULL),
(25, NULL, NULL, 32, 16, 5, 'Active', '2018-07-01 23:07:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(6, '2016_06_01_000004_create_oauth_clients_table', 2),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(8, '2018_02_08_061140_create_clients_table', 3),
(9, '2018_02_08_061149_create_admins_table', 3),
(10, '2018_07_02_071949_create_permission_tables', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('02afc8505ec893bc58c19eb1b320d07a67f62ebad4c5379a2f03d34c6be7248dcccad3cdebd95d59', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:56:23', '2018-06-08 07:56:23', '2019-06-08 13:26:23'),
('0727a92a2caf3527f8b48e356ae2dea669928651eef2909196e554580212b39828e1fb04e8540a14', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:53:23', '2018-06-08 07:53:23', '2019-06-08 13:23:23'),
('115770e00845cc0f0c4df6092c25709c4ea5aae1332c810ad9d6aeba00488f42bfd395ecacc5ec8b', 3, 9, 'tribe365', '[]', 0, '2018-05-23 06:53:55', '2018-05-23 06:53:55', '2019-05-23 12:23:55'),
('11eecedd9c43a9109aae62568035b756d13f4b1d7da94fee04fb7c83d9edf517726ca4f94573dd96', 1, 9, 'tribe365', '[]', 0, '2018-06-13 07:13:26', '2018-06-13 07:13:26', '2019-06-13 12:43:26'),
('1828ce5099f51471385089da23ca63211c11ba4c9d6b58455c41538207601032d296c2357fe13f58', 4, 9, 'tribe365', '[]', 0, '2018-05-29 23:46:42', '2018-05-29 23:46:42', '2019-05-30 05:16:42'),
('18f0b7c7172e44ab6e9f3489821a0a646e9e19262af654e6351ff552c714e2d0bb525a248cf98f4b', 3, 9, 'tribe365', '[]', 0, '2018-05-23 06:48:48', '2018-05-23 06:48:48', '2019-05-23 12:18:48'),
('1a0bc24a4416fcc82f880af783cde4ff83c6b6d883568b3af3ae8368e460790a11643fac01dedc5e', 11, 9, 'tribe365', '[]', 0, '2018-06-26 06:14:46', '2018-06-26 06:14:46', '2019-06-26 11:44:46'),
('1c092aaead45286b8e9755bd81c72f5e0d5fa123051383abcf9d464203c239c9f70698dbee231428', 11, 9, 'tribe365', '[]', 0, '2018-07-01 23:17:22', '2018-07-01 23:17:22', '2019-07-02 04:47:22'),
('1e36b7bfc23b7ddaef1bb7977678fecc8e834151accd54aa7a546a3d2e494a46dafcca9dcfc099cf', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:55:36', '2018-06-08 07:55:36', '2019-06-08 13:25:36'),
('1f073f0634c408b493665f4fce37a56f4ddc2fa9f9b7c302e33a91865835326a8b73c2d50ad0829e', 6, 9, 'tribe365', '[]', 0, '2018-06-12 07:15:09', '2018-06-12 07:15:09', '2019-06-12 12:45:09'),
('1f1f3ad4476c121352ae9b1014ee5073718822980842397825a68273a2906951f92f6574138cdff4', 1, 9, 'tribe365', '[]', 0, '2018-06-29 09:48:57', '2018-06-29 09:48:57', '2019-06-29 15:18:57'),
('23d91a6752c3cfe13b0ad56616a27b3d1b9bf729b3cb0c90c1ae8a7286a4da5a7259fea8c3bf999f', 1, 9, 'tribe365', '[]', 0, '2018-06-29 08:34:43', '2018-06-29 08:34:43', '2019-06-29 14:04:43'),
('3213413ce7e7c52c5ea4323bd82db9c256c023a90bf7cc9d1855fb1bd6d3694db1b0fc81c2239eb9', 1, 9, 'tribe365', '[]', 0, '2018-06-13 02:07:59', '2018-06-13 02:07:59', '2019-06-13 07:37:59'),
('3219e2eb610adf1003f587a3b2f0b8f55673f29dea92e955a08f939c94ea2ae1285ac81b88f22f52', 12, 9, 'tribe365', '[]', 0, '2018-06-11 08:39:02', '2018-06-11 08:39:02', '2019-06-11 14:09:02'),
('32428a10be3cbd104279c17c46e172f71c0f4df6a150ba6d2aea949d29cd6149aa3d4968730b115a', 11, 9, 'tribe365', '[]', 0, '2018-06-22 06:29:00', '2018-06-22 06:29:00', '2019-06-22 11:59:00'),
('3324bb4cc4cac627437c5f9887b6e104622cf6ad21417f4186567cd303ab7587b8b17c727c9f30d2', 1, 9, 'tribe365', '[]', 0, '2018-06-28 05:10:37', '2018-06-28 05:10:37', '2019-06-28 10:40:37'),
('34d238d4daaac6d49a5bd9a9e989bcc08affff7a723484f6019de6b8e2f2c22b96e5b7b6a437d0c7', 11, 9, 'tribe365', '[]', 0, '2018-06-29 08:53:19', '2018-06-29 08:53:19', '2019-06-29 14:23:19'),
('388bafd1b3faef0afeec92b02f37112b549f364712986b3cc09e957a6738ad02c229ef58d55aee97', 1, 9, 'tribe365', '[]', 0, '2018-06-19 23:51:55', '2018-06-19 23:51:55', '2019-06-20 05:21:55'),
('3b560a104cc200db546e1dc66cfdab2f5f813f0f8a5234a33e51e59a36c2e0275e8a32fff936b7e4', 11, 9, 'tribe365', '[]', 0, '2018-07-01 23:08:58', '2018-07-01 23:08:58', '2019-07-02 04:38:58'),
('3bc5ef86faf4f6709755dc2f2b721be02f1575587daf2c732253a873fb04fc624fa778cde827cb62', 1, 9, 'tribe365', '[]', 0, '2018-06-18 00:32:54', '2018-06-18 00:32:54', '2019-06-18 06:02:54'),
('3caf98a21a53cef9a202794bef4fcf3130e3f6157f16105e12b12e5e8ec4615c6b3f60a0766ab653', 1, 9, 'tribe365', '[]', 0, '2018-06-13 01:01:48', '2018-06-13 01:01:48', '2019-06-13 06:31:48'),
('428517d4397cc01e60515e22bfd2ca2fb4a7b9175bbaebe2c88ab49355111e9bac67f0afcf0de5c3', 1, 9, 'tribe365', '[]', 0, '2018-06-29 10:09:23', '2018-06-29 10:09:23', '2019-06-29 15:39:23'),
('43ca3b13c33ef75e86b883ccf9126be2d65494ccb52fb53ea6ad1b91b3ff4c6e34f48313a349861e', 3, 9, 'tribe365', '[]', 1, '2018-05-18 07:24:28', '2018-05-18 07:24:28', '2019-05-18 12:54:28'),
('4f750a38d1283efd82450dcfba7f6b115850b28b080317e9c715792846bcb9592925ce7c8960c3db', 1, 9, 'tribe365', '[]', 0, '2018-06-13 00:55:46', '2018-06-13 00:55:46', '2019-06-13 06:25:46'),
('50dce8d773958098115ee41d696cfafec6dea18cb0c077035afbfe52e895fb6f9d9aac00f7101e0b', 1, 9, 'tribe365', '[]', 0, '2018-06-28 00:21:39', '2018-06-28 00:21:39', '2019-06-28 05:51:39'),
('537d8280114a3e9b9cfef795162dd44d5d491057d434d842a35fc121b2aed86569617823a5b12dfd', 1, 9, 'tribe365', '[]', 0, '2018-06-13 05:53:22', '2018-06-13 05:53:22', '2019-06-13 11:23:22'),
('5443d1f790846ee912b08ee4211521ab5ab27dfce59b068a2facba9d3bf8a9073efa0436b4483f97', 11, 9, 'tribe365', '[]', 0, '2018-06-29 07:23:15', '2018-06-29 07:23:15', '2019-06-29 12:53:15'),
('54d277e9a237f8bde66d3779d5f6b5e8ec87fce948868462374ca65380901e4b249d2bbc776e1ea5', 3, 9, 'tribe365', '[]', 0, '2018-05-18 06:48:47', '2018-05-18 06:48:47', '2019-05-18 12:18:47'),
('555515b7aac89847e545ed441f1d60a5a955635b7960f8fe0f0505d24af16ad0a3ea1a69d65b425c', 11, 9, 'tribe365', '[]', 0, '2018-06-26 22:47:12', '2018-06-26 22:47:12', '2019-06-27 04:17:12'),
('555fdde8d7e843f4b5f9112da7b53ea39e860f4e69a8e94771b344b67cfdfa6f16df7a71c9edbf9f', 11, 9, 'tribe365', '[]', 0, '2018-06-29 03:31:19', '2018-06-29 03:31:19', '2019-06-29 09:01:19'),
('5c0749fd6ef918a728f7783ed7b9f3b0c77b48a52f50f6424dff804f25acdbb0cea65288fb634d6f', 1, 9, 'tribe365', '[]', 0, '2018-06-29 09:03:21', '2018-06-29 09:03:21', '2019-06-29 14:33:21'),
('62835ce1fbdfaa793db103129ebe92267b03c7790100bc1d487cd22f3674142c48751aca66b62d6c', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:56:47', '2018-06-08 07:56:47', '2019-06-08 13:26:47'),
('628781f81840a1593a1cc7709fb96fe4e50cf67a9ab2a43ada208713cc7d4352a5936d5265016c17', 11, 9, 'tribe365', '[]', 0, '2018-06-22 06:42:48', '2018-06-22 06:42:48', '2019-06-22 12:12:48'),
('68dfe82fbf76c2a2b59edb59107bd7938adc89c3fe9eb6f362d7e316c2de489190b654539cfa34d3', 1, 9, 'tribe365', '[]', 0, '2018-06-08 05:59:29', '2018-06-08 05:59:29', '2019-06-08 11:29:29'),
('6a0a72a67e681f99ac1dafe14428dceea7fdab021756fb503d71222da0d8f683af4fd3870bd23c68', 11, 9, 'tribe365', '[]', 0, '2018-06-29 09:11:25', '2018-06-29 09:11:25', '2019-06-29 14:41:25'),
('6d7fbed5cd5896a6508d397fda2e5fcf37d7b47a77e60f08084b535681953104cf22c47af2444835', 3, 9, 'tribe365', '[]', 0, '2018-05-18 07:28:55', '2018-05-18 07:28:55', '2019-05-18 12:58:55'),
('6f0ea010f195c03f815e20690dd08d96f56f326660f9168d3ff549ce9746ac3dbee43f468e67e9fc', 4, 9, 'tribe365', '[]', 0, '2018-05-29 23:46:33', '2018-05-29 23:46:33', '2019-05-30 05:16:33'),
('7288ca7c44a017a57b19956790463b756f2ca67e74e4e706d0abd1ac402857e604fb88d571507f4e', 3, 9, 'tribe365', '[]', 1, '2018-05-23 06:13:54', '2018-05-23 06:13:54', '2019-05-23 11:43:54'),
('72946771db267d5e733ac2f28fa30963d23dca0d7be71e24aef559922e3e32ffc144f7f92d0b6e49', 1, 9, 'tribe365', '[]', 0, '2018-06-19 04:23:46', '2018-06-19 04:23:46', '2019-06-19 09:53:46'),
('75cd9fe6d558a79d89d090600d00013c7b010744214d31841ec644e51700b383cb3d4f8216b97b2e', 1, 9, 'tribe365', '[]', 0, '2018-06-13 04:24:26', '2018-06-13 04:24:26', '2019-06-13 09:54:26'),
('7ad0c2e051ac1102cee831a4c0049c4dd2e7a1e6577a0c28136672ed2bd50816e2555f4c40df5b9a', 16, 9, 'tribe365', '[]', 0, '2018-06-22 06:28:40', '2018-06-22 06:28:40', '2019-06-22 11:58:40'),
('7d3624c3e57e8be84ef35a1beec244aaeae7a4f9e1bd55d95d313bb95ab5fe80d0f3aae9ca44f608', 1, 9, 'tribe365', '[]', 0, '2018-06-29 10:04:59', '2018-06-29 10:04:59', '2019-06-29 15:34:59'),
('7d9fb2921853a3736ccd8a91eaef1b1064844ef86818e4061bcd0dd813330292d5f1fb3a5384717d', 1, 9, 'tribe365', '[]', 0, '2018-06-07 00:32:58', '2018-06-07 00:32:58', '2019-06-07 06:02:58'),
('84db1aa40268cc91588f1e1896077f63c2a3047aaa77b8034d0e565def8f1f4b52ab6016bb12b203', 11, 9, 'tribe365', '[]', 0, '2018-06-26 05:59:48', '2018-06-26 05:59:48', '2019-06-26 11:29:48'),
('88dadfa109f88b21a3cb15c335dca188cf909ae04fb269f6c1458797cb761b405b58eb7083229347', 1, 9, 'tribe365', '[]', 0, '2018-06-29 03:33:50', '2018-06-29 03:33:50', '2019-06-29 09:03:50'),
('920f9e9a5159c0b9daa3c82ad10ac4507290535ee17df847c256feca071a9f0c90fe53b09ca4705f', 1, 9, 'tribe365', '[]', 0, '2018-06-22 07:06:26', '2018-06-22 07:06:26', '2019-06-22 12:36:26'),
('968225cfcb0e82ac408bfe3423586ab764b4e7c3ad13df8f2fbf0a256b2b77a29e25a0b94ede0c7c', 12, 9, 'tribe365', '[]', 0, '2018-06-11 06:58:44', '2018-06-11 06:58:44', '2019-06-11 12:28:44'),
('985ca147abdb61af937ccbbcf6f29a741fbb95155248f2f18d181f2549e6e2ca16c621bccaae066c', 3, 9, 'tribe365', '[]', 1, '2018-05-18 07:26:09', '2018-05-18 07:26:09', '2019-05-18 12:56:09'),
('a449626ae4ca629182e665f2d218194526ea6c807fe80acfc8cadd20caa45ad6bcd79893628007ad', 1, 9, 'tribe365', '[]', 0, '2018-06-25 06:52:15', '2018-06-25 06:52:15', '2019-06-25 12:22:15'),
('a7cdbf1fbdd7f18ff189378933bd8016835e0a98e62e434e836f5642f3de79f03c504cb8a24bbb52', 3, 9, 'tribe365', '[]', 1, '2018-05-18 07:27:28', '2018-05-18 07:27:28', '2019-05-18 12:57:28'),
('acba56eba317c6afe975edb1e9bdd6089a482d0b406aa099b963e8cab5f7446ab7ed0bc11359489f', 11, 9, 'tribe365', '[]', 0, '2018-06-26 05:26:46', '2018-06-26 05:26:46', '2019-06-26 10:56:46'),
('af9f067cacdd3f7db8adf7123dd172b042f179b55fdfe54c7cacde541cb4b91637ee84f051c08f6a', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:30:36', '2018-06-08 07:30:36', '2019-06-08 13:00:36'),
('b41bc53df47d02df824b8285ff03aee7e06ec9f9a6eb9a747de34b2338cb531dcf94d0ba8bd60e20', 1, 9, 'tribe365', '[]', 0, '2018-06-19 03:14:19', '2018-06-19 03:14:19', '2019-06-19 08:44:19'),
('b64e139d2afbdf9c533062f5652fc813df0a972a1515d6f2ae9ffb02c9a99f91a9db75db521e9896', 11, 9, 'tribe365', '[]', 0, '2018-06-29 09:08:41', '2018-06-29 09:08:41', '2019-06-29 14:38:41'),
('b6e8f19af4238e8768937003987787f1b9850e9b170d1df849b33cb125d54ccc1760c73767639cce', 11, 9, 'tribe365', '[]', 0, '2018-06-26 05:58:38', '2018-06-26 05:58:38', '2019-06-26 11:28:38'),
('bade4314ccf1656a21a18fcaa7c037ce6b86bb02b76fe6cb6b4e3a5d8f467a2575eb5eded879b8a0', 11, 9, 'tribe365', '[]', 0, '2018-06-28 00:24:33', '2018-06-28 00:24:33', '2019-06-28 05:54:33'),
('bb2556cb85d335853a84a99c8b0b3d0e62b67869624073dee0f67493fc42bb77734fef4b242f0247', 1, 9, 'tribe365', '[]', 0, '2018-06-29 08:58:59', '2018-06-29 08:58:59', '2019-06-29 14:28:59'),
('bcfb9b024beb1b49979cd72b4dec0a86b67dc1fb652c92c51c7e0c10b736b4c674365c58c1ae3329', 11, 9, 'tribe365', '[]', 0, '2018-06-19 08:32:40', '2018-06-19 08:32:40', '2019-06-19 14:02:40'),
('c652aa944618e7760e198791fdbf789ffd8e1cfa382de046a230c86c2beb693d73f4b1809836b4e3', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:55:01', '2018-06-08 07:55:01', '2019-06-08 13:25:01'),
('c6cd6c9bd734fbde08383fb1ae1b2ae0bf7f9faccb3640d2c9c7d190288118605ec4b0645ce09644', 6, 9, 'tribe365', '[]', 0, '2018-06-12 07:28:35', '2018-06-12 07:28:35', '2019-06-12 12:58:35'),
('c8733526fd3239fe7669f3396605fe4d30b6b2c7d6c45df19ce3e4c6c82dbe893b137b963407bbc8', 11, 9, 'tribe365', '[]', 0, '2018-07-01 23:13:50', '2018-07-01 23:13:50', '2019-07-02 04:43:50'),
('cb1b8934248a864eee0be67ff7e88bbd762968c23048ce432797dbd102649dec3c1b2920df33eda8', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:54:07', '2018-06-08 07:54:07', '2019-06-08 13:24:07'),
('cc1a434c792b411720c63754567fd8a1a36d06e2dff6d4f377119ab62ebd8ecc594724e284cb90ab', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:33:00', '2018-06-08 07:33:00', '2019-06-08 13:03:00'),
('da013d71b9100386f2cfaa48fbd9f158cc9b4a70e9c786e13751ba217195530add2909e828669d88', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:39:07', '2018-06-08 07:39:07', '2019-06-08 13:09:07'),
('db4f88e53071cc97571ad19e9539169995b67f8b4ccaa468cb96700333cd644901c93b475c7da9ec', 11, 9, 'tribe365', '[]', 0, '2018-06-26 06:32:20', '2018-06-26 06:32:20', '2019-06-26 12:02:20'),
('db67fd05def294a984e049c1f0234652d74da4f6061ced2e4e723407ffdbf0b8f25717bfe240d9dd', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:58:15', '2018-06-08 07:58:15', '2019-06-08 13:28:15'),
('dee6e4edf0e18f50075d5a4b78aa0cd05a6d0830c5c830e9a78c6ef10df324e75b4dfc3b2bda00f6', 11, 9, 'tribe365', '[]', 0, '2018-06-26 00:25:56', '2018-06-26 00:25:56', '2019-06-26 05:55:56'),
('df1a2a0cfb66114b129db9e48efcde298185255aaa1d1e7f0623cad42ec2fc5e525f4938ba24076e', 12, 9, 'tribe365', '[\"admin\"]', 0, '2018-06-11 23:01:54', '2018-06-11 23:01:54', '2019-06-12 04:31:54'),
('e0a5b48b368395cf4a1fe150d50bd175af66fad642992b59990729fcb2dc0747926207f75b20363d', 12, 9, 'tribe365', '[\"place-orders\"]', 0, '2018-06-12 00:55:07', '2018-06-12 00:55:07', '2019-06-12 06:25:07'),
('e3a6a8eb237b6841c214ec03d805045db9734cf958dbde2a3d30fe3f7990eca8401ccbfe25ec5a5c', 1, 9, 'tribe365', '[]', 0, '2018-06-25 01:27:35', '2018-06-25 01:27:35', '2019-06-25 06:57:35'),
('e4091b88ec44a7bfa9474fbb5e68c27115bc1bc7a1af5815148a0d86c1683783bd75e9babcba822b', 1, 9, 'tribe365', '[]', 0, '2018-06-08 05:58:03', '2018-06-08 05:58:03', '2019-06-08 11:28:03'),
('e7971924e15af65c74f01bb44e2624d90b674188cf890bd7df8f8b139659058b5088feeffbdb2aeb', 1, 9, 'tribe365', '[]', 0, '2018-06-13 04:26:55', '2018-06-13 04:26:55', '2019-06-13 09:56:55'),
('e79d145942d6d436cbed740e0384a1495b74636bf3e3852cea63a80df008c1595119c239f425655b', 11, 9, 'tribe365', '[]', 0, '2018-06-26 22:46:23', '2018-06-26 22:46:23', '2019-06-27 04:16:23'),
('e828df18cfa763d9e498e952e76560acadceae29a7f9f60250715d4d71eac7564b3368ce07ded7c1', 11, 9, 'tribe365', '[]', 0, '2018-06-29 07:13:04', '2018-06-29 07:13:04', '2019-06-29 12:43:04'),
('ea19551f0ec6774c2c9bc10467fffd8b91ea11a45e3909006aace1cf6e3e8ce6336a4cfee2f4ec11', 6, 9, 'tribe365', '[]', 0, '2018-06-12 08:07:04', '2018-06-12 08:07:04', '2019-06-12 13:37:04'),
('ecba8cf2f42c41eff150e045c9bafd37116854073348578cfe4e5fa2f42ec170cc345c33cff22c69', 1, 9, 'tribe365', '[]', 0, '2018-06-12 23:52:25', '2018-06-12 23:52:25', '2019-06-13 05:22:25'),
('ecd3ad23a4380075ac80bfb5968cb434fd18311dde41f0c6318f93ba55386035357f08801af14f1d', 1, 9, 'tribe365', '[]', 0, '2018-06-08 07:57:10', '2018-06-08 07:57:10', '2019-06-08 13:27:10'),
('eecadb9f96118b4c03698de0f16515319205f649e80319a19cb8276120e141eddaa49f7046b6c91f', 11, 9, 'tribe365', '[]', 0, '2018-06-29 08:36:40', '2018-06-29 08:36:40', '2019-06-29 14:06:40'),
('ef27df8cfc7dacf348bac31f5421b71a386ac10169ad69fa816d43c70a4c16016e826ac04c9b8855', 1, 9, 'tribe365', '[]', 0, '2018-06-23 01:49:25', '2018-06-23 01:49:25', '2019-06-23 07:19:25'),
('fc0dd54964e516985ab8812d72c11fbb06a1f41339fabe568d5ddc74e875ad067139eabdae8141e3', 12, 9, 'tribe365', '[\"admin\"]', 0, '2018-06-12 00:03:34', '2018-06-12 00:03:34', '2019-06-12 05:33:34'),
('fd26817290d8698734b784fd81e3862763a2310237fa1987512f67db78eb22f104232ba81bcbe2de', 3, 9, 'tribe365', '[]', 0, '2018-05-18 07:14:04', '2018-05-18 07:14:04', '2019-05-18 12:44:04'),
('feb64ae08ac8fe0ea4267bdd670bcbfe1e30f71addb9320ed197afec82bd381a85da65efa0d76cf3', 1, 9, 'tribe365', '[]', 0, '2018-06-08 05:58:15', '2018-06-08 05:58:15', '2019-06-08 11:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'Qpy92Lm4n7UpnxrutCyUvoFSDBh56Iku4NLdVHhb', 'http://localhost', 1, 0, 0, '2018-05-15 07:54:22', '2018-05-15 07:54:22'),
(2, NULL, 'Laravel Password Grant Client', 'bGboYrFyGGPxeNglkXUp3oX9o73Yx9gQageVfjLA', 'http://localhost', 0, 1, 0, '2018-05-15 07:54:22', '2018-05-15 07:54:22'),
(3, NULL, 'Laravel Personal Access Client', 'dakeAUaoVFUi9YNLDWBQ9Z92E6jd1a8SQrQcvO28', 'http://localhost', 1, 0, 0, '2018-05-15 08:04:32', '2018-05-15 08:04:32'),
(4, NULL, 'Laravel Password Grant Client', 'uMHySqdQr7jAyEy3zv6mXMUOyYWDMkS0cPyGRfwD', 'http://localhost', 0, 1, 0, '2018-05-15 08:04:32', '2018-05-15 08:04:32'),
(5, NULL, 'Laravel Personal Access Client', 'CIHPgIs24zlmxqjBq41JhiwgH7N0vrTLrQn5rPiy', 'http://localhost', 1, 0, 0, '2018-05-15 08:13:29', '2018-05-15 08:13:29'),
(6, NULL, 'Laravel Password Grant Client', 'AIA2FQgd1SLRZ7lpoDY5OAFvVG86IZz7HYFaXnIe', 'http://localhost', 0, 1, 0, '2018-05-15 08:13:29', '2018-05-15 08:13:29'),
(7, NULL, 'Laravel Personal Access Client', 'BdknCk3xwk7WhpXHRW3y428OgwnUF7PlGjtl0JsG', 'http://localhost', 1, 0, 0, '2018-05-16 00:26:29', '2018-05-16 00:26:29'),
(8, NULL, 'Laravel Password Grant Client', 'P0ZYHvxtLQ8VcrC8WLjUUp9FSe1pjhv7m86wDDbT', 'http://localhost', 0, 1, 0, '2018-05-16 00:26:29', '2018-05-16 00:26:29'),
(9, NULL, 'Laravel Personal Access Client', '6zQR6BiMT8WMo27l2aXPy1ycP2P941FEDkEsJD1i', 'http://localhost', 1, 0, 0, '2018-05-18 04:00:03', '2018-05-18 04:00:03'),
(10, NULL, 'Laravel Password Grant Client', 'iebp4ydLutSD6Gr4WS25p5xINz2pAi0eGcjylT49', 'http://localhost', 0, 1, 0, '2018-05-18 04:00:03', '2018-05-18 04:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-05-15 07:54:22', '2018-05-15 07:54:22'),
(2, 3, '2018-05-15 08:04:32', '2018-05-15 08:04:32'),
(3, 5, '2018-05-15 08:13:29', '2018-05-15 08:13:29'),
(4, 7, '2018-05-16 00:26:29', '2018-05-16 00:26:29'),
(5, 9, '2018-05-18 04:00:03', '2018-05-18 04:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
CREATE TABLE `offices` (
  `id` int(10) UNSIGNED NOT NULL,
  `office` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numberOfEmployees` int(11) NOT NULL,
  `numberOfDepartments` int(11) NOT NULL,
  `orgId` int(10) UNSIGNED NOT NULL,
  `type` enum('Office','Site') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office`, `address`, `city`, `country`, `phone`, `numberOfEmployees`, `numberOfDepartments`, `orgId`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Indore', NULL, NULL, NULL, NULL, 303, 0, 1, 'Office', 'Active', '2018-06-12 23:48:36', '2018-06-12 23:48:36'),
(2, 'Srilanka', NULL, NULL, NULL, NULL, 20, 0, 2, 'Office', 'Active', '2018-06-12 23:50:57', '2018-06-12 23:50:57'),
(9, 'indore-11', NULL, NULL, NULL, NULL, 0, 0, 6, 'Office', 'Active', '2018-06-13 07:07:45', NULL),
(10, 'bhopal-12', NULL, NULL, NULL, NULL, 0, 0, 6, 'Office', 'Active', '2018-06-13 07:07:45', NULL),
(11, 'Indore', NULL, NULL, NULL, NULL, 20, 0, 7, 'Office', 'Active', '2018-06-18 03:14:47', '2018-06-18 03:14:47'),
(12, 'indore-11', '144-1 indore mp', 'Indore', 'India', '789564688', 0, 0, 8, 'Office', 'Active', '2018-06-19 06:11:05', NULL),
(13, 'indore-11', '144-2 Bhopal mp', 'Bhopal', 'UK', '789564688', 0, 0, 8, 'Office', 'Active', '2018-06-19 06:11:05', NULL),
(14, 'Indore-11', '144-1 indore mp', 'Indore', 'India', '789564688', 12, 0, 9, 'Office', 'Active', '2018-06-19 06:17:24', NULL),
(15, 'Indore-11', '144-2 Bhopal mp', 'Bhopal', 'UK', '789564688', 5, 0, 9, 'Office', 'Active', '2018-06-19 06:17:24', NULL),
(16, 'indore-11', '144-1 indore mp', 'Indore', 'India', '789564688', 0, 0, 10, 'Office', 'Active', '2018-06-21 08:27:27', NULL),
(17, 'Indore-11', '144-2 Bhopal mp', 'Bhopal', 'UK', '789564688', 0, 0, 10, 'Office', 'Active', '2018-06-21 08:27:27', NULL),
(18, 'indore-11', '144-1 indore mp', 'Indore', 'India', '789564688', 0, 0, 11, 'Office', 'Active', '2018-06-22 02:12:53', NULL),
(19, 'indore-11', '144-2 Bhopal mp', 'Bhopal', 'UK', '789564688', 0, 0, 11, 'Office', 'Active', '2018-06-22 02:12:53', NULL),
(20, 'adaDS', 'ADSAsd', 'asdad', 'DASdasd', 'asdadas', 0, 0, 12, 'Office', 'Active', '2018-06-22 03:35:37', NULL),
(21, 'asdasd', 'Sfasdfas', 'sdfasfd', 'asdasd', 'fasdf', 0, 0, 12, 'Office', 'Active', '2018-06-22 03:35:37', NULL),
(22, 'dfgsdfg', 'Dfgsdf', 'dfgdfg', 'dfgdfg', 'gdsfgsdf', 0, 0, 13, 'Office', 'Active', '2018-06-22 03:38:56', NULL),
(23, 'dfgdg', 'Dfgdg', 'dfgd', 'dfgdfg', 'fgdfgd', 0, 0, 13, 'Office', 'Active', '2018-06-22 03:38:56', NULL),
(24, 'adaDS', 'ADSAsd', 'asdad', 'DASdasd', 'asdadas', 0, 0, 14, 'Office', 'Active', '2018-06-22 04:22:56', NULL),
(25, 'asdasd', 'Sfasdfas', 'sdfasfd', 'asdasd', 'fasdf', 0, 0, 14, 'Office', 'Active', '2018-06-22 04:22:56', NULL),
(26, 'adaDS', 'ADSAsd', 'asdad', 'DASdasd', 'asdadas', 0, 0, 15, 'Office', 'Active', '2018-06-22 04:24:44', NULL),
(27, 'Asdasd', 'Sfasdfas', 'sdfasfd', 'asdasd', 'fasdf', 0, 0, 15, 'Office', 'Active', '2018-06-22 04:24:44', NULL),
(28, 'dfgsdfg', 'Dfgsdfg dfgsdfg', 'sdfasdfdasf', 'dfadsfsf', '45234535', 0, 0, 16, 'Office', 'Active', '2018-06-22 04:55:57', NULL),
(29, 'Office-1 indore', NULL, NULL, NULL, NULL, 10, 0, 17, 'Office', 'Active', '2018-06-28 06:35:31', '2018-06-28 06:35:31'),
(30, 'Office-indore', NULL, NULL, NULL, NULL, 20, 0, 19, 'Office', 'Active', '2018-06-29 05:53:09', '2018-06-29 05:53:09'),
(31, 'Admin-user', NULL, NULL, NULL, NULL, 10, 0, 20, 'Office', 'Active', '2018-06-29 06:44:42', '2018-06-29 06:44:42'),
(32, 'office', 'address', 'indore', 'india', '96305258884', 0, 0, 21, 'Office', 'Active', '2018-06-29 07:34:28', NULL),
(33, 'ofname', 'address', 'city', 'country', '96385244555', 0, 0, 22, 'Office', 'Active', '2018-06-29 07:43:52', NULL),
(34, 'djjdjd', 'Fmdmdmf', 'McNamara', 'dndnnd', 'snsns', 0, 0, 23, 'Office', 'Active', '2018-06-29 09:06:46', NULL),
(35, 'djdjd', 'Dndnnd jfirir', 'ttt', 'ggg', '123654', 0, 0, 24, 'Office', 'Active', '2018-06-29 09:30:57', NULL),
(36, 'test New', 'Abc', 'abc', 'indore123', '123654', 0, 0, 25, 'Office', 'Active', '2018-06-29 09:32:51', NULL),
(37, 'hsi', 'haus', 'jsjs', 'hshhs', '97979554', 0, 0, 26, 'Office', 'Active', '2018-06-29 10:20:06', NULL),
(38, 'dxnsjdj', 'dnndjdrj hshs', 'xdkdkd', 'dhjdd', '28899', 0, 0, 27, 'Office', 'Active', '2018-06-29 10:33:39', NULL),
(39, 'vut', 'uv', 'jv', 'ig', '38', 0, 0, 28, 'Office', 'Active', '2018-07-01 23:03:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
CREATE TABLE `organisations` (
  `id` int(10) UNSIGNED NOT NULL,
  `organisation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `industry` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turnover` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numberOfEmployees` int(11) DEFAULT NULL,
  `numberOfOffices` int(11) DEFAULT NULL,
  `numberOfDepartments` int(11) DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `superOrganisation` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ImageURL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `organisation`, `address1`, `address2`, `address3`, `postcode`, `industry`, `phone`, `turnover`, `numberOfEmployees`, `numberOfOffices`, `numberOfDepartments`, `status`, `superOrganisation`, `ImageURL`, `created_at`, `updated_at`) VALUES
(1, 'IBM', 'UK', 'india', '', '452015', 'IT', '13213544', '146564564', 303, 1, 0, 'Active', 'N', 'org_img_1528867116.png', '2018-06-12 23:48:36', '2018-06-12 23:48:36'),
(2, 'AT&T', 'Uk', 'Srilanka', '', '452015', 'IT', '987888779', '1564464', 20, 1, 0, 'Active', 'N', 'org_img_1528867257.png', '2018-06-12 23:50:57', '2018-06-12 23:50:57'),
(6, 'TNT-Group123', 'indore', NULL, NULL, NULL, 'support', '45644887', '10255656', 0, 2, 0, 'Inactive', NULL, 'org_1528893465.png', '2018-06-13 07:07:45', NULL),
(7, 'Microsoft45', 'Uk', 'India', '', '452015', 'Software', '879467668', '4878648', 20, 1, 0, 'Active', 'N', 'org_1529311487.jpg', '2018-06-18 03:14:47', '2018-06-18 03:14:47'),
(8, 'TNT-Group', 'indore', NULL, NULL, NULL, 'support', '45644887', '10255656', 0, 2, 0, 'Inactive', NULL, 'org_1529408465.png', '2018-06-19 06:11:05', NULL),
(9, 'TNT-Group2', 'Indore', 'Add2', NULL, NULL, '45644887', '45644887', '10255656', 0, 2, 0, 'Inactive', NULL, 'org_1529408844.png', '2018-06-19 06:17:24', NULL),
(10, 'TNT-Group', 'indore', NULL, NULL, NULL, 'support', '45644887', NULL, 0, 2, 0, 'Inactive', NULL, 'org_1529589447.png', '2018-06-21 08:27:27', NULL),
(11, 'TNT-Group', 'indore', NULL, NULL, NULL, 'support', '45644887', NULL, 0, 2, 0, 'Inactive', NULL, 'org_1529653373.png', '2018-06-22 02:12:53', NULL),
(12, 'fsdjfha', 'jsdkfhaldfjkhas', NULL, NULL, NULL, 'ajshdfladks', NULL, NULL, 0, 2, 0, 'Inactive', NULL, '', '2018-06-22 03:35:37', NULL),
(13, 'dfgsdfg', 'dfgsdf', NULL, NULL, NULL, 'dfgsdf', NULL, NULL, 0, 2, 0, 'Inactive', NULL, '', '2018-06-22 03:38:56', NULL),
(14, 'fsdjfha', 'jsdkfhaldfjkhas', NULL, NULL, NULL, 'ajshdfladks', NULL, NULL, 0, 2, 0, 'Inactive', NULL, 'org_1529661176.png', '2018-06-22 04:22:56', NULL),
(15, 'fsdjfha', 'jsdkfhaldfjkhas', NULL, NULL, NULL, 'ajshdfladks', NULL, NULL, 0, 2, 0, 'Inactive', NULL, 'org_1529661284.png', '2018-06-22 04:24:44', NULL),
(16, 'xzCZXcsd', 'dfgsdfg a', NULL, NULL, NULL, 'dfgsdfg', NULL, NULL, 0, 1, 0, 'Inactive', NULL, 'org_1529663157.png', '2018-06-22 04:55:57', NULL),
(17, 'Chetaru', 'indore', 'vajay nagar indore', '', '452015', 'IT', '7897988787', '1000025', 10, 1, 0, 'Inactive', 'N', 'org_1530187531.png', '2018-06-28 06:35:31', '2018-06-28 06:35:31'),
(18, 'Apple Inc.', 'One Apple Park Way', 'Cupertino, CA 95014', '', '452015', 'Hardware', '4089961010', '84', 0, 0, 0, 'Active', 'N', 'org_1530258798.png', '2018-06-29 02:23:18', '2018-06-29 02:23:18'),
(19, 'chetaru', 'indore', 'Bhopal', '', '452015', 'IT', '45644887', '1000025', 20, 1, 0, 'Active', 'N', 'org_1530271389.png', '2018-06-29 05:53:09', '2018-06-29 05:53:09'),
(20, 'testing', 'indore', 'Bhopal', '', '452015', 'Automobile', '45644887', '1000025', 10, 1, 0, 'Inactive', 'N', 'org_1530274482.png', '2018-06-29 06:44:42', '2018-06-29 06:44:42'),
(21, 'name', 'address', NULL, NULL, NULL, 'industry', '900090990', NULL, 0, 1, 0, 'Active', NULL, 'org_1530277468.png', '2018-06-29 07:34:28', NULL),
(22, 'c namr', 'address', NULL, NULL, NULL, 'industry', NULL, NULL, 0, 1, 0, 'Active', NULL, 'org_1530278032.png', '2018-06-29 07:43:52', NULL),
(23, 'test p1', 'kxdkkd', NULL, NULL, NULL, 'abc', NULL, NULL, 0, 1, 0, 'Active', NULL, 'org_1530283006.png', '2018-06-29 09:06:46', NULL),
(24, 'dhdjd jdjd', 'djjsjdjd jdjd', NULL, NULL, NULL, 'djdjjd djjdjd', NULL, NULL, 0, 1, 0, 'Active', NULL, 'org_1530284457.png', '2018-06-29 09:30:57', NULL),
(25, 'test123', 'anc', NULL, NULL, NULL, 'test', NULL, NULL, 0, 1, 0, 'Active', NULL, 'org_1530284571.png', '2018-06-29 09:32:51', NULL),
(26, 'xhfy', 'uduf', NULL, NULL, NULL, 'hddy', NULL, NULL, 0, 1, 0, 'Active', NULL, '', '2018-06-29 10:20:06', NULL),
(27, 'djdjd', 'djsjjsjd', NULL, NULL, NULL, 'jdjddj', NULL, NULL, 0, 1, 0, 'Active', NULL, 'org_1530288219.png', '2018-06-29 10:33:39', NULL),
(28, 'bh', 'ug', NULL, NULL, NULL, 'jvg', NULL, NULL, 0, 1, 0, 'Active', NULL, '', '2018-07-01 23:03:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2018-07-01 18:30:00', NULL),
(2, 'client', 'web', '2018-07-01 18:30:00', NULL),
(3, 'employee', 'web', '2018-07-01 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int(10) DEFAULT NULL,
  `office_id` int(10) DEFAULT NULL,
  `department_id` int(10) DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='for employee table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `password2`, `organisation_id`, `office_id`, `department_id`, `status`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@chetaru.com', '$2y$12$qCLay7l79Y3wrc3fKepsE.JDRRmLH3ReXcxqoXf/xCiEyQQr8IBYq', NULL, NULL, NULL, NULL, 'Active', 1, 'namFX56f0UYlmmPZlCCiy01JX7TRDmFuC1OUdOX9p6eb7RhjYGkCuXysXxf9', '2018-06-13 05:13:17', NULL),
(2, 'Client-john', 'info@ibm.com', '$2y$10$GruidlTYLYC2YhC6BRcpGuVmrC/17VqsEf/A2TdDzrOyWTReF3sNS', 'MTIz', 1, NULL, NULL, 'Active', 2, NULL, '2018-06-12 23:48:36', '2018-06-12 23:48:36'),
(3, 'Jay', 'jay@ibm', '$2y$10$IErU8HyAUgveJvyFcs39FOuHx.nGktaPDaPaycdNUB.LwwsZEneLy', NULL, NULL, 1, 7, 'Active', 3, NULL, '2018-06-12 23:48:36', '2018-06-12 23:48:36'),
(4, 'Client-roy', 'info@atnt.com', '$2y$10$Z60GW6PW5dLgU9G5qT9BTuOJcaGcYuYXN1UHOpEvG4IrlmkmSQMBi', 'MTIz', 2, NULL, NULL, 'Active', 2, NULL, '2018-06-12 23:50:57', '2018-06-12 23:50:57'),
(5, 'Messy', 'messy@atnt.com', '$2y$10$IrxmRCSI38Aile3OR/8/EeDwH53izfiGYFpIwypAFfxNrC/1YZAoS', NULL, NULL, 2, 7, 'Active', 3, NULL, '2018-06-12 23:50:57', '2018-06-12 23:50:57'),
(9, 'TNT-Group', 'aakash02@chetaru.com', '$2y$10$aSTHaqiIIGK2tA0irLeoKeLEjkhTs48sNS3cWPShbUBB84FPXYMm6', 'MTIz', 6, NULL, NULL, 'Active', 2, NULL, '2018-06-13 07:07:45', NULL),
(11, 'Jay', 'jay@test.com', '$2y$10$9rwgxTPTPd011wB30kFLr.O0AhM4zItoQidKJ2TijZMh.fk5G.coO', NULL, 6, 9, 2, 'Active', 3, NULL, '2018-06-13 23:06:13', NULL),
(12, 'Jaypal', 'jay1@test.com', '$2y$10$Xp0simf17F4xWeoNR2pJMOiWcqB5GtxgGsWWtTl44SrrxZVQIfI7q', NULL, 6, 9, 2, 'Active', 3, NULL, '2018-06-13 23:06:13', NULL),
(13, 'priya', 'priya@test.com', '$2y$10$/YfAfSHxl9RRjnJX4TYWGOX7ZCR9q0J5iPcibXXDLnLYsC.k.gSTu', NULL, 6, 10, 1, 'Active', 3, NULL, '2018-06-13 23:06:13', NULL),
(14, 'jaya', 'jaya@test.com', '$2y$10$KlJyJZXZfH4PuLgoc3qnIu3UlBNsBxhSKW99GZeHpKryaut4mWriS', NULL, 6, 10, 1, 'Active', 3, NULL, '2018-06-13 23:06:13', NULL),
(15, 'Clientdfs', 'contact@ms.com', '$2y$10$GCo0eFD4qkWyXuhyyChULeqjAa65/fxe3LsaTzctsawY5JD7oAj.K', 'MTIz', 7, NULL, NULL, 'Active', 2, NULL, '2018-06-18 03:14:47', '2018-06-18 03:14:47'),
(16, 'User1', 'user1@ms.com', '$2y$10$cWSm1Vus90gzRSVsr36T/uKH4vQTnbuqwOPa25QO9NCYfREFqlJk2', NULL, NULL, 11, 7, 'Active', 3, NULL, '2018-06-18 03:14:47', '2018-06-18 03:14:47'),
(17, 'User2', 'user2@ms.com', '$2y$10$z.CHXInCUutiHMWVO5n9ie8UqerhmzVdA/rovbu6Y.yo44pS846ja', NULL, NULL, 11, 7, 'Active', 3, NULL, '2018-06-18 03:14:47', '2018-06-18 03:14:47'),
(18, 'TNT-Group', 'aakash022@chetaru.com', '$2y$10$edGLwZCwnz5kLEEXCg.n6.YjEw77bZJFeFCZOfUymyU48Gt9xCnYm', 'MTIz', 8, NULL, NULL, 'Active', 2, NULL, '2018-06-19 06:11:05', NULL),
(19, 'TNT-Group', 'aakash0222@chetaru.com', '$2y$10$eejsdo2EuGEyoaxCMssla.JyqHXXVzLOTTiQvtEYzTxtGZEui./0C', 'MTIz', 9, NULL, NULL, 'Active', 2, NULL, '2018-06-19 06:17:24', NULL),
(20, 'Jay', 'jay236@test.com', '$2y$10$i3wkLAid5Vl4QgH.G7htl.GmdQHv99rpCi27fKusisHtLAZ6KeN3S', NULL, 6, 9, 2, 'Active', 3, NULL, '2018-06-20 03:51:00', NULL),
(21, 'Jay', 'r@r.com', '$2y$10$cj7U/nV3eOoT7ewqMWDfE.zfSl5WNJ6qSOM2oZJc6ZGeR38zNXOUi', NULL, 6, 9, 2, 'Active', 3, NULL, '2018-06-21 00:04:34', NULL),
(22, 'R', 'rat@r.com', '$2y$10$47tunH87vE6asGwdzMVRLOQPb4/.GCGxk1tDs8ezZeuB/KLh11Ly2', NULL, 6, 9, 2, 'Active', 3, NULL, '2018-06-21 00:05:09', NULL),
(23, 'Aakash', 'aakash02222@chetaru.com', '$2y$10$1Zi9Wu4T6JkBMq0cphva.ex05DF5YGp7b7BB7N88AMMnql1kt7dc2', 'MTIz', 10, NULL, NULL, 'Active', 2, NULL, '2018-06-21 08:27:27', NULL),
(24, 'Aakash', 'aakash022226@chetaru.com', '$2y$10$BKDdnz6nveZ0s9nX2mhgeeSY8m88E7Q7t8MfO9vwEN1mZGpBqANTO', 'MTIz', 11, NULL, NULL, 'Active', 2, NULL, '2018-06-22 02:12:53', NULL),
(25, 'Djklfhasdklfhasdfljksfhas', 'sdfads@facebook.com', '$2y$10$kaAhJyXQNmHmiOBtry27OuxWLRC31Zu5c.TULGnSUPDORz1C7cn3C', 'MTIz', 12, NULL, NULL, 'Active', 2, NULL, '2018-06-22 03:35:38', NULL),
(26, 'Dfgdfg', 'dfgsdfgfgdsdfg', '$2y$10$YkBIpjg14CAAbr9mLtEpHO8Qvd1b.6Yb7f1gc9JNev7S8Cut0PFWK', 'ZGZnZGY=', 13, NULL, NULL, 'Active', 2, NULL, '2018-06-22 03:38:56', NULL),
(27, 'Djklfhasdklfhasdfljksfhas', 'aakash@facebook.com', '$2y$10$s/aSMJ9lmURygJG/3We4UOHYBzY6Fveo4FjU3nyxaTpqyx2q7Kfji', 'MTIz', 14, NULL, NULL, 'Active', 2, NULL, '2018-06-22 04:22:56', NULL),
(28, 'Aakash', 'aakash05@facebook.com', '$2y$10$sih/M07Fh4yszJ9gW3xc7unehotCPuinToe3xSHWZAgD6nWoLM7n.', 'MTIz', 15, NULL, NULL, 'Active', 2, NULL, '2018-06-22 04:24:44', NULL),
(29, 'Dfgsdfg', 'sdfasdf', '$2y$10$98gh1EwzUlwryRjUDXy6Y./HLI9MCGlz0T2LxOeF3fXlhWrMSUZNC', 'YXNkZmFzZg==', 16, NULL, NULL, 'Active', 2, NULL, '2018-06-22 04:55:58', NULL),
(30, '123654', 'ggg@gmail.com', '$2y$10$gVvu8C03jyWx6hgkECPM5u/4ovkxjKnOzajZ1Kqx69CO24QEhmQZO', NULL, 123654, 25, 3, 'Active', 3, NULL, '2018-06-25 08:07:09', NULL),
(31, 'Test User Audition', 'abc@abc.abc', '$2y$10$kIYHM26DIOUjfqNGtUHdDuKg1Kz6aMiBvyYE.nMvx5uNhw5vSg6Z6', NULL, 16, 28, 3, 'Active', 3, NULL, '2018-06-25 08:15:42', NULL),
(32, 'Sdfgsdfg', 'xzcZXCC@dfssd.com', '$2y$10$sjNU6C9066Nfges/uIYWiu9jmCbKUTJLXUnufy3QuMblSZJle9.ve', NULL, 15, 26, 2, 'Active', 3, NULL, '2018-06-25 08:17:16', NULL),
(33, 'Fgtesrtewtwert', 'ertwert', '$2y$10$68msBGK3/0lpPlpKK6kcDeAlOnzy.nPJQ292JPixRAtUDGh8Qt1dK', NULL, 15, 26, 2, 'Active', 3, NULL, '2018-06-25 08:20:48', NULL),
(34, 'Client', 'chetaru@chetaru.com', '$2y$10$/NDSLWjTuzZCS7VjuddByuwA.bynt.7OkPLn4bSmnmxdETO43YUyi', 'MTIz', 17, NULL, NULL, 'Active', 2, NULL, '2018-06-28 06:35:31', '2018-06-28 06:35:31'),
(35, 'User1', 'user12@chetaru.com', '$2y$10$D9SYmL8Is7AWMai.Sl/xJuNkD00Pr641.D76/uIZveVczQqCj0g1a', NULL, NULL, 29, 7, 'Active', 3, NULL, '2018-06-28 06:35:31', '2018-06-28 06:35:31'),
(36, 'User2', 'user23@chetaru.com', '$2y$10$y80AlwEDNSsO62RyyFkM/u6Ztrhhm3S.ghGJ9EHMnlH8xEB48hLSK', NULL, NULL, 29, 7, 'Active', 3, NULL, '2018-06-28 06:35:31', '2018-06-28 06:35:31'),
(37, 'Apple', 'info@apple.com', '$2y$10$lc5Fd9cDATwr377TGGer1eVzPXfyaLm6jDoyR9SIbQ/cyKrUnkj8m', 'YXBwbGUxMjM=', 18, NULL, NULL, 'Active', 2, NULL, '2018-06-29 02:23:19', '2018-06-29 02:23:19'),
(38, 'Fgsdafa', 'avcf@gmail.com', '$2y$10$5RjJhu6ZWD1haIZJow6hauPfDNSefwtP0TjWKR4RLc8lcnwG8SfEq', NULL, NULL, 28, 4, 'Active', 3, NULL, '2018-06-29 04:22:13', NULL),
(39, 'Fdhdfgh', 'hfdh@fdg.dfs', '$2y$10$d5PSFO66iVyvtucu4vgri.zJuiljnPqQyn1AZcLzNLcpdwjVtwz/.', NULL, NULL, 29, 2, 'Active', 3, NULL, '2018-06-29 04:24:43', NULL),
(40, 'Youuyio', 'ioyuoyu', '$2y$10$xaNJH7Pm6VHYwaFPPBBs5elRa1YTWm89PwHAKGW5ygvfrKIWH55c.', NULL, NULL, 29, 2, 'Active', 3, NULL, '2018-06-29 04:26:00', NULL),
(41, 'Your', 'uioyuoi@dtg.com', '$2y$10$I5/THzTo1SE8CtYbqxCDaONDld8tS4AlwlaMxclBdw.xbRqBRej7q', NULL, NULL, 29, 3, 'Active', 3, NULL, '2018-06-29 04:26:28', NULL),
(42, 'Referrer', 'ertwe@dfghd.cvb', '$2y$10$ZA42WJ8dKbTcl1iluJNejeroZxbS.j9a1QMoVXRSbfdRsROd/3JB6', NULL, NULL, 29, 2, 'Active', 3, NULL, '2018-06-29 04:28:56', NULL),
(43, 'Tutti', 'trutry@dfhdf.tyu', '$2y$10$cP/trdOlaeLg8Dp5u.kfaOPSVdA4kKb13UILJQG9WsWucjnZm9uJK', NULL, NULL, 28, 2, 'Active', 3, NULL, '2018-06-29 04:30:23', NULL),
(44, 'Admin', 'admin489@chetaru.in', '$2y$10$4XzG0FaTS6kftB3sVe.yAudCnSoZUgu9BLt4CAxYPKeNELIQP5yYG', 'MTIz', 19, NULL, NULL, 'Active', 2, NULL, '2018-06-29 05:53:09', '2018-06-29 05:53:09'),
(45, 'User1', 'rahul132@bajaj.com', '$2y$10$NO3F0BkJvKJxtkkb8KSZaO20cCCVSFs1Aj7ArDaQ84A2.pnN7dfW.', NULL, NULL, 30, 7, 'Active', 3, NULL, '2018-06-29 05:53:09', '2018-06-29 05:53:09'),
(46, 'User2', 'rahul456@bajaj.com', '$2y$10$vJO2RuHK3zG3dCZRoRWXaOo0mm4mq2qyuXv/aPfETf2prLy6Nqjz6', NULL, NULL, 30, 6, 'Active', 3, NULL, '2018-06-29 05:53:09', '2018-06-29 05:53:09'),
(47, 'Test-user', 'tst@gmail.com', '$2y$10$dpb8KStmPCDwMc2zsyIaeOeUF5nyE.ixIKNi6.8/TInCBsGREa7Hy', 'MTIz', 20, NULL, NULL, 'Active', 2, NULL, '2018-06-29 06:44:42', '2018-06-29 06:44:42'),
(48, 'User1', 'user123@gmail.com', '$2y$10$/qMCzcsKddYjr8eNrgkS1ec5ZYyKlITv/RTn3nTBuVeG/jppLv6Ji', NULL, NULL, 31, 2, 'Active', 3, NULL, '2018-06-29 06:44:42', '2018-06-29 06:44:42'),
(49, 'User2', 'user236@gmail.com', '$2y$10$9bfp9py0E0z1WJG4O/nVneW0HDWG1UNbv41OBKozjw0G0Nf/56bX2', NULL, NULL, 31, 4, 'Active', 3, NULL, '2018-06-29 06:44:42', '2018-06-29 06:44:42'),
(50, 'User3', 'user879@gmail.com', '$2y$10$tiKlBbhc3nwnWeExvgNaBee8mkq9HA5KWxwB0CrDRlMMwwm33qRXe', NULL, NULL, 31, 7, 'Active', 3, NULL, '2018-06-29 06:44:42', '2018-06-29 06:44:42'),
(51, 'Name', 'email', '$2y$10$jEUAOyArGB1.EkgbUZcHqePrdOCmj/7VVUqdQHxswM/zJXZ2wf5L6', NULL, 20, 30, 3, 'Active', 3, NULL, '2018-06-29 07:13:08', NULL),
(52, 'Prakhar', 'premail', '$2y$10$0Wm42ifwKDBVJxZR6e/lLuSwNc9XVhcIdR/qH9/2prBy6x3bgOQFC', NULL, 20, 30, 1, 'Active', 3, NULL, '2018-06-29 07:17:13', NULL),
(53, 'Hemant', 'hemail', '$2y$10$YCDSOOCkaUsoyTRZbEoC/ez/W5rrg3PoI2h8Y.FqDaXsvkgdsZA2S', NULL, 20, 31, 3, 'Active', 3, NULL, '2018-06-29 07:17:51', NULL),
(54, 'Name', 'emsil', '$2y$10$TJwRrleF51hzhWMKyuioU.LJ2.skcouwC0BU8th8qoOrkUDg4E/oS', 'cGFzcw==', 22, NULL, NULL, 'Active', 2, NULL, '2018-06-29 07:43:52', NULL),
(55, 'Gggh', 'gg@gg.gg', '$2y$10$L9IcBQ5svX9WZV4NY2JkPOJaWvKX6ud6qP.Dpyde6xseKJgdyIqvu', NULL, NULL, 32, 3, 'Active', 3, NULL, '2018-06-29 09:04:48', NULL),
(56, 'Kddkkd', 'xmxj@gmail.com', '$2y$10$w2HccNuaisQM3.ABwyTD4usC97HaUaju8M.QpjEJ2KmZBP9wn9bhK', 'MTIz', 23, NULL, NULL, 'Active', 2, NULL, '2018-06-29 09:06:46', NULL),
(57, 'Djjdjd', 'ndjd@gmail.com', '$2y$10$7ep8GtdFs0n.sAkBBzDQ8OyK5GEDLVb9uIuvPZUKeMfFDBqlmFiRm', 'MTIz', 24, NULL, NULL, 'Active', 2, NULL, '2018-06-29 09:30:57', NULL),
(58, 'Abc123', 'gg@gg.com', '$2y$10$xwwg0s2ePksJ5GVwfqLo/ObdPYDJFdWlcJ4WTC8PTnqgUSmXGAj7.', 'MTIz', 25, NULL, NULL, 'Active', 2, NULL, '2018-06-29 09:32:51', NULL),
(59, 'Dydu', 'hldhf', '$2y$10$W3cinMuopSFuSlQoxJ1O4u0KX3HVbiYiOPKTzdckley/jmqii/NKa', 'dWZ1ZnVm', 26, NULL, NULL, 'Active', 2, NULL, '2018-06-29 10:20:06', NULL),
(60, 'Jdsjdjd', 'djdjdjjd@gmail.com', '$2y$10$YXxDt4UhKQGaRioXl3R9Qe.THeq05qFcwW6BwAG0bqpb9NQE.ondK', 'MTIz', 27, NULL, NULL, 'Active', 2, NULL, '2018-06-29 10:33:39', NULL),
(61, 'Jvi', 'vug', '$2y$10$Qxf0GLdXbGy21gJu0LMAvu0y.zkpFjfx0Km5j5N0EjEMXXdb/K0Ei', 'dmln', 28, NULL, NULL, 'Active', 2, NULL, '2018-07-01 23:03:10', NULL),
(62, 'Ycyf', 'ycyc', '$2y$10$ILZ52QzsID5tYA/6j9iMLOIva8CXkvpPI3VeAOX/K0CBSvnAPRe2.', NULL, 16, 32, 5, 'Active', 3, NULL, '2018-07-01 23:07:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `all_department`
--
ALTER TABLE `all_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_orgid_foreign` (`orgId`),
  ADD KEY `departments_officeid_foreign` (`officeId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`),
  ADD KEY `oauth_access_tokens_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offices_orgid_foreign` (`orgId`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191)),
  ADD KEY `password_resets_token_index` (`token`(191));

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `all_department`
--
ALTER TABLE `all_department`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_officeid_foreign` FOREIGN KEY (`officeId`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `departments_orgid_foreign` FOREIGN KEY (`orgId`) REFERENCES `organisations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
