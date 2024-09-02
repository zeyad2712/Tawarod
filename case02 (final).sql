-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 11:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(2, 'Allam', 'malllam146@gmail.com', '$2y$10$PiYonq2IHFT96rsO4qAm.eLiJ78LEIXGBiB2lyAKfgTvgx3R8HX2S'),
(3, 'adam', 'mina@gmail.com', '$2y$10$6M/SHJjg8ldYFY5m4u72le.UJg9dxQGjeZue/K9kFFaE0JM.85kFS'),
(4, 'aaaa', 'yassindiaakarim@gmail.com', '$2y$10$WSGOv6wB6BM8lDtzo59xOOOAenmEO3bsaP/06bi9PjLB6JCPysNXm'),
(5, 'aaaa', 'marizthabet05@gmail.com', '$2y$10$mEaf4ZIQpzXGSuKyh9qcmOUTbBuUv7goIay9wdgSJbuc5/.9pgsam');

-- --------------------------------------------------------

--
-- Table structure for table `c.posts`
--

CREATE TABLE `c.posts` (
  `c.post_id` int(11) NOT NULL,
  `c.post_desc` longtext NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `p.image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c.posts`
--

INSERT INTO `c.posts` (`c.post_id`, `c.post_desc`, `client_id`, `freelancer_id`, `p.image`) VALUES
(43, 'how can you be a freelancer?', 41, NULL, 'download (4).jpeg'),
(44, 'to be a freelancer', NULL, 43, 'download (5).jpeg'),
(45, 'fresh taste!', 44, NULL, 'food-writer.jpg'),
(46, 'New Here!!', 48, NULL, 'download (6).jpeg');

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
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` int(11) NOT NULL DEFAULT 0,
  `from_to` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `freelancer_id`, `client_id`, `text`, `date`, `seen`, `from_to`) VALUES
(16, 40, 41, 'hello', '2002-09-24 09:57:38', 0, 'cf'),
(17, 43, 41, 'hello', '2002-09-24 01:24:47', 1, 'cf'),
(18, 43, 41, 'hello', '2002-09-24 01:25:21', 1, 'fc'),
(19, 43, 47, 'ta5bom', '2002-09-24 01:32:44', 1, 'cf'),
(20, 43, 41, 'hello', '2002-09-24 02:26:37', 1, 'cf'),
(21, 43, 41, 'hi', '2002-09-24 02:27:04', 1, 'fc'),
(22, 43, 41, 'call me if needed', '2002-09-24 10:58:18', 0, 'fc'),
(23, 43, 44, 'conntact me', '2002-09-24 11:07:01', 1, 'cf'),
(24, 43, 48, 'join me as developer', '2002-09-24 11:10:33', 0, 'cf'),
(25, 43, 44, 'call', '2002-09-24 11:25:56', 0, 'fc');

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
(39, 'Apex Digital Solutions', 'gannahalaa.presentaion@gmail.com', '$2y$10$jzc5DVUCRyEwBfTylZ0bceUvJKzv3/KwpT9di7bgZ1UC2MFsl7Q7S', 'Bahrain', 'Screenshot (360).png', NULL),
(40, ' CityScope Analytics', 'gannahalaa.presentation@gmail.com', '$2y$10$u9WHhvx6pjwCVi0ojgE.a..37BG45wRuBCoeQuQ2CoXScTRjCPQAq', 'Algeria', 'Screenshot (369).png', NULL),
(41, 'Mina Magdy', 'mn.magdy455@gmail.com', '$2y$10$HymCU5KOdCYajM1YRJZGLu037KtK9QqWvqoaTljm/IlEuYxTRAlAG', 'Algeria', 'Screenshot (359).png', NULL),
(42, 'DataVision Analytics', 'Maloka.elhalawany@gmail.com', '$2y$10$BhnxhLVrIDMAxMzPOEY4jeuzVnhptl4BWQfDa/eoN3nFhYgigRw4W', 'Tunisia', 'Screenshot (367).png', NULL),
(43, ' E-Shop Masters', 'zezowaleed2712@gmail.com', '$2y$10$uix7X/L1Hrqw4wcxHcipxewboXCtXoeGZ8keQkBX3NxKoSJngiwae', 'Kuwait', 'Logo.png', NULL),
(44, 'FreshTaste Foods', 'kittyelkfrawy@gmail.com', '$2y$10$oJXoV.y1hns8Mh.tB5JZ.emk41R3znuzxrDD5Eh2XOrsBYr7O8HKS', 'Saudi Arabia', 'Screenshot (361).png', NULL),
(45, ' GadgetReview Central', '01123040511m@gmail.com', '$2y$10$kpnXXARQpjeWXMPBNII83Ofm3CZeFQfc23oIV2U3lI4gAuXRgPWSK', 'Saudi Arabia', 'Screenshot (365).png', NULL),
(46, 'Hopeful Hearts Foundation', '01123040511a@gmail.com', '$2y$10$yiYd3ougR.AFQNNs.YG3r.biDe3tW6F6zT7ylDt6NC16Wi07.F03O', 'Qatar', 'Screenshot (362).png', NULL),
(47, 'Innovate Local Biz', 'survivya2@gmail.com', '$2y$10$Q4pae0wZDFk7hbEtTGap/updur0dEhrxOptKO52vSr4ijMvHaIal.', 'Saudi Arabia', 'Screenshot (357).png', NULL),
(48, 'InnovateUX Labs', 'gannaalaa02@gmail.com', '$2y$10$1tAP72dJFoHc1z7vtWP0iOm1CsRoen/JiiuDgEhhNd4nTlcOWOlwy', 'Saudi Arabia', 'Screenshot (370).png', NULL),
(49, ' Luxe Living Blog', 'marizthabet05@gmail.com', '$2y$10$Na6G7iQ7qSqupyrb5ZuCF.LOZNtCNSCNjcJiiF.7y4NhscUnDFwti', 'the United Arab Emirates', 'Screenshot (363).png', NULL),
(50, 'PixelPerfect Design', 'mariz.thabet33@gmail.com', '$2y$10$OlsVvz5uWyeDzfBisxtjquh0haZ4Rk4MRFkwhUk2z35z/Kjo1lGOe', 'Egypt', 'Screenshot (371).png', NULL),
(51, ' SmartData Solutions', 'mariz.thabeet@gmail.com', '$2y$10$vutzTnkAegrYCVjlaQAd6e6QQxdLfBdpwDLMjMxGBeNWWTjyJQnQO', 'Lebanon', 'Screenshot (368).png', NULL),
(52, 'Wellness World', 'notyourbusiness960@gmail.com', '$2y$10$6H3HXxDXPZ/QFksjABiGAe7lmB79vJwpJHLtKUqxUm7BrDqrOIN0m', 'Oman', 'Screenshot (366).png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `files` longtext NOT NULL,
  `post_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `text`, `files`, `post_id`, `freelancer_id`) VALUES
