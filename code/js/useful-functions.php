<script>
		//Useful functions **************
		/*********************** USEFUL FUNCTIONS **************************/

		//Set InnerHTML Safely
		function setInnerHTML(setterFieldID, value){
			if (document.getElementById(setterFieldID)){
				var setThis = document.getElementById(setterFieldID);
				setThis.innerHTML = value;
			}
			else{
				if (debugging){
					console.log(setterFieldID + ' InnerHTML wont set for some reason.');
				}
			}
		}
		//Return InnerHTML Safely
		function returnInnerHTML(eID){
			if (document.getElementById(eID)){
				return document.getElementById(eID).innerHTML;	
			}
			else{
				if (debugging){
					console.log('I cant return the innerHTML on element' + eID + ' for some reason.');
				}
			}
		}
		function getNumberFromID(ID){
			var qNumber;
			return qNumber = ID.replace(/[A-Za-z]/g, '');
		}
		function getNumberFromIDandSlashTrailingNumber(ID){
			var qNumber;
			qNumber = ID.slice(0, -1) 
			return qNumber = qNumber.replace(/[A-Za-z]/g, '');
		}
		function enableButton(eID){
			var buttonID = eID;
			var button = document.getElementById(buttonID);
			button.classList.remove("disabledButton");
		}
		function disableButton(eID){
			var buttonID = eID;
			var button = document.getElementById(buttonID);
			button.classList.add("disabledButton");
		}
		//Return Input Values
		function returnValue(eID){
			if (document.getElementById(eID)){
				if (document.getElementById(eID).value){
					return document.getElementById(eID).value;	
				}
				else{
					if (debugging){
						console.log(eID + ' does not have a value or is set to false.');
					}
				}
			}
			else{
				if (debugging){
					console.log('I cant find element' + eID + '.')
				}
			}
		}
		//Clear Input Values Safely
		function clearThisValue(eID){
			if (document.getElementById(eID)){
				var clearThis = document.getElementById(eID);
				clearThis.value = '';
			}
			else{
				if (debugging){
					console.log(eID + ' wont clear for some reason.');
				}
			}
		}
		//Set Input Values Safely
		function setThisValue(setterFieldID, value){
			if (document.getElementById(setterFieldID)){
				var setThis = document.getElementById(setterFieldID);
				setThis.value = value;
			}
			else{
				if (debugging){
					console.log(setterFieldID + ' wont set for some reason.');
				}
			}
		}
		


</script>