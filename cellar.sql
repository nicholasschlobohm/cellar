-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2020 at 05:48 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cellar`
--

-- --------------------------------------------------------

--
-- Table structure for table `bottle`
--

CREATE TABLE `bottle` (
  `id` varchar(36) NOT NULL,
  `wine` varchar(36) NOT NULL,
  `rack` varchar(36) NOT NULL,
  `position` text NOT NULL,
  `purchased` date NOT NULL,
  `til` int(11) NOT NULL,
  `price` float NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bottle`
--

INSERT INTO `bottle` (`id`, `wine`, `rack`, `position`, `purchased`, `til`, `price`, `notes`) VALUES
('c44adf43-b7b3-4d94-a619-295cc5e8c547', '0ee80dd7-1a31-4c88-8278-a1835ae88d46', 'b54b2044-f94e-48fe-b0e9-27b4e29377f6', '0,0', '2020-03-06', 20300101, 30, '');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` varchar(36) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `address`) VALUES
('2cbef628-ff23-4a58-b234-06225c7ca963', '2017 Eukey Road, Ballandean QLD 4382'),
('d34a70cd-a6ec-4417-925a-9d3105cc57a4', '123 Fake Street, Sydney NSW 2000');

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE `rack` (
  `id` varchar(36) NOT NULL,
  `name` varchar(120) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `size` text NOT NULL,
  `description` text NOT NULL,
  `location` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`id`, `name`, `width`, `height`, `size`, `description`, `location`) VALUES
('44bb18c2-9cfd-43b1-9645-7800b40795c1', 'Bellini Wine Fridge', 2, 6, '', 'acquired 7 March 2020', '44bb18c2-9cfd-43b1-9645-7800b40795c1'),
('b54b2044-f94e-48fe-b0e9-27b4e29377f6', 'Test Rack', 2, 6, '', 'acquired late 2019', 'd34a70cd-a6ec-4417-925a-9d3105cc57a4');

-- --------------------------------------------------------

--
-- Table structure for table `wine`
--

CREATE TABLE `wine` (
  `id` varchar(36) NOT NULL,
  `winery` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wine`
--

INSERT INTO `wine` (`id`, `winery`, `name`, `year`, `type`, `category`, `description`) VALUES
('e1fe5441-b674-43c0-8c53-c1125083fe85', 'ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Symphony of White', 2018, 'wine', 'wine_white', 'A delightfully fragrant and delicious blend of Sauvignon Blanc, Pinot Gris, Viognier and Gewürztraminer from our 2018 vintage. Each of the four varieties play a symphony to your senses as you enjoy this wine. The Gewürztraminer provides heady rose water aromas which combine with the apricot from the Viognier, passionfruit from the Savvy B and pear from the Pinot G. Onn the palate your taste buds delight in gooseberry, lime, musk and stone fruit flavours with a rich middle palate. The long, crisp, mouth-watering finish will demand that you have prawns and Moreton Bay bugs ready to go.'),
('a4be589d-d41a-42fc-996e-62cf252b6784', 'ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Reserve Sauvignon Blanc', 2019, 'wine', 'wine_savblanc', 'Scented whiffs of passionfruit flowers combine with hints of lemongrass and pineapple. Deliciously rich mouth filling citrus flavours delicately balance out the seamless acid profile intelligently supported by a zippy textural finish.'),
('5b962cec-5b95-4bda-b6d0-409df8808035', 'ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Prosecco Brut', 2019, 'wine', 'wine_prosecco', 'Treat yourself to some well-earned Fizziotherapy! Audacious aromas of lemonade and kaffir lime peer through sophisticated notes of yellow flesh peach and apricot. Delicate citrus notes highlight the delicious lip-smacking profile of apple and pear with a lovely balance of acidity to enhance the fresh zippy finish.'),
('270774d2-e6f7-4f7d-ac64-cb5d02feeeb5', 'ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Reserve Nebbiolo', 2016, 'wine', 'wine_nebbiolo', 'The king of Italian wines since 1200AD, often compared to Pinor Noir for its finicky nature in the vineyard and haunting fragrance in the glass. Al Pacino\'s Scent of a Woman can be found seductively arising from the glass with evocative aromas of perfume, rose petal and wild cranberry easing through a backdrop of earth and black truffles. The tightly knitted flavour profile will tempt even the most dedicated Pinotphile into batting for the other side.'),
('9227f538-4779-4a40-bbe5-aa771d4ccf71', 'ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Reserve Tannat', 2016, 'wine', 'wine_tannat', 'Arousing aromas of dark mulberry and chocolate ease through a plethora of fruits of the forest. Concentrated flavours of spicy plum and liquorice peer through a gorgeously rich mid palate of silky tannins and ripe fruit.'),
('be48a7cc-8078-411e-95d5-5db5da044ff2', 'ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Reserve Montepulciano', 2017, 'wine', 'wine_montepulciano', 'The colour is dark and brooding like Michael Corleone with the ample body of Don Vito, and the silky mouth feel of Connie Corleone. Breathe in oregano, tobacco, red plum, sour cherry and chocolate. Taste sour cherry and dark chocolate with dried flowers strewn by vestal virgins. One glass of this wine and you will be crooning like Johnny Fontane and if someone empties the bottle before you can refill your glass you will feel like going to the matresses.'),
('0ee80dd7-1a31-4c88-8278-a1835ae88d46', 'ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Petit Manseng', 2019, 'wine', 'wine_white', 'This variety originates from the foothills of the Pyrenees in France\'s Basque country. It is one of France\'s best-kept wine secrets until now! Breathe in grapefruit, pineapple, white peach and honey suckle flowers before delighting your tongue with spices and stonefruit perfectly in symphony with racy acidity.');

-- --------------------------------------------------------

--
-- Table structure for table `winery`
--

CREATE TABLE `winery` (
  `id` varchar(36) NOT NULL,
  `name` varchar(60) NOT NULL,
  `logo` text NOT NULL,
  `contact` text NOT NULL,
  `description` text NOT NULL,
  `location` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `winery`
--

INSERT INTO `winery` (`id`, `name`, `logo`, `contact`, `description`, `location`) VALUES
('ed036ab2-d53c-4271-b063-5fdeeec4b56b', 'Symphony Hill', 'https://cdn.hardiegrant.com/-/media/winecompanion/wineries/s/sy/symphony%20hill%20wines/logos/logo-large-font.ashx?h=312&la=en&w=312', 'Ewen & Elissa Macpherson\r\ninfo@symphonyhill.com.au', 'Symphony Hill Wines embodies the cutting edge, neo-vino wine movement that dares to take Australian wines in fresh and exciting directions. Owner, Ewen Macpherson, defied old school wine snobs and dared to believe he could make world class wines in a wine region of unfulfilled potential – the Granite Belt, QLD.', '2cbef628-ff23-4a58-b234-06225c7ca963');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
