
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `caption` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `account`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `shared` (
    `user_id` int(11) NOT NULL,
    `image_id` int(11) NOT NULL,
    FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;