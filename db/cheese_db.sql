-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2019 at 05:38 PM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npeters5_dmit2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `cheese_db`
--

CREATE TABLE `cheese_db` (
  `cheese` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `classification` varchar(255) NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `viewed` int(255) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheese_db`
--

INSERT INTO `cheese_db` (`cheese`, `description`, `type`, `country`, `age`, `classification`, `price`, `image_file`, `viewed`, `cid`) VALUES
('Bleu Benedictine', 'Blue Benedictineâ€™s texture is smooth and buttery. Its aroma is of mushrooms and the paste is off-white in color with blue-green veins running throughout. The monks use Penicillium Roqueforti (the same blue used in Roquefort) in this cheese, which makes for a nice contrast in flavor to the rich paste that has a touch of earthiness and salt.', 'Cow', 'Canada', 12, 'Blue', '0.00', 'image_5dd9c095290e0.jpg', 23, 9),
('Jarlsberg', 'Made from pasteurized cowâ€™s milk, Norwayâ€™s best known and most widely produced cheese is Jarlsberg. Although a couple of different legends exist about the origins of the cheese, the true development of Jarlsberg began in 1956 with research conducted by the Agricultural University of Norway.', 'Cow', 'Norway', 4, 'Semi-Hard', '0.00', 'image_5dd9c4daadd69.jpg', 15, 10),
('Manchego', 'Produced in Castile La Mancha, in Spain, Manchego is probably the best known of the Spanish sheep\'s milk cheeses. ', 'Sheep', 'Spain', 0, 'Semi-Soft', '0.00', 'image_5dd9c6a4976dc.jpg', 7, 11),
('Parmesan', 'A hard, crumbly cheese, Parmesan is well suited for grating. Flavor is earthy yet less sharp than other grana-style cheeses such as Parmigiano Reggiano. ', 'Cow', 'Italy', 0, 'Hard', '0.00', 'image_5dd9c7349cb64.jpg', 4, 12),
('Gouda', 'Gouda is a signature cheese of the Dutch and an increasingly popular style made by cheesemakers in the United States. Gouda is aged anywhere from 2 months to five years. The longer it\'s aged, the more intense the cheese becomes; harder and denser in texture with bold flavors that can be sharp, salty, sweet, nutty and caramelized all at once.', 'Cow', 'Netherlands', 8, 'Semi-Hard', '10.38', 'image_5dd9eb71ed77c.jpg', 43, 13),
('Cheddar', 'Cheddar cheese is a relatively hard, off-white (or orange if colourings such as annatto are added), sometimes sharp-tasting, natural cheese. Originating in the English village of Cheddar in Somerset,[1] cheeses of this style are now produced beyond the region and in several countries around the world. ', 'Cow', 'United Kingdom', 3, 'Hard', '0.00', 'image_5dd9ecbebe5c5.jpg', 11, 14),
('Cotija', 'El queso Cotija de MontaÃ±a or \"grain cheese\" is dry, firm, and very salty (the cheese is usually several times saltier than typical cheese, traditionally so that it will keep better). It is a seasonal cheese produced in limited quantities only from July to October because the cows are fed only on the rich grass that grows naturally on the mountains during the rainy season, giving the cheese its unique color and flavor. ', 'Cow', 'Mexico', 5, 'Semi-Hard', '0.00', 'image_5dd9efd0f2657.jpg', 4, 15),
('Roquefort', 'The cheese is white, tangy, crumbly and slightly moist, with distinctive veins of blue mold. It has characteristic odor and flavor with a notable taste of butyric acid; the blue veins provide a sharp tang. It has no rind; the exterior is edible and slightly salty.', 'Sheep', 'France', 5, 'Blue', '0.00', 'image_5dd9f08ee23f1.jpg', 2, 16),
('Blu di Bufala', 'Blu di Bufala is an Italian blue-veined cheese made with full-fat pasteurized buffalo milk by Quattro Portoni in Bergamo, Italy', 'Buffalo', 'Italy', 3, 'Blue', '30.00', 'image_5dd9f20dde205.jpg', 15, 17),
('Havarti', 'Havarti is made like most cheeses, by introducing rennet to milk to cause curdling. The curds are pressed into cheese molds which are drained, and then the cheese is aged. ', 'Cow', 'Denmark', 3, 'Semi-Soft', '0.00', 'image_5dd9f351aab6b.jpg', 2, 18),
('Atika', 'Atika is made from a mix of two different milks: goat and sheep. The rustic little wheels are aged from six to nine months, washed in a solution of cultures and brine every couple of weeks. ', 'Goat', 'United States', 6, 'Semi-Hard', '0.00', 'image_5dd9f8a970e24.jpg', 2, 19),
('Nocciolo', 'The cheese has strong umami aromas with notes of nuts and tropical fruit. Flavors are of sweet roasted hazelnuts with a yogurt-like tang and milkiness.', 'Cow', 'Italy', 2, 'Semi-Soft', '26.45', 'image_5de2c0f92d86a.jpg', 3, 20),
('Gamalost', 'Gamalost, which translates as old cheese, was once a staple of the Norwegian diet. The name might be due to the texture of the surface, or the fact that it is an old tradition, not the ripening which may take as little as two weeks.', 'Cow', 'Norway', 1, 'Semi-Soft', '0.00', 'image_5de2d557ab168.jpg', 3, 21),
('Gjetost', 'Pronounced â€œyay-toast,â€ this sweet, brown, creamy cheese is made from the whey of goatâ€™s milk.', 'Goat', 'Norway', 2, 'Semi-Hard', '0.00', 'image_5de2d81a7ca70.jpg', 2, 23),
('Gorgonzola', 'Gorgonzola has been produced for centuries in Gorgonzola, Milan, acquiring its greenish-blue marbling in the 11th century. However, the town\'s claim of geographical origin is disputed by other localities.', 'Cow', 'Italy', 4, 'Blue', '8.82', 'image_5de30d2e4c163.jpg', 5, 25),
('Vieux Boulogne', 'Vieux-Boulogne is famed for its strong smell, and in November 2004 was found by researchers at Cranfield University to be the \\\"smelliest\\\" of 15 French and British cheeses that they tested.', 'Cow', 'France', 2, 'Soft', '18.12', 'image_5de30fcfe499a.jpg', 2, 26),
('Casu Marzu', 'Casu marzu is created by leaving whole pecorino cheeses outside with part of the rind removed to allow the eggs of the cheese fly Piophila casei to be laid in the cheese.', 'Sheep', 'France', 0, 'Soft', '0.00', 'image_5de31318c2a36.jpg', 3, 27),
('Ricotta', 'Ricotta curds are creamy white in appearance, and slightly sweet in taste. The fat content changes depending on the brand and the type of milk used.', 'Sheep', 'Italy', 3, 'Soft', '4.97', 'image_5de3151164313.jpg', 3, 28),
('Mozzarella', 'Mozzarella is a traditionally southern Italian cheese made from Italian buffalo\'s milk by the pasta filata method.', 'Buffalo', 'Italy', 1, 'Semi-Soft', '0.00', 'image_5de316936589a.jpg', 4, 29),
('Emmental', 'Emmental is a yellow, medium-hard Swiss cheese that originated in the area around Emmental, Canton Bern. It has a savory but mild taste.', 'Cow', 'Switzerland', 18, 'Semi-Hard', '0.00', 'image_5de318d678de4.jpg', 2, 30),
('Asiago', 'Asiago originates from the Veneto region of Italy and is produced from raw, skimmed cowâ€™s milk. Asiago is named for the Asiago plateau in the mountains of Veneto in northern Italy.', 'Cow', 'Italy', 18, 'Hard', '12.97', 'image_5df1843b04384.jpg', 1, 32),
('Brie De Meaux', 'French cheese\'s king of kings. Since the Middle Ages this cheese has captured the hearts of all those who have experienced its outstanding taste. In the 19th century is was considered the finest cheese in Europe.', 'Cow', 'France', 1, 'Soft', '19.24', 'image_5df1857439b6d.jpg', 3, 33),
('Camembert', 'Has typical Camembert characteristics such as white rind and creamy yellow pate. Tends to be a little salty sometimes.', 'Cow', 'France', 1, 'Soft', '7.34', 'image_5df186454f289.jpg', 1, 34),
('Gruyere', 'Gruyere is a buttery and toasty-flavored cheese. It is hard with a firm, yet pliable texture. The texture is dense and compact, yet flexible. It is this density that makes it stronger and less stringy than Emmental when heated, so it is better for grating, grilling and in soups.', 'Cow', 'Switzerland', 1, 'Hard', '21.20', 'image_5df1874fb9cdd.jpg', 1, 35),
('Old Ford', 'This delicate, firm cheese is aged and then pressed to perfection by hand. It\'s made from a goat\'s milk that comes all the way from England. This cheese is known for its savory, salty, and buttery flavor. ', 'Goat', 'United Kingdom', 9, 'Semi-Soft', '57.20', 'image_5df1892781fa0.jpg', 1, 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cheese_db`
--
ALTER TABLE `cheese_db`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cheese_db`
--
ALTER TABLE `cheese_db`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