(25, 'interested', '', 31, 43),
(26, 'interested', '', 31, 56);

-- --------------------------------------------------------

--
-- Table structure for table `c_comments`
--

CREATE TABLE `c_comments` (
  `c_comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `c.post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_comments`
--

INSERT INTO `c_comments` (`c_comment_id`, `comment`, `client_id`, `freelancer_id`, `c.post_id`) VALUES
(57, 'join me', 41, NULL, 43),
(58, 'like', NULL, 43, 43),
(59, 'nice ', 44, NULL, 44);

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
  `freelancer_image` longtext DEFAULT NULL,
  `hide` int(11) NOT NULL DEFAULT 0,
  `ban` int(11) NOT NULL DEFAULT 0,
  `time` date DEFAULT NULL,
  `days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`freelancer_id`, `freelancer_name`, `freelancer_email`, `freelancer_password`, `available_hours`, `price/hour`, `N_id`, `birthdate`, `cat_id`, `subcat_id`, `about`, `job_title`, `views`, `average_rate`, `rank_id`, `freelancer_image`, `hide`, `ban`, `time`, `days`) VALUES
(39, 'Mariam Ayed ', 'pikotitoo@gmail.com', '$2y$10$5Clu7jITYqn/ANz3PIffHe/iD0icy67uvQomkDBGtaQrOJJx6hAHS', 8, 40, '30501180100842', '2005-01-18', 5, 16, ' A consultant in the field of human resources data analysis for more than 10 years and also  holds a diploma in data science and analysis. I can work with Excel very efficiently, and I also use Power BI and Python to analyze data.', ' Data analyses', 12, 2.5, 1, 'Mariam 3aed photo.png', 0, 0, NULL, NULL),
(40, 'Menna adle ', 'kittyelkfrawy@gmail.com', '$2y$10$ldAQMDOYdkAdmE8YE.L2veaqGTqAML8EBbUXunzjle3vjEKDeqJ/S', 12, 65, '30501180100842', '2005-01-18', 5, 17, ': This is Menna, a specialist in data science, and I hold a master’s degree in technological  information systems from the College of Computers and Information at the Arab Academy for  Science, Technology, and Maritime Transport.', ' Data scientist', 34, 2.5, 1, 'Menna adle.png', 0, 0, NULL, NULL),
(42, 'karim ahmed', 'allam146@gmail.com', '$2y$10$J8V.3TXH6b3WigsDRLJ4Vu1fF3hfHAQBzqwV/xd9Wqos8IfIZ7gkO', 12, 40, '30501180100842', '2005-01-18', 5, 16, 'I am a data analyst and accountant, with extensive experience in SQL, Excel, Power BI, and Power  Query.  As a data analyst, I have strong skills in SQL language, which allows me to extract, process, and  analyze data efficiently. I have extensive experie', 'Data analyses ', 6, 2.5, 1, 'Nour eldeen Photo.png', 0, 0, NULL, NULL),
(43, 'Mahmoud Allam', 'malllam146@gmail.com', '$2y$10$9aNeFP4q840lufEoAwfzH.A/U5axdrRnIljUlnU/GS01HWNP07mem', 7, 30, '30501180100842', '2005-01-18', 5, 17, 'I have extensive experience in Excel, dealing with VBA programming, and benefiting from its  advanced functions and formulas to uncover valuable insights and generate them in interactive  reports that show the status of your project.  In addition, I have ', 'Data scientist', 66, 2.5, 3, 'download (3).jpeg', 0, 0, NULL, NULL),
(44, 'Abdelrahman Rasmi', '01123040511m@gmail.com', '$2y$10$k98FGtz.wtrT7gTo6HUiFeHOtySB5Uffup98pOHtyV9dNMiU.r3O.', 12, 35, '30501180100842', '2005-01-18', 4, 12, 'Welcome, i am Abu Talib Adam, a PHP, Laravel, HTML, CSS, and JavaScript developer. I bring  a real enthusiasm for learning and a strong foundation in backend development.', ' Back-End', 2, 2.5, 1, 'Abdelrahman ramsi photo.png', 0, 0, NULL, NULL),
(45, 'Abdelrahman Yasser', 'zezowaleed2712@gmail.com', '$2y$10$of2Z6jIXFSMlju66tfKQMejDy36jbdYkOw5Kwn14.Kc.KIlhMWMbW', 12, 25, '30501180100842', '2005-01-18', 4, 12, 'I`m a software developer. I have a proven track record in providing innovative and easy-to use solutions in addition to the utmost precision in website design. My experience spans across a range of programming languages including: Python- JavaScript- C++-', 'Back-End', 1, 2.5, 3, 'Abdelrahman yasser photo.png', 0, 1, '2024-09-10', 7),
(46, 'Ali Ganzory', '01123040511a@gmail.com', '$2y$10$qIYhxPxgjw73WHX6Wn6/S.DAgQvksRLK7mJc.g.wtxB4lUgHgobze', 10, 25, '30501180100842', '2005-01-18', 4, 13, 'I am a Full Stack developer with more than two years of experience, specializing in building  and maintaining integrated applications and websites using MERN and Next.js technologies. My  extensive experience in front-end and back-end development enables ', 'Full-stack', 2, 2.5, 3, 'Ali photo.png', 0, 0, NULL, NULL),
(47, ' Mohamed Tantawi', 'mariz.thabeet@gmail.com', '$2y$10$NXAm4yRm5It/CcFMmDcXM.P8rRFqc6NvI20Z86N7Cx0rk2ZlG3jZC', 8, 55, '30501180100842', '2005-01-18', 4, 13, 'I am a full stack developer with 6 years of programming experience.  Let me know if you have any questions After the project is completed, there are (3) months of free support.  I can design websites, UI/UX, as well as mobile development.', 'Full-stack', 9, 2.5, 1, 'Mohamed tantawi photo.png', 0, 0, NULL, NULL),
(48, 'Tony Ehab', 'mariz.thabet33@gmail.com', '$2y$10$kv3wu8VlHfwgaG9s1/PM4ueo3FHWrKcKXqvJH7a80TKSzaxxEH2bS', 12, 5, '30501180100842', '2005-01-18', 4, 11, 'I have sufficient experience to develop a website that suits your company and competes strongly in  the market.  Using the most famous website development languages, tools, and frameworks, learn about the  most famous ones:  HTML5, CSS3, SASS, JavaScript.', 'Fron-End', 1, 2.5, 2, 'Tony photo.png', 0, 0, NULL, NULL),
(49, 'Alia Mohamed', 'Alia.najdallah@gmail.com', '$2y$10$UHcw2TTvI6aVA8WhFhtYXufI75DcPHACGsHvamaOImmrDylOxK43O', 8, 20, '30501180100842', '2005-01-18', 6, NULL, NULL, NULL, 1, 2.5, 3, 'default.jpg', 0, 0, NULL, NULL),
(50, 'Mohamed ali', 'Alia@pmaestro.com', '$2y$10$LcAvhIMRRFsb2n2cMt7aduiMc9VplkUGm3DsxAaaijncj8RH.UNt2', 12, 25, '30501180100842', '2005-01-18', 6, NULL, NULL, NULL, 1, 2.5, 2, 'default.jpg', 0, 0, NULL, NULL),
(51, 'Ehab tony', 'talkafrawy@gmail.com', '$2y$10$h1XVJOXJtTAvDJXS0fCW/O2goSoxsVLnQvUyUHRH4jrbtYyRO47Qq', 5, 35, '30501180100842', '2005-01-18', 7, NULL, NULL, NULL, 2, 2.5, 1, 'default.jpg', 0, 0, NULL, NULL),
(55, 'Rawda magdy', 'Rawdamagdy12@gmail.com', '$2y$10$IntI3bkhVP4SVP/S18ePcOB8BCjr5Z3HoQb89UbsE1c0sCCG9IuGa', 12, 15, '30501180100842', '2005-01-18', 7, NULL, NULL, NULL, 1, 2.5, 1, 'default.jpg', 0, 0, NULL, NULL),
(56, 'gannah alaa', 'gannaalaa02@gmail.com', '$2y$10$iv.mvhLlHF.A4pULIEeTaOaeArLteudKHIZSySJIytj8LkVHrdLfC', 12, 40, '30501180100842', '2005-01-18', 9, NULL, NULL, NULL, 2, 2.5, 2, 'default.jpg', 0, 0, NULL, NULL),
(59, 'merna mohamed', 'gannahalaa.presentaion@gmail.com', '$2y$10$gxTpFs6E0yv7IURkbhRFsu6s7Bdnv0TNy2ny4G0MIG6r9u4zPGtNe', 8, 30, '30501180100842', '2005-01-18', 9, NULL, NULL, NULL, 1, 2.5, 3, 'default.jpg', 0, 0, NULL, NULL),
(60, 'jana mohamed', 'survivya2@gmail.com', '$2y$10$bo8sTGFzRLu42HSyHZDYWuCOfksthsFuapMvXOtczwbz0cpQNtFfO', 8, 55, '30501180100842', '2005-01-18', 8, 19, ' A passionate freelance designer with a love for crafting visually stunning and impactful designs. With 4 years of experience in the design industry, I specialize in [graphic design/web design/UX/UI design/branding/etc.].', 'Animations', 1, 2.5, 1, 'OIF.jpeg', 0, 0, NULL, NULL),
(61, 'ahmed mohamed', 'notyourbusiness960@gmail.com', '$2y$10$no/9F2zvSbik.KdyGztsVea1Jh4lbsyh0WhFjQFHBOp3JA.RTMSAu', 10, 45, '30501180100842', '2005-01-18', 8, 18, 'My design philosophy revolves around understanding your unique needs and translating them into effective and engaging visual solutions. Whether it\'s a sleek website, a memorable brand identity, or eye-catching marketing materials.', 'Animations', 1, 2.5, 3, 'OIP (1).jpeg', 0, 0, NULL, NULL);

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
(19, 43, 'https://www.linkedin.com/feed/');

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
(26, 75, 41, 43, 150),
(27, 77, 44, 43, 120);

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
(28, 5, 61, 'post for hiring'),
(29, 5, 62, 'post for hiring'),
(30, 5, 64, 'post for hiring data analyst'),
(31, 5, 60, 'post for hiring data analyst'),
(32, 4, 65, 'new post');

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
(52, 'project 1', 'project 1', 2, 44),
(53, 'project1', 'team project', 1, 41),
(59, 'TASK 2', 'TO DO', 1, 47),
(60, 'project 2', 'project no.2', 2, 41),
(61, 'project 2', 'project no.2', 1, 44),
(62, 'project 1', 'project no.1', 1, 40),
(63, 'project 2', 'project no.2', 2, 40),
(64, 'project 3', 'project no.3', 1, 44),
(65, 'project 1', 'project no.1', 1, 48);

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
(52, 40),
(60, 43),
(61, 43);

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

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `client_id`, `freelancer_id`, `rate`) VALUES
(23, 41, 43, 5),
(24, 44, 43, 5),
(25, 41, 43, 5);

