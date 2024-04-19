
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressid` int(10) NOT NULL,
  `custid` int(10) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(25) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `contactno` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressid`, `custid`, `city_id`, `address`, `state`, `pincode`, `contactno`) VALUES
(3, 13, 8, '3rd floor, city light building, Opp. Khazana jewellers', 'Karnataka', '575003', 2147483647),
(4, 13, 2, 'Tenkila road', 'karnataka', '589674', 2147483647),
(5, 15, 6, '3rfd floor,\r\ncity ligh', 'Karnataka', '476512', 2147483647),
(6, 2, 2, '3rd floor', 'karna', '121223', 2147483647),
(7, 2, 7, 'Jamshed pur', 'Karnataka', '589674', 2147483647),
(8, 9, 2, 'Julion Gate', 'Karnataka', '575002', 2147483647),
(9, 18, 2, 'Gomti Nagar', 'Delhi', '225006', 2147483647),
(10, 19, 2, 'GOMYTI', 'UT', '23401', 2147483647),
(11, 20, 6, 'Gomti Nagar', 'UP', '211006', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bilid` int(10) NOT NULL,
  `custid` int(10) NOT NULL,
  `addressid` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `bill_no` bigint(20) NOT NULL,
  `entry_type` text NOT NULL,
  `purchdate` date NOT NULL,
  `delivdate` date NOT NULL,
  `total_amt` double(10,2) NOT NULL,
  `cardtype` varchar(20) NOT NULL,
  `cardno` varchar(5) NOT NULL,
  `cvvno` varchar(10) NOT NULL,
  `expirydate` date NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bilid`, `custid`, `addressid`, `city_id`, `staffid`, `bill_no`, `entry_type`, `purchdate`, `delivdate`, `total_amt`, `cardtype`, `cardno`, `cvvno`, `expirydate`, `comment`, `status`) VALUES
