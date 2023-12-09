-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 06:21 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akses`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeId` int(255) NOT NULL,
  `employeeName` varchar(50) NOT NULL,
  `employeeEmail` varchar(50) NOT NULL,
  `employeePhone` varchar(50) NOT NULL,
  `employeeAddress` text NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `employeePassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeId`, `employeeName`, `employeeEmail`, `employeePhone`, `employeeAddress`, `isAdmin`, `employeePassword`) VALUES
(7, 'Yohanes Rico Wijaya', 'rcwjys@gmail.com', '6282158204550', 'aada', 1, '$2y$10$D0.13DaeJvtBiicY/PiMSub4qA2PRHdJfdZPJcrX5wTgWxPADbo8O'),
(8, 'admin', 'admin@mail.com', '123233232332', '233dadwada', 0, '$2y$10$QynCeTE7Z2/eFkidTQiurOzgUsZDffo1R4RZK1YTvC6AJv6/PU8jC');

-- --------------------------------------------------------

--
-- Table structure for table `formulariums`
--

CREATE TABLE `formulariums` (
  `formulariumId` int(255) NOT NULL,
  `formulariumName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicinerecipes`
--

CREATE TABLE `medicinerecipes` (
  `recipeId` int(255) NOT NULL,
  `recipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicinerecipes`
--

INSERT INTO `medicinerecipes` (`recipeId`, `recipe`) VALUES
(1, '30 kaps/bulan');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicineId` int(255) NOT NULL,
  `medicineName` varchar(50) NOT NULL,
  `medicineStock` int(11) NOT NULL,
  `medicineInformation` text NOT NULL,
  `expiredDate` date NOT NULL,
  `medicinePeriod` varchar(50) NOT NULL,
  `recipeId` int(255) NOT NULL,
  `medicineUnitId` int(255) NOT NULL,
  `therapyClassId` int(255) NOT NULL,
  `subTherapyClassId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicineId`, `medicineName`, `medicineStock`, `medicineInformation`, `expiredDate`, `medicinePeriod`, `recipeId`, `medicineUnitId`, `therapyClassId`, `subTherapyClassId`) VALUES
(2, ' Simvastatin 10 mg', 100, 'Analgetik, Antipiretik, Anti-inflamasi, AINS', '2023-12-01', 'lebih dari 6 bulan', 1, 1, 2, 2),
(3, ' Simvastatin 20 mg', 5, 'Analgetik, Antipiretik, Anti-inflamasi, AINS', '2023-12-09', 'lebih dari 6 bulan', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicineunits`
--

CREATE TABLE `medicineunits` (
  `medicineUnitId` int(255) NOT NULL,
  `medicineUnit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicineunits`
--

INSERT INTO `medicineunits` (`medicineUnitId`, `medicineUnit`) VALUES
(1, 'Tablet'),
(2, 'Botol'),
(3, 'Pot'),
(4, 'Tube'),
(5, 'Ampul'),
(6, 'Botol 10 ml'),
(7, 'Supp'),
(8, 'Kapsul'),
(9, 'Buah'),
(10, 'Pasang');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageId` int(255) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `customerEmail` varchar(50) NOT NULL,
  `customerPhoneNumber` varchar(50) NOT NULL,
  `customerMessage` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `customerName`, `customerEmail`, `customerPhoneNumber`, `customerMessage`, `created_at`) VALUES
(1, 'Yohanes Rico Wijaya', 'rcwjys@gmail.com', '0821580204550', 'Testing message', '2023-11-20 00:02:58'),
(2, 'Alif', 'Alif@mail.com', '983128989232', 'admwmdwianwinnaindwaindnaindnsanndinwanndinasiniwnidianisndianidniandnisaninwdinanidnanidnaindid jwamdomadmamdoammdoamdmadmmsawodmosamomwomdosamomwodmosamomdomwoamdomsamwomdosmaomowmdomasomomwdomawomsoamdmaowmdmaomdomsaomwmdoam', '2023-11-20 00:02:58'),
(3, 'Bintang', 'bintang@mail.com', '82158204466', 'Halo!', '2023-11-20 00:02:58'),
(4, 'awdawdwa', 'wdawdadwad@mail.com', '123312321321223', 'awdadadadwijnadiwonwdindianinwidnidaw', '2023-11-20 00:02:58'),
(5, 'awdawdwadawdaw', 'dada@mail.com', '93283328483', 'awdijnanidaiwinwiandianinizsda', '2023-11-20 00:02:58'),
(6, 'awdwadad', 'ad@mail.com', '2387872382387', 'dawiunhadwiundbawninadwiiawnidan', '2023-11-20 00:02:58'),
(7, 'wadawdawdaw', 'dawda@mail.com', '3238292398893', 'djwaojodjowajodjoajojsodadw', '2023-11-20 00:02:58'),
(8, 'dwawdawdad', 'amowa@mail.com', '12219912323', 'odamwmodwmaomdoamodmaomdowamomdwomdwoamodmaomdwomodwa', '2023-11-20 00:02:58'),
(9, 'adwkmodwaodowm', 'ajdw@mail.com', '93293289389', 'dawinwiainadinasinidnianwdawdad', '2023-11-20 00:02:58'),
(10, 'adwkmodwaodowm', 'ajdw@mail.com', '93293289389', 'dawinwiainadinasinidnianwdawdad', '2023-11-20 00:02:58'),
(15, 'dwawodiaowdma', 'tre@mail.com', '237723328372', 'diaiwndinaindinsiawds', '2023-11-20 00:02:58'),
(16, 'awddwadwa', 'dawdw@mai.com', '0821580204550', 'mmidaidiojawj9iodwa', '2023-11-20 00:02:58'),
(17, 'awddwadwa', 'dawdw@mai.com', '2332233223', '233dadwadasdawda', '2023-11-20 00:02:58'),
(18, 'dawdadwadw', 'adw@mail.com', '2378y32877838723', 'dawndwianndwaiadwwad', '2023-11-20 00:02:58'),
(19, 'dawiwdaniwdnaniaw', 'awidndwai@mail.com', '9323232329238939', 'adiiwndndawnindianndsind', '2023-11-20 00:02:58'),
(20, 'wdawdwdwadwa', 'dadwawd@mail.com', '9433499349', 'dawdadaczx jiadawdada', '2023-11-20 00:02:58'),
(21, 'dadaadwwdda', 'diawndiwa@mail.com', 'mdiaodw', 'ndianiwdaw', '2023-11-20 00:02:58'),
(22, 'infensefifsei', 'ijndiwa@mail.com', '2329323', 'ndianiwniduwanidwaniknidwa', '2023-11-20 00:02:58'),
(23, 'dujadbbwabbi', 'ndwinawa@mail.com', 'ndawiiwdnn', '23uiaidinawnidaadwd', '2023-11-20 00:02:58'),
(24, 'dawdwawda', 'dwaijnw@mail.com', 'indawnwian', '2932diabniwiwiad', '2023-11-20 00:02:58'),
(25, 'Islahihya', 'Islahihya@mail.com', '329030203023', 'dawdawdsawdsawdsawd', '2023-11-20 00:02:58'),
(26, 'adwwaddw', 'wa@mail.com', '238893923', 'dnwaidniwadwadw', '2023-11-20 00:02:58'),
(28, 'Joko', 'Joko@mail.com', '23992332934398', 'dawdsawdsawdsawdsawd', '2023-11-20 00:02:58'),
(29, 'adwiadniannwda', 'daiidnwni@mail.com', '23099320032', 'mdoamwmdomsawdsawd', '2023-11-20 00:02:58'),
(30, 'awdinjawdwian', 'diawnwia@mail.com', 'adwoodamo', 'imdiamwmdmaodwa', '2023-11-20 00:02:58'),
(31, 'awdada', 'wddawdwm@mail.com', '13211331131313130', 'dawda2dawdawd', '2023-11-20 00:02:58'),
(32, 'Adit', 'adit@mail.com', 'nanwidi', 'adnwinidawindnnaidwwd', '2023-11-20 00:02:58'),
(33, 'Yohanes Rico Wijaya', 'rcwjys@gmail.com', '1235678652', 'awdjnaiwdnianwndnisnaiwndninsan', '2023-11-20 00:04:03'),
(34, 'Yohanes Rico Wijaya', 'rcwjys@gmail.com', 'dawdadsawd', 'andwiainwdinadinisnaniwndnnsnindinnqiawdij9wqnidas', '2023-11-20 00:08:48'),
(35, 'Yohanes Rico WIjaya', 'rcwjys@gmail.com', '6282158204550', 'iadwinnnsinaiwndisawdads', '2023-11-20 00:33:49'),
(36, 'Yohanes Rico WIjaya', 'rcwjys@gmail.com', '6282158204550', 'aiwdanwdnisnianwnidnisnianiwndsawdw', '2023-11-20 00:34:07'),
(37, 'Rafi', 'rafi@gmail.com', '081234567890', 'tes pesan', '2023-11-22 04:59:35'),
(38, 'Test ', 'Tes@mail.com', '8215820455660', 'dwannwaiiwdaindiwnidawninidwinaindwnibcduybyububiidiwbqubudqbdbbquwdbbqwubduqubduqbsaj d jw jajdsnainiwndidnwiaidnfbubesfbabdbuwabudbuabs ad wuadad', '2023-12-08 02:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `programreports`
--

CREATE TABLE `programreports` (
  `programReportId` int(255) NOT NULL,
  `programName` varchar(50) NOT NULL,
  `medicineId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subtherapyclasses`
--

CREATE TABLE `subtherapyclasses` (
  `subTherapyClassId` int(255) NOT NULL,
  `subTherapyClassName` varchar(50) NOT NULL,
  `therapyClassId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subtherapyclasses`
--

INSERT INTO `subtherapyclasses` (`subTherapyClassId`, `subTherapyClassName`, `therapyClassId`) VALUES
(1, 'Analgetik Non Narkotik', 1),
(2, 'Anti Alergi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `therapyclasses`
--

CREATE TABLE `therapyclasses` (
  `therapyClassId` int(255) NOT NULL,
  `therapyClassName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `therapyclasses`
--

INSERT INTO `therapyclasses` (`therapyClassId`, `therapyClassName`) VALUES
(1, 'Analgetik, Anti Piretik, Anti Inflamasi Non Steroi'),
(2, 'Anti Alergi & Kortikosteroid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeId`);

--
-- Indexes for table `formulariums`
--
ALTER TABLE `formulariums`
  ADD PRIMARY KEY (`formulariumId`);

--
-- Indexes for table `medicinerecipes`
--
ALTER TABLE `medicinerecipes`
  ADD PRIMARY KEY (`recipeId`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicineId`),
  ADD KEY `FK_recipeId` (`recipeId`),
  ADD KEY `FK_therapyClassId` (`therapyClassId`),
  ADD KEY `FK_medicineUnitsToMedicines` (`medicineUnitId`),
  ADD KEY `FK_subTherapyClasssToMedicines` (`subTherapyClassId`);

--
-- Indexes for table `medicineunits`
--
ALTER TABLE `medicineunits`
  ADD PRIMARY KEY (`medicineUnitId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `subtherapyclasses`
--
ALTER TABLE `subtherapyclasses`
  ADD PRIMARY KEY (`subTherapyClassId`),
  ADD KEY `FK_theraphyClassesTosubTherapyClasses` (`therapyClassId`);

--
-- Indexes for table `therapyclasses`
--
ALTER TABLE `therapyclasses`
  ADD PRIMARY KEY (`therapyClassId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `formulariums`
--
ALTER TABLE `formulariums`
  MODIFY `formulariumId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicinerecipes`
--
ALTER TABLE `medicinerecipes`
  MODIFY `recipeId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicineId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicineunits`
--
ALTER TABLE `medicineunits`
  MODIFY `medicineUnitId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `subtherapyclasses`
--
ALTER TABLE `subtherapyclasses`
  MODIFY `subTherapyClassId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `FK_medicineUnitsToMedicines` FOREIGN KEY (`medicineUnitId`) REFERENCES `medicineunits` (`medicineUnitId`),
  ADD CONSTRAINT `FK_recipeId` FOREIGN KEY (`recipeId`) REFERENCES `medicinerecipes` (`recipeId`),
  ADD CONSTRAINT `FK_subTherapyClasssToMedicines` FOREIGN KEY (`subTherapyClassId`) REFERENCES `subtherapyclasses` (`subTherapyClassId`),
  ADD CONSTRAINT `FK_therapyClassId` FOREIGN KEY (`therapyClassId`) REFERENCES `therapyclasses` (`therapyClassId`);

--
-- Constraints for table `subtherapyclasses`
--
ALTER TABLE `subtherapyclasses`
  ADD CONSTRAINT `FK_theraphyClassesTosubTherapyClasses` FOREIGN KEY (`therapyClassId`) REFERENCES `therapyclasses` (`therapyClassId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
