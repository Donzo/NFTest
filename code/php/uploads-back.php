<?php
	
	$userAccount = NULL;
	//We need the user account number for the file system so do or die
	if (isset($_POST['userAccountNum'])) {
		$userAccount = $_POST['userAccountNum'];
	}
	else{
		die("No user account sent.");
	}
	
	$imgURL1 = false;
	$imgURL2 = false;
	$imgURL3 = false;
	$imgURL4 = false;
	$imgURL5 = false;
	
	
	$baseURL = "https://nftest.net/test-taker";
	$linkToThisTest = $baseURL;
	
	//Get the test data
	$postData = $_POST['testData'];
	$data = json_decode($postData);
	
	//Title
	$testTitle = $data->testTitleInputField; 
	$formattedTitle = formatUrl($testTitle);
	

	//Img 1
	if ($data->NFT1URL){
		$imgURL1 = reset($data->NFT1URL); 
	}
	if ($data->NFT2URL){
		$imgURL2 = reset($data->NFT2URL); 
	}
	if ($data->NFT3URL){
		$imgURL3 = reset($data->NFT3URL); 
	}
	if ($data->NFT4URL){
		$imgURL4 = reset($data->NFT4URL); 
	}
	if ($data->NFT5URL){
		$imgURL5 = reset($data->NFT5URL); 
	}
	
	//Test Directory Path
	$pathToTestDir = "/var/www/nftest/tests/";
	//User Directory Path
	$pathToUserDir = "/var/www/nftest/tests/" . $userAccount;
	if (!file_exists($pathToUserDir)) {
		//Set these to less permissive when done debugging
		//mkdir($pathToUserDir, 0775, true);
	    mkdir($pathToUserDir, 0777, true);
	}
	//Path to this Test
	$pathToThisTest = $pathToUserDir . "/" . $formattedTitle;
	if (!file_exists($pathToThisTest)) {
		//Set these to less permissive when done debugging
		//mkdir($pathToUserDir, 0775, true);
	    mkdir($pathToThisTest, 0777, true);
	}
	else{
		//Append a random number to the test directory if the user is creating a test with a duplicate title.
		$randomNum = mt_rand (10,9999999999);
		$pathToThisTest = $pathToUserDir . "/" . $formattedTitle . $randomNum;
	}
	
	//Set Path for the JSON file
	$pathToUserJSON = $pathToThisTest . "/" . 'data.json';
	//Create the json file
	$jsonFile = fopen($pathToUserJSON ,"wb");
	
	//Write it to a file and put it in the directory.
	fwrite($jsonFile,$postData);
	fclose($jsonFile);
	
	//This works
	//fwrite($jsonFile, $_POST['testData']);
	


    function formatUrl($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	
	//Connect to DB
	require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');
	
	
	//Now add photos paths to DB
	if ($imgURL1 && $imgURL2 && $imgURL3 && $imgURL4 && $imgURL5){
		$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO tests (accountNumber, testName, testNameFF, pathToResources, pathToTest, pathToImage1, pathToImage2, pathToImage3, pathToImage4, pathToImage5) VALUES (:accountNumber, :testName, :testNameFF, :pathToResources, :pathToTest, :pathToImage1, :pathToImage2, :pathToImage3, :pathToImage4, :pathToImage5)");
		$my_Insert_Statement->bindValue(':accountNumber',$userAccount);
		$my_Insert_Statement->bindValue(':testName', $testTitle);
		$my_Insert_Statement->bindValue(':testNameFF', $formattedTitle);
		$my_Insert_Statement->bindValue(':pathToResources', $pathToThisTest);
		$my_Insert_Statement->bindValue(':pathToTest', $pathToUserJSON);
		$my_Insert_Statement->bindValue(':pathToImage1',$imgURL1);
		$my_Insert_Statement->bindValue(':pathToImage2', $imgURL2);
		$my_Insert_Statement->bindValue(':pathToImage3', $imgURL3);
		$my_Insert_Statement->bindValue(':pathToImage4', $imgURL4);
		$my_Insert_Statement->bindValue(':pathToImage5', $imgURL5);
		if ($my_Insert_Statement->execute()) {
			echo "New test created successfully";
		}
	}
	else if ($imgURL1 && $imgURL2 && $imgURL3 && $imgURL4){
		$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO tests (accountNumber, testName, testNameFF, pathToResources, pathToTest, pathToImage1, pathToImage2, pathToImage3, pathToImage4) VALUES (:accountNumber, :testName, :testNameFF, :pathToResources, :pathToTest, :pathToImage1, :pathToImage2,  :pathToImage3, :pathToImage4)");
		$my_Insert_Statement->bindValue(':accountNumber',$userAccount);
		$my_Insert_Statement->bindValue(':testName', $testTitle);
		$my_Insert_Statement->bindValue(':testNameFF', $formattedTitle);
		$my_Insert_Statement->bindValue(':pathToResources', $pathToThisTest);
		$my_Insert_Statement->bindValue(':pathToTest', $pathToUserJSON);
		$my_Insert_Statement->bindValue(':pathToImage1',$imgURL1);
		$my_Insert_Statement->bindValue(':pathToImage2', $imgURL2);
		$my_Insert_Statement->bindValue(':pathToImage3', $imgURL3);
		$my_Insert_Statement->bindValue(':pathToImage4', $imgURL4);
		if ($my_Insert_Statement->execute()) {
			echo "New test created successfully";
		}
	}
	else if ($imgURL1 && $imgURL2 && $imgURL3){
		$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO tests (accountNumber, testName, testNameFF, pathToResources, pathToTest, pathToImage1, pathToImage2, pathToImage3) VALUES (:accountNumber, :testName, :testNameFF, :pathToResources, :pathToTest, :pathToImage1, :pathToImage2,  :pathToImage3)");
		$my_Insert_Statement->bindValue(':accountNumber',$userAccount);
		$my_Insert_Statement->bindValue(':testName', $testTitle);
		$my_Insert_Statement->bindValue(':testNameFF', $formattedTitle);
		$my_Insert_Statement->bindValue(':pathToResources', $pathToThisTest);
		$my_Insert_Statement->bindValue(':pathToTest', $pathToUserJSON);
		$my_Insert_Statement->bindValue(':pathToImage1',$imgURL1);
		$my_Insert_Statement->bindValue(':pathToImage2', $imgURL2);
		$my_Insert_Statement->bindValue(':pathToImage3', $imgURL3);
		if ($my_Insert_Statement->execute()) {
			echo "New test created successfully";
		}
	}
	else if ($imgURL1 && $imgURL2){
		$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO tests (accountNumber, testName, testNameFF, pathToResources, pathToTest, pathToImage1, pathToImage2) VALUES (:accountNumber, :testName, :testNameFF, :pathToResources, :pathToTest, :pathToImage1, :pathToImage2)");
		$my_Insert_Statement->bindValue(':accountNumber',$userAccount);
		$my_Insert_Statement->bindValue(':testName', $testTitle);
		$my_Insert_Statement->bindValue(':testNameFF', $formattedTitle);
		$my_Insert_Statement->bindValue(':pathToResources', $pathToThisTest);
		$my_Insert_Statement->bindValue(':pathToTest', $pathToUserJSON);
		$my_Insert_Statement->bindValue(':pathToImage1',$imgURL1);
		$my_Insert_Statement->bindValue(':pathToImage2', $imgURL2);
		if ($my_Insert_Statement->execute()) {
			echo "New test created successfully";
		}
	}
	else if ($imgURL1){
		$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO tests (accountNumber, testName, testNameFF, pathToResources, pathToTest, pathToImage1) VALUES (:accountNumber, :testName, :testNameFF, :pathToResources, :pathToTest, :pathToImage1)");
		$my_Insert_Statement->bindValue(':accountNumber',$userAccount);
		$my_Insert_Statement->bindValue(':testName', $testTitle);
		$my_Insert_Statement->bindValue(':testNameFF', $formattedTitle);
		$my_Insert_Statement->bindValue(':pathToResources', $pathToThisTest);
		$my_Insert_Statement->bindValue(':pathToTest', $pathToUserJSON);
		$my_Insert_Statement->bindValue(':pathToImage1',$imgURL1);
		if ($my_Insert_Statement->execute()) {
			echo "New test created successfully";
		}
	}
	
	
	
	$my_Db_Connection  = NULL;

?>