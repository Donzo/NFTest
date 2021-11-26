<html>

    <head>

    <?php 
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/meta-data.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php');
	
	?>
	<script type="text/javascript" src="/dist/web3.min.js"></script>
	
    <title>NFTest | Create Tests and Award NFTs</title>
    </head>
    <body>
		<div class="content">
			<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/header.php');?>
			<div class="content-section" id='start-div'>
				<p>NFTest is a generalized testing platform that outputs test results as NFTs.</p>
				<p>Create tests and award custom NFTs based on results.</p>
				
				<div class='home-nav-buttons'>
					<div class="nav-button" id='makeTestButton' onclick="connectWallet(1)">
						Make a Test
					</div>
					<a class="nav-button-link" href='/my-tests'><div class="nav-button">
						View Tests
					</div></a>
				</div>
				<!-- User Account Number will come here after successfully connecting -->
				<div class='userAccountNumDiv'>
					<div id='userAccountNumber'></div>
				</div>
			</div>
			
			<div id="test-maker-div"><div class="content-section questionDiv" id="q1Div"></div></div>
			<div class="content-section" id="test-maker-buttons"></div>
			<div class="content-section" id="nftMakerDiv"></div>
			<div class="content-section" id="nftMakerOptionsDiv"></div>
			
			<div class="content-section" id="nftThresholdSetter1">
				<div id="nftMakerHeaderTxt" class="cu-header-txt">Minting Threshold</div>
				<div id="nftMakerDirections" class="cu-dir1">
					What is the percentage that users must score <span style='text-decoration:underline'>GREATER THAN</span> to mint this NFT?
				</div>
				<div id='nftmnthrshControlsDiv1' class='threshold-setter-div'>
					<div class='thresholdSetterDiv'>
						<div class='thresholdSetterDir'>
							<label class='thresholdSetterLabel' for='thresholdSetter1'>
							Test Taker Must Score <span style='text-decoration:underline'>HIGHER</span> Than This Percentage to Mint: 
							</label>
						</div>
						<div class='thresholdSetterInputFieldDiv'>
							<div class='input-field-with-directions'>
								<div class='tiny-directions'>You Can Change Me</div>
								<input type='text' maxlength='2' id='thresholdSetter1' class='thresholdSetterInputField' onchange='verifyMultiValues()'>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Multi NFT Div -->
			<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/multi-nft-html.php');?>
			<!-- Multi NFT Div ended-->
			<div class="content-section" id="createTestButtonDiv">
				<div class='bigButton' id='checkTestButton' onClick='checkTest()'>CREATE YOUR TEST</div>
				<div class='mediumButton' id='addAnotherNFTButton' onClick='addAnotherNFT()'>Add Another NFT for Lower Scores</div>
				<div id='test-upload-progress-div'>
					<div id='test-upload-progress'>
						<div id='loading-wheel'>
							<img src='/images/loading-wheel.gif'>
						</div>
						<div id='upload-status-text'>
							Checking your test for blank inputs...
						</div>
					</div>
				</div>
			</div>
			<!-- Footer -->
			<div id='site-footer'>
				<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/footer-links.php'); ?>
			</div>
		<!--Following Tag Marks End of Content DIV-->
		</div>	
	</body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/useful-functions.php'); ?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/make-test.php'); ?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/upload-front.php'); ?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/connect-wallet.php'); ?>

</html>
