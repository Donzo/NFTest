	<script>
		var debugging = true;
		var totalQuestions = 0;
		var nextQuestion = 1;
		var tmbExist = false;
		var onNow = false;
		var makingNFT = false;
		var nftMakerRadioIsActive = false;
		var NFTcount = 1;
		var lastCompletedNFT = 0;
		var scoreThreshold1;
		var scoreThreshold2;
		var scoreThreshold3;
		var scoreThreshold4;
		var scoreThreshold5;
		var scoreRangesValid = false;
		var imageSizeThreshold = 10000;
		var offToFixIt = false;
		var nft2removed = false;
  		var	nft3removed = false;
  		var nft4removed = false;
  		var nft5removed = false;
		var fileUpload1 = false;
		var fileUpload2 = false;
		var fileUpload3 = false;
		var fileUpload4 = false;
		var fileUpload5 = false;
		var fileUpload1EXT = false;
		var fileUpload2EXT = false;
		var fileUpload3EXT = false;
		var fileUpload4EXT = false;
		var fileUpload5EXT = false;
		var fileUploadLink1 = false;
		var fileUploadLink2 = false;
		var fileUploadLink3 = false;
		var fileUploadLink4 = false;
		var fileUploadLink5 = false;
		var imgCFlink1 = false;
		var imgCFlink2 = false;
		var imgCFlink3 = false;
		var imgCFlink4 = false;
		var imgCFlink5 = false;
		
		
		function makeTest(){
			if (!onNow){
				var testMakerDiv = document.getElementById('test-maker-div');
				var testMakerButtons = document.getElementById('test-maker-buttons');
				testMakerDiv.style.visibility="visible";
				testMakerButtons.style.visibility="visible";
				createQuestion(1);
				//Disable button and make it inoperable
				onNow = true;
				var button = document.getElementById('makeTestButton');
				button.classList.add("disabledButton");
			}
		}
		function changeQuestionFormat(qNum, oldStyle, newStyle){
			//Store Header Content
			var qHeaderContentID = "q" + qNum + "headerContent";
			var qHeaderContent = document.getElementById(qHeaderContentID);
			//Store the old header data just in case bro
			window[qHeaderContentID] = qHeaderContent;
			
			//Get the question area
			var qAreaID = "q" + qNum + "QuestionArea";
			var qArea = document.getElementById(qAreaID);
			//OLD STYLE ID
			var qArchiveID = qAreaID + oldStyle;	
			//NEW STYLE ID
			var qArchiveLookupID = qAreaID + newStyle;
			
			//Store the data
			storeData();
				
			//Restore the old data if it exists otherwise give them some new shit.
			if (window[qArchiveLookupID] && window[qArchiveID]){
				//Grab old data
				var oldData = window[qArchiveLookupID];
				//Store new data
				window[qArchiveLookupID] = qArea.innerHTML;
				//Restore old HTML		
				qArea.innerHTML = oldData;
				//Store new HTML
				window[qArchiveLookupID] = qArea.innerHTML;
			}
			else{
				if (newStyle == "multipleChoice"){
					//Store the old HTML 
					window[qArchiveID] = qArea.innerHTML;
					loadMultipleChoice(qNum);
				}
				else if (newStyle == "shortResponse"){
					//Store the old HTML
					window[qArchiveID] = qArea.innerHTML;
					loadShortResponse(qNum);
				}
			}
			//Restore the Data
			restoreData();
			
		}
		function loadMultipleChoice(qNum){
			//we are changing the question area div with innerHTML
			
			var questionInput = "<div class='enterQuestionDiv'><span class='qHeadingTxt'><label class='qLabel' for='q" + qNum + "inputField'>Enter Question " + qNum + ": </label></span><div class='qInputFieldDiv'><input type='text' id='q" + qNum + "inputField' class='qInputField'></div></div>";
			var qChoiceA = "<div id='q" + qNum + "answerChoiceA' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceA'><span class='qChoiceTxt rightAnswerLbl'>Correct Answer: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceA' class='qcInputField'></div></div>";
			var qChoiceB = "<div id='q" + qNum + "answerChoiceB' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceB'><span class='qChoiceTxt wrongAnswerLbl'>Distractor (Wrong Answer): </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceB' class='qcInputField'></div></div>";
	
			var addChoicesDiv = "<div id='addChoicesDiv" + qNum + "' class='addChoicesDiv'></div>";
			var addChoiceButton = "<div class='addChoiceButton button' onClick='addChoice(" + qNum + ")' id='addChoiceQ" + qNum + "'>Add Another Distractor</div>";
			var removeChoiceButton =  "<div class='removeChoiceButton button disabledButton' onClick='removeMultipleChoice(" + qNum + ")' id='removeChoiceQ" + qNum + "'>Remove Distractor</div>";
			//I dont think there are any hanging divs but add a </div> tag if it looks fucked
			var qAreaHTML = questionInput + qChoiceA + qChoiceB + addChoicesDiv + addChoiceButton + removeChoiceButton;
			
		
			//Set the question area
			var qAreaID = "q" + qNum + "QuestionArea";
			var qArea = document.getElementById(qAreaID);
			qArea.innerHTML = qAreaHTML; 
			
		}
		function setCaseSensitivity(qNum){
			var eID = "q" + qNum + "caseSensitiveButton";
			var isChecked = document.getElementById(eID).checked;
						
			if (!isChecked){
				if (window.dataStore[eID]){
					if (debugging){
						console.log('deleting stored case senstivitivy preferences');
					}
					delete window.dataStore[eID];
				}
			}
			else{
				window.dataStore[eID] = isChecked;
			}

		}
		function loadShortResponse(qNum){
			//Begin with one correct answer
			window["q" + qNum + "correctAnswerCount"] = 1;
			
			var questionInput = "<div class='enterQuestionDiv'><span class='qHeadingTxt'><label class='qLabel' for='q" + qNum + "inputField'>Enter Question " + qNum + ": </label></span><div class='qInputFieldDiv'><input type='text' id='q" + qNum + "inputField' class='qInputField'></div></div>";
			var rightAnswer1 = "<div id='q" + qNum + "rightAnswer1Div' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "rightAnswer1'><span class='qChoiceTxt rightAnswerLbl'>Correct Answer: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "rightAnswer1' class='qcInputField'></div></div>";
			
			var addChoicesDiv = "<div id='addChoicesDiv" + qNum + "' class='addChoicesDiv'></div>";
			var addChoiceButton = "<div class='addChoiceButton button' onClick='addCorrectAnswer(" + qNum + ")' id='addChoiceQ" + qNum + "'>Add Another Acceptable Answer</div>";
			var removeChoiceButton =  "<div class='removeChoiceButton button disabledButton' onClick='removeChoice(" + qNum + ")' id='removeChoiceQ" + qNum + "'>Remove Correct Answer</div>";
			var makeCaseSensitiveButton ="<div id='makeCaseSensitiveButton" + qNum + "' class='manualOrderButtonContainer'><label for='q" + qNum + "caseSensitiveButton'><div class='mobInputContainer'><input type='checkbox' id='q" + qNum + "caseSensitiveButton' onClick='setCaseSensitivity(" + qNum + ")'><span class='mobLabeltxt'>Make Case Sensitive?</span></div></label></div>";

			
			var shortResponseHTML = questionInput + rightAnswer1 + addChoicesDiv + addChoiceButton + removeChoiceButton + makeCaseSensitiveButton;
			
			var qAreaID = "q" + qNum + "QuestionArea";
			var qArea = document.getElementById(qAreaID);
			qArea.innerHTML = shortResponseHTML; 
		}
		function addTitleAndDescriptionBox(){
			//Header Fields and Divs for First Question load
			var testTitleHeader = "<div class='test-title-and-subtitle-div'><div class='test-title-txt'>Test Title</div>";
			var testTitleDir = "<div class='test-title-div-dir'>Enter the title of your test and a short description for your test takers.</div></div>";
			var testTitleInput = "<div class='enterTitleDiv'><span class='titleTxtFL'><label class='qLabel' for='testTitleInputField'>Enter Test Title</label></span><div class='qInputFieldDiv'><input type='text' id='testTitleInputField' class='qInputField'></div></div>";
			var testDescriptionInput = "<div class='enterDescriptionDiv'><div class='testDescriptionHeadingTxt'><label class='qLabel' for='testDescriptionInputField'>Enter Test Description</label></div><div class='testDescriptionInputDiv'><textarea rows='5' id='testDescriptionInputField' class='testDescriptionInputField'></textarea></div></div>";
			
			var testTitleAndSubtitleHTML = "<div id='testTitleAndSubtitleHTML' class='content-section'>" + testTitleHeader + testTitleDir + testTitleInput + testDescriptionInput + "</div>";

			//Create it and Set it
			var lastQDivID = "start-div";
			var newDiv = document.createElement('div');
			var divID = 'titleAndSubtitleDiv';
			newDiv.setAttribute('id',divID);
			newDiv.setAttribute('class', 'content-section titleAndSubtitleDiv');
			//setInnerHTML(divID, manualOrderContentDivHTML);
			document.getElementById(lastQDivID).insertAdjacentHTML('afterend', testTitleAndSubtitleHTML);
			//setMOdefaultOrder(qNum);
		}
		function createQuestion(qNum){
			var headerContentDiv = "<div class='headerContent' id='q"+ qNum + "headerContent'>";
			var qHeading = "<h2 class='qStyleChoice'>Question #" +qNum+"</h2>";
			var qStyleChoiceTxt = "<p class='qStyleChoice'>Choose a question style.</p>";
			var qStyleChoiceName = "qStyleChoice" + qNum;
			var mChoiceRadio = "<div class='qStyleRadio'><input type='radio' class='qStyleChoice' onclick='qFormat(" + qNum + ")' id='"+qStyleChoiceName+"a' name='"+qStyleChoiceName+"' value='multipleChoice' checked><label for='"+qStyleChoiceName+"a'><span class='selector-font'>Multiple Choice</span></label></div>";
			var fBlankRadio = "<div class='qStyleRadio'><input type='radio' class='qStyleChoice' onclick='qFormat(" + qNum + ")' id='"+qStyleChoiceName+"b' name='"+qStyleChoiceName+"' value='shortResponse'><label for='"+qStyleChoiceName+"b'><span class='selector-font'>Short Response</span></label></div>"
			var qChoiceHTML = headerContentDiv + qHeading + qStyleChoiceTxt + "<div class='qStyleChoiceDiv' id='qStyleChoiceDiv"+ qNum + "'>" + mChoiceRadio + fBlankRadio + "</div></div>";
			

			var questionArea = "<div class='questionArea' id='q" + qNum + "QuestionArea'>";
			var questionInput = "<div class='enterQuestionDiv'><span class='qHeadingTxt'><label class='qLabel' for='q" + qNum + "inputField'>Enter Question " + qNum + ": </label></span><div class='qInputFieldDiv'><input type='text' id='q" + qNum + "inputField' class='qInputField'></div></div>";
			
			var qChoiceA = "<div id='q" + qNum + "answerChoiceA' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceA'><span class='qChoiceTxt rightAnswerLbl'>Correct Answer: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceA' class='qcInputField'></div></div>";
			var qChoiceB = "<div id='q" + qNum + "answerChoiceB' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceB'><span class='qChoiceTxt wrongAnswerLbl'>Distractor (Wrong Answer): </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceB' class='qcInputField'></div></div>";
			var addChoicesDiv = "<div id='addChoicesDiv" + qNum + "' class='addChoicesDiv'></div>";
			var addChoiceButton = "<div class='addChoiceButton button' onClick='addChoice(" + qNum + ")' id='addChoiceQ" + qNum + "'>Add Another Distractor</div>";
			var removeChoiceButton =  "<div class='removeChoiceButton button disabledButton' onClick='removeMultipleChoice(" + qNum + ")' id='removeChoiceQ" + qNum + "'>Remove Distractor</div>";
			var manualChoiceOrderButton ="<div id='manualOrderButtonContainer" + qNum + "' class='manualOrderButtonContainer'><label for='manualOrderButton'><div class='mobInputContainer'><input type='radio' id='q" + qNum + "manualOrderBtn' onClick='manualOrderButton(" + qNum + ")'><span class='mobLabeltxt'>Order Choices Manually?</span></div></label></div>";

			
			var qInputHTML = "<div class='qInputDiv' id='qInputDiv"+ qNum + "'>" + questionArea + questionInput + qChoiceA + qChoiceB + addChoicesDiv + addChoiceButton + removeChoiceButton + manualChoiceOrderButton + "</div></div>";
			var newqDiv = "<div class='content-section questionDiv' id='q"+ qNum + "Div'>" + qChoiceHTML + qInputHTML + "</div>";
			//Set q1 Answer Choices AND all other questions to the default of 2.
			window["q" + qNum + "acc"] = 2;
			//Track the style to handle shifts
			window["q" + qNum + "style"] = "multipleChoice";
			//window.q1acc;
			
			if (qNum == 1){
				addTitleAndDescriptionBox();
				var q1Div =  document.getElementById('q1Div');
				q1Div.innerHTML = qChoiceHTML + qInputHTML;
				addTestMakerButtons();
			}
			else{
				storeData();
				var testMakerDiv = document.getElementById('test-maker-div');
				testMakerDiv.innerHTML += newqDiv;
				if (qNum == 2){
					document.getElementById("q"+ qNum + "Div").scrollIntoView();
				}
				restoreData();
			}
			totalQuestions++;
			nextQuestion++;
			
		}
		function setDefaultRange(inputID, choicesCount){
			if (choicesCount == 2){
				setThisValue(inputID, "1,2");
			}
			else if (choicesCount == 3){
				setThisValue(inputID, "1,2,3");
			}
			else if (choicesCount == 4){
				setThisValue(inputID, "1,2,3,4");
			}
			else if (choicesCount == 5){
				setThisValue(inputID, "1,2,3,4,5");
			}
			else if (choicesCount == 6){
				setThisValue(inputID, "1,2,3,4,5,6");
			}
		}
		//Sets the manual order default for when someone hits the manually order button
		function setMOdefaultOrder(qNum){
		
			var moInputFieldID = "q" + qNum + "moInputField";
			//get answer options
			var inputFieldaID = "q" + qNum + "choiceA";
			var inputFieldbID = "q" + qNum + "choiceB";
			var inputFieldcID = "q" + qNum + "choiceC";
			var inputFielddID = "q" + qNum + "choiceD";
			var inputFieldeID = "q" + qNum + "choiceE";
			var inputFieldfID = "q" + qNum + "choiceF";
			
			
			var choicesCount = 0;
			
			if (document.getElementById(inputFieldaID)){
				choicesCount++;
			}
			if (document.getElementById(inputFieldbID)){
				choicesCount++;
			}
			if (document.getElementById(inputFieldcID)){
				choicesCount++;
			}
			if (document.getElementById(inputFielddID)){
				choicesCount++;
			}
			if (document.getElementById(inputFieldeID)){
				choicesCount++;
			}
			if (document.getElementById(inputFieldfID)){
				choicesCount++;
			}
			console.log('choices count = ' + choicesCount);
			setDefaultRange(moInputFieldID, choicesCount);
			
		}
		//This function verifies that the manually ordered answer choice input is properly formatted
		function verifyManualValues(eID, qNum){
			//Set control variable
			var realNumbers = true;
			//Get number of choices
			var choiceNum = window["q" + qNum + "acc"];
			
			//Get field input
			var qcOrderFieldValue = returnValue(eID);
			//Turn them into a number object that we can loop and check
			var convertedValues = qcOrderFieldValue.split(",").map(Number);
			
			//Check for the correct number of choices
			if (choiceNum != convertedValues.length){
				setDefaultRange(eID, choiceNum);
				realNumbers = false;
				alert('You have too many or too few answer choices. Resetting your order... Press the red button to randomize your answer choices.');
				return;
			}
			
			//Run that loop
			let checkForNAN = convertedValues;
			for (let i = 0; i < checkForNAN.length; i++) {
				//Check for non-numbers
				if (isNaN(checkForNAN[i])){
					realNumbers = false;
					alert('You can only put numbers in this box. Resetting the score ranges... Push the red cancel button to randomize your answer choices.')
					//RESET THE ANSWERS
					setDefaultRange(eID, choiceNum);
					break;
				}
				//Check for too big numbers
				if (checkForNAN[i] > choiceNum){
					realNumbers = false;
					setDefaultRange(eID, choiceNum);
					alert('One of your numbers is greater than the number of choices that you have. This will not work. Resetting the score ranges... Push the red cancel button to randomize your answer choices.')
					break;
				}
			}
			if (realNumbers){
				//make sure all the numbers are unique
				const unique = (value, index, self) => {
  					return self.indexOf(value) === index
				}

				const uniqueNumbers = convertedValues.filter(unique);
				//We dont have enough unique numbers to represent the number of answer choices. This must be rejected. They have duplicated numbers.
				if (uniqueNumbers.length != choiceNum){
					realNumbers = false;
					//RESET THE ANSWERS
					alert('You have ' + uniqueNumbers.length + ' answer choices but you have only placed ' + choiceNum + '. I will reset the ranges. Try again or push the red cancel button to just randomize your choices instead of manually programming the order.')
					setDefaultRange(eID, choiceNum);
				}
				
			}
			if (realNumbers){
				if (debugging){
					console.log('This is a properly formed manual answer selection range.')
				}
			}
			else{
				setDefaultRange(eID, choiceNum);
			}
		}

		function manualOrderButton(qNum){
			if (window["manualOrderQ" + qNum + "DivAdded"] != true){
				//Set global control variable to prevent million div adds.
				window["manualOrderQ" + qNum + "DivAdded"] = true;		 		
				////MANUAL ORDER BUTTON
				var mcobID = 'manualOrderButtonContainer' + qNum
				var manualOrderContentDiv = "<div id='q" + qNum + "manualOrderContentDiv' class='content-section manualOrderContentDiv'>";
				var moHeaderContentDiv = "<div class='headerContent' id='q"+ qNum + "moHeaderContent'>";
				var moHeading = "<div class='cu-header-txt'>Order Choices For Question #" +qNum+"?</div>";
				var moDir = "<div class='cu-dir2'>Manually order your answer choices by entering the order in the field. <span style='text-decoration:underline;'>ANSWER CHOICES WILL ALWAYS SERVE IN THIS ORDER</span>. The number 1 is ALWAYS the correct answer. PRESS the red 'CANCEL' button TO SERVE the answer choices RANDOMLY instead.</div>";
				var moInput = "<div class='moOrderInputDiv'><span class='moHeadingText'><label class='qLabel' for='q" + qNum + "moInputField'>Set Order For Question " + qNum + ": </span><div class='moqcInputDiv'><input type='text' id='q" + qNum + "moInputField' onchange='verifyManualValues(this.id, " + qNum +")' class='moqcInputField'></div></label></div>";
				var moCancelButton = "<div class='cancelMOBdiv' id='cancelMOBdivForQ"+ qNum +"'><div id='cancelMObuttonForQ"+ qNum +"' class='bigButton cancelMO' onClick='cancelMO(" + qNum + ")'>Cancel and Randomize</div></div>";
				var manualOrderContentDivHTML = manualOrderContentDiv + moHeaderContentDiv + moHeading + moDir + moInput + moCancelButton + "</div>"; //Must close an open div
			
				//Create it and Set it
				var lastQDivID = "q" + qNum + "Div";
				var newDiv = document.createElement('div');
				var divID = 'q' + qNum + 'manualOrderContentDiv';
				newDiv.setAttribute('id',divID);
				newDiv.setAttribute('class', 'content-section manualOrderContentDiv');
				//setInnerHTML(divID, manualOrderContentDivHTML);
				document.getElementById(lastQDivID).insertAdjacentHTML('afterend', manualOrderContentDivHTML);
				setMOdefaultOrder(qNum);
 				//document.getElementById(lastQDivID).append(newDiv);
 			}
		}
		function cancelMO(qNum){
			//Remove The Div
			//Set control value
			window["manualOrderQ" + qNum + "DivAdded"] = false;
			//Remove DIV
			var divID = "q" + qNum + "manualOrderContentDiv";
			document.getElementById(divID).remove();
			//Reset Manual Ordering Radio Button
			var radioButtonUncheckID = "q" + qNum + "manualOrderBtn";
			document.getElementById(radioButtonUncheckID).checked = false;
			//
		}
		function addTestMakerButtons(){
			var testMakerButtons = document.getElementById('test-maker-buttons');
			var addAnotherQButton = "<div class='mt-button nav-button mediumButton' onClick='addAnotherQ()' id='addAnotherQ'>Add Another Question</div>";
			var submitButton = "<div class='mt-button nav-button mediumButton' onClick='makeNFT()' id='makeNFT'>Make Your NFT</div>";	
			var tmButtonHTML = "<div class'tmButton-Div'>" + addAnotherQButton + submitButton + "</div>";
			testMakerButtons.innerHTML += tmButtonHTML;
		}
		function qFormat(qNum){
			var rbName = "qStyleChoice" + qNum;
			var rbNameA =rbName + "a";
			var rbNameB = rbName + "b";
			var qs1 = document.getElementById(rbNameA).checked;
			var qs2 = document.getElementById(rbNameB).checked;
			
			var oldQStyle = window["q" + qNum + "style"];
			
			//changeQuestionFormat(qNum, oldStyle, newStyle){
			
			if (qs1){
				changeQuestionFormat(qNum, oldQStyle, 'multipleChoice');
				//Track the old style to handle shifts
				window["q" + qNum + "style"] = "multipleChoice";
			}
			else if (qs2){
				changeQuestionFormat(qNum, oldQStyle, 'shortResponse');
				//Track the old style to handle shifts
				window["q" + qNum + "style"] = "shortResponse";
			}
		}
		//This adds a choice for multiple-choice questions
		function addChoice(qNum){
			//How many choices do we have?
			var currentNumberOfChoices = window["q" + qNum + "acc"];
			//Where are we putting the new choices?
			var qDivVar = "addChoicesDiv" + qNum;
			var qDiv = document.getElementById(qDivVar);
			var newChoice;
			
			//Store the data because INNERHTML erases users' input
			storeData();
			
			if (currentNumberOfChoices == 2){
			//Add a choice
				newChoice  = "<div id='q" + qNum + "answerChoiceC' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceC'><span class='qChoiceTxt wrongAnswerLbl'>Distractor 2: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceC' class='qcInputField'></div></div>";
				window["q" + qNum + "acc"]++;
				qDiv.innerHTML += newChoice;
				//Enable Remove Choice Button
				//enableRemoveChoiceButton(qNum);
				var buttonID = "removeChoiceQ" + qNum;
				enableButton(buttonID);
			}
			else if (currentNumberOfChoices == 3){
			//Add a choice
				newChoice  = "<div id='q" + qNum + "answerChoiceD' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceD'><span class='qChoiceTxt wrongAnswerLbl'>Distractor 3: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceD' class='qcInputField'></div></div>";
				window["q" + qNum + "acc"]++;
				qDiv.innerHTML += newChoice;
			}
			else if (currentNumberOfChoices == 4){
			//Add a choice
				newChoice  = "<div id='q" + qNum + "answerChoiceE' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceE'><span class='qChoiceTxt wrongAnswerLbl'>Distractor 4: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceE' class='qcInputField'></div></div>";
				window["q" + qNum + "acc"]++;
				qDiv.innerHTML += newChoice;
			}
			else if (currentNumberOfChoices == 5){
			//Add a choice
				newChoice  = "<div id='q" + qNum + "answerChoiceF' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "choiceF'><span class='qChoiceTxt wrongAnswerLbl'>Distractor 5: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "choiceF' class='qcInputField'></div></div>";
				window["q" + qNum + "acc"]++;
				qDiv.innerHTML += newChoice;
				var buttonID = "addChoiceQ" + qNum;
				disableButton(buttonID);
				//disableAddChoiceButton(qNum);
			}
			else {
				alert('That\'s all the choices you can add right now.')
			}
			restoreData();
			
			//Extend the Manual Choices Fields if user is adding choices
			var divID = "q" + qNum + "manualOrderContentDiv";
			if (document.getElementById(divID)){
				setMOdefaultOrder(qNum);
			}
			
		}
		//This adds a correct answer for short response questions
		function addCorrectAnswer(qNum){
			//How many choices do we have?
			var currentNumberOfAnswers = window["q" + qNum + "correctAnswerCount"];
			
			//Where are we putting the new choices?
			var qDivVar = "addChoicesDiv" + qNum;
			var qDiv = document.getElementById(qDivVar);
			var newCorrectAnswer;
			
			//Store the data because INNERHTML erases users' input
			storeData();
			
			if (currentNumberOfAnswers == 1){
				newCorrectAnswer = "<div id='q" + qNum + "rightAnswer2Div' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "rightAnswer2'><span class='qChoiceTxt rightAnswerLbl'>Alternate Correct Answer 1: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "rightAnswer2' class='qcInputField'></div></div>";
				window["q" + qNum + "correctAnswerCount"]++;

				qDiv.innerHTML += newCorrectAnswer;
				//Enable Remove Choice Button
				//enableRemoveChoiceButton(qNum);
				var buttonID = "removeChoiceQ" + qNum;
				enableButton(buttonID);
			}
			else if (currentNumberOfAnswers == 2){
				newCorrectAnswer = "<div id='q" + qNum + "rightAnswer3Div' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "rightAnswer3'><span class='qChoiceTxt rightAnswerLbl'>Alternate Correct Answer 2: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "rightAnswer3' class='qcInputField'></div></div>";
				window["q" + qNum + "correctAnswerCount"]++;
				qDiv.innerHTML += newCorrectAnswer;
			}
			else if (currentNumberOfAnswers == 3){
				newCorrectAnswer = "<div id='q" + qNum + "rightAnswer4Div' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "rightAnswer4'><span class='qChoiceTxt rightAnswerLbl'>Alternate Correct Answer 3: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "rightAnswer4' class='qcInputField'></div></div>";
				window["q" + qNum + "correctAnswerCount"]++;
				qDiv.innerHTML += newCorrectAnswer;
			}
			else if (currentNumberOfAnswers == 4){
				newCorrectAnswer = "<div id='q" + qNum + "rightAnswer5Div' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "rightAnswer5'><span class='qChoiceTxt rightAnswerLbl'>Alternate Correct Answer 4: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "rightAnswer5' class='qcInputField'></div></div>";
				window["q" + qNum + "correctAnswerCount"]++;
				qDiv.innerHTML += newCorrectAnswer;
			}
			else if (currentNumberOfAnswers == 5){
				newCorrectAnswer = "<div id='q" + qNum + "rightAnswer6Div' class='qChoiceDiv enterAnswerChoiceDiv'><label class='qLabel' for='q" + qNum + "rightAnswer6'><span class='qChoiceTxt rightAnswerLbl'>Alternate Correct Answer 5: </span></label><div class='qcInputFieldDiv'><input type='text' id='q" + qNum + "rightAnswer6' class='qcInputField'></div></div>";
				window["q" + qNum + "correctAnswerCount"]++;
				qDiv.innerHTML += newCorrectAnswer;
				//disableAddChoiceButton(qNum);
				var buttonID = "addChoiceQ" + qNum;  
				disableButton(buttonID);
			}
			else {
				alert('That\'s all the correct answers that you can add right now.')
			}
			restoreData();
		}
		function removeMultipleChoice(qNum){
			var currentNumberOfChoices = window["q" + qNum + "acc"];
			if (currentNumberOfChoices < 3){
				alert('You cannot remove anymore distractors. A multiple-choice question must have at least 2 choices.' );	
			}
			else{
				var qcDiv = "q" + qNum + "answerChoiceC";
				if (currentNumberOfChoices == 3){
					//disableRemoveChoiceButton(qNum);
					var buttonID = "removeChoiceQ" + qNum;
					disableButton(buttonID);
				}
				else if (currentNumberOfChoices == 4){
					qcDiv = "q" + qNum + "answerChoiceD";
				}
				else if (currentNumberOfChoices == 5){
					qcDiv = "q" + qNum + "answerChoiceE";
				}
				else if (currentNumberOfChoices == 6){
					qcDiv = "q" + qNum + "answerChoiceF";
					var buttonID = "addChoiceQ" + qNum;
					enableButton(buttonID);
					//enableAddChoiceButton(qNum);
				}
				var qcDivToRemove = document.getElementById(qcDiv);
				//Remove the div
				qcDivToRemove.remove();				
				window["q" + qNum + "acc"]--;
			}
			//Remove Manual Choice Fields if user is removing choices
			var divID = "q" + qNum + "manualOrderContentDiv";
			if (document.getElementById(divID)){
				setMOdefaultOrder(qNum);
			}
			
		}
		function removeChoice(qNum){
			var currentNumberOfAnswers = window["q" + qNum + "correctAnswerCount"];
			
			
			if (currentNumberOfAnswers == 1){
				alert('You cannot remove anymore correct answers or you will have none left.' );
			}
			else{
				var caDiv = "q" + qNum + "rightAnswer2Div";
				if (currentNumberOfAnswers == 2){
					//disableRemoveChoiceButton(qNum);
					var buttonID = "removeChoiceQ" + qNum;
					disableButton(buttonID);
				}
				else if (currentNumberOfAnswers == 3){
					caDiv = "q" + qNum + "rightAnswer3Div";
				}
				else if (currentNumberOfAnswers == 4){
					caDiv = "q" + qNum + "rightAnswer4Div";
				}
				else if (currentNumberOfAnswers == 5){
					caDiv = "q" + qNum + "rightAnswer5Div";
				}
				else if (currentNumberOfAnswers == 6){
					caDiv = "q" + qNum + "rightAnswer6Div";
				}
				var caDivToRemove = document.getElementById(caDiv);
				//Remove the div
				caDivToRemove.remove();				
				window["q" + qNum + "correctAnswerCount"]--;
			}
			
		}
		function storeData(){
			//Create an object literal and stuff it with input ids and values
			window.dataStore = {};
			//Also look for checked radio buttons
			let inputList = Array.from(document.querySelectorAll('[type="text"], [type="radio"]:checked, [type="checkbox"]:checked'));
			for (const input of inputList){
   				window.dataStore[input.id] = input.value;
   				//Maybe add local storage someday
   				//localStorage.setItem(input.id, input.value);
			}
			//Save Description too
			if (typeof returnValue('testDescriptionInputField') === 'string'){
				//Return value and strip linebreaks
				var descripton = returnValue('testDescriptionInputField').replace(/\n/g, '');
				window.dataStore['testDescriptionInputField'] = descripton;
			}
			//console.table(window.dataStore);
		}
		function restoreData(){
			//Unpack the object literal and restore the values to the inputs
			for (let [key, value] of Object.entries(window.dataStore)) {
				var dataToRestore = document.getElementById(key);
				if (dataToRestore){
					if (dataToRestore && dataToRestore.getAttribute('type') == 'radio'  ){
						dataToRestore.checked = true;
					}
					else{
						dataToRestore.value = value;
					}					
				}
				//console.log('dataToRestore = ' + dataToRestore.value)
				//console.log(`key=${key} value=${value}`)
			}
	
		}
		function addAnotherQ(){
			createQuestion(nextQuestion);
		}
		function makeNFT(){
			if (makingNFT){
				alert('You are already making your NFT. Scroll down to upload 1 or more images.')
			}
			else{
				nftMakerDiv = document.getElementById('nftMakerDiv');
				nftMakerDiv.style.visibility="visible";
			
				var headerTxt = "<div id='nftMakerHeaderTxt' class='cu-header-txt'>Upload Your NFT Image</div>";
				var directions = "<div id='nftMakerDirections' class='cu-dir1'>Choose an image that you can award to people who complete your test. This image will be part of the NFT that your test takers can mint.</div>"
				var imgUploader = "<div id='imgUploader1' class='uploader'><input type='file'  accept='image/gif, image/jpeg, image/png, image/svg' name='file1' class='fileSelector' id='file1' onchange='loadFile(event, 1)' style='display: none'></div>";
				var imgUploadButton = "<label for='file1'><div class='button' id='imgUploadButton1'>Upload Image</div></label>";
				var imgRemoveButton = "<div class='button disabledButton' id='imgRemoveButton1' onClick='removeImage(1)'>Remove Image</div>";
				var imgOutput = "<div id='imgOutput1' class='imgOutputer'><img id='output' /></div>";	
			
				nftMakerDiv.innerHTML = headerTxt + directions + imgUploader + imgUploadButton + imgRemoveButton + imgOutput;
				
				var buttonID = "makeNFT";
				makingNFT = true;
				disableButton(buttonID);
				//Move the page down or user might not be aware new content has been added below.
				document.getElementById("imgUploadButton1").scrollIntoView();
				
			}
		}
		function removeImage(imgNum){
			if (imgNum == 1){
				if (document.getElementById('output').src){
					var image = document.getElementById('output');					
					image.removeAttribute("src");
					//Disable Button
					var buttonID = "imgRemoveButton1";
					disableButton(buttonID);
					//Enable Button
					buttonID = "imgUploadButton1";
					enableButton(buttonID);	
				}
			}
			else if (imgNum == 2){
				if (document.getElementById('output2').src){
					var image = document.getElementById('output2');					
					image.removeAttribute("src");
					//Disable Button
					var buttonID = "imgRemoveButton2";
					disableButton(buttonID);
					//Enable Button
					buttonID = "imgUploadButton2";
					enableButton(buttonID);	
				}
			}
			else if (imgNum == 3){
				if (document.getElementById('output3').src){
					var image = document.getElementById('output3');					
					image.removeAttribute("src");
					//Disable Button
					var buttonID = "imgRemoveButton3";
					disableButton(buttonID);
					//Enable Button
					buttonID = "imgUploadButton3";
					enableButton(buttonID);	
				}
			}
			else if (imgNum == 4){
				if (document.getElementById('output4').src){
					var image = document.getElementById('output4');					
					image.removeAttribute("src");
					//Disable Button
					var buttonID = "imgRemoveButton4";
					disableButton(buttonID);
					//Enable Button
					buttonID = "imgUploadButton4";
					enableButton(buttonID);	
				}
			}
			else if (imgNum == 5){
				if (document.getElementById('output5').src){
					var image = document.getElementById('output5');					
					image.removeAttribute("src");
					//Disable Button
					var buttonID = "imgRemoveButton5";
					disableButton(buttonID);
					//Enable Button
					buttonID = "imgUploadButton5";
					enableButton(buttonID);	
				}
			}
		}
		function addMakerOptionsForNFT(){
			nftMakerOptionsDiv = document.getElementById('nftMakerOptionsDiv');
			nftMakerOptionsDiv.style.display="block";
			
			var headerTxt = "<div id='nftMakerHeaderTxt' class='cu-header-txt'>How to Award Your NFT to Test Takers?</div>";
			var directions = "<div id='nftMakerDirections' class='cu-dir1'>You can offer your NFT for mint to anyone who completes the test or only those who pass a threshold of correct answers.</div>";
			var radioDivA = "<div class='radioButtonContainer' id='nftMakerOptionsRBContainer'><div class='qStyleRadio'><input type='radio' class='qStyleChoice' onclick='nftMakerOptionsAdjust(1)' id='nftMakerOption1' name='nftMakerOptions' value='allMint' checked><label for='nftMakerOption1'><span class='selector-font'>Allow Everyone Who Takes Your Test to Mint Your NFT</span></label></div>";
			var radioDivB = "<div class='qStyleRadio'><input type='radio' class='qStyleChoice' onclick='nftMakerOptionsAdjust(2)' id='nftMakerOption2' name='nftMakerOptions' value='restrictMint'><label for='nftMakerOption2'><span class='selector-font'>Require Users to Answer Some Percentage of Questions Correctly</span></label></div>";
			//var radioDivC = "<div class='qStyleRadio'><input type='radio' class='qStyleChoice' onclick='nftMakerOptionsAdjust(3)' id='nftMakerOption3' name='nftMakerOptions' value='multiMint'><label for='nftMakerOption3'><span class='selector-font'>Award Different NFTs Based on Percentage Correct</span></label></div></div>";

			nftMakerOptionsDiv.innerHTML = headerTxt + directions + radioDivA + radioDivB; // + radioDivC;
			var submitTestButtonDiv = document.getElementById('createTestButtonDiv');
			submitTestButtonDiv.style.display = 'block';
			
			if (lastCompletedNFT == 0){
				lastCompletedNFT++;
			};
			
		}
		function nftMakerOptionsAdjust(choice){
			
			var nftMode2 = document.getElementById('nftThresholdSetter1');
			var nftMode3 = document.getElementById('multi-nft-div');
			
			if (choice == 1){
				//Clear the Multi NFT Maker Inputs
				clearNFTMKRinputs();
				nftMode2.style.display = 'none';
				nftMode3.style.display = 'none';
				//Hide this button if it exists
				if (document.getElementById('addAnotherNFTButton')){
					var makeThisButtonDisappear = document.getElementById('addAnotherNFTButton');
					makeThisButtonDisappear.style.display = 'none';		
				}
			}
			else if (choice == 2){
				nftMode2.style.display = 'block';
				nftMode3.style.display = 'none';
				var setThis = document.getElementById('thresholdSetter1');
				setThis.value = '59';
				//Try setting the values
				resetMultiNFTScoreValues();
				var makeThisButtonAppear = document.getElementById('addAnotherNFTButton');
				makeThisButtonAppear.style.display = 'inline-flex';			
			}

		}
		function clearNFTMKRinputs(){
			//Rollback Control Variable
			NFTcount = 1;
			//Clear Data
			if (document.getElementById('thresholdSetter1')){
				var clearThis = document.getElementById('thresholdSetter1');
				clearThis.value = '';
			}
			//Reset Button
			if (document.getElementById('addAnotherNFTButton')){
				var buttonToEnable = document.getElementById('addAnotherNFTButton');
				if (buttonToEnable.classList.contains('disabledButton')){
					enableButton(buttonToEnable.id);
				}
			}
		}
		function hideNFTdiv(eID){
			if (document.getElementById(eID)){
				el = document.getElementById(eID);
				el.style.display = "none";
			}
			else{
				if (debugging){
					alert(eID + 'cant be found')
				}
			}
		}
		function showNFTdiv(eID){
			if (document.getElementById(eID)){
				el = document.getElementById(eID);
				el.style.display = "block";
			}
			else{
				if (debugging){
					alert(eID + 'cant be found')
				}
			}
		}
		function deleteNFT(which){
			
			//How many NFTs I got?

			//Attempting to remove an NFT from the middle.
			if (which < NFTcount){
				var msg = 'If you remove NFT ' + which + ', you will remove all NFTs after it. Are you sure you want to do this?';
				if (confirm(msg)) {
					if (which == 2){
						//Set control variables
						nft2removed = true;
  						nft3removed = true;
  						nft4removed = true;
  						nft5removed = true;
  						//Remove Images
  						removeImage(2);
  						removeImage(3);
  						removeImage(4);
  						removeImage(5);
  						//Hide divs
  						hideNFTdiv('nft2Div');
  						hideNFTdiv('nftThresholdSetter2');
  						hideNFTdiv('nft3Div');
  						hideNFTdiv('nftThresholdSetter3');
  						hideNFTdiv('nft4Div');
  						hideNFTdiv('nftThresholdSetter4');
  						hideNFTdiv('nft5Div');
  						hideNFTdiv('nftThresholdSetter5');
  						//Restore Control Variables
  						NFTcount = 1;
  						lastCompletedNFT = 1;
  						
					}
					else if (which == 3){
  						nft3removed = true;
  						nft4removed = true;
  						nft5removed = true;
  						removeImage(3);
  						removeImage(4);
  						removeImage(5);
  						hideNFTdiv('nft3Div');
  						hideNFTdiv('nftThresholdSetter3');
  						hideNFTdiv('nft4Div');
  						hideNFTdiv('nftThresholdSetter4');
  						hideNFTdiv('nft5Div');
  						hideNFTdiv('nftThresholdSetter5');
  						//Restore Control Variables
  						NFTcount = 2;
  						lastCompletedNFT = 2;
					}
					else if (which == 4){
  						nft4removed = true;
  						nft5removed = true;
  						removeImage(4);
  						removeImage(5);
  						hideNFTdiv('nft4Div');
  						hideNFTdiv('nftThresholdSetter4');
  						hideNFTdiv('nft5Div');
  						hideNFTdiv('nftThresholdSetter5');
  						//Restore Control Variables
  						NFTcount = 3;
  						lastCompletedNFT = 3;
					}
				}			
			}
			//Taking from the top (safe remove)
			else{
				if (which == 2){
					nft2removed = true;
					NFTcount = 1;
  					lastCompletedNFT = 1;
				}
				else if (which == 3){
					nft3removed = true;
					NFTcount = 2;
  					lastCompletedNFT = 2;
				}
				else if (which == 4){
					nft4removed = true;
					NFTcount = 3;
  					lastCompletedNFT = 3;
				}
				else if (which == 5){
					nft5removed = true;
					NFTcount = 4;
  					lastCompletedNFT = 4;
				}
				removeImage(which);
				var div1ID = 'nft' + which + 'Div';
				var div2ID = 'nftThresholdSetter' + which;
				hideNFTdiv(div1ID);
  				hideNFTdiv(div2ID);
  				var nftCounter = (which - 1);
  				//Restore Control Variables
  				NFTcount = nftCounter;
  				lastCompletedNFT = NFTcount;
			}
			enableButton('addAnotherNFTButton');				
		}
		function addAnotherNFT(){
			//alert('called here lastCompletedNFT = ' + lastCompletedNFT + " NFTcount = " + NFTcount + 'nft2removed = '+ nft2removed + ' nft3removed = ' + nft3removed);
			
			var nftMode3 = document.getElementById('multi-nft-div');
			//Make the Multi NFT Div appear if it doesn't already exist.
			if (nftMode3.style.display != "block"){
				nftMode3.style.display = "block";
			}	
			//Check for Redisplays first
			if (nft2removed && lastCompletedNFT == 1 && NFTcount == 1 ){
				showNFTdiv('nft2Div');
				NFTcount++;
				disableButton('addAnotherNFTButton');
				setDisplayValues();
			}
			else if (nft3removed && lastCompletedNFT == 2 && NFTcount == 2 ){
				showNFTdiv('nft3Div');
				NFTcount++;
				disableButton('addAnotherNFTButton');
				setDisplayValues();
			}
			else if (nft4removed && lastCompletedNFT == 3 && NFTcount == 3 ){
				showNFTdiv('nft4Div');
				NFTcount++;
				disableButton('addAnotherNFTButton');
				setDisplayValues();
			}
			else if (nft5removed && lastCompletedNFT == 4 && NFTcount == 4 ){
				showNFTdiv('nft5Div');
				NFTcount++;
				disableButton('addAnotherNFTButton');
				setDisplayValues();
			}
			//Adding NFT2
			else if (lastCompletedNFT == NFTcount && NFTcount == 1){
				//Disable add new button
				disableButton('addAnotherNFTButton');
				NFTcount++;
				setDisplayValues();
			}
			//WE ARE ADDING THE 3rD NFT!!!!!!!!!!!!!
			else if (lastCompletedNFT == NFTcount && NFTcount == 2){
				//Make new DIV visible here
				disableButton('addAnotherNFTButton');
				NFTcount++;
				setDisplayValues();
				//REVEAL THE THRID DIV!!!!!
				var nft3Div = document.getElementById('nft3Div');
				nft3Div.style.display = 'block';	
			}
			//Adding #4
			else if (lastCompletedNFT == NFTcount && NFTcount == 3){
				//Make new DIV visible here
				disableButton('addAnotherNFTButton');
				NFTcount++;
				setDisplayValues();
				//REVEAL THE Fourth DIV!!!!!
				var nft4Div = document.getElementById('nft4Div');
				nft4Div.style.display = 'block';	
			}
			//Adding #5
			else if (lastCompletedNFT == NFTcount && NFTcount == 4){
				//Make new DIV visible here
				disableButton('addAnotherNFTButton');
				NFTcount++;
				setDisplayValues();
				//REVEAL THE Fourth DIV!!!!!
				var nft5Div = document.getElementById('nft5Div');
				nft5Div.style.display = 'block';	
			}
			else{
				if (NFTcount == 5){
					alert('You cannot add any more NFT images to this test at this time. Maybe finish this test and make a new one?');
				}
				else{
					alert('You must complete the NFT on which you are working before you can start another.');
				}
			}
			
			
			/* WORKING HERE
			
			
			
			if (nft3removed){
			//FUCKED BUT HERE WE ARE
			showNFTdiv(NFTcount);
			}
			//MBRING DIVS BACK			nftCounter
			*/		
		}
		function setDisplayValues(){
			//Get my ranges and display them
			if (scoreThreshold2){
				document.getElementById('nft2-max-score').innerHTML = (scoreThreshold1) + "%";
				document.getElementById('nft2-max-scoreB').innerHTML = (scoreThreshold1) + "%";				
			}
			if (scoreThreshold3){
				document.getElementById('nft3-max-score').innerHTML = (scoreThreshold2) + "%";
				document.getElementById('nft3-max-scoreB').innerHTML = (scoreThreshold2) + "%";			
			}
			if (scoreThreshold4){
				document.getElementById('nft4-max-score').innerHTML = scoreThreshold3 + "%";
				document.getElementById('nft4-max-scoreB').innerHTML = scoreThreshold3 + "%";		
			}
			if (scoreThreshold5){
				document.getElementById('nft5-max-score').innerHTML = scoreThreshold4 + "%";
				document.getElementById('nft5-max-scoreB').innerHTML = scoreThreshold4 + "%";		
			}
		}

		function validateInteger(str) {
			str = str.trim();
			if (!str) {
				return false;
			}
			str = str.replace(/^0+/, "") || "0";
			var n = Math.floor(Number(str));
			return n !== Infinity && String(n) === str && n >= 0;
		}
		function setScoreThresholds(){
			//Clear old values
			scoreThreshold1 = null;
			scoreThreshold2 = null;
			scoreThreshold3 = null;
			scoreThreshold4 = null;
			scoreThreshold5 = null;
			
			//Update these new values if they exist	and are valid	else set them to some valid and sensible number (as a string)	
			if (returnValue('thresholdSetter1')){
				scoreThreshold1 = validateInteger(returnValue('thresholdSetter1')) ? returnValue('thresholdSetter1') : "89";
				setThisValue('thresholdSetter1', scoreThreshold1);
			}
			if (returnValue('thresholdSetter2')){
				scoreThreshold2 = validateInteger(returnValue('thresholdSetter2')) ? returnValue('thresholdSetter2') : "70";
				setThisValue('thresholdSetter2', scoreThreshold2);
			}
			if (returnValue('thresholdSetter3')){
				scoreThreshold3 = validateInteger(returnValue('thresholdSetter3')) ? returnValue('thresholdSetter3') : "60";
				setThisValue('thresholdSetter3', scoreThreshold3);
			}
			if (returnValue('thresholdSetter4')){
				scoreThreshold4 = validateInteger(returnValue('thresholdSetter4')) ? returnValue('thresholdSetter4') : "50";
				setThisValue('thresholdSetter4', scoreThreshold4);
			}
			if (returnValue('thresholdSetter5')){
				scoreThreshold5 = validateInteger(returnValue('thresholdSetter5')) ? returnValue('thresholdSetter5') : "0";
				setThisValue('thresholdSetter5', scoreThreshold5);
			}
		}

		function resetMultiNFTScoreValues(){
			clearThisValue('thresholdSetter1');
			clearThisValue('thresholdSetter2');
			clearThisValue('thresholdSetter3');
			clearThisValue('thresholdSetter4');
			clearThisValue('thresholdSetter5');
			
			setThisValue('thresholdSetter1', "89");
			setThisValue('thresholdSetter2', "80");
			setThisValue('thresholdSetter3', "70");
			setThisValue('thresholdSetter4', "60");
			setThisValue('thresholdSetter5', "0");
		}
		function verifyMultiValues(eID){
			
			setScoreThresholds();
			scoreRangesValid = false;
			
			/*IF ANY SCORE++ IS BIGGER THAN SCORE THAN SCORE IS INVALID SO RESET FIELDS FOR USER*/
			//Score 2 is bigger than score 1. Reset all values.
			if (scoreThreshold2 && scoreThreshold1 <= scoreThreshold2 && NFTcount < 1){
				msg = scoreThreshold2 + ' is bigger than or equal to ' + scoreThreshold1 + '. This will not work. I will reset the values and you can try to set them again if you want.';
				alert(msg);
				resetMultiNFTScoreValues();
				scoreRangesValid = true;
			}
			//Score 3 is bigger than score 2. Reset all values.
			else if (scoreThreshold3 && scoreThreshold2 <= scoreThreshold3 && NFTcount < 2){
				msg = scoreThreshold3 + ' is bigger than or equal to ' + scoreThreshold2 + '. This will not work. I will reset the values and you can try to set them again if you want.';
				alert(msg);
				resetMultiNFTScoreValues();
				scoreRangesValid = true;	
			}
			//Score 4 is bigger than score 3. Reset all values.
			else if (scoreThreshold4 && scoreThreshold3 <= scoreThreshold4 && NFTcount < 3){
				msg = scoreThreshold4 + ' is bigger than or equal to ' + scoreThreshold3 + '. This will not work. I will reset the values and you can try to set them again if you want.';
				alert(msg);
				resetMultiNFTScoreValues();
				scoreRangesValid = true;
			}
			//Score 5 is bigger than score 4. Reset all values.
			else if (scoreThreshold5 && scoreThreshold4 <= scoreThreshold5 && NFTcount < 4){
				msg = scoreThreshold5 + ' is bigger than or equal to ' + scoreThreshold4 + '. This will not work. I will reset the values and you can try to set them again if you want.';
				alert(msg);
				resetMultiNFTScoreValues();
				scoreRangesValid = true;
			}
			
			//Enable the ADD NEW NFT button if it is not enabled yet
			if (lastCompletedNFT == 1 && NFTcount == 2 && scoreRangesValid ){
				lastCompletedNFT++;
				enableButton('addAnotherNFTButton');
			}
			
			//Reset the display values
			adjustMultiValuesForUser();
			setDisplayValues();
			
		}
		function adjustMultiValuesForUser(){
			if (scoreThreshold2 && scoreThreshold1 <= scoreThreshold2){
				if (scoreThreshold2 >= 10){
					scoreThreshold2 = scoreThreshold1 - 10;
					setThisValue('thresholdSetter2', scoreThreshold2);
				} 
			}
			if (scoreThreshold3 && scoreThreshold2 <= scoreThreshold3){
				if (scoreThreshold3 >= 10){
					scoreThreshold3 = scoreThreshold2 - 10;
					setThisValue('thresholdSetter3', scoreThreshold3);
				} 
			}
			if (scoreThreshold4 && scoreThreshold3 <= scoreThreshold4){
				if (scoreThreshold4 >= 10){
					scoreThreshold4 = scoreThreshold3 - 10;
					setThisValue('thresholdSetter4', scoreThreshold4);
				} 
			}
			if (scoreThreshold5 && scoreThreshold4 <= scoreThreshold5){
				if (scoreThreshold5 >= 10){
					scoreThreshold5 = scoreThreshold3 - 10;
					setThisValue('thresholdSetter5', scoreThreshold5);
				} 
			}
		}
		function confirmIt(key, msg){
			if (confirm(msg)) {
  				// Fix it!
  				offToFixIt = true;
  				document.getElementById(key).scrollIntoView();
  				window.scrollBy(0, -150); 
  				document.getElementById(key).focus();
				console.log('He WANT TO FIX IT');
			}
			else{
				if(debugging){
				  console.log(key + ' was not saved to the dataobject.');
				}
			}
		}
		function doesItHasSRC(eID){
			console.log('Does it has source eID = ' + eID);
			if (document.getElementById(eID).src){
				return true; 
			}
			else {
				return false;
			}
		}
		function checkTest(){
			//Show progress of test
			var progressDiv = document.getElementById('test-upload-progress-div');
			progressDiv.style.display="flex";
			//setInnerHTML('upload-status-text', "new status");
			
			//Save
			storeData();
			//Set control variable
			offToFixIt = false;
			//Blacklist values that the user doesn't care about
			const dontCheckTheseKeys = ["thresholdSetter1", "thresholdSetter2", "thresholdSetter3", "thresholdSetter4", "thresholdSetter5"];

			//Also Check for Test Description (textarea)
			if (typeof returnValue('testDescriptionInputField') != 'string' || returnValue('testDescriptionInputField') == '' ){
				var msg = "Your test description field is blank. Do you want to fix it?";
				confirmIt('testDescriptionInputField', msg);
			}

   			for (let [key, value] of Object.entries(window.dataStore)) {
   				if (testTitleInputField)
   				var msg = setChkMSG(key); 
   				if (value == "" && offToFixIt !=true && !dontCheckTheseKeys.includes(key)){
 					confirmIt(key, msg);
   				}
   				//console.log(`key=${key} value=${value}`);
   			}
			
			var nft1src = doesItHasSRC('output');
			var nft2src = doesItHasSRC('output2');
			var nft3src = doesItHasSRC('output3');
			var nft4src = doesItHasSRC('output4');
			var nft5src = doesItHasSRC('output5');
			
			console.log('ok about this warning lets see: NFTcount = ' + NFTcount + " and nft1src = " + nft1src + " and also offToFixIt = " + offToFixIt);
			
   			//Check to see if NFT images are set
   			if (NFTcount >= 1 && nft1src != true && offToFixIt !=true ){ 
   			 	var msg = "You did not assign an image for NFT 1. Do you want to fix it?"; 
   				confirmIt('imgUploadButton1', msg);
   			}
   			else if (NFTcount >= 2 && nft2src != true && offToFixIt !=true ){
   				var msg = "You did not assign an image for NFT 2. Do you want to fix it?"; 
   				confirmIt('imgUploadButton2', msg);
   			}
   			else if (NFTcount >= 3 && nft3src != true && offToFixIt !=true ){
   			 	var msg = "You did not assign an image for NFT 3. Do you want to fix it?"; 
   				confirmIt('imgUploadButton3', msg);
   			}
   			else if (NFTcount >= 4 && nft4src != true && offToFixIt !=true ){
   				var msg = "You did not assign an image for NFT 4. Do you want to fix it?"; 
   				confirmIt('imgUploadButton4', msg);
   			}
   			else if (NFTcount == 5 && nft5src != true && offToFixIt !=true ){
   				var msg = "You did not assign an image for NFT 5. Do you want to fix it?"; 
   				confirmIt('imgUploadButton5', msg);
   			}
   			//All done!
			if (debugging){
	   			console.log('User input checked.')
				console.log(window.dataStore);
			}
			uploadTheTest();
		}
		function setChkMSG(key){
			var referenceToField = key;
			
			//Test Title
			if (referenceToField == 'testTitleInputField'){
				return 'You do not have a title for your test. Do you want to fix it?';
			}
			//Regex Patterns to Make Field Names More Readable By Humans
			let reQinputField = /q[0-9]inputField/;
			let reQchoiceA = /q[0-9]choiceA/;
			let reQchoiceB = /q[0-9]choiceB/;
			let reQchoiceC = /q[0-9]choiceC/;
			let reQchoiceD = /q[0-9]choiceD/;
			let reQchoiceE = /q[0-9]choiceE/;
			let reQchoiceF = /q[0-9]choiceF/;
			let reQrightAnswer1 = /q[0-9]rightAnswer1/;
			let reQrightAnswer2 = /q[0-9]rightAnswer2/;
			let reQrightAnswer3 = /q[0-9]rightAnswer3/;
			let reQrightAnswer4 = /q[0-9]rightAnswer4/;
			let reQrightAnswer5 = /q[0-9]rightAnswer5/;
			let reQrightAnswer6 = /q[0-9]rightAnswer6/;
			
			//Warn User if they left an important field blank and offer them the opportunity to fix it.
			if (reQinputField.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromID(key);
				return ('You left question ' + qNumber + ' blank. Would you like to fix it?')
			}
			else if (reQchoiceA.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromID(key);
				return ('You left choice A for question number ' + qNumber + ' blank. Would you like to fix it?')
			}
			else if (reQchoiceB.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromID(key);
				return ('You left choice B for question number ' + qNumber + ' blank. Would you like to fix it?')
			}
			else if (reQchoiceC.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromID(key);
				return ('You left choice C for question number ' + qNumber + ' blank. Would you like to fix it?')
			}
			else if (reQchoiceD.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromID(key);
				return ('You left choice D for question number ' + qNumber + ' blank. Would you like to fix it?')
			}
			else if (reQchoiceE.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromID(key);
				return ('You left choice E for question number ' + qNumber + ' blank. Would you like to fix it?')
			}
			else if (reQchoiceF.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromID(key);
				return ('You left choice F for question number ' + qNumber + ' blank. Would you like to fix it?')
			}
			else if (reQrightAnswer1.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromIDandSlashTrailingNumber(key);
				return ('You left correct answer field 1 blank for question number ' + qNumber + '. Would you like to fix it?')
			}
			else if (reQrightAnswer2.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromIDandSlashTrailingNumber(key);
				return ('You left correct answer field 2 blank for question number ' + qNumber + '. Would you like to fix it?')
			}
			else if (reQrightAnswer3.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromIDandSlashTrailingNumber(key);
				return ('You left correct answer field 3 blank for question number ' + qNumber + '. Would you like to fix it?')
			}
			else if (reQrightAnswer4.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromIDandSlashTrailingNumber(key);
				return ('You left correct answer field 4 blank for question number ' + qNumber + '. Would you like to fix it?')
			}
			else if (reQrightAnswer5.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromIDandSlashTrailingNumber(key);
				return ('You left correct answer field 5 blank for question number ' + qNumber + '. Would you like to fix it?')
			}
			else if (reQrightAnswer6.test(key)){
				//Removes all letters from ID preserving only the question number.
				var qNumber = getNumberFromIDandSlashTrailingNumber(key);
				return ('You left correct answer field 6 blank for question number ' + qNumber + '. Would you like to fix it?')
			}
			else{
				return (referenceToField + " is blank. Do you want to fix it?");
			}
		}
	</script>