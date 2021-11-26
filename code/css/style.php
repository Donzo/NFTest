<?php
	//Colors
	$cssColor1 = "#D90B1C";
	$cssColor2 = "#FAF566";
	$cssColor3 = "#9ACFDD";
	$cssColor4 = "#CABAAB";
	$cssColor5 = "#202731";
	$greenHex = "lime";
	//$greenHex = "#32CD32";
	$disabledColor = "#EBEBE4";

	if ($alternateStyle){
	/*Set alternate colors if desired
		$color1 = "#D90B1C";
		$color2 = "#FAF566";
		$color3 = "#9ACFDD";
		$color4 = "#CABAAB";
		$color5 = "#202731";
	*/
	}
	
?>

<style>
	html, body {
		background-color:<?php echo $cssColor5; ?>;
		font-family: 'Press Start 2P', cursive;
		margin: 0;
		padding: 0;
		-webkit-tap-highlight-color: rgba(0,0,0,0);
		overscroll-behavior-y: contain;
	}
	input[type="text"]{
		font-family: 'Press Start 2P', cursive;
		padding:.25em .5em;
	}
	img{
		margin: 0;
		max-width:100%; 
		max-height:100%;
	}
	.content{
		background-color:<?php echo $cssColor3; ?>;
		margin:  0 4em 0 4em;
		padding: 2em;
	}
	.content-section{
		background-color:<?php echo $cssColor4; ?>;
		margin: 2em 0;
		padding: 2em;
		border:5px solid <?php echo $cssColor5; ?>;
		line-height:1.7em;
	}
	.header{
		background-color:<?php echo $cssColor1; ?>;
		display: flex;
		justify-content:center; 
		align-items: safe center;
		border:5px solid <?php echo $cssColor2; ?>;
		height:200px;
	}
	.header-logo-img{
  		margin:2em;
  		padding:2em 3em 2em 1em;
  		height: 80%;
  		display: flex;
    	justify-content: center;
	}
	.header-txt-img{
  		margin:2em;
  		justify-content: center;
	}
	.userAccountNumDiv{
		display:flex;
		flex-basis: 100%;
		margin:.5em;
		font-size:.4em;
		overflow-wrap: break-word;
	}
	#userAccountNumber{
		margin-left: auto;
	}
	#start-div{
		padding-bottom:.25em;
	}
	.radioButtonContainer{
		background-color: #F4F1EE;
		border:5px solid <?php echo $cssColor1; ?>;
		-moz-box-shadow: 1px 1px 3px 2px #cabaab;
  		-webkit-box-shadow: 1px 1px 3px 2px #cabaab;
  		box-shadow: 1px 1px 3px 2px #cabaab;
  		padding:1em;
  		margin:1.5em;
	}
	.home-nav-buttons{
		display:flex;
		justify-content:space-around; 
		align-items: safe center;
		margin:1em;
		padding:1em;
		text-align:center;
	}
	.nav-button{
		display:inline-flex;
		font-size:.9em;
		background-color:#C0C0C0;
		border:3px solid <?php echo $cssColor5; ?>;
		margin: 1em;
		padding: .5em;
		cursor: pointer;
	}
	a.nav-button-link{
		text-decoration: none;
		color:#000000;
	}
	.nav-button:hover {
		background-color: <?php echo $cssColor2; ?>;
	}
	
	.button, .bigButton, .mediumButton{
		font-size:.9em;
		display: inline-flex;
		background-color:#C0C0C0;
		border:3px solid <?php echo $cssColor5; ?>;
		margin: 1em;
		padding: .5em;
		cursor: pointer; 
	}
	.button:hover, .bigButton:hover, #addAnotherQ {
		background-color: <?php echo $cssColor2; ?>;
	}
	#addAnotherQ:hover, #makeNFT:hover, #imgUploadButton1:hover, .greenButton{
		background-color:<?php echo $greenHex; ?>;
	}
	.greenButton:hover{
		background-color:<?php echo $cssColor2; ?>;
	}
	.redButton{
		background-color:<?php echo $cssColor1; ?>;
	}
	.redButton:hover{
		background-color:<?php echo $cssColor2; ?>;
	}
	.mediumButton{
		padding:1em;
		font-size:1.1em;
	}
	.bigButton{
		padding:2em;
		font-size:1.3em;
	}
	.cancelMO{
		background-color:<?php echo $cssColor1; ?>;
	}
	.disabledButton, #imgUploadButton1.disabledButton, #makeNFT.disabledButton:hover{
		background-color: <?php echo $disabledColor; ?>;
		color:lightgrey;
		border: #f2f2f2;
		cursor:auto;
	}
	.disabledButton:hover, #imgUploadButton1.disabledButton:hover{
		background-color: <?php echo $disabledColor; ?>;
	}
	/*Test Maker*/
	#test-maker-div{
		visibility:hidden;
	}
	#test-maker-buttons{
		visibility:hidden;
	}
	h2.qStyleChoice{
		display:block;	
	}
	.qStyleRadio{
		margin:.25em 1em;
		display:inline-flex;
	}
	.qStyleChoice{
		margin:.25em 1em;
	}
	.selector-font{
		font-size:.8em;
	}
	#nftMakerOptionsRBContainer{
		display:flex;
		flex-direction: column;
	}
	.rightAnswerLbl{
		color:<?php echo $greenHex; ?>;
	}
	.wrongAnswerLbl{
		color:<?php echo $cssColor1; ?>;
	}
	.enterQuestionDiv, .enterAnswerChoiceDiv, .enterTitleDiv, .enterDescriptionDiv{
		width: 100%;
		margin:1em;
		display: flex;
	}
	.enterDescriptionDiv{
		height:6em;
	}
	
	.moOrderInputDiv{
		width: 50%;
		margin:1em;
		padding:.5em;
		display: inline-flex;
	}
	.content-section.questionDiv{
		padding-bottom:.25em;
	}
		.qInputFieldDiv, .qInputField, .qcInputField, .qcInputFieldDiv, .moqcInputField, .moqcInputDiv, .testDescriptionInputDiv, .testDescriptionInputField{
			width: 100%;
			flex-grow: 1;
			line-height: 2.5em;
		}
		.test-title-and-subtitle-div{
			background-color: <?php echo $disabledColor; ?>;
			border:5px solid <?php echo $cssColor4; ?>;
		}
		.test-title-div-dir{
			font-size: 1.1em;
			margin:0 1em 1.5em 1em;
			padding: .75em .25em .25em .25em;
		}
		.testDescriptionInputDiv{
			line-height: 2em;
		}
		.testDescriptionInputField{
			height:7.77em;
			font-family: 'Press Start 2P', cursive;
			vertical-align: top;
		}
		.test-title-txt{
			font-size:2.25em;
			line-height:1.15em;
			text-align:center;
			padding: .75em .25em .25em .25em;
		}
		.cancelMOBdiv{
			display:inline-flex;
		}
		.cancelMOBdiv:last-child {
			margin-left: auto;
		}
		
		.moqcInputField{
			line-height: 4em;
		}
		.qHeadingTxt, .moHeadingText, .titleTxtFL, .subTitleTxtFL{
			display: inline-flex;
		}
		.titleTxtFL{
			color: <?php echo $cssColor2; ?>;
		}
		.subTitleTxtFL{
			color: <?php echo $cssColor3; ?>;
		}
		

		.manualOrderButtonContainer{
			display: flex;
			justify-content: right;
			line-height: .8em;
		}
		.mobInputContainer{
			background-color: #F1EDE9;
			-moz-box-shadow: 1px 1px 3px 2px #cabaab;
  			-webkit-box-shadow: 1px 1px 3px 2px #cabaab;
  			box-shadow: 1px 1px 3px 2px #cabaab;
  			padding:.25em;
		}
		.moHeadingText{
			color:<?php echo $cssColor2; ?>;
		}
		.mobLabeltxt{
			font-size:.5em;
		}
		
	/*NFT Maker*/
	#nftMakerDiv{
		visibility:hidden;
		background-color: <?php echo $cssColor2; ?>;
	}

	#multi-nft-div, #nftThresholdSetter1, #createTestButtonDiv, #nft3Div, #nftThresholdSetter3, #nft4Div, #nftThresholdSetter4, #nft5Div, #nftThresholdSetter5, #nftMakerOptionsDiv{
		display:none;
	}
	#nftThresholdSetter3
	.cu-header-txt{
		font-size: 1.5em;
		margin:.25em 1em;
	}
	.cu-dir1{
		font-size: 1em;
		margin:.5em 1em;
	}
	.cu-dir2{
		font-size: .75em;
		line-height:1.75em;
		margin:.5em 1em;
	}
	.thresholdSetterDiv{
		font-size: 1em;
		margin:1em;
		display:flex;
		justify-content: center;
	}
		.thresholdSetterDir{
			display:flex;
			margin-top:1em;
			margin-right: 1em;
			flex-basis: 50%;
			align-items: center;
			vertical-align: middle;
			background-color: #F4F1EE;
			border:5px solid <?php echo $cssColor1; ?>;
			-moz-box-shadow: 1px 1px 3px 2px #cabaab;
  			-webkit-box-shadow: 1px 1px 3px 2px #cabaab;
  			box-shadow: 1px 1px 3px 2px #cabaab;
  			padding:1em;
  			
		}
		.input-field-with-directions{
			display:inline-flex;
			flex-direction: column;
			vertical-align: bottom;
		}
		.tiny-directions{
			text-align:center;
		    text-decoration: underline;
			font-size:.5em;
			vertical-align: bottom;
			color: <?php echo $disabledColor; ?>; 
			margin:.1em .25em .05em .5em;
		}
		.value-pop{
			font-size:larger;
			color:<?php echo $cssColor1; ?>;
		}
		.thresholdSetterLabel{
			text-align: right;
			vertical-align: middle;
		}
		input.thresholdSetterInputField{
			height:4em;
			width:4em;
			font-size:2em;
			line-height:2em;
			text-align:center;
			align-items: center;
			margin:.05em .25em .25em .5em;
			flex-grow: 1;
			/*border:3px solid <?php echo $cssColor1; ?>;*/
		}
		
	#nftThresholdSetter2{
		display:none;
	}
	#nftMakerDirections{
		margin-top:2em;
	}
	
	#checkTestButton{
		background-color: <?php echo $cssColor2; ?>;
	}
	#checkTestButton:hover {
		background-color: <?php echo $greenHex; ?>;
	}
	#addAnotherNFTButton{
		display:none;
	}
	#addAnotherNFTButton:hover{
		background-color: <?php echo $greenHex; ?>;
	}
	#addAnotherNFTButton.disabledButton:hover{
		background-color: <?php echo $disabledColor; ?>;
		cursor:auto;
	}	
	#imgOutput1{
		
	}
	input.fileSelector{
		padding:1em;
		margin:1em;
	}
	#test-upload-progress-div{
		display:none;
		justify-content: center;
		margin:2em 2em 3em 2em;
		padding:1em;
	}
	#test-upload-progress{
		display: flex;
		flex-direction: column;
		justify-content:center;
	}
	#loading-wheel{
		display: flex;
		justify-content: center;
		text-align:center;
		margin:auto;
		padding:1em;
	}
	#networkSwitchContainer{
		display:flex;
		justify-content: flex-start;
	}
	#my-results-connect-button{
		display:flex;
		flex-direction: column;
	}
	#connection-in-progress{
		display:none;
	}
	.link-unit-container{
		display:flex;
		justify-content:center;
		flex-direction:column;
		margin:1em;
	}
	p.links{
		text-align: center;
	}
	/*FOOTER*/
	#footer-link-container{
		display: flex; 
   		justify-content: right;
   	}
   	.footer-item{
   		display:inline-flex;
   		font-size:.25em;
   		margin-left:4em;
   	}
   	.hide-on-phone{
	   	display:inline-flex;
  	}
	/* My Results */
	#featured-test-div{
		background-color: <?php echo $disabledColor; ?>;
		border:5px solid <?php echo $cssColor1; ?>;
	}
	.test-group-div{
		margin:1em;
		padding:1em;
	}
	#nft-img-div{
		display:flex;
		justify-content:center;
		padding:2em;
	}
	#nft-img-results-page{
		/*border: 3px dotted <?php echo $disabledColor; ?>;*/
	}
	.header-txt{
		text-align:center;
	}
	.title-txt{
		text-align:center;
		font-size:3em;
	}
	#stats-container-div{
		background-color: <?php echo $disabledColor; ?>;
		border:5px solid <?php echo $cssColor1; ?>;
		padding:2em;
		line-height:2em;
	}
	/*Largest CSS*/
	@media only screen and (min-width: 1599px) {
		.header{
			height:300px;
		}
	}
	/*Large CSS*/
	@media only screen and (max-width: 1598px) and (min-width: 1200px) {
		
	}
	/*Medium CSS*/
	@media only screen and (max-width: 1199px) and (min-width: 1023px) {
		
	}
	/*Small CSS*/
	@media only screen and (max-width: 1022px) and (min-width: 481px) {
		.content{
			margin:  0 .2em 0 .2em;
			padding: .25em;
		}
		.moOrderInputDiv{
			width: 80%;
			margin:.8em;
		}
		.header-logo-img{
  			margin:.25em;
  			padding:.5em 1em 1em 1em;
		}

	}
	/*Smallest CSS*/
	@media only screen and (max-width: 480px){
		.content{
			margin:  0 .1em 0 .1em;
			padding: .1em;
		}
		.header{
			height:100px;
		}
		.header-logo-img{
  			height: inherit;
  			margin:0;
  			padding:.25em .3em .2em 1em;
		}
		.radioButtonContainer{
	  		padding:.25em;
  			margin:.5em;
		}
		.qStyleRadio {
		    margin: 0.25em .2em;
		}
		.moOrderInputDiv{
			width: 100%;
			margin:0.25em;
		}
		.manualOrderButtonContainer{
			justify-content: left;
			margin: .5em .1em 1em 2em; 
			font-size:.45em;
		}
		.mobInputContainer{
		   background-color: inherit;
		}
		.enterQuestionDiv, .enterAnswerChoiceDiv, .enterTitleDiv, .enterDescriptionDiv{
			width: 100%;
			margin:.1em;
			display: flex;
			flex-direction: column;
		}
		.content-section{
			padding: 1em 1em 5em .1em;
		}
		.link-unit-container{
			margin:0.1em;
		}
		.test-group-div{
			margin:.15em;
			padding:1em;
		}
		#nft-img-div{
			padding:1em;
		}
		.footer-item{
	   		line-height:1.5em;
	   		margin-top:-5em;
  	 	}
  	 	.hide-on-phone{
	   		display:none;
  	 	}
	}

</style>