(2, 6, 0, 10, 1, 1001, 'Purchase', '2021-09-23', '0000-00-00', 2750.00, '', '', '', '0000-00-00', 'Thank you', 'Active'),
(3, 9, 0, 11, 1, 2500, 'Purchase', '2021-09-27', '0000-00-00', 16325.00, '', '', '', '0000-00-00', 'Thank you', 'Active'),
(4, 9, 0, 2, 1, 1001, 'Purchase', '0000-00-00', '0000-00-00', 1000.00, '', '', '', '0000-00-00', 'test', 'Active'),
(5, 13, 3, 8, 0, 1001, 'Invoice', '2021-09-27', '0000-00-00', 2850.00, 'Visa', '158', '', '0000-00-00', '', 'Active'),
(6, 13, 0, 8, 0, 1001, 'Invoice', '2021-09-27', '0000-00-00', 2850.00, 'Visa', '12345', '158', '0000-00-00', '', 'Active'),
(7, 13, 3, 8, 0, 1001, 'Invoice', '2021-09-27', '0000-00-00', 2000.00, 'Visa', '12345', '158', '0000-00-00', '', 'Active'),
(9, 15, 5, 6, 0, 1001, 'Invoice', '2021-09-26', '0000-00-00', 4250.00, 'Visa', '12345', '587', '0000-00-00', '', 'Active'),
(10, 2, 7, 7, 0, 2501, 'Invoice', '2021-12-18', '2021-12-18', 100.00, 'Visa', '12345', '589', '0000-00-00', '', 'Active'),
(11, 9, 8, 2, 0, 1001, 'Invoice', '2022-08-12', '0000-00-00', 2200.00, 'Visa', '12345', '158', '0000-00-00', '', 'Active'),
(13, 9, 8, 2, 0, 1001, 'Invoice', '2022-08-12', '0000-00-00', 92.00, 'Master Card', '12345', '158', '0000-00-00', '', 'Active'),
(14, 9, 8, 2, 0, 2502, 'Invoice', '2022-08-12', '0000-00-00', 47.00, 'Visa', '12345', '101', '0000-00-00', '', 'Active'),
(15, 18, 9, 2, 0, 2503, 'Invoice', '2023-05-22', '0000-00-00', 167.00, 'Visa', '23456', '999', '0000-00-00', '', 'Active'),
(16, 20, 11, 6, 0, 2504, 'Invoice', '2023-06-01', '0000-00-00', 42.00, 'Visa', '12345', '345', '0000-00-00', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `sub_catid` int(11) NOT NULL,
  `catgory_title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `sub_catid`, `catgory_title`, `description`, `status`) VALUES
(3, 0, 'Household', 'Household Items', 'Active'),
(5, 0, 'Groceries', 'Groceries', 'Active'),
(10, 0, 'Personal care', 'parsonal care code', 'Active'),
(11, 0, 'Packaged foods', 'packaged foods', 'Active'),
(12, 0, 'Beverages', 'beverages test', 'Active'),
(14, 3, 'Dals & Pulses', 'Dals & Pulses', 'Active'),
(15, 10, 'Baby Soap', 'Baby Soap', 'Active'),
(16, 11, 'Baby Food', 'Baby Food', 'Active'),
(17, 12, 'Instant Coffee', 'Instant Coffee', 'Active'),
(20, 5, 'Dry Fruit', 'Dry Fruit', 'Active'),
(21, 5, 'Rice & Rice Products', 'Rice & Rice Products', 'Active'),
(24, 3, 'Ditergent', 'Ditergent', 'Active'),
(25, 3, 'Ditergent', 'Ditergent\r\n', ''),
(27, 3, 'Shampoo', 'Shampoo\r\n\r\n', 'Active'),
(28, 3, 'Kitchenware', 'Kitchenware', 'Active'),
(29, 10, 'Baby Care Accessories', 'Baby Care Accessories', 'Active'),
(30, 10, 'Baby oil & shampoos', 'Baby Oil & Shampoos', 'Active'),
(31, 10, 'Baby Creams & Lotion', 'Baby Creams & Lotion', 'Active'),
(32, 10, 'Baby Powder', 'Baby Powder', 'Active'),
(33, 10, 'Diapers & Wipes', 'Diapers & Wipes', 'Active'),
(34, 11, 'Desert Items', 'Desert Items', 'Active'),
(35, 11, 'Biscuits', 'Biscuits', 'Active'),
(36, 11, 'Breakfast Cereals', 'Breakfast Cereals', 'Active'),
(37, 11, 'Chocolates & Sweets', 'Chocolates & Sweets', 'Active'),
(38, 12, 'Green Tea ', 'Green Tea', 'Active'),
(39, 12, 'Ground Coffee', 'Ground Coffee', 'Active'),
(40, 12, 'Herbal Tea', 'Herbal Tea', 'Active'),
(41, 12, 'Tea', 'Tea', 'Active'),
(42, 12, 'Tea Bags', 'Tea bags', 'Active'),
(43, 5, 'Fruits', 'Fruits', 'Active'),
(44, 5, 'Vegetables', 'Vegetables', 'Active'),
(45, 11, 'Rusk', '', 'Active'),
(46, 11, 'Millet Powder', '', 'Active'),
(47, 5, 'Staples', '', 'Active'),
(48, 12, 'Cool Drinks', '', 'Active'),
(49, 11, 'Chocolates', '', 'Active'),
(50, 0, 'Vegetables', 'All types of vegetables', 'Active'),
(51, 50, 'Herbs', 'Herbs', 'Active'),
(52, 50, 'Seasonal', 'Seasonal', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincodes` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city`, `pincodes`, `description`, `status`) VALUES
(2, 'Delhi', '574219', 'BC Road', 'Active'),
(6, 'Lucknow', '589674', 'Gomtinagar\r\n', 'Active'),
(7, 'Bangalore', '687001,678002,678003', 'capital of the Indian state of Karnataka\r\n ', 'Active'),
(10, 'Mysore', '589674,569875', ' Mysore', 'Active'),
(11, 'Bihar', '671121,671122,671123,671124,671125', ' Bihar', 'Active'),
(13, 'Gorakhpur', '35', ' Gorakhnath Temple , Vishnu Temple, Geeta Vatika, Arogya Mandir, Gita Press and Gita Vatika are the famous places any tourist would like to visit. Other places like Imambara, Ramgarh Taal, Archeological Museum, Planetarium, Rail Museum are also the centre of attraction for tourist and local people.\r\n\r\n', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custid` int(11) NOT NULL,
  `cust_type` varchar(25) NOT NULL,
  `custname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob_no` varchar(15) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `cust_type`, `custname`, `email`, `mob_no`, `cpassword`, `status`) VALUES
