--
-- Database: `contact_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favorite` tinyint(1) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dummy data for table `contacts`
--
INSERT INTO `contacts` (`id`,`fullname`, `email`, `favorite`, `image`) VALUES
(1,'Jane Cooper', 'jane.cooper@example.com', 0, 'noimage.jpg'),
(2,'Cody fisher', 'cody.fisher@example.com', 0, 'avatar.jpg'),
(3,'Esther Howard', 'esther.hovard@example.com', 1, 'noimage.jpg'),
(4,'Jenny Wilson', 'jenny.wilson@example.com', 1, 'noimage.jpg'),
(5,'Kristin Watson', 'kristin.watson@example.com', 1, 'noimage.jpg');
--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;


--
-- Table structure for table `phone_number`
--

CREATE TABLE `phone_number` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dummy data for table `phone_number`
--
INSERT INTO `phone_number` (`id`, `contact_id`, `phone`, `label`) VALUES
(1, 1, '123456789', 'work'),
(2, 1, '455624578', 'home'),
(3, 2, '321112255', 'work'),
(4, 4, '222223354', 'business'),
(5, 5, '321332165', 'home');
--
-- Indexes for table `phone_number`
--
ALTER TABLE `phone_number`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6B01BC5BE7A1254A` (`contact_id`);

--
-- AUTO_INCREMENT for table `phone_number`
--
ALTER TABLE `phone_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;