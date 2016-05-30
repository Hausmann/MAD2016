-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Mai 2016 um 16:41
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `einsatzplanungdb`
--
DROP DATABASE IF EXISTS `einsatzplanungdb`;
CREATE DATABASE `einsatzplanungdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `einsatzplanungdb`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abteilungen`
--

CREATE TABLE `abteilungen` (
  `abteilungID` int(11) NOT NULL,
  `koe` text COLLATE utf8_bin NOT NULL,
  `beschreibung` text COLLATE utf8_bin NOT NULL,
  `stellen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `abteilungen`
--

INSERT INTO `abteilungen` (`abteilungID`, `koe`, `beschreibung`, `stellen`) VALUES
(1, 'C111', 'Ausbildung Uwe', 5),
(2, 'C112', 'Ausbildung Michael', 5),
(3, 'C115', 'Ausbildung Carmen', 5),
(4, 'P131', 'IT-Betrieb für zentrale Systeme', 3),
(5, 'BC121', 'Entwicklung Wirtschaftsprüfung', 3),
(6, 'EB343', 'Großrechnerkomponenten für Steuerprogramme', 2),
(7, 'JUBIT', 'Jugendfirma der DATEV', 12),
(8, 'EB133', 'KRW Schnittstellen und Versionserstellung - Technik', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ausbilder`
--

CREATE TABLE `ausbilder` (
  `ausbilderID` int(11) NOT NULL,
  `vorname` text COLLATE utf8_bin NOT NULL,
  `nachname` text COLLATE utf8_bin NOT NULL,
  `abteilungID` int(11) NOT NULL,
  `persNr` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `ausbilder`
--

INSERT INTO `ausbilder` (`ausbilderID`, `vorname`, `nachname`, `abteilungID`, `persNr`) VALUES
(1, 'Michael', 'Hausmann', 2, 0),
(2, 'Uwe', 'Ritthammer', 1, 0),
(3, 'Carmen', 'Kurtz', 3, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `azubis`
--

CREATE TABLE `azubis` (
  `azubiID` int(11) NOT NULL,
  `vorname` text COLLATE utf8_bin NOT NULL,
  `nachname` text COLLATE utf8_bin NOT NULL,
  `berufID` int(11) NOT NULL,
  `ausbilderID` int(11) NOT NULL,
  `heimatabteilungID` int(11) NOT NULL,
  `persNr` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `azubis`
--

INSERT INTO `azubis` (`azubiID`, `vorname`, `nachname`, `berufID`, `ausbilderID`, `heimatabteilungID`, `persNr`) VALUES
(1, 'Bernhard', 'Schiffer', 2, 2, 6, 9446),
(2, 'Daniel', 'Kurzendorfer', 2, 3, 5, 9473),
(3, 'Alexander', 'Flohr', 1, 1, 4, 0),
(5, 'Oliver', 'Zernikow', 2, 2, 8, 9465),
(6, 'test', 'test2', 2, 2, 6, 9412),
(7, 'Max', 'Mustermann', 2, 2, 6, 1245),
(8, 'Oli', 'Cow', 2, 2, 6, 815),
(17, 'Daniel', 'Rotkopf', 2, 2, 6, 9999),
(18, 'daniela', 'rotkopf', 2, 2, 6, 12343),
(19, 'Oli', 'Cow', 2, 2, 6, 12312),
(28, 'Daniel', 'Kurziiii', 1, 1, 1, 9123);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `berufe`
--

CREATE TABLE `berufe` (
  `berufID` int(11) NOT NULL,
  `beschreibung` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `berufe`
--

INSERT INTO `berufe` (`berufID`, `beschreibung`) VALUES
(1, 'Fachinformatiker Systemintegration'),
(2, 'Fachinformatiker Anwendungsentwicklung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einsaetze`
--

CREATE TABLE `einsaetze` (
  `einsatzID` int(11) NOT NULL,
  `abteilungID` int(11) NOT NULL,
  `azubiID` int(11) NOT NULL,
  `vonDatum` date NOT NULL,
  `bisDatum` date NOT NULL,
  `status` enum('genehmigt','abgelehnt','Wunsch','Bedarf') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `einsaetze`
--

INSERT INTO `einsaetze` (`einsatzID`, `abteilungID`, `azubiID`, `vonDatum`, `bisDatum`, `status`) VALUES
(1, 7, 1, '2016-03-14', '2016-05-06', 'genehmigt'),
(2, 7, 2, '2016-07-18', '2016-09-09', 'genehmigt'),
(3, 4, 3, '2016-04-01', '2016-06-30', 'genehmigt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fachausbilder`
--

CREATE TABLE `fachausbilder` (
  `fachausbilderID` int(11) NOT NULL,
  `vorname` text COLLATE utf8_bin NOT NULL,
  `nachname` text COLLATE utf8_bin NOT NULL,
  `abteilungID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `fachausbilder`
--

INSERT INTO `fachausbilder` (`fachausbilderID`, `vorname`, `nachname`, `abteilungID`) VALUES
(1, 'Andreas', 'Fürst', 4),
(2, 'Herbert', 'Peter', 5),
(3, 'Alexandra', 'Meyer', 6),
(4, 'Thomas', 'Kuhn', 8);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `abteilungen`
--
ALTER TABLE `abteilungen`
  ADD PRIMARY KEY (`abteilungID`);

--
-- Indizes für die Tabelle `ausbilder`
--
ALTER TABLE `ausbilder`
  ADD PRIMARY KEY (`ausbilderID`),
  ADD KEY `abteilungID` (`abteilungID`);

--
-- Indizes für die Tabelle `azubis`
--
ALTER TABLE `azubis`
  ADD PRIMARY KEY (`azubiID`),
  ADD KEY `berufID` (`berufID`),
  ADD KEY `ausbilderID` (`ausbilderID`),
  ADD KEY `heimatabteilungID` (`heimatabteilungID`);

--
-- Indizes für die Tabelle `berufe`
--
ALTER TABLE `berufe`
  ADD PRIMARY KEY (`berufID`);

--
-- Indizes für die Tabelle `einsaetze`
--
ALTER TABLE `einsaetze`
  ADD PRIMARY KEY (`einsatzID`),
  ADD KEY `azubiID` (`azubiID`),
  ADD KEY `abteilungID` (`abteilungID`);

--
-- Indizes für die Tabelle `fachausbilder`
--
ALTER TABLE `fachausbilder`
  ADD PRIMARY KEY (`fachausbilderID`),
  ADD KEY `abteilungID` (`abteilungID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `abteilungen`
--
ALTER TABLE `abteilungen`
  MODIFY `abteilungID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `ausbilder`
--
ALTER TABLE `ausbilder`
  MODIFY `ausbilderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `azubis`
--
ALTER TABLE `azubis`
  MODIFY `azubiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT für Tabelle `berufe`
--
ALTER TABLE `berufe`
  MODIFY `berufID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `einsaetze`
--
ALTER TABLE `einsaetze`
  MODIFY `einsatzID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `fachausbilder`
--
ALTER TABLE `fachausbilder`
  MODIFY `fachausbilderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ausbilder`
--
ALTER TABLE `ausbilder`
  ADD CONSTRAINT `ausbilder_ibfk_1` FOREIGN KEY (`abteilungID`) REFERENCES `abteilungen` (`abteilungID`);

--
-- Constraints der Tabelle `azubis`
--
ALTER TABLE `azubis`
  ADD CONSTRAINT `azubis_ibfk_1` FOREIGN KEY (`berufID`) REFERENCES `berufe` (`berufID`),
  ADD CONSTRAINT `azubis_ibfk_2` FOREIGN KEY (`ausbilderID`) REFERENCES `ausbilder` (`ausbilderID`),
  ADD CONSTRAINT `azubis_ibfk_3` FOREIGN KEY (`heimatabteilungID`) REFERENCES `abteilungen` (`abteilungID`);

--
-- Constraints der Tabelle `einsaetze`
--
ALTER TABLE `einsaetze`
  ADD CONSTRAINT `einsaetze_ibfk_1` FOREIGN KEY (`azubiID`) REFERENCES `azubis` (`azubiID`),
  ADD CONSTRAINT `einsaetze_ibfk_2` FOREIGN KEY (`abteilungID`) REFERENCES `abteilungen` (`abteilungID`);

--
-- Constraints der Tabelle `fachausbilder`
--
ALTER TABLE `fachausbilder`
  ADD CONSTRAINT `fachausbilder_ibfk_1` FOREIGN KEY (`abteilungID`) REFERENCES `abteilungen` (`abteilungID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