-- --------------------------------------------------------

--
-- Table structure for table `react`
--

CREATE TABLE `react` (
  `react_id` int(11) NOT NULL,
  `action` int(11) DEFAULT NULL,
  `c.post_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `react`
--

INSERT INTO `react` (`react_id`, `action`, `c.post_id`, `client_id`, `freelancer_id`) VALUES
(163, 1, 43, 41, NULL),
(164, 1, 44, NULL, 43),
(165, 1, 43, NULL, 43),
(166, 1, 44, 44, NULL),
(167, 0, 43, 44, NULL),
(168, 1, 44, 48, NULL),
(169, 1, 45, 48, NULL),
(170, 1, 43, 48, NULL),
(171, 1, 46, NULL, 43),
(172, 1, 45, NULL, 43);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `freeelancer_id` int(11) NOT NULL,
  `report` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `client_id`, `freeelancer_id`, `report`) VALUES
(15, 39, 45, 'bad'),
(16, 41, 43, 'late work'),
(17, 41, 43, 'bad');

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
(72, 'pending', 43, 53, 12),
(74, 'pending', 43, 59, 88),
(75, 'Approval', 43, 60, 5),
(76, 'pending', 39, 53, 12),
(77, 'Approval', 43, 61, 4),
(78, 'pending', 39, 61, 2),
(79, 'Approval', 43, 52, 6);

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
(36, 43, 44, 'good job'),
(37, 43, 44, 'good job'),
(38, 43, 41, 'Great freelancer');

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

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`sample_id`, `freelancer_id`, `sample_file`, `sample_desc`, `sample_name`) VALUES
(13, 39, 'Sample 1.png', 'sample 1', 'sample1'),
(14, 39, 'Sample 2.jpg', 'sample 2', 'sample2'),
(15, 39, 'Sample 3.jpg', 'sample 3', 'sample3'),
(16, 39, 'Sample.jpg', 'sample 4', 'sample4'),
(17, 40, 'Sample 1.jpeg', 'sample 1', 'sample1'),
(18, 40, 'Sample 2.jpeg', 'sample 2', 'sample2'),
(19, 40, 'Sample 3.jpg', 'sample 3', 'sample3'),
(20, 42, 'Sample 1.jpg', 'sample 1', 'sample1'),
(21, 42, 'Sample 2.jpg', 'sample 2', 'sample2'),
(22, 42, 'Sample 3.jpg', 'sample 3', 'sample3'),
(23, 42, 'Sample 4.jpg', 'sample 4', 'sample4'),
(24, 42, 'Sanple 5.jpg', 'sample 5', 'sample5'),
(25, 43, 'Sample 1.png', 'sample 1', 'sample1'),
(26, 43, 'Sample 2.png', 'sample 2', 'sample2'),
(27, 43, 'Sample 3.png', 'sample 3', 'sample3'),
(28, 43, 'Sample 4.png', 'sample 4', 'sample4'),
(29, 44, 'Sample 1.jpeg', 'sample 1', 'sample1'),
(30, 44, 'Sample 2.jpeg', 'sample 2', 'sample2'),
(31, 44, 'Sample 3.jpeg', 'sample 3', 'sample3'),
(32, 44, 'Sample 4.jpeg', 'sample 4', 'sample4'),
(33, 44, 'Sample 5.jpeg', 'sample 5', 'sample5'),
(34, 44, 'Sample 6.jpeg', 'sample 6', 'sample6'),
(35, 45, 'Sample 1.png', 'sample 1', 'sample1'),
(36, 45, 'Sample 2.png', 'sample 2', 'sample2'),
(37, 45, 'Sample 3.png', 'sample 3', 'sample3'),
(38, 45, 'Sample 4.png', 'sample 4', 'sample4'),
(39, 45, 'Sample 5.png', 'sample 5', 'sample5'),
(40, 45, 'Sample 6.png', 'sample 6', 'sample6'),
(41, 45, 'Sample 7.png', 'sample7', 'sample7'),
(42, 45, 'Sample 8.png', 'sample 8', 'sample8'),
(43, 46, 'Sample 1.png', 'sample 1', 'sample1'),
(44, 46, 'Sample 2 .png', 'sample 2', 'sample2'),
(45, 46, 'Sample 3.png', 'sample 3', 'sample3'),
(46, 46, 'Sample 4.png', 'sample 4', 'sample4'),
(47, 46, 'Sample 5 .png', 'sample 5', 'sample5'),
(48, 46, 'Sample 6.png', 'sample 6', 'sample6'),
(49, 47, 'Sample 1.png', 'sample 1', 'sample1'),
(50, 47, 'Sample 2.png', 'sample 2', 'sample2'),
(51, 47, 'Sample 3.png', 'sample 3', 'sample3'),
(52, 48, 'Sample 1.png', 'sample 1', 'sample1'),
(53, 48, 'Sample 2.png', 'sample 2', 'sample2'),
(54, 48, 'Sample 3.png', 'sample 3', 'sample3'),
(55, 49, 'acpqogrhcf3dwdtrrwff.wav', 'voice over 1', 'sample1'),
(56, 49, 'acpqogrhcf3dwdtrrwff.wav', 'voice over 2', 'sample2'),
(57, 50, 'cejkexyumovqtxp3ypjw.mp3', 'voice over 1', 'sample 1'),
(58, 50, 'ilknsyz9avqlx70hxe3h.mp3', 'voice over', 'sample 2'),
(59, 51, 'OIP.jpeg', 'marketing sample', 'sample 1'),
(60, 55, 'OIP.jpeg', 'sample for marketing', 'sample 1'),
(61, 60, 'download (1).jpeg', 'animation sample', 'sample 1'),
(62, 61, 'download (2).jpeg', '2D animation', 'sample 1'),
(63, 61, 'OIF (1).jpeg', '2D animation 2', 'sample 2');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'to do'),
(2, 'inprogress'),
(3, 'done');

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
-- Table structure for table `task_details`
--

CREATE TABLE `task_details` (
  `project_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `file` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_details`
--

INSERT INTO `task_details` (`project_id`, `freelancer_id`, `status_id`, `file`) VALUES
(60, 43, 1, NULL),
(61, 43, 1, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `client_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`client_id`, `freelancer_id`) VALUES
(41, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `c.posts`
--
ALTER TABLE `c.posts`
  ADD PRIMARY KEY (`c.post_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `client_id` (`client_id`);

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
-- Indexes for table `c_comments`
--
ALTER TABLE `c_comments`
  ADD PRIMARY KEY (`c_comment_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `c.post_id` (`c.post_id`);

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
-- Indexes for table `react`
--
ALTER TABLE `react`
  ADD PRIMARY KEY (`react_id`),
  ADD KEY `c.post_id` (`c.post_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freeelancer_id` (`freeelancer_id`);

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
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `task_details`
--
ALTER TABLE `task_details`
  ADD PRIMARY KEY (`project_id`,`freelancer_id`),
  ADD KEY `project_id` (`project_id`,`freelancer_id`),
  ADD KEY `status` (`status_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`client_id`,`freelancer_id`),
  ADD KEY `client_id` (`client_id`,`freelancer_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `c.posts`
--
ALTER TABLE `c.posts`
  MODIFY `c.post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `c_comments`
--
ALTER TABLE `c_comments`
  MODIFY `c_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `freelancer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `react`
--
ALTER TABLE `react`
  MODIFY `react_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `c.posts`
--
ALTER TABLE `c.posts`
  ADD CONSTRAINT `c.posts_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c.posts_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `c_comments`
--
ALTER TABLE `c_comments`
  ADD CONSTRAINT `c_comments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_comments_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_comments_ibfk_3` FOREIGN KEY (`c.post_id`) REFERENCES `c.posts` (`c.post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `react`
--
ALTER TABLE `react`
  ADD CONSTRAINT `react_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `react_ibfk_2` FOREIGN KEY (`c.post_id`) REFERENCES `c.posts` (`c.post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `react_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`freeelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `task_details`
--
ALTER TABLE `task_details`
  ADD CONSTRAINT `task_details_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_details_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_details_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
