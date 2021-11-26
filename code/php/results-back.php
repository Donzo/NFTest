<?php
	
	$userAccount = NULL;
	if (isset($_POST['userAccountNum'])) {
		$userAccount = $_POST['userAccountNum'];
	}
	else{
		die("No user account sent.");
	}
	
	/*********
	Create folders and JSON file
	*********/
	$nameOfTest = $_POST['testName'];
	$formattedTitle = $_POST['testNameFF'] . "-" . $_POST['testID'];
	$testID = $_POST['testID'];
	$answersRight = $_POST['answersRight'];
	$answersWrong = $_POST['answersWrong'];
	$cap = $_POST['cap'];
	$NFTIMGLink = $_POST['myNFTIMGLink'];
	
	//Get the test data
	$postData = $_POST['testResults'];
	$data = json_decode($postData);

	//User Directory Path
	$pathToUserDir = "/var/www/nftest/test-results/" . $userAccount;
	if (!file_exists($pathToUserDir)) {
		//Set these to less permissive when done debugging
		//mkdir($pathToUserDir, 0775, true);
	    mkdir($pathToUserDir, 0777, true);
	}
	//Path to this Test
	$pathToTheseResults = $pathToUserDir . "/" . $formattedTitle;
	if (!file_exists($pathToTheseResults)) {
		//Set these to less permissive when done debugging
		//mkdir($pathToUserDir, 0775, true);
	    mkdir($pathToTheseResults, 0777, true);
	}
	
	//Set Path for the JSON file
	$pathToUserJSON = $pathToTheseResults . "/" . 'data.json';
	//Create the json file
	$jsonFile = fopen($pathToUserJSON ,"wb");
	
	$wwwPathToUserJSON = str_replace("/var/www/nftest","",$pathToUserJSON);
		
	//Write it to a file and put it in the directory.
	fwrite($jsonFile,$postData);
	fclose($jsonFile);

	$testNameFF = $_POST['testNameFF'];

	//Connect to DB
	require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');
	
	$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO testResults (accountNumber, testName, testNameFF, testID, answersRight,answersWrong, cap, pathToMyResults, NFTimg) VALUES (:accountNumber, :testName, :testNameFF, :testID, :answersRight, :answersWrong, :cap, :pathToMyResults, :NFTimg)");

	$my_Insert_Statement->bindValue(':accountNumber',$userAccount);
	$my_Insert_Statement->bindValue(':testName', $nameOfTest);
	$my_Insert_Statement->bindValue(':testNameFF', $testNameFF);
	$my_Insert_Statement->bindValue(':testID', $testID);
	$my_Insert_Statement->bindValue(':answersRight', $answersRight);
	$my_Insert_Statement->bindValue(':answersWrong', $answersWrong);
	$my_Insert_Statement->bindValue(':cap', $cap);
	$my_Insert_Statement->bindValue(':pathToMyResults', $wwwPathToUserJSON);
	$my_Insert_Statement->bindValue(':NFTimg', $NFTIMGLink);
	if ($my_Insert_Statement->execute()) {
		echo "New test created successfully";
	}
	
	$my_Db_Connection  = NULL;

?>