(1, 'Customer', 'Peter king', 'peterking@gmail.com', '7894756103', '14b953e91473cdd55b5783f19ccc3caf', 'Active'),
(2, 'Customer', 'lakshitha', 'neetha@gmail.com', '7894561223', 'c8b68fbdafb81cd0c01f41b728740fd6', 'Active'),
(3, 'Customer', 'Vinod kumar', 'vinodkumar@gmail.com', '7945612456', '25f9e794323b453885f5181f1b624d0b', 'Active'),
(4, 'Customer', 'Vilas kumar', 'vilaskumar@gmail.com', '7894561230', '0af90a1bb167f347da94fc8625a36e33', 'Active'),
(5, 'customer', 'Atlas', 'atlas@gmail.com', '7888561230', 'd41d8cd98f00b204e9800998ecf8427e', 'Active'),
(6, 'Customer', 'Payal Singh', 'phinix@gmail.com', '7894560123', 'd41d8cd98f00b204e9800998ecf8427e', 'Active'),
(7, 'Customer', 'Arjun Verma', 'arjun76@gmail.com', '7894561230', 'c62d929e7b7e7b6165923a5dfc60cb56', 'Active'),
(8, 'Customer', 'Preetham', 'preetham@gmail.com', '7894561230', 'e807f1fcf82d132f9bb018ca6738a19f', 'Active'),
(9, 'Customer', 'Zainab sidduqi', 'Fresho@gmail.com', '789456120', '', 'Active'),
(10, 'Customer', 'Amrita Srivastava', '90amrita@gmai.com', '7752984782', '82aeb813a490539b8923a1fd4a9614af', 'Active'),
(11, 'Customer', 'KIRTI', 'SAHU@gmail.com', '6567890987', '9e4cb6cc3efcd84eca79374fde6a6682', 'Active'),
(12, 'Customer', 'SHRUTI ', 'shruti@GMAIL.COM', '7654678987', 'e10adc3949ba59abbe56e057f20f883e', 'Active'),
(20, 'Customer', 'Amrita Srivastava', '12as@gmail.com', '7654324567', '508df4cb2f4d8f80519256258cfb975f', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodid` int(10) NOT NULL,
  `catid` int(10) NOT NULL,
  `prodname` varchar(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `stockstatus` varchar(20) NOT NULL,
  `prodspecif` text NOT NULL,
  `images` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodid`, `catid`, `prodname`, `price`, `discount`, `unit`, `stockstatus`, `prodspecif`, `images`, `status`) VALUES
