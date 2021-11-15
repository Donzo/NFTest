<script>
		var dataIsUploading = false;
		
		function uploadTheTest(){
		
			//var progressDiv = document.getElementById('test-upload-progress-div');
			//progressDiv.style.display="flex";
			//setInnerHTML('upload-status-text', "new status");
		
		
			if (fileUpload1){
				setInnerHTML('upload-status-text', "Uploading NFT 1...");
				uploadFile(1);
				window.dataStore["NFT1exists"] = true;
			} 
			if (fileUpload2){
				setInnerHTML('upload-status-text', "Uploading NFT 2...");
				uploadFile(2);
				window.dataStore["NFT2exists"] = true;
			} 
			if (fileUpload3){
				setInnerHTML('upload-status-text', "Uploading NFT 3...");
				uploadFile(3);
				window.dataStore["NFT3exists"] = true;
			}
			if (fileUpload4){
				setInnerHTML('upload-status-text', "Uploading NFT 4...");
				uploadFile(4);
				window.dataStore["NFT4exists"] = true;
			}
			if (fileUpload5){
				setInnerHTML('upload-status-text', "Uploading NFT 5...");
				uploadFile(5);
				window.dataStore["NFT5exists"] = true;
			}
		}
		
		var loadFile = function(event, imgNumber) {
			//The File is too big. Warn the client.
			// check file size - this turns files less than 1 MB into a decimal. Anything over 1 is too big.
			var fileSizeCalc1 = event.target.files[0].size / 1024;
			var fileSizeCalc2 = fileSizeCalc1 / 1014;
			if (debugging){
				console.log('The uploaded file is ' + fileSizeCalc2 + 'MB.');
			}
			if (fileSizeCalc2 > imageSizeThreshold){
				alert('This image is too big. It must be smaller than ' + imageSizeThreshold + 'MB.');
			}
			else{
				if (imgNumber == 1){
					//Add image to page
					var image = document.getElementById('output');
					image.src = URL.createObjectURL(event.target.files[0]);
					//Store image in an object to pass to the server
					fileUpload1 = event.target.files[0];
					fileUpload1EXT = getExt(event.target.files[0]);
					getURLsForUploads(1);
					//Enable Remove Upload Button
					var buttonID = "imgRemoveButton1";
					enableButton(buttonID);
					//Disable Upload Button
					buttonID = "imgUploadButton1";
					disableButton(buttonID);
					//If the Maker Options for the NFT Maker Don't exist, add them.
					if (!nftMakerRadioIsActive){
						addMakerOptionsForNFT();
						nftMakerRadioIsActive = true;
					}			
				}
				if (imgNumber == 2){
					var image = document.getElementById('output2');
					image.src = URL.createObjectURL(event.target.files[0]);
					//Store image in an object to pass to the server
					fileUpload2 = event.target.files[0];
					fileUpload2EXT = getExt(event.target.files[0]);
					getURLsForUploads(2);
					//Enable Remove Upload Button
					var buttonID = "imgRemoveButton2";
					enableButton(buttonID);
					//Disable Upload Button
					buttonID = "imgUploadButton2";
					disableButton(buttonID);
					//Load the next threshold setter DIV
					var scoreSetDivID = 'nftThresholdSetter2';
					document.getElementById(scoreSetDivID).style.display = "block";
					verifyMultiValues();
					setDisplayValues();
					//Also Enable Add NFT Button at this step
					if (lastCompletedNFT == 1 && NFTcount == 2){
						lastCompletedNFT++;
						enableButton('addAnotherNFTButton');
					}
				}
				if (imgNumber == 3){
					var image = document.getElementById('output3');
					image.src = URL.createObjectURL(event.target.files[0]);
					//Store image in an object to pass to the server
					fileUpload3 = event.target.files[0];
					fileUpload3EXT = getExt(event.target.files[0]);
					getURLsForUploads(3);
					//Enable Remove Upload Button
					var buttonID = "imgRemoveButton3";
					enableButton(buttonID);
					//Disable Upload Button
					buttonID = "imgUploadButton3";
					disableButton(buttonID);
					//Load the next threshold setter DIV
					var scoreSetDivID = 'nftThresholdSetter3';
					document.getElementById(scoreSetDivID).style.display = "block";
					verifyMultiValues();
					setDisplayValues();
					//Also Enable Add NFT Button at this step
					if (lastCompletedNFT == 2 && NFTcount == 3){
						lastCompletedNFT++;
						enableButton('addAnotherNFTButton');
					}
				}
				if (imgNumber == 4){
					var image = document.getElementById('output4');
					image.src = URL.createObjectURL(event.target.files[0]);
					//Store image in an object to pass to the server
					fileUpload4 = event.target.files[0];
					fileUpload4EXT = getExt(event.target.files[0]);
					getURLsForUploads(4);
					//Enable Remove Upload Button
					var buttonID = "imgRemoveButton4";
					enableButton(buttonID);
					//Disable Upload Button
					buttonID = "imgUploadButton4";
					disableButton(buttonID);
					//Load the next threshold setter DIV
					var scoreSetDivID = 'nftThresholdSetter4';
					document.getElementById(scoreSetDivID).style.display = "block";
					verifyMultiValues();
					setDisplayValues();
					//Also Enable Add NFT Button at this step
					if (lastCompletedNFT == 3 && NFTcount == 4){
						lastCompletedNFT++;
						enableButton('addAnotherNFTButton');
					}
				}
				if (imgNumber == 5){
					var image = document.getElementById('output5');
					image.src = URL.createObjectURL(event.target.files[0]);
					//Store image in an object to pass to the server
					fileUpload5 = event.target.files[0];
					fileUpload5EXT = getExt(event.target.files[0]);
					getURLsForUploads(5);
					//Enable Remove Upload Button
					var buttonID = "imgRemoveButton5";
					enableButton(buttonID);
					//Disable Upload Button
					buttonID = "imgUploadButton5";
					disableButton(buttonID);
					//Load the next threshold setter DIV
					var scoreSetDivID = 'nftThresholdSetter5';
					document.getElementById(scoreSetDivID).style.display = "block";
					verifyMultiValues();
					setDisplayValues();
					//Also Enable Add NFT Button at this step
					if (lastCompletedNFT == 4 && NFTcount == 5){
						lastCompletedNFT++;
						//Maybe paralyze button forever here.
						//enableButton('addAnotherNFTButton');
					}
				}
			}
		};
		function getExt(fileName){
			const media_file = fileName // event is from the <input> event
			const filename = media_file.name

			let last_dot = filename.lastIndexOf('.')
			let ext = filename.slice(last_dot + 1)
			let name = filename.slice(0, last_dot)
			return ext;
		}
		
		//Connect to Cloudflare and Get an Upload Link for the Image
		async function getURLsForUploads(nftNum){
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200) {
					if (nftNum == 1){
						fileUploadLink1 = this.responseText;
					}
					else if (nftNum == 2){
						fileUploadLink2 = this.responseText;
					}
					else if (nftNum == 3){
						fileUploadLink3 = this.responseText;
					}
					else if (nftNum == 4){
						fileUploadLink4 = this.responseText;
					}
					else if (nftNum == 5){
						fileUploadLink5 = this.responseText;
					}
   				}
			};
			xhttp.open("GET", "/code/php/cloudflare-images-connect.php", true);
			xhttp.send();

		};
		async function uploadTestData() {
			
			
			//Create Form Data Object to be sent to server
			let formData = new FormData();
			
			//Append account number
			formData.append('userAccountNum', window['userAccountNumber']);
			
			//Push in some more test data
			window.dataStore['totalQuestions'] = totalQuestions;
			
			//Get number of choices for each question and put it in the test data
			for (let i = 0; i <= totalQuestions; i++) {
				window.dataStore["q" + i + "acc"] = window["q" + i + "acc"];
			}
			
			//Append test data
			formData.append('testData', JSON.stringify(window.dataStore));
			
			var loadingWheel = document.getElementById('loading-wheel');
			loadingWheel.style.visibility="hidden";
			setInnerHTML('upload-status-text', "Upload Complete. Redirecting after confirmation...");
			
			//Send it!
			await fetch('/code/php/uploads-back.php', {
				method: "POST", 
				body: formData
			}).then((response) => {
 				console.log(response);
 				alert('Your test has been created. You will now be redirected to your tests.');
				window.location.replace("https://nftest.net/my-tests?userAccountNum=" + window['userAccountNumber']);
			})
			
			
		}
		async function uploadFile(which) {
			
			//Create Form Data Object to be sent to server
			const formData = new FormData();
			
			//Append account number
			//formData.append('userAccountNum', window['userAccountNumber']);
			
			var imgURL = null;

			if (which == 1){
				var fileName = "NFT1." + fileUpload1EXT;
				formData.append('file', fileUpload1, fileName);
				window.dataStore["NFT1exists"] = true;
				imgURL = fileUploadLink1;
				window.dataStore["fileName1"] = fileName;
			}
			else if (which == 2){
				var fileName = "NFT2." + fileUpload2EXT;
				formData.append('file', fileUpload2, fileName);
				window.dataStore["NFT2exists"] = true;
				imgURL = fileUploadLink2;
				window.dataStore["fileName2"] = fileName;
			} 
			else if (which == 3){
				var fileName = "NFT3." + fileUpload3EXT;
				formData.append('file', fileUpload3, fileName);
				window.dataStore["NFT3exists"] = true;
				imgURL = fileUploadLink3;
				window.dataStore["fileName3"] = fileName;
			}
			else if (which == 4){
				var fileName = "NFT4." + fileUpload4EXT;
				formData.append('file', fileUpload4, fileName);
				window.dataStore["NFT4exists"] = true;
				imgURL = fileUploadLink4;
				window.dataStore["fileName4"] = fileName;
			}
			else if (which == 5){
				var fileName = "NFT5." + fileUpload5EXT;
				formData.append('file', fileUpload5, fileName);
				window.dataStore["NFT5exists"] = true;
				imgURL = fileUploadLink5;
				window.dataStore["fileName5"] = fileName;
			}
		

    		const options = {
      			method: 'POST',
    			body: formData,
   			};
    		//Upload File to Cloudflare and Retrieve the Permalink
    		await fetch(imgURL, options).then((response) => {
 				response.json().then(function(result) {
 					if (which == 1){
 						imgCFlink1 = result.result.variants;
 						window.dataStore["NFT1URL"] = imgCFlink1;
 						setInnerHTML('upload-status-text', "NFT 1 Uploaded...");
 					}
 					else if (which == 2){
 						imgCFlink2 = result.result.variants;
 						window.dataStore["NFT2URL"] = imgCFlink2;
 						setInnerHTML('upload-status-text', "NFT 2 Uploaded...");
 					}
 					else if (which == 3){
 						imgCFlink3 = result.result.variants;
 						window.dataStore["NFT3URL"] = imgCFlink3;
 						setInnerHTML('upload-status-text', "NFT 3 Uploaded...");
 					}
 					else if (which == 4){
 						imgCFlink4 = result.result.variants;
 						window.dataStore["NFT4URL"] = imgCFlink4;
 						setInnerHTML('upload-status-text', "NFT 4 Uploaded...");
 					}
 					else if (which == 5){
 						imgCFlink5 = result.result.variants;
 						window.dataStore["NFT5URL"] = imgCFlink5;
 						setInnerHTML('upload-status-text', "NFT 5 Uploaded...");
 					}
 					if (which == NFTcount){
 						setInnerHTML('upload-status-text', "All NFTs Uploaded. Now Uploading Test Data...");
 						uploadTestData();	
 					}
				}); 
			});
						    
			
		}

	</script>