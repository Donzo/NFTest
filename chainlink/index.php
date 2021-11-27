<html>
    <head>
	<?php
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/meta-data.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/test-taker-style.php');
	?>
	<style>
		#connection-in-progress{
			overflow-wrap: break-word;
		}
		#progress-div{
			font-size:2em;
			line-height:2em;
		}
	</style>
	<script type="text/javascript" src="/dist/web3.min.js"></script>
	
	<script>
		var apiURLBase = "https://nftest.net/pass-api/?";
		var paramKey1 = "uAN=";
		var paramKey2 = "&tID=";
		var paramKey3 = "&pp=";
		var paramValue1 = "";
		var paramValue2 = "";
		var paramValue3 = "";
		var chainId = false;
		var passing = null;
		
		function callAPI(){
			if (document.getElementById("uAN").value && document.getElementById("tID").value && document.getElementById("passingScore").value){
				paramValue1 = document.getElementById("uAN").value;
				paramValue2 = document.getElementById("tID").value;
				paramValue3 = document.getElementById("passingScore").value;
				
				var apiURL = apiURLBase + paramKey1 + paramValue1 + paramKey2 + paramValue2 + paramKey3 + paramValue3;
				window['apiURL'] = apiURL;
				
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						// Typical action to be performed when the document is ready:
						document.getElementById("apiReturn").innerHTML = xhttp.responseText;
						passing = xhttp.responseText;
						var sendToLinkNodeButton = document.getElementById("sendToLinkNodeButton");
  						sendToLinkNodeButton.classList.remove("disabledButton");
   					}
				};
				xhttp.open("GET", apiURL, true);
				xhttp.send();
			}
			else{
				alert('You must enter values into all the fields to call this API.')
			}
		}
		
		async function getWallet() {	
			const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
			const account = accounts[0];
				
			if (account){
				//Loading wheel;
				document.getElementById('connection-in-progress').style.display = "flex";	
				//userAccountNumber.innerHTML = "User Account: " + "<a href='/my-tests'>" + account + "</a>";
				window['userAccountNumber'] = account;
				//Create Web3 Object
				let web3 = new Web3(Web3.givenProvider);
									
				//Get Provider
				web3.eth.net.getId().then(
					function(value) {
						provider = value;
						reportProvider();
  						console.log('provider: ' + provider);  							
  					}	
  				);
  					
			}
			else{
				alert("I can't connect to your wallet!");
			}
		}
		function reportProvider(){
			if (window.ethereum) {
  		 		chainId = window.ethereum.chainId;
  		 		console.log('chainID = ' + chainId)
			}
			if (chainId == "0xa86a" || provider == 43114){
				networkName = "avalanche";
				console.log('User is on Avalanche C-Chain.');
				switchToKovan();
			}
			else if (chainId == "0x1" || provider == 1){
  				console.log('User is on Ethereum Mainnet.');
  				networkName = "ethereum";
  				switchToKovan();
  			}
  			else if (chainId == "0x2a" || provider == 42){
  				console.log('Good job, user, you are on the right network!');
  				networkName = "kovan";
  				sendTheData();
  			}
  			else if (chainId == "0x89" || provider == 137){
  				console.log('User is on Polygon Network.');
  				networkName = "polygon";
  				switchToKovan();
  			}
  			else if (chainId == "0x4" || provider == 4){
  				console.log('User is on Rinkeby Testnet.');
  				networkName = "rinkeby";
  				switchToKovan();
  			}
  			else if (chainId == "0xa4b1" || provider == 42161){
  				console.log('User is on Arbitrum.');
  				networkName = "arbitrum";
  				switchToKovan();
  			}
  			else{
  				console.log('User is on unhandled network with ID number ' + provider + ' and chainid ' + chainId + '.');
  				switchToKovan();
  			}
  			
		}
		async function switchToKovan(){
			
			//Kovan
			var theChainID = '0x2a';
			var theRPCURL = 'https://kovan.infura.io';
			var nn = "kovan";
			
			try {
					await window.ethereum.request({
						method: 'wallet_switchEthereumChain',
						params: [{ chainId: theChainID }],
					});
				} catch (switchError) {
  				// This error code indicates that the chain has not been added to MetaMask.
				if (switchError.code === 4902) {
					try {
						await window.ethereum.request({
							method: 'wallet_addEthereumChain',
							params: [{ chainId: theChainID, rpcUrl: theRPCURL}],
						});
					}
					catch (addError) {
				
					}
				}
			}
			finally{
				sendTheData();
			}
			
		}
		function sendTheData(){
			networkName = "Kovan Testnet";
			contractAddress = "0x6cb3742731107DDEc3ebDc40f87afd4f00E673FF";
			checkThisID = 'snKovan';
			buttonName = 'kovan';
			
			
			let web3 = new Web3(Web3.givenProvider);
			var contract = new web3.eth.Contract(abi, contractAddress, {
				from: window['userAccountNumber'],
				//gasPrice: '20000000000'
			});
			//var metadataURI = "https://nftest.net" + pathToMyResults;
			
			
			contract.methods.setNewRequest(window['apiURL']).send({
				from: window['userAccountNumber']
			}, function(){
				var progressDiv = document.getElementById('progress-div');
				progressDiv.style.margin = ".25em";	
				progressDiv.style.textAlign = "center";	
				progressDiv.style.color = "#FAF566";	
				progressDiv.innerHTML = "Setting New API Request | Mining Transaction...";
			})
			.once('receipt', function(receipt){
				callTheNextThing();
				//console.log(Object.keys(receipt));
				//Loading wheel;
				var infoDiv = document.getElementById('connection-in-progress');
				var progressDiv = document.getElementById('progress-div');
				progressDiv.style.margin = "1.5em 0em .25em 0em";
				progressDiv.style.color = "lime";	
				progressDiv.innerHTML = "Transaction Mined";
				infoDiv.style.display = 'block';
				infoDiv.innerHTML = "<p style='text-align:center;'>Hash</p><p><a href='https://kovan.etherscan.io/tx/" + receipt.transactionHash + "' target='_new'> "+ receipt.transactionHash + "</a></p>";	
			})
			
			function callTheNextThing(){
				
				contract.methods.requestResult().send({
					from: window['userAccountNumber']
				}).once('receipt', function(receipt){
					console.log(Object.keys(receipt));
				})
			}
		
		}
		
		function sendAPIdataToSmartContract(){			
			getWallet();
		}
		
	</script>
	
    <title>NFTest | Chainlink Integration</title>

    </head>
    <body>
		<div class="content">
			<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/header.php');?>
			<div class="content-section" id='title-of-test-div'>
				<!-- Title Goes Here-->
				<div id='test-title'>
					Connecting the API to Chainlink
				</div>
				<div id='test-description'>
					<div id='chainlink-logo-div' style='display:flex; justify-content:center; height:6em; margin: 0 0 4em 0;'><img src='/images/test-assets/chainlink-logo.png'></div>
					<p>Chainlink can connect to ANY API to transport data to smartcontracts.</p>
					<p>I created <a href='https://nftest.net/pass-api/?uAN=0xab8e6493def98177af1db49280a0d174b3ace9be&tID=18&pp=90' target='_new'>a simple API</a> that will tell you whether a user 'passed' a test or not based on an arbitrary percentile value.</p>
					<p>I then used Chainlink to connect this API to a smart contract on Kovan that updates its values based on these API results.</p>
					<p>It is a simple and powerful demonstration of how Chainlink can easily bring ANY API data to smartcontracts.</p>
				</div>
			</div>
			<div class="content-section">	
				<h2 class='header-txt' id='contract-addresses-div'>"Pass" API</h2>
					<div class='link-unit-container'>
						<p class='links'>
							Send a user account, test ID, and arbitrary passing threshold (an integer that is 1-100) to the API. The API will return a boolean value based on whether the user scored equal to or higher than the threshold on the specified test.
						</p>
						<p class='links'>
							<fieldset>
    						<legend>REQUIRED API INPUTS</legend>
    							<label for="tID">Test ID:</label>
    							<input type="number" id="tID" name="tID" style="padding:1.5em; line-height:2em; font-size=1.5em; font-family: 'Press Start 2P', cursive;" value="18"><br><br>
    							
    							<label for="lname">Wallet Address:</label>
   								 <input type="text" id="uAN" name="uAN" value="0xab8e6493def98177af1db49280a0d174b3ace9be"><br><br>
    
    							<label for="passingScore">Passing Score (0-100):</label>
    							<input type="number" min="0" max="100" id="passingScore" name="passingScore" style="padding:1.5em; line-height:2em; font-size=1.5em; font-family: 'Press Start 2P', cursive;" value="60"> %<br><br>
							</fieldset>
						</p>
						<div class="nav-button greenButton bigButton" style="display:block; text-align:center;" id="callAPIbutton" onclick="callAPI()">Call API</div>
					</div>
			</div>
			<div class='content-section' id='return-div'>
				<h2 class='header-txt' id='return-div'>API Return</h2>
					<div class='link-unit-container'>
						<div id='apiReturn' style='text-align:center;'>*api data will return here*</div>
					</div>
			</div>
			<div class='content-section' id='contact'>
				<h2 class='header-txt' id='contract-addresses-div'>Send API Data to Smart Contract with Chainlink</h2>
					<div id='progress-div'>
					</div>
					<div id='connection-in-progress' style='justify-content:center;'>
						<img src="/images/loading-wheel.gif">
					</div>
					
					<div>
						<div class="bigButton disabledButton" id='sendToLinkNodeButton' style='display:block; text-align:center;' onclick='sendAPIdataToSmartContract()'>Send API Data to Smart Contract</div>
					</div>
			</div>			
			<div id='site-footer'>
				<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/footer-links.php'); ?>
			</div>
		<!--Following Tag Marks End of Content DIV-->
		</div>	
	</body>
	<script>
		var abi = [
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "bytes32",
				"name": "id",
				"type": "bytes32"
			}
		],
		"name": "ChainlinkCancelled",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "bytes32",
				"name": "id",
				"type": "bytes32"
			}
		],
		"name": "ChainlinkFulfilled",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "bytes32",
				"name": "id",
				"type": "bytes32"
			}
		],
		"name": "ChainlinkRequested",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "bytes32",
				"name": "_requestId",
				"type": "bytes32"
			},
			{
				"internalType": "bool",
				"name": "_pass",
				"type": "bool"
			}
		],
		"name": "fulfill",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "requestResult",
		"outputs": [
			{
				"internalType": "bytes32",
				"name": "requestId",
				"type": "bytes32"
			}
		],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_myRequest",
				"type": "string"
			}
		],
		"name": "setNewRequest",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "myRequest",
		"outputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "pass",
		"outputs": [
			{
				"internalType": "bool",
				"name": "",
				"type": "bool"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
];
	</script>
</html>
