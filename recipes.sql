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
create table if not EXISTS `Dietary_Preference`(
    `PreferenceID` int not null AUTO_INCREMENT,
    `PreferenceName` varchar(50) not null,
    primary key (`PreferenceID`)
);
insert into `Dietary_Preference` (`PreferenceName`)
values ('Lactose Free'), ('Vegan'),('Gluten Free'),
('Vegetarian'),('No Preference');

create table `Cuisine`(
    `CuisineID` int not null AUTO_INCREMENT,
    `Description` varchar(75) not null,
    primary key (`CuisineID`)
);

insert into `Cuisine` (`Description`) values 
('American'), ('Canadian'), ('Mexican'), ('Italian'),
('Viatnamese'), ('French');

insert into `Cuisine` (`Description`) values
('Dessert');
create table if not Exists `Recipe`(
    `RecipeID` int AUTO_INCREMENT not null,
    `Name` varchar(50) not null,
    `Description` varchar (100),
    `Instructions` varchar(500) not null,
    `Ingredients` varchar (500),
    `DateCreated` date not null,
    `DateUpdated` date,
    `UserID` int not null,
    `CuisineID` int not null,
    `PreferenceID` int not null,
    primary key(`RecipeID`),
    foreign key (`UserID`) references `USER`(`UserID`)
    on update CASCADE 
    on delete no action ,  
    foreign key (`PreferenceID`) references `Dietary_Preference`(`PreferenceID`)
    on update CASCADE 
    on delete no action,   
     foreign key (`CuisineID`) references `Cuisine`(`CuisineID`)
    on update CASCADE 
    on delete no action  
);

INSERT INTO `USER` (`FirstName`, `LastName`, `Email`, `UserName`, `RegistrationDate`, `Password`)
VALUES 
('John', 'Doe', 'john.doe@hotmail.com', 'johndoe', '2025-03-21', 'password123'),
('Jane', 'Smith', 'jane.smith@gmail.com', 'janesmith', '2025-03-20', '123ABC'),
('Alice', 'Johnson', 'alice.johnson@yahoo.com', 'alicej', '2025-03-18', 'mypassword'),
('Bob', 'Williams', 'bob.williams@outlook.com', 'bobbyw', '2025-03-19', 'bobspass');


INSERT INTO `Recipe` (`Name`, `Description`, `Instructions`, `Ingredients`, `DateCreated`, `DateUpdated`, `UserID`, `CuisineID`, `PreferenceID`)
VALUES 
('Chocolate Cake', 'A rich and moist chocolate cake', '1. Preheat oven. 2. Mix ingredients. 3. Bake for 30 minutes.','chocolate, butter, flour','2025-03-21', '2025-03-21', 1, 7, 5),
('Spaghetti Bolognese', 'A classic Italian pasta dish', '1. Cook pasta. 2. Prepare sauce. 3. Combine and serve.', 'noodles, tomatoes, beef','2025-03-21', '2025-03-21', 2, 4, 3),
('Grilled Cheese Sandwich', 'A simple and delicious sandwich', '1. Heat pan. 2. Butter bread. 3. Grill with cheese until golden brown.', 'cheese, bread, butter','2025-03-19', '2025-03-19', 3, 1, 5),
('Caesar Salad', 'A fresh and crispy salad with Caesar dressing', '1. Toss lettuce with dressing. 2. Add croutons and cheese.', 'lettuce, parmesan, crutons','2025-03-18', '2025-03-18', 4, 4, 4);

create table `Favorite_Recipe`(
    `RecipeID` int not null,
    `UserID` int not null,
    primary key (`RecipeID`,`UserID`),
    foreign key (`RecipeID`) references `Recipe`(`RecipeID`),
    foreign key (`UserID`) references `USER`(`UserID`)
);

alter table `USER` 
add column PreferenceID int null;

alter table `USER`
add constraint `PreferenceID_FK`
foreign key (`PreferenceID`) references `Dietary_Preference`(`PreferenceID`)
on delete set null;

insert into `Favorite_Recipe` (`RecipeID`, `UserID`) values (1,1),(2,1);








