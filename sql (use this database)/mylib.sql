-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2024 at 08:57 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mylib`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` varchar(5) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `category_id` varchar(5) NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `fk_cat_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `category_id`) VALUES
('B001', 'Harry Potter 1', 'C002'),
('B003', 'DARK', 'C001');

-- --------------------------------------------------------

--
-- Table structure for table `bookborrower`
--

DROP TABLE IF EXISTS `bookborrower`;
CREATE TABLE IF NOT EXISTS `bookborrower` (
  `borrow_id` varchar(5) NOT NULL,
  `book_id` varchar(5) NOT NULL,
  `member_id` varchar(5) NOT NULL,
  `borrow_status` varchar(100) NOT NULL,
  `borrower_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`borrow_id`,`book_id`,`member_id`),
  KEY `fk_book_id` (`book_id`),
  KEY `fk_member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookborrower`
--

INSERT INTO `bookborrower` (`borrow_id`, `book_id`, `member_id`, `borrow_status`, `borrower_date_modified`) VALUES
('BR001', 'B003', 'M001', 'Borrowed', '2024-06-13 05:00:08'),
('BR002', 'B001', 'M001', 'Available', '2024-06-14 06:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `bookcategory`
--

DROP TABLE IF EXISTS `bookcategory`;
CREATE TABLE IF NOT EXISTS `bookcategory` (
  `category_id` varchar(5) NOT NULL,
  `category_Name` varchar(100) NOT NULL,
  `date_modified` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookcategory`
--

INSERT INTO `bookcategory` (`category_id`, `category_Name`, `date_modified`) VALUES
('C001', 'Sci-fi', '2014-08-12 11:14:54am'),
('C002', 'Adventure', '2014-08-13 11:14:54am');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

DROP TABLE IF EXISTS `fine`;
CREATE TABLE IF NOT EXISTS `fine` (
  `fine_id` varchar(5) NOT NULL,
  `book_id` varchar(5) NOT NULL,
  `member_id` varchar(5) NOT NULL,
  `fine_amount` varchar(100) NOT NULL,
  `fine_date_modified` varchar(100) NOT NULL,
  PRIMARY KEY (`fine_id`),
  KEY `fk_book_id_fine` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`fine_id`, `book_id`, `member_id`, `fine_amount`, `fine_date_modified`) VALUES
('F001', 'B001', 'M001', '200', '2014-08-18 11:14:54am');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `member_id` varchar(5) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `birthday`, `email`) VALUES
('M001', 'Shan', 'Jayasekar', '12/02/2000', 'shan@gmail.com'),
('M002', 'Shammi', 'Nethupul', '2000/12/05', 'cycotechnologies@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `first_name`, `last_name`, `username`, `password`) VALUES
('U002', 'saman@gmail.com', 'saman', 'kumara', 'Saman', '$2y$10$pFqaTPsq4dVoufzwaGTlGuWMLzly1MiAfRT4lMFUP2yGguANrPJlK'),
('U003', 'kamal@gmail.com', 'kamal', 'kalhara', 'kamal', '$2y$10$YVVA1zscazYK6TChfIMFyOA7JDdnWd/BbmC7LgF13H8OMOLy5Rlrq');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_cat_id` FOREIGN KEY (`category_id`) REFERENCES `bookcategory` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookborrower`
--
ALTER TABLE `bookborrower`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON UPDATE CASCADE;

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `fk_book_id_fine` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
