<?php

	//Get Post Data
	$userAccount = $_POST['userAccountNum'];
	$testID = $_POST['testID'];
	//$testNameFF = $_POST['testNameFF']; 
		
	//Connect to DB
	require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');
		
	
	$stmt = $my_Db_Connection->prepare("SELECT * FROM testResults WHERE accountNumber = :accountNumber AND testID = :testID"); // WHERE testNameFF = :testNameFF AND id = :id
	$stmt->bindParam(':accountNumber', $userAccount);
	$stmt->bindParam(':testID', $testID);
	//$stmt->bindParam(':testNameFF', $testNameFF);
		
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		$myTest = "/my-results?resultsID=" . $row['id'] . "&userAccNum=" . $row['accountNumber'] . "&testNameFF=" . $row['testNameFF'] . "&testID=". $row['testID'];
	}
	print $myTest;
?>