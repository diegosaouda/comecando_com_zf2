-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 02-Set-2013 às 21:19
-- Versão do servidor: 5.5.31
-- versão do PHP: 5.4.4-14+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de Dados: `local.curso.forseti`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `album`
--

INSERT INTO `album` (`id`, `artist`, `title`) VALUES
(8, 'Metallica', 'St. Anger');

-- --------------------------------------------------------

--
-- Estrutura da tabela `album_music`
--

CREATE TABLE IF NOT EXISTS `album_music` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `album_music`
--

INSERT INTO `album_music` (`id`, `album_id`, `name`) VALUES
(1, 8, 'Frantic'),
(2, 8, 'St. Anger'),
(3, 8, 'Some Kind Of Monster'),
(4, 8, 'Dirty Window'),
(5, 8, 'Invisible Kid'),
(6, 8, 'My World'),
(7, 8, 'Shoot Me Again'),
(8, 8, 'Sweet Amber'),
(9, 8, 'The Unnamed Feeling'),
(10, 8, 'Purify'),
(11, 8, 'All Within My Hands');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `album_music`
--
ALTER TABLE `album_music`
  ADD CONSTRAINT `album_music_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`);
