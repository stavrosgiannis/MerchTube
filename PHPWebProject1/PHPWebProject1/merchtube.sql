-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Jul 2018 um 09:22
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `merchtube`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_adresse`
--

CREATE TABLE `tbl_adresse` (
  `id_adresse` int(100) NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hausnummer` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plz` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ort` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `land` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typ` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_anwender`
--

CREATE TABLE `tbl_anwender` (
  `id_anwender` int(100) NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `anwender_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profilbild_id` int(100) DEFAULT NULL,
  `adresse_id` int(100) DEFAULT NULL,
  `login` int(1) NOT NULL,
  `geschaeftsanwender_id` int(11) DEFAULT NULL,
  `partner_id` int(100) DEFAULT NULL,
  `bankverbindung_id` int(100) DEFAULT NULL,
  `salt` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `frage1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `frage2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `frage3` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `tbl_anwender`
--

INSERT INTO `tbl_anwender` (`id_anwender`, `vorname`, `nachname`, `email`, `passwort`, `anwender_name`, `profilbild_id`, `adresse_id`, `login`, `geschaeftsanwender_id`, `partner_id`, `bankverbindung_id`, `salt`, `frage1`, `frage2`, `frage3`) VALUES
(8, '4', '4', '4@4.4', '2bb35cdaf3071e1fab4e666dd883293c23d7565dc0049c49f1b03e2b17dadc43', '4', 1, 8, 0, NULL, NULL, NULL, '7a0', '4', '4', '4'),
(11, '7', '7', '7@7.7', '7352adfd9cb2fd6d8484d38e9b869a2d4f05d1f3c6e58f50161a4ad7b57cadf8', '7', NULL, NULL, 0, NULL, NULL, NULL, 'fb0', '7', '7', '7');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_anwender_trend`
--

CREATE TABLE `tbl_anwender_trend` (
  `anwender_id` int(100) NOT NULL,
  `trend_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_artikel`
--

CREATE TABLE `tbl_artikel` (
  `id_artikel` int(100) NOT NULL,
  `bezeichnug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `beschriebung` text COLLATE utf8_unicode_ci,
  `preis` double(8,2) NOT NULL,
  `status` int(10) NOT NULL,
  `bildpfadname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `artikelnummer` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `tbl_artikel`
--

INSERT INTO `tbl_artikel` (`id_artikel`, `bezeichnug`, `beschriebung`, `preis`, `status`, `bildpfadname`, `artikelnummer`) VALUES
(1, '1', '1', 1.00, 0, 'Weiße_Tasse_MrTaste.jpg', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_bankverbindung`
--

CREATE TABLE `tbl_bankverbindung` (
  `id_bankverbindung` int(11) NOT NULL,
  `kontonummer` int(11) NOT NULL,
  `blz` int(11) NOT NULL,
  `bic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `iban` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_farbe`
--

CREATE TABLE `tbl_farbe` (
  `artikelnummer` int(100) NOT NULL,
  `farbe` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_geschaeftsanwender`
--

CREATE TABLE `tbl_geschaeftsanwender` (
  `id_geschaeftsanwender` int(11) NOT NULL,
  `firmenname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `umstid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_groesse_kleidung`
--

CREATE TABLE `tbl_groesse_kleidung` (
  `artikelnummer` int(11) NOT NULL,
  `groesse` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_groesse_orbjekte`
--

CREATE TABLE `tbl_groesse_orbjekte` (
  `artikelnummer` int(100) NOT NULL,
  `groesse` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_partner`
--

CREATE TABLE `tbl_partner` (
  `id_partner` int(100) NOT NULL,
  `channel_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `channel_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_profilbild`
--

CREATE TABLE `tbl_profilbild` (
  `id_profilbild` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `tbl_profilbild`
--

INSERT INTO `tbl_profilbild` (`id_profilbild`, `name`) VALUES
(1, 'penis.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_rechnung`
--

CREATE TABLE `tbl_rechnung` (
  `anwender_id` int(100) NOT NULL,
  `artikel_id` int(100) NOT NULL,
  `menge` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_template`
--

CREATE TABLE `tbl_template` (
  `id_tamplate` int(11) NOT NULL,
  `bannerlinks_dateiname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bannerrechts_dateiname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bannertitel_dateiname` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_trends`
--

CREATE TABLE `tbl_trends` (
  `id_trend` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_warenkorb`
--

CREATE TABLE `tbl_warenkorb` (
  `anwender_id` int(100) NOT NULL,
  `artikel_id` int(100) NOT NULL,
  `menge` int(10) NOT NULL,
  `session` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `tbl_warenkorb`
--

INSERT INTO `tbl_warenkorb` (`anwender_id`, `artikel_id`, `menge`, `session`) VALUES
(11, 1, 1, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_adresse`
--
ALTER TABLE `tbl_adresse`
  ADD PRIMARY KEY (`id_adresse`);

--
-- Indizes für die Tabelle `tbl_anwender`
--
ALTER TABLE `tbl_anwender`
  ADD PRIMARY KEY (`id_anwender`),
  ADD KEY `bild_id` (`profilbild_id`),
  ADD KEY `adresse_id` (`adresse_id`),
  ADD KEY `partner_id` (`partner_id`),
  ADD KEY `bankverbindung_id` (`bankverbindung_id`),
  ADD KEY `adresse_id_2` (`adresse_id`),
  ADD KEY `geschaeftsanwender_id` (`geschaeftsanwender_id`);

--
-- Indizes für die Tabelle `tbl_anwender_trend`
--
ALTER TABLE `tbl_anwender_trend`
  ADD KEY `anwender_id` (`anwender_id`),
  ADD KEY `trend_id` (`trend_id`);

--
-- Indizes für die Tabelle `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `arikel_bild_id` (`bildpfadname`),
  ADD KEY `artikelnummer` (`artikelnummer`);

--
-- Indizes für die Tabelle `tbl_bankverbindung`
--
ALTER TABLE `tbl_bankverbindung`
  ADD PRIMARY KEY (`id_bankverbindung`);

--
-- Indizes für die Tabelle `tbl_farbe`
--
ALTER TABLE `tbl_farbe`
  ADD PRIMARY KEY (`artikelnummer`);

--
-- Indizes für die Tabelle `tbl_geschaeftsanwender`
--
ALTER TABLE `tbl_geschaeftsanwender`
  ADD PRIMARY KEY (`id_geschaeftsanwender`);

--
-- Indizes für die Tabelle `tbl_groesse_kleidung`
--
ALTER TABLE `tbl_groesse_kleidung`
  ADD PRIMARY KEY (`artikelnummer`);

--
-- Indizes für die Tabelle `tbl_groesse_orbjekte`
--
ALTER TABLE `tbl_groesse_orbjekte`
  ADD PRIMARY KEY (`artikelnummer`);

--
-- Indizes für die Tabelle `tbl_partner`
--
ALTER TABLE `tbl_partner`
  ADD PRIMARY KEY (`id_partner`),
  ADD KEY `template_id` (`template_id`);

--
-- Indizes für die Tabelle `tbl_profilbild`
--
ALTER TABLE `tbl_profilbild`
  ADD PRIMARY KEY (`id_profilbild`);

--
-- Indizes für die Tabelle `tbl_rechnung`
--
ALTER TABLE `tbl_rechnung`
  ADD KEY `artikel_id` (`artikel_id`),
  ADD KEY `anwender_id` (`anwender_id`);

--
-- Indizes für die Tabelle `tbl_template`
--
ALTER TABLE `tbl_template`
  ADD PRIMARY KEY (`id_tamplate`);

--
-- Indizes für die Tabelle `tbl_trends`
--
ALTER TABLE `tbl_trends`
  ADD PRIMARY KEY (`id_trend`);

--
-- Indizes für die Tabelle `tbl_warenkorb`
--
ALTER TABLE `tbl_warenkorb`
  ADD KEY `anwender_id` (`anwender_id`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_adresse`
--
ALTER TABLE `tbl_adresse`
  MODIFY `id_adresse` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `tbl_anwender`
--
ALTER TABLE `tbl_anwender`
  MODIFY `id_anwender` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT für Tabelle `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  MODIFY `id_artikel` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `tbl_bankverbindung`
--
ALTER TABLE `tbl_bankverbindung`
  MODIFY `id_bankverbindung` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_farbe`
--
ALTER TABLE `tbl_farbe`
  MODIFY `artikelnummer` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_geschaeftsanwender`
--
ALTER TABLE `tbl_geschaeftsanwender`
  MODIFY `id_geschaeftsanwender` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_groesse_kleidung`
--
ALTER TABLE `tbl_groesse_kleidung`
  MODIFY `artikelnummer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_groesse_orbjekte`
--
ALTER TABLE `tbl_groesse_orbjekte`
  MODIFY `artikelnummer` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_partner`
--
ALTER TABLE `tbl_partner`
  MODIFY `id_partner` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_profilbild`
--
ALTER TABLE `tbl_profilbild`
  MODIFY `id_profilbild` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `tbl_template`
--
ALTER TABLE `tbl_template`
  MODIFY `id_tamplate` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_trends`
--
ALTER TABLE `tbl_trends`
  MODIFY `id_trend` int(100) NOT NULL AUTO_INCREMENT;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_adresse`
--
ALTER TABLE `tbl_adresse`
  ADD CONSTRAINT `tbl_adresse_ibfk_1` FOREIGN KEY (`id_adresse`) REFERENCES `tbl_anwender` (`adresse_id`);

--
-- Constraints der Tabelle `tbl_anwender`
--
ALTER TABLE `tbl_anwender`
  ADD CONSTRAINT `tbl_anwender_ibfk_1` FOREIGN KEY (`bankverbindung_id`) REFERENCES `tbl_bankverbindung` (`id_bankverbindung`),
  ADD CONSTRAINT `tbl_anwender_ibfk_2` FOREIGN KEY (`profilbild_id`) REFERENCES `tbl_profilbild` (`id_profilbild`),
  ADD CONSTRAINT `tbl_anwender_ibfk_3` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner` (`id_partner`),
  ADD CONSTRAINT `tbl_anwender_ibfk_4` FOREIGN KEY (`geschaeftsanwender_id`) REFERENCES `tbl_geschaeftsanwender` (`id_geschaeftsanwender`);

--
-- Constraints der Tabelle `tbl_anwender_trend`
--
ALTER TABLE `tbl_anwender_trend`
  ADD CONSTRAINT `tbl_anwender_trend_ibfk_1` FOREIGN KEY (`anwender_id`) REFERENCES `tbl_anwender` (`id_anwender`),
  ADD CONSTRAINT `tbl_anwender_trend_ibfk_2` FOREIGN KEY (`trend_id`) REFERENCES `tbl_trends` (`id_trend`);

--
-- Constraints der Tabelle `tbl_farbe`
--
ALTER TABLE `tbl_farbe`
  ADD CONSTRAINT `tbl_farbe_ibfk_1` FOREIGN KEY (`artikelnummer`) REFERENCES `tbl_artikel` (`artikelnummer`);

--
-- Constraints der Tabelle `tbl_groesse_kleidung`
--
ALTER TABLE `tbl_groesse_kleidung`
  ADD CONSTRAINT `tbl_groesse_kleidung_ibfk_1` FOREIGN KEY (`artikelnummer`) REFERENCES `tbl_artikel` (`artikelnummer`);

--
-- Constraints der Tabelle `tbl_groesse_orbjekte`
--
ALTER TABLE `tbl_groesse_orbjekte`
  ADD CONSTRAINT `tbl_groesse_orbjekte_ibfk_1` FOREIGN KEY (`artikelnummer`) REFERENCES `tbl_artikel` (`artikelnummer`);

--
-- Constraints der Tabelle `tbl_partner`
--
ALTER TABLE `tbl_partner`
  ADD CONSTRAINT `tbl_partner_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `tbl_template` (`id_tamplate`);

--
-- Constraints der Tabelle `tbl_rechnung`
--
ALTER TABLE `tbl_rechnung`
  ADD CONSTRAINT `tbl_rechnung_ibfk_1` FOREIGN KEY (`anwender_id`) REFERENCES `tbl_anwender` (`id_anwender`),
  ADD CONSTRAINT `tbl_rechnung_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `tbl_artikel` (`id_artikel`);

--
-- Constraints der Tabelle `tbl_warenkorb`
--
ALTER TABLE `tbl_warenkorb`
  ADD CONSTRAINT `tbl_warenkorb_ibfk_1` FOREIGN KEY (`anwender_id`) REFERENCES `tbl_anwender` (`id_anwender`),
  ADD CONSTRAINT `tbl_warenkorb_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `tbl_artikel` (`id_artikel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
