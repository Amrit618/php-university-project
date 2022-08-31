-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2019 at 07:47 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshopnepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'amrit', 'amrit123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `product_price` int(11) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cmnt_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cmnt_id`, `prod_id`, `cat_name`, `username`, `comment`, `date`) VALUES
(26, 1, 'product_mobile', 'bipul', 'hello', '2017-07-29 05:49:12'),
(27, 1, 'product_electronics', 'bipul', 'Is this a original sandwich maker?', '2017-07-29 05:50:28'),
(28, 1, 'product_comp', 'bipul', 'Please include model number also!', '2017-07-29 05:52:47'),
(29, 1, 'product_comp', 'bipul', 'k chha ho', '2017-07-29 06:12:56'),
(30, 2, 'product_mobile', 'Rupesh', 'Please include all the descriptions!', '2017-07-29 06:35:33'),
(31, 2, 'product_mobile', 'Rupesh', 'Is this a brand new phone or an used one??', '2017-07-29 06:36:01'),
(32, 2, 'product_mobile', 'Dicchya', 'I wanna know the last price of the product after discount', '2017-07-29 06:55:15'),
(33, 2, 'product_electronics', 'Dicchya', 'Is this a original Boiler from Baltra ?', '2017-07-29 07:03:08'),
(34, 3, 'product_men', 'rppoudel', 'XL is available or not?', '2017-07-29 09:36:03'),
(35, 2, 'product_electronics', 'ankit', 'Discount?', '2019-08-24 18:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_image` text NOT NULL,
  `product_id` int(5) NOT NULL,
  `order_quantity` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `location` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_image`, `product_id`, `order_quantity`, `user_id`, `location`, `category`, `status`) VALUES
(28, 'i8.jpg', 2, 1, 13, 'Dhulikhel', 'product_mobile', 'shipped'),
(29, 'i8.jpg', 2, 1, 15, 'Dhulikhel', 'product_mobile', 'notshipped');

-- --------------------------------------------------------

--
-- Table structure for table `product_comp`
--

CREATE TABLE `product_comp` (
  `prod_id` int(10) NOT NULL,
  `prod_no` int(15) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_image` text NOT NULL,
  `prod_price` float NOT NULL,
  `prod_quan` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `keyword` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_comp`
--

INSERT INTO `product_comp` (`prod_id`, `prod_no`, `prod_name`, `prod_image`, `prod_price`, `prod_quan`, `date_added`, `keyword`, `category`) VALUES
(1, 1, 'HP Laptop', 'hp.jpg', 60000, 3, '2017-07-03 21:38:28', 'hp, laptop,hp laptop', 'product_comp'),
(2, 2, 'Acer Laptop', 'acer.jpg', 40000, 22, '2017-07-03 21:39:12', 'acer laptop', 'product_comp'),
(3, 3, 'Mac Book Pro', 'mac.jpg', 100000, 22, '2017-07-03 21:41:58', 'mac book', 'product_comp'),
(4, 4, 'Dell', 'dell.jpg', 50000, 2, '2017-07-03 21:42:20', 'dell', 'product_comp');

-- --------------------------------------------------------

--
-- Table structure for table `product_electronics`
--

CREATE TABLE `product_electronics` (
  `prod_id` int(10) NOT NULL,
  `prod_no` int(15) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_image` text NOT NULL,
  `prod_price` float NOT NULL,
  `prod_quan` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `keyword` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_electronics`
--

INSERT INTO `product_electronics` (`prod_id`, `prod_no`, `prod_name`, `prod_image`, `prod_price`, `prod_quan`, `date_added`, `keyword`, `category`) VALUES
(1, 1, 'Sandwich Maker', 'sand.jpg', 2000, 23, '2017-07-02 15:34:03', 'sandwich maker,maker', 'product_electronics'),
(2, 2, 'Baltra Boiler', 'boiler.jpg', 2000, 20, '2017-07-02 20:46:50', 'baltra, boiler ,water boiller', 'product_electronics'),
(3, 3, 'Vacuum Cleaner', 'vacuum.jpg', 10000, 15, '2017-07-02 20:47:32', 'vacuum cleaner', 'product_electronics'),
(4, 4, 'Samsung 32\" LED', 'tv.jpg', 40000, 10, '2017-07-02 20:49:01', 'Samsung TV ,tv', 'product_electronics');

-- --------------------------------------------------------

--
-- Table structure for table `product_home`
--

CREATE TABLE `product_home` (
  `prod_id` int(10) NOT NULL,
  `prod_no` int(15) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_image` text NOT NULL,
  `prod_price` float NOT NULL,
  `prod_quan` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `keyword` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_home`
--

INSERT INTO `product_home` (`prod_id`, `prod_no`, `prod_name`, `prod_image`, `prod_price`, `prod_quan`, `date_added`, `keyword`, `category`) VALUES
(1, 1, 'Gas Stove', 'gas_stove.jpg', 5000, 10, '2017-07-02 20:52:45', 'gas,stove,gas stove', 'product_home'),
(2, 2, 'Chair', 'chair.jpg', 5000, 12, '2017-07-02 20:53:35', 'chair', 'product_home'),
(3, 3, 'Gas Hob', 'hob.jpg', 6000, 11, '2017-07-02 20:54:24', 'gas stove, gas ', 'product_home'),
(4, 4, 'Vacuum Cleaner', 'vacuum.jpg', 5000, 11, '2017-07-02 20:55:32', 'vacuum cleaner', 'product_home');

-- --------------------------------------------------------

--
-- Table structure for table `product_men`
--

CREATE TABLE `product_men` (
  `prod_id` int(10) NOT NULL,
  `prod_no` int(15) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_image` text NOT NULL,
  `prod_price` float NOT NULL,
  `prod_quan` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `keyword` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_men`
--

INSERT INTO `product_men` (`prod_id`, `prod_no`, `prod_name`, `prod_image`, `prod_price`, `prod_quan`, `date_added`, `keyword`, `category`) VALUES
(3, 3, 'Windcheater', 'wind.jpg', 2000, 23, '2017-07-03 21:55:35', 'windcheater', 'product_men');

-- --------------------------------------------------------

--
-- Table structure for table `product_mobile`
--

CREATE TABLE `product_mobile` (
  `prod_id` int(10) NOT NULL,
  `prod_no` varchar(15) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_brandname` varchar(255) NOT NULL,
  `prod_image` text NOT NULL,
  `prod_price` float NOT NULL,
  `prod_quan` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `keyword` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_mobile`
--

INSERT INTO `product_mobile` (`prod_id`, `prod_no`, `prod_name`, `prod_brandname`, `prod_image`, `prod_price`, `prod_quan`, `date_added`, `keyword`, `category`) VALUES
(1, '1', 'Samsung Galaxy s8', 'Samsung', 's8.jpg', 80000, 11, '2017-07-03 21:43:32', 'samsung , s8, new samsung, samsung 2017,mobile', 'product_mobile'),
(2, '2', 'iPhone 7', 'Apple', 'i8.jpg', 100000, 22, '2017-07-03 21:44:04', 'iphone,mobile', 'product_mobile'),
(3, '3', 'One plus 3t', 'OnePlus', 'offer.jpg', 30000, 11, '2017-07-03 21:44:48', 'oneplus,3t', 'product_mobile'),
(4, '4', 'HTC', 'HTC', 'htc-desire-626-global-phone-listing-blue-lagoon.jpg', 20000, 13, '2017-07-03 21:48:26', 'htc', 'product_mobile');

-- --------------------------------------------------------

--
-- Table structure for table `product_women`
--

CREATE TABLE `product_women` (
  `prod_id` int(10) NOT NULL,
  `prod_no` int(15) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_image` text NOT NULL,
  `prod_price` float NOT NULL,
  `prod_quan` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `keyword` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_women`
--

INSERT INTO `product_women` (`prod_id`, `prod_no`, `prod_name`, `prod_image`, `prod_price`, `prod_quan`, `date_added`, `keyword`, `category`) VALUES
(1, 4, 'Adidas shoes', 'Adidas Casual Shoes For Women Sports fashion 864_LRG.jpg', 2000, 11, '2017-07-03 22:01:26', 'shoe', 'product_women');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `email`, `phone`, `username`, `password`) VALUES
(8, 'Bipul', 'Thapa', 'bipulthapa@gmail.com', 9867767364, 'bipul', '81dc9bdb52d04dc20036dbd8313ed055'),
(9, 'Rupesh', 'Poudel', 'rupesh.poudel07@gmail.com', 9876542122, 'rppoudel', '5d41402abc4b2a76b9719d911017c592'),
(10, 'ram', 'poudel', 'a@gmail.com', 9866565454, 'ram', '5d41402abc4b2a76b9719d911017c592'),
(11, 'rupesh', 'poudel', 'rupesh.poudel07@gmail.com', 9812345676, 'Rupesh', '5d41402abc4b2a76b9719d911017c592'),
(12, 'Dicchya', 'Poudel', 'a@gmail.com', 9863245223, 'Dicchya', '5d41402abc4b2a76b9719d911017c592'),
(13, 'Dipesh', 'Rai', 'raidipesh78@gmail.com', 9826354723, 'dipesh', '81dc9bdb52d04dc20036dbd8313ed055'),
(15, 'Ankit', 'Acharya', 'ankit@gmail.com', 9865011888, 'ankit', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `cmnt_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reply_text` text NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `cmnt_id`, `username`, `reply_text`, `reply_date`) VALUES
(7, 29, 'bipul', 'kina', '2017-07-29 06:25:18'),
(8, 29, 'bipul', 'kaile', '2017-07-29 06:25:23'),
(9, 29, 'bipul', 'hora', '2017-07-29 06:32:20'),
(10, 31, 'ram', 'Obviously its a brand new phone just imported from USA.', '2017-07-29 06:37:04'),
(11, 30, 'ram', 'Ok bro thanks for the suggestion!!', '2017-07-29 06:40:32'),
(12, 31, 'Dicchya', 'Great job!', '2017-07-29 06:41:41'),
(13, 33, 'rppoudel', 'Yeah, of course its an original Boiler', '2017-07-29 09:34:50'),
(14, 26, 'dipesh', 'Hey', '2019-08-24 15:31:59'),
(15, 26, 'dipesh', 'Hey', '2019-08-24 15:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cat_name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wish_id`, `prod_id`, `cat_name`, `username`) VALUES
(44, 1, 'product_electronics', 'rppoudel'),
(78, 2, 'product_mobile', 'dipesh'),
(80, 2, 'product_electronics', 'ankit'),
(81, 3, 'product_mobile', 'dipesh'),
(82, 1, 'product_mobile', 'dipesh'),
(83, 1, 'product_women', 'dipesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cmnt_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_comp`
--
ALTER TABLE `product_comp`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_id` (`prod_no`);

--
-- Indexes for table `product_electronics`
--
ALTER TABLE `product_electronics`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_id` (`prod_no`);

--
-- Indexes for table `product_home`
--
ALTER TABLE `product_home`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_id` (`prod_no`);

--
-- Indexes for table `product_men`
--
ALTER TABLE `product_men`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_id` (`prod_no`);

--
-- Indexes for table `product_mobile`
--
ALTER TABLE `product_mobile`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_id` (`prod_no`);

--
-- Indexes for table `product_women`
--
ALTER TABLE `product_women`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_id` (`prod_no`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `cmnt_id` (`cmnt_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cmnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_comp`
--
ALTER TABLE `product_comp`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_electronics`
--
ALTER TABLE `product_electronics`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_home`
--
ALTER TABLE `product_home`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_men`
--
ALTER TABLE `product_men`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_mobile`
--
ALTER TABLE `product_mobile`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_women`
--
ALTER TABLE `product_women`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`cmnt_id`) REFERENCES `comment` (`cmnt_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
