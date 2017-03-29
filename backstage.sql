SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `customer` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;