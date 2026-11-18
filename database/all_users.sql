-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 مارس 2025 الساعة 07:53
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `all_users`
--

-- --------------------------------------------------------

--
-- بنية الجدول `classroom`
--

CREATE TABLE `classroom` (
  `code_class` varchar(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `Section` varchar(255) NOT NULL,
  `nameTeacher` varchar(255) NOT NULL,
  `image_Acount` varchar(255) NOT NULL,
  `class_Name` varchar(255) NOT NULL,
  `sending` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `classroom`
--


-- --------------------------------------------------------

--
-- بنية الجدول `courses`
--

CREATE TABLE `courses` (
  `title` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `Files` text NOT NULL,
  `Image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `NameTeacher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `courses`
--

INSERT INTO `courses` (`title`, `Price`, `Files`, `Image`, `description`, `course_id`, `duration`, `NameTeacher`) VALUES
('PHP', 100, '[{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412517_E16m4TqjHvpB1gjJZBbtMZP2yLoBZwDVXmPbpVvE.mp4\",\"id\":1,\"title\":\"E16m4TqjHvpB1gjJZBbtMZP2yLoBZwDVXmPbpVvE.mp4\",\"duration\":\"13:21\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412523_N9EJo978guW4qGLA0xUEUEx2atZwuRl7yf1f3zdX.mp4\",\"id\":2,\"title\":\"N9EJo978guW4qGLA0xUEUEx2atZwuRl7yf1f3zdX.mp4\",\"duration\":\"04:23\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412524_oqZxJmvKgTJQleUwQfMcldTZDzRqhyaSX1kFlF3T.mp4\",\"id\":3,\"title\":\"oqZxJmvKgTJQleUwQfMcldTZDzRqhyaSX1kFlF3T.mp4\",\"duration\":\"09:55\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412525_Ose4BqVds1yVWqcNFqTtwlfRfdQySzdNxaezqzIc.mp4\",\"id\":4,\"title\":\"Ose4BqVds1yVWqcNFqTtwlfRfdQySzdNxaezqzIc.mp4\",\"duration\":\"12:13\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412528_ouuKzXHOlHZwRXWc9HdTEKwKOkXNN1SH8ZdmwFWT.mp4\",\"id\":5,\"title\":\"ouuKzXHOlHZwRXWc9HdTEKwKOkXNN1SH8ZdmwFWT.mp4\",\"duration\":\"04:49\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412540_qA97osvwWm8kb2AsniBWrV3nXlClHil8XYGZGY0e.mp4\",\"id\":6,\"title\":\"qA97osvwWm8kb2AsniBWrV3nXlClHil8XYGZGY0e.mp4\",\"duration\":\"11:29\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412548_QEKW1d1uNJDuut0GctWWqXgYMKmfU68XH79KB17g.mp4\",\"id\":7,\"title\":\"QEKW1d1uNJDuut0GctWWqXgYMKmfU68XH79KB17g.mp4\",\"duration\":\"15:08\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412557_XUXpJC6gbwszgodZ6m282gaPUi18MCImEZn3t4w4.mp4\",\"id\":8,\"title\":\"XUXpJC6gbwszgodZ6m282gaPUi18MCImEZn3t4w4.mp4\",\"duration\":\"06:03\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412559_YIibwbP3xvoqQhsYQ37nwrEkRbKzCnicoIHS5LxU.mp4\",\"id\":9,\"title\":\"YIibwbP3xvoqQhsYQ37nwrEkRbKzCnicoIHS5LxU.mp4\",\"duration\":\"03:50\"},{\"path\":\"..\\/..\\/uploadsCourse\\/PHP_1738412514\\/1738412561_ZgFzM2oYDMCVh92GV3kqONuTannh2lsP2DIQfqTI.mp4\",\"id\":10,\"title\":\"ZgFzM2oYDMCVh92GV3kqONuTannh2lsP2DIQfqTI.mp4\",\"duration\":\"05:47\"}]', '../../uploadsCourse/PHP_1738412514/1738412514_pexels-padrinan-1111318.jpg', 'it is backend  language', 'PHP_1738412561', '87:03', 'Mohamed Ayman'),
('knk', 20, '[{\"path\":\"..\\/..\\/uploadsCourse\\/knk_1739555131\\/1739555134_E16m4TqjHvpB1gjJZBbtMZP2yLoBZwDVXmPbpVvE.mp4\",\"id\":1,\"title\":\"E16m4TqjHvpB1gjJZBbtMZP2yLoBZwDVXmPbpVvE.mp4\",\"duration\":\"13:21\"},{\"path\":\"..\\/..\\/uploadsCourse\\/knk_1739555131\\/1739555135_epyU4DdNosuvmrKNN4XXSYgp4SRU808WLE2a7kNb.mp4\",\"id\":2,\"title\":\"epyU4DdNosuvmrKNN4XXSYgp4SRU808WLE2a7kNb.mp4\",\"duration\":\"09:41\"},{\"path\":\"..\\/..\\/uploadsCourse\\/knk_1739555131\\/1739555135_gundLmpzNvkXLAQFmeOD1HPtEaONqryzNCyFcIbj.mp4\",\"id\":3,\"title\":\"gundLmpzNvkXLAQFmeOD1HPtEaONqryzNCyFcIbj.mp4\",\"duration\":\"03:03\"}]', '../../uploadsCourse/knk_1739555131/1739555131_Screenshot (2).png', 'jj', 'knk_1739555135', '26:06', 'Mohamed'),
('hh', 20, '[{\"path\":\"..\\/..\\/uploadsCourse\\/hh_1739706819\\/1739706820_YIibwbP3xvoqQhsYQ37nwrEkRbKzCnicoIHS5LxU.mp4\",\"id\":1,\"title\":\"YIibwbP3xvoqQhsYQ37nwrEkRbKzCnicoIHS5LxU.mp4\",\"duration\":\"03:50\"},{\"path\":\"..\\/..\\/uploadsCourse\\/hh_1739706819\\/1739706821_ZgFzM2oYDMCVh92GV3kqONuTannh2lsP2DIQfqTI.mp4\",\"id\":2,\"title\":\"ZgFzM2oYDMCVh92GV3kqONuTannh2lsP2DIQfqTI.mp4\",\"duration\":\"05:47\"}]', '../../uploadsCourse/hh_1739706819/1739706819_Screenshot (2).png', 'fd', 'hh_1739706821', '09:38', 'Abdallah'),
('h', 100, '[{\"path\":\"..\\/..\\/uploadsCourse\\/h_1741118703\\/1741118748_ZgFzM2oYDMCVh92GV3kqONuTannh2lsP2DIQfqTI.mp4\",\"id\":1,\"title\":\"ZgFzM2oYDMCVh92GV3kqONuTannh2lsP2DIQfqTI.mp4\",\"duration\":\"05:47\"}]', '../../uploadsCourse/h_1741118703/1741118704_ااااااااااا.jpg', 'it is backend langue', 'h_1741118748', '05:47', 'Mohamed Ayman');

-- --------------------------------------------------------

--
-- بنية الجدول `donecourse`
--

CREATE TABLE `donecourse` (
  `email` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `idperson` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `inside_class`
--

CREATE TABLE `inside_class` (
  `id` int(11) NOT NULL,
  `code_class` varchar(50) NOT NULL,
  `comments` text DEFAULT NULL,
  `image_account` varchar(255) DEFAULT NULL,
  `time` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `style` varchar(255) NOT NULL,
  `name_Acount` varchar(255) NOT NULL,
  `email` varchar(44) NOT NULL,
  `Files` text DEFAULT NULL,
  `test` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `inside_class`
--


-- --------------------------------------------------------

--
-- بنية الجدول `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `Publish` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `resulttest`
--

CREATE TABLE `resulttest` (
  `email` varchar(255) NOT NULL,
  `result` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `resulttest`
--


-- --------------------------------------------------------

--
-- بنية الجدول `student`
--

CREATE TABLE `student` (
  `nameStudent` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `NationalityStudent` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `placement` varchar(255) NOT NULL,
  `NameParent` varchar(255) NOT NULL,
  `NationalityParent` int(11) NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `school` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `img1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`img1`)),
  `img2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`img2`)),
  `img3` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `studentclassroom`
--

CREATE TABLE `studentclassroom` (
  `email` varchar(255) NOT NULL,
  `code_class` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `studentclassroom`
--


-- --------------------------------------------------------

--
-- بنية الجدول `teachers`
--

CREATE TABLE `teachers` (
  `NameTeacher` varchar(255) NOT NULL,
  `phone_Number` int(11) NOT NULL,
  `place_of_residence` varchar(255) NOT NULL,
  `cv` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cv`)),
  `National_number` int(14) NOT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`image`)),
  `date` varchar(255) NOT NULL,
  `sx` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `test`
--

CREATE TABLE `test` (
  `email` varchar(255) NOT NULL,
  `codeTest` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `Test` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Test`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `test`
--


-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `email` varchar(40) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password_user` longtext DEFAULT NULL,
  `image_Acount` longtext DEFAULT NULL,
  `Profession` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`email`, `user_name`, `password_user`, `image_Acount`, `Profession`) VALUES
('a@gmail.com', 'MOSTAFA', 'mygkA200r#', '../../Image/user.png', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`code_class`),
  ADD UNIQUE KEY `code_class` (`code_class`);

--
-- Indexes for table `inside_class`
--
ALTER TABLE `inside_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inside_class`
--
ALTER TABLE `inside_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
