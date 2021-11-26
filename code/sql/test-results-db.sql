CREATE DATABASE IF NOT EXISTS NFTestData;
USE NFTestData;
CREATE TABLE testResults(
	id INT NOT NULL AUTO_INCREMENT, 
	accountNumber VARCHAR(50) NOT NULL, 
	testName VARCHAR(150), 
	testNameFF VARCHAR(150), 
	testID INT, 
	answersRight INT, 
	answersWrong INT, 
	cap INT, 
	pathToMyResults VARCHAR(512),
	NFTimg VARCHAR(512), 
	PRIMARY KEY (id)
);