CREATE DATABASE IF NOT EXISTS chats;
USE chats; 

CREATE TABLE IF NOT EXISTS users
(
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO users 
    (id, username) 
VALUES 
    (1,"lenpaprocki"),
    (2,"roxcampain");


CREATE TABLE IF NOT EXISTS chats
(
	id INT NOT NULL AUTO_INCREMENT,
	ownerId INT NOT NULL,
	text VARCHAR(255) NOT NULL,
	`timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (ownerId) REFERENCES users(id)
);

INSERT INTO chats 
    (ownerId, text) 
VALUES 
    (1,"Leota Dilliard"),
    (2,"Abel Maclead"),
    (1,"Kiley Caldarera"),
    (2,"Maryann Royster"),
    (1,"Veronika Inouye"),
    (2,"Willow Kusko"),
    (1,"Rozella Ostrosky"),
    (2,"Alishia Sergi"),
    (1,"Kanisha Waycott"),
    (2,"Jose Stockham");