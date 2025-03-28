DROP DATABASE if EXISTS assignment2;
CREATE DATABASE assignment2;
GRANT ALL PRIVILEGES ON assignment2.* TO 'root'@'localhost';
FLUSH PRIVILEGES;

USE assignment2;

create table if not EXISTS `USER`(
    `UserID` int  AUTO_INCREMENT not null,
    `FirstName` varchar(50) not null,
    `LastName` varchar(50) not null,
    `Email` varchar(50) not null,
    `UserName` varchar(20) not null,
    `RegistrationDate` date not null,
    `Password` varchar(20) not null,
    primary key (`UserID`)
);

create table if not Exists `Recipe`(
    `RecipeID` int AUTO_INCREMENT not null,
    `Name` varchar(50) not null,
    `Description` varchar (100),
    `Instructions` varchar(500) not null,
    `DateCreated` date not null,
    `DateUpdated` date,
    `UserID` int not null,
    primary key(`RecipeID`),
    foreign key (`UserID`) references `USER`(`UserID`)
    on update CASCADE 
    on delete no action
);
use assignment2;
INSERT INTO `USER` (`FirstName`, `LastName`, `Email`, `UserName`, `RegistrationDate`, `Password`)
VALUES 
('John', 'Doe', 'john.doe@hotmail.com', 'johndoe', '2025-03-21', 'password123'),
('Jane', 'Smith', 'jane.smith@gmail.com', 'janesmith', '2025-03-20', '123ABC'),
('Alice', 'Johnson', 'alice.johnson@yahoo.com', 'alicej', '2025-03-18', 'mypassword'),
('Bob', 'Williams', 'bob.williams@outlook.com', 'bobbyw', '2025-03-19', 'bobspass');

use assignment2;
INSERT INTO `Recipe` (`Name`, `Description`, `Instructions`, `DateCreated`, `DateUpdated`, `UserID`)
VALUES 
('Chocolate Cake', 'A rich and moist chocolate cake', '1. Preheat oven. 2. Mix ingredients. 3. Bake for 30 minutes.', '2025-03-21', '2025-03-21', 1),
('Spaghetti Bolognese', 'A classic Italian pasta dish', '1. Cook pasta. 2. Prepare sauce. 3. Combine and serve.', '2025-03-21', '2025-03-21', 2),
('Grilled Cheese Sandwich', 'A simple and delicious sandwich', '1. Heat pan. 2. Butter bread. 3. Grill with cheese until golden brown.', '2025-03-19', '2025-03-19', 3),
('Caesar Salad', 'A fresh and crispy salad with Caesar dressing', '1. Toss lettuce with dressing. 2. Add croutons and cheese.', '2025-03-18', '2025-03-18', 4);