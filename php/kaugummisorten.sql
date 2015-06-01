--
-- Dantenbank Name: demo
--
CREATE DATABASE IF NOT EXISTS `demo`;


--
-- Tabellenstruktur für Tabelle `kaugummisorten`
--

CREATE TABLE IF NOT EXISTS `kaugummisorten` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `geschmack` int(11) NOT NULL DEFAULT '0',
  `farbe` text NOT NULL,
  `preis` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kaugummisorten`
--

INSERT INTO `kaugummisorten` (`id`, `name`, `geschmack`, `farbe`, `preis`) VALUES
(0, 'Huba Apfel', 2, 'grün', '0,32'),
(1, 'Huba Pink', 1, 'Pink', '0,60'),
(2, 'Wild Berry', 1, 'rosa', '0,40'),
(3, 'Artic Cool', 3, 'weiß', '0,42'),
(4, 'Banana Joe', 2, 'gelb', '0,38'),
(5, 'Ätopiana', 3, 'braun', '0,30'),
(6, 'Exotic', 2, 'cockatoo', '0,45');

--
-- Indizes für die Tabelle `kaugummisorten`
--
ALTER TABLE `kaugummisorten`
  ADD PRIMARY KEY (`id`);
