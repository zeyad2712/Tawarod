-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 04:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `case02`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(4, 'Developer'),
(5, 'Data analyst\r\n'),
(6, 'Voice over'),
(7, 'Marketing analyst '),
(8, 'Designer'),
(9, 'Content creator ');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_password` varchar(255) NOT NULL,
  `client_country` varchar(255) NOT NULL,
  `client_image` longtext NOT NULL,
  `promocode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_email`, `client_password`, `client_country`, `client_image`, `promocode`) VALUES
(4, 'radwan', '01123040511n@gmail.com', '$2y$10$hFd./3zNQGrfWipjgZ67qOE9lbcKxwzpnJaXCTSXPJ4D7YVWMRJP.', 'radwan', 'default.jpg', '0'),
(5, 'allam', '01123040511p@gmail.com', '$2y$10$BFBsWF8zlyFQrbobapm/sOHg8St6sOJt09zOpQ2sj88PuDo7LajPO', 'erd', 'default.jpg', '0'),
(6, '01123040511ksjnn@gmail.com', '01123040511@gmail.com', '$2y$10$5zCGydsb1gUtxOhstUCAr.QosZc/l0.TCPOozVPZeNZ3sdZUPBJ0y', 'radwan', 'default.jpg', '0'),
(7, 'mariz', 'nohanabil146@gmail.com', '123', 'egypt', 'default.jpg', '0'),
(16, 'thabet fouad', 'mariz.thabet33@gmail.com', '$2y$10$VblkTNDcps0K2WfzacvkBuw4A8QUFLbnh3yx.6EEtpAmzIZyiozhG', 'Egypt', 'default.jpg', '0'),
(18, 'mariz thabet', 'mariz.thabeet@gmail.com', '$2y$10$aH4OLT.lj5nwFVpmpIGIMejyMSMdt36zcdQNszBhoBeHJjdz3AL3m', 'Egypt', 'default.jpg', '0'),
(19, 'noha nabil', 'mariz.thabeet@gmail.com', '$2y$10$aH4OLT.lj5nwFVpmpIGIMejyMSMdt36zcdQNszBhoBeHJjdz3AL3m', 'Egypt', 'default.jpg', '0'),
(24, 'pinar', 'mariz.thabet33@gmail.com', '$2y$10$kvsuJm3U0Ht5jdB0jRe3/.lhyE8F/lAcvhab/HhnFyOcGipDiOwGe', 'Bahrain', 'default.jpg', '0'),
(28, 'allam', 'malllam146@gmail.com', '$2y$10$5rbIEqAeiqP9dbxjx08sa.VOOsIkQ9F8V.1mDl0yEdED2U1b0ipYu', 'Egypt', 'default.jpg', '0'),
(29, 'rawda', 'rawdamagdy12@gmail.com', '$2y$10$Vf0Vtt23geb6KACJVt6lG.67b9ufy9LrUuxFCBvetiR.9zzu2BeHG', 'Lebanon', 'default', '0'),
(30, 'mina magdy', 'mn.magdy455@gmail.com', '$2y$10$.G4IXIFWbQfmnAKnSoHkGe9RK0/Ry7893/.nRPcwbZpOar3GoAjfC', 'Qatar', 'art2.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

CREATE TABLE `freelancer` (
  `freelancer_id` int(11) NOT NULL,
  `freelancer_name` varchar(255) NOT NULL,
  `freelancer_email` varchar(255) NOT NULL,
  `freelancer_password` varchar(255) NOT NULL,
  `available_hours` int(11) NOT NULL,
  `price/hour` int(11) NOT NULL,
  `N_id` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `subcat_id` int(11) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `average_rate` float DEFAULT NULL,
  `rank_id` int(11) DEFAULT NULL,
  `freelancer_image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`freelancer_id`, `freelancer_name`, `freelancer_email`, `freelancer_password`, `available_hours`, `price/hour`, `N_id`, `birthdate`, `cat_id`, `subcat_id`, `about`, `job_title`, `views`, `average_rate`, `rank_id`, `freelancer_image`) VALUES
(35, 'mahmoud', 'malllam146@gmail.com', '$2y$10$tY6mrOkyx7vVFV3QCQ2.9O8TQdylpfw4gboBH2ofl4mGYLLRa12vC', 77, 74, '30402050101156', '2004-02-05', 5, 17, 'yghyjn', 'allala', 47, 0, 2, '269151161_1615625995463467_4060409518665337994_n.jpg'),
(36, 'ytyugui', 'guiguikb', 'hjkgujb', 0, 50, '884', '2024-08-06', 9, 13, 'hiohi', NULL, 48, 0, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `link_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`link_id`, `freelancer_id`, `link`) VALUES
(1, 35, 'http://localhost/day10_c');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `request_id`, `client_id`, `freelancer_id`, `total_price`) VALUES
(13, 50, 30, 36, 27750);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `post_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `cat_id`, `project_id`, `post_desc`) VALUES
(2, 6, 4, 'test to know if it works or no'),
(9, 5, 20, 'ay ay ay hagaaaa'),
(10, 5, 17, 'allamaaa');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_desc` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_desc`, `type_id`, `client_id`) VALUES
(4, 'case03', 'fsafasd', 1, 7),
(9, 'scout3', 'sdfvszdfvs', 1, 16),
(17, 'cairo website', 'nnnnn', 2, 30),
(20, 'Innovate', 'I want a website about innovation', 2, 30),
(21, 'cairo website', 'mmmmm', 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `project_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`project_id`, `freelancer_id`) VALUES
(17, 35),
(17, 36);

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rank_id`, `rank_name`) VALUES
(1, 'senior'),
(2, 'junior'),
(3, 'mineor');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `request_status` varchar(255) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `hours_requested` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `request_status`, `freelancer_id`, `project_id`, `hours_requested`) VALUES
(50, 'approval', 36, 17, 555),
(51, 'approval\r\n', 35, 17, 555),
(52, 'approval', 35, 17, 888),
(53, 'approval', 35, 20, 888);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `freelancer_id`, `client_id`, `text`) VALUES
(20, 35, 28, 'takhbom'),
(21, 36, 30, 'bbbb');

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `sample_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `sample_file` longtext NOT NULL,
  `sample_desc` varchar(255) NOT NULL,
  `sample_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_cat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_cat_id`, `cat_id`, `sub_cat`) VALUES
(11, 4, 'Front-End'),
(12, 4, 'Back-End'),
(13, 4, 'Full-Stack'),
(14, 4, 'App Developer'),
(15, 4, 'UI/UX'),
(16, 5, 'Data Analyst'),
(17, 5, 'Data Scientist'),
(18, 8, '2D Animation'),
(19, 8, '3D Animation');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(1, 'team'),
(2, 'individual');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`freelancer_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `rank_id_2` (`rank_id`),
  ADD KEY `sub_cat_id` (`subcat_id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`project_id`,`freelancer_id`),
  ADD KEY `project_id` (`project_id`,`freelancer_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `freelancer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelancer`
--
ALTER TABLE `freelancer`
  ADD CONSTRAINT `freelancer_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freelancer_ibfk_2` FOREIGN KEY (`rank_id`) REFERENCES `rank` (`rank_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freelancer_ibfk_3` FOREIGN KEY (`subcat_id`) REFERENCES `sub_category` (`sub_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`request_id`) REFERENCES `request` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_members_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sample`
--
ALTER TABLE `sample`
  ADD CONSTRAINT `sample_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
