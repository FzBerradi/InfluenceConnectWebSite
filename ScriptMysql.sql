-- Create the database
CREATE DATABASE brandsInfluencers;

-- Use the database
USE brandsInfluencers;


-- Create the user table
CREATE TABLE user (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  firstName VARCHAR(255),
  lastName VARCHAR(255) ,
  userName VARCHAR(255) ,
  Password VARCHAR(255),
  Email VARCHAR(255),
  PhoneNumber VARCHAR(20),
  ImageProfile VARCHAR(255),
  ImageCover VARCHAR(255),
  Location VARCHAR(255) ,
  discription VARCHAR(255),
  Website VARCHAR(255),
  confirmed BOOLEAN,
  isAdmin BOOLEAN,
  isBrand BOOLEAN,
  isInfluencer BOOLEAN,
  tk varchar(255),
  ig varchar(255),
  fb varchar(255),
  gender varchar(255),
  ca int null,
  address varchar(255),
  age int null

);




-- Create the Partnership table
CREATE TABLE Partnership (
  PartnershipID INT PRIMARY KEY AUTO_INCREMENT,
  BrandID INT NOT NULl,
  InfluencerID INT NOT NULL,
  brandConfirmed BOOLEAN ,
  InfluencerConfirmed BOOLEAN,
  price int NOT NULL,
  StartDate DATE NOT NULL,
  EndDate DATE NOT NULL,
  description varchar(255),
  Status VARCHAR(255) NOT NULL,
  CONSTRAINT fk_BrandID FOREIGN KEY (BrandID) REFERENCES user(ID) ON DELETE CASCADE,
  CONSTRAINT fk_InfluencerID FOREIGN KEY (InfluencerID) REFERENCES user(ID) on DELETE CASCADE
);



-- Create the Messages table
CREATE TABLE Messages (
  MessageID INT PRIMARY KEY AUTO_INCREMENT,
  SenderID INT NOT NULL,
  RecipientID INT NOT NULL,
  MessageText VARCHAR(1000) NOT NULL,
  SentTime DATETIME NOT NULL,
  CONSTRAINT fk_SenderID FOREIGN KEY (SenderID) REFERENCES user(ID)  on DELETE CASCADE ,
  CONSTRAINT fk_RecipientID FOREIGN KEY (RecipientID) REFERENCES user(ID)  on DELETE CASCADE
);


CREATE TABLE account_deletion (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  reason VARCHAR(255)NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(ID) ON DELETE CASCADE
);



INSERT INTO user (ID ,firstName, lastName, userName, Password, Email, PhoneNumber, ImageProfile, ImageCover, Location, discription, Website, confirmed, isAdmin, isBrand, isInfluencer, tk, ig, fb, gender, ca, address, age)
VALUES (1,'admin', 'admin', '', '$2y$10$RcnFlSjiHlJDcj6Lm6liTe/rQBK5AmWB3aozjSg46rkz5cRuHnuRe', 'fatimazahra.bamhaouch@gmail.com', ''			  , ''		    , '','', ''		      , ''			,1, 1, NULL, NULL, ''    , ''		, ''	 , ''	  , null	  , 'rabat'  ,null),
       (2,'admin', 'admin', '', '$2y$10$RcnFlSjiHlJDcj6Lm6liTe/rQBK5AmWB3aozjSg46rkz5cRuHnuRe', 'Benaouda.salma4@gmail.com'		, ''		  , ''		    , '','', ''		      , ''			,1, 1, NULL, NULL, ''    , ''		, ''	 , ''	  , null	  , 'casa'	 , null),
       (3,'admin', 'admin', '', '$2y$10$RcnFlSjiHlJDcj6Lm6liTe/rQBK5AmWB3aozjSg46rkz5cRuHnuRe', 'fatimazohraberradi1@gmail.com'	, ''		  , ''		    , '','', ''		   	  , ''		    ,1, 1, NULL, NULL, ''    , ''		, ''	 , ''	  , null	  , 'martil' , null),
       (4,'nike', ''		, '', '$2y$10$5i2EavbAOgNw2Su/utk40es0x0Bu58h0PxS1ZxCA78H6tEjE.5QQa', 'nike@nike.com'					, '8888888888', 'nike.jpg'  , '','', 'nike brand' , 'nike.com'  ,1, NULL, 1, NULL, ''    , ''		, ''	 , ''	  , '2000', 'tetouan', null),
       (5,'gucci', ''		, '', '$2y$10$5i2EavbAOgNw2Su/utk40es0x0Bu58h0PxS1ZxCA78H6tEjE.5QQa', 'gucci@gucci.com'					, '2020202020', 'gucci.png' , '','', 'gucci brand', 'gucci.com' ,1, NULL, 1, NULL, ''	   , ''		, ''	 , ''	  , '2000', 'USA'	 , null),
       (6,'jack', 'marcos', '', '$2y$10$7NDnVtOdMjdmwmzM1UZ/jO1K1GiPIy6zKXx8NsyMRaoGTgAKIE0Tm', 'jack@gmail.com'					, '1212121212', 'team-2.jpg', '','', ''		      , ''			,1,NULL, NULL, 1,'@lora', '@jack', '@luna', 'femme', null	  , 'rabat'	 , '22'),
       (7,'lora', 'json', ''	, '$2y$10$HeGDXgdaCBiXEwyFzH2Ev.XVx1iuHhxpTogZFtHKkULRqjrSpxTCm', 'lora@gmail.com'					, '5555555555', 'team-1.jpg', '','', ''		      , ''			,1, NULL, NULL, 1,'@lora', '@lora', '@lora', 'homme', null	  , 'casa'	 , 25);


INSERT INTO Partnership (BrandID, InfluencerID, brandConfirmed, InfluencerConfirmed, price, StartDate, EndDate, description, Status) 
VALUES (5, 6, 1, 1, 50000, '2023-03-31', '2023-04-27', 'hi i want to create contract with us', 'confirmed'),
       (4, 7, 1, null, 30000, '2023-04-06', '2023-05-03', 'can we create contract', '0');

INSERT INTO account_deletion (user_id, reason)
VALUES (4, 'I no longer need this account.'),
       (7, 'I have switched to a different platform.');



INSERT INTO Messages (MessageID, SenderID, RecipientID, MessageText, SentTime)
VALUES 
(6, 4, 6, 'hello can we create a contract', '2023-04-29 13:41:54'),
(7, 4, 6, 'if you want', '2023-04-29 13:42:02'),
(8, 6, 4, 'yeah ofc', '2023-04-29 13:42:47'),
(9, 6, 4, 'give me ur number and i will call you later', '2023-04-29 13:43:05');

