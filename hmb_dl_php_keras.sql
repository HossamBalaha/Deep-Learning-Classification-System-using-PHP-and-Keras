-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 08:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmb_dl_php_keras`
--

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`) VALUES
(2, 'Female'),
(1, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `allowed_extensions` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `allowed_extensions`) VALUES
(1, 'Image', 'jpg,jpeg,png'),
(2, 'Text', ''),
(3, 'Audio', ''),
(4, 'Video', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `gender_id` int(10) UNSIGNED DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_classifiers`
--

CREATE TABLE `user_classifiers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `type_id` int(11) UNSIGNED DEFAULT NULL,
  `model` varchar(150) NOT NULL,
  `labels` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

CREATE TABLE `user_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_classifier_id` int(10) UNSIGNED DEFAULT NULL,
  `file` varchar(150) NOT NULL,
  `original_name` text NOT NULL,
  `output` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `website_cards`
--

CREATE TABLE `website_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_cards`
--

INSERT INTO `website_cards` (`id`, `image`, `title`, `description`) VALUES
(1, '/uploads/cards/card-1.jpg', 'Title 1', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod risus eget neque condimentum elementum. Sed orci sapien, consectetur vel nibh a, ultrices molestie nunc. Duis interdum nisl non risus accumsan, molestie porta neque consectetur. Pellentesque pulvinar tempus justo eu viverra. Donec a felis felis. In eu convallis enim. Nunc non mattis neque, nec cursus ipsum. Praesent euismod molestie ante et molestie. Sed mattis tincidunt viverra. Curabitur lacinia est est, eu placerat neque dictum sed.\r\n\r\nEtiam enim ligula, semper eget pretium vitae, dignissim eget libero. Aliquam ultrices mauris odio, a ultricies massa vulputate at. Donec tempor magna odio, porttitor tristique est auctor non. Fusce mollis purus sed consectetur tempus. Nunc consectetur in neque a dignissim. Sed in varius risus. Praesent sollicitudin diam eu tellus eleifend lobortis. Morbi facilisis pretium diam, id mollis purus tempus eu. Aenean pharetra, enim eu pulvinar convallis, metus massa condimentum nunc, at efficitur augue arcu in leo. Duis sed tempus est, sed consequat felis. Aliquam at scelerisque diam. Aenean vel odio tristique, pellentesque sapien a, vulputate velit. Curabitur efficitur id velit sit amet malesuada. Aliquam pulvinar elit non urna iaculis, nec feugiat mi ornare.\r\n\r\nDonec nec justo vitae leo mollis ullamcorper quis non dui. Nulla condimentum semper suscipit. Donec egestas dolor quis elementum sollicitudin. Sed auctor, erat quis venenatis rhoncus, nulla ex molestie elit, dictum posuere erat diam vel neque. Vivamus nulla tellus, dignissim sit amet sapien id, eleifend semper massa. Sed commodo turpis sed eros fermentum, eu rhoncus felis semper. Maecenas et magna eros. Nunc lobortis vel diam eu accumsan. Mauris pretium accumsan nibh, eu euismod purus accumsan bibendum. Quisque non orci et arcu condimentum lobortis ac sit amet neque. Aliquam nisi odio, eleifend mattis commodo id, pellentesque id est. Mauris a mattis turpis.\r\n\r\nQuisque mollis iaculis nibh sed iaculis. Sed cursus, odio vel hendrerit porttitor, dolor risus auctor leo, eu interdum eros sem at ex. In fermentum rutrum tristique. Aliquam rhoncus rhoncus tristique. Proin ac neque blandit, facilisis risus ultrices, efficitur felis. Duis vitae porttitor mi, in aliquam justo. Maecenas interdum pretium lorem vel dignissim. Fusce turpis nibh, rhoncus id nunc sit amet, malesuada rhoncus magna. Quisque quis iaculis mauris.\r\n\r\nSuspendisse malesuada id nisl eu gravida. Mauris tempus lectus at neque fermentum hendrerit. Phasellus malesuada risus vel porttitor condimentum. Sed condimentum vehicula laoreet. Phasellus ante tortor, finibus et arcu ac, viverra lacinia orci. Quisque bibendum, lectus eu feugiat commodo, eros massa tempor lectus, vel fermentum quam purus faucibus diam. Ut in lectus in leo bibendum accumsan. Cras quis ultrices dui. Proin in aliquam turpis. Cras vitae dolor aliquam, tincidunt tellus sit amet, efficitur lacus. Praesent imperdiet imperdiet odio in lacinia. Cras nisi lorem, dictum in est eu, pulvinar euismod dolor. Phasellus id porttitor elit, et volutpat nunc. '),
(2, '/uploads/cards/card-2.jpg', 'Title 2', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod risus eget neque condimentum elementum. Sed orci sapien, consectetur vel nibh a, ultrices molestie nunc. Duis interdum nisl non risus accumsan, molestie porta neque consectetur. Pellentesque pulvinar tempus justo eu viverra. Donec a felis felis. In eu convallis enim. Nunc non mattis neque, nec cursus ipsum. Praesent euismod molestie ante et molestie. Sed mattis tincidunt viverra. Curabitur lacinia est est, eu placerat neque dictum sed.\r\n\r\nEtiam enim ligula, semper eget pretium vitae, dignissim eget libero. Aliquam ultrices mauris odio, a ultricies massa vulputate at. Donec tempor magna odio, porttitor tristique est auctor non. Fusce mollis purus sed consectetur tempus. Nunc consectetur in neque a dignissim. Sed in varius risus. Praesent sollicitudin diam eu tellus eleifend lobortis. Morbi facilisis pretium diam, id mollis purus tempus eu. Aenean pharetra, enim eu pulvinar convallis, metus massa condimentum nunc, at efficitur augue arcu in leo. Duis sed tempus est, sed consequat felis. Aliquam at scelerisque diam. Aenean vel odio tristique, pellentesque sapien a, vulputate velit. Curabitur efficitur id velit sit amet malesuada. Aliquam pulvinar elit non urna iaculis, nec feugiat mi ornare.\r\n\r\nDonec nec justo vitae leo mollis ullamcorper quis non dui. Nulla condimentum semper suscipit. Donec egestas dolor quis elementum sollicitudin. Sed auctor, erat quis venenatis rhoncus, nulla ex molestie elit, dictum posuere erat diam vel neque. Vivamus nulla tellus, dignissim sit amet sapien id, eleifend semper massa. Sed commodo turpis sed eros fermentum, eu rhoncus felis semper. Maecenas et magna eros. Nunc lobortis vel diam eu accumsan. Mauris pretium accumsan nibh, eu euismod purus accumsan bibendum. Quisque non orci et arcu condimentum lobortis ac sit amet neque. Aliquam nisi odio, eleifend mattis commodo id, pellentesque id est. Mauris a mattis turpis.\r\n\r\nQuisque mollis iaculis nibh sed iaculis. Sed cursus, odio vel hendrerit porttitor, dolor risus auctor leo, eu interdum eros sem at ex. In fermentum rutrum tristique. Aliquam rhoncus rhoncus tristique. Proin ac neque blandit, facilisis risus ultrices, efficitur felis. Duis vitae porttitor mi, in aliquam justo. Maecenas interdum pretium lorem vel dignissim. Fusce turpis nibh, rhoncus id nunc sit amet, malesuada rhoncus magna. Quisque quis iaculis mauris.\r\n\r\nSuspendisse malesuada id nisl eu gravida. Mauris tempus lectus at neque fermentum hendrerit. Phasellus malesuada risus vel porttitor condimentum. Sed condimentum vehicula laoreet. Phasellus ante tortor, finibus et arcu ac, viverra lacinia orci. Quisque bibendum, lectus eu feugiat commodo, eros massa tempor lectus, vel fermentum quam purus faucibus diam. Ut in lectus in leo bibendum accumsan. Cras quis ultrices dui. Proin in aliquam turpis. Cras vitae dolor aliquam, tincidunt tellus sit amet, efficitur lacus. Praesent imperdiet imperdiet odio in lacinia. Cras nisi lorem, dictum in est eu, pulvinar euismod dolor. Phasellus id porttitor elit, et volutpat nunc. '),
(3, '/uploads/cards/card-3.jpg', 'Title 3', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod risus eget neque condimentum elementum. Sed orci sapien, consectetur vel nibh a, ultrices molestie nunc. Duis interdum nisl non risus accumsan, molestie porta neque consectetur. Pellentesque pulvinar tempus justo eu viverra. Donec a felis felis. In eu convallis enim. Nunc non mattis neque, nec cursus ipsum. Praesent euismod molestie ante et molestie. Sed mattis tincidunt viverra. Curabitur lacinia est est, eu placerat neque dictum sed.\r\n\r\nEtiam enim ligula, semper eget pretium vitae, dignissim eget libero. Aliquam ultrices mauris odio, a ultricies massa vulputate at. Donec tempor magna odio, porttitor tristique est auctor non. Fusce mollis purus sed consectetur tempus. Nunc consectetur in neque a dignissim. Sed in varius risus. Praesent sollicitudin diam eu tellus eleifend lobortis. Morbi facilisis pretium diam, id mollis purus tempus eu. Aenean pharetra, enim eu pulvinar convallis, metus massa condimentum nunc, at efficitur augue arcu in leo. Duis sed tempus est, sed consequat felis. Aliquam at scelerisque diam. Aenean vel odio tristique, pellentesque sapien a, vulputate velit. Curabitur efficitur id velit sit amet malesuada. Aliquam pulvinar elit non urna iaculis, nec feugiat mi ornare.\r\n\r\nDonec nec justo vitae leo mollis ullamcorper quis non dui. Nulla condimentum semper suscipit. Donec egestas dolor quis elementum sollicitudin. Sed auctor, erat quis venenatis rhoncus, nulla ex molestie elit, dictum posuere erat diam vel neque. Vivamus nulla tellus, dignissim sit amet sapien id, eleifend semper massa. Sed commodo turpis sed eros fermentum, eu rhoncus felis semper. Maecenas et magna eros. Nunc lobortis vel diam eu accumsan. Mauris pretium accumsan nibh, eu euismod purus accumsan bibendum. Quisque non orci et arcu condimentum lobortis ac sit amet neque. Aliquam nisi odio, eleifend mattis commodo id, pellentesque id est. Mauris a mattis turpis.\r\n\r\nQuisque mollis iaculis nibh sed iaculis. Sed cursus, odio vel hendrerit porttitor, dolor risus auctor leo, eu interdum eros sem at ex. In fermentum rutrum tristique. Aliquam rhoncus rhoncus tristique. Proin ac neque blandit, facilisis risus ultrices, efficitur felis. Duis vitae porttitor mi, in aliquam justo. Maecenas interdum pretium lorem vel dignissim. Fusce turpis nibh, rhoncus id nunc sit amet, malesuada rhoncus magna. Quisque quis iaculis mauris.\r\n\r\nSuspendisse malesuada id nisl eu gravida. Mauris tempus lectus at neque fermentum hendrerit. Phasellus malesuada risus vel porttitor condimentum. Sed condimentum vehicula laoreet. Phasellus ante tortor, finibus et arcu ac, viverra lacinia orci. Quisque bibendum, lectus eu feugiat commodo, eros massa tempor lectus, vel fermentum quam purus faucibus diam. Ut in lectus in leo bibendum accumsan. Cras quis ultrices dui. Proin in aliquam turpis. Cras vitae dolor aliquam, tincidunt tellus sit amet, efficitur lacus. Praesent imperdiet imperdiet odio in lacinia. Cras nisi lorem, dictum in est eu, pulvinar euismod dolor. Phasellus id porttitor elit, et volutpat nunc. '),
(4, '/uploads/cards/card-4.jpg', 'Title 4', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod risus eget neque condimentum elementum. Sed orci sapien, consectetur vel nibh a, ultrices molestie nunc. Duis interdum nisl non risus accumsan, molestie porta neque consectetur. Pellentesque pulvinar tempus justo eu viverra. Donec a felis felis. In eu convallis enim. Nunc non mattis neque, nec cursus ipsum. Praesent euismod molestie ante et molestie. Sed mattis tincidunt viverra. Curabitur lacinia est est, eu placerat neque dictum sed.\r\n\r\nEtiam enim ligula, semper eget pretium vitae, dignissim eget libero. Aliquam ultrices mauris odio, a ultricies massa vulputate at. Donec tempor magna odio, porttitor tristique est auctor non. Fusce mollis purus sed consectetur tempus. Nunc consectetur in neque a dignissim. Sed in varius risus. Praesent sollicitudin diam eu tellus eleifend lobortis. Morbi facilisis pretium diam, id mollis purus tempus eu. Aenean pharetra, enim eu pulvinar convallis, metus massa condimentum nunc, at efficitur augue arcu in leo. Duis sed tempus est, sed consequat felis. Aliquam at scelerisque diam. Aenean vel odio tristique, pellentesque sapien a, vulputate velit. Curabitur efficitur id velit sit amet malesuada. Aliquam pulvinar elit non urna iaculis, nec feugiat mi ornare.\r\n\r\nDonec nec justo vitae leo mollis ullamcorper quis non dui. Nulla condimentum semper suscipit. Donec egestas dolor quis elementum sollicitudin. Sed auctor, erat quis venenatis rhoncus, nulla ex molestie elit, dictum posuere erat diam vel neque. Vivamus nulla tellus, dignissim sit amet sapien id, eleifend semper massa. Sed commodo turpis sed eros fermentum, eu rhoncus felis semper. Maecenas et magna eros. Nunc lobortis vel diam eu accumsan. Mauris pretium accumsan nibh, eu euismod purus accumsan bibendum. Quisque non orci et arcu condimentum lobortis ac sit amet neque. Aliquam nisi odio, eleifend mattis commodo id, pellentesque id est. Mauris a mattis turpis.\r\n\r\nQuisque mollis iaculis nibh sed iaculis. Sed cursus, odio vel hendrerit porttitor, dolor risus auctor leo, eu interdum eros sem at ex. In fermentum rutrum tristique. Aliquam rhoncus rhoncus tristique. Proin ac neque blandit, facilisis risus ultrices, efficitur felis. Duis vitae porttitor mi, in aliquam justo. Maecenas interdum pretium lorem vel dignissim. Fusce turpis nibh, rhoncus id nunc sit amet, malesuada rhoncus magna. Quisque quis iaculis mauris.\r\n\r\nSuspendisse malesuada id nisl eu gravida. Mauris tempus lectus at neque fermentum hendrerit. Phasellus malesuada risus vel porttitor condimentum. Sed condimentum vehicula laoreet. Phasellus ante tortor, finibus et arcu ac, viverra lacinia orci. Quisque bibendum, lectus eu feugiat commodo, eros massa tempor lectus, vel fermentum quam purus faucibus diam. Ut in lectus in leo bibendum accumsan. Cras quis ultrices dui. Proin in aliquam turpis. Cras vitae dolor aliquam, tincidunt tellus sit amet, efficitur lacus. Praesent imperdiet imperdiet odio in lacinia. Cras nisi lorem, dictum in est eu, pulvinar euismod dolor. Phasellus id porttitor elit, et volutpat nunc. ');

-- --------------------------------------------------------

--
-- Table structure for table `website_configurations`
--

CREATE TABLE `website_configurations` (
  `id` int(10) UNSIGNED NOT NULL,
  `config_key` varchar(100) NOT NULL,
  `config_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_configurations`
--

INSERT INTO `website_configurations` (`id`, `config_key`, `config_value`) VALUES
(1, 'name', 'Website Name'),
(2, 'logo', '/uploads/logos/logo.jpg'),
(3, 'phone', '(000) 000-000-0000'),
(4, 'email', 'company@company.com');

-- --------------------------------------------------------

--
-- Table structure for table `website_slider`
--

CREATE TABLE `website_slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_slider`
--

INSERT INTO `website_slider` (`id`, `image`, `title`, `description`) VALUES
(1, '/uploads/sliders/slider-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod risus eget neque condimentum elementum. Sed orci sapien, consectetur vel nibh a, ultrices molestie nunc. Duis interdum nisl non risus accumsan, molestie porta neque consectetur. Pellentesque pulvinar tempus justo eu viverra. Donec a felis felis. In eu convallis enim. Nunc non mattis neque, nec cursus ipsum. Praesent euismod molestie ante et molestie. Sed mattis tincidunt viverra. Curabitur lacinia est est, eu placerat neque dictum sed. '),
(2, '/uploads/sliders/slider-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod risus eget neque condimentum elementum. Sed orci sapien, consectetur vel nibh a, ultrices molestie nunc. Duis interdum nisl non risus accumsan, molestie porta neque consectetur. Pellentesque pulvinar tempus justo eu viverra. Donec a felis felis. In eu convallis enim. Nunc non mattis neque, nec cursus ipsum. Praesent euismod molestie ante et molestie. Sed mattis tincidunt viverra. Curabitur lacinia est est, eu placerat neque dictum sed. '),
(3, '/uploads/sliders/slider-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod risus eget neque condimentum elementum. Sed orci sapien, consectetur vel nibh a, ultrices molestie nunc. Duis interdum nisl non risus accumsan, molestie porta neque consectetur. Pellentesque pulvinar tempus justo eu viverra. Donec a felis felis. In eu convallis enim. Nunc non mattis neque, nec cursus ipsum. Praesent euismod molestie ante et molestie. Sed mattis tincidunt viverra. Curabitur lacinia est est, eu placerat neque dictum sed. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indexes for table `user_classifiers`
--
ALTER TABLE `user_classifiers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_classifier_id` (`user_classifier_id`);

--
-- Indexes for table `website_cards`
--
ALTER TABLE `website_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_configurations`
--
ALTER TABLE `website_configurations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `config_key` (`config_key`);

--
-- Indexes for table `website_slider`
--
ALTER TABLE `website_slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_classifiers`
--
ALTER TABLE `user_classifiers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_cards`
--
ALTER TABLE `website_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `website_configurations`
--
ALTER TABLE `website_configurations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `website_slider`
--
ALTER TABLE `website_slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_classifiers`
--
ALTER TABLE `user_classifiers`
  ADD CONSTRAINT `user_classifiers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_classifiers_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_history`
--
ALTER TABLE `user_history`
  ADD CONSTRAINT `user_history_ibfk_1` FOREIGN KEY (`user_classifier_id`) REFERENCES `user_classifiers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