(20, 21, 'Bvk brown rice 5 kg', 400.00, 10.00, 'KG', 'Avaiable', 'Bvk brown rice 5 kg\r\nBrown\r\n5kg bags', 'a:1:{i:0;s:23:\"1630924176shopping.webp\";}', 'Active'),
(21, 44, 'Fresho Carrot - Orange, 5', 38.00, 10.00, '1/2 Gm', 'Avaiable', 'Fresho Carrot - Orange\r\nAbout the Product\r\nA popular sweet-tasting root vegetable, Carrots are narrow and cone shaped.\r\nThey have thick, fleshy, deeply colored root, which grows underground, and feathery green leaves that emerge above the ground.\r\nWhile these greens are fresh tasting and slightly bitter, the carrot roots are crunchy textured with a sweet and minty aromatic taste.\r\nFresho brings you the flavour and richness of the finest crispy and juicy carrots that are locally grown and the best of the region.\r\nDo not forget to check our delicious recipe - https://www.bigbasket.com/cookbook/recipes/912/carrot-halwa/\r\nBenefits\r\nCarrots provide the highest content of vitamin A of all the vegetables.\r\nBrightly orange colored carrots have pigments like carotenoids and flavonoids, that provide several antioxidants and act as a defense against cancer.\r\nThey aid in maintaining oral health and also decrease the risk of stroke and other heart diseases.', 'a:1:{i:0;s:18:\"1630925096cara.jpg\";}', 'Active'),
(22, 43, 'Apple Royal Gala Approximately 1KG', 140.00, 5.00, '4 pcs', 'Avaiable', 'Apple is one of the most popular fruits worldwide. It is rich in Fiber, Potassium, Vitamin C, Vitamin K, Carbs and Calories. It also consists of soluble fibers that helps in weight loss and maintaining gut health. Eating apples lower the risks of major diseases like Cancer, Diabetes etc. You can include Apples as a part of your diet in the form of Salads, Smoothies, Pies and several other desserts. Buy Apple Royal Gala (4 pcs) (Approx 500 g - 700 g) online now.', 'a:1:{i:0;s:51:\"1631005692apple-royal-gala-4-pcs-0-20201118 (1).jpg\";}', 'Active'),
(23, 43, 'Kashmiri Apple\r\n', 140.00, 0.00, '4 pcs', 'Avaiable', 'Apple is one of the most popular fruits worldwide. It is rich in Fiber, Potassium, Vitamin C, Vitamin K, Carbs and Calories. It also consists of soluble fibers that helps in weight loss and maintaining gut health. Eating apples lower the risks of major diseases like Cancer, Diabetes etc. You can include Apples as a part of your diet in the form of Salads, Smoothies, Pies and several other desserts. Buy Apple Royal Gala (4 pcs) (Approx 500 g - 700 g) online now.', 'a:1:{i:0;s:51:\"1631005692apple-royal-gala-4-pcs-0-20201118 (1).jpg\";}', 'Active'),
(24, 44, 'Kashmiri Carrot', 50.00, 0.00, '1/2 Gm', 'Avaiable', 'Fresho Carrot - Orange\r\nAbout the Product\r\nA popular sweet-tasting root vegetable, Carrots are narrow and cone shaped.\r\nThey have thick, fleshy, deeply colored root, which grows underground, and feathery green leaves that emerge above the ground.\r\nWhile these greens are fresh tasting and slightly bitter, the carrot roots are crunchy textured with a sweet and minty aromatic taste.\r\nFresho brings you the flavour and richness of the finest crispy and juicy carrots that are locally grown and the best of the region.\r\nDo not forget to check our delicious recipe - https://www.bigbasket.com/cookbook/recipes/912/carrot-halwa/\r\nBenefits\r\nCarrots provide the highest content of vitamin A of all the vegetables.\r\nBrightly orange colored carrots have pigments like carotenoids and flavonoids, that provide several antioxidants and act as a defense against cancer.\r\nThey aid in maintaining oral health and also decrease the risk of stroke and other heart diseases.', 'a:1:{i:0;s:18:\"1630925096cara.jpg\";}', 'Active'),
(25, 21, 'Bvk brown rice 10 kg', 800.00, 0.00, 'KG', 'Avaiable', 'Bvk brown rice 5 kg\r\nBrown\r\n5kg bags', 'a:1:{i:0;s:23:\"1630924176shopping.webp\";}', 'Active'),
(26, 21, 'Bvk Brown Rice 25 KG', 2000.00, 0.00, '25 KG', 'Out Of Stock', 'Bvk brown rice 5 kg\r\nBrown\r\n5kg bags', 'a:1:{i:0;s:23:\"1630924176shopping.webp\";}', 'Active'),
(27, 45, 'Britania Rusk', 32.00, 5.00, '1pc', 'Avaiable', 'Premium Bake Rusk with goodness of wheat is been a traditional tea companion and is loved by many. Britannia Toast Tea Premium Bake Rusk is as crispy as your traditional one, but with a hint of elaichi and right amount of sweetness, it\'s taste will leave you amazed. Britannia Toast Tea Premium Bake Rusk for long has been a part of every home, sharing those moments of joy.', 'a:1:{i:0;s:69:\"1631009987premium-sooji-rusk-britannia-original-imag5j4ur2fbjfpf.jpeg\";}', 'Active'),
(28, 46, 'Origo Fresh Bajra Pearl Millet', 37.00, 0.00, '1 KG', 'Avaiable', 'Brand\r\nOrigo Fresh\r\nModel Name\r\nBajra\r\nType\r\nPearl Millet\r\nQuantity\r\n1 kg\r\nMaximum Shelf Life\r\n4 Months\r\nIs Perishable\r\nNo\r\nOrganic\r\nNo\r\nNutrient Content\r\nNA\r\nEAN\r\n8906059935923', 'a:1:{i:0;s:73:\"16310103091-bajra-pearl-millet-origo-fresh-original-imaf8abbgbdfdumk.jpeg\";}', 'Active'),
(29, 16, 'Chakki Atta', 285.00, 10.00, '10 KG', 'Avaiable', 'Chakki Atta is freshly made from the choicest grains. It is carefully ground using modern chakki technique. The taste and nutrition ensure that this Atta contains 0% Maida and it gives you softer rotis for a long time. Buy Chakki Atta online now!', 'a:1:{i:0;s:15:\"16321286331.jpg\";}', 'Active'),
(30, 48, 'Pepsi', 100.00, 10.00, 'Ltr', 'Avaiable', 'Pepsi is a carbonated soft drink manufactured by PepsiCo. Originally created and developed in 1893 by Caleb Bradham and introduced as Brad\'s Drink, it was renamed as Pepsi-Cola in 1898, and then shortened to Pepsi in 1961.', 'a:1:{i:0;s:44:\"1632676411750ml-pepsi-cold-drink-500x500.jpg\";}', 'Active'),
(31, 49, 'Kitkat', 50.00, 10.00, '1 pc', 'Avaiable', 'Kit Kat is a chocolate-covered wafer bar confection created by Rowntree\'s of York, United Kingdom, and is now produced globally by Nestlé, except in the United States, where it is made under license by the H. B. Reese Candy Company, a division of the Hershey Company.', 'a:1:{i:0;s:31:\"1632677403kitkat-brand-page.png\";}', 'Active'),
(32, 49, 'Mentos', 125.00, 10.00, '1 pc', 'Avaiable', 'Mentos (stylised as mentos) are a brand of packaged scotch mints sold in stores and vending machines. ', 'a:1:{i:0;s:34:\"163267754891Vg3t5kqEL._SL1500_.jpg\";}', 'Active'),
(33, 49, 'Boomer', 5.00, 0.00, '1pc', 'Out Of Stock', 'With Wrigley\'s Boomer Strawberry Flavoured Bubble Gum, treat yourself to the explosively fruity flavor of a fun and delicious bubble gum. This delicious chewing', 'a:1:{i:0;s:21:\"1632677667images.jfif\";}', 'Active'),
(34, 49, 'Cadbury Choclairs Gold 117 Candies', 400.00, 0.00, '725 Gm', 'Avaiable', 'The luscious new candy contains an indulgent brownie flavor in its caramel and rich Cadbury chocolate at its center\r\nA sweet home pack of your favorite chocolatiers\r\nExperience the yummy flavor of chocolate as soon as you bite into the candy', 'a:1:{i:0;s:34:\"163267787271VoCACMrSL._SL1500_.jpg\";}', 'Inactive'),
(37, 20, 'Cashews', 65.00, 75.00, '35', 'Avaiable', 'Cashews are low in sugar and rich in fiber, heart-healthy fats, and plant protein. They\'re also a good source of copper, magnesium, and manganese — nutrients important for energy production, brain health, immunity, and bone health.\r\n', 'a:1:{i:0;s:20:\"1685549385casew.jpeg\";}', 'Active'),
(38, 51, 'Lemon Grass', 12.00, 20.00, '40', 'Avaiable', 'Lemon Grass is a culinary herb that comes with an excellent aroma. It is also used as a medicinal herb in India. It has a subtle citrusy flavour and can be used fresh or even dried and powdered.\r\n', 'a:1:{i:0;s:35:\"1685549597fresho-lemon-grass.w.webp\";}', 'Active'),
(39, 27, 'PANTENE', 720.00, 7.00, '100', 'Avaiable', 'Pantene advanced hair fall solution hair fall control shampoo combines the age-old anti-hair fall secret of fermented rice water with the revolutionary science of pro-v formula. It strengthens your hair from root to tip and reduces hair fall for more open hair days. The new Pantene advanced hair fall solution also provides protection against hair breakage and styling damage. For everyday use, try it with the Pantene advanced hair fall solution conditioner and open hair miracle and experience more open hair days. Against styling damage vs non-conditioning shampoo due to breakage', 'a:1:{i:0;s:74:\"1685545046hair-fall-control-shampoo-pantene-original-imag4ftkdgynm4xu.webp\";}', 'Active'),
(40, 27, 'HEAD & SHOULDERS(1 L)', 524.00, 54.00, '50', 'Avaiable', 'Go from dry and frizzy hair to smooth and silky hair in just one wash. Head & Shoulders Smooth & Silky Anti-Dandruff Shampoo is formulated with added moisturizers to cleanse and restore dry, frizzy hair and leave you with dandruff free hair*. Go ahead, run your hands through your hair again. (*visible flakes only, with regular use) - 24 hour frizz control for smooth, beautiful-looking hair - Gentle pH balanced formula for everyday use, even on color treated hair', 'a:1:{i:0;s:70:\"16855452551-smooth-silky-head-shoulders-original-imagyn9zgknsbgkg.webp\";}', 'Active'),
(41, 27, 'DOVE Hair (340 ml)', 320.00, 7.00, '76', 'Avaiable', 'You know what’s one of the greatest worries women have? It’s hair fall. And seeing hair strands in our comb can be daunting. That’s why Dove brings you this hair fall rescue shampoo. Combat hair fall and add some bounce to your hair by using this shampoo.\r\nHealthy Hair\r\nApart from combating hair fall, this shampoo deeply nourishes damaged hair from root to tip and makes hair visibly fuller.\r\nGentle Formula\r\nThis shampoo is so gentle that you can use it every day.', 'a:1:{i:0;s:19:\"1685545478DOVE.webp\";}', 'Active'),
(42, 27, 'HIMALAYA Anti-Hair fall(340 ml)', 199.00, 28.00, '70', 'Avaiable', 'Reduces Hair Fall Up To 96%*: Himalaya Anti Hair Fall Bhringaraja Shampoo Uses Plant Sciences: A Special Blend Of Botanical Extracts And Natural Protein 5 Technology To Effectively Reduce Hair Fall And Provide Nourishment To Your Hair.Best Of Nature And Science: Himalaya Anti Hair Fall Bhringaraja Shampoo Is Made With Goodness Of Bhringaraja,Palasha And Natural Protein 5 Technology. Bhringaraja Is A Time Tested Ayurvedic Herb Known To Promote Hair Growth; Palasha Helps Reduce Hair Fall. Natural Protein Of Soy And Wheat : Strengthens Hair, Reduces Hair Breakage, Helps Reduce Hair Damage, Smoothens Hair And Nourishes Hair.Safe & Effective: Our Dermatologically Tested Formula Is Fortified With Herbal Ingredients, Himalaya Anti Bhringaraja Shampoo Is Effective And Gentle, Leaving Your Hair Beautiful And Healthy. It Has 0% Harmful Chemicals.For Best Results, Use Himalaya Anti-Hair Fall Conditioner After Shampoo For Smooth And Conditioned Hair.\r\n', 'a:1:{i:0;s:23:\"1685546142himalaya.webp\";}', 'Active'),
(43, 14, 'Mung Dal(1 Kg)', 154.00, 35.00, '50', 'Avaiable', 'Moong dal might help in lowering the level of lipids and cholesterol in the body.4It might also help in the production of enzymes that might regulate the cholesterol levels of the blood. This cholesterol-lowering effect of moong dal might be similar to Vitamin E.', 'a:1:{i:0;s:22:\"1685546653MungDal.webp\";}', 'Active'),
(44, 14, 'Chana Dal(500kg)', 62.00, 30.00, '65', 'Avaiable', 'Moong dal might help in lowering the level of lipids and cholesterol in the body.4It might also help in the production of enzymes that might regulate the cholesterol levels of the blood. This cholesterol-lowering effect of moong dal might be similar to Vitamin E.', 'a:1:{i:0;s:24:\"1685547067chana dal.webp\";}', 'Active'),
(45, 14, 'Masoor Dal(1 KG)', 85.00, 50.00, '60', 'Avaiable', 'Masoor Dal is Hindi for ‘orange lentils’, ‘red lentils’ or ‘pink lentils’. Basically these are the same lentils with different names. But note that these are not the same as Puy lentils, which are a green French lentil.', 'a:1:{i:0;s:25:\"1685547645masoor Dak.webp\";}', 'Active'),
(46, 14, 'Rajam', 186.00, 28.00, '35', 'Avaiable', 'From the deep dark maroon red rajma to the lovely to look at streaked colored bean, the small white colored kidney beans and the unique black rajma. The size of these beans also varies from small to medium to large.\r\n\r\nTo make these recipes you can choose any variety of rajma that is available to you. But make sure to cook them perfectly as the cooking time will vary with the variety and kind of bean you use. And also remember to presoak them before you begin cooking.\r\n\r\n', 'a:1:{i:0;s:20:\"1685549229rajma.webp\";}', 'Active'),
(47, 35, 'Good Day', 166.00, 33.00, '59', 'Avaiable', 'General\r\nBrand\r\nBRITANNIA\r\nModel Name\r\nGood Day Cashew\r\nQuantity\r\n1000 g\r\nType  Cookies\r\nBase Flavors  Cashew\r\nOrganic No\r\nIngredients NA\r\nFood Preference Vegetarian\r\nContainer Type Pouch\r\nMaximum Shelf Life 6 Months\r\nnutrient Content NA\r\nNet Quantity 1000 g\r\n', 'a:1:{i:0;s:23:\"1685550527good day.webp\";}', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchid` int(10) NOT NULL,
  `prodid` int(10) NOT NULL,
  `typeid` int(10) NOT NULL,
  `custid` int(10) NOT NULL,
  `bilid` int(10) NOT NULL,
  `entry_type` varchar(25) NOT NULL,
  `qty` float(10,2) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount_price` float(10,2) NOT NULL,
  `comment` text NOT NULL,
  `purchasestatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchid`, `prodid`, `typeid`, `custid`, `bilid`, `entry_type`, `qty`, `price`, `discount_price`, `comment`, `purchasestatus`) VALUES
