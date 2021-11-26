<html>

    <head>
    <?php 
    	require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/useful-functions.php'); 
    ?>
    <!-- Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

	<!-- Global Meta Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<!-- OG Metatags-->
	<meta property="og:url" content="https://nftest.net/" />
	<meta property="og:title" content="NFTest | Tests That Award Custom NFTs" />
	<meta property="og:description" content="Take a test. Mint your results as an NFT." /> 
	<meta property="og:image" content="https://nftest.net/images/nftest-logo-1200x630.png" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	
	<!-- Twitter Metatags -->
	<meta name="twitter:image" content="https://nftest.net/images/nftest-logo-800x418.png">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:creator" content="@NFTestDotNet">
	<meta name="twitter:title" content="NFTest | Tests That Award Custom NFTs">
	<meta name="twitter:description" content="Take tests and earn custom NFTs based on your results.">
	
	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	
	<script>
		function getMyTests(){
			var accNumber = window['userAccountNumber'];
			var redirectHere = "https://nftest.net/my-tests?userAccountNum=" + accNumber;
			window.location.replace(redirectHere);
		}
	</script>
 <?php

	$myTests = "View all the tests that you have made here. You are not logged in or you haven't made any tests yet.";
	$userAccount = "notLoggedIn";
	//We need the user account number 
	if (isset($_GET['userAccountNum'])) {
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');
		
		$userAccount = $_GET['userAccountNum'];

		try { 
  			$my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
		} 
		catch (PDOException $error) {
  			echo 'Connection error: ' . $error->getMessage();
		}
		
		
		$myTests = "<h2>Tests That I Created</h2>";
		$stmt = $my_Db_Connection->prepare("SELECT * FROM tests WHERE accountNumber = :accountNumber"); // WHERE testNameFF = :testNameFF AND id = :id
		$stmt->bindParam(':accountNumber', $userAccount);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$myTests .= "<a href='https://nftest.net/test-taker?id=" . $row['id'] . "&testNameFF=" . $row['testNameFF'] . "'>". $row['testName'] . "</a><br />";
		}
		
		$myResults = "<h2>Tests That I've Taken</h2>";
		$stmt2 = $my_Db_Connection->prepare("SELECT * FROM testResults WHERE accountNumber = :accountNumber");
		$stmt2->bindParam(':accountNumber', $userAccount);
		$stmt2->execute();
		$testNames = array();
		while ($row = $stmt2->fetch()) {
			//Print my test results, do not duplicate
			if (!in_array($row['testID'], $testNames) && $row['cap'] > 0 && $row['testName']){
				$myResults .= "<a href='https://nftest.net/my-results?testID=" . $row['testID'] . "&resultsID=". $row['id'] . "&userAccNum=". $userAccount . "&testNameFF=" . $row['testNameFF'] . "'>". $row['testName'] . "</a> - ". $row['cap']."% Correct<br />";
    			array_push($testNames, $row['testID']);
			}
		}
		
		$my_Db_Connection = NULL;
		

	}

	
?>    
   
    	<?php 
    	//require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/pdo-test.php');
    	?>
    <?php 
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php');
		
	?>
	<script type="text/javascript" src="/dist/web3.min.js"></script>
	
    <title>NFTest | My Tests</title>
    </head>
    <body>
		<div class="content">
			<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/header.php');?>
			<div class="content-section" id='start-div'>
					<div id='featured-test-div' class='test-group-div'>
			
						<h2>Featured Tests</h2>
						<p>
							<a href='https://nftest.net/test-taker/?id=14&testNameFF=the-oracle-problem'>
								The Oracle Problem Test
							</a>
						</p>
						<p>
							<a href='https://nftest.net/test-taker?id=20&testNameFF=avax-defi-test'>
								Avax DeFi Test
							</a>
						</p>
						<p>
							<a href='https://nftest.net/test-taker/?id=21&testNameFF=polygon-defi-test'>
								Polygon DeFi Test
							</a>
						</p>
					</div>						
				<?php
					echo "<div class='test-group-div' id='my-tests-group-div'>" . $myTests . "</div>";
					echo "<div class='test-group-div' id='my-results-group-div'>" . $myResults . "</div>";
					
				?>
				<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/return-my-nft-url.php'); ?>
				<div class='home-nav-buttons'>
					<!--div class="nav-button">Take a Test</div-->
					<div class="nav-button" id='myTestsButton' onclick="connectWallet(3)">View My Tests</div>
				</div>
				<!-- User Account Number will come here after successfully connecting -->
				<div class='userAccountNumDiv'>
					<div id='userAccountNumber'></div>
				</div>
			</div>
			<div id='site-footer'>
				<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/footer-links.php'); ?>
			</div>
		<!--Following Tag Marks End of Content DIV-->
		</div>	
	</body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/connect-wallet.php'); ?>

	
</html>
