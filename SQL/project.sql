-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2019 at 05:05 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rent` int(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `bed` varchar(255) NOT NULL,
  `bath` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `detloc` varchar(255) NOT NULL,
  `det` varchar(255) NOT NULL,
  `pimage` varchar(255) NOT NULL,
  `simage1` varchar(255) DEFAULT NULL,
  `simage2` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `title`, `type`, `rent`, `area`, `bed`, `bath`, `location`, `detloc`, `det`, `pimage`, `simage1`, `simage2`, `status`, `phone`, `owner`) VALUES
(8, '3 Bedroom Apartment', 'Flat', 30000, '1500', '3', '4', 'Uttara', 'House: 42, Road: 6/A, Sector 5', 'Policy: Advance 2 months, Gate Lock: 11 PM, Rent Due Date 5th of each month\r\nAmenities: Lift, Generator, Hot Water, South Facing', 'image/156609837423175af2ea1b03786.png', 'image/15660983741852614-1200x900.jpg', 'image/1566098374120031431-Interior-Chinese-Apartment-Sketchup-Model-Free-Download-1.jpg', '1', '01940188701', 'fahim'),
(11, 'Duplex House', 'House', 45000, '45000', '5', '5', 'Bashundhara', 'House: 42, Road: 6/A, Sector 5', 'Policy: Advance 2 months, Gate Lock: 11 PM, Rent Due Date 5th of each month\r\nAmenities: Lift, Generator, Hot Water, South Facing\r\n', 'image/156609952114475be4322b924bc3b-e9988c1f-large.jpg', 'image/1566099521205855070664.jpg', 'image/15660995211584114-1200x900.jpg', '1', '01940188701', 'fahim'),
(14, '2 Bedroom Apartment', 'Flat', 15000, '1500', '2', '2', 'Mirpur', 'House: 42, Road: 6/A, Sector 5', 'Policy: Advance 2 months, Gate Lock: 11 PM, Rent Due Date 5th of each month\r\nAmenities: Lift, Generator, Hot Water, South Facing', 'image/156609990686114-1200x900.jpg', 'image/156609990615061photo-1522708323590-d24dbb6b0267.jpg', 'image/1566099906146img_4239-1.jpg', '1', '01940188701', 'fahim'),
(15, '5 Bedroom Apartment', 'Flat', 35000, '4000', '5', '6+', 'Gulshan', 'House: 42, Road: 6/A, Sector 5', 'Policy: Advance 2 months, Gate Lock: 11 PM, Rent Due Date 5th of each month\r\nAmenities: Lift, Generator, Hot Water, South Facing', 'image/1566100001171491431-Interior-Chinese-Apartment-Sketchup-Model-Free-Download-1.jpg', 'image/15661000011449755070664.jpg', 'image/15661000017369photo-1522708323590-d24dbb6b0267.jpg', '1', '01940188701', 'fahim'),
(16, 'Master Bed Room', 'Room', 8000, '150', '1', '1', 'Khilkhet', 'House 35, Block A, Road 9', 'Service Charge: 2000 taka', 'image/156611346512855gubhostel3.jpg', 'image/15661134655916gubhostel4.jpg', 'image/1566113465116311649.jpg', '1', '01940188701', 'fahim'),
(17, '2 Bedroom Flat', 'Flat', 15000, '1200', '2', '2', 'Mirpur', 'Road 6/A', 'Advance 2 month', 'image/1566115530147135af2ea1b03786.png', 'image/1566115530586414-1200x900.jpg', 'image/156611553045021431-Interior-Chinese-Apartment-Sketchup-Model-Free-Download-1.jpg', '1', '01940188701', 'fahim');

-- --------------------------------------------------------

--
-- Table structure for table `tolet`
--

CREATE TABLE `tolet` (
  `id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `rent` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `rent_from` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `adstatus` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `tolet`
--

INSERT INTO `tolet` (`id`, `Name`, `rent`, `image`, `location`, `property_type`, `rent_from`, `number`, `adstatus`) VALUES
(2, '2 Bedroom Apartment', 20000, '1.jpg', 'Uttara', 'Apartment', 'August', '019554285', 1),
(3, '1 Seat on Masterbed', 5000, '2.jpg', 'Bashundhara', 'Seat', 'August', '0185525112', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `phonenumber`, `image`) VALUES
(1, 'asdsa', 'sdad', 'fahimsm96@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', '1940188701', 'image/C Sharp 2.JPG'),
(2, 'Sirajum Munir Fahim', 'sadsaf', 'fah96@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', '1940188701', 'image/1565859740C sharp.JPG'),
(3, 'Sirajum Munir', 'munirfahim', 'ksajd@cc.com', '4c56ff4ce4aaf9573aa5dff913df997a', '01871437006', 'image/1565961626cafeeaa8793561f51e1c94daebb74939.jpg'),
(4, 'Sirajum Munir Fahim', 'fahim', 'sirajummunir@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', '01940188701', 'image/1566098093xOm7WWYH.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tolet`
--
ALTER TABLE `tolet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tolet`
--
ALTER TABLE `tolet`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