(1, 54, 12, 65, 12, '', 12.00, 15.00, 1.00, '', ''),
(2, 20, 7, 1, 2, 'Purchase', 10.00, 50.00, 0.00, '', 'Active'),
(3, 24, 0, 1, 2, 'Purchase', 25.00, 40.00, 0.00, '', 'Active'),
(4, 27, 0, 1, 2, 'Purchase', 50.00, 25.00, 0.00, '', 'Active'),
(5, 30, 20, 1, 3, 'Purchase', 10.00, 30.00, 0.00, '', 'Active'),
(6, 30, 21, 1, 3, 'Purchase', 25.00, 75.00, 0.00, '', 'Active'),
(7, 31, 0, 1, 3, 'Purchase', 100.00, 40.00, 0.00, '', 'Active'),
(8, 32, 0, 1, 3, 'Purchase', 100.00, 100.00, 0.00, '', 'Active'),
(9, 33, 0, 1, 3, 'Purchase', 50.00, 3.00, 0.00, '', 'Active'),
(10, 21, 16, 1, 4, 'Purchase', 10.00, 100.00, 0.00, '', 'Active'),
(24, 30, 20, 13, 6, 'Invoice', 5.00, 45.00, 10.00, '', 'Active'),
(25, 30, 22, 13, 6, 'Invoice', 10.00, 150.00, 25.00, '', 'Active'),
(26, 31, 0, 13, 6, 'Invoice', 20.00, 50.00, 10.00, '', 'Active'),
(27, 32, 0, 13, 6, 'Invoice', 1.00, 125.00, 10.00, '', 'Active'),
(28, 30, 20, 13, 7, 'Invoice', 10.00, 45.00, 10.00, '', 'Active'),
(29, 30, 23, 13, 7, 'Invoice', 1.00, 300.00, 0.00, '', 'Active'),
(30, 32, 0, 13, 7, 'Invoice', 10.00, 125.00, 10.00, '', 'Active'),
(31, 35, 0, 1, 8, 'Purchase', 100.00, 10.00, 0.00, '', 'Active'),
(32, 36, 25, 1, 8, 'Purchase', 10.00, 40.00, 0.00, '', 'Active'),
(33, 33, 0, 1, 8, 'Purchase', 1000.00, 5.00, 0.00, '', 'Active'),
(34, 36, 25, 15, 9, 'Invoice', 10.00, 50.00, 10.00, '', 'Active'),
(35, 35, 0, 15, 9, 'Invoice', 25.00, 150.00, 10.00, '', 'Active'),
(38, 20, 7, 2, 10, 'Invoice', 1.00, 100.00, 10.00, '', 'Active'),
(41, 22, 0, 9, 11, 'Invoice', 5.00, 140.00, 5.00, '', 'Active'),
(42, 31, 0, 9, 11, 'Invoice', 3.00, 50.00, 10.00, '', 'Active'),
(43, 23, 0, 9, 11, 'Invoice', 10.00, 140.00, 0.00, '', 'Active'),
(44, 29, 0, 9, 12, 'Invoice', 1.00, 285.00, 10.00, '', 'Active'),
(45, 20, 7, 9, 12, 'Invoice', 1.00, 100.00, 10.00, '', 'Active'),
(46, 21, 16, 9, 13, 'Invoice', 1.00, 50.00, 5.00, '', 'Active'),
(47, 31, 0, 9, 13, 'Invoice', 1.00, 50.00, 10.00, '', 'Active'),
(48, 21, 16, 9, 14, 'Invoice', 1.00, 50.00, 5.00, '', 'Active'),
(49, 29, 0, 17, 0, 'Invoice', 1.00, 285.00, 10.00, '', 'Pending'),
(51, 31, 0, 17, 0, 'Invoice', 1.00, 50.00, 10.00, '', 'Pending'),
(52, 22, 0, 17, 0, 'Invoice', 1.00, 140.00, 5.00, '', 'Pending'),
(53, 21, 16, 17, 0, 'Invoice', 1.00, 50.00, 5.00, '', 'Pending'),
(54, 20, 7, 18, 15, 'Invoice', 1.00, 100.00, 10.00, '', 'Active'),
(55, 21, 16, 18, 15, 'Invoice', 1.00, 50.00, 5.00, '', 'Active'),
(56, 27, 0, 18, 15, 'Invoice', 1.00, 32.00, 5.00, '', 'Active'),
(57, 22, 0, 19, 0, 'Invoice', 1.00, 140.00, 5.00, '', 'Pending'),
(58, 21, 16, 19, 0, 'Invoice', 1.00, 50.00, 5.00, '', 'Pending'),
(59, 45, 0, 20, 16, 'Invoice', 1.00, 85.00, 50.00, '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(10) NOT NULL,
  `city_id` int(11) NOT NULL,
  `staff_type` varchar(25) NOT NULL,
  `staffname` varchar(25) NOT NULL,
  `loginid` varchar(30) NOT NULL,
  `apassword` varchar(255) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `contactno` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `city_id`, `staff_type`, `staffname`, `loginid`, `apassword`, `emailid`, `contactno`, `status`) VALUES
