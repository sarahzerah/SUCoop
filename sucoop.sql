-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2018 at 12:10 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sucoop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_sales`
--

CREATE TABLE `cash_sales` (
  `ORNum` int(11) NOT NULL,
  `dateBought` date NOT NULL,
  `timeBought` time NOT NULL,
  `totalAmount` double NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cash_transaction`
--

CREATE TABLE `cash_transaction` (
  `transactionNum` int(11) NOT NULL,
  `dateReceived` date NOT NULL,
  `timeReceived` time NOT NULL,
  `userID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `totalAmount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `charge_invoice`
--

CREATE TABLE `charge_invoice` (
  `chargeInvoiceNum` int(11) NOT NULL,
  `dateBought` date NOT NULL,
  `timeBought` time NOT NULL,
  `totalAmount` double NOT NULL,
  `userID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt`
--

CREATE TABLE `goods_receipt` (
  `GRNum` int(11) NOT NULL,
  `dateRestocked` date NOT NULL,
  `timeRestocked` time NOT NULL,
  `supplierID` int(11) NOT NULL,
  `totalAmount` double NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goods_receipt`
--

INSERT INTO `goods_receipt` (`GRNum`, `dateRestocked`, `timeRestocked`, `supplierID`, `totalAmount`, `userID`) VALUES
(25, '2018-03-17', '07:30:52', 0, 38000, 0),
(26, '2018-03-18', '05:51:30', 0, 17840, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `productNum` int(11) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `category` varchar(15) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `originalPrice` double NOT NULL,
  `SRP` double NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `consignment` varchar(3) NOT NULL,
  `userID` int(11) NOT NULL,
  `status` varchar(8) NOT NULL,
  `supplierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`productNum`, `itemName`, `category`, `unit`, `originalPrice`, `SRP`, `quantity`, `consignment`, `userID`, `status`, `supplierID`) VALUES
(26, 'coke', 'drink', 'bottle', 200, 400, 179, 'yes', 4, 'lacking', 1),
(27, 'gg', 'viand', 'serving', 40, 55, 0, 'no', 4, 'received', 3),
(28, 'mike', 'viand', 'serving', 20, 40, 0, 'yes', 4, 'received', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `purchaseNum` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productNum` int(11) NOT NULL,
  `ORNum` int(11) NOT NULL,
  `chargeInvoiceNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` int(11) NOT NULL,
  `creditLimit` double NOT NULL,
  `creditBalance` double NOT NULL,
  `savings` double NOT NULL,
  `investment` double NOT NULL,
  `status` varchar(8) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `creditLimit`, `creditBalance`, `savings`, `investment`, `status`, `userID`) VALUES
(1, 23580, 3570, 9590, 11790, 'active', 7),
(2, 37000, 60, 6000, 18500, 'active', 8),
(3, -256, 0, 0, -128, 'active', 9),
(4, 940, 390, 500, 470, 'active', 10),
(5, 0, 0, 0, 0, 'inactive', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `orderNum` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productNum` int(11) NOT NULL,
  `PONum` int(11) NOT NULL,
  `comment` text NOT NULL,
  `lacking` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_items`
--

INSERT INTO `ordered_items` (`orderNum`, `quantity`, `productNum`, `PONum`, `comment`, `lacking`) VALUES
(37, 3, 26, 27, 'Received 1. Lacking 2 more.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `PONum` int(11) NOT NULL,
  `dateOrdered` date NOT NULL,
  `timeOrdered` time NOT NULL,
  `totalAmount` double NOT NULL,
  `userID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`PONum`, `dateOrdered`, `timeOrdered`, `totalAmount`, `userID`, `supplierID`) VALUES
(27, '2018-03-18', '01:49:51', 600, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restocked_items`
--

CREATE TABLE `restocked_items` (
  `restockNum` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productNum` int(11) NOT NULL,
  `GRNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restocked_items`
--

INSERT INTO `restocked_items` (`restockNum`, `quantity`, `productNum`, `GRNum`) VALUES
(47, 20, 26, 25),
(48, 10, 26, 25),
(49, 40, 26, 25),
(50, 10, 26, 25),
(51, 10, 26, 25),
(52, 10, 26, 26),
(53, 10, 26, 26),
(54, 40, 26, 26),
(55, 5, 26, 26),
(56, 15, 26, 26),
(57, 3, 26, 26),
(58, 3, 26, 26),
(59, 2, 26, 26),
(60, 1, 26, 26),
(61, 0, 27, 26),
(62, 0, 28, 26);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `companyName` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephoneNum` varchar(8) NOT NULL,
  `mobileNum` varchar(11) NOT NULL,
  `salesRepresentative` varchar(50) NOT NULL,
  `srContactNum` varchar(11) NOT NULL,
  `srEmailAdd` varchar(50) NOT NULL,
  `accountName` varchar(50) NOT NULL,
  `accountNum` varchar(20) NOT NULL,
  `status` varchar(8) NOT NULL,
  `userID` int(11) NOT NULL,
  `bankName` varchar(20) NOT NULL,
  `consignor` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `companyName`, `address`, `telephoneNum`, `mobileNum`, `salesRepresentative`, `srContactNum`, `srEmailAdd`, `accountName`, `accountNum`, `status`, `userID`, `bankName`, `consignor`) VALUES
(1, 'Coca-Cola', 'Dumaguete City', '', '09726352732', 'Mae Ann Jean Anfone', '09159368492', 'maejkawaii@gmail.com', 'Coca-Colay', '1234567890', 'active', 4, 'BPI', 'no'),
(2, 'FancyAll Inc', 'Nochefranca Street', '', '09212433119', 'Dianne Lee', '09159368492', 'dianne@gmail.com', 'Fancy All Inc', '1234567890', 'active', 4, 'BDO', 'yes'),
(3, 'Sucoop', 'silliman', '03522575', '09213763767', 'sarah Ann', '09323984755', 'sas@gmail.com', 'sarag', '0997897999', 'active', 4, 'bdo', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `cTransactionNum` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `amount` double NOT NULL,
  `transactionNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `middleName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `civilStatus` varchar(10) NOT NULL,
  `birthDate` date NOT NULL,
  `homeAddress` varchar(100) NOT NULL,
  `currentAddress` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `contactNum` varchar(11) NOT NULL,
  `contactNum2` varchar(11) NOT NULL,
  `emailAdd` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `picture` text NOT NULL,
  `status` varchar(8) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `dateRemoved` date NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `middleName`, `lastName`, `civilStatus`, `birthDate`, `homeAddress`, `currentAddress`, `role`, `contactNum`, `contactNum2`, `emailAdd`, `username`, `password`, `picture`, `status`, `comment`, `dateRemoved`, `dateCreated`) VALUES
(1, 'Maej', 'Apostol', 'Anfone', 'Single', '1996-05-11', 'Upper Talay, Dumaguete City', 'Seoul, Korea', 'manager', '09956543545', '', 'maejkawaii@gmail.com', 'manager', '81dc9bdb52d04dc20036dbd8313ed055', '1520480983_27953918_1586151424839508_1526038146972647424_n.jpg', 'active', '', '0000-00-00', '2018-03-08'),
(2, 'Sarah', 'Chepwogen', 'Towett', 'Married', '1996-02-01', 'Kenya', 'Dumaguete City', 'cashier', '09872648395', '09121373776', 'sarah@gmail.com', 'cashier', '81dc9bdb52d04dc20036dbd8313ed055', '1520480771_571a52f8ada3b2051abb104944b109f4.jpg', 'active', '', '0000-00-00', '2018-03-08'),
(3, 'Blanche', 'Solon', 'Solamillo', 'Married', '1995-11-04', 'Dauin, Negros Oriental', 'Seoul, South Korea', 'secretary', '09112321312', '09956795084', 'blanche@gmail.com', 'secretary', '81dc9bdb52d04dc20036dbd8313ed055', '1520566155_Koala.jpg', 'active', '', '0000-00-00', '2018-03-08'),
(4, 'Jovan', 'Carbas', 'Renacia', 'Married', '1997-06-17', 'San Jose, Negros Oriental', 'Tokyo, Japan', 'inventory personnel', '09777928758', '', 'jovan@gmail.com', 'inventory', '81dc9bdb52d04dc20036dbd8313ed055', '1520481439_27702325_1344153309024130_3021145150660280320_n.jpg', 'active', '', '0000-00-00', '2018-03-08'),
(5, 'Kimberly', 'Catipay', 'Belcina', 'Single', '1995-10-16', 'Looc, Dumaguete City', 'Camella Road, Candao-ay, Dumaguete City', 'accountant', '09872648392', '09956795084', 'kim@gmail.com', 'accountant', '81dc9bdb52d04dc20036dbd8313ed055', '1520481551_27071738_1571367812948750_8465900716790120448_n.jpg', 'active', '', '0000-00-00', '2018-03-08'),
(6, 'Zxzx', 'Xzxz', 'Zxzxz', 'Married', '2018-03-04', 'Zxzx', 'Sdssd', 'secretary', '45343453443', '34545354545', 'sdas@sdsds.com', 'ZXZxzxz', '0c945e6b6b6615a49afc791b9a5f29ad', 'default.jpg', 'inactive', '', '0000-00-00', '2018-03-08'),
(7, 'Jo Marie', 'Pis-an', 'Morfe', 'Single', '1994-12-21', 'Talay, Dumaguete City', 'Seoul, South Korea', 'member', '09997928758', '', 'jo@gmail.com', 'member', '81dc9bdb52d04dc20036dbd8313ed055', 'default.jpg', 'active', '', '0000-00-00', '2018-03-08'),
(8, 'Michael James', 'Apostol', 'Anfone', 'Married', '1992-01-17', 'Upper Talay, Dumaguete City', 'Tokyo, Japan', 'member', '09627382918', '', 'michael@gmail.com', 'MAAnfone', 'a16a71383b0dc009840d7a4a6b7186fa', 'default.jpg', 'active', '', '0000-00-00', '2018-03-08'),
(9, 'Sherra', 'Teves', 'Salatandre', 'Single', '1995-11-23', 'Dumaguete', 'Manila', 'member', '09912121121', '', 'siarra@gmail.com', 'STSalatandre', 'ae10656c5628cdb282dccd6e830666d2', 'default.jpg', 'active', '', '0000-00-00', '2018-03-09'),
(10, 'Jonathan Mark', 'Nacague', 'Te', 'Single', '1979-01-15', 'CCS', 'CCS', 'member', '09143141717', '', 'jonathanmarkte@gmail.com', 'JNTe', '63ccaceb90e3963b4ff20bd7aa7cdd33', 'default.jpg', 'active', '', '0000-00-00', '2018-03-09'),
(11, 'Joy', 'Montiel', 'Dy', 'Married', '2018-03-09', 'CCS', 'CCS', 'inventory personnel', '12345678900', '', 'joymdy@su.edu.ph', 'JMDy', '0ac8c0689b5706a76fe360c6deb404c6', 'default.jpg', 'active', '', '0000-00-00', '2018-03-09'),
(12, 'WQERWE', 'W', 'WERWE', 'Married', '2018-03-21', 'WER', 'EWR', 'member', '12345678901', '', '345345435@DFG', 'WWWERWE', 'aced73f71d48f3cb487e70c7730b4288', 'default.jpg', 'inactive', 'i DONT LIKE THIS GUY', '2018-03-09', '2018-03-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_sales`
--
ALTER TABLE `cash_sales`
  ADD PRIMARY KEY (`ORNum`);

--
-- Indexes for table `cash_transaction`
--
ALTER TABLE `cash_transaction`
  ADD PRIMARY KEY (`transactionNum`);

--
-- Indexes for table `charge_invoice`
--
ALTER TABLE `charge_invoice`
  ADD PRIMARY KEY (`chargeInvoiceNum`);

--
-- Indexes for table `goods_receipt`
--
ALTER TABLE `goods_receipt`
  ADD PRIMARY KEY (`GRNum`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`productNum`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`purchaseNum`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`orderNum`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`PONum`);

--
-- Indexes for table `restocked_items`
--
ALTER TABLE `restocked_items`
  ADD PRIMARY KEY (`restockNum`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`cTransactionNum`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_transaction`
--
ALTER TABLE `cash_transaction`
  MODIFY `transactionNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charge_invoice`
--
ALTER TABLE `charge_invoice`
  MODIFY `chargeInvoiceNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods_receipt`
--
ALTER TABLE `goods_receipt`
  MODIFY `GRNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `productNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `purchaseNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `orderNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `PONum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `restocked_items`
--
ALTER TABLE `restocked_items`
  MODIFY `restockNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `cTransactionNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
