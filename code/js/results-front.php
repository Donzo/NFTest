<script>
		var dataIsUploading = false;
		
		function uploadMyScore(){
			uploadScore();			
		}
		
		
		async function uploadScore() {

			
			var myNFTIMGLINK = false;
			
			//FIND MY NFT LINK
			//This test has 1 NFT and everyone can mint it.
			if (allMint){
				myNFTIMGLINK = imgURI1;
			}
			else{
				if ( window["cap"] > thresholdSetter1 && typeof imgURI1 !== 'undefined'){
				
					myNFTIMGLINK = imgURI1;
				}
				else if ( window["cap"] >= thresholdSetter2 && typeof imgURI2 !== 'undefined'){
					myNFTIMGLINK = imgURI2;
				}
				else if ( window["cap"] >= thresholdSetter3 && typeof imgURI3 !== 'undefined'){
					myNFTIMGLINK = imgURI3;
				}
				else if ( window["cap"] >= thresholdSetter4 && typeof imgURI4 !== 'undefined'){
					myNFTIMGLINK = imgURI4;
				}
				else if ( window["cap"] >= thresholdSetter5 && typeof imgURI5 !== 'undefined'){
					myNFTIMGLINK = imgURI5;
				}
				else{
					alert('Im sorry you cannot mint. Try to get a higher score.');
				}
			}
			var qTotal = answersRight + answersWrong;
			var linkToThisTest = "https://nftest.net/test-taker?id=" + testID + "&testNameFF=" + testNameFF;
			//Create Data Structure
			var testResults = {
   				"name": testTitle + " | NFTest Results",
				"description": "Test results from NFTest: create tests and award custom NFTs based on results.",
				"image": myNFTIMGLINK,
				"external_url": linkToThisTest,
				"background_color": "CABAAB",
				"attributes": [		
					{
      					"trait_type": "Test Title", 
      					"value": testTitle
    				}, 
    				{
    					"trait_type": "Test Description", 
						"value": testDesc
   					},
   					{
    					"trait_type": "Address of Tester", 
						"value": window['userAccountNumber']
   					},
    				{
    					"trait_type": "Test ID",
    					"display_type": "number", 
						"value": testID
   					},
   					{
    					"trait_type": "Questions Right", 
						"display_type": "number", 
						"value": answersRight,
						"max_value":qTotal
   					},
   					{
    					"trait_type": "Questions Wrong", 
						"display_type": "number", 
						"value": answersWrong,
						"max_value":qTotal
   					},
				    {
						"trait_type": "Total Percent Correct", 
						"display_type": "number", 
						"value": window["cap"],
						"max_value":100
  					},
  									    {
						"trait_type": "Accuracy", 
						"value": window["cap"],
						"max_value":100
  					},
  					{
    					"trait_type": "Link to This Test", 
						"value": linkToThisTest
   					}
 				]		 
			}
			
			
			
			
			//Create Form Data Object to be sent to server
			let formData = new FormData();
			
			//Append NFT Data
			formData.append('testResults', JSON.stringify(testResults));
			
			//Append Test Data
			formData.append('userAccountNum', window['userAccountNumber']);
			formData.append('testID', testID);
			formData.append('testName', testTitle);
			formData.append('testNameFF', testNameFF);
			formData.append('answersRight', answersRight);
			formData.append('answersWrong', answersWrong);
			formData.append('cap', window["cap"]);
			formData.append('myNFTIMGLink', myNFTIMGLINK);
			
			//Send it!
			await fetch('/code/php/results-back.php', {
				method: "POST", 
				body: formData
			}).then((response) => {
 				console.log(response);
 				goToMintPage();
				//window.location.replace("https://nftest.net/my-tests?userAccountNum=" + window['userAccountNumber']);
			})
						    
		}
		async function goToMintPage() {
		
			var http = new XMLHttpRequest();
			var url = '/code/php/return-my-nft-url.php';
			var params = "userAccountNum=" + window['userAccountNumber'] + "&testID=" + testID;
			http.open('POST', url, true);

			//Send the proper header information along with the request
			http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			http.onreadystatechange = function() {//Call a function when the state changes.
    			if(http.readyState == 4 && http.status == 200) {
       				window.location.replace("https://nftest.net/" + http.responseText);
    			}
			}
			http.send(params);
		}

	</script>