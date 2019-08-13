-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2019 at 02:53 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ronsafett`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL,
  `contact_no` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `email`, `alt_email`, `password`, `active_status`, `contact_no`, `mobile_no`, `address`, `facebook_url`, `twitter_url`, `instagram_url`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@ronsafe.com', 'ronsafe1@gmail.com', '$2y$10$xzxr2yrzt626FCvN5TuU2.BHny/4VlEI9SuLwpdwJSRHUC.UeAZaS', 1, '1-868-658-6481 / 1-868-743-7377', '1-768-658-5481', '#2 Battoo Avenue\r\nMarabella\r\nTrinidad', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com.com', NULL, '2019-02-17 18:30:00', '2019-06-17 04:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner_photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_photo`, `cp_id`, `created_at`, `updated_at`) VALUES
(1, 'B56051.jpg', 4, '2019-02-27 03:03:07', '2019-03-01 06:05:45'),
(2, 'B18466.jpg', 2, '2019-02-27 03:03:56', '2019-05-22 00:48:23'),
(3, 'B67505.jpg', 3, '2019-05-22 00:40:12', '2019-05-22 00:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_slug`, `created_at`, `updated_at`) VALUES
(2, 'Category 4', 'category-4', '2019-02-18 04:43:24', '2019-03-14 07:43:50'),
(3, 'Category 3', 'category-3', '2019-02-18 04:54:59', '2019-03-14 07:43:37'),
(4, 'Category 2', 'category-2', '2019-02-18 05:09:48', '2019-03-14 07:43:27'),
(5, 'Category 1', 'category-1', '2019-02-21 00:01:01', '2019-03-14 07:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `cms_contents`
--

CREATE TABLE `cms_contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cms_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_contents`
--

INSERT INTO `cms_contents` (`id`, `page_title`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `cms_photo`, `created_at`, `updated_at`) VALUES
(1, 'About Us', '<p>In the years following the OSH Act 2004 / 2006 Amended, many organizations were required to make improvements in their occupational, health and safety systems and processes. With our passion for developing people and organizations, complemented by our HSE and Rescue competencies, we sought to provide the necessary services to assist these Organizations. Today, we provide a totally integrated range of HSE and Emergency Response services to the Energy, Construction, Industrial and Residential Sectors, that are tailored to meet their specific requirements.</p>', 'About Us', 'About Us', 'About Us', 'CMS99220.png', '2019-02-17 18:30:00', '2019-02-27 04:48:41'),
(2, 'Our Company', '<p>RONSAFE is a service oriented company, specializing in Safety &amp; Rescue Services, Emergency Response Training, HSE &amp; Rescue Equipment Rentals / Sales and HSE Consultancy for the Energy, Construction, Industrial and Residential sectors.</p>', 'Our Company', 'Our Company', 'Our Company', NULL, '2019-02-17 18:30:00', '2019-02-27 04:41:34'),
(3, 'Our Mission', '<p>RONSAFE will be a globally recognized provider for quality HSSE &amp; Emergency Response Services through strategic collaborations supported by a technological-driven, innovative, competent, experienced, professional workforce and management team.</p>', 'Our Mission', 'Our Mission', 'Our Mission', NULL, '2019-02-17 18:30:00', '2019-05-22 00:43:55'),
(4, 'Our Vision', '<p>To enable our Clients to effectively prevent and manage emergencies through in-depth training, competency development and provision of Emergency Response Services, utilizing innovative technologies and techniques.</p>', 'Our Vision', 'Our Vision', 'Our Vision', 'CMS51750.jpg', '2019-02-17 18:30:00', '2019-02-27 04:48:11'),
(5, 'Corporate Social Responsibility', 'Part of being a caring company is being a responsible corporate citizen. At Ronsafe, we take a long-term approach to balancing our business priorities with our social, economic and environmental responsibilities. These efforts align with the company’s higher purpose of saving and sustaining lives.', 'Corporate Social Responsibility', 'Corporate Social Responsibility', 'Corporate Social Responsibility', 'CMS30179.png', '2019-02-27 18:30:00', '2019-02-28 04:09:05'),
(6, 'Rescue Technicians', '<p>At Ronsafe Safety and Rescue Limited our bank of rescue technicians are trained for multiple rescue scenarios and have a wealth of on the job experience from years of service.</p>\r\n\r\n<p>Roles of a Safety Technician include but are not limited to:</p>\r\n\r\n<ul>\r\n	<li>Assembly of all relevant safety equipment for the job order</li>\r\n	<li>Provide technical rescue standby for the work environment inclusive and not limited to technical rope rescue and confined spaces</li>\r\n	<li>At Ronsafe all rescue technicians are trained to perform CPR and basic first aid</li>\r\n	<li>Continuously liaising with the client to report any safety developments</li>\r\n</ul>', 'Rescue Technicians', 'Rescue Technicians', 'Rescue Technicians', 'CMS70425.png', '2019-02-27 18:30:00', '2019-02-28 05:20:17'),
(7, 'Safety Officers', '<p>At Ronsafe Safety and Rescue Limited our safety officers monitor workplace activities to ensure that workers comply with company policies and government safety regulations.</p>\r\n\r\n<p>Roles of a Safety Officer include but are not limited to:</p>\r\n\r\n<ul>\r\n	<li>Assist with the preparation of programmes, projects, plans, systems and procedures in accordance with the Occupational Safety and Health Act</li>\r\n	<li>Assist in developing and implementing safety policies tailored to the specific job</li>\r\n	<li>Undertake inspections of the operating systems and procedures</li>\r\n	<li>Inspect the interior and exterior of the work area for potential hazards</li>\r\n	<li>Ensure that workers wear their required Personal Protective Equipment (PPE)</li>\r\n	<li>Conduct investigation if accident occurs on site</li>\r\n</ul>', 'Safety Officers', 'Safety Officers', 'Safety Officers', '', '2019-02-27 18:30:00', '2019-02-28 05:32:02'),
(8, 'Terms & Conditions', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '', '2019-03-27 18:30:00', '2019-03-29 03:43:36'),
(9, 'Privacy Policy', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '', '2019-03-27 18:30:00', '2019-03-29 03:54:51'),
(10, 'Training Registration instructions', '<p>When an user book a training at that time he will register if he is new user other wise registered user directly login to book the training Program. You can check the details by clicking on any one below &quot;<strong>Book Now</strong>&quot; button.There is a booking option on the right hand side.</p>', 'Training Registration instructions', 'Training Registration instructions', 'Training Registration instructions', NULL, '2019-05-21 18:30:00', '2019-05-22 01:59:31'),
(11, 'CORE VALUES', '<ul>\r\n	<li>Strategic Management &ndash; developing and implementing emergent strategies to capture opportunities for realization and refinement of the mission</li>\r\n	<li>Continuous Development &ndash; commitment to continuous personal and organizational improvement to meet the demands of the changing global environment</li>\r\n	<li>Commitment &ndash; understanding and meeting or exceeding the needs of the clients, by following approved procedures and processes to enable successful delivery of contractual agreement Integrity &ndash; honest and consistent adherence to good moral principles</li>\r\n</ul>', 'CORE VALUES', 'CORE VALUES', 'CORE VALUES', NULL, '2019-05-21 18:30:00', '2019-05-22 23:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'Red', '#fa0404', '2019-02-20 04:36:30', '2019-03-14 07:10:12'),
(2, 'Green', '#3dde23', '2019-02-20 04:36:40', '2019-03-14 07:10:27'),
(3, 'Blue', '#193fb5', '2019-03-11 07:31:24', '2019-03-13 04:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contents` text CHARACTER SET utf8 NOT NULL,
  `created_date` date NOT NULL,
  `updated_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `title`, `contents`, `created_date`, `updated_on`) VALUES
(1, 'Forgot password mail :: Admin', '<body>\r\n  <table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br/>\r\n                <strong>Your Login credential details as follows.</strong><br/><br/>\r\n                \r\n                <strong>Email :</strong> %ADMINEMAIL% <br>\r\n                <strong>Password: </strong> %ADMINPASSWORD% <br><br/>\r\n              </div>\r\n              \r\n              <strong>Thanks</strong><br/>\r\n              %ADMINNAME%<br/>\r\n              %FROMEMAIL%\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n          All rights &copy; ronsafeet.  %CURRENTYEAR%\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</body>', '2019-03-15', '2019-03-15'),
(6, 'Vender Registration Mail :: Admin', '<table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n\r\n		<tr>\r\n			<td>\r\n			<div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br />\r\n                <strong>A new vendor recently registered.Check the admin panel for more details.</strong><br /><br />\r\n                <strong>Name :</strong> %VENDORNAME%<br />\r\n                <strong>Email :</strong> %VENDOREMAIL%<br />\r\n                <strong>Contact No. :</strong> %VENDORCONTACTNO%<br /><br />\r\n              </div>\r\n              \r\n              <strong>Thanks</strong><br />\r\n              %VENDORNAME%\r\n            </div>\r\n			</td>\r\n		</tr>\r\n\r\n		<tr>\r\n          <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n              All rights &copy; ronsafett.  %CURRENTYEAR%\r\n          </td>\r\n        </tr>\r\n	</tbody>\r\n\r\n</table>', '2019-03-15', '2019-03-15'),
(2, 'Contact Us :: Email Template', '<table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n	<tbody>\r\n\r\n		<tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br />\r\n                <strong>Enquiry details as follows</strong><br /><br />\r\n                \r\n                <strong>Name :</strong> %NAME%<br />\r\n                <strong>Email :</strong> %EMAIL%<br />\r\n                <strong>Contact No. :</strong> %CONTACTNO%<br /><br />\r\n                <strong>Message :</strong><br /> %MESSAGE% <br /><br />\r\n              </div>\r\n              <strong>Thanks</strong><br />\r\n              <strong>%ADMINNAME%</strong><br />\r\n              <strong>%ADMINEMAIL%</strong>\r\n              </div>\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n          <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n              All rights &copy; ronsafett. %CURRENTYEAR%\r\n          </td>\r\n        </tr>\r\n\r\n	</tbody>\r\n\r\n</table>', '2018-08-20', '2018-08-20'),
(3, 'Training Booking Mail :: User', '<table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n	<tbody>\r\n\r\n		<tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br />\r\n                <strong>Thank you.Your Booking has been completed successfully.</strong><br />\r\n                <strong>Your Booking details as follows</strong><br /><br />\r\n                \r\n                <strong>Booking ID :</strong> %BOOKINGID%<br />\r\n                <strong>TRANSACTION ID :</strong> %TRNSID%<br /><br /><br />\r\n              </div>\r\n              <strong>Thanks</strong><br />\r\n              <strong>%ADMINNAME%</strong><br />\r\n              <strong>%ADMINEMAIL%</strong>\r\n              </div>\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n          <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n              All rights &copy; ronsafett.  %CURRENTYEAR%\r\n          </td>\r\n        </tr>\r\n\r\n	</tbody>\r\n\r\n</table>', '2019-03-15', '2019-03-15'),
(4, 'Forgot Password Mail :: User', '<body>\r\n    <table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tr>\r\n        <td style=\"background:#dbe0fd; text-align:center;\">\r\n          <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:20px;\"><br/>\r\n                    Your Login credential details as follows.\r\n                </strong><br/><br/>\r\n                \r\n                <strong>Email :</strong> %USEREMAIL% <br>\r\n                <strong>Password: </strong> %USERPASSWORD% <br>\r\n                <br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%ADMINEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n          <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n              All rights &copy; ronsafett.  %CURRENTYEAR%\r\n          </td>\r\n        </tr>\r\n  </table>\r\n</body>', '2019-03-15', '2019-03-15'),
(5, 'Order Despatched Email Template', '<body>\r\n   <table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n   <tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n           <div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br/>\r\n                <strong>\r\n                 Today we have despatched your order number %ORDERNUMBER%. Within 2-3 working days you will get your order.</strong><br/>\r\n                 <strong>For details check your Order History in your account.</strong><br/><br/>\r\n                \r\n              \r\n                \r\n              </div>\r\n              \r\n              <strong>Thanks</strong><br/>\r\n              %ADMINNAME%<br/>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n          All rights &copy; ronsafett.  %CURRENTYEAR%\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</body>', '2019-03-26', '2019-03-26'),
(8, 'User Registration Mail :: User', '<body>\r\n   <table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n   <tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n           <div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br/>\r\n                <strong>You have registered successfully.Your login credential as follows.</strong><br/><br/>\r\n                \r\n                <strong>Login ID</strong>  : %USEREMAIL% / %USERCONTACTNO%<br/>\r\n                <strong>Password</strong> : %USERPASSWORD%<br/><br/>\r\n                \r\n              </div>\r\n              \r\n              <strong>Thanks</strong><br/>\r\n              %ADMINNAME%<br/>\r\n              %ADMINEMAIL%\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n     <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n          All rights &copy; ronsafett.  %CURRENTYEAR%\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</body>', '2019-03-15', '2019-03-15'),
(7, 'Training Booking Mail :: Admin', '<table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n	<tbody>\r\n\r\n		<tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br />\r\n                <strong>A new Training Booking recently placed.Training Booking details as follows</strong><br /><br />\r\n                \r\n                <strong>Booking ID :</strong> %BOOKINGID%<br />\r\n                <strong>Transaction ID :</strong> %TRNSID%<br /><br /><br />\r\n              </div>\r\n              <strong>Thanks</strong><br />\r\n              <strong>%USERNAME%</strong><br />\r\n              <strong>%USEREMAIL%</strong>\r\n              </div>\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n          <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n              All rights &copy; ronsafett.com.  %CURRENTYEAR%\r\n          </td>\r\n        </tr>\r\n\r\n	</tbody>\r\n\r\n</table>', '2019-03-15', '2019-03-15'),
(9, 'Forgot Password mail :: User', '<body>\r\n  <table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br/>\r\n                <strong>Your Login credential details as follows.</strong><br/><br/>\r\n                \r\n                <strong>Email :</strong> %USEREMAIL% <br>\r\n                <strong>Password: </strong> %USERPASSWORD% <br><br/>\r\n              </div>\r\n              \r\n              <strong>Thanks</strong><br/>\r\n              %ADMINNAME%<br/>\r\n              %ADMINEMAIL%\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n          All rights &copy; ronsafett.  %CURRENTYEAR%\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</body>', '2019-03-15', '2019-03-15'),
(10, 'New Order :: Admin', '<table width=\"100%\" style=\"border:1px solid #EEE; background-color:#FFF; font-size:14px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n	<tbody>\r\n\r\n		<tr>\r\n        <td style=\"text-align:center; background:#dbe0fd;\">\r\n           <img src=\"https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png\" width=\"157\"/>\r\n        </td>\r\n    </tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"padding:35px; color:#555;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\"><br />\r\n                <strong>A new  Order recently placed. Order details as follows</strong><br /><br />\r\n                \r\n                <strong>ORDER ID :</strong> %ORDERID%<br />\r\n                <strong>Transaction ID :</strong> %TRNSID%<br /><br /><br />\r\n              </div>\r\n              <strong>Thanks</strong><br />\r\n              <strong>%USERNAME%</strong><br />\r\n              <strong>%USEREMAIL%</strong>\r\n              </div>\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n          <td style=\"text-align:center; color:#000; background-color:#dbe0fd;\" height=\"35\">\r\n              All rights &copy; ronsafett.com.  %CURRENTYEAR%\r\n          </td>\r\n        </tr>\r\n\r\n	</tbody>\r\n\r\n</table>', '2019-03-25', '2019-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `master_orders`
--

CREATE TABLE `master_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double(10,2) DEFAULT NULL,
  `shipping_amount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` int(11) DEFAULT '0',
  `order_notes` text COLLATE utf8mb4_unicode_ci,
  `ship_date` date DEFAULT NULL,
  `shipping_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_orders`
--

INSERT INTO `master_orders` (`id`, `user_id`, `full_name`, `email`, `contact_no`, `address1`, `address2`, `city`, `post_code`, `state`, `country`, `total_amount`, `shipping_amount`, `grand_total`, `transaction_id`, `payment_status`, `order_status`, `order_notes`, `ship_date`, `shipping_url`, `tracking_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Suresh Kumar', 'suresh@bletindia.com', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bhubaneswar', '751010', 'Odisha', 'India', 83.00, 8.30, 91.30, 'TRNS23432OK234324', NULL, 0, NULL, NULL, NULL, NULL, '2019-03-25 05:25:33', '2019-03-25 05:25:33'),
(2, 1, 'Suresh Kumar', 'suresh@bletindia.com', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bhubaneswar', '751010', 'Odisha', 'India', 65.00, 6.50, 71.50, 'TRNS23432OK234324456', NULL, 0, NULL, NULL, NULL, NULL, '2019-03-25 05:43:20', '2019-03-25 05:43:20'),
(3, 10, 'Surendra Rana', 'sr@bletindia.com', '9090905717', 'Mancheswar Industrial Estate', 'test2', 'Bhubaneswar', '751010', 'Odisha', 'India', 4.00, 0.40, 4.40, 'TRNS35345TEST234324', NULL, 1, 'Need gift package.', '2019-03-26', 'http://abc.com', NULL, '2019-03-25 06:48:26', '2019-03-26 05:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `membership_affiliations`
--

CREATE TABLE `membership_affiliations` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_affiliations`
--

INSERT INTO `membership_affiliations` (`id`, `member_photo`, `created_at`, `updated_at`) VALUES
(1, 'MA21093.png', '2019-02-27 07:00:31', '2019-02-27 07:23:25'),
(2, 'MA44917.png', '2019-02-27 07:00:41', '2019-02-27 07:23:37'),
(3, 'MA54423.png', '2019-02-27 07:00:50', '2019-02-27 07:23:50'),
(4, 'MA89550.png', '2019-02-27 07:00:58', '2019-02-27 07:24:01'),
(5, 'MA90910.png', '2019-02-27 07:01:18', '2019-02-27 07:25:48'),
(6, 'MA28012.png', '2019-02-27 07:01:28', '2019-02-27 07:25:18'),
(7, 'MA51162.png', '2019-02-27 07:01:39', '2019-02-27 07:25:04'),
(8, 'MA87154.png', '2019-02-27 07:01:49', '2019-02-27 07:24:48'),
(9, 'MA96817.png', '2019-02-27 07:01:59', '2019-02-27 07:24:35'),
(10, 'MA74261.png', '2019-02-27 07:02:06', '2019-02-27 07:24:15'),
(11, 'MA56130.png', '2019-02-27 07:02:14', '2019-02-27 07:26:15'),
(12, 'MA38185.png', '2019-02-27 07:02:21', '2019-02-27 07:27:22'),
(13, 'MA22595.png', '2019-02-27 07:02:30', '2019-02-27 07:27:45'),
(14, 'MA46573.png', '2019-02-27 07:02:39', '2019-02-27 07:27:02'),
(15, 'MA28215.png', '2019-02-27 07:02:47', '2019-02-27 07:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_24_072327_create_admins_table', 1),
(4, '2019_01_24_091857_create_user_registrations_table', 1),
(5, '2019_01_24_103122_create_seos_table', 1),
(6, '2019_01_24_104205_create_cms_contents_table', 1),
(7, '2019_01_24_110232_create_banners_table', 1),
(8, '2019_02_18_060816_create_categories_table', 2),
(9, '2019_02_18_132038_create_trainings_table', 3),
(11, '2019_02_20_093321_create_sizes_table', 4),
(12, '2019_02_20_095343_create_colors_table', 5),
(13, '2019_02_20_084232_create_products_table', 6),
(14, '2019_02_20_103612_create_product_prices_table', 7),
(15, '2019_02_20_112025_create_product_optional_images_table', 8),
(16, '2019_02_27_112845_create_membership_affiliations_table', 9),
(17, '2019_02_27_131428_create_our_services_table', 10),
(21, '2019_03_06_074746_create_payment_settings_table', 12),
(22, '2019_03_06_084721_create_training_bookings_table', 13),
(24, '2019_03_18_094226_create_temp_carts_table', 14),
(25, '2019_03_19_125048_create_master_orders_table', 15),
(27, '2019_03_19_125319_create_order_items_table', 16),
(28, '2019_03_28_083855_create_seo_page_settings_table', 17),
(29, '2019_05_22_095027_create_testimonials_table', 18),
(30, '2019_05_22_110033_create_videos_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `price_id` int(10) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `price_id`, `size`, `color`, `unit_price`, `qty`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 45, NULL, NULL, '65.00', 1, '65.00', '2019-03-25 05:25:33', '2019-03-25 05:25:33'),
(2, 1, 40, 'Large', 'Red', '5.00', 2, '10.00', '2019-03-25 05:25:33', '2019-03-25 05:25:33'),
(3, 1, 38, 'Small', 'Green', '4.00', 2, '8.00', '2019-03-25 05:25:33', '2019-03-25 05:25:33'),
(4, 2, 45, NULL, NULL, '65.00', 1, '65.00', '2019-03-25 05:43:20', '2019-03-25 05:43:20'),
(5, 3, 38, 'Small', 'Green', '4.00', 1, '4.00', '2019-03-25 06:48:26', '2019-03-25 06:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `our_services`
--

CREATE TABLE `our_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_services`
--

INSERT INTO `our_services` (`id`, `service_title`, `service_photo`, `service_details`, `created_at`, `updated_at`) VALUES
(1, 'Safety & Rescue Services', 'OS74252.png', '<ul>\r\n	<li>Rescue Technician</li>\r\n	<li>Fire watch</li>\r\n	<li>Confined Space Attendant</li>\r\n</ul>', '2019-02-28 00:55:56', '2019-02-28 01:22:02'),
(2, 'Emergency Response Training', 'OS93083.png', '<ul>\r\n	<li>First Aid</li>\r\n	<li>Rope Rescue</li>\r\n	<li>Fire Life Training</li>\r\n</ul>', '2019-02-28 00:57:39', '2019-02-28 01:26:03'),
(3, 'HSE & Rescue Equipment Rentals / Sales', 'OS42063.png', '<ul>\r\n	<li>Technical Rescue Equipment</li>\r\n	<li>Breathing Air Carts</li>\r\n	<li>Ambulance Services</li>\r\n</ul>', '2019-02-28 01:12:57', '2019-02-28 01:25:26'),
(5, 'Test', 'OS25355.jpg', '<p>fsdfdsfds</p>', '2019-02-28 01:51:52', '2019-02-28 01:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `paypal_environment` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Sandbox,2=Live',
  `paypal_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_per` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `paypal_environment`, `paypal_email`, `shipping_per`, `created_at`, `updated_at`) VALUES
(1, 1, 'sureshkumar02_biz@gmail.com', 10, '2019-03-05 18:30:00', '2019-03-25 03:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `prd_cat_id` int(10) UNSIGNED NOT NULL,
  `prd_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_details` longtext COLLATE utf8mb4_unicode_ci,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `prd_cs_opt` int(11) NOT NULL,
  `prd_meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prd_meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prd_cat_id`, `prd_name`, `prd_slug`, `prd_photo`, `prd_details`, `active_status`, `prd_cs_opt`, `prd_meta_title`, `prd_meta_keyword`, `prd_meta_description`, `created_at`, `updated_at`) VALUES
(7, 5, 'Test', 'test', 'P_28157.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 0, 1, 'werwerwe', 'werwerw', 'asdas', '2019-02-21 06:41:52', '2019-03-14 07:49:31'),
(8, 5, 'Test Product 4', 'test-product-4', 'P_19322.jpg', '<p>sdfsdfsdf</p>', 0, 1, 'adsadsa', 'sdfsd', 'sdfsdf', '2019-02-21 07:02:00', '2019-03-14 07:46:43'),
(9, 2, 'Test Product 3', 'test-product-3', 'P_30707.jpg', '<p>dsadsad</p>', 0, 1, 'asdsad', NULL, NULL, '2019-02-26 06:58:33', '2019-03-18 23:33:20'),
(10, 4, 'Test Product 2', 'test-product-2', 'P_21657.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</p>', 0, 1, 'fsdfsdfsd', NULL, NULL, '2019-02-26 07:03:10', '2019-03-14 07:48:51'),
(11, 2, 'Test Product 1', 'test-product-1', 'P_47078.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 0, 1, 'gfdgfd', NULL, NULL, '2019-02-26 08:07:14', '2019-03-20 23:57:12'),
(15, 5, 'Test Product No Option', 'test-product-no-option', 'P_51995.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 0, 0, 'rwerwe', NULL, NULL, '2019-03-14 01:10:39', '2019-03-14 07:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_optional_images`
--

CREATE TABLE `product_optional_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `prd_id` int(10) UNSIGNED NOT NULL,
  `opt_images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_optional_images`
--

INSERT INTO `product_optional_images` (`id`, `prd_id`, `opt_images`, `created_at`, `updated_at`) VALUES
(14, 15, 'OPT_290231552569252.jpg', '2019-03-14 07:44:12', '2019-03-14 07:44:12'),
(16, 15, 'OPT_566851552569287.jpg', '2019-03-14 07:44:47', '2019-03-14 07:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `prd_id` int(10) UNSIGNED DEFAULT NULL,
  `size_id` int(10) UNSIGNED DEFAULT NULL,
  `color_id` int(10) UNSIGNED DEFAULT NULL,
  `prd_price` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `prd_id`, `size_id`, `color_id`, `prd_price`, `created_at`, `updated_at`) VALUES
(6, 8, 3, 2, 6.00, '2019-02-21 07:02:00', '2019-03-14 07:46:43'),
(8, 7, 4, 2, 6.00, '2019-02-21 18:30:00', '2019-03-14 07:49:31'),
(9, 8, 2, 1, 7.00, '2019-02-26 03:09:53', '2019-03-14 07:46:43'),
(11, 8, 4, 2, 3.00, '2019-02-26 03:18:42', '2019-03-14 07:46:43'),
(12, 9, 3, 2, 6.00, '2019-02-26 06:58:33', '2019-03-18 23:33:20'),
(13, 9, 2, 2, 7.00, '2019-02-26 06:58:33', '2019-03-18 23:33:20'),
(15, 10, 2, 2, 5.00, '2019-02-26 07:03:10', '2019-03-14 07:48:51'),
(37, 10, 3, 2, 6.00, '2019-02-26 08:04:38', '2019-03-14 07:48:52'),
(38, 10, 4, 2, 4.00, '2019-02-26 08:04:38', '2019-03-14 07:48:52'),
(39, 10, 4, 1, 1.00, '2019-02-26 08:04:38', '2019-03-14 07:48:52'),
(40, 11, 3, 1, 5.00, '2019-02-26 08:07:14', '2019-03-20 23:57:12'),
(41, 11, 2, 2, 6.00, '2019-02-26 08:07:15', '2019-03-20 23:57:12'),
(43, 10, 2, 1, 2.00, '2019-02-27 00:18:46', '2019-03-14 07:48:52'),
(45, 15, NULL, NULL, 65.00, '2019-03-14 01:10:39', '2019-03-14 07:49:45'),
(46, 11, 4, 3, 7.00, '2019-03-14 03:25:00', '2019-03-20 23:57:12'),
(47, 11, 3, 3, 8.00, '2019-03-14 03:25:34', '2019-03-20 23:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` int(10) UNSIGNED NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_descr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `meta_title`, `meta_keyword`, `meta_descr`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to Ronsafett', 'Welcome to Ronsafett', 'Welcome to Ronsafett', NULL, '2019-02-26 03:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `seo_page_settings`
--

CREATE TABLE `seo_page_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_page_settings`
--

INSERT INTO `seo_page_settings` (`id`, `page_name`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'Home | Welcome to Ronsafett', 'Home', 'Home', '2019-03-27 18:30:00', '2019-03-28 07:58:12'),
(2, 'Training', 'Training', 'training', 'training', '2019-03-27 18:30:00', '2019-03-28 07:59:25'),
(3, 'Products', 'Products', 'Products', 'Products', '2019-03-27 18:30:00', '2019-03-27 18:30:00'),
(4, 'Contact Us', 'Contact Us', 'Contact Us', 'Contact Us', '2019-03-27 18:30:00', '2019-03-27 18:30:00'),
(5, 'User Registration', 'User Registration', NULL, NULL, '2019-03-27 18:30:00', '2019-03-28 07:55:03'),
(6, 'User Login', 'Login', 'User Login', 'User Login', '2019-03-27 18:30:00', '2019-03-28 07:59:17'),
(7, ' Forgot Password', ' Forgot Password', ' Forgot Password', ' Forgot Password', '2019-03-27 18:30:00', '2019-03-27 18:30:00'),
(8, 'Videos', 'Videos', 'Videos', 'Videos', '2019-05-22 18:30:00', '2019-05-22 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `created_at`, `updated_at`) VALUES
(2, 'Medium', '2019-02-20 04:13:48', '2019-02-20 04:13:48'),
(3, 'Large', '2019-02-20 04:16:15', '2019-02-20 04:16:15'),
(4, 'Small', '2019-02-20 04:16:35', '2019-02-20 04:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `temp_carts`
--

CREATE TABLE `temp_carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_id` int(10) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_carts`
--

INSERT INTO `temp_carts` (`id`, `user_id`, `session_id`, `price_id`, `size`, `color`, `unit_price`, `qty`, `total_price`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 11, 'Small', 'Green', '3.00', 3, '9.00', '2019-06-21 07:56:51', '2019-06-21 07:56:51'),
(3, NULL, 'SkBctYvCrbu2RYMjd9ofyWCkNib0epnmL4GrsCaz', 45, NULL, NULL, '65.00', 1, '65.00', '2019-06-22 01:07:58', '2019-06-22 01:07:58'),
(4, 4, NULL, 11, 'Small', 'Green', '3.00', 2, '6.00', '2019-06-22 01:12:42', '2019-06-22 01:13:23'),
(5, 44, NULL, 11, 'Small', 'Green', '3.00', 0, '0.00', '2019-06-22 01:13:42', '2019-06-24 06:04:01'),
(6, 504, NULL, 11, 'Small', 'Green', '3.00', 9, '27.00', '2019-06-22 01:17:52', '2019-06-22 01:34:29'),
(7, 504, NULL, 11, 'Small', 'Green', '3.00', 5, '15.00', '2019-06-22 01:34:49', '2019-06-22 01:37:15'),
(13, NULL, 'U2DEKO6pEVZItDTJtLNZCgO3NdD7BetK1Gdl5fQm', 45, NULL, NULL, '65.00', 2, '130.00', '2019-06-24 23:57:16', '2019-06-25 00:41:58'),
(14, NULL, 'U2DEKO6pEVZItDTJtLNZCgO3NdD7BetK1Gdl5fQm', 38, 'Small', 'Green', '4.00', 1, '4.00', '2019-06-24 23:57:25', '2019-06-24 23:57:25'),
(38, 1, NULL, 8, 'Small', 'Green', '6.00', 1, '6.00', '2019-06-26 08:14:54', '2019-06-26 08:14:54'),
(39, 1, 'J02NdRn2vPo7lYYn0voTOzleVsqwTuiYyTDKdqeB', 46, 'Small', 'Blue', '7.00', 2, '14.00', '2019-06-26 08:15:09', '2019-07-10 03:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Skumar', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '2019-05-22 04:52:40', '2019-05-23 04:02:01'),
(3, 'Trideep', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '2019-05-22 05:16:14', '2019-05-23 04:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_price` double(10,2) NOT NULL,
  `training_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `training_title`, `training_price`, `training_icon`, `training_details`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 'Technical Rescue', 25.99, '63633fe4.png', '<ul>\r\n	<li>Technical Rope Rescue &ndash; High &amp; Low Angle</li>\r\n	<li>Confined Space Rescue</li>\r\n	<li>Trench Rescue</li>\r\n	<li>Water Rescue</li>\r\n	<li>Structural Collapse Rescue</li>\r\n</ul>', 0, '2019-02-20 00:42:55', '2019-02-27 04:52:56'),
(2, 'Fire Life Safety', 25.99, '85774fe3.png', '<ul>\r\n	<li>Basic and Advanced Fire Fighting</li>\r\n	<li>Industrial Fire Fighting</li>\r\n	<li>Fire Extinguisher</li>\r\n	<li>Fire Watch / Fire Warden</li>\r\n</ul>', 0, '2019-02-27 04:53:50', '2019-02-27 04:53:50'),
(3, 'Training - Safety', 25.99, '84493fe2.png', '<ul>\r\n	<li>First Aid, CPR and AED</li>\r\n	<li>Confined Space &ndash; Awareness&nbsp;</li>\r\n	<li>Confined Space &ndash; Entrant &amp; Attendant</li>\r\n	<li>Confined Space &ndash; Supervisor</li>\r\n	<li>Authorized Gas Testing Training</li>\r\n	<li>Breathing Air Operator</li>\r\n</ul>', 0, '2019-02-27 04:55:27', '2019-02-27 04:55:27'),
(4, 'Training - Safety (Continued)', 25.99, '77378fe1.png', '<ul>\r\n	<li>OSH Requirements for Manager and Supervisor</li>\r\n	<li>Fall Protection</li>\r\n	<li>Scaffold Inspector</li>\r\n	<li>HAZMAT / HAZWOPER</li>\r\n	<li>ICS 100 / 200 / 300</li>\r\n	<li>Client Specific Training Programs</li>\r\n</ul>', 0, '2019-02-27 05:02:46', '2019-02-27 05:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `training_bookings`
--

CREATE TABLE `training_bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `training_price` double(10,2) NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_bookings`
--

INSERT INTO `training_bookings` (`id`, `training_id`, `user_id`, `training_price`, `full_name`, `contact_no`, `email`, `address1`, `address2`, `city`, `post_code`, `state`, `country`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 25.99, 'Trideep Dakua', '9338455675', 'trideep@bletindia.com', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bhubaneswar', '751010', 'Odisha', 'India', 'TRNSOK34543TST', '2019-03-07 05:01:43', '2019-03-07 05:01:43'),
(4, 2, 1, 25.99, 'Suresh Kumar Khatua', '9861245555', 'suresh@bletindia.com', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bhubaneswar', '751010', 'Odisha', 'India', 'TRNS12312OKTST234', '2019-03-07 05:18:48', '2019-03-07 05:18:48'),
(5, 1, 1, 25.00, 'suresh kumar', '9861245555', 'sureshkumar02@gmail.com', 'Test', NULL, 'BBSR', '751010', 'Odisha', 'India', NULL, '2019-06-28 05:26:11', '2019-06-28 05:26:11'),
(6, 3, 1, 25.99, 'Test', '9338455675', 'suresh@bletindia.com', 'test', NULL, 'test', '751010', 'Odisha', 'India', NULL, '2019-06-28 06:57:46', '2019-06-28 06:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_registrations`
--

CREATE TABLE `user_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_registrations`
--

INSERT INTO `user_registrations` (`id`, `full_name`, `email`, `password`, `contact_no`, `address1`, `address2`, `city`, `post_code`, `state`, `country`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'suresh@bletindia.com', '$2y$10$CRC4Kt74KS22MQ1GeE0lQ.FCYMGKmQN5Deac6Uh7N21S0j/AqDkLu', '9338455675', 'test', NULL, 'test', '751010', 'Odisha', 'India', 0, '2019-03-06 08:23:00', '2019-06-21 05:12:00'),
(6, 'Trideep Dakua', 'trideep@bletindia.com', '$2y$10$ZgRkYO5JhT2uk.yo.AJHweUN7gzcpnpcGDDfSDdyUe3JKAsLgn2s.', '9338455675', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bhubaneswar', '751010', 'Odisha', 'India', 0, '2019-03-07 05:01:43', '2019-03-08 04:06:30'),
(7, 'Trideep Dakua', 'trideep1@bletindia.com', '$2y$10$6RmEcPU5rIo.BKY4AkuEee8Hsl9PpwWlFZxXKniQw9XcTK/v0jHYi', '7205821247', 'Bhubaneswar Odisha', 'Sahidnagar', 'Bhubaneswar', '751010', 'Odisha', 'India', 0, '2019-03-20 07:43:03', '2019-03-20 07:43:03'),
(8, 'Trideep Dakua', 'trideep2@bletindia.com', '$2y$10$6xUfvzGfNz1DK2grMZj/qeu6zqMSAtlRiYgDQ9zRXMgPXXee5Btxi', '7205821247', 'Bhubaneswar Odisha', 'Sahidnagar', 'Bhubaneswar', '751010', 'Odisha', 'India', 0, '2019-03-20 07:47:18', '2019-03-20 07:47:18'),
(10, 'Surendra Rana', 'sr@bletindia.com', '$2y$10$TB3S0QoOpFCRfnFt/BWPM.f6OqzXtLYR6UhB4hN2tp1mewBJk9.Ni', '9090905717', 'Mancheswar Industrial Estate', 'test2', 'Bhubaneswar', '751010', 'Odisha', 'India', 0, '2019-03-25 05:19:34', '2019-03-25 05:19:34'),
(15, 'McKenzie Ramirez', 'setaqag@mailinator.com', '$2y$10$dD7bAKpjKYT0st0DozHZjulGvhiFiliGqFZstRhiz7jzOOrU.nNxa', 'Elit aspernatur', '992 Old Freeway', 'Est mollit tempora i', 'Incidunt fugiat qua', 'Sit qui ni', 'Id fugiat amet ad r', 'Illo rem aspernatur', 0, '2019-03-27 05:28:19', '2019-03-27 05:28:19'),
(16, 'Colt Cochran', 'musosuva@mailinator.net', '$2y$10$bORTY5.TQbQ/MrVEAD/L3OjrE3GHwVwDhMeoJNQsdtj12w0qZAPIS', 'Laborum incidid', '10 South Second Parkway', 'Natus id molestiae', 'Unde mollit tempor m', 'Aut totam ', 'Delectus ut ea tota', 'Exercitationem in pa', 0, '2019-03-27 05:35:39', '2019-03-27 05:35:39'),
(17, 'Ginger Frye', 'dexodejypy@mailinator.net', '$2y$10$EWRxGLkKQedlht0ZcqBLxOvM217XLP0J2dnHmc0PvOhIk6mEjUPHW', 'Pariatur Volupt', '200 West First Boulevard', 'Nostrum consequatur', 'Officia autem ipsum', 'Et fugit v', 'Eu autem repudiandae', 'Esse quaerat volupta', 0, '2019-03-27 06:01:46', '2019-03-27 06:01:46'),
(18, 'sfd', 'dffggf@gmail.com', '$2y$10$GBLggUpZcGQMLA/hFcAkReqFbyBxMlGqxCtjgwA3366VzyS95PTWC', '3454657578', 'thytu', 'yuiyiuo', 'uloi', 'uoi', 'lil;i', 'kuokui', 0, '2019-03-31 23:29:10', '2019-03-31 23:29:10'),
(20, 'Test', 'Test', '$2y$10$kLdk771QtV7n1mm6h04SeeCZUbYVLBK.njlPBNADS9rdcJQ9Kqnxm', '9338455675', 'test', NULL, 'test', '751010', 'Odisha', 'India', 0, '2019-06-11 03:39:58', '2019-06-11 05:29:49'),
(21, 'Mano R', 'ms@abc.com', '$2y$10$tvneSQZ4N8qj/lvmSL11rug0.FHLRrCoNGn0eZtBFMA9IiI8GM4iW', '2133242490', 'Ch Colony', 'Canal Road', 'Bhubaneswar', '123123', 'Odisha', 'India', 0, '2019-06-12 00:19:23', '2019-06-12 05:29:47'),
(22, 'manoranjan', 'ma@bletindia.com', '$2y$10$/GU0ReJnRohYFdtlXMAj.OxGQ.GEHkW.Ke.aELpAjFtH7sPd5Pc3u', '9874125360', 'rasulgarh', 'canal road', 'bar', '147852', 'Orissa', 'India', 0, '2019-06-12 00:25:55', '2019-06-12 00:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `video`, `created_at`, `updated_at`) VALUES
(1, 'Test123', 'V73090.mov', '2019-05-22 06:12:43', '2019-05-22 06:29:47'),
(3, 'One More Test', 'V71861.mp4', '2019-05-22 06:15:05', '2019-05-22 06:15:05'),
(5, 'mov test', 'V33023.mov', '2019-05-22 06:17:53', '2019-05-22 06:17:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_cat_name_unique` (`cat_name`),
  ADD UNIQUE KEY `categories_cat_slug_unique` (`cat_slug`);

--
-- Indexes for table `cms_contents`
--
ALTER TABLE `cms_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_orders`
--
ALTER TABLE `master_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `membership_affiliations`
--
ALTER TABLE `membership_affiliations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_price_id_foreign` (`price_id`);

--
-- Indexes for table `our_services`
--
ALTER TABLE `our_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_prd_cat_id_foreign` (`prd_cat_id`);

--
-- Indexes for table `product_optional_images`
--
ALTER TABLE `product_optional_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_prices_prd_id_foreign` (`prd_id`),
  ADD KEY `product_prices_size_id_foreign` (`size_id`),
  ADD KEY `product_prices_color_id_foreign` (`color_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_page_settings`
--
ALTER TABLE `seo_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_carts`
--
ALTER TABLE `temp_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_carts_price_id_foreign` (`price_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_bookings`
--
ALTER TABLE `training_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_bookings_training_id_foreign` (`training_id`),
  ADD KEY `training_bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_registrations`
--
ALTER TABLE `user_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_registrations_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_contents`
--
ALTER TABLE `cms_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_orders`
--
ALTER TABLE `master_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `membership_affiliations`
--
ALTER TABLE `membership_affiliations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `our_services`
--
ALTER TABLE `our_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_optional_images`
--
ALTER TABLE `product_optional_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seo_page_settings`
--
ALTER TABLE `seo_page_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temp_carts`
--
ALTER TABLE `temp_carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `training_bookings`
--
ALTER TABLE `training_bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_registrations`
--
ALTER TABLE `user_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_orders`
--
ALTER TABLE `master_orders`
  ADD CONSTRAINT `master_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user_registrations` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `master_orders` (`id`),
  ADD CONSTRAINT `order_items_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `product_prices` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_prd_cat_id_foreign` FOREIGN KEY (`prd_cat_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `product_prices_prd_id_foreign` FOREIGN KEY (`prd_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_prices_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `temp_carts`
--
ALTER TABLE `temp_carts`
  ADD CONSTRAINT `temp_carts_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `product_prices` (`id`);

--
-- Constraints for table `training_bookings`
--
ALTER TABLE `training_bookings`
  ADD CONSTRAINT `training_bookings_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`),
  ADD CONSTRAINT `training_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user_registrations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
