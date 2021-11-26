CREATE DATABASE IF NOT EXISTS NFTestData;
USE NFTestData;
CREATE TABLE tests(
	id INT NOT NULL AUTO_INCREMENT, 
	accountNumber VARCHAR(50) NOT NULL, 
	testName  VARCHAR(150) NOT NULL, 
	testNameFF  VARCHAR(150) NOT NULL, 
	pathToResources VARCHAR(512) NOT NULL UNIQUE, 
	pathToTest VARCHAR(512) NOT NULL UNIQUE, 
	pathToImage1 VARCHAR(512), 
	pathToImage2 VARCHAR(512), 
	pathToImage3 VARCHAR(512), 
	pathToImage4 VARCHAR(512), 
	pathToImage5 VARCHAR(512), 
	PRIMARY KEY (id)
);