(1, 2, 'Admin', 'Mr. admin', 'admin', 'd94354ac9cf3024f57409bd74eec6b4c', 'admin@gmail.com', '789456123', 'Active'),
(2, 3, 'Staff', 'Raj kiran', 'rajkiran', '25f9e794323b453885f5181f1b624d0b', 'rajkiran@gmail.com', '7894561230', 'Active'),
(3, 3, 'Admin', 'Rajesh kumar', 'rajeshkumar', 'c62d929e7b7e7b6165923a5dfc60cb56', 'rajeshkumar@gamilo.com', '7894561230', 'Active'),
(4, 6, 'Staff', 'Ptere', 'rajkiran', '25f9e794323b453885f5181f1b624d0b', 'rajkiran@gmail.com', '7894561230', 'Active'),
(5, 6, 'Staff', 'Peter zoor', 'peter', '435427a4d30be41e2dd45614dfbca74e', 'peter@gmail.com', '7894561230', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `typeid` int(10) NOT NULL,
  `prodid` int(10) NOT NULL,
  `color` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `stockstatus` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`typeid`, `prodid`, `color`, `image`, `cost`, `discount`, `unit`, `stockstatus`, `status`) VALUES
(7, 20, 'Red', '1631874648apple-royal-gala-4-pcs-0-20201118 (1).jpg', 100.00, 10.00, 'KG', 'Available', 'Active'),
(16, 21, '', '1631875014', 50.00, 5.00, '1 KG', 'Available', 'Active'),
(17, 21, '', '1631875043', 100.00, 10.00, '2KG', 'Available', 'Active'),
(18, 21, '', '1631875098', 150.00, 25.00, '3 KG', 'Available', 'Active'),
(19, 21, '', '1631875127', 200.00, 50.00, '5 KGs', 'Available', 'Active'),
(20, 30, '', '1632676628750ml-pepsi-cold-drink-500x500.jpg', 45.00, 10.00, '1/2 Ltr', 'Available', 'Active'),
(21, 30, '', '1632676663750ml-pepsi-cold-drink-500x500.jpg', 90.00, 20.00, '1 Ltr', 'Available', 'Active'),
(22, 30, '', '1632680929640x640.jpg', 150.00, 25.00, '2 Ltr', 'Available', 'Active'),
(23, 30, '', '1632676920download (3).jfif', 300.00, 0.00, '5 Ltr', 'Out of Stock', 'Active'),
(24, 30, '', '1632676825download (2).jfif', 5000.00, 0.00, '10 Ltr', 'Available', 'Inactive'),
(25, 36, '', '163264972710000148_30-fresho-onion.jpg', 50.00, 10.00, '1 kg', 'Available', 'Active'),
(26, 36, '', '163264975110000148_30-fresho-onion.jpg', 100.00, 10.00, '2 kg', 'Available', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressid`),
  ADD KEY `custid` (`custid`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bilid`),
  ADD KEY `custid` (`custid`),
  ADD KEY `addressid` (`addressid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodid`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchid`),
  ADD KEY `prodid` (`prodid`,`typeid`,`custid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`typeid`),
  ADD KEY `prodid` (`prodid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bilid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `typeid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
