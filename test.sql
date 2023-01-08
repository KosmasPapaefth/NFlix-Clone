-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 10 Ιουν 2021 στις 17:39:49
-- Έκδοση διακομιστή: 10.4.11-MariaDB
-- Έκδοση PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `test`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `creditsmovies`
--

CREATE TABLE `creditsmovies` (
  `creditID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `Actors` text NOT NULL,
  `Directors` text NOT NULL,
  `Screenwriter` text NOT NULL,
  `Musicians` text NOT NULL,
  `Soundtrack` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `creditsmovies`
--

INSERT INTO `creditsmovies` (`creditID`, `movieID`, `Actors`, `Directors`, `Screenwriter`, `Musicians`, `Soundtrack`) VALUES
(4, 67, 'Jane Levy ,Dylan Minnette ,Daniel Zovatto ,Stephen Lang', 'Fede Álvarez', 'Fede Álvarez ,Rodo Sayagues', 'Roque Baños', 'Don\'t Breathe - Roque Banos'),
(5, 68, 'Keanu Reeves, Michael Nyqvist, Alfie Allen, Adrianne Palicki\r\nBridget Moynahan\r\nDean Winters\r\nIan McShane\r\nJohn Leguizamo\r\nWillem Dafoe', 'Chad Stahelski', 'Derek Kolstad', 'Tyler Bates\r\nJoel J. Richard', 'Every Ending Has a Beginning - John Wick Soundtrack By Tyler Bates and Joel Richard'),
(6, 69, 'Keanu Reeves , Riccardo , Scamarcio , Ian McShane', 'Chad Stahelski', 'Darek Kolstad', 'Tyler Bates ,Joel J. Richard', 'John Wick: Chapter 2 (Original Motion Picture Soundtrack)'),
(7, 70, 'Keanu Reeves , Halle Berry , Ian McShane', 'Chad Stahelski', 'Derek Kolstad , Shay Hatten , Chris Collins', 'Tyler Bates , Joel J. Richard', 'John Wick: Chapter 3 – Parabellum (Original Motion Picture Soundtrack)'),
(8, 71, 'Keanu Reeves', 'Chad Stahelski', 'Michael Finch ,Shay Hatten ,Derek Kolstad', '-', '-'),
(9, 72, 'Johnny Depp , Orlando Bloom , Keira Knightley', 'Gore Verbinski', 'Ted Elliott , Terry Rossio , Stuart Beattie', 'Klaus Badelt', 'Pirates Of The Caribbean The Curse Of The Black Pearl - Soundtrack Suite - Klaus Badelt'),
(10, 73, 'James McAvoy , Anya Taylor-Joy , Betty Buckley', 'M. Night Shyamalan', 'M. Night Shyamalan', 'West Dylan Thordson', 'Split 2016'),
(11, 74, 'Liam Neeson , Maggie Grace , Leland Orser', 'Pierre Morel', 'Luc BessonRobert Mark Kamen', 'Nathaniel Méchaly', 'Taken (2008) Opening (Soundtrack OST)');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `creditsseries`
--

CREATE TABLE `creditsseries` (
  `creditID` int(11) NOT NULL,
  `seriesID` int(11) NOT NULL,
  `Actors` text NOT NULL,
  `Directors` text NOT NULL,
  `Screenwriter` text NOT NULL,
  `Musicians` text NOT NULL,
  `Soundtrack` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `creditsseries`
--

INSERT INTO `creditsseries` (`creditID`, `seriesID`, `Actors`, `Directors`, `Screenwriter`, `Musicians`, `Soundtrack`) VALUES
(1, 9, 'Michael Hall, Jennifer Carpenter, David Zayas', 'James Manos JR.', 'James Manos JR.', 'losha', 'Dexter main'),
(3, 11, 'John Slattery ,Fernanda Andrade ,Michael Mosley, Gerardo Celasco\r\nEve Harlow,Aaron Moten,Evan Whitten,Elizabeth Cappuccino.Jason Butler Harner', 'Manny Coto', 'John Requa, Glenn Ficarra,Charles Gogolak,Manny Coto', 'Sean Callery ,Jonas Friedman, Jamie Forsyth', 'No'),
(4, 12, 'Úrsula Corberó , Álvaro Morte , Itziar Ituño , Pedro Alonso , Miguel Herrán', 'Jesús Colmenar , Alex Rodrigo', 'Alex Pina', 'Iván Martínez Lacámara , Manel Santisteban', 'Cecilia Krull - My life is going on'),
(5, 13, 'Cillian Murphy , Paul Anderson , Helen McCrory , Sophie Rundle , Joe Cole', 'Anthony Byrne , Colm McCarthy , Tim Mielants', 'Steven Knight', 'Martin Phipps , Paul Hartnoll , PJ Harvey', 'Nick Cave And The Bad Seeds - Red Right Hand (Peaky Blinders OST)'),
(6, 14, 'Peter Dinklage , Lena Headey , Emilia Clarke , Kit Harington , Sophie Turner', 'David Nutter , Matt Shakman , Jeremy Podeswa', 'David Benioff , D.B. Weiss', 'Ramin Djawadi', 'Ramin Djawadi - Main Title'),
(7, 15, 'Dominic Purcell , Wentworth Miller , Robert Knepper , Amaury Nolasco', 'Bobby Roth , Kevin Hooks , Dwight H. Little , Nelson McCormick', 'Paul T. Scheuring', 'Ramin Djawadi', 'Prison Break - Strings Of Prisoners'),
(8, 16, 'Bryan Cranston , Anna Gunn , Aaron Paul , Betsy Brandt , RJ Mitte', 'Michelle MacLaren , Adam Bernstein', 'Vince Gilligan , Peter Gould , George Mastras', 'Dave Porter', 'Breaking Bad Soundtracks'),
(9, 17, 'Anya Taylor-Joy , Chloe Pirrie , Bill Camp , Marcin Dorocinski', 'Scott Frank', 'Scott Frank , Allan Scott', 'Carlos Rafael Rivera', 'The Vogues - You\'re The One');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `moviecomments`
--

CREATE TABLE `moviecomments` (
  `commentID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `moviecomments`
--

INSERT INTO `moviecomments` (`commentID`, `movieID`, `userID`, `comment`) VALUES
(3, 68, 39, 'Nice Movie'),
(6, 72, 16, 'Η καλυτερη ταινια'),
(7, 74, 16, 'Ταινιαρα!!'),
(8, 68, 48, 'niceee');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `movierating`
--

CREATE TABLE `movierating` (
  `rateID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `movierating`
--

INSERT INTO `movierating` (`rateID`, `movieID`, `userID`, `rate`) VALUES
(9, 68, 39, 5),
(28, 67, 39, 2),
(29, 67, 16, 3),
(30, 72, 16, 5),
(31, 74, 16, 5),
(32, 68, 48, 4),
(33, 68, 16, 5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `movies`
--

CREATE TABLE `movies` (
  `MovieId` int(11) NOT NULL,
  `moviename` varchar(255) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Year` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `movies`
--

INSERT INTO `movies` (`MovieId`, `moviename`, `Duration`, `Description`, `Year`, `Category`) VALUES
(67, 'Don\'t Breathe', 88, 'Don\'t Breathe is an American horror-thriller film', 2016, 'Horror,Thriller'),
(68, 'John Wick Chapter:1', 101, 'An ex-hit-man comes out of retirement to track down the gangsters that killed his dog and took everything from him.', 2014, 'Action , Thriller , Crime'),
(69, 'John Wick Chapter:2', 122, 'After returning to the criminal underworld to repay a debt, John Wick discovers that a large bounty has been put on his life.', 2017, 'Action , Crime , Thriller'),
(70, 'John Wick: Chapter 3', 130, 'John Wick is on the run after killing a member of the international assassins\' guild, and with a $14 million price tag on his head, he is the target of hit men and women everywhere', 2019, 'Action , Crime , Thriller'),
(71, 'John Wick: Chapter 4', 0, 'The continuing adventures of assassin John Wick.', 2022, 'Action , Crime , Thriller'),
(72, 'Pirates of the Caribbean: The Curse of the Black Pearl', 2003, 'Blacksmith Will Turner teams up with eccentric pirate \"Captain\" Jack Sparrow to save his love, the governor\'s daughter, from Jack\'s former pirate allies, who are now undead.', 2003, 'Action , Adventure , Fantasy'),
(73, 'Split', 117, 'Three girls are kidnapped by a man with a diagnosed 23 distinct personalities. They must try to escape before the apparent emergence of a frightful new 24th.', 2016, 'Horror , Thriller'),
(74, 'Taken', 90, 'A retired CIA agent travels across Europe and relies on his old skills to save his estranged daughter, who has been kidnapped while on a trip to Paris.', 2008, 'Action , Thriller , Crime');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `moviesfav`
--

CREATE TABLE `moviesfav` (
  `favid` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `moviesfav`
--

INSERT INTO `moviesfav` (`favid`, `movieID`, `userID`) VALUES
(54, 68, 39),
(57, 74, 16),
(58, 68, 48),
(59, 68, 16);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `moviewish`
--

CREATE TABLE `moviewish` (
  `wishID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `moviewish`
--

INSERT INTO `moviewish` (`wishID`, `movieID`, `userID`) VALUES
(5, 71, 16);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `series`
--

CREATE TABLE `series` (
  `SeriesId` int(11) NOT NULL,
  `SeriesName` varchar(40) NOT NULL,
  `Episodes` int(11) NOT NULL,
  `Seasons` int(11) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Year` int(11) NOT NULL,
  `Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `series`
--

INSERT INTO `series` (`SeriesId`, `SeriesName`, `Episodes`, `Seasons`, `Duration`, `Description`, `Year`, `Category`) VALUES
(9, 'Dexter', 106, 9, 5618, 'By day, mild-mannered Dexter is a blood-spatter analyst for the Miami police. But at night, he is a serial killer who only targets other murderers.', 2006, 'Crime, Drama, Mystery'),
(11, 'nExt', 10, 1, 600, 'A former tech CEO joins an FBI Cybersecurity Agent to stop the emergence of a rogue Artificial Intelligence.', 2020, 'Crime , Sci-Fi , Drama'),
(12, 'Money Heist (La Casa De Papel)', 41, 5, 2400, 'An unusual group of robbers attempt to carry out the most perfect robbery in Spanish history - stealing 2.4 billion euros from the Royal Mint of Spain.', 2017, 'Action , Crime , Mystery'),
(13, 'Peaky Blinders', 36, 5, 2160, 'A gangster family epic set in 1900s England, centering on a gang who sew razor blades in the peaks of their caps, and their fierce boss Tommy Shelby.', 2013, 'Crime , Drama'),
(14, 'Game of Thrones', 73, 8, 3650, 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.', 2011, 'Drama , Adventure , Action'),
(15, 'Prison Break', 90, 5, 4500, 'Due to a political conspiracy, an innocent man is sent to death row and his only hope is his brother, who makes it his mission to deliberately get himself sent to the same prison in order to break the both of them out, from the inside.', 2005, 'Action , Crime , Drama'),
(16, 'Breaking Bad', 62, 5, 3100, 'A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family\'s future.', 2008, 'Crime , Drama , Thriller'),
(17, 'The Queen\'s Gambit', 7, 1, 420, 'Orphaned at the tender age of nine, prodigious introvert Beth Harmon discovers and masters the game of chess in 1960s USA. But child stardom comes at a price.', 2020, 'Drama');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `seriescomments`
--

CREATE TABLE `seriescomments` (
  `commentID` int(11) NOT NULL,
  `seriesID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `seriescomments`
--

INSERT INTO `seriescomments` (`commentID`, `seriesID`, `userID`, `comment`) VALUES
(4, 9, 39, 'Καλη σειρα'),
(5, 9, 40, 'kalh'),
(6, 17, 16, 'Πολυ καλη ταινια και σε κραταει προσηλωμενο'),
(7, 14, 16, 'Η καλυτερη σειρα ολων των εποχων'),
(8, 14, 48, 'my favorite'),
(9, 13, 16, 'Polu kalh');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `seriesfav`
--

CREATE TABLE `seriesfav` (
  `favid` int(11) NOT NULL,
  `seriesID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `seriesfav`
--

INSERT INTO `seriesfav` (`favid`, `seriesID`, `userID`) VALUES
(3, 9, 16),
(4, 9, 40),
(5, 17, 16),
(6, 14, 48),
(7, 16, 16);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `seriesrating`
--

CREATE TABLE `seriesrating` (
  `rateID` int(11) NOT NULL,
  `seriesID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `seriesrating`
--

INSERT INTO `seriesrating` (`rateID`, `seriesID`, `userID`, `rate`) VALUES
(8, 9, 39, 1),
(10, 9, 16, 4),
(11, 9, 40, 3),
(12, 17, 16, 5),
(13, 14, 16, 5),
(14, 14, 48, 5),
(15, 13, 16, 4),
(16, 16, 16, 4);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `serieswish`
--

CREATE TABLE `serieswish` (
  `wishID` int(11) NOT NULL,
  `seriesID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `serieswish`
--

INSERT INTO `serieswish` (`wishID`, `seriesID`, `userID`) VALUES
(3, 9, 40);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(16, 'useras', '$2y$10$sU7hcR5zzwr7SxRzBtGFXOHkcpZzs74sLrzQyv/GcpnJlsY/O2ItO', 'user', '2021-05-13 12:51:10'),
(38, 'test1', '$2y$10$rOPDppSyAoi/JuB1I7lYWefC5LaHAuLN8NFRQDj.WrMb.e/REsY8O', 'company', '2021-05-30 17:16:31'),
(39, 'kosmas', '$2y$10$VfOK2ZY30paFp.8WOIswb.Dm.r3IzxaLLQdGD9fxXZJWvPF23ee/2', 'user', '2021-06-09 13:29:45'),
(40, 'net', '$2y$10$jN.oLdeQWkxVbCkLnKePdOh0dH.E0EHWqGjgjFxLcEfBs3RdBIty2', 'user', '2021-06-10 00:29:06'),
(41, 'company0', '$2y$10$MfgN7.sjod2m5iwVFkmqU.zL03cx.SFUFY7UIWX13vf/x.whv2vQ.', 'company', '2021-06-10 14:44:27'),
(47, 'admin', '$2y$10$MYeXDpNXVY3fXm.a822oL.KYKunHMIwnF0wt2GkJ1UPYUvAmQnyiC', 'admin', '2021-06-10 14:59:58'),


--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `creditsmovies`
--
ALTER TABLE `creditsmovies`
  ADD PRIMARY KEY (`creditID`),
  ADD KEY `FK_creditsmovieID` (`movieID`);

--
-- Ευρετήρια για πίνακα `creditsseries`
--
ALTER TABLE `creditsseries`
  ADD PRIMARY KEY (`creditID`),
  ADD KEY `FK_creditsseriesID` (`seriesID`);

--
-- Ευρετήρια για πίνακα `moviecomments`
--
ALTER TABLE `moviecomments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `FK_commovieID` (`movieID`),
  ADD KEY `FK_comuserID` (`userID`);

--
-- Ευρετήρια για πίνακα `movierating`
--
ALTER TABLE `movierating`
  ADD PRIMARY KEY (`rateID`),
  ADD KEY `FK_movrateuserID` (`userID`),
  ADD KEY `FK_movratemovieID` (`movieID`);

--
-- Ευρετήρια για πίνακα `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`MovieId`),
  ADD UNIQUE KEY `moviename` (`moviename`);

--
-- Ευρετήρια για πίνακα `moviesfav`
--
ALTER TABLE `moviesfav`
  ADD PRIMARY KEY (`favid`),
  ADD KEY `FK_favmovieID` (`movieID`),
  ADD KEY `FK_favmovuserID` (`userID`);

--
-- Ευρετήρια για πίνακα `moviewish`
--
ALTER TABLE `moviewish`
  ADD PRIMARY KEY (`wishID`),
  ADD KEY `FK_wishmovieID` (`movieID`),
  ADD KEY `FK_wishuserID` (`userID`);

--
-- Ευρετήρια για πίνακα `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`SeriesId`);

--
-- Ευρετήρια για πίνακα `seriescomments`
--
ALTER TABLE `seriescomments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `FK_commuserID` (`userID`),
  ADD KEY `FK_commseriesID` (`seriesID`);

--
-- Ευρετήρια για πίνακα `seriesfav`
--
ALTER TABLE `seriesfav`
  ADD PRIMARY KEY (`favid`),
  ADD KEY `FK_favseriesID` (`seriesID`),
  ADD KEY `FK_favusersID` (`userID`);

--
-- Ευρετήρια για πίνακα `seriesrating`
--
ALTER TABLE `seriesrating`
  ADD PRIMARY KEY (`rateID`),
  ADD KEY `FK_rateseriesID` (`seriesID`),
  ADD KEY `FK_rateuserID` (`userID`);

--
-- Ευρετήρια για πίνακα `serieswish`
--
ALTER TABLE `serieswish`
  ADD PRIMARY KEY (`wishID`),
  ADD KEY `FK_seriesID` (`seriesID`),
  ADD KEY `FK_userID` (`userID`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `creditsmovies`
--
ALTER TABLE `creditsmovies`
  MODIFY `creditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT για πίνακα `creditsseries`
--
ALTER TABLE `creditsseries`
  MODIFY `creditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `moviecomments`
--
ALTER TABLE `moviecomments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT για πίνακα `movierating`
--
ALTER TABLE `movierating`
  MODIFY `rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT για πίνακα `movies`
--
ALTER TABLE `movies`
  MODIFY `MovieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT για πίνακα `moviesfav`
--
ALTER TABLE `moviesfav`
  MODIFY `favid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT για πίνακα `moviewish`
--
ALTER TABLE `moviewish`
  MODIFY `wishID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT για πίνακα `series`
--
ALTER TABLE `series`
  MODIFY `SeriesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT για πίνακα `seriescomments`
--
ALTER TABLE `seriescomments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT για πίνακα `seriesfav`
--
ALTER TABLE `seriesfav`
  MODIFY `favid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT για πίνακα `seriesrating`
--
ALTER TABLE `seriesrating`
  MODIFY `rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT για πίνακα `serieswish`
--
ALTER TABLE `serieswish`
  MODIFY `wishID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `creditsmovies`
--
ALTER TABLE `creditsmovies`
  ADD CONSTRAINT `FK_creditsmovieID` FOREIGN KEY (`movieID`) REFERENCES `movies` (`MovieId`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `creditsseries`
--
ALTER TABLE `creditsseries`
  ADD CONSTRAINT `FK_creditsseriesID` FOREIGN KEY (`seriesID`) REFERENCES `series` (`SeriesId`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `moviecomments`
--
ALTER TABLE `moviecomments`
  ADD CONSTRAINT `FK_commovieID` FOREIGN KEY (`movieID`) REFERENCES `movies` (`MovieId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_comuserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `movierating`
--
ALTER TABLE `movierating`
  ADD CONSTRAINT `FK_movratemovieID` FOREIGN KEY (`movieID`) REFERENCES `movies` (`MovieId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_movrateuserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `moviesfav`
--
ALTER TABLE `moviesfav`
  ADD CONSTRAINT `FK_favmovieID` FOREIGN KEY (`movieID`) REFERENCES `movies` (`MovieId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_favmovuserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `moviewish`
--
ALTER TABLE `moviewish`
  ADD CONSTRAINT `FK_wishmovieID` FOREIGN KEY (`movieID`) REFERENCES `movies` (`MovieId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_wishuserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `seriescomments`
--
ALTER TABLE `seriescomments`
  ADD CONSTRAINT `FK_commseriesID` FOREIGN KEY (`seriesID`) REFERENCES `series` (`SeriesId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_commuserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `seriesfav`
--
ALTER TABLE `seriesfav`
  ADD CONSTRAINT `FK_favseriesID` FOREIGN KEY (`seriesID`) REFERENCES `series` (`SeriesId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_favusersID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `seriesrating`
--
ALTER TABLE `seriesrating`
  ADD CONSTRAINT `FK_rateseriesID` FOREIGN KEY (`seriesID`) REFERENCES `series` (`SeriesId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_rateuserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `serieswish`
--
ALTER TABLE `serieswish`
  ADD CONSTRAINT `FK_seriesID` FOREIGN KEY (`seriesID`) REFERENCES `series` (`SeriesId`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
