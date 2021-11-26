<html>
    <head>
    <?php
    	
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/useful-functions.php');
				
		if ($_GET['userAccNum'] && $_GET['resultsID'] && $_GET['testID'] && $_GET['testNameFF']){
			//Connect to DB
			require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');
		
			$testID = $_GET['testID'];
			$resultsID = $_GET['resultsID'];
			$testNameFF = $_GET['testNameFF'];
			$userAccNum = $_GET['userAccNum'];
			
			
			

			$getTestData = $my_Db_Connection->prepare("SELECT * FROM testResults WHERE id = :id AND accountNumber = :accountNumber AND testID = :testID "); 
			$getTestData->bindParam(':testID', $testID);
			$getTestData->bindParam(':id', $resultsID);
			$getTestData->bindParam(':accountNumber', $userAccNum);
			$getTestData->execute();
			$testData = $getTestData->fetch(PDO::FETCH_ASSOC);
			if ($testData) {
	 			echo  "<script>var testName = '" . $testData['testName'] . "';";
	 			echo  "var testNameFF = '" . $testData['testNameFF'] . "';";
	 			echo  "var resultsID = '" . $testData['id'] . "';";
	 			echo  "var testID = '" . $testData['testID'] . "';";
	 			echo  "var ogUser = '" . $testData['accountNumber'] . "';";
	 			echo  "var answersRight = '" . $testData['answersRight'] . "';";
	 			echo  "var answersWrong = '" . $testData['answersWrong'] . "';";
	 			echo  "var cap = '" . $testData['cap'] . "';";
	 			echo  "var pathToMyResults = '" . $testData['pathToMyResults'] . "';";
	 			echo  "var NFTimg = '" . $testData['NFTimg'] . "';</script>";
	 		
	 		}
			$my_Db_Connection  = NULL;			
		}
		else{
			die("Oh man... What are you doing?");
		}
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/meta-data.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/test-taker-style.php');
		
	?>
	<style>
		#progress-div{
			font-size:2em;
			line-height:2em;
		}
		#loading-wheel, #connection-in-progress {
			overflow-wrap: break-word;
			word-break: break-all;
		}
	</style>
	<script type="text/javascript" src="/dist/web3.min.js"></script>
	
    <title>NFTest |Take a Test and Mint Your Results as an NFT</title>
    	<script>
    		//Get the ABI
    		var abi = JSON.stringify(<?php echo $abi?>); 
    	</script>
    </head>
    <body>
		<div class="content">
			<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/header.php');?>
			<div class="content-section" id='title-of-test-div'>
				<!-- Title Goes Here-->
			</div>
			<div class="content-section">
				<div id='nft-img-div'>
					<!-- NFT IMG Goes Here-->
					<img id='nft-img-results-page' src='/images/loading-wheel.gif'>
				</div>
				<h2 class='header-txt'>NFT Image</h2>
			</div>
			<div class='content-section' id='stats-div'>
				<h2 class='header-txt'>Test Results</h2>
				<div id='stats-container-div'>
					<div class='stat-item' id='qsRight'>
						<!--Qs right goes here-->
					</div>
					<div class='stat-item' id='qsWrong'>
						<!--Qs right goes here-->
					</div>
					<div class='stat-item' id='cap'>
						<!--Qs right goes here-->
					</div>
					<div class='stat-item' id='my-results-link-container'>
						<div id='my-results-link'></div>
					</div>
				</div>
				
			</div>
			<div class="content-section" id='start-div'>
				<div id='my-results-connect-button' class='home-nav-buttons'>
					<!--div class="nav-button">Take a Test</div-->
					<div class="nav-button" id='mintTestButton' onclick="connectWallet(4)">Connect Wallet to Mint</div>
					<div id='loading-wheel'>
						<img id='connection-in-progress' src='/images/loading-wheel.gif'>
					</div>
				</div>
				<!-- User Account Number will come here after successfully connecting -->
				<div class='userAccountNumDiv'>
					<div id='userAccountNumber'></div>
				</div>
			</div>
			
			<?php
				
				require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/footer-links.php');
			?>
			<div id='site-footer'>
				<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/footer-links.php'); ?>
			</div>
		<!--Following Tag Marks End of Content DIV-->
		</div>	
	</body>
	
	<?php 
			require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/connect-wallet.php');
			require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/load-results.php');	
			
	?>
	
</html>
