CREATE TABLE Tdl_User(
   UserID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   Nom VARCHAR(50)  NOT NULL,
   Prénom VARCHAR(50) ,
   Email VARCHAR(50)  NOT NULL,
   Password VARCHAR(255)  NOT NULL
);
ALTER TABLE Tdl_User ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE Tdl_Priority(
   PriorityID INT NOT NULL PRIMARY KEY auto_increment,
   Nom VARCHAR(50)  NOT NULL
);
ALTER TABLE Tdl_Priority ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE Tdl_Category(
   CategoryID INT NOT NULL PRIMARY KEY auto_increment,
   Nom VARCHAR(50)  NOT NULL
);
ALTER TABLE Tdl_Category ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE Tdl_Task(
   TaskID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   Titre VARCHAR(100)  NOT NULL,
   Description VARCHAR(300) ,
   Echéance DATE NOT NULL,
   PriorityID INT NOT NULL,
   UserID INT NOT NULL,
   FOREIGN KEY(PriorityID) REFERENCES Tdl_Priority(PriorityID),
   FOREIGN KEY(UserID) REFERENCES Tdl_User(UserID)
);
ALTER TABLE Tdl_Task ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE Appartient(
   TaskID INT,
   CategoryID INT,
   PRIMARY KEY(TaskID, CategoryID),
   FOREIGN KEY(TaskID) REFERENCES Tdl_Task(TaskID),
   FOREIGN KEY(CategoryID) REFERENCES Tdl_Category(CategoryID)
);
ALTER TABLE Appartient ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO Tdl_Category (CategoryID, Nom) VALUES ('Personnel');
INSERT INTO Tdl_Category (CategoryID, Nom) VALUES ('Famille');
INSERT INTO Tdl_Category (CategoryID, Nom) VALUES ('Travail');
INSERT INTO Tdl_Category (CategoryID, Nom) VALUES ('Amis');
INSERT INTO Tdl_Category (CategoryID, Nom) VALUES ('Autre');

INSERT INTO Tdl_Priority (PriorityID, Nom) VALUES ('Basse');
INSERT INTO Tdl_Priority (PriorityID, Nom) VALUES ('Moyenne');
INSERT INTO Tdl_Priority (PriorityID, Nom) VALUES ('Haute');
INSERT INTO Tdl_Priority (PriorityID, Nom) VALUES ('Ultime');