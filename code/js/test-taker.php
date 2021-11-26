	<script>	
		const testDO = JSON.parse(testData);
		var debugging = true;
		<!-- Get our test data -->
		//alert('working' + testData);
		if (debugging){
			//console.log("Here is our test data" + testData);
		}
		var testTitle = testDO["testTitleInputField"];
		var testDesc = testDO["testDescriptionInputField"];
		var totalQs = testDO["totalQuestions"];
		var NFT1exists = true;
		var NFT2exists = false;
		var NFT3exists = false;
		var NFT4exists = false;
		var NFT5exists = false;
		var nftCount = 1;
		if (testDO["NFT2exists"]){
			NFT2exists = true;
			nftCount++;
		}
		if (testDO["NFT3exists"]){
			NFT3exists = true;
			nftCount++;
		}
		if (testDO["NFT4exists"]){
			NFT4exists = true;
			nftCount++;
		}
		if (testDO["NFT5exists"]){
			NFT5exists = true;
			nftCount++;
		}
		var correctWordTense = nftCount > 1 ? " different NFTs that you can mint based on your score." : " NFT.";
		var mintConditions = "";
		var thresholdSetter1 = false;
		var thresholdSetter2 = false;
		var thresholdSetter3 = false;
		var thresholdSetter4 = false;
		var thresholdSetter5 = false;
		var allMint = false;
		
		var qchoices =false;
		var qChoice1 = false;
		var qChoice2 = false;
		var qChoice3 = false;
		var qChoice4 = false;
		var qChoice5 = false;
		var qChoice6 = false;
		var qChoice1HTML = false;
		var qChoice2HTML = false;
		var qChoice3HTML = false;
		var qChoice4HTML = false;
		var qChoice5HTML = false;
		var qChoice6HTML = false;
		var answersRight = 0;
		var answersWrong = 0;
		var totalQNum = 0;

		
		
		
		//This test has 1 NFT and everyone can mint it.
		if (testDO["nftMakerOption1"]=='allMint'){
			mintConditions = "Everyone who completes this test can mint the NFT."
			allMint = true;
			
		}
		else if (testDO["nftMakerOption2"] == "restrictMint"){
			thresholdSetter1 = testDO["thresholdSetter1"];
			mintConditions = "Mint NFT 1 by scoring > " + thresholdSetter1 + " percent of questions correctly.<br/><br/>"
			if ( testDO["NFT2exists"] && testDO["thresholdSetter2"]){
				thresholdSetter2 = testDO["thresholdSetter2"] >= 0 ? testDO["thresholdSetter2"] : false;
				mintConditions += "Mint NFT 2 by scoring >= " + thresholdSetter2 + " percent.<br/><br/>"
			}
			if ( testDO["NFT3exists"] && testDO["thresholdSetter3"]){
				thresholdSetter3 = testDO["thresholdSetter3"]  >= 0 ? testDO["thresholdSetter3"] : false;
				mintConditions += "Mint NFT 3 by scoring >= " + thresholdSetter3 + " percent.<br/><br/>"
			}
			if ( testDO["NFT4exists"] && testDO["thresholdSetter4"]){
				thresholdSetter4 = testDO["thresholdSetter4"] >= 0 ? testDO["thresholdSetter4"] : false;
				mintConditions += "Mint NFT 4 by scoring >=  " + thresholdSetter4 + " percent.<br/><br/>"
			}
			if ( testDO["NFT5exists"] && testDO["thresholdSetter5"]){
				thresholdSetter5 = testDO["thresholdSetter5"]  >= 0 ? testDO["thresholdSetter5"] : false;
				mintConditions += "Mint NFT 5 by scoring >= " + thresholdSetter5 + " percent."
			}
		}
		var testStats = "This test has " + testDO["totalQuestions"] + " questions and " + nftCount + correctWordTense;
		var mintConditionsTxt = "<div class='mintConditions'>" + mintConditions + "</div>";
		
		setInnerHTML('test-title', testTitle);
		setInnerHTML('test-description', "<p>" + testDesc + "</p><p>" + testStats + "</p>");
		setInnerHTML('test-stats', mintConditionsTxt);
	

		var newqDivID = false;
		var lastQDivID = "start-div";
		
		/*Shuffle function*/
		const getShuffledArr = arr => {
        const newArr = arr.slice()
        	for (let i = newArr.length - 1; i > 0; i--) {
            	const rand = Math.floor(Math.random() * (i + 1));
            	[newArr[i], newArr[rand]] = [newArr[rand], newArr[i]];
       		}
        	return newArr
   		};
   		
		function returnThisAnswer(num){
			if (num == 1){
				return qChoice1;
			}
			else if (num == 2){
				return qChoice2;
			}
			else if (num == 3){
				return qChoice3;
			}
			else if (num == 4){
				return qChoice4;
			}
			else if (num == 5){
				return qChoice5;
			}
			else if (num == 6){
				return qChoice6;
			}
		}
		function takeTest(){
			var qsToCreate = testDO["totalQuestions"];
			totalQNum = qsToCreate;
			var qsCreated = 0;
			
			while (qsCreated < qsToCreate) {
				qsCreated++;
				
					
				//Create it and Set it
				if (qsCreated > 1 && newqDivID){
					lastQDivID = newqDivID;
				}
				var divID = "qDiv" + qsCreated;
				var qHeading = "<div class='qHeading'>Question " + qsCreated + "</div>";
				var qTxt = "<div class='questionTxt'>" + testDO["q" + qsCreated + "inputField"] + "</div>";
				var qInput = "";
				
				//Multiple Choice Question
				if (testDO["qStyleChoice" + qsCreated + "a"] == "multipleChoice"){
					
					var qInputSetID = "mcInputSetForQ" + qsCreated;
					//Program the answers
					var answerOrder = [];
					if (testDO["q" + qsCreated + "choiceA"]){
						
						qChoice1 = testDO["q" + qsCreated + "choiceA"];
						//Set the answer in the browser window
						window["q" + qsCreated + "ca"] = qChoice1;
						answerOrder.push(qChoice1);
					}
					if (testDO["q" + qsCreated + "choiceB"]){
						qChoice2 = testDO["q" + qsCreated + "choiceB"];
						answerOrder.push(qChoice2);
					}
					if (testDO["q" + qsCreated + "choiceC"]){
						qChoice3 = testDO["q" + qsCreated + "choiceC"];
						answerOrder.push(qChoice3);
					}
					if (testDO["q" + qsCreated + "choiceD"]){
						qChoice4 = testDO["q" + qsCreated + "choiceD"];
						answerOrder.push(qChoice4);
					}
					if (testDO["q" + qsCreated + "choiceE"]){
						qChoice5 = testDO["q" + qsCreated + "choiceE"];
						answerOrder.push(qChoice5);
					}
					if (testDO["q" + qsCreated + "choiceF"]){
						qChoice6 = testDO["q" + qsCreated + "choiceF"];
						answerOrder.push(qChoice6);
					}
					var finalAnswerOrder = getShuffledArr(answerOrder);
					
					//Check for manually ordered answers - If we find them, respect the order.
					if (testDO["q" + qsCreated + "moInputField"]){
						var userAnswerOrder = testDO["q" + qsCreated + "moInputField"].split(',');
						var thisArrayCount = 0;
						finalAnswerOrder = [];
						while (thisArrayCount < userAnswerOrder.length){
							finalAnswerOrder.push(returnThisAnswer(userAnswerOrder[thisArrayCount]));
							thisArrayCount++;
						}						
					}

					//Finalize answers (random or manual)
					if (finalAnswerOrder.length == 6){
						//We are stripping out quotes and double quotes so we don't break the scoring mechanism. 
						qChoice1HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceA'><input value='" + finalAnswerOrder[0].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[0] + "</div>";
						qChoice2HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[1].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[1] + "</div>";
						qChoice3HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[2].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[2] + "</div>";
						qChoice4HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[3].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[3] + "</div>";
						qChoice5HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[4].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[4] + "</div>";
						qChoice6HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[5].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[5] + "</div>";
						qchoices = qChoice1HTML + qChoice2HTML + qChoice3HTML + qChoice4HTML + qChoice5HTML + qChoice6HTML;
					}
					else if (finalAnswerOrder.length == 5){
						qChoice1HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceA'><input value='" + finalAnswerOrder[0].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[0] + "</div>";
						qChoice2HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[1].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[1] + "</div>";
						qChoice3HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[2].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[2] + "</div>";
						qChoice4HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[3].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[3] + "</div>";
						qChoice5HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[4].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[4] + "</div>";
						qchoices = qChoice1HTML + qChoice2HTML + qChoice3HTML + qChoice4HTML + qChoice5HTML;
					}
					else if (finalAnswerOrder.length == 4){
						qChoice1HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceA'><input value='" + finalAnswerOrder[0].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[0] + "</div>";
						qChoice2HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[1].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[1] + "</div>";
						qChoice3HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[2].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[2] + "</div>";
						qChoice4HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[3].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[3] + "</div>";
						qchoices = qChoice1HTML + qChoice2HTML + qChoice3HTML + qChoice4HTML;
					}
					else if (finalAnswerOrder.length == 3){
						qChoice1HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceA'><input value='" + finalAnswerOrder[0].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[0] + "</div>";
						qChoice2HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[1].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[1] + "</div>";
						qChoice3HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[2].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[2] + "</div>";
						qchoices = qChoice1HTML + qChoice2HTML + qChoice3HTML;
					}
					else{
						qChoice1HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceA'><input value='" + finalAnswerOrder[0].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[0] + "</div>";
						qChoice2HTML = "<div class='mc-choice' id='q" + qsCreated + "choiceB'><input value='" + finalAnswerOrder[1].replace(/['"]+/g, '') + "' type='radio' name=" + qInputSetID + "> " + finalAnswerOrder[1] + "</div>";
						qchoices = qChoice1HTML + qChoice2HTML;
					}
					qInput = "<div class='multiple-choice-q-input-div'><fieldset class='multiple-choice-q-input-div' id='" + qInputSetID + "'>" + qchoices + "</fieldset></div>";
				}
				//Short Response Question
				else if (testDO["qStyleChoice" + qsCreated + "b"] == "shortResponse"){
					
					//Do this
					var qInputSetID = "srInputSetForQ" + qsCreated;
					
					qInput = "<div class='short-response-q-input-div-container'><div class='short-response-q-input-div'><fieldset class='short-response-q-input-div' name='" + qInputSetID + "'><div class='short-response-field-container'><div class='srTxtDiv'>Enter Your Response: </div><input class='srInputField' type='text' id='" + qInputSetID + "' name='" + qInputSetID + "'></div></fieldset></div></div>";
				}
				
				
				var qHTML = "<div id='" + divID + "' class='content-section qDiv'>" + qHeading + qTxt + qInput + "</div>";
				document.getElementById(lastQDivID).insertAdjacentHTML('afterend', qHTML);
				
				
				
				newqDivID = divID;
			}
			var submitTestButton = "<div id='submit-test-div' class='content-section submit-test-div'><div id='submit-button' onClick='checkMyTest()' class='bigButton'>Submit Your Test</div></div>";
			document.getElementById(newqDivID).insertAdjacentHTML('afterend', submitTestButton);
			
			//Scroll it into view
			var goHereID = 'qDiv1';
			document.getElementById(goHereID).scrollIntoView();
  			window.scrollBy(0, -150); 
  			document.getElementById(goHereID).focus();	
		}
		function submitTest(){
			var qn = 1;
			while (qn <= totalQs){
				//Multiple Choice
				var inputName = "mcInputSetForQ" + qn;
				//Short Response
				var inputName2 = "srInputSetForQ" + qn;
				var userInput = null;
				//Multiple Choice
				if (document.getElementById(inputName)){

					userInput = document.querySelector('input[name="' + inputName + '"]:checked').value;		
					//We are stripping out quotes and double quotes so we don't break the scoring mechanism. 
					//There's probably a better way to deal with them than stripping but wgaf?
					if (window["q" + qn + "ca"].replace(/['"]+/g, '') == userInput){
						answersRight++;
					}
					else{
						answersWrong++;
					}
						
				}
				//Short answer
				else if (document.getElementById(inputName2)){
					var ans1 = Math.floor(100000000 + Math.random() * 900000000);
					var ans2 = Math.floor(100000000 + Math.random() * 900000000);
					var ans3 = Math.floor(100000000 + Math.random() * 900000000);
					var ans4 = Math.floor(100000000 + Math.random() * 900000000);
					var ans5 = Math.floor(100000000 + Math.random() * 900000000);
					var ans6 = Math.floor(100000000 + Math.random() * 900000000);
					
					var caseSensID = "q" + qn + "caseSensitiveButton";
					
					if (testDO["q" + qn + "rightAnswer1"]){
						if (testDO["q" + qn + "caseSensitiveButton"] && testDO["q" + qn + "caseSensitiveButton"] == "on"){
							ans1 = testDO["q" + qn + "rightAnswer1"].replace(/['"]+/g, '');
						}
						else{
							ans1 = testDO["q" + qn + "rightAnswer1"].replace(/['"]+/g, '').toLowerCase();
						}
					}
					if (testDO["q" + qn + "rightAnswer2"]){
						if (testDO["q" + qn + "caseSensitiveButton"] && testDO["q" + qn + "caseSensitiveButton"] == "on"){
							ans2 = testDO["q" + qn + "rightAnswer2"].replace(/['"]+/g, '');
						}
						else{
							ans2 = testDO["q" + qn + "rightAnswer2"].replace(/['"]+/g, '').toLowerCase();
						}
					}
					if (testDO["q" + qn + "rightAnswer3"]){
						if (testDO["q" + qn + "caseSensitiveButton"] && testDO["q" + qn + "caseSensitiveButton"] == "on"){
							ans3 = testDO["q" + qn + "rightAnswer3"].replace(/['"]+/g, '');
						}
						else{
							ans3 = testDO["q" + qn + "rightAnswer3"].replace(/['"]+/g, '').toLowerCase();
						}
					}
					if (testDO["q" + qn + "rightAnswer4"]){
						if (testDO["q" + qn + "caseSensitiveButton"] && testDO["q" + qn + "caseSensitiveButton"] == "on"){
							ans4 = testDO["q" + qn + "rightAnswer4"].replace(/['"]+/g, '');
						}
						else{
							ans4 = testDO["q" + qn + "rightAnswer4"].replace(/['"]+/g, '').toLowerCase();
						}
					}
					if (testDO["q" + qn + "rightAnswer5"]){
						if (testDO["q" + qn + "caseSensitiveButton"] && testDO["q" + qn + "caseSensitiveButton"] == "on"){
							ans5 = testDO["q" + qn + "rightAnswer5"].replace(/['"]+/g, '');
						}
						else{
							ans5 = testDO["q" + qn + "rightAnswer5"].replace(/['"]+/g, '').toLowerCase();
						}
					}
					if (testDO["q" + qn + "rightAnswer6"]){
						if (testDO["q" + qn + "caseSensitiveButton"] && testDO["q" + qn + "caseSensitiveButton"] == "on"){
							ans6 = testDO["q" + qn + "rightAnswer6"].replace(/['"]+/g, '');
						}
						else{
							ans6 = testDO["q" + qn + "rightAnswer6"].replace(/['"]+/g, '').toLowerCase();
						}
					}

					//Get user input
					var userAnswer = document.querySelector('input[name="' + inputName2 + '"]').value.replace(/['"]+/g, '').toLowerCase();
					
					if (testDO["q" + qn + "caseSensitiveButton"] && testDO["q" + qn + "caseSensitiveButton"] == "on"){
						userAnswer = document.querySelector('input[name="' + inputName2 + '"]').value.replace(/['"]+/g, '');
					}
					//Run it against our acceptable answers
					if (userAnswer == ans1 || userAnswer == ans2 || userAnswer == ans3 || userAnswer == ans4 || userAnswer == ans5 || userAnswer == ans6 ){
						answersRight++;
						//alert('qn ' + qn + " right!");
					}
					else{
						answersWrong++;
						//alert('qn ' + qn + " wrong!");
					}					
				}
				qn++;
			}
				window["cap"] = (answersRight / totalQs) * 100;
				uploadMyScore();
		
		}

		function confirmThis(key, msg){
			if (confirm(msg)) {
  				// Fix it!
  				offToFixIt = true;
  				document.getElementById(key).scrollIntoView();
  				window.scrollBy(0, -150); 
  				document.getElementById(key).focus();
			}
			else{
				if(debugging){
				  console.log("User entered " + key + " without an answer.");
				}
			}
		}
		function checkMyTest(){
			
			offToFixIt = false;
			qn = 1;
			while (qn <= totalQs && offToFixIt !=true){
				//Multiple Choice
				var inputName = "mcInputSetForQ" + qn;
				//Short Response
				var inputName2 = "srInputSetForQ" + qn;
				
				//Look for Blank Multiple Choice
				if (document.getElementById(inputName)){
					if (!document.querySelector('input[name="' + inputName + '"]:checked')){
						var keyName = "qDiv" + qn;
						alert('You did not answer question ' + qn + ". You must choose an answer.");
						offToFixIt = true;
  						document.getElementById(keyName).scrollIntoView();
  						window.scrollBy(0, -150); 
  						document.getElementById(keyName).focus();
					}
				}
			
				//Look for Blank Short answer
				else if (document.getElementById(inputName2)){
					if (document.getElementById(inputName2).value == undefined || document.getElementById(inputName2).value == ""){
						var keyName = "qDiv" + qn;
						alert('You did not answer question ' + qn + ". You must enter an answer.");
						offToFixIt = true;
  						document.getElementById(keyName).scrollIntoView();
  						window.scrollBy(0, -150); 
  						document.getElementById(keyName).focus();
					}		
				}				
				qn++
			}
			if (!offToFixIt){
				submitTest();
				alert('You scored ' + answersRight + ' questions right out of ' + totalQNum + '. Click OK to view your results page.');
			}		
		}
		function clearIt(){
			document.getElementById('nothing-to-see-here').remove();
		}
		clearIt();
	</script>
