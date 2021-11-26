<html>
    <head>
    <?php
    	require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/useful-functions.php');
    	//Connect to DB
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');
		
		
		$id = "Error";
		$testNameFF = "Error";

		if ($_GET['id']){
			$id = $_GET['id'];	
		}
		if ( $_GET['testNameFF']){
			$testNameFF = $_GET['testNameFF'];	
		}


		$getTestData = $my_Db_Connection->prepare("SELECT * FROM tests WHERE testNameFF = :testNameFF AND id = :id"); 
		$getTestData->bindParam(':testNameFF', $testNameFF);
		$getTestData->bindParam(':id', $id);
		$getTestData->execute();
		$testData = $getTestData->fetch(PDO::FETCH_ASSOC);
		if ($testData) {

	 		echo  "<div id='nothing-to-see-here'><script>var testData = '" . addslashes(file_get_contents($testData['pathToTest'])) . "';</script></div>";
	 		if ($testData['pathToImage1']){
	 			echo  "<script>var imgURI1 = '" . $testData['pathToImage1'] . "';";
	 		}
	 		if ($testData['pathToImage2']){
	 			echo  "var imgURI2 = '" . $testData['pathToImage2'] . "';";
	 		}
	 		if ($testData['pathToImage3']){
	 			echo  "var imgURI3 = '" . $testData['pathToImage3'] . "';";
	 		}
	 		if ($testData['pathToImage4']){
	 			echo  "var imgURI4 = '" . $testData['pathToImage4'] . "';";
	 		}
			if ($testData['pathToImage5']){
	 			echo  "var imgURI5 = '" . $testData['pathToImage5'] . "';";
	 		}
	 		echo "var testNameFF = '" . $testData['testNameFF'] . "'; var testID = '" . $testData['id']  . "'; </script>";
		} 
		$my_Db_Connection  = NULL;
		
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/meta-data.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/test-taker-style.php');
		
	?>
	<script type="text/javascript" src="/dist/web3.min.js"></script>
	
    <title>NFTest |Take a Test and Mint Your Results as an NFT</title>
    </head>
    <body>
		<div class="content">
			<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/header.php');?>
			<div class="content-section" id='start-div'>
				<div id='test-title'>
				</div>
				<div id='test-description'>
				</div>
				<div id='test-stats'>
				&nbsp;
				</div>
				<?php 
					//Get the test data
					require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/test-taker.php'); 
				?>
				<div class='home-nav-buttons'>
					<div class="nav-button" id='takeTestButton' onclick="connectWallet(2)">Take This Test</div>
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
			require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/results-front.php');	
			require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/get-test-data.php');	
			
	?>
	
</